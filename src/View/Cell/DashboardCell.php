<?php
namespace App\View\Cell;

use Cake\View\Cell;
use Cake\Utility\Hash;

class DashboardCell extends Cell
{

    public function display($dashboardItem){
        
        $this->set('dashboardItem',$dashboardItem);
    }
    
    private function getMyDepartments(){
        $my_departments = $this->request->session()->read('Auth.User.departments');
        
        if(!empty($my_departments)){
            $my_departments = Hash::extract($my_departments, 
                '{n}.id');
            return $my_departments;
        }
        
        return [];
    }
    
    protected function getDepartmentSecurity(){
        
        $my_departments = $this->request->session()->read('Auth.User.leads');
        
        if(!empty($my_departments)){
            $my_departments = Hash::extract($my_departments, 
                '{n}.id');
            return $my_departments;
        }
        
        return [];
    }
    
    
    public function new_users($dashboardItem, $facility_id = null){
        $this->loadModel('Users');
        
        $conditions = ['Users.group_id'=>7,'Users.active'=>true];
        
        switch($dashboardItem->filter_type){
            case 'user1'://'Only Show My Records'
                
                break;
            case 'department1'://Only Show Departments that I manage
                $departments = $this->getDepartmentSecurity();
                break;
            case 'department2'://Only Show Departments that I am a membner of
                $departments = $this->getMyDepartments();
                break;
            case 'department3'://Filter a specific department
                $departments[] = (int) $dashboardItem->filter_value;
                break;
        }
        
        if(isset($departments) && !empty($departments)){
            $conditions[] = ['Users.id IN (select user_id from departments_users where department_id IN ('.implode(',',$departments).'))'];
        }
        
        
        $this->set('users',$this->Users->find('all',
            ['fields'=>['id','name','profile_url', 'created']
                ,'conditions'=>$conditions]
            ));
        $this->set('dashboardItem',$dashboardItem);
    }
    
    public function registers_stats($dashboardItem, $facility_id = null){
        $this->loadModel('Registers');
        $session = $this->request->session();
        $user = $session->read('Auth.User');
        
        
        $conditions = [
            'Registers.active' => 1,
            'Registers.status' => 'Registered',
            'YEAR(Registers.created) >= YEAR(NOW()) - 2'
            ];
        
        switch($dashboardItem->filter_type){
            case 'user1'://'Only Show My Records'
                $conditions[] = ['Registers.user_id'=>$this->request->session()->read('Auth.User.id')];
                break;
            case 'department1'://Only Show Departments that I manage
                $departments = $this->getDepartmentSecurity();
                break;
            case 'department2'://Only Show Departments that I am a membner of
                $departments = $this->getMyDepartments();
                break;
            case 'department3'://Filter a specific department
                $departments[] = (int) $dashboardItem->filter_value;
                break;
        }
        
        //TODO: Setup department view for staff
        $group = $user['group_id'];
        if(!$group || $group > 3){//4 	staff and below lock to own account
            $conditions['Registers.user_id'] = $user['id'];
        }
        
        if(isset($departments) && !empty($departments)){
            $conditions[] = ['Registers.department_id IN ('.implode(',',$departments).')'];
        }
        
        $registers = $this->Registers->find();
        
        $registers = $registers->select([
                'year'=>'YEAR(Registers.created)',
                'type'=>'RegisterTemplates.name',
                'count' => $registers->func()->count('*')])
                ->hydrate(false)
                ->contain(['RegisterTemplates'])
                ->where($conditions)
                ->order(['YEAR(Registers.created)'=>'desc'])
                ->group(['YEAR(Registers.created)',
                        'RegisterTemplates.name'])
                ->toArray();
        
        $this->set('data',$registers);
        $this->set('dashboardItem',$dashboardItem);
    }
    
    
    public function trips_stats($dashboardItem, $facility_id = null){
        $session = $this->request->session();
        $user = $session->read('Auth.User');
        
        $this->loadModel('Trips');
        
        $conditions = [
            'Trips.active' => 1,
            'Trips.status != "Cancelled"',
            'YEAR(Trips.start_date) >= YEAR(NOW()) - 6'
            ];
        
        switch($dashboardItem->filter_type){
            case 'user1'://'Only Show My Records'
                $conditions[] = ['Trips.user_id'=>$this->request->session()->read('Auth.User.id')];
                break;
            case 'department1'://Only Show Departments that I manage
                $departments = $this->getDepartmentSecurity();
                break;
            case 'department2'://Only Show Departments that I am a membner of
                $departments = $this->getMyDepartments();
                break;
            case 'department3'://Filter a specific department
                $departments[] = (int) $dashboardItem->filter_value;
                break;
        }
        
        //TODO: Setup department view for staff
        $group = $user['group_id'];
        if(!$group || $group > 3){//4 	staff and below lock to own account
            $conditions['Trips.user_id'] = $user['id'];
        }
        
        if(isset($departments) && !empty($departments)){
            $conditions[] = ['Trips.id IN (select trip_id from trip_types_trips ttt left join trip_types tt on tt.id = ttt.trip_type_id where tt.department_id IN ('.implode(',',$departments).'))'];
        }
        
        $trips = $this->Trips->find();
        
        $trips = $trips->select([
                'year'=>'YEAR(Trips.start_date)',
                'count' => $trips->func()->count('Trips.id')])
                ->hydrate(false)
                ->where($conditions)
                ->order(['YEAR(Trips.start_date)'=>'desc'])
                ->group(['YEAR(Trips.start_date)'])
                ->toArray();
        
        $this->set('data',$trips);
        $this->set('dashboardItem',$dashboardItem);
    }
    
