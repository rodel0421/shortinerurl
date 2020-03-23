<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Hash;

/**
 * Equipment Controller
 *
 * @property \App\Model\Table\EquipmentTable $Equipment
 */
class EquipmentController extends AppController
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
        $contain = [
            'EquipmentTypes', 
            'Departments', 
            'Users'];
    	
    	$conditions = array();
        $userView = false;
    	
    	$alt = ['Users.name'=>'Users.name'];
        
    	$conditions = $this->buildConditions($this->Equipment,$alt);
        
        $group = $this->Auth->user('group_id');
        if(!$group || $group > 3){//4 	staff and below lock to own account
            $departments = $this->userDepartments();
            if(!empty($departments)){
                $conditions['OR'] = [
                'Equipment.department_id IN'=>  array_keys($departments),
                'Equipment.user_id'=> $this->Auth->user('id')
                    ];
            }else{
                $conditions['Equipment.user_id'] = $this->Auth->user('id');
            }
            
            $userView = true;
        }
        
        if(!$this->request->query('archived')){
            $conditions['Equipment.active']=1;
        }else{
            $conditions['Equipment.active']=0;
        }
        
        if($this->facility_id()){
            $conditions['Equipment.facility_id']=$this->facility_id();
        }else{
            $conditions[]='Equipment.facility_id IS NULL';
        }
        
        if($this->request->query('service')){
            $conditions[] = 'Equipment.next_service IS NOT NULL';
            $conditions['Equipment.next_service <='] = date("Y-m-d", strtotime($this->request->query('service')));
        }
                
        if($this->request->query('search')){
            $conditions['OR']['Equipment.title LIKE']='%'.$this->request->query('search').'%';
            $conditions['OR']['Equipment.make LIKE']='%'.$this->request->query('search').'%';
            $conditions['OR']['Equipment.model LIKE']='%'.$this->request->query('search').'%';
            $conditions['OR']['Equipment.asset LIKE']='%'.$this->request->query('search').'%';
        }
        
        $this->paginate = [
            'contain' => $contain,
            'conditions'=>$conditions,
            'fields'=>[
                'Equipment.id','Equipment.title','EquipmentTypes.title','Departments.name','Equipment.asset',
                'Equipment.make','Equipment.status','Equipment.alert_status','Equipment.next_service','Equipment.next_alert'
                ],
            'limit' => 30,
            'order' => [
                'Equipment.title'
            ]
        ];
        
        $equipment = $this->paginate($this->Equipment);
        $equipmentTypes = $this->Equipment->EquipmentTypes->find('list', ['order' => 'title','conditions'=>['active'=>true]]);
        $departments = $this->Equipment->Departments->find('list', ['order' => 'name','conditions'=>['active'=>true]]);

        $this->set(compact('equipment','equipmentTypes', 'departments'));
        $this->set('_serialize', ['equipment']);//Needed for lookup
    }

    /**
     * View method
     *
     * @param string|null $id Equipment id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $equipment = $this->Equipment->get($id, [
            'contain' => [
                'EquipmentTypes', 
                'Departments', 
                'Users', 
                'EquipmentLogs'=>['Users'],
                'RelatedEquipment.EquipmentTypes',
                'RelatedToEquipment.EquipmentTypes']
        ]);
        
        $group = $this->Auth->user('group_id');
        //Not RO or better
        if(!$group || $group > 3){//Staff and below lock to own account
            //Check if in department
            $departments = $this->userDepartments();
            $depOK = isset($departments[$equipment->department_id]);
            //If not owner reject
            if(!$depOK && $equipment->user_id != $this->Auth->user('id')){
                 $this->Flash->error(__('You do not have access to this record.'));
                return $this->redirect($this->referer());
            }
        }
        
        $equipmentLogs=[];
        if($equipment->has('equipment_logs')){
            $equipmentLogs = Hash::combine($equipment->equipment_logs,'{n}.id','{n}','{n}.type');
        }
        
        
        $this->set(compact('equipment', 'equipmentLogs'));
        
    }
    
    public function preview($id = null)
    {
        $equipment = $this->Equipment->get($id, [
            'contain' => [
                'EquipmentTypes',
                'EquipmentLogs'=>['conditions'=>['public'=>true,'type'=>'Document']]
                ]
        ]);
        
        $group = $this->Auth->user('group_id');
        //Not RO or better
        if(!$group || $group > 3){//Staff and below lock to own account
            //Check if in department
            $departments = $this->userDepartments();
            $depOK = isset($departments[$equipment->department_id]);
            
            $hireOK = $equipment->for_hire;
            //Only show hire equipment to public 
            //If not owner reject
            if(!$hireOK && !$depOK && $equipment->user_id != $this->Auth->user('id')){
                 $this->Flash->error(__('You do not have access to this record.'));
                return $this->redirect($this->referer());
            }
        }
        
        $this->set(compact('equipment'));
        
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($user_id = null)
    {
        
        $group = $this->Auth->user('group_id');
        if(!$group || $group > 3){//operators and below lock to own account
            $user_id = $this->Auth->user('id');
            $this->request->data['valid'] = false;
            
            $departments = $this->userDepartments();
        }else{
            $departments = $this->Equipment->Departments->find('list', ['order' => 'name','conditions'=>['active'=>true]]);
        }
        
        if($user_id){
            $user = $this->Equipment->Users->get($user_id, ['contain' => []]);
            $this->set(compact('user'));
        }
        
        $equipment = $this->Equipment->newEntity();
        if ($this->request->is('post')) {
            if(isset($user)){
                $this->request->data['user_id'] = $user->id;
            }
            
            $this->request->data['facility_id']=$this->facility_id();
            
            $equipment = $this->Equipment->patchEntity($equipment, $this->request->data);
            if ($this->Equipment->save($equipment)) {
                $this->Flash->success(__('The equipment has been saved.'));
                if(isset($user)){
                    return $this->redirect(['controller'=>'Users','action' => 'view',$user->id]);
                }
                return $this->redirect(['action' => 'view',$equipment->id]);
            }
            $this->Flash->error(__('The equipment could not be saved. Please, try again.'));
        }
        
        $equipmentTypes = $this->Equipment->EquipmentTypes->find('list', ['order' => 'title','conditions'=>['active'=>true]]);
        
        
        $this->set(compact('equipment',  'equipmentTypes', 'departments'));
        
    }

    /**
     * Edit method
     *
     * @param string|null $id Equipment id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $equipment = $this->Equipment->get($id, [
            'contain' => ['EquipmentTypes']
        ]);
               
        $group = $this->Auth->user('group_id');
        $user_id = $this->Auth->user('id');
        //Check if in department
        $departments = $this->userDepartments();
        $depOK = isset($departments[$equipment->department_id]);
        if((!$group || $group > 3) && !$depOK && $equipment->user_id != $user_id){//4 operators and below lock to own account
            $this->Flash->error(__('You do not have access to this record.'));
            return $this->redirect($this->referer());
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $equipment = $this->Equipment->patchEntity($equipment, $this->request->data);
            if ($this->Equipment->save($equipment)) {
                $this->Flash->success(__('The equipment has been saved.'));
                
                return $this->redirect(['action' => 'view',$id]);
            }
            $this->Flash->error(__('The equipment could not be saved. Please, try again.'));
        }
        
        //$related_equipment = $this->Equipment->find('list');
        $equipmentTypes = $this->Equipment->EquipmentTypes->find('list', ['order' => 'title',
            'conditions'=>['EquipmentTypes.active'=>true]]);
        $departments = $this->Equipment->Departments->find('list', ['order' => 'name',
            'conditions'=>['Departments.active'=>true]]);
        
        $this->set(compact('equipment', 'equipmentTypes', 'departments'));
        
    }
    
    public function custom($id = null)
    {
        $equipment = $this->Equipment->get($id, [
            'contain' => ['EquipmentTypes']
        ]);
        
        $group = $this->Auth->user('group_id');
        $user_id = $this->Auth->user('id');
        //Check if in department
        $departments = $this->userDepartments();
        $depOK = isset($departments[$equipment->department_id]);
        if((!$group || $group > 3) && !$depOK && $equipment->user_id != $user_id){//4 operators and below lock to own account
            $this->Flash->error(__('You do not have access to this record.'));
            return $this->redirect($this->referer());
        }
        
        
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $custom_data = json_encode($this->request->data('Custom'));
            
            if($custom_data){
                $equipment->type_data = $custom_data;
            }
            
            if ($custom_data && $this->Equipment->save($equipment)) {
                $this->Flash->success(__('The equipment has been saved.'));
                
                return $this->redirect(['action' => 'view',$id]);
            }
            $this->Flash->error(__('The equipment could not be saved. Please, try again.'));
        }else{
            $curent = json_decode($equipment->type_data, true);
            if($curent){
                $this->request->data['Custom'] = $curent;
            }
        }
        
        $this->set(compact('equipment'));
        
    }

    /**
     * Delete method
     *
     * @param string|null $id Equipment id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        
        $equipment = $this->Equipment->get($id);
        
        $group = $this->Auth->user('group_id');
        $user_id = $this->Auth->user('id');
        //Check if in department
        $departments = $this->userDepartments();
        $depOK = isset($departments[$equipment->department_id]);
        if((!$group || $group > 3) && !$depOK && $equipment->user_id != $user_id){//4 operators and below lock to own account
            $this->Flash->error(__('You do not have access to delete this record.'));
            return $this->redirect($this->referer());
        }
        
        $msg = 'archived';
        if($equipment->active){
            $equipment->active = 0;
        }else{
            $equipment->active = 1;
            $msg = 'restored';
        }
        
        if ($this->Equipment->save($equipment)) {
            $this->Flash->success(__('The equipment has been '.$msg.'.'));
        } else {
            $this->Flash->error(__('The equipment could not be '.$msg.'. Please, try again.'));
        }
        
        if($equipment->user_id){
            return $this->redirect(['controller'=>'Users','action' => 'view',$equipment->user_id]);
        }

        return $this->redirect(['action' => 'index']);
    }
    
}
