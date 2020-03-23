<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\Routing\Router;
use Cake\Mailer\Email;

/**
 * EquipmentReservations Controller
 *
 * @property \App\Model\Table\EquipmentReservationsTable $EquipmentReservations
 */
class EquipmentReservationsController extends AppController
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
        if (in_array($this->request->action, ['update','week','export'])) {
            if ($user['group_id'] <= 2) {
                return true;
            }
        }
        
        if (in_array($this->request->action, ['index','view','edit','add','delete','addTrip','feed','calendar'])) {
            return true;
        }
        
        return parent::isAuthorized($user);
    }
    
    public function beforeFilter(\Cake\Event\Event $event){
         $this->Security->config('unlockedActions', ['update']);
         return parent::beforeFilter($event);
    }
    
    public function calendar(){
        $this->request->data = $this->request->query();
        $equipmentTypes = $this->EquipmentReservations->Equipment
                ->EquipmentTypes->find('list', 
                        ['order' => 'title','conditions'=>['active'=>true]]);
        $departments = $this->EquipmentReservations->Equipment->Departments->find('list', ['order' => 'name','conditions'=>['active'=>true]]);
        $this->set(compact('equipmentTypes','departments'));
        
    }
    
    private function sendReminder($id){
        
        $equipmentReservation = $this->EquipmentReservations->get($id, [
            'contain' => [
                'Equipment'=>[
                        'fields'=>['title'],
                        'EquipmentTypes'=>['fields'=>['title']]
                        ]
                    ,'Users'=>[
                        'fields'=>['id','given_name','email']
                    ]],
        ]);
        
        $afterEnd = ($equipmentReservation->end->format('Y-m-d H:i') < date('Y-m-d H:i'));
        
        
        $setting = $this->siteSettings();
        $client_name = ($setting) ? $setting->name:'';
        $app_logo_text = ($setting && $setting->short)?$setting->short:'DDMS';
        
        $siteLink = Router::url('/', true);
        $privacyLink = $this->privacyLink();
        $loginLink = Router::url('/', true).'users/login';

        if($afterEnd && !$equipmentReservation->returned && $equipmentReservation->has('user')){
            $email = new Email();
            $email->template('equipment_overdue', 'styled')
                ->emailFormat('html')
                ->viewVars(compact('equipmentReservation','siteLink','privacyLink','loginLink','client_name','app_logo_text'))
                ->to($equipmentReservation->user->email)
                ->subject($app_logo_text.' - Equipment Overdue!')
                ->send();
            return true;
        }
        
        return false;
    }
    
    public function week(){
        $date = isset($this->request->query['date'])? date('Y-m-d',strtotime($this->request->query['date'])):date('Y-m-d');
        $datetime = strtotime($date);
        $day = date('w',$datetime);
        $start = date('Y-m-d', strtotime('-'.$day.' days',$datetime));
        $end = date('Y-m-d', strtotime('+'.(6-$day).' days',$datetime));
        
        $conditions = [];
        if($this->facility_id()){
            $conditions['Equipment.facility_id']=$this->facility_id();
        }else{
            $conditions[]='Equipment.facility_id IS NULL';
        }
        
        $query = $this->EquipmentReservations->find();
        $query->contain(['Equipment','Users']);
        $query->where(function ($exp) use ($start, $end) {
                return $exp->between('start', $start, $end);
            })
        ->where($conditions);

        $events = $query->toArray();
  
        $this->set(compact('date','start','end','events','datetime'));
        
    }
    
    public function feed(){
        $start = isset($this->request->query['start'])? date('Y-m-d',strtotime($this->request->query['start'])):'';
        $end = isset($this->request->query['end'])? date('Y-m-d',strtotime($this->request->query['end'])):'';
        $state = isset($this->request->query['state'])? $this->request->query['state']:'';
        
        $alt = [
            'Users.name'=>'Users.name','Equipment.title'=>'Equipment.title',
            'Equipment.equipment_type_id'=>['type'=>'integer'],
            'Equipment.department_id'=>['type'=>'integer']
            ];
        $conditions = $this->buildConditions($this->EquipmentReservations,$alt);
        
        if($this->facility_id()){
            $conditions['Equipment.facility_id']=$this->facility_id();
        }else{
            $conditions[]='Equipment.facility_id IS NULL';
        }
        
        $query = $this->EquipmentReservations->find();
        $query->contain(['Equipment','Users']);
        $query->select([
            'id',
            'title'=>'Equipment.title', 
            'start', 
            'end', 
            'qty',
            'allDay'=>'all_day',
            'approved']);
        
        $query->where(function ($exp) use ($start, $end) {
                return $exp->between('start', $start, $end);
            })
        ->orWhere(function ($exp) use ($start, $end) {
                return $exp->between('end', $start, $end);
            })
        ->orWhere(['AND'=> ['start <='=> $start, 'end >=' => $end]])
        ->where($conditions);
        $events = $query->toArray();

        $this->set('events', $events);
    }
    
    public function update(){
        $status = 'ERR';
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            try{
                $id = key($this->request->data);
                $equipmentReservation = $this->EquipmentReservations->get($id, ['contain' => []]);
                
                if(isset($this->request->data[$id]['approved']) && $this->request->data[$id]['approved'] == ''){
                    $this->request->data[$id]['approved'] = null;
                }
                
                
                $equipmentReservation = $this->EquipmentReservations->patchEntity($equipmentReservation, $this->request->data[$id]);
                if ($this->EquipmentReservations->save($equipmentReservation)) {
                    $status = 'OK';
                    $this->clearNewReservation($id);
                }
            }catch(Cake\Datasource\Exception\RecordNotFoundException $e){
                
            }
        }
        $this->set('status', $status);
    }
    
    private function notifyNewReservation($id){
        $equipmentReservation = $this->EquipmentReservations->get($id, [
            'contain' => ['Equipment'],
            'fields'=>['EquipmentReservations.id','Equipment.department_id','Equipment.title']
        ]);
                
        if($equipmentReservation->equipment->department_id){
            $this->loadModel('Alerts');
            $connection = ConnectionManager::get('default');
            $users = $connection->execute(
                    'SELECT DISTINCT user_id FROM departments_leaders WHERE department_id = :id'
                    , ['id' => $equipmentReservation->equipment->department_id])->fetchAll('assoc');
            
            $title = 'New Equipment Reservation: '.h($equipmentReservation->equipment->title);
            foreach($users as $user){
                $this->Alerts->create($title, 'New', 'EquipmentReservations', $equipmentReservation->id,$user['user_id']);
            }
        }
    }
    
    private function clearNewReservation($id){
        $this->loadModel('Alerts');
        $this->Alerts->clear('New', 'EquipmentReservations', $id);
    }
    
    
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $contain = [
            'Trips'=>['fields'=>['status']],
            'Equipment'=>['EquipmentTypes','Departments'], 
            'Users'];
    	
    	$conditions = array();
        $userView = false;
    	
    	$alt = [
            'Users.name'=>'Users.name',
            'Equipment.title'=>'Equipment.title',
            'Equipment.equipment_type_id'=>['type'=>'integer'],
            'Equipment.department_id'=>['type'=>'integer']
            ];
        
    	$conditions = $this->buildConditions($this->EquipmentReservations,$alt);
        
        $group = $this->Auth->user('group_id');
        if(!$group || $group > 3){//4 	staff and below lock to own account
            $conditions['user_id'] = $this->Auth->user('id');
            $userView = true;
        }
        
        if($this->facility_id()){
            $conditions['Equipment.facility_id']=$this->facility_id();
        }else{
            $conditions[]='Equipment.facility_id IS NULL';
        }
        
        if($this->request->query('archived')){
            $conditions[]= [
                'OR'=>[
                    'EquipmentReservations.start <='=>date('Y-m-d'),
                    'EquipmentReservations.end <='=>date('Y-m-d')
                ]];
        }else{
            $conditions[]= [
                'OR'=>[
                    'EquipmentReservations.start >='=>date('Y-m-d'),
                    'EquipmentReservations.end >='=>date('Y-m-d')
                ]];
        }
        
        
        $this->paginate = [
            'contain' => $contain,
            'conditions'=>$conditions,
            'limit' => 30,
            'order' => [
                'EquipmentReservations.start'=>'ASC'
            ]
        ];
        
        $equipmentTypes = $this->EquipmentReservations->Equipment->EquipmentTypes->find('list', ['order' => 'title','conditions'=>['active'=>true]]);
        $departments = $this->EquipmentReservations->Equipment->Departments->find('list', ['order' => 'name','conditions'=>['active'=>true]]);
        
        $equipmentReservations = $this->paginate($this->EquipmentReservations);
        $this->set('status_classes', \App\Model\Table\TripsTable::STATUS_CLASSES);
        $this->set(compact('equipmentReservations','equipmentTypes','departments'));
    }
    
    
    
    public function export()
    {
        $contain = [
            'Trips'=>['fields'=>['id','status']],
            'Equipment'=>[
                'fields'=>['id','title'],
                'EquipmentTypes'=>['fields'=>['id','title']],
                'Departments'=>['fields'=>['id','name']]
                ], 
            'Users'=>['fields'=>['id','name']]];
    	
    	$conditions = array();
        $userView = false;
    	
    	$alt = [
            'Users.name'=>'Users.name',
            'Equipment.title'=>'Equipment.title',
            'Equipment.equipment_type_id'=>['type'=>'integer'],
            'Equipment.department_id'=>['type'=>'integer']
            ];
        
    	$conditions = $this->buildConditions($this->EquipmentReservations,$alt);
        
        $group = $this->Auth->user('group_id');
        if(!$group || $group > 3){//4 	staff and below lock to own account
            $conditions['user_id'] = $this->Auth->user('id');
            $userView = true;
        }
        
        if($this->facility_id()){
            $conditions['Equipment.facility_id']=$this->facility_id();
        }else{
            $conditions[]='Equipment.facility_id IS NULL';
        }
        
        if($this->request->query('archived')){
            $conditions[]= [
                'OR'=>[
                    'EquipmentReservations.start <='=>date('Y-m-d'),
                    'EquipmentReservations.end <='=>date('Y-m-d')
                ]];
        }else{
            $conditions[]= [
                'OR'=>[
                    'EquipmentReservations.start >='=>date('Y-m-d'),
                    'EquipmentReservations.end >='=>date('Y-m-d')
                ]];
        }
        
        
        $this->paginate = [
            'contain' => $contain,
            'conditions'=>$conditions,
            'limit' => 10000,
            'order' => [
                'EquipmentReservations.start'=>'ASC'
            ]
        ];
        $equipmentReservations = $this->paginate($this->EquipmentReservations);
        
        $_header = [
            'ID','Start', 'End', 
            'Trip','Type',
            'Department',
            'Equipment','Qty',
            'User','Approved','Returned',
            'Created'
            ];
        $_extract = [
            'id','start', 'end', 
            'trip.id',
            'equipment.equipment_type.title',
            'equipment.department.name',
            'equipment.title',
            'qty',
            'user.name','approved','returned',
            'created'
        ];
        $_bom = true;
        $_serialize = ['equipmentReservations'];
        
        $this->response = $this->response->withDownload('Equipment_Reservations.csv');
        $this->viewBuilder()->className('CsvView.Csv');
        $this->set(compact('equipmentReservations', '_serialize','_extract','_header','_bom'));
    
    }

    /**
     * View method
     *
     * @param string|null $id Equipment Reservation id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $equipmentReservation = $this->EquipmentReservations->get($id, [
            'contain' => ['Equipment', 'Users']
        ]);
        
        $isOwner = $this->isOwner($equipmentReservation->user_id);
        
        $updateReservation = $this->EquipmentReservations->get($id, [
            'contain' => []
        ]);
        
        if($this->request->getQuery('sendOverdue') && ($this->isAdmin() || $this->isOfficer())){
            if($this->sendReminder($equipmentReservation->id)){
                $this->Flash->success(__('The equipment reservation reminder has been sent.'));
            }else{
                $this->Flash->error(__('No equipment overdue for user.'));
            }
            $referer = ($this->request->query('back'))?$this->request->query('back'): $this->referer();
            return $this->redirect($referer);
        }
        
        
        if (($isOwner || $this->isAdmin() || $this->isOfficer()) && $this->request->is(['patch', 'post', 'put'])) {
            $updateReservation = $this->EquipmentReservations->patchEntity($updateReservation, $this->request->data);
            if ($this->EquipmentReservations->save($updateReservation)) {
                $this->Flash->success(__('The equipment reservation has been saved.'));
                if($updateReservation->type == 'Trip'){
                    return $this->redirect(['controller'=>'Trips','action' => 'view',$updateReservation->tableid,'#'=>'EquipmentHire']);
                }else{
                    return $this->redirect(['controller'=>'Users','action' => 'view',$updateReservation->user_id,'#'=>'EquipmentHire']);
                }
                
            }
            $this->Flash->error(__('The equipment reservation could not be saved. Please, try again.'));
        }
        
        
        $referer = ($this->request->query('back'))?$this->request->query('back'): $this->referer();
        
        if($referer == '/'){ 
            if($equipmentReservation->type == 'Trip'){
                $referer = \Cake\Routing\Router::url(['controller'=>'Trips','action' => 'view',$equipmentReservation->tableid,'#'=>'EquipmentHire'],true);
            }else{
                $referer = \Cake\Routing\Router::url(['controller'=>'Users','action' => 'view',$equipmentReservation->user_id,'#'=>'EquipmentHire'],true);
            }
        }
        
        $this->set('referer',$referer);

        $this->set( compact('equipmentReservation', 'updateReservation','isOwner'));
        
    }
    
    public function addTrip($id)
    {
        $trip = $this->EquipmentReservations->Trips->get($id, [
            'contain' => [],
            'fields'=>['id','user_id','start_date','end_date']
        ]);
        
        $equipment_type_id = $this->request->query('Equipment.equipment_type_id');
        $equipment_type = $this->EquipmentReservations
                ->Equipment
                ->EquipmentTypes->find('all')
                ->select(['id','title','hourly_booking','auto_approval'])
                ->where(['id'=>$equipment_type_id])
                ->first();
        
        $start_date = isset($this->request->query['start_date'])? date('Y-m-d',strtotime($this->request->query['start_date'])):$trip->start_date->format('Y-m-d');
        $start = $start_date;
        $start_time = $this->request->query('start_time');
        if($start_time) {
            $this->request->data['start_time'] = $start_time;
            $start = date('Y-m-d H:i:s', strtotime($start_date) + ($start_time * 60 * 60) );
        }
        
        $end_date = isset($this->request->query['end_date'])? date('Y-m-d',strtotime($this->request->query['end_date'])):$trip->end_date->format('Y-m-d');
        $end = $end_date;
        $end_time = $this->request->query('end_time');
        if($end_time){
            $this->request->data['end_time'] = $end_time;
            $end = date('Y-m-d H:i:s', strtotime($end_date) + ($end_time * 60 * 60) );
        }
        
        //TODO: Update to all trip personnel can view
        $group = $this->Auth->user('group_id');
        $user_id = $this->Auth->user('id');
        if((!$group || $group > 3) && $trip->user_id != $user_id){//4 staff and below lock to own account
            $this->Flash->error(__('You do not have access to this record.'));
            return $this->redirect($this->referer());
        }
        
        $equipmentReservation = $this->EquipmentReservations->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['type'] = 'Trip';
            $this->request->data['table'] = 'Trips';
            $this->request->data['tableid'] = $id;
            $this->request->data['start'] = $start;
            $this->request->data['end'] = $end;
            $this->request->data['all_day'] = !($start_time && $end_time);
            $this->request->data['user_id'] = $trip->user_id;
            
            //Approved
            if($equipment_type && $equipment_type->auto_approval){
                $this->request->data['approved'] = true;
            }
            
            $equipmentReservation = $this->EquipmentReservations->patchEntity($equipmentReservation, $this->request->data);
            
            if($equipment_type->hourly_booking){
                if(!$start_time){
                    $equipmentReservation->setError('start_time','Required');
                }
                if(!$end_time){
                    $equipmentReservation->setError('start_time','Required');
                }
            }
            
            if ($this->EquipmentReservations->save($equipmentReservation)) {
                $this->Flash->success(__('The equipment reservation has been saved.'));

                return $this->redirect(['controller'=>'Trips','action' => 'view',$id,'#'=>'EquipmentHire']);
            }
            $this->Flash->error(__('The equipment reservation could not be saved. Please, try again.'));
        }
        
        //Makesure dates are current
        $this->loadModel('Dates');
        $result = $this->Dates->setupDates();
        
        
        $contain = ['EquipmentTypes', 'Departments'];
    	
    	$conditions = array();
        $userView = false;
    	
    	$alt = [];
        
    	$conditions = $this->buildConditions($this->EquipmentReservations->Equipment,$alt);
        $subqueryconditions = '';
        
        if($this->facility_id()){
            $conditions['Equipment.facility_id']=$this->facility_id();
            $subqueryconditions = 'facility_id = '.$this->facility_id();
        }else{
            $conditions[]='Equipment.facility_id IS NULL';
            $subqueryconditions = 'facility_id IS NULL';
        }
        
        $conditions['Equipment.active']=1;
        $conditions['Equipment.for_hire']=1;
        
        $this->paginate = [
            'Equipment'=>[
                'contain' => $contain,
                'conditions'=>$conditions,
                'limit' => 10,
                'order' => [
                    'Equipment.title'
                ]
            ]
        ];
        
        $times = [//Allowed times for bookings TODO: Move this to a config
            7 => '7:00am',
            8 => '8:00am',
            9 => '9:00am',
            10 => '10:00am',
            11 => '11:00am',
            12 => '12:00pm',
            13 => '1:00pm',
            14 => '2:00pm',
            15 => '3:00pm',
            16 => '4:00pm',
            17 => '5:00pm',
            18 => '6:00pm',
            19 => '7:00pm',
        ];
        
        if($equipment_type && 
                (!$equipment_type->hourly_booking || ($start_time && $end_time))){
            $equipment = $this->paginate($this->EquipmentReservations->Equipment->find());
            //Get IDs
            $equipment_ids = \Cake\Utility\Hash::extract($equipment->toArray(),'{n}.id');

            if($start_time && $end_time){
                $avaiability = $this->EquipmentReservations->avaiability_time($equipment_ids,$start_date,$end_date,$start_time,$end_time);
            }else{
                $avaiability = $this->EquipmentReservations->avaiability($equipment_ids,$start_date,$end_date);
            }
            $departments = $this->EquipmentReservations->Equipment->Departments->find('list', 
                    ['order' => 'name',
                    'conditions'=>[
                        'active'=>true,
                        'id in (select department_id from equipment where for_hire=1 and active=1 and '.$subqueryconditions.' group by department_id)'
                        ]
                        ]);
        }
        
        $equipmentTypes = $this->EquipmentReservations->Equipment->EquipmentTypes->find('list', 
                ['order' => 'title',
                    'conditions'=>['active'=>true,'id in (select equipment_type_id from equipment where for_hire=1 and active=1 and '.$subqueryconditions.' group by equipment_type_id)']
                ]);
        
           
        $this->set(compact(
                'equipmentReservation',
                'equipment',
                'departments',
                'equipmentTypes',
                'trip',
                'avaiability',
                'start_date','end_date',
                'equipment_type','times',
                'start','end'));
        
    }
   

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        
        if(!isset($id)){
            $id = $this->Auth->user('id');
        }
        
        $user = $this->EquipmentReservations->Users->get($id, [
            'contain' => [],
            'fields'=>['id','name']
        ]);
        
        $equipment_type_id = $this->request->query('Equipment.equipment_type_id');
        $equipment_type = $this->EquipmentReservations
                ->Equipment
                ->EquipmentTypes->find('all')
                ->select(['id','title','hourly_booking','auto_approval'])
                ->where(['id'=>$equipment_type_id])
                ->first();
        
        
        $start_date = isset($this->request->query['start_date'])? date('Y-m-d',strtotime($this->request->query['start_date'])):date('Y-m-d', strtotime("+3 days"));
        $start = $start_date;
        $start_time = $this->request->query('start_time');
        if($start_time) {
            $this->request->data['start_time'] = $start_time;
            $start = date('Y-m-d H:i:s', strtotime($start_date) + ($start_time * 60 * 60) );
        }
        $end_date = isset($this->request->query['end_date'])? date('Y-m-d',strtotime($this->request->query['end_date'])):date('Y-m-d', strtotime("+10 days"));
        $end = $end_date;
        $end_time = $this->request->query('end_time');
        if($end_time){
            $this->request->data['end_time'] = $end_time;
            $end = date('Y-m-d H:i:s', strtotime($end_date) + ($end_time * 60 * 60) );
        }
                
        $group = $this->Auth->user('group_id');
        $user_id = $this->Auth->user('id');
        if((!$group || $group > 3) && $id != $user_id){//4 staff and below lock to own account
            $this->Flash->error(__('You do not have access to this record.'));
            return $this->redirect($this->referer());
        }
        
        $equipmentReservation = $this->EquipmentReservations->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['type'] = 'User';  
            $this->request->data['start'] = $start;
            $this->request->data['end'] = $end;
            $this->request->data['all_day'] = !($start_time && $end_time);
            $this->request->data['user_id'] = $user->id;
            $this->request->data['tableid'] = $user->id;
            
            //Approved
            if($equipment_type && $equipment_type->auto_approval){
                $this->request->data['approved'] = true;
            }
            
            $equipmentReservation = $this->EquipmentReservations->patchEntity($equipmentReservation, $this->request->data);
            
            if($equipment_type->hourly_booking){
                if(!$start_time){
                    $equipmentReservation->setError('start_time','Required');
                }
                if(!$end_time){
                    $equipmentReservation->setError('start_time','Required');
                }
            }
            
            if ($this->EquipmentReservations->save($equipmentReservation)) {
                if(!$equipmentReservation->approved){
                    $this->notifyNewReservation($equipmentReservation->id);//Only create for ones that need approval
                }
                
                $this->Flash->success(__('The equipment reservation has been saved.'));
                $this->Cookie->write('Box.EquipmentHire', false);//Show box
                return $this->redirect(['controller'=>'Users','action' => 'view',$user->id,'#'=>'EquipmentHire']);
            }
            $this->Flash->error(__('The equipment reservation could not be saved. Please, try again.'));
        }
        
        //Makesure dates are current
        $this->loadModel('Dates');
        $result = $this->Dates->setupDates();
        
        
        $contain = ['EquipmentTypes', 'Departments'];
    	
    	$conditions = array();
        $userView = false;
    	
    	$alt = [];
        
    	$conditions = $this->buildConditions($this->EquipmentReservations->Equipment,$alt);
        $subqueryconditions = '';
        
        if($this->facility_id()){
            $conditions['Equipment.facility_id']=$this->facility_id();
            $subqueryconditions = 'facility_id = '.$this->facility_id();
        }else{
            $conditions[]='Equipment.facility_id IS NULL';
            $subqueryconditions = 'facility_id IS NULL';
        }
        
        $conditions['Equipment.active']=1;
        $conditions['Equipment.for_hire']=1;
        
        $this->paginate = [
            'Equipment'=>[
                'contain' => $contain,
                'conditions'=>$conditions,
                'limit' => 10,
                'order' => [
                    'Equipment.title'
                ]
            ]
        ];
        
        $times = [//Allowed times for bookings TODO: Move this to a config
            7 => '7:00am',
            8 => '8:00am',
            9 => '9:00am',
            10 => '10:00am',
            11 => '11:00am',
            12 => '12:00pm',
            13 => '1:00pm',
            14 => '2:00pm',
            15 => '3:00pm',
            16 => '4:00pm',
            17 => '5:00pm',
            18 => '6:00pm',
            19 => '7:00pm',
        ];
        
        
        if($equipment_type && 
                (!$equipment_type->hourly_booking || ($start_time && $end_time))){
            $equipment = $this->paginate($this->EquipmentReservations->Equipment->find());
            //Get IDs
            $equipment_ids = \Cake\Utility\Hash::extract($equipment->toArray(),'{n}.id');

            if($start_time && $end_time){
                $avaiability = $this->EquipmentReservations->avaiability_time($equipment_ids,$start_date,$end_date,$start_time,$end_time);
            }else{
                $avaiability = $this->EquipmentReservations->avaiability($equipment_ids,$start_date,$end_date);
            }
            $departments = $this->EquipmentReservations->Equipment->Departments->find('list', 
                    ['order' => 'name',
                    'conditions'=>[
                        'active'=>true,
                        'id in (select department_id from equipment where for_hire=1 and active=1 and '.$subqueryconditions.' group by department_id)'
                        ]
                        ]);
        }
        
        $equipmentTypes = $this->EquipmentReservations->Equipment->EquipmentTypes->find('list', 
                ['order' => 'title',
                    'conditions'=>['active'=>true,'id in (select equipment_type_id from equipment where for_hire=1 and active=1 and '.$subqueryconditions.' group by equipment_type_id)']
                ]);
        
        $this->set(compact(
                'equipmentReservation','equipment',
                'equipmentTypes','user','avaiability',
                'start_date','end_date',
                'start','end',
                'departments','equipment_type','times'));
        
    }

    /**
     * Edit method
     *
     * @param string|null $id Equipment Reservation id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $equipmentReservation = $this->EquipmentReservations->get($id, [
            'contain' => ['Trips','Equipment']
        ]);
        
        $editEquipmentReservation = $this->EquipmentReservations->get($id, [
            'contain' => []
        ]);
        
        $isOwner = $this->isOwner($equipmentReservation->user_id);
        
        if(!($isOwner || $this->isAdmin() || $this->isOfficer())){
            $this->Flash->error(__('You do not have access to this record.'));
            return $this->redirect($this->referer());
        }
        
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $start_date = $this->request->data('start_date');
            $end_date = $this->request->data('end_date');
            
            if(!$equipmentReservation->all_day){
                $start_time = $this->request->data('start_time');
                $end_time = $this->request->data('end_time');
                
                $start = date('Y-m-d H:i:s', strtotime($start_date) + ($start_time * 60 * 60) );
                $prev_start = $equipmentReservation->start->format('Y-m-d H:i:s');
                $end = date('Y-m-d H:i:s', strtotime($end_date) + ($end_time * 60 * 60) );
                $prev_end = $equipmentReservation->end->format('Y-m-d H:i:s');
            }else{
                $start = $start_date;
                $prev_start = $equipmentReservation->start->format('Y-m-d');
                $end = $end_date;
                $prev_end = $equipmentReservation->end->format('Y-m-d');
                
            }
            
            $this->request->data['start'] = $start;
            $this->request->data['end'] = $end;
            
            $editEquipmentReservation = $this->EquipmentReservations->patchEntity($editEquipmentReservation, $this->request->data);
            if($start < $prev_start){
                $editEquipmentReservation->setError('start_date','Cannot change to earlier.');
            }
            if($end > $prev_end){
                $editEquipmentReservation->setError('end_date','Cannot change to later.');
            }
            
            if ($this->EquipmentReservations->save($editEquipmentReservation)) {
                $this->Flash->success(__('The equipment reservation has been saved.'));
                
                if($this->request->query('back')) return $this->redirect($this->request->query('back'));
                
                if($equipmentReservation->type == 'Trip'){
                    return $this->redirect(['controller'=>'Trips','action' => 'view',$equipmentReservation->tableid,'#'=>'EquipmentHire']);
                }else{
                    return $this->redirect(['controller'=>'Users','action' => 'view',$equipmentReservation->user_id,'#'=>'EquipmentHire']);
                }
                
            }
            $this->Flash->error(__('The equipment reservation could not be saved. Please, try again.'));
        }else{
            $start_date = $equipmentReservation->start->i18nFormat('yyyy-MM-dd');
            $end_date = $equipmentReservation->end->i18nFormat('yyyy-MM-dd');
        }
                
        if($equipmentReservation->all_day){
            $avaiability = $this->EquipmentReservations->avaiability([$equipmentReservation->equipment_id],$start_date,$end_date);
        }else{
            $start_time = (int) $equipmentReservation->start->format('H');
            $end_time = (int) $equipmentReservation->end->format('H');
            $avaiability = $this->EquipmentReservations->avaiability_time([$equipmentReservation->equipment_id],$start_date,$end_date,$start_time,$end_time);
            $this->set(compact('start_time','end_time'));
        }
        
        $times = [//Allowed times for bookings TODO: Move this to a config
            7 => '7:00am',
            8 => '8:00am',
            9 => '9:00am',
            10 => '10:00am',
            11 => '11:00am',
            12 => '12:00pm',
            13 => '1:00pm',
            14 => '2:00pm',
            15 => '3:00pm',
            16 => '4:00pm',
            17 => '5:00pm',
            18 => '6:00pm',
            19 => '7:00pm',
        ];
        
        $this->set(compact('editEquipmentReservation','equipmentReservation','avaiability','times','start_date','end_date'));
        
    }

    /**
     * Delete method
     *
     * @param string|null $id Equipment Reservation id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $equipmentReservation = $this->EquipmentReservations->get($id);
        
        $isOwner = $this->isOwner($equipmentReservation->user_id);
        
        if(!($isOwner || $this->isAdmin() || $this->isOfficer())){
            $this->Flash->error(__('You do not have access to this record.'));
            return $this->redirect($this->referer());
        }        
        
        //Cannot delete once past start time
        if($this->isAdmin() || $this->isOfficer() ||  $equipmentReservation->start->format('Y-m-d H:i') > date('Y-m-d H:i')){
            if ($this->EquipmentReservations->delete($equipmentReservation)) {
                $this->clearNewReservation($id);
                $this->Flash->success(__('The equipment reservation has been deleted.'));
            } else {
                $this->Flash->error(__('The equipment reservation could not be deleted. Please, try again.'));
            }
        }else{
            $this->Flash->error(__('The equipment reservation could not be deleted because it is now past the start date.'));
        }
        
        if($this->request->query('back')) return $this->redirect($this->request->query('back'));
        
        if($equipmentReservation->type == 'Trip'){
            return $this->redirect(['controller'=>'Trips','action' => 'view',$equipmentReservation->tableid,'#'=>'EquipmentHire']);
        }elseif($equipmentReservation->type == 'User'){
            return $this->redirect(['controller'=>'Users','action' => 'view',$equipmentReservation->user_id,'#'=>'EquipmentHire']);
        }

        return $this->redirect('/');
    }
}