    public function trip_type_stats($dashboardItem, $facility_id = null){
        $session = $this->request->session();
        $user = $session->read('Auth.User');
        
        $this->loadModel('Trips');
        
        $conditions = [
            'Trips.active' => 1,
            'Trips.status != "Cancelled"',
            'YEAR(Trips.start_date) >= YEAR(NOW()) - 2'
            ];
        
        switch($dashboardItem->filter_type){
            case 'user1'://'Only Show My Records'
                $conditions[] = ['Trips.user_id'=>$this->request->session()->read('Auth.User.id')];
                break;
            case 'department1'://Only Show Departments that I manage
                $departments = $this->getDepartmentSecurity();
                break;
            case 'department2'://Only Show Departments that I am a membner of
                $departments = $this->getMyDepartments();
                break;
            case 'department3'://Filter a specific department
                $departments[] = (int) $dashboardItem->filter_value;
                break;
        }
        
        //TODO: Setup department view for staff
        $group = $user['group_id'];
        if(!$group || $group > 3){//4 	staff and below lock to own account
            $conditions['Trips.user_id'] = $user['id'];
        }
        
        if(isset($departments) && !empty($departments)){
            $conditions[] = ['Trips.id IN (select trip_id from trip_types_trips ttt left join trip_types tt on tt.id = ttt.trip_type_id where tt.department_id IN ('.implode(',',$departments).'))'];
        }
        
        $trips = $this->Trips->find();
        
        $trips = $trips->select([
                'year'=>'YEAR(Trips.start_date)',
                'type'=>'TripTypes.title',
                'count' => $trips->func()->count('Trips.id')])
                ->hydrate(false)
                ->join([
                    'ttt' => [
                        'table' => 'trip_types_trips',
                        'type' => 'LEFT',
                        'conditions' => 'Trips.id = ttt.trip_id',
                    ],
                    'TripTypes' => [
                        'table' => 'trip_types',
                        'type' => 'INNER',
                        'conditions' => 'TripTypes.id = ttt.trip_type_id',
                    ]
                ])
                ->where($conditions)
                ->order(['YEAR(Trips.start_date)'=>'desc'])
                ->group(['YEAR(Trips.start_date)',
                        'TripTypes.title'])
                ->toArray();
        
        $this->set('data',$trips);
        $this->set('dashboardItem',$dashboardItem);
    }
    
    public function certifications($dashboardItem, $facility_id = null){
        $this->loadModel('Users');
        
        $conditions = ['Users.active'=>true];
        
        switch($dashboardItem->filter_type){
            case 'user1'://'Only Show My Records'
                $conditions[] = ['Users.id'=>$this->request->session()->read('Auth.User.id')];
                break;
            case 'department1'://Only Show Departments that I manage
                $departments = $this->getDepartmentSecurity();
                break;
            case 'department2'://Only Show Departments that I am a membner of
                $departments = $this->getMyDepartments();
                break;
            case 'department3'://Filter a specific department
                $departments[] = (int) $dashboardItem->filter_value;
                break;
        }
        
        if(isset($departments) && !empty($departments)){
            $conditions[] = ['Users.id IN (select user_id from departments_users where department_id IN ('.implode(',',$departments).'))'];
        }    
        
        $users = $this->Users->find()->where($conditions);
        $users->innerJoinWith('Certifications', function ($q) {
                return $q->where(['Certifications.valid' => 0,'Certifications.active' => 1]);
            })->select(
                    ['id','name','profile_url', 'created','count' => $users->func()->count('Certifications.id')]
                    )->distinct(['Users.id'])->all();
        /*'all',[
                'contain'=>['Certifications'],
                'fields'=>['id','name','profile_url', 'created'],
                'conditions'=>['active'=>true]]
            );*/
        
        $this->set('users',$users);
        $this->set('dashboardItem',$dashboardItem);
    }
    
