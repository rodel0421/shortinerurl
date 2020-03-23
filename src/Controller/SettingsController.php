<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;

use Cake\Event\Event;

/**
 * Settings Controller
 *
 * @property \App\Model\Table\SettingsTable $Settings
 */
class SettingsController extends AppController
{
    public function initialize(){
        parent::initialize();
    
        //$this->set('auth_domain_csv', 'Test-title');
    }
    
    private $_areas = [
        'Registers'=>'Registers',
        'People'=>'People Lookup',
        'Trips'=>'Trips'
    ];
    
    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow(['index']);
        
    }
    
    public function isAuthorized($user){
        // Bare minimum to all
        if (in_array($this->request->action, ['training'])) {
            return true;
        }
        
        return parent::isAuthorized($user);
    }
    
    public function training($id = null){
        
        if(isset($id)){
            $this->Cookie->write('training_data', 'true');  
        }else{
            if ($this->Cookie->check('training_data')){
                $this->Cookie->delete('training_data');
            }
        }
        
        return $this->redirect($this->referer());
    }
    
    public function index()
    {
        if($this->siteSettings()){
            //Allready setup
            return $this->redirect($this->referer());
        }
        
        $setting = $this->Settings->newEntity();
        if ($this->request->is(['patch', 'post', 'put'])) {
            //Enable all
            $this->request->data['enabled_areas'] = array_keys($this->_areas);
            
            $setting = $this->Settings->patchEntity($setting, $this->request->data);
            if ($this->Settings->save($setting)) {
                $this->Flash->success('The setting has been saved.');

                $this->loadModel('Users');
                $admins = $this->Users->find()->where(['group_id'=>1])->count();
                if($admins == 0){
                    return $this->redirect(['controller'=>'Users','action' => 'add','admin'=>true]);
                }else{
                    return $this->redirect(['controller'=>'Users','action' => 'login']);
                }
            } else {
                $this->Flash->error('The setting could not be saved. Please, try again.');
            }
        }
        //$this->set('isTrial',$this->isTrial());
        $this->set(compact('setting'));
    }
    
    /**
     * Edit method
     *
     * @param string|null $id Setting id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit()
    {
        //$this->set('auth_domain_csv', 'Test-title');
        $setting = $this->Settings->find()->contain([])->first();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $setting = $this->Settings->patchEntity($setting, $this->request->data);
            if ($this->Settings->save($setting)) {
                $this->Flash->success('The setting has been saved.');

                return $this->redirect(['action' => 'edit']);
            } else {
                $this->Flash->error('The setting could not be saved. Please, try again.');
            }
        }
        //$this->set('isTrial',$this->isTrial());
        $areas = $this->_areas;
        $this->set(compact('setting','areas'));
    }
    
    
    
}
