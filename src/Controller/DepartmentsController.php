<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Departments Controller
 *
 * @property \App\Model\Table\DepartmentsTable $Departments
 */
class DepartmentsController extends AppController
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
        
        
        //Read Only can list user accounts
        if (in_array($this->request->action, ['index','view'])) {
            if ($user['group_id'] <= 3) {
                return true;
            }
        }
        
        //managers can add / edit
        if (in_array($this->request->action, ['add','edit'])) {
            if ($user['group_id'] <= 2) {
                return true;
            }
        }
        
        //super admins can delete
        if (in_array($this->request->action, ['delete'])) {
            if ($user['group_id'] == 1) {
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
        $contain = [];
    	
    	$conditions = array();
    	
    	$alt = [];
    	
    	$conditions = $this->buildConditions($this->Departments,$alt);
    	if(!$this->request->query('archived')){
            $conditions['Departments.active']=1;
        }else{
            $conditions['Departments.active']=0;
        }
        
        $this->paginate = [
            'contain' => $contain,
                'conditions'=>$conditions,
                'limit' => 30,
                'order' => [
                    'Departments.name'
                ]
        ];
        
        
        $departments = $this->paginate($this->Departments);

        $this->set(compact('departments'));
        
    }

    /**
     * View method
     *
     * @param string|null $id Department id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $department = $this->Departments->get($id, [
            'contain' => [
                'Users',
                'Leaders'
                ]
        ]);

        $this->set('department', $department);
        
    }
    
    public function details($id = null)
    {
        $department = $this->Departments->get($id, [
            'contain' => ['Leaders']
        ]);
        
        $this->Departments->sendStatusEmail($id);
        
        //Get list of users in this department
        $user_ids = $this->Departments->Users->DepartmentsUsers->find()
            ->select('user_id')
            ->where(['department_id'=>$id])
            ->extract('user_id')->toArray();
        
        $contain = [
            'Certifications.CertificationTypes'=>[
                'fields'=>['id','category','type','name']],
            'Certifications.CertificationTypes.CertificationClasses'=>[
                'fields'=>['id','name','icon']],
            'Certifications'=>[
                'fields'=>['id','status','user_id','expires'],
                // Only get certs that are expiring
                'conditions'=>[
                    'Certifications.status >' => 1,
                    'Certifications.valid' => true,
                    'Certifications.active'=>true]],
            'Registers.RegisterClasses'=>[
                'fields'=>['id','title','icon']],
            'Registers.RegisterTemplates'=>[
                'fields'=>['id','name']],
            'Registers'=>[
                // Only get registers that are expiring
                'fields'=>['id','cert_status','user_id','cert_status_date','register_template_id'],
                'conditions'=>[
                    'Registers.cert_status >' => 1,
                    'Registers.status'=>'Registered',
                    'Registers.active'=>true]]];
    	
    	$conditions = ['Users.active'=>1];
    	
        
        if(!empty($user_ids)){
            $conditions[]['Users.id IN'] = $user_ids;
        }else{
            $conditions[]['Users.id'] = 0;//Return none
        }
        
        $users = $this->Departments->Users->find()
                ->select(['id','name'], true)
                ->autoFields(false)
                ->contain($contain)
                ->where($conditions)->toArray();

        $this->set('users', $users);
        $this->set('department', $department);
        
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $department = $this->Departments->newEntity();
        if ($this->request->is('post')) {
            $department = $this->Departments->patchEntity($department, $this->request->data);
            if ($this->Departments->save($department)) {
                $this->Flash->success(__('The department has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The department could not be saved. Please, try again.'));
        }
        $users = $this->Departments->Users->find('list', 
            ['order' => 'name','conditions'=>['active'=>true]]);

        $this->set(compact('department', 'users'));
        
    }

    /**
     * Edit method
     *
     * @param string|null $id Department id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $department = $this->Departments->get($id, [
            'contain' => ['Users',
                'Leaders']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $department = $this->Departments->patchEntity($department, $this->request->data);
            if ($this->Departments->save($department)) {
                $this->Flash->success(__('The department has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The department could not be saved. Please, try again.'));
        }
        $users = $this->Departments->Users->find('list', 
            ['order' => 'name','conditions'=>['active'=>true]]);
        
        $this->set(compact('department', 'users'));
        
    }

    /**
     * Delete method
     *
     * @param string|null $id Department id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $department = $this->Departments->get($id);
        
        $msg = 'deleted';
        if($department->active){
            $department->active = 0;
        }else{
            $department->active = 1;
            $msg = 'restored';
        }
        if ($this->Departments->save($department)) {
            $this->Flash->success(__('The department has been '.$msg.'.'));
        } else {
            $this->Flash->error(__('The department could not be '.$msg.'. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
