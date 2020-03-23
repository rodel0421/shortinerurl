<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AllowedDomains Controller
 *
 * @property \App\Model\Table\AllowedDomainsTable $AllowedDomains
 *
 * @method \App\Model\Entity\AllowedDomain[] paginate($object = null, array $settings = [])
 */
class AllowedDomainsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $domains = $this->paginate($this->AllowedDomains);

        $this->set(compact('domains'));
        $this->set('_serialize', ['domains']);
    }

    /**
     * View method
     *
     * @param string|null $id Allowed Domain id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $allowedDomain = $this->AllowedDomains->get($id, [
            'contain' => []
        ]);

        $this->set('allowedDomain', $allowedDomain);
        $this->set('_serialize', ['allowedDomain']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $allowedDomain = $this->AllowedDomains->newEntity();
        if ($this->request->is('post')) {
            $allowedDomain = $this->AllowedDomains->patchEntity($allowedDomain, $this->request->getData());
            if ($this->AllowedDomains->save($allowedDomain)) {
                $this->Flash->success(__('The allowed domain has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The allowed domain could not be saved. Please, try again.'));
        }
        $this->set(compact('allowedDomain'));
        $this->set('_serialize', ['allowedDomain']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Allowed Domain id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $allowedDomain = $this->AllowedDomains->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $allowedDomain = $this->AllowedDomains->patchEntity($allowedDomain, $this->request->getData());
            if ($this->AllowedDomains->save($allowedDomain)) {
                $this->Flash->success(__('The allowed domain has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The allowed domain could not be saved. Please, try again.'));
        }
        $this->set(compact('allowedDomain'));
        $this->set('_serialize', ['allowedDomain']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Allowed Domain id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $allowedDomain = $this->AllowedDomains->get($id);
        if ($this->AllowedDomains->delete($allowedDomain)) {
            $this->Flash->success(__('The allowed domain has been deleted.'));
        } else {
            $this->Flash->error(__('The allowed domain could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
