<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Facilities Controller
 *
 * @property \App\Model\Table\FacilitiesTable $Facilities
 */
class FacilitiesController extends AppController
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
        if (in_array($this->request->action, ['add','delete','edit','index','view'])) {
            if ($user['group_id'] < 1) { 
                return true;
            }
        }
        
        return parent::isAuthorized($user);
    }
    
    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow(['home']);
    }
    
    private $_areas = [
        'Registers'=>'Registers',
        'People'=>'People Lookup',
        'Trips'=>'Trips',
        'Bookings'=>'Bookings'
    ];
    
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function home()
    {
        $this->viewBuilder()->layout('public');
        
        $group = $this->Auth->user('group_id');
        $conditions = [];
        if(!$group || $group > 3){//4 	staff and below secure
            $conditions['OR'] = ['Resources.group_id >='=>$group,'Resources.group_id is null'];
        }elseif(!$group){//Not authed - show only public
            $conditions[] = 'Resources.group_id is null';
        }
        
        $facilities = $this->Facilities->find('all',[
            'conditions'=>['Facilities.active'=>true],
            'contain'=>[
                'Resources'=>['conditions'=>$conditions]],
            'order' => [
                'Facilities.title'
            ]]);
        
        if($facilities->count() == 0){
            $resources = $this->Facilities->Resources->find('all',[
                'conditions'=>$conditions
            ]);
            $this->viewBuilder()->template('resources');
            $this->set(compact('resources'));
        }
        
        $this->set(compact('facilities'));
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $contain = [];
        $conditions = [];
    	
    	$alt = [];
        
    	$conditions = $this->buildConditions($this->Facilities,$alt);
        
        if(!$this->request->query('archived')){
            $conditions['Facilities.active']=1;
        }else{
            $conditions['Facilities.active']=0;
        }
        
        $this->paginate = [
            'contain' => $contain,
            'conditions'=>$conditions,
            'limit' => 30
        ];
        
        $facilities = $this->paginate($this->Facilities);

        $this->set(compact('facilities'));
        
    }

    /**
     * View method
     *
     * @param string|null $id Facility id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $facility = $this->Facilities->get($id, [
            'contain' => []
        ]);

        $this->set('facility', $facility);
        
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $facility = $this->Facilities->newEntity();
        if ($this->request->is('post')) {
            $facility = $this->Facilities->patchEntity($facility, $this->request->data);
            if ($this->Facilities->save($facility)) {
                $this->Flash->success(__('The facility has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The facility could not be saved. Please, try again.'));
        }
        $areas = $this->_areas;
        $this->set(compact('facility','areas'));
        
    }

    /**
     * Edit method
     *
     * @param string|null $id Facility id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $facility = $this->Facilities->get($id, [
            'contain' => ['Users']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $facility = $this->Facilities->patchEntity($facility, $this->request->data);
            if ($this->Facilities->save($facility)) {
                $this->Flash->success(__('The facility has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The facility could not be saved. Please, try again.'));
        }
        
        $areas = $this->_areas;
        $this->set(compact('facility','areas'));
        
    }

    /**
     * Delete method
     *
     * @param string|null $id Facility id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $facility = $this->Facilities->get($id);
        
        $msg = 'deleted';
        if($facility->active){
            $facility->active = 0;
        }else{
            $facility->active = 1;
            $msg = 'restored';
        }
        if ($this->Facilities->save($facility)) {
            $this->Flash->success(__('The facility has been '.$msg.'.'));
        } else {
            $this->Flash->error(__('The facility could not be '.$msg.'. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
