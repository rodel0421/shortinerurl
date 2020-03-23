<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * EquipmentLogs Controller
 *
 * @property \App\Model\Table\EquipmentLogsTable $EquipmentLogs
 */
class EquipmentLogsController extends AppController
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
        
        if (in_array($this->request->action, ['index'])) {
            if ($user['group_id'] <= 3) {
                return true;
            }
        }
        
        if (in_array($this->request->action, ['edit','add','delete'])) {
            return true;
        }
        
        return parent::isAuthorized($user);
    }
    
    public function index()
    {
        $contain = ['Equipment'=>['Departments','EquipmentTypes']];
    	
    	$conditions = array();
        $userView = false;
    	
    	$alt = ['Equipment.equipment_type_id'=>'Equipment.equipment_type_id',
            'Equipment.department_id'=>'Equipment.department_id',
            'Equipment.title'=>'Equipment.title'];
        
    	$conditions = $this->buildConditions($this->EquipmentLogs,$alt);
        
        $conditions['Equipment.active']=1;
        if(!$this->request->query('archived')){
            $conditions['EquipmentLogs.active']=1;
        }else{
            $conditions['EquipmentLogs.active']=0;
        }
        
        
        if(isset($this->request->query['date_filter'])){
            $days = (int) $this->request->query('date_filter');
            $conditions['EquipmentLogs.alert_date <='] = date('Y-m-d', strtotime("+ $days Days"));
            $this->request->data['date_filter'] = $days;
        }
        
        if($this->facility_id()){
            $conditions['Equipment.facility_id']=$this->facility_id();
        }else{
            $conditions[]='Equipment.facility_id IS NULL';
        }
        
               
        $this->paginate = [
            'contain' => $contain,
            'conditions'=>$conditions,
            'limit' => 30,
            'order' => [
                'Equipment.title'
            ]
        ];
        
        $equipmentLogs = $this->paginate($this->EquipmentLogs);
        $equipmentTypes = $this->EquipmentLogs->Equipment->EquipmentTypes->find('list', ['order' => 'title','conditions'=>['active'=>true]]);
        $departments = $this->EquipmentLogs->Equipment->Departments->find('list', ['order' => 'name','conditions'=>['active'=>true]]);

        $this->set(compact('equipmentLogs','equipmentTypes', 'departments'));
        
    }
    

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($equipment_id = null)
    {
        
        $equipment = $this->EquipmentLogs->Equipment->get($equipment_id, [
            'contain' => ['EquipmentTypes']
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
        
        $type = 'Note';
        
        $said_type = $this->request->query('type');
        if($said_type && in_array($said_type,['Service','Document','Reminder'])){
            $type = $said_type;
        }
        
        
        $equipmentLog = $this->EquipmentLogs->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['type'] = $type;
            $this->request->data['equipment_id'] = $equipment_id;
            $this->request->data['user_id'] = $this->Auth->user('id');
            if($this->request->data('last_service')){
                $this->request->data['date'] = $this->request->data('last_service');
            }
            
            $equipmentLog = $this->EquipmentLogs->patchEntity($equipmentLog, $this->request->data);
            
            if($this->request->data('last_service')){
                $equipmentLog->date = $this->request->data('last_service');
            }
            
            if ($this->EquipmentLogs->save($equipmentLog)) {
                if($this->request->data('last_service')){
                    $equipment->last_service = $this->request->data('last_service');
                    $equipmentLog->date = $this->request->data('last_service');
                    $equipment->next_service = $this->request->data('next_service') ? $this->request->data('next_service') : null;
                }
                
                if($this->request->data('usage_km')){
                    $equipment->usage_km = $this->request->data('usage_km');
                }
                
                if($this->request->data('usage_hours')){
                    $equipment->usage_hours = $this->request->data('usage_hours');
                }
                
                if($equipment->dirty()){
                    $this->EquipmentLogs->Equipment->save($equipment);
                }
                
                $this->Flash->success(__('The equipment log has been saved.'));

                return $this->redirect(['controller'=>'Equipment','action' => 'view',$equipment_id]);
            }
            $this->Flash->error(__('The equipment log could not be saved. Please, try again.'));
        }
        
        
        $this->set(compact('equipmentLog', 'equipment', 'type'));
        
        
        return $this->render(strtolower($type));
    }

    /**
     * Edit method
     *
     * @param string|null $id Equipment Log id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $equipmentLog = $this->EquipmentLogs->get($id, [
            'contain' => []
        ]);
        
        $equipment = $this->EquipmentLogs->Equipment->get($equipmentLog->equipment_id, [
            'contain' => ['EquipmentTypes']
        ]);
        
        $type = 'Note';
        
        $said_type = $equipmentLog->type;
        if($said_type && in_array($said_type,['Service','Document','Reminder'])){
            $type = $said_type;
        }
        
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
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $equipmentLog = $this->EquipmentLogs->patchEntity($equipmentLog, $this->request->data);
            if ($this->EquipmentLogs->save($equipmentLog)) {
                $this->Flash->success(__('The equipment log has been saved.'));
                
                if($this->request->data('last_service')){
                    $equipment->last_service = $this->request->data('last_service');
                    $equipmentLog->date = $this->request->data('last_service');
                    $equipment->next_service = $this->request->data('next_service') ? $this->request->data('next_service') : null;
                }
                
                if($this->request->data('usage_km')){
                    $equipment->usage_km = $this->request->data('usage_km');
                }
                
                if($this->request->data('usage_hours')){
                    $equipment->usage_hours = $this->request->data('usage_hours');
                }
                
                if($equipment->dirty()){
                    $this->EquipmentLogs->Equipment->save($equipment);
                }
                

                return $this->redirect(['controller'=>'Equipment','action' => 'view',$equipmentLog->equipment_id]);
            }
            $this->Flash->error(__('The equipment log could not be saved. Please, try again.'));
        }
        
        $this->set(compact('equipmentLog','equipment','type'));
        
        
        return $this->render(strtolower($type));
        
        
    }

    /**
     * Delete method
     *
     * @param string|null $id Equipment Log id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $equipmentLog = $this->EquipmentLogs->get($id,['contain'=>['Equipment'=>['fields'=>['id','user_id']]]]);
        
        
        $group = $this->Auth->user('group_id');
        //Not RO or better
        if(!$group || $group > 3){//Staff and below lock to own account
            //Check if in department
            $departments = $this->userDepartments();
            $depOK = isset($departments[$equipmentLog->equipment->department_id]);

            //If not owner reject
            if(!$depOK && $equipmentLog->equipment->user_id != $this->Auth->user('id')){
                 $this->Flash->error(__('You do not have access to this record.'));
                return $this->redirect($this->referer());
            }
        }
        
        $msg = 'archived';
        if($equipmentLog->active){
            $equipmentLog->active = 0;
        }else{
            $equipmentLog->active = 1;
            $msg = 'restored';
        }
        
        if ($this->EquipmentLogs->save($equipmentLog)) {
            $this->Flash->success(__('The equipment log has been '.$msg.'.'));
        } else {
            $this->Flash->error(__('The equipment log could not be '.$msg.'. Please, try again.'));
        }

        return $this->redirect($this->referer());
    }
}
