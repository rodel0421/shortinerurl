<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UserDocs Controller
 *
 * @property \App\Model\Table\UserDocsTable $UserDocs
 */
class UserDocsController extends AppController
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
        //Permissions are checked in each function
        return true;
    }
    
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $contain = ['Users'];
    	
    	$conditions = array();
        $userView = false;
    	
    	$alt = ['Users.name'=>'Users.name'];
        
    	$conditions = $this->buildConditions($this->UserDocs,$alt);
        
        $group = $this->Auth->user('group_id');
        if(!$group || $group > 3){//4 	staff and below lock to own account
            $conditions['user_id'] = $this->Auth->user('id');
            $userView = true;
        }
        
        if(!$this->request->query('archived')){
            $conditions['UserDocs.active']=1;
        }else{
            $conditions['UserDocs.active']=0;
        }
        
        $this->paginate = [
            'contain' => $contain,
            'conditions'=>$conditions,
            'limit' => 30,
            'order' => [
                'Users.name'
            ]
        ];
        
        $userDocs = $this->paginate($this->UserDocs);

        $this->set(compact('userDocs'));
    }

    /**
     * View method
     *
     * @param string|null $id User Doc id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userDoc = $this->UserDocs->get($id, [
            'contain' => ['Users']
        ]);
        
        $group = $this->Auth->user('group_id');
        $user_id = $this->Auth->user('id');
        if((!$group || $group > 3) && $userDoc->user_id != $user_id){//4 staff and below lock to own account
            $this->Flash->error(__('You do not have access to this record.'));
            return $this->redirect($this->referer());
        }
        
        //Private means user cannot view. Only RO and above
        if($userDoc->private && (!$group || $group > 3)){
            $this->Flash->error(__('You do not have access to this record.'));
            return $this->redirect($this->referer());
        }

        $this->set('userDoc', $userDoc);
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
        if(!$group || $group > 2){//3 RO and below lock to own account
            $user_id = $this->Auth->user('id');
            $this->request->data['private'] = false;
        }
        
        $user = $this->UserDocs->Users->get($user_id, ['contain' => []]);
        
        $userDoc = $this->UserDocs->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['user_id'] = $user_id;
            $this->request->data['active'] = true;
            
            $userDoc = $this->UserDocs->patchEntity($userDoc, $this->request->data);
            if ($this->UserDocs->save($userDoc)) {
                $this->Flash->success(__('The user doc has been saved.'));

                if($this->request->query('back'))
                    return $this->redirect($this->request->query('back'));
                
                return $this->redirect(['controller'=>'Users','action' => 'view',$user_id]);
            }
            $this->Flash->error(__('The user doc could not be saved. Please, try again.'));
        }
        
        $this->set(compact('userDoc','user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User Doc id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userDoc = $this->UserDocs->get($id, [
            'contain' => []
        ]);
        
        $group = $this->Auth->user('group_id');
        $user_id = $this->Auth->user('id');
        if((!$group || $group > 2) && $userDoc->user_id != $user_id){//3 RO and below lock to own account
            $this->Flash->error(__('You do not have access to this record.'));
            return $this->redirect($this->referer());
        }
        
        //Private means user cannot view. Only Officer and above
        if($userDoc->private && (!$group || $group > 2)){
            $this->Flash->error(__('You do not have access to this record.'));
            return $this->redirect($this->referer());
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userDoc = $this->UserDocs->patchEntity($userDoc, $this->request->data);
            if ($this->UserDocs->save($userDoc)) {
                $this->Flash->success(__('The user doc has been saved.'));

                if($this->request->query('back'))
                    return $this->redirect($this->request->query('back'));
                
                return $this->redirect(['controller'=>'Users','action' => 'view',$userDoc->user_id]);
            }
            $this->Flash->error(__('The user doc could not be saved. Please, try again.'));
        }
        
        $this->set(compact('userDoc'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User Doc id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userDoc = $this->UserDocs->get($id);
        
        $group = $this->Auth->user('group_id');
        $user_id = $this->Auth->user('id');
        if((!$group || $group > 2) && $userDoc->user_id != $user_id){//3 RO and below lock to own account
            $this->Flash->error(__('You do not have access to this record.'));
            return $this->redirect($this->referer());
        }
        
        //Private means user cannot view. Only Officer and above
        if($userDoc->private && (!$group || $group > 2)){
            $this->Flash->error(__('You do not have access to this record.'));
            return $this->redirect($this->referer());
        }
        
        $msg = 'deleted';
        if($userDoc->active){
            $userDoc->active = 0;
        }else{
            $userDoc->active = 1;
            $msg = 'restored';
        }
        
        if ($this->UserDocs->save($userDoc)) {
            $this->Flash->success(__('The document has been '.$msg.'.'));
        } else {
            $this->Flash->error(__('The document could not be '.$msg.'. Please, try again.'));
        }

        return $this->redirect(['controller'=>'Users','action' => 'view',$userDoc->user_id]);
    }
}
