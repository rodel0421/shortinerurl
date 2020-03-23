<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\Mailer\Email;
use Cake\Routing\Router;

/**
 * Registers Controller
 *
 * @property \App\Model\Table\RegistersTable $Registers
 */
class RegistersController extends AppController
{
    
    public function isAuthorized($user){
        // Bare minimum to all
        /*
         * 
            1 	Admin
            2 	Officer / Manager
            3 	Read Only
            4 	Staff
            5 	User / Operator
            6 	Student
            7 	Limited
         */
        //Everyone has access.
        
        //Officer / Manager only
        if (in_array($this->request->action, ['update'])) {
            if ($user['group_id'] <= 2) {
                return true;
            }
        }
        
        if (in_array($this->request->action, ['index','view','add','delete'])) {
            return true;
        }
        
        return parent::isAuthorized($user);
    }
    
    public function beforeFilter(\Cake\Event\Event $event){
         $this->Security->config('unlockedActions', ['update']);
         
         return parent::beforeFilter($event);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $contain = ['RegisterTemplates', 'Users', 'RegisterClasses', 'Departments'];
    	
    	$conditions = array();
        $userView = false;
    	
    	$alt = ['Users.name'=>'Users.name'];
        
    	$conditions = $this->buildConditions($this->Registers,$alt);
        
        $group = $this->Auth->user('group_id');
        if(!$group || $group > 3){//4 	staff and below lock to own account
            $conditions['user_id'] = $this->Auth->user('id');
            $userView = true;
        }
        
        if(!$this->request->query('archived')){
            $conditions['Registers.active']=1;
        }else{
            $conditions['Registers.active']=0;
        }
        
        $this->paginate = [
            'contain' => $contain,
            'conditions'=>$conditions,
            'limit' => 30,
            'order' => [
                'Users.name'
            ]
        ];
        
        
        $registers = $this->paginate($this->Registers);
        $registerClasses = $this->Registers->RegisterClasses->find('list', ['order' => 'title','consitions'=>['active'=>1]]);
        $registerTemplates = $this->Registers->RegisterTemplates->find('list', ['order' => 'name','consitions'=>['active'=>1]]);
        $departments = $this->Registers->Departments->find('list',['order'=>'name','consitions'=>['active'=>1]]);


        $this->set(compact('registers','registerClasses','registerTemplates','departments'));
        
    }

