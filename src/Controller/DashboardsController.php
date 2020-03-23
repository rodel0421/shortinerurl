<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Dashboards Controller
 *
 * @property \App\Model\Table\DashboardsTable $Dashboards
 *
 * @method \App\Model\Entity\Dashboard[] paginate($object = null, array $settings = [])
 */
class DashboardsController extends AppController
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
        
        //managers can add / edit
        if (in_array($this->request->action, ['view','delete','add','edit'])) {
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
     * @return \Cake\Http\Response|null
     */
    public function index($id = null)
    {
        $conditions = ['user_id'=>$this->Auth->user('id')];
        
        $group = $this->Auth->user('group_id');
        if($group == 1 && isset($id)){//Admin view
            $conditions['user_id'] = $id;
        }
        
        $this->paginate = [
            'contain' => [],
            'conditions'=>$conditions        
        ];
        $dashboards = $this->paginate($this->Dashboards);

        $this->set(compact('dashboards'));
        
    }

    /**
     * View method
     *
     * @param string|null $id Dashboard id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
    
        if(isset($id)){
            $dashboard = $this->Dashboards->get($id, [
                'contain' => ['Users', 'DashboardItems']
            ]);
        }else{
            $dashboard = $this->Dashboards->find('all', [
                'contain' => ['Users', 'DashboardItems'],
                'conditions'=>['user_id'=>$this->Auth->user('id')],
                'order'=>'order'
            ])->first();
        }
        if(!$dashboard){
            $this->Flash->success(__('First time viewing, please create your custom dashboard.'));
            $dashboard = $this->Dashboards->newEntity();
            $dashboard->name = 'Home';
            $dashboard->user_id = $this->Auth->user('id');
            if ($this->Dashboards->save($dashboard)) {
                return $this->redirect(['action' => 'edit',$dashboard->id]);
            }else{
                $this->Flash->error(__('The dashboard could not be created. Please, try again.'));
                return $this->redirect(['action'=>'add']);
            }
        }

        $group = $this->Auth->user('group_id');
        if($group != 1 && $dashboard->user_id != $this->Auth->user('id')){//Admin view
            $this->Flash->error(__('You do not have access to this record.'));
            return $this->redirect($this->referer());
        }
        
        
        $dashboards = $this->Dashboards->find('list', [
                'conditions'=>['user_id'=>$this->Auth->user('id')],
                'order'=>'order'
            ]);
        
        $this->set('dashboard_items', $this->Dashboards->dashboard_items);
        $this->set(compact('dashboard','dashboards'));
        
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $dashboard = $this->Dashboards->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['user_id']=$this->Auth->user('id');
            
            $dashboard = $this->Dashboards->patchEntity($dashboard, $this->request->getData());
            if ($this->Dashboards->save($dashboard)) {
                $this->Flash->success(__('The dashboard has been created.'));

                return $this->redirect(['action' => 'edit',$dashboard->id]);
            }
            $this->Flash->error(__('The dashboard could not be saved. Please, try again.'));
        }
        
        $this->set(compact('dashboard'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Dashboard id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $dashboard = $this->Dashboards->get($id, [
            'contain' => [ 'DashboardItems']
        ]);
        
        $group = $this->Auth->user('group_id');
        if($group != 1 && $dashboard->user_id != $this->Auth->user('id')){//Admin view
            $this->Flash->error(__('You do not have access to this record.'));
            return $this->redirect($this->referer());
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dashboard = $this->Dashboards->patchEntity($dashboard, $this->request->getData());
            if ($this->Dashboards->save($dashboard)) {
                $this->Flash->success(__('The dashboard has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dashboard could not be saved. Please, try again.'));
        }
        $filter_types = $this->Dashboards->DashboardItems->filter_types;
        
        $this->set('dashboard_items', $this->Dashboards->dashboard_items);
        $this->set(compact('dashboard','filter_types'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Dashboard id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
                
        $dashboard = $this->Dashboards->get($id);
        
        $group = $this->Auth->user('group_id');
        if($group != 1 && $dashboard->user_id != $this->Auth->user('id')){//Admin view
            $this->Flash->error(__('You do not have access to this record.'));
            return $this->redirect($this->referer());
        }
        
        if ($this->Dashboards->delete($dashboard)) {
            $this->Flash->success(__('The dashboard has been deleted.'));
        } else {
            $this->Flash->error(__('The dashboard could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'view']);
    }
}
