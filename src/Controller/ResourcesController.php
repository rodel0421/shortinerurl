<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Resources Controller
 *
 * @property \App\Model\Table\ResourcesTable $Resources
 */
class ResourcesController extends AppController
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
        if (in_array($this->request->action, ['add','delete','edit'])) {
            if ($user['group_id'] <= 2) {
                return true;
            }
        }
        
        if (in_array($this->request->action, ['index','view','home'])) {
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
        
        if($this->request->query('rebuild')){
            $this->Resources->recover();
            return $this->redirect(['action'=>'index']);
        }
        
        $categories = $this->Resources->ResourceCategories->find('list',[
            'order'=>'name'
        ])->toArray();
        
        
        $contain = ['Groups','ResourceCategories'];
        
        $paginationOptions = [
            'contain' => $contain,
            'limit' => 30,
            'order' => [
                'Resources.lft'
            ]
        ];
        
        if(isset($this->request->query['category'])){
            $category_id = (int)$this->request->query['category'];
            
            $this->request->data['category'] = $category_id;
            //$this->set('page_heading', isset($categories[$category_id])?$categories[$category_id]:'Documents' );
            
            $paginationOptions['join'] = [
                'alias' => 'Categories',
                'table' => 'resources_tags',
                'type' => 'INNER',
                'conditions' => ['Categories.resource_id = Resources.id','resource_category_id'=>$category_id]
                ];
        }
        
    	$alt = [];
        
    	$conditions = $this->buildConditions($this->Resources,$alt);
        
        if(!$this->request->query('archived')){
            $conditions['Resources.active']=1;
        }else{
            $conditions['Resources.active']=0;
        }
        
        if($this->facility_id()){
            $conditions['Resources.facility_id']=$this->facility_id();
        }else{
            $conditions[]='Resources.facility_id IS NULL';
        }
        
        $group = $this->Auth->user('group_id');
        if(!$group || $group > 3){//4 	staff and below secure
            $conditions['OR'] = ['Resources.group_id >='=>$group,'Resources.group_id is null'];
        }
        
        $paginationOptions['conditions'] = $conditions;
        $this->paginate = $paginationOptions;
        
        $resources = $this->paginate($this->Resources);
        

        $this->set(compact('resources','categories'));
        
    }
    
    public function home()
    {
        $categories = $this->Resources->ResourceCategories->find('list',[
            'order'=>'name'
        ])->toArray();
        
        $contain = ['Groups','ResourceCategories'];
    	
        $paginationOptions = [
            'contain' => $contain,
            'limit' => 30,
            'order' => [
                'Resources.lft'
            ]
        ];
        
        if(isset($this->request->query['category'])){
            $category_id = (int)$this->request->query['category'];
            
            $this->request->data['category'] = $category_id;
            //$this->set('page_heading', isset($categories[$category_id])?$categories[$category_id]:'Documents' );
            
            $paginationOptions['join'] = [
                'alias' => 'Categories',
                'table' => 'resources_tags',
                'type' => 'INNER',
                'conditions' => ['Categories.resource_id = Resources.id','resource_category_id'=>$category_id]
                ];
        }
        
    	$alt = [];
    	$conditions = $this->buildConditions($this->Resources,$alt);
        
        if(!$this->request->query('archived')){
            $conditions['Resources.active']=1;
        }else{
            $conditions['Resources.active']=0;
        }
        
        if($this->facility_id()){
            $conditions['Resources.facility_id']=$this->facility_id();
        }else{
            $conditions[]='Resources.facility_id IS NULL';
        }
        
        //Public
        $group = $this->Auth->user('group_id');
        if(!$group || $group > 3){//4 	staff and below secure
            $conditions['OR'] = ['Resources.group_id >='=>$group,'Resources.group_id is null'];
        }
        
        $paginationOptions['conditions'] = $conditions;
        $this->paginate = $paginationOptions;
        
        $resources = $this->paginate($this->Resources);

        $this->set(compact('resources','categories'));
        
    }

    /**
     * View method
     *
     * @param string|null $id Resource id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $resource = $this->Resources->get($id, [
            'contain' => ['Users', 'Facilities', 'Groups','ResourceCategories']
        ]);
        
        if(($this->isAdmin() || $this->isOfficer) && $this->request->query('moveUp')){
            $this->Resources->moveUp($resource);
            $this->Flash->success(__('The resource has been moved up.'));
            return $this->redirect($this->referer());
        }
        
        if(($this->isAdmin() || $this->isOfficer) && $this->request->query('moveDown')){
            $this->Resources->moveDown($resource);
            $this->Flash->success(__('The resource has been moved down.'));
            return $this->redirect($this->referer());
        }
        
        $group = $this->Auth->user('group_id');
        
        
        if((!$group || $group > 3) && $resource->group_id && $resource->group_id < $group){//4 	staff and below secure
            $this->Flash->error(__('You do not have access to this record.'));
            return $this->redirect($this->referer());
        }

        $this->set('resource', $resource);
        
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        
        $type = 'Note';
        
        $said_type = $this->request->query('type');
        if($said_type && in_array($said_type,['Note','Link','Document'])){
            $type = $said_type;
        }
        
        $resource = $this->Resources->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['type'] = $type;
            $this->request->data['user_id'] = $this->Auth->user('id');
            $this->request->data['facility_id']=$this->facility_id();
            
            
            $resource = $this->Resources->patchEntity($resource, $this->request->data);
            if ($this->Resources->save($resource)) {
                $this->Flash->success(__('The resource has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The resource could not be saved. Please, try again.'));
        }
        
        $groups = $this->Resources->Groups->find('list', ['order' => ['id'=>'desc']]);
        $categories = $this->Resources->ResourceCategories->find('list',[
            'keyField'=>'name',
            'order'=>'name'
        ]);
        
        $this->set(compact('resource', 'groups','type','categories'));
        
    }

    /**
     * Edit method
     *
     * @param string|null $id Resource id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $resource = $this->Resources->get($id, [
            'contain' => ['ResourceCategories']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['user_id'] = $this->Auth->user('id');
            $resource = $this->Resources->patchEntity($resource, $this->request->data);
            if ($this->Resources->save($resource)) {

                if(array_key_exists('doc', $this->request->data)){
                    if($this->request->data['doc']){
                        if(!file_exists(WWW_ROOT.'upload/resources/'. $resource->id)){
                            mkdir(WWW_ROOT.'upload/resources/'. $resource->id, 0077, true);
                        }
                        move_uploaded_file($this->request->data['doc']['tmp_name'], WWW_ROOT . $resource->doc);
                        // var_dump($this->request->data['doc']['tmp_name'], WWW_ROOT . $resource->doc);exit;
                    }
                }
                $this->Flash->success(__('The resource has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The resource could not be saved. Please, try again.'));
        }
        $groups = $this->Resources->Groups->find('list', ['order' => ['id'=>'desc']]);
        $categories = $this->Resources->ResourceCategories->find('list',[
            'keyField'=>'name',
            'order'=>'name'
        ]);
        
        $this->set(compact('resource', 'groups','categories'));
        
    }

    /**
     * Delete method
     *
     * @param string|null $id Resource id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $resource = $this->Resources->get($id);
        $msg = 'deleted';
        if($resource->active){
            $resource->active = 0;
        }else{
            $resource->active = 1;
            $msg = 'restored';
        }
        
        if ($this->Resources->save($resource)) {
            $this->Flash->success(__('The resource has been '.$msg.'.'));
        } else {
            $this->Flash->error(__('The resource could not be '.$msg.'. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