    /**
     * View method
     *
     * @param string|null $id Register id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        //$this->Registers->processAll();
        
        $register = $this->Registers->get($id, [
            'contain' => [
                'RegisterTemplates', 
                'Users'=>['UserDocs','Certifications'=>['CertificationTypes','Validated']], 
                'RegisterClasses', 
                'Departments', 
                'RegisterChecklists', 
                'RegisterForms']
        ]);
        
        $group = $this->Auth->user('group_id');
        $user_id = $this->Auth->user('id');
        $isOwner = $this->isOwner($register->user_id);
        $departments = $this->userDepartments();
        $departmentMember = isset($departments[$register->department_id]);//User in department
        
        if((!$group || $group > 3) && !$isOwner && !$departmentMember){//4 staff and below lock to own account
            $this->Flash->error(__('You do not have access to this record.'));
            return $this->redirect($this->referer());
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            
            $register = $this->Registers->patchEntity($register, $this->request->data);
            $sendNotification = ($register->dirty('status') && $register->status == 'In Progress');
            $registered = ($register->dirty('status') && ($register->status != 'In Progress'));
            $rejected = ($register->dirty('status') && ($register->status == 'Rejected'));
            
            if($isOwner && $register->dirty('register_class_id')){
                $this->Flash->error(__('You cannot process your own Register'));
                return $this->redirect($this->referer());
            }
            
            $reason = $this->request->data('reason');
            if($reason){
                $register->notes .= '<p><b>Rejected Reason: </b><br/>'.$reason.'</p>';
            }
            
            if($rejected && empty($reason)){
                $register->setError('reason','You must specify a reason.');
            }
            
            if ($this->Registers->save($register)) {
                $this->Flash->success(__('The Register has been updated.'));
                
                //if submit for processing Send notifications to department
                if($sendNotification) $this->notifyNewRegister($register);
                
                if($registered){
                    $this->loadModel('Alerts');
                    $this->Alerts->clear('New', 'Registers', $register->id);
                }
                
                if($rejected){
                    $this->send_user_email($register,$this->request->data('reason'));
                }
                
                if($this->request->query('back'))
                    return $this->redirect($this->request->query('back'));
                
                return $this->redirect(['controller'=>'Users','action'=>'view',$register->user_id]);
            }
            $this->Flash->error(__('The Register could not be updated. Please, try again.'));
        }
        
        $registerClasses = $this->Registers->RegisterClasses->find('list', 
                ['order' => 'title',
                'conditions'=>['active'=>1,'register_template_id'=>$register->register_template_id]]);
        
        $this->set(compact('register', 'registerClasses','isOwner','departmentMember'));
        
    }
    
    public function update(){
        $status = 'ERR';
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            try{
                $id = key($this->request->data);
                $register = $this->Registers->get($id, ['contain' => []]);
                $register = $this->Registers->patchEntity($register, $this->request->data[$id]);
                if ($this->Registers->save($register)) {
                    $status = 'OK';
                }
            
            }catch(Cake\Datasource\Exception\RecordNotFoundException $e){
                
            }
        }
        $this->set('status', $status);
    }
    
    
    //Create alert for department leaders
    private function notifyNewRegister($register){
        if($register->department_id){
            $this->loadModel('Alerts');
            $connection = ConnectionManager::get('default');
            $users = $connection->execute(
                    'SELECT DISTINCT user_id FROM departments_leaders WHERE department_id = :id'
                    , ['id' => $register->department_id])->fetchAll('assoc');
            
            $title = 'New Register: '.h($register->user->name).' # '.h($register->register_template->name);
            foreach($users as $user){
                $this->Alerts->create($title, 'New', 'Registers', $register->id,$user['user_id']);
            }
        }
    }
    
    private function send_user_email($register, $reason = ''){
        
        if(!$register->user->email){
            return false;
        }
        
        $dataArray['register'] = $register;
        $dataArray['reason'] = $reason;
        $dataArray['siteLink'] = Router::url('/', true);
        $dataArray['privacyLink'] = $this->privacyLink();
        $dataArray['loginLink'] = Router::url('/', true).'users/login';
        $setting = $this->siteSettings();
        $dataArray['client_name'] = ($setting) ? $setting->name:'';
        $dataArray['app_logo_text'] = ($setting && $setting->short)?$setting->short:'DDMS';
        
        $email = new Email();
        $email->emailFormat('html');
        $email->template('user_register_rejected', 'styled');
        $email->to($register->user->email, $register->user->name);
        $email->subject('Register Rejected');
        $email->viewVars($dataArray);
        $email->send();
        
        return true;
    }
    

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($user_id = null)
    {
        if(!$user_id){
            $user_id = $this->Auth->user('id');
        }
        
        $group = $this->Auth->user('group_id');
        if(!$group || $group > 3){//4 	staff and below lock to own account
            $user_id = $this->Auth->user('id');
            $this->request->data['valid'] = false;
        }
        
        $user = $this->Registers->Users->get($user_id, ['contain' => []]);
        
        $register = $this->Registers->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['user_id'] = $user_id;
            $this->request->data['active'] = true;
            
            
            if($this->request->data['register_template_id']){
                $registerTemplate = $this->Registers->RegisterTemplates->get((int) $this->request->data['register_template_id'],['fields'=>['checklists']]);
                //create checklists
                if(isset($registerTemplate->checklists)){
                    $checklists = explode("\n", $registerTemplate->checklists);

                    foreach($checklists as $checklist){
                        $title = trim($checklist);
                        if(!empty($title)){
                            $this->request->data['register_checklists'][] = ['title'=>$title,'status'=>'To be done'];
                        }
                    }
                }
            }
            
            $register = $this->Registers->patchEntity($register, $this->request->data,
                        ['associated' => ['RegisterChecklists']]);
            
            if ($this->Registers->save($register)) {
                $this->Flash->success(__('The register has been started.'));

                return $this->redirect(['action' => 'view',$register->id]);
            }
            $this->Flash->error(__('The register could not be saved. Please, try again.'));
        }
        
        
        $registerTemplates = $this->Registers->RegisterTemplates->find('all', [
            'order' => 'order',
            'conditions'=>['RegisterTemplates.active'=>true]]);
        
        $departments = $this->Registers
                ->RegisterTemplates->find()->matching('Departments')
                ->combine('_matchingData.Departments.id', 
                        '_matchingData.Departments.name', 
                        'id'
                        )->toArray();
        //die();
        $this->set(compact('register', 'registerTemplates', 'user', 'registerClasses', 'departments'));
        
    }

    

    /**
     * Delete method
     *
     * @param string|null $id Register id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        
        $register = $this->Registers->get($id);
        
        $group = $this->Auth->user('group_id');
        $user_id = $this->Auth->user('id');
        $departments = $this->userDepartments();
        $departmentMember = isset($departments[$register->department_id]);//User in department
        
        if((!$group || $group > 3) && $register->user_id != $user_id && !$departmentMember){//4 staff and below lock to own account
            $this->Flash->error(__('You do not have access to this record.'));
            return $this->redirect($this->referer());
        }        
        
        $msg = 'deleted';
        if($register->active){
            $register->active = 0;
        }else{
            $register->active = 1;
            $msg = 'restored';
        }
        if ($this->Registers->save($register)) {
            $this->Flash->success(__('The register has been '.$msg.'.'));
            
            $this->loadModel('Alerts');
            $this->Alerts->clear('New', 'Registers', $register->id);
            
        } else {
            $this->Flash->error(__('The register could not be '.$msg.'. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
