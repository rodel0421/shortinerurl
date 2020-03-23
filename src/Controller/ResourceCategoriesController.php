<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ResourceCategories Controller
 *
 * @property \App\Model\Table\ResourceCategoriesTable $ResourceCategories
 *
 * @method \App\Model\Entity\ResourceCategory[] paginate($object = null, array $settings = [])
 */
class ResourceCategoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $resourceCategories = $this->paginate($this->ResourceCategories);

        $this->set(compact('resourceCategories'));
        
    }

    /**
     * View method
     *
     * @param string|null $id Resource Category id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $resourceCategory = $this->ResourceCategories->get($id, [
            'contain' => ['ResourcesTags']
        ]);

        $this->set('resourceCategory', $resourceCategory);
        
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $resourceCategory = $this->ResourceCategories->newEntity();
        if ($this->request->is('post')) {
            $resourceCategory = $this->ResourceCategories->patchEntity($resourceCategory, $this->request->getData());
            if ($this->ResourceCategories->save($resourceCategory)) {
                $this->Flash->success(__('The resource category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The resource category could not be saved. Please, try again.'));
        }
        $this->set(compact('resourceCategory'));
        
    }

    /**
     * Edit method
     *
     * @param string|null $id Resource Category id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $resourceCategory = $this->ResourceCategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $resourceCategory = $this->ResourceCategories->patchEntity($resourceCategory, $this->request->getData());
            if ($this->ResourceCategories->save($resourceCategory)) {
                $this->Flash->success(__('The resource category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The resource category could not be saved. Please, try again.'));
        }
        $this->set(compact('resourceCategory'));
        
    }

    /**
     * Delete method
     *
     * @param string|null $id Resource Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $resourceCategory = $this->ResourceCategories->get($id);
        if ($this->ResourceCategories->delete($resourceCategory)) {
            $this->Flash->success(__('The resource category has been deleted.'));
        } else {
            $this->Flash->error(__('The resource category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
