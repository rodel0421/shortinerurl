<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Maintenance Controller
 *
 *
 * @method \App\Model\Entity\Maintenance[] paginate($object = null, array $settings = [])
 */
class MaintenanceController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $maintenance = $this->paginate($this->Maintenance);

        $this->set(compact('maintenance'));
        $this->set('_serialize', ['maintenance']);
    }

    /**
     * View method
     *
     * @param string|null $id Maintenance id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $maintenance = $this->Maintenance->get($id, [
            'contain' => []
        ]);

        $this->set('maintenance', $maintenance);
        $this->set('_serialize', ['maintenance']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $maintenance = $this->Maintenance->newEntity();
        if ($this->request->is('post')) {
            $maintenance = $this->Maintenance->patchEntity($maintenance, $this->request->getData());
            if ($this->Maintenance->save($maintenance)) {
                $this->Flash->success(__('The maintenance has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The maintenance could not be saved. Please, try again.'));
        }
        $this->set(compact('maintenance'));
        $this->set('_serialize', ['maintenance']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Maintenance id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $maintenance = $this->Maintenance->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $maintenance = $this->Maintenance->patchEntity($maintenance, $this->request->getData());
            if ($this->Maintenance->save($maintenance)) {
                $this->Flash->success(__('The maintenance has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The maintenance could not be saved. Please, try again.'));
        }
        $this->set(compact('maintenance'));
        $this->set('_serialize', ['maintenance']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Maintenance id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $maintenance = $this->Maintenance->get($id);
        if ($this->Maintenance->delete($maintenance)) {
            $this->Flash->success(__('The maintenance has been deleted.'));
        } else {
            $this->Flash->error(__('The maintenance could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
