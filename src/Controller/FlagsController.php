<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Flags Controller
 *
 * @property \App\Model\Table\FlagsTable $Flags
 */
class FlagsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $flags = $this->paginate($this->Flags);

        $this->set(compact('flags'));
        
    }

    /**
     * View method
     *
     * @param string|null $id Flag id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $flag = $this->Flags->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('flag', $flag);
        
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $flag = $this->Flags->newEntity();
        if ($this->request->is('post')) {
            $flag = $this->Flags->patchEntity($flag, $this->request->data);
            if ($this->Flags->save($flag)) {
                $this->Flash->success(__('The flag has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The flag could not be saved. Please, try again.'));
        }
        $users = $this->Flags->Users->find('list', ['limit' => 200]);
        $this->set(compact('flag', 'users'));
        
    }

    /**
     * Edit method
     *
     * @param string|null $id Flag id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $flag = $this->Flags->get($id, [
            'contain' => ['Users']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $flag = $this->Flags->patchEntity($flag, $this->request->data);
            if ($this->Flags->save($flag)) {
                $this->Flash->success(__('The flag has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The flag could not be saved. Please, try again.'));
        }
        $users = $this->Flags->Users->find('list', ['limit' => 200]);
        $this->set(compact('flag', 'users'));
        
    }

    /**
     * Delete method
     *
     * @param string|null $id Flag id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $flag = $this->Flags->get($id);
        if ($this->Flags->delete($flag)) {
            $this->Flash->success(__('The flag has been deleted.'));
        } else {
            $this->Flash->error(__('The flag could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
