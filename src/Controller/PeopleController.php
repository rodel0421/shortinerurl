<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CertificationClasses Controller
 *
 * @property \App\Model\Table\CertificationClassesTable $CertificationClasses
 */
class PeopleController extends AppController
{

    var $uses = false;
    
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
        
        
        //User / Operator can list user accounts
        if (in_array($this->request->action, ['index'])) {
            if ($user['group_id'] <= 5) {
                return true;
            }
        }
        
        //Admins have all
        return parent::isAuthorized($user);
    }
    
    
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->loadModel('Users');
        $contain = [
            'Groups',
            'UserTypes',
            'Departments',
            'CertificationStatus'=>[
                'fields'=>['status','status_date','type']],
            'EquipmentStatus'=>[
                'fields'=>['status','status_date','type']],
            'RegisterStatus'=>[
                'fields'=>['status','status_date','type']],
            'Certifications.CertificationTypes'=>[
                'fields'=>['id','category','type','name']],
            'Certifications.CertificationTypes.CertificationClasses'=>[
                'fields'=>['id','name','icon']],
            'Certifications'=>[
                'fields'=>['id','status','user_id'],
                'conditions'=>['Certifications.active'=>true]],
            'Registers.RegisterClasses'=>[
                'fields'=>['id','title','icon']],
            'Registers.RegisterTemplates'=>[
                'fields'=>['id','name']],
            'Registers'=>[
                'fields'=>['id','cert_status','user_id','cert_status_date','register_template_id'],
                'conditions'=>[
                    'Registers.status'=>'Registered',
                    'Registers.active'=>true]]];
    	
    	$conditions = [];
    	
    	$alt = [];
        
    	$conditions = $this->buildConditions($this->Users,$alt);
        
        if(!$this->request->query('archived')){
            $conditions['Users.active']=1;
        }else{
            $conditions['Users.active']=0;
        }
        
        $group = $this->Auth->user('group_id');
        $userView = false;
        if(!$group || $group > 4){//4 	staff and above show filters
            $userView = true;
        }
        
        if($this->request->query('department_id')){
            $user_ids = $this->Users->DepartmentsUsers->find()
                    ->select('user_id')
                    ->contain([])
                    ->where(['department_id'=>$this->request->query('department_id')])
                    ->extract('user_id')->toArray();
            
            $this->request->data['department_id'] = $this->request->query('department_id');
            if(!empty($user_ids)){
                $conditions[]['Users.id IN'] = $user_ids;
            }else{
                $conditions[]['Users.id'] = 0;
            }
            
        }
        
        if($this->request->query('certification_class_id')){
            $user_ids = $this->Users->Certifications->find()
                    ->select('user_id')
                    ->contain(['CertificationTypes'])
                    ->where(['CertificationTypes.certification_class_id'=>$this->request->query('certification_class_id')])
                    ->extract('user_id')->toArray();
            
            $this->request->data['certification_class_id'] = $this->request->query('certification_class_id');
            if(count($user_ids) > 0){
                $conditions[]['Users.id IN']=$user_ids;
            }else{
                $conditions[]['Users.id']=0;//Return nothing
            }
        }
        
        if($this->request->query('register_template_id')){
            $registerClasses = $this->Users->Registers->RegisterClasses->find('list', 
                ['order' => 'title',
                 'conditions'=>['active'=>1,'register_template_id'=>$this->request->query('register_template_id')]])->toArray();
            
            $this->set(compact('registerClasses'));
            
            $this->request->data['register_template_id'] = $this->request->query('register_template_id');
            
            //Class set and in current template
            if($this->request->query('register_class_id') && isset($registerClasses[$this->request->query('register_class_id')])){
                $user_ids = $this->Users->Registers->find()
                    ->select('user_id')
                    ->where([
                        'register_class_id'=>$this->request->query('register_class_id'),
                        'status'=>'Registered',
                        'active'=>true
                            ])
                    ->extract('user_id')->toArray();
                $this->request->data['register_class_id'] = $this->request->query('register_class_id');
                if(count($user_ids) > 0){
                    $conditions['Users.id IN']=$user_ids;
                }else{
                    $conditions['Users.id']=0;//Return nothing
                }
            }else{
                $user_ids = $this->Users->Registers->find()
                    ->select('user_id')
                    ->where([
                        'register_template_id'=>$this->request->query('register_template_id'),
                        'status'=>'Registered',
                        'active'=>true
                            ])
                    ->extract('user_id')->toArray();
            
                if(count($user_ids) > 0){
                    $conditions['Users.id IN']=$user_ids;
                }else{
                    $conditions['Users.id']=0;//Return nothing
                }
            }
            
        }
        
        
        
        $this->paginate = [
            'contain' => $contain,
            'conditions'=>$conditions,
            'fields'=>['id','name','UserTypes.title','Groups.name','Groups.style','profile_url'],
            'limit' => 30,
            'order' => [
                'Users.name'
            ]
        ];
        
        
        $users = $this->paginate($this->Users);
        
        $groups = $this->Users->Groups->find('list');
        $departments = $this->Users->Departments->find('list', ['order' => 'name']);
        
        $this->loadModel('CertificationClasses');
        $certificationClasses = $this->CertificationClasses->find('list', 
            [
            'order' => 'name',
            'conditions'=>['active'=>true]]);
        
        
        $registerTemplates = $this->Users->Registers->RegisterTemplates->find('list', 
            ['order' => 'name','consitions'=>['active'=>1]]);
        
        $userTypes = $this->Users->UserTypes->find('list', ['order' => 'title'])->where(['active'=>true]);
        
        $this->set(compact('users','certificationClasses','registerTemplates','groups','departments','userView','userTypes'));
        $this->set('_serialize', ['users']);//Needed for TripsPersonnel and BookingPersonnel
    }

}
