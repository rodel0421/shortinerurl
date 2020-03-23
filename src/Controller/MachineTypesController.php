<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MachineTypes Controller
 *
 * @property \App\Model\Table\MachineTypesTable $MachineTypes
 *
 * @method \App\Model\Entity\MachineType[] paginate($object = null, array $settings = [])
 */
class MachineTypesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $machineTypes = $this->paginate($this->MachineTypes);

        $this->set(compact('machineTypes'));
        $this->set('_serialize', ['machineTypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Machine Type id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $machineType = $this->MachineTypes->get($id, [
            'contain' => ['Modules']
        ]);

        $this->set('machineType', $machineType);
        $this->set('_serialize', ['machineType']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $machineType = $this->MachineTypes->newEntity();
        if ($this->request->is('post')) {
            $machineType = $this->MachineTypes->patchEntity($machineType, $this->request->getData());
            if ($this->MachineTypes->save($machineType)) {
                $this->Flash->success(__('The machine type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The machine type could not be saved. Please, try again.'));
        }
        $this->set(compact('machineType'));
        $this->set('_serialize', ['machineType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Machine Type id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $machineType = $this->MachineTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $machineType = $this->MachineTypes->patchEntity($machineType, $this->request->getData());
            if ($this->MachineTypes->save($machineType)) {
                $this->Flash->success(__('The machine type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The machine type could not be saved. Please, try again.'));
        }
        $this->set(compact('machineType'));
        $this->set('_serialize', ['machineType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Machine Type id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $machineType = $this->MachineTypes->get($id);
        if ($this->MachineTypes->delete($machineType)) {
            $this->Flash->success(__('The machine type has been deleted.'));
        } else {
            $this->Flash->error(__('The machine type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
