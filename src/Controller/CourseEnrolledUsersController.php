<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CourseEnrolledUsers Controller
 *
 * @property \App\Model\Table\CourseEnrolledUsersTable $CourseEnrolledUsers
 *
 * @method \App\Model\Entity\CourseEnrolledUser[] paginate($object = null, array $settings = [])
 */
class CourseEnrolledUsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Courses']
        ];
        $courseEnrolledUsers = $this->paginate($this->CourseEnrolledUsers);
        dump($courseEnrolledUsers);exit;
        $this->set(compact('courseEnrolledUsers'));
        $this->set('_serialize', ['courseEnrolledUsers']);
    }

    /**
     * View method
     *
     * @param string|null $id Course Enrolled User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $courseEnrolledUser = $this->CourseEnrolledUsers->get($id, [
            'contain' => ['Users', 'Courses', 'CourseEnrolledModules', 'CourseEnrolledTests']
        ]);

        $this->set('courseEnrolledUser', $courseEnrolledUser);
        $this->set('_serialize', ['courseEnrolledUser']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $courseEnrolledUser = $this->CourseEnrolledUsers->newEntity();
        if ($this->request->is('post')) {
            $courseEnrolledUser = $this->CourseEnrolledUsers->patchEntity($courseEnrolledUser, $this->request->getData());
            if ($this->CourseEnrolledUsers->save($courseEnrolledUser)) {
                $this->Flash->success(__('The course enrolled user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The course enrolled user could not be saved. Please, try again.'));
        }
        $users = $this->CourseEnrolledUsers->Users->find('list', ['limit' => 200]);
        $courses = $this->CourseEnrolledUsers->Courses->find('list', ['limit' => 200]);
        $this->set(compact('courseEnrolledUser', 'users', 'courses'));
        $this->set('_serialize', ['courseEnrolledUser']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Course Enrolled User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $courseEnrolledUser = $this->CourseEnrolledUsers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $courseEnrolledUser = $this->CourseEnrolledUsers->patchEntity($courseEnrolledUser, $this->request->getData());
            if ($this->CourseEnrolledUsers->save($courseEnrolledUser)) {
                $this->Flash->success(__('The course enrolled user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The course enrolled user could not be saved. Please, try again.'));
        }
        $users = $this->CourseEnrolledUsers->Users->find('list', ['limit' => 200]);
        $courses = $this->CourseEnrolledUsers->Courses->find('list', ['limit' => 200]);
        $this->set(compact('courseEnrolledUser', 'users', 'courses'));
        $this->set('_serialize', ['courseEnrolledUser']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Course Enrolled User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $courseEnrolledUser = $this->CourseEnrolledUsers->get($id);
        if ($this->CourseEnrolledUsers->delete($courseEnrolledUser)) {
            $this->Flash->success(__('The course enrolled user has been deleted.'));
        } else {
            $this->Flash->error(__('The course enrolled user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
