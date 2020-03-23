<?php

namespace App\Shell;

use Cake\Console\Shell;
use Cake\I18n\Time;
use Cake\Mailer\Email;
use Cake\Routing\Router;


class NotificationShell extends Shell
{
//sudo crontab -u www-data -e
// bin/cake Notification
//     sudo -u www-data bin/cake Notification

    public function initialize()
    {
        parent::initialize();
        //$this->loadModel('');
        Time::$defaultLocale = 'en_AU';
	    Time::setToStringFormat('dd/MM/yyyy');
    }
    
    /*
     *  Notify users who have equipment due back in the next 24 hours
     * Only do for bookings longer than 2 days    */
    public function equipment() {
        $this->out('Notification Shell - equipment_reminder');
        $this->loadModel('Users');
        
        $equipmentCond = [
                    'EquipmentReservations.start < CURDATE()', #Not today
                    'EquipmentReservations.end = DATE_ADD(CURDATE(), INTERVAL 1 day)',#Tomorrow
                    'EquipmentReservations.approved'=>true,
                    'EquipmentReservations.returned'=>false];
        
        $usersWithReturns = $this->Users->EquipmentReservations->find()
                ->where($equipmentCond)
                ->extract('user_id')->toArray();
        
        $users = [];
        if($usersWithReturns){
            $users = $this->Users->find()
                    ->select(['id','given_name','email'])
                    ->contain([
                        'EquipmentReservations'=>[
                            'conditions'=>$equipmentCond,
                            'Equipment'=>[
                                'fields'=>['title'],
                                'EquipmentTypes'=>['fields'=>['title']]
                                ]
                            ]
                        ])
                ->where(['id IN'=>$usersWithReturns,'active'=>true])->toArray();
        }
        
        if($users){
            $this->loadModel('Settings');
            $setting = $this->Settings->find()->contain([])->first();
            $client_name = ($setting) ? $setting->name:'';
            $app_logo_text = ($setting && $setting->short)?$setting->short:'DDMS';
            $siteLink = Router::url('/', true);
            $privacyLink = null;  
            if (\Cake\Core\Configure::check('Client.privacy_policy_url')) {
                $privacyLink = \Cake\Core\Configure::read('Client.privacy_policy_url');   
            }
            //Remove invalid links
            if (filter_var($privacyLink, FILTER_VALIDATE_URL) === false) {
                $privacyLink = null;    
            }
            $dataArray['privacyLink'] = $privacyLink;    
            $loginLink = Router::url('/', true).'users/login';
            
            $this->out('Processing '.count($users).' users.');
            $this->loadModel('Users');
            foreach($users as $user){
                
                
                $email = new Email();
                $email->template('equipment_reminder', 'styled')
                    ->emailFormat('html')
                    ->viewVars(compact('user','siteLink','privacyLink','loginLink','client_name','app_logo_text'))
                    ->to($user->email)
                    ->subject($app_logo_text.' - Equipment Return Reminder')
                    ->send();
                
                sleep(3);
            }
        }
        
    }
    
    /*
     * Send cert and registers status email for all users
     * that have a cert or register expiring soon
     *  */
    public function status() {
        $this->out('Notification Shell - status');
        $this->loadModel('Certifications');
        
        
        //Users with expiring certs
        $invalid_certs = $this->Certifications->find()
                ->where(['status >' => 1,
                        'active' => true,
                        'valid' => true])
                ->select('user_id')
                ->distinct('user_id')->extract('user_id');
        
        //Users with expiring registers
        $this->loadModel('Registers');
        $invalid_registers = $this->Registers->find()
                ->where(['status' => 'Registered',
                        'active' => true,
                        'cert_status >' => 1])
                ->select('user_id')
                ->distinct('user_id')->extract('user_id');
        
        $users = array_merge($invalid_certs->toArray(), $invalid_registers->toArray());
        $users = array_unique($users);
        
        if(!empty($users)){
            //Processing count($users)
            $this->out('Processing '.count($users).' users.');
            $this->loadModel('Users');
            foreach($users as $user_id){
                $this->Users->sendStatusEmail($user_id);
                sleep(3);
            }
        }
        
    }
    
    
    /*
     * Send cert and registers status email to department leaders
     *  */
    public function departments() {
        $this->out('Notification Shell - departments');
        
        $this->loadModel('Departments');
        
        
        
        $departmnts = array_unique($this->Departments->DepartmentsLeaders->find()
            ->select('department_id')
            ->extract('department_id')->toArray());
        
                
        if(!empty($departmnts)){
            //Processing count($users)
            $this->out('Processing '.count($departmnts).' departments.');
            
            foreach($departmnts as $departmnt_id){
                $sent = $this->Departments->sendStatusEmail($departmnt_id);
                if($sent){
                    $this->out('Sent department #'.$departmnt_id);
                }
                sleep(3);
            }
            
        }
        
    }
    
    
    /*
     * Default call for this shell
     * Will send any new alerts a user has
     *   */
    public function alerts(){
        $this->out('Notification Shell - alerts');
        $this->loadModel('Users');
        
        $this->loadModel('Settings');
        $setting = $this->Settings->find()->contain([])->first();
        $client_name = ($setting) ? $setting->name:'';
        $app_logo_text = ($setting && $setting->short)?$setting->short:'DDMS';
        
        //Only get the last week of alerts
        $users = $this->Users->find('all',[
            'contain'=>[
                'Alerts'=>[
                    'conditions'=>[
                        'ack IS NULL',
                        'active'=>1,
                        'created >='=> date('Y-m-d',  strtotime('- 1 week'))
                        ]
                    ]],
            'conditions'=>[
                'active'=>1]
        ]);
        
        $this->out('Users #'.$users->count());
                
        $siteLink = Router::url('/', true);
        $privacyLink = null;   
        if (\Cake\Core\Configure::check('Client.privacy_policy_url')) {
            $privacyLink = \Cake\Core\Configure::read('Client.privacy_policy_url');   
        }
        //Remove invalid links
        if (filter_var($privacyLink, FILTER_VALIDATE_URL) === false) {
            $privacyLink = null;    
        }

        $loginLink = Router::url('/', true).'users/login';
        
        foreach($users as $user){
            if($user->has('alerts') && count($user->alerts) > 0){
                $this->out($user->name.' has alerts #'.count($user->alerts));
                
                //mark as sent
                $hasNew = false;
                foreach($user->alerts as $alert){
                    if(!$alert->first_sent){
                        $hasNew = true;
                        
                        $alert->first_sent = date('Y-m-d H:i:s');
                        $this->Users->Alerts->save($alert);
                    }
                }
                
                if(!$hasNew) continue;//do not send if nothing new
                
                $this->out('Emailing...');
                $email = new Email();
                $email->template('user_alerts', 'styled')
                    ->emailFormat('html')
                    ->viewVars(compact('user','siteLink','privacyLink','loginLink','client_name','app_logo_text'))
                    ->to($user->email)
                    ->subject($app_logo_text.' - Pending Notifications')
                    ->send();
                
                
                sleep(3);
                
            }
        }
    }
    
    public function main() {
        $this->out('Notification Shell');
        $this->alerts();
    }
     
}
