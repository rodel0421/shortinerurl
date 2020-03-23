<?php
namespace App\Controller;

use App\Controller\AppController;
/**
 * CourseModules Controller
 *
 * @property \App\Model\Table\CourseModulesTable $CourseModules
 *
 * @method \App\Model\Entity\CourseModule[] paginate($object = null, array $settings = [])
 */
class CourseModulesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Courses', 'MachineTypes', 'Resources', 'Tests']
        ];
        $courseModules = $this->CourseModules->Courses->find('list', ['limit' => 200]);

        $this->set(compact('courseModules','courses'));
        $this->set('_serialize', ['courseModules']);
    }

    /**
     * View method
     *
     * @param string|null $id Course Module id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $courseModule = $this->CourseModules->get($id, [
            'contain' => ['Courses', 'CourseMachineTypes', 'Resources', 'CourseEnrolledModules', 'CourseTests']
        ]);

        $this->set('courseModule', $courseModule);
        $this->set('_serialize', ['courseModule']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $courseModule = $this->CourseModules->newEntity();
        if ($this->request->is('post')) {
            $courseModule = $this->CourseModules->patchEntity($courseModule, $this->request->getData());
            if ($this->CourseModules->save($courseModule)) {
                $this->Flash->success(__('The course module has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The course module could not be saved. Please, try again.'));
        }
        $courses = $this->CourseModules->Courses->find('list', ['limit' => 200]);
        $courseMachineTypes = $this->CourseModules->CourseMachineTypes->find('list', ['limit' => 200]);
        $resources = $this->CourseModules->Resources->find('list', ['limit' => 200]);
        $this->set(compact('courseModule', 'courses', 'courseMachineTypes', 'resources'));
        $this->set('_serialize', ['courseModule']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Course Module id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $courseModule = $this->CourseModules->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $courseModule = $this->CourseModules->patchEntity($courseModule, $this->request->getData());
            if ($this->CourseModules->save($courseModule)) {
                $this->Flash->success(__('The course module has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The course module could not be saved. Please, try again.'));
        }
        $courses = $this->CourseModules->Courses->find('list', ['limit' => 200]);
        $courseMachineTypes = $this->CourseModules->CourseMachineTypes->find('list', ['limit' => 200]);
        $resources = $this->CourseModules->Resources->find('list', ['limit' => 200]);
        $this->set(compact('courseModule', 'courses', 'courseMachineTypes', 'resources'));
        $this->set('_serialize', ['courseModule']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Course Module id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $courseModule = $this->CourseModules->get($id);
        if ($this->CourseModules->delete($courseModule)) {
            $this->Flash->success(__('The course module has been deleted.'));
        } else {
            $this->Flash->error(__('The course module could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