    public function equipment_service($dashboardItem,$facility_id = null){
        $this->loadModel('Equipment');
        $session = $this->request->session();
        $user = $session->read('Auth.User');
        
        $conditions = [
            'Equipment.active' => 1,
            'Equipment.next_service IS NOT NULL',
            'Equipment.next_service <='=>  date("Y-m-d", strtotime("+2 months"))];
        
        if($facility_id){
            $conditions['Equipment.facility_id']=$facility_id;
        }else{
            $conditions[]='Equipment.facility_id IS NULL';
        }
        
        $group = $user['group_id'];
        //TODO: Setup department view for staff
        
        switch($dashboardItem->filter_type){
            case 'user1'://'Only Show My Records'
                $conditions[] = ['Equipment.user_id'=>$this->request->session()->read('Auth.User.id')];
                break;
            case 'department1'://Only Show Departments that I manage
                $departments = $this->getDepartmentSecurity();
                break;
            case 'department2'://Only Show Departments that I am a membner of
                $departments = $this->getMyDepartments();
                break;
            case 'department3'://Filter a specific department
                $departments[] = (int) $dashboardItem->filter_value;
                break;
            default:
                //Admins - show own and not user
                $conditions['OR'] = [
                    'Equipment.user_id' => $user['id'],
                    'Equipment.user_id IS NULL'
                        ];
        }
        
        if(!$group || $group > 3){//4 	staff and below lock to own account
            $conditions['Equipment.user_id'] = $user['id'];
            $userView = true;
        }
        
        if(isset($departments) && !empty($departments)){
            $conditions[] = ['Equipment.department_id IN ('.implode(',',$departments).')'];
        }
        
        $equipment = $this->Equipment->find('all',[
            'fields'=>['id','title','status','next_service'],
            'order'=>['next_service'=>'asc'],
            'conditions'=>$conditions,
            'limit'=>5
        ]);
        
        $this->set('equipment',$equipment);
        $this->set('dashboardItem',$dashboardItem);
    }
    
    
    public function registers_inprogress($dashboardItem, $facility_id = null){
        $this->loadModel('Registers');
        $session = $this->request->session();
        $user = $session->read('Auth.User');
        
        
        $conditions = [
            'Registers.active' => 1,
            'Registers.status' => 'In Progress'
            ];
        
        
        switch($dashboardItem->filter_type){
            case 'user1'://'Only Show My Records'
                $conditions[] = ['Registers.user_id'=>$this->request->session()->read('Auth.User.id')];
                break;
            case 'department1'://Only Show Departments that I manage
                $departments = $this->getDepartmentSecurity();
                break;
            case 'department2'://Only Show Departments that I am a membner of
                $departments = $this->getMyDepartments();
                break;
            case 'department3'://Filter a specific department
                $departments[] = (int) $dashboardItem->filter_value;
                break;
        }
        
        //TODO: Setup department view for staff
        $group = $user['group_id'];
        if(!$group || $group > 3){//4 	staff and below lock to own account
            $conditions['Registers.user_id'] = $user['id'];
        }
        
        if(isset($departments) && !empty($departments)){
            $conditions[] = ['Registers.department_id IN ('.implode(',',$departments).')'];
        }
        
        $registers = $this->Registers->find('all',[
            'fields'=>['Registers.id','Users.name','Registers.status','RegisterTemplates.name'],
            'order'=>['Registers.created'=>'desc'],
            'contain'=>['RegisterTemplates','Users'],
            'conditions'=>$conditions,
            'limit'=>10
        ]);
        
        $this->set('registers',$registers);
        $this->set('dashboardItem',$dashboardItem);
    }
    
