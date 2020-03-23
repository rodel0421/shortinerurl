<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Guides Controller
 *
 * @property \App\Model\Table\GuidesTable $Guides
 *
 * @method \App\Model\Entity\Guide[] paginate($object = null, array $settings = [])
 */
class GuidesController extends AppController
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
        
        
        
        //Admins have all
        return parent::isAuthorized($user);
    }
    
    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow(['view','open']);
        
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function open(){
        
        $condtions = [];
        if($this->request->query('c')){
            $condtions['controller']=$this->request->query('c');
        }else{
            $condtions['controller']='index';//This will cause nothing to be found
            //Then it will list the index
        }
        if($this->request->query('a')){
            $condtions['action']=$this->request->query('a');
        }
        
        $guide = $this->Guides->find('all', [
            'contain' => [],
            'conditions'=>$condtions,
            'order'=>'lft'
        ])->first();
        
        if(!$guide){//Just get controller
            unset($condtions['action']);
            $guide = $this->Guides->find('all', [
                'contain' => [],
                'conditions'=>$condtions,
                'order'=>'lft'
            ])->first();
        }
        
        if($guide){
            return $this->redirect(['action' => 'view',$guide->id]);
        }
        
        $index = $this->Guides
            ->find('all')
            ->contain([
                'ChildGuides'=>
                    ['fields'=>['id','title','parent_id']]])
            ->order('Guides.lft')
            ->where(['parent_id IS NULL'])
            ->select(['id','title']);
        
        $this->set(compact('index'));
        
    }
    
    public function index()
    {
        $this->paginate = [
            'limit' => 60,
            'contain'=>['ParentGuides'],
            'order' => [
                'Guides.lft' 
            ]
        ];
        
        if($this->request->query('rebuild')){
            $this->Guides->recover();
            return $this->redirect(['action'=>'index']);
        }
        
        
        $guides = $this->paginate($this->Guides);

        $this->set(compact('guides'));
        
    }

    /**
     * View method
     *
     * @param string|null $id Guide id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $guide = $this->Guides->get($id, [
            'contain' => []
        ]);
        
        //Get list of guides for same controller
        $guides = $this->Guides->find('all', [
            'contain' => [],
            'conditions'=>['controller'=>$guide->controller],
            'order'=>'lft'
        ]);
        
        if($this->isAdmin() && $this->request->query('moveUp')){
            $this->Guides->moveUp($guide);
            $this->Flash->success(__('The guide has been moved up.'));
            return $this->redirect($this->referer());
        }
        
        if($this->isAdmin() && $this->request->query('moveDown')){
            $this->Guides->moveDown($guide);
            $this->Flash->success(__('The guide has been moved down.'));
            return $this->redirect($this->referer());
        }
        
        
        /*
        $top_id = $guide->parent_id;
        if(!$top_id){
            $top_id = $guide->id;
        }
        
        $subIndex = $this->Guides
            ->find('children',['for'=>$top_id])
            ->select(['id','title']);*/

        $this->set(compact('guide','guides'));
        
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $guide = $this->Guides->newEntity();
        if ($this->request->is('post')) {
            $guide = $this->Guides->patchEntity($guide, $this->request->getData());
            if ($this->Guides->save($guide)) {
                $this->Flash->success(__('The guide has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The guide could not be saved. Please, try again.'));
        }
        $controllers = $this->getControllers();
        $parents = $this->Guides->find('list',['conditions'=>['parent_id IS NULL']]);
        
        $this->set(compact('guide','controllers','parents'));
        
    }

    /**
     * Edit method
     *
     * @param string|null $id Guide id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $guide = $this->Guides->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $guide = $this->Guides->patchEntity($guide, $this->request->getData());
            if ($this->Guides->save($guide)) {
                $this->Flash->success(__('The guide has been saved.'));

                return $this->redirect(['action' => 'view',$guide->id]);
            }
            $this->Flash->error(__('The guide could not be saved. Please, try again.'));
        }
        
        $controllers = $this->getControllers();
        $parents = $this->Guides->find('list',['conditions'=>['parent_id IS NULL']]);
        
        $this->set(compact('guide','controllers','parents'));
        
    }

    /**
     * Delete method
     *
     * @param string|null $id Guide id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $guide = $this->Guides->get($id);
        if ($this->Guides->delete($guide)) {
            $this->Flash->success(__('The guide has been deleted.'));
        } else {
            $this->Flash->error(__('The guide could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'open']);
    }
    
    
    private function getControllers() {
        $files = scandir('../src/Controller/');
        $results = [];
        $ignoreList = [
            '.', 
            '..', 
            'Component', 
            'AppController.php',
        ];
        foreach($files as $file){
            if(!in_array($file, $ignoreList)) {
                $controller = str_replace('Controller', '', explode('.', $file)[0]);
                $results[$controller] = $controller;
            }            
        }
        return $results;
    }    
    
    private function getActions($controllerName) {
        $className = 'App\\Controller\\'.$controllerName.'Controller';
        $class = new ReflectionClass($className);
        $actions = $class->getMethods(ReflectionMethod::IS_PUBLIC);
        $results = [$controllerName => []];
        $ignoreList = ['beforeFilter', 'afterFilter', 'initialize'];
        foreach($actions as $action){
            if($action->class == $className && !in_array($action->name, $ignoreList)){
                array_push($results[$controllerName], $action->name);
            }   
        }
        return $results;
    }

    private function getResources(){
        $controllers = $this->getControllers();
        $resources = [];
        foreach($controllers as $id => $controller){
            $actions = $this->getActions($controller);
            array_push($resources, $actions);
        }
        return $resources;
    }
}
