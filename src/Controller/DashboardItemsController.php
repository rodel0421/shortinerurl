<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * DashboardItems Controller
 *
 * @property \App\Model\Table\DashboardItemsTable $DashboardItems
 *
 * @method \App\Model\Entity\DashboardItem[] paginate($object = null, array $settings = [])
 */
class DashboardItemsController extends AppController
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
        if (in_array($this->request->action, ['delete','add','edit','reorder'])) {
            if ($user['group_id'] <= 4) {
                return true;
            }
        }
        
        
        //Admins have all
        return parent::isAuthorized($user);
    }
    
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        $dashboard = $this->DashboardItems->Dashboards->get($id, [
            'contain' => []
        ]);
        
        $group = $this->Auth->user('group_id');
        if($group != 1 && $dashboard->user_id != $this->Auth->user('id')){//Admin view
            $this->Flash->error(__('You do not have access to this record.'));
            return $this->redirect($this->referer());
        }
        
        if($this->request->query('name')){
        
            $dashboardItem = $this->DashboardItems->newEntity();

            $this->request->data['dashboard_id'] = $id;
            $this->request->data['name'] = $this->request->query('name');

            $dashboardItem = $this->DashboardItems->patchEntity($dashboardItem, $this->request->getData());
            if ($this->DashboardItems->save($dashboardItem)) {
                $this->Flash->success(__('The dashboard item has been added.'));

                return $this->redirect($this->referer());
            }
        }
        $this->Flash->error(__('The dashboard item could not be added. Please, try again.'));

        return $this->redirect($this->referer());
    }
    
    public function edit($id = null)
    {
        $dashboardItem = $this->DashboardItems->get($id, [
            'contain' => ['Dashboards']
        ]);
        
        $group = $this->Auth->user('group_id');
        if($group != 1 && $dashboardItem->dashboard->user_id != $this->Auth->user('id')){//Admin view
            $this->Flash->error(__('You do not have access to this record.'));
            return $this->redirect($this->referer());
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dashboardItem = $this->DashboardItems->patchEntity($dashboardItem, $this->request->getData());
            if ($this->DashboardItems->save($dashboardItem)) {
                $this->Flash->success(__('The dashboard item has been saved.'));

                return $this->redirect(['controller'=>'Dashboards','action' => 'edit',$dashboardItem->dashboard_id]);
            }
            $this->Flash->error(__('The dashboard item could not be saved. Please, try again.'));
        }
        
        $this->loadModel('Departments');
        $departments = $this->Departments->find('list',['conditions'=>['active'=>true]]);
        
        $filter_types = $this->DashboardItems->filter_types;
        
        $this->set('dashboard_items', $this->DashboardItems->Dashboards->dashboard_items);
        
        $this->set(compact('dashboardItem','departments','filter_types'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Dashboard Item id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function reorder($id = null)
    {
        $dashboardItem = $this->DashboardItems->get($id, [
            'contain' => ['Dashboards']
        ]);
        
        $group = $this->Auth->user('group_id');
        if($group != 1 && $dashboardItem->dashboard->user_id != $this->Auth->user('id')){//Admin view
            $this->Flash->error(__('You do not have access to this record.'));
            return $this->redirect($this->referer());
        }
        
        if($this->request->query('order')){
            $dashboardItem->order = (int) $this->request->query('order');
            $this->DashboardItems->save($dashboardItem);
        }
        $this->set('dashboardItem', $dashboardItem);
    }

    /**
     * Delete method
     *
     * @param string|null $id Dashboard Item id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $dashboardItem = $this->DashboardItems->get($id, [
            'contain' => ['Dashboards']
        ]);
        
        $group = $this->Auth->user('group_id');
        if($group != 1 && $dashboardItem->dashboard->user_id != $this->Auth->user('id')){//Admin view
            $this->Flash->error(__('You do not have access to this record.'));
            return $this->redirect($this->referer());
        }
        
        if ($this->DashboardItems->delete($dashboardItem)) {
            $this->Flash->success(__('The dashboard item has been deleted.'));
        } else {
            $this->Flash->error(__('The dashboard item could not be deleted. Please, try again.'));
        }

        return $this->redirect($this->referer());
    }
}