    public function upcoming_trips($dashboardItem, $facility_id = null){
        $session = $this->request->session();
        $user = $session->read('Auth.User');
        
        $this->loadModel('Trips');
        
        $conditions = [
            'Trips.active' => 1,
            'Trips.status != "Cancelled"',
            'Trips.start_date between curdate() and DATE_ADD(CURDATE(),INTERVAL 2 WEEK)'
            ];
        
        switch($dashboardItem->filter_type){
            case 'user1'://'Only Show My Records'
                $conditions[] = ['Trips.user_id'=>$this->request->session()->read('Auth.User.id')];
                break;
            case 'department1'://Only Show Departments that I manage
                $departments = $this->getDepartmentSecurity();
                break;
            case 'department2'://Only Show Departments that I am a membner of
                $departments = $this->getMyDepartments();
                break;
            case 'department3'://Filter a specific department
                $departments[] = (int) $dashboardItem->filter_value;
                break;
        }
        
        //TODO: Setup department view for staff
        $group = $user['group_id'];
        if(!$group || $group > 3){//4 	staff and below lock to own account
            $conditions['Trips.user_id'] = $user['id'];
        }
        
        if(isset($departments) && !empty($departments)){
            $conditions[] = ['Trips.id IN (select trip_id from trip_types_trips ttt left join trip_types tt on tt.id = ttt.trip_type_id where tt.department_id IN ('.implode(',',$departments).'))'];
        }
        
        $trips = $this->Trips->find('all',[
            'fields'=>['Trips.id','Trips.title',
                'Trips.location','Users.name','Trips.status',
                'Trips.start_date','Trips.end_date',
                'Trips.supervisor_check'],
            'order'=>['Trips.start_date'=>'desc'],
            'contain'=>['TripTypes','Users'],
            'conditions'=>$conditions,
            'limit'=>10
        ]);
        
        $this->set('trips',$trips);
        $this->set('dashboardItem',$dashboardItem);
    }

    public function trips_pending_supervisor($dashboardItem, $facility_id = null){
        $session = $this->request->session();
        $user = $session->read('Auth.User');
        
        $this->loadModel('Trips');
        
        $conditions = [
            'Trips.active' => 1,
            'Trips.status = "Pending"',
            'Trips.supervisor_check is null'
            ];
        
        switch($dashboardItem->filter_type){
            case 'user1'://'Only Show My Records'
                $conditions[] = [
                    'OR'=>[
                        'Trips.supervisorid'=>$this->request->session()->read('Auth.User.id'),
                        'Trips.supervisor_email'=>$this->request->session()->read('Auth.User.email')
                    ]
                    ];
                break;
            case 'department1'://Only Show Departments that I manage
                $departments = $this->getDepartmentSecurity();
                break;
            case 'department2'://Only Show Departments that I am a membner of
                $departments = $this->getMyDepartments();
                break;
            case 'department3'://Filter a specific department
                $departments[] = (int) $dashboardItem->filter_value;
                break;
        }
        
        //TODO: Setup department view for staff
        $group = $user['group_id'];
        if(!$group || $group > 3){//4 	staff and below lock to own account
            $conditions['Trips.user_id'] = $user['id'];
        }
        
        if(isset($departments) && !empty($departments)){
            $conditions[] = ['Trips.id IN (select trip_id from trip_types_trips ttt left join trip_types tt on tt.id = ttt.trip_type_id where tt.department_id IN ('.implode(',',$departments).'))'];
        }
        
        $trips = $this->Trips->find('all',[
            'fields'=>['Trips.id','Trips.title',
                'Trips.location','Users.name','Trips.status',
                'Trips.start_date','Trips.end_date',
                'Trips.supervisor_check'],
            'order'=>['Trips.start_date'=>'desc'],
            'contain'=>['TripTypes','Users'],
            'conditions'=>$conditions,
            'limit'=>10
        ]);
        
        $this->set('trips',$trips);
        $this->set('dashboardItem',$dashboardItem);
    }

