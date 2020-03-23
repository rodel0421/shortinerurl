<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Messages Controller
 *
 * @property \App\Model\Table\MessagesTable $Messages
 */
class MessagesController extends AppController
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
        
        //Staff and above
        if (in_array($this->request->action, ['add','delete','edit'])) {
            if ($user['group_id'] <= 4) { 
                return true;
            }
        }
        
        if (in_array($this->request->action, ['index','view'])) {
            return true;
        }
        
        return parent::isAuthorized($user);
    }
    
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $contain = ['Users'];
    	
    	$conditions = [];
    	
    	$alt = [];
        
    	$conditions = $this->buildConditions($this->Messages,$alt);
        
        if(!$this->request->query('archived')){
            $conditions['Messages.active']=1;
            
            if(!$this->request->query('history')){
                $conditions['Messages.expires >=']=date('Y-m-d');
            }else{
                $conditions['Messages.expires <']=date('Y-m-d');
            }
        }else{
            $conditions['Messages.active']=0;
        }
        
        
        if($this->facility_id()){
            $conditions['Messages.facility_id']=$this->facility_id();
        }else{
            $conditions[]='Messages.facility_id IS NULL';
        }
        
        $group = $this->Auth->user('group_id');
        if((!$group || $group > 2)){
            $conditions['Messages.expires >='] = date('Y-m-d');
        }
        
        $this->paginate = [
            'contain' => $contain,
            'conditions'=>$conditions,
            'limit' => 30,
            'order' => [
                'Messages.created'=>'desc'
            ]
        ];
        
        $messages = $this->paginate($this->Messages);

        $this->set(compact('messages'));
        
    }

    /**
     * View method
     *
     * @param string|null $id Message id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $message = $this->Messages->get($id, [
            'contain' => ['Users', 'Facilities']
        ]);

        $this->set('message', $message);
        
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $message = $this->Messages->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['user_id'] = $this->Auth->user('id');
            $this->request->data['facility_id']=$this->facility_id();
            $message = $this->Messages->patchEntity($message, $this->request->data);
            if ($this->Messages->save($message)) {
                $this->Flash->success(__('The message has been saved.'));

                if($this->request->data('block_send_alert')){
                    $to = $this->request->data('department_id');
                    $this->sendAlerts($message->id,$to);
                }
                
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The message could not be saved. Please, try again.'));
        }
        
        $this->loadModel('Departments');
        $departments = $this->Departments->find('list', ['order' => 'name','conditions'=>['active'=>1]]);
        
        $this->set(compact('message','departments'));
        
    }

    /**
     * Edit method
     *
     * @param string|null $id Message id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $message = $this->Messages->get($id, [
            'contain' => []
        ]);
        
        $group = $this->Auth->user('group_id');
        $user_id = $this->Auth->user('id');
        if((!$group || $group > 2) && $message->user_id != $user_id){//3 officer and below lock to own account
            $this->Flash->error(__('You do not have access to this record.'));
            return $this->redirect($this->referer());
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $message = $this->Messages->patchEntity($message, $this->request->data);
            if ($this->Messages->save($message)) {
                $this->Flash->success(__('The message has been saved.'));
                
                if($this->request->data('block_send_alert')){
                    $to = $this->request->data('department_id');
                    $this->clearAlerts($message->id);
                    $this->sendAlerts($message->id,$to);
                }

                return $this->redirect(['action' => 'view',$id]);
            }
            $this->Flash->error(__('The message could not be saved. Please, try again.'));
        }
        
        $this->loadModel('Departments');
        $departments = $this->Departments->find('list', ['order' => 'name','conditions'=>['active'=>1]]);
        
        $this->set(compact('message','departments'));
        
    }
    
    private function sendAlerts($id,$department_id = null){
        $messages = $this->Messages->get($id, [
            'contain' => []
        ]);
        
        if(!$department_id){
            $this->loadModel('Users');
            //Send to all
            $users = $this->Users->find()->select('id')
                    ->where(['active'=>true])
                    ->extract('id')->toArray();
        }else{
            $this->loadModel('Departments');
            //send just to people in the department
            $department = $this->Departments->find()
                    ->contain(
                        ['Users'=>[
                            'conditions'=>['Users.active'=>true],
                            'fields'=>['Users.id','DepartmentsUsers.department_id']
                            ]]
                    )
                    ->where(['active'=>true,'id'=>$department_id])
                    ->first();
            $users = \Cake\Utility\Hash::extract($department->users,'{n}.id');           
        }
        
        if(!empty($users)){
            $this->loadModel('Alerts');
            foreach($users as $user_id){
                $this->Alerts->create('New Notice Board Message: '.h($messages->title), 'New', 'Messages', $id,$user_id);
            }
        }
    }
    
    private function clearAlerts($id){
        $this->loadModel('Alerts');
        $this->Alerts->clear('New', 'Messages', $id);
    }

    /**
     * Delete method
     *
     * @param string|null $id Message id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $message = $this->Messages->get($id);
        
        $group = $this->Auth->user('group_id');
        $user_id = $this->Auth->user('id');
        if((!$group || $group > 2) && $message->user_id != $user_id){//3 officer and below lock to own account
            $this->Flash->error(__('You do not have access to this record.'));
            return $this->redirect($this->referer());
        }
        
        $msg = 'deleted';
        if($message->active){
            $message->active = 0;
        }else{
            $message->active = 1;
            $msg = 'restored';
        }
        if ($this->Messages->save($message)) {
            $this->Flash->success(__('The message has been '.$msg.'.'));
            $this->clearAlerts($message->id);
        } else {
            $this->Flash->error(__('The message could not be '.$msg.'. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
