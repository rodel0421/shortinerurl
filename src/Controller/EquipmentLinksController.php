<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * EquipmentLinks Controller
 *
 * @property \App\Model\Table\EquipmentLinksTable $EquipmentLinks
 */
class EquipmentLinksController extends AppController
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
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($equipment_id)
    {
        $equipment = $this->EquipmentLinks->Equipment->get($equipment_id, [
            'contain' => [],
            'fields'=>['id','user_id','department_id']]);
            
        $group = $this->Auth->user('group_id');
        if(!$group || $group > 3){//operators and below lock to own account
            //Check if in department
            $departments = $this->userDepartments();
            $depOK = isset($departments[$equipment->department_id]);
            
            
            $user_id = $this->Auth->user('id');
            if(!$depOK && $equipment->user_id != $this->Auth->user('id')){
                $this->Flash->error(__('You do not have access to this equipment'));
                return $this->redirect($this->referer());
            }
            
        }
        
        $equipmentLink = $this->EquipmentLinks->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['equipment_id'] = $equipment_id;
            
            $equipmentLink = $this->EquipmentLinks->patchEntity($equipmentLink, $this->request->data);
            if ($this->EquipmentLinks->save($equipmentLink)) {
                $this->Flash->success(__('The equipment has been linked.'));
            }else{
                $this->Flash->error(__('The equipment could not be linked. Please, try again.'));
            }
            
        }
        
        return $this->redirect(['controller'=>'Equipment','action' => 'view',$equipment_id]);
    }


    /**
     * Delete method
     *
     * @param string|null $id EquipmentLinks id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        
        $equipmentLink = $this->EquipmentLinks->get($id,[
            'contain'=>
                ['Equipment'=>
                    ['fields'=>['id','user_id','department_id']]]]);
        
        $group = $this->Auth->user('group_id');
        $user_id = $this->Auth->user('id');
        //Check if in department
        $departments = $this->userDepartments();
        $depOK = isset($departments[$equipmentLink->equipment->department_id]);
        
        if((!$group || $group > 3) && $depOK && $equipmentLink->equipment->user_id != $user_id){//4 operators and below lock to own account
            $this->Flash->error(__('You do not have access to delete this record.'));
            return $this->redirect($this->referer());
        }
        
        if ($this->EquipmentLinks->delete($equipmentLink)) {
            $this->Flash->success(__('The equipment has been deleted.'));
        } else {
            $this->Flash->error(__('The equipment could not be deleted. Please, try again.'));
        }
        
        return $this->redirect($this->referer());
    }
}