    public function trips_requires_action($dashboardItem, $facility_id = null){
        $session = $this->request->session();
        $user = $session->read('Auth.User');
        
        $this->loadModel('Trips');
        
        $conditions = [
            'Trips.active' => 1,
            'Trips.status = "Requires Action"'
            ];
        
        switch($dashboardItem->filter_type){
            case 'user1'://'Only Show My Records'
                $conditions[] = ['Trips.user_id'=>$this->request->session()->read('Auth.User.id')];
                break;
            case 'department1'://Only Show Departments that I manage
                $departments = $this->getDepartmentSecurity();
                break;
            case 'department2'://Only Show Departments that I am a membner of
                $departments = $this->getMyDepartments();
                break;
            case 'department3'://Filter a specific department
                $departments[] = (int) $dashboardItem->filter_value;
                break;
        }
        
        //TODO: Setup department view for staff
        $group = $user['group_id'];
        if(!$group || $group > 3){//4 	staff and below lock to own account
            $conditions['Trips.user_id'] = $user['id'];
        }
        
        if(isset($departments) && !empty($departments)){
            $conditions[] = ['Trips.id IN (select trip_id from trip_types_trips ttt left join trip_types tt on tt.id = ttt.trip_type_id where tt.department_id IN ('.implode(',',$departments).'))'];
        }
        
        $trips = $this->Trips->find('all',[
            'fields'=>['Trips.id','Trips.title',
                'Trips.location','Users.name','Trips.status',
                'Trips.start_date','Trips.end_date',
                'Trips.supervisor_check'],
            'order'=>['Trips.start_date'=>'desc'],
            'contain'=>['TripTypes','Users'],
            'conditions'=>$conditions,
            'limit'=>10
        ]);
        
        $this->set('trips',$trips);
        $this->set('dashboardItem',$dashboardItem);
    }
    
    public function trips_in_progress($dashboardItem, $facility_id = null){
        $session = $this->request->session();
        $user = $session->read('Auth.User');
        
        $this->loadModel('Trips');
        
        $conditions = [
            'Trips.active' => 1,
            'Trips.status != "Cancelled"',
            'Trips.start_date <= curdate()',
            'Trips.end_date >= curdate()'
            ];
        
        switch($dashboardItem->filter_type){
            case 'user1'://'Only Show My Records'
                $conditions[] = ['Trips.user_id'=>$this->request->session()->read('Auth.User.id')];
                break;
            case 'department1'://Only Show Departments that I manage
                $departments = $this->getDepartmentSecurity();
                break;
            case 'department2'://Only Show Departments that I am a membner of
                $departments = $this->getMyDepartments();
                break;
            case 'department3'://Filter a specific department
                $departments[] = (int) $dashboardItem->filter_value;
                break;
        }
        
        //TODO: Setup department view for staff
        $group = $user['group_id'];
        if(!$group || $group > 3){//4 	staff and below lock to own account
            $conditions['Trips.user_id'] = $user['id'];
        }
        
        if(isset($departments) && !empty($departments)){
            $conditions[] = ['Trips.id IN (select trip_id from trip_types_trips ttt left join trip_types tt on tt.id = ttt.trip_type_id where tt.department_id IN ('.implode(',',$departments).'))'];
        }
        
        $trips = $this->Trips->find('all',[
            'fields'=>['Trips.id','Trips.title',
                'Trips.location','Users.name','Trips.status',
                'Trips.start_date','Trips.end_date',
                'Trips.supervisor_check'],
            'order'=>['Trips.start_date'=>'desc'],
            'contain'=>['TripTypes','Users'],
            'conditions'=>$conditions,
            'limit'=>10
        ]);
        
        $this->set('trips',$trips);
        $this->set('dashboardItem',$dashboardItem);
    }
    
    public function pending_reservations($dashboardItem, $facility_id = null){
        $session = $this->request->session();
        $user = $session->read('Auth.User');
               
        $this->loadModel('EquipmentReservations');
        
        $conditions = [
            'EquipmentReservations.approved IS NULL',
            'OR'=>[
                    'EquipmentReservations.start >='=>date('Y-m-d'),
                    'EquipmentReservations.end >='=>date('Y-m-d')
                ]
            ];
        
        switch($dashboardItem->filter_type){
            case 'user1'://'Only Show My Records'
                $conditions[] = ['EquipmentReservations.user_id'=>$this->request->session()->read('Auth.User.id')];
                break;
            case 'department1'://Only Show Departments that I manage
                $departments = $this->getDepartmentSecurity();
                break;
            case 'department2'://Only Show Departments that I am a membner of
                $departments = $this->getMyDepartments();
                break;
            case 'department3'://Filter a specific department
                $departments[] = (int) $dashboardItem->filter_value;
                break;
        }
        
        $group = $user['group_id'];
        if(!$group || $group > 3){//4 	staff and below lock to own account
            $conditions['EquipmentReservations.user_id'] = $user['id'];
        }
        
        if(isset($departments) && !empty($departments)){
            $conditions[] = ['EquipmentReservations.user_id IN (select user_id from departments_users where department_id IN ('.implode(',',$departments).'))'];
        }
        
        if($facility_id){
            $conditions['Equipment.facility_id']=$facility_id;
        }else{
            $conditions[]='Equipment.facility_id IS NULL';
        }
        
        $equipment_reservations = $this->EquipmentReservations->find('all',[
            'fields'=>[
                'EquipmentReservations.id',
                'Equipment.title','Users.name',
                'EquipmentReservations.start',
                'EquipmentReservations.qty',
                'EquipmentTypes.title'],
            'order'=>['EquipmentReservations.start'=>'desc'],
            'contain'=>['Equipment.EquipmentTypes','Users'],
            'conditions'=>$conditions,
            'limit'=>10
        ]);
        
        $this->set('equipment_reservations',$equipment_reservations);
        $this->set('dashboardItem',$dashboardItem);
    }
    
