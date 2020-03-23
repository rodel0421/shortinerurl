<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UserNotes Controller
 *
 * @property \App\Model\Table\UserNotesTable $UserNotes
 */
class UserNotesController extends AppController
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
        if (in_array($this->request->action, ['edit'])) {
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
     * Edit method
     *
     * @param string|null $id User Note id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userNote = $this->UserNotes->get($id, [
            'contain' => []
        ]);
        
        
        if($userNote->created->i18nFormat('yyyy-MM-dd') != date("Y-m-d")){
            $this->Flash->error(__('Cannot edit notes older than 1 day'));
            return $this->redirect(['controller'=>'Users','action' => 'view',$userNote->user_id]);
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userNote = $this->UserNotes->patchEntity($userNote, $this->request->data);
            if ($this->UserNotes->save($userNote)) {
                $this->Flash->success(__('The user note has been saved.'));

                return $this->redirect(['controller'=>'Users','action' => 'view',$userNote->user_id]);
            }
            $this->Flash->error(__('The user note could not be saved. Please, try again.'));
        }
        $users = $this->UserNotes->Users->find('list', ['limit' => 200]);
        $this->set(compact('userNote', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User Note id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userNote = $this->UserNotes->get($id);
        
        $userNote->active = 0;
        if ($this->UserNotes->save($userNote)) {
            $this->Flash->success(__('The user note has been removed.'));
        } else {
            $this->Flash->error(__('The user note could not be removed. Please, try again.'));
        }

        return $this->redirect(['controller'=>'Users','action' => 'view',$userNote->user_id]);
    }
}
