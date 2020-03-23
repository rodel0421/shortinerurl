<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UserCostCenters Controller
 *
 * @property \App\Model\Table\UserCostCentersTable $UserCostCenters
 *
 * @method \App\Model\Entity\UserCostCenter[] paginate($object = null, array $settings = [])
 */
class UserCostCentersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $userCostCenters = $this->paginate($this->UserCostCenters);

        $this->set(compact('userCostCenters'));
        $this->set('_serialize', ['userCostCenters']);
    }

    /**
     * View method
     *
     * @param string|null $id User Cost Center id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userCostCenter = $this->UserCostCenters->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('userCostCenter', $userCostCenter);
        $this->set('_serialize', ['userCostCenter']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userCostCenter = $this->UserCostCenters->newEntity();
        if ($this->request->is('post')) {
            $userCostCenter = $this->UserCostCenters->patchEntity($userCostCenter, $this->request->getData());
            if ($this->UserCostCenters->save($userCostCenter)) {
                $this->Flash->success(__('The user cost center has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user cost center could not be saved. Please, try again.'));
        }
        $users = $this->UserCostCenters->Users->find('list', ['limit' => 200]);
        $this->set(compact('userCostCenter', 'users'));
        $this->set('_serialize', ['userCostCenter']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Cost Center id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userCostCenter = $this->UserCostCenters->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userCostCenter = $this->UserCostCenters->patchEntity($userCostCenter, $this->request->getData());
            if ($this->UserCostCenters->save($userCostCenter)) {
                $this->Flash->success(__('The user cost center has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user cost center could not be saved. Please, try again.'));
        }
        $users = $this->UserCostCenters->Users->find('list', ['limit' => 200]);
        $this->set(compact('userCostCenter', 'users'));
        $this->set('_serialize', ['userCostCenter']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Cost Center id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userCostCenter = $this->UserCostCenters->get($id);
        if ($this->UserCostCenters->delete($userCostCenter)) {
            $this->Flash->success(__('The user cost center has been deleted.'));
        } else {
            $this->Flash->error(__('The user cost center could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