    public function pending_trips($dashboardItem, $facility_id = null){
        $session = $this->request->session();
        $user = $session->read('Auth.User');
        
        $this->loadModel('Trips');
        
        $conditions = [
            'Trips.active' => 1,
            'Trips.status' => 'Pending'
            ];
        
        
        switch($dashboardItem->filter_type){
            case 'user1'://'Only Show My Records'
                $conditions[] = ['Trips.user_id'=>$this->request->session()->read('Auth.User.id')];
                break;
            case 'department1'://Only Show Departments that I manage
                $departments = $this->getDepartmentSecurity();
                break;
            case 'department2'://Only Show Departments that I am a membner of
                $departments = $this->getMyDepartments();
                break;
            case 'department3'://Filter a specific department
                $departments[] = (int) $dashboardItem->filter_value;
                break;
        }
        
        //TODO: Setup department view for staff
        $group = $user['group_id'];
        if(!$group || $group > 3){//4 	staff and below lock to own account
            $conditions['Trips.user_id'] = $user['id'];
        }
        
        if(isset($departments) && !empty($departments)){
            $conditions[] = ['Trips.id IN (select trip_id from trip_types_trips ttt left join trip_types tt on tt.id = ttt.trip_type_id where tt.department_id IN ('.implode(',',$departments).'))'];
        }
        
        $trips = $this->Trips->find('all',[
            'fields'=>[
                'Trips.id',
                'Trips.title',
                'Trips.location',
                'Users.name',
                'Trips.start_date',
                'Trips.end_date',
                'Trips.supervisor_check'
                ],
            'order'=>['Trips.start_date'=>'desc'],
            'contain'=>['TripTypes','Users'],
            'conditions'=>$conditions,
            'limit'=>10
        ]);
        
        $this->set('trips',$trips);
        $this->set('dashboardItem',$dashboardItem);
    }
    
    
    public function pending_bookings($dashboardItem, $facility_id = null){
        $session = $this->request->session();
        $user = $session->read('Auth.User');
        
        $this->loadModel('Bookings');
        
        $conditions = [
            'Bookings.active' => 1,
            'Bookings.status' => 'Pending Approval'
            ];
        
        if($facility_id){
            $conditions['Bookings.facility_id']=$facility_id;
        }else{
            $conditions[]='Bookings.facility_id IS NULL';
        }
        
        
        switch($dashboardItem->filter_type){
            case 'user1'://'Only Show My Records'
                $conditions[] = ['Bookings.user_id'=>$this->request->session()->read('Auth.User.id')];
                break;
            case 'department1'://Only Show Departments that I manage
                $departments = $this->getDepartmentSecurity();
                break;
            case 'department2'://Only Show Departments that I am a membner of
                $departments = $this->getMyDepartments();
                break;
            case 'department3'://Filter a specific department
                $departments[] = (int) $dashboardItem->filter_value;
                break;
        }
        
        
        $group = $user['group_id'];
        if(!$group || $group > 3){//4 	staff and below lock to own account
            $conditions['Bookings.user_id'] = $user['id'];
        }
        
        if(isset($departments) && !empty($departments)){
            $conditions[] = ['Bookings.user_id IN (select user_id from departments_users where department_id IN ('.implode(',',$departments).'))'];
        }
        
        $bookings = $this->Bookings->find('all',[
            'fields'=>['Bookings.id','Bookings.name','Bookings.start_date','Bookings.end_date','Bookings.supervisor_check'],
            'order'=>['Bookings.start_date'=>'desc'],
            'contain'=>['BookingTemplates','Users'],
            'conditions'=>$conditions,
            'limit'=>10
        ]);
        
        $this->set('bookings',$bookings);
        $this->set('dashboardItem',$dashboardItem);
    }

}