<?php
namespace App\Controller;

use App\Controller\AppController;


/**
 * FormTemplates Controller
 *
 * @property \App\Model\Table\FormTemplatesTable $FormTemplates
 */
class FormTemplatesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $contain = [];
    	
    	$conditions = [];
    	
    	$alt = [];
        
    	$conditions = $this->buildConditions($this->FormTemplates,$alt);
        if(!$this->request->query('archived')){
            $conditions['FormTemplates.active']=1;
        }else{
            $conditions['FormTemplates.active']=0;
        }
        
        $this->paginate = [
            'contain' => $contain,
            'conditions'=>$conditions,
            'limit' => 30,
            'order' => [
                'title'
            ]
        ];
        $formTemplates = $this->paginate($this->FormTemplates);

        $this->set(compact('formTemplates'));
        
    }

    /**
     * View method
     *
     * @param string|null $id Form Template id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $formTemplate = $this->FormTemplates->get($id, [
            'contain' => []
        ]);

        $this->set('formTemplate', $formTemplate);
        
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $formTemplate = $this->FormTemplates->newEntity();
        if ($this->request->is('post')) {
            $formTemplate = $this->FormTemplates->patchEntity($formTemplate, $this->request->data);
            if ($this->FormTemplates->save($formTemplate)) {
                $this->Flash->success(__('The form template has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The form template could not be saved. Please, try again.'));
        }
        $this->set(compact('formTemplate'));
        
    }

    /**
     * Edit method
     *
     * @param string|null $id Form Template id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $formTemplate = $this->FormTemplates->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $formTemplate = $this->FormTemplates->patchEntity($formTemplate, $this->request->data);
            if ($this->FormTemplates->save($formTemplate)) {
                $this->Flash->success(__('The form template has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The form template could not be saved. Please, try again.'));
        }
        $this->set(compact('formTemplate'));
        
    }

    /**
     * Delete method
     *
     * @param string|null $id Form Template id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $formTemplate = $this->FormTemplates->get($id);
        
        
        $msg = 'deleted';
        if($formTemplate->active){
            $formTemplate->active = 0;
        }else{
            $formTemplate->active = 1;
            $msg = 'restored';
        }
        
        if ($this->FormTemplates->save($formTemplate)) {
            $this->Flash->success(__('The form template has been '.$msg.'.'));
        } else {
            $this->Flash->error(__('The form template could not be '.$msg.'. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
