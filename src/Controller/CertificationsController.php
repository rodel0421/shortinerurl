<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Certifications Controller
 *
 * @property \App\Model\Table\CertificationsTable $Certifications
 */
class CertificationsController extends AppController
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
        $contain = ['Users'=>['Departments'], 'CertificationTypes'];
    	
    	$conditions = array();
        $userView = false;
    	
    	$alt = ['Users.name'=>'Users.name'];
        
    	$conditions = $this->buildConditions($this->Certifications,$alt);
        
        $group = $this->Auth->user('group_id');
        if(!$group || $group > 3){//4 	staff and below lock to own account
            $conditions['user_id'] = $this->Auth->user('id');
            $userView = true;
        }
        
        if($this->request->query('department_id')){
            $user_ids = $this->Certifications->Users->DepartmentsUsers->find()
                    ->select('user_id')
                    ->contain([])
                    ->where(['department_id'=>$this->request->query('department_id')])
                    ->extract('user_id')->toArray();
            
            $this->request->data['department_id'] = $this->request->query('department_id');
            if(!empty($user_ids)){
                $conditions['Users.id IN'] = $user_ids;
            }else{
                $conditions['Users.id'] = 0;
            }
            
        }
        
        if(!$this->request->query('archived')){
            $conditions['Certifications.active']=1;
        }else{
            $conditions['Certifications.active']=0;
        }
        
        $this->paginate = [
            'contain' => $contain,
            'conditions'=>$conditions,
            'limit' => 30,
            'order' => [
                'Users.name'
            ]
        ];
        
        $certifications = $this->paginate($this->Certifications);
        $departments = $this->Certifications->Users->Departments->find('list', ['order' => 'name']);
        
        $certificationTypes = $this->Certifications->CertificationTypes->find('list', ['order' => 'name','conditions'=>['active'=>true]]);
        $this->set(compact('certifications','certificationTypes','userView','departments'));
    }

    /**
     * View method
     *
     * @param string|null $id Certification id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        
        
        $certification = $this->Certifications->get($id, [
            'contain' => ['Users','Validated', 'CertificationTypes']
        ]);
        
        $group = $this->Auth->user('group_id');
        $user_id = $this->Auth->user('id');
        $owner = $certification->user_id == $user_id;
        if((!$group || $group > 3) && !$owner){//4 staff and below lock to own account
            $this->Flash->error(__('You do not have access to this record.'));
            return $this->redirect($this->referer());
        }

        $this->set(compact('certification', 'owner'));
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
        
        if($this->request->query('replacing')){
            $replacing = $this->Certifications->get($this->request->query('replacing'), [
                'contain' => ['CertificationTypes']
            ]);
            
            if($user_id != $replacing->user_id){
                $this->Flash->error(__('Invalid url'));
                return $this->redirect($this->referer());
            }
            
            $this->set(compact('replacing'));
            
        }
        
        $user = $this->Certifications->Users->get($user_id, ['contain' => []]);
        
        $certification = $this->Certifications->newEntity();
        if ($this->request->is('post')) {
            if(!isset($this->request->data['valid'])){
                $this->request->data['valid'] = false;
            }
            
            $this->request->data['user_id'] = $user_id;
            $this->request->data['active'] = true;
            //$this->request->data['status'] = 4;
            
            $certification = $this->Certifications->patchEntity($certification, $this->request->data);
            
            if ($this->Certifications->save($certification)) {
                $this->Flash->success(__('The certification has been saved.'));
                
                if(isset($replacing)){
                    $replacing->active = false;
                    $this->Certifications->save($replacing);
                }
                
                if($this->request->query('back'))
                    return $this->redirect($this->request->query('back'));
                
                return $this->redirect(['controller'=>'Users','action' => 'view',$user_id]);
            }
            $this->Flash->error(__('The certification could not be saved. Please, try again.'));
        }
        
        $options = ['order' => 'name','conditions'=>['active'=>true]];
        if($this->request->query('type')){
            $options['conditions']['type']=$this->request->query('type');
        }
        $certificationTypes = $this->Certifications->CertificationTypes->find('list', $options);
        
        
        $this->set(compact('certification', 'user', 'certificationTypes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Certification id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $certification = $this->Certifications->get($id, [
            'contain' => ['Users']
        ]);
        
        $group = $this->Auth->user('group_id');
        $user_id = $this->Auth->user('id');
        $owner = $certification->user_id == $user_id;
        if((!$group || $group > 2) && !$owner){//3 RO and below lock to own account
            $this->Flash->error(__('You do not have access to this record.'));
            return $this->redirect($this->referer());
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $redirect = ['controller'=>'Users','action' => 'view',$certification->user_id];
            
            $validating = isset($this->request->data['valid']);
            
            if($validating){ //Cannot validate own.
                if($owner && $this->request->data['valid'] == 1){
                    $this->Flash->error(__('You cannot validate your own certification'));
                    return $this->redirect($redirect);
                }
                
                //Dont allow plebs to set validation to 1 only 0
                if(!$group || $group > 2){
                    $this->request->data['valid'] = 0;
                    $this->request->data['validated_by'] = null;
                    $this->request->data['validated_date'] =  null;
                }else{
                    $this->request->data['validated_by'] = $user_id;
                    $this->request->data['validated_date'] =  date('Y-m-d H:i:s');
                }
                
                if($this->request->data['valid'] == 0){
                    $redirect = ['action' => 'edit',$id];
                }
            }
                        
            $certification = $this->Certifications->patchEntity($certification, $this->request->data);
            if ($this->Certifications->save($certification)) {
                $this->Flash->success(__('The certification has been saved.'));

                if($this->request->query('back'))
                    return $this->redirect($this->request->query('back'));
                
                return $this->redirect($redirect);
            }
            $this->Flash->error(__('The certification could not be saved. Please, try again.'));
        }
        $certificationTypes = $this->Certifications->CertificationTypes->find('list', ['order' => 'name','conditions'=>['active'=>true]]);
        $this->set(compact('certification', 'certificationTypes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Certification id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $certification = $this->Certifications->get($id);
        
        $group = $this->Auth->user('group_id');
        $user_id = $this->Auth->user('id');
        if((!$group || $group > 2) && $certification->user_id != $user_id){//3 RO and below lock to own account
            $this->Flash->error(__('You do not have access to this record.'));
            return $this->redirect($this->referer());
        }
        
        $msg = 'deleted';
        if($certification->active){
            $certification->active = 0;
        }else{
            $certification->active = 1;
            $msg = 'restored';
        }
        if ($this->Certifications->save($certification)) {
            $this->Flash->success(__('The certification has been '.$msg.'.'));
        } else {
            $this->Flash->error(__('The certification could not be '.$msg.'. Please, try again.'));
        }

        if($this->request->query('back'))
                    return $this->redirect($this->request->query('back'));
        return $this->redirect(['controller'=>'Users','action' => 'view',$certification->user_id]);
    }
}
