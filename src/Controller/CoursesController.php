<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\Query;
use Cake\Routing\Router;
/**
 * Courses Controller
 *
 * @property \App\Model\Table\CoursesTable $Courses
 *
 * @method \App\Model\Entity\Course[] paginate($object = null, array $settings = [])
 */
class CoursesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $courses = $this->paginate($this->Courses);
        $this->set(compact('courses'));
        $this->set('_serialize', ['courses']);
    }

    public function myCourses(){
        $this->viewBuilder()->setLayout('taro');
        $userID = $this->Auth->user('id');
        $courses = $this->Courses->CourseEnrolledUsers->find()->where(['user_id' => $userID])->contain(['Courses'])->toArray();
        $this->set(compact('courses'));
        $this->set('_serialize', ['courses']);
    }

    /**
     * View method
     *
     * @param string|null $id Course id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $course = $this->Courses->get($id, [
            'contain' => [
                'Modules',
                'CourseEnrolledUsers' => function (Query $q){
                    return $q->select(['CourseEnrolledUsers.course_id','CourseEnrolledUsers.status','Users.id', 'Users.given_name', 'Users.surname'])
                        ->contain(['Users']);
                }
            ]
        ]);

        //Fill users array with list of enrolled users
        $users = [];
        if(!empty($course->course_enrolled_users)){
            foreach($course->course_enrolled_users as $enrolled_user){
                array_push($users, $enrolled_user->user->id);
            }
        }
        ($course->modules) ? $students = $this->getUnenrolled([$course->modules[0]->id]): $students = [];
        
        $modules_list = $this->Courses->Modules->find('list')->where(['course_id' => $id]);
        if(!empty($users)){
            $students->where(['id NOT IN ' => $users]);
        }
        $this->set('users', $users);
        $this->set('students', $students);
        $this->set('modules_list', $modules_list);
        $this->set('course', $course);
        $this->set('_serialize', ['course']);
    }

        /**
     * View method
     *
     * @param string|null $id Course id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function viewCourse($id = null)
    {
        $this->viewBuilder()->setLayout('taro');
        $course = $this->Courses->get($id, [
            'contain' => ['Modules']
        ]);
        $uid = $this->Auth->user('id');
        $isEnrolled = $this->Courses->CourseEnrolledUsers->isUserEnrolled( $uid, $id );
        $this->set(compact('course', 'isEnrolled'));
        $this->set('_serialize', ['course']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $course = $this->Courses->newEntity();
        if ($this->request->is('post')) {
            $course = $this->Courses->patchEntity($course, $this->request->getData());
            if ($this->Courses->save($course)) {
                $this->Flash->success(__('The course has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The course could not be saved. Please, try again.'));
        }
        $this->set(compact('course'));
        $this->set('_serialize', ['course']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Course id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $course = $this->Courses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $course = $this->Courses->patchEntity($course, $this->request->getData());
            if ($this->Courses->save($course)) {
                $this->Flash->success(__('The course has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The course could not be saved. Please, try again.'));
        }
        $this->set(compact('course'));
        $this->set('_serialize', ['course']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Course id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $course = $this->Courses->get($id);
        if ($this->Courses->delete($course)) {
            $this->Flash->success(__('The course has been deleted.'));
        } else {
            $this->Flash->error(__('The course could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function invite($id){
        $this->viewBuilder()->layout('ajax');

        $request = $this->request->getData();
        $course = $this->Courses->get($id);
        $invited_users = [];
        $invited_user_ids = [];
        $this->loadModel('CourseEnrolledModules');
        foreach($request['students'] as $student){
            // $invited_user = array('user_id' => $student, 'status' => 'invited');
            if (filter_var($student, FILTER_VALIDATE_EMAIL)) {
                $this->sendEmailInvite($student);
                $result = array(
                    'message'   => 'Invitations sent'  ,
                );
                $code = 200;
            } else {                
                $invited_user = $this->Courses->CourseEnrolledUsers->newEntity();
                $course_enrolled_modules = [];
                foreach($request['modules'] as $module){
                    $course_enrolled_module = $this->CourseEnrolledModules->newEntity();
                    $course_enrolled_module->course_enrolled_user_id = $student;
                    $course_enrolled_module->course_module_id = $module;
                    $course_enrolled_module->status = 'accepted';
                    array_push($course_enrolled_modules, $course_enrolled_module);
                }
                $invited_user->user_id = $student;
                $invited_user->status = 'accepted';
                $invited_user->course_enrolled_modules = $course_enrolled_modules;
                array_push($invited_users, $invited_user);
                array_push($invited_user_ids, $student);
            }
        }
        if($invited_users){
            $course->course_enrolled_users = $invited_users;
            if($this->Courses->save($course)){
                $this->loadModel('Alerts');
                $course = $this->Courses->get($course->id, ['contain' => [
                    'CourseEnrolledUsers' => function(Query $q) use ($invited_user_ids){
                        return $q->where(['user_id IN' => $invited_user_ids]);
                    }
                ]]);
                foreach($course->course_enrolled_users as $student){
                    $alert = $this->Alerts->newEntity();
                    $data = array(
                        'title' => 'You have been invited to finish the course '. $course->name,
                        'controller' => 'Courses',
                        'item' => $student->id,
                        'user_id' => $student->user_id,
                        'link' => 'courses/accept-invitation/'.$student->id,
                        'type' => 'CourseEnrolledUser',
                        'active' => 1,
                    );
                    $alert = $this->Alerts->patchEntity($alert, $data);
                    $this->Alerts->save($alert);
                }
                $result = array(
                    'message'   => 'Invitations sent'  ,
                );
                $code = 200;
            }
            else{
                $result = array(
                    'message' => 'Error inviting users'  
                );          
                $code = 500;  
            }
        }
        $result = json_encode($result);
        // $result = json_encode($course);
        $this->response->type('json');
        $this->response->body($result);
        $this->response->statusCode($code);
        // $this->response->statusCode(200);
        
        return $this->response;
    }

    public function acceptInvitation($id){
        $invite = $this->Courses->CourseEnrolledUsers->get($id, ['contain' => ['CourseEnrolledModules']]);
        $patched = [
            'status' => 'accepted'
        ];
        $course_enrolled_modules = [];
        foreach($invite->course_enrolled_modules as $index=>$module){
            $course_enrolled_module = [
                'course_module_id' => $module->course_module_id,
                'status' => 'accepted'
            ];
            array_push($course_enrolled_modules, $course_enrolled_module);
        }
        $patched['course_enrolled_modules'] = $course_enrolled_modules;
        $this->Courses->CourseEnrolledUsers->patchEntity($invite, $patched, ['associated' => ['CourseEnrolledModules']]);
        if($this->Courses->CourseEnrolledUsers->save($invite)){
            $this->Flash->success(__('Invitation Accepted'));
            return $this->redirect($this->referer());
        }
    }

    public function inviteUsers(){
        $courses = $this->Courses->find()->contain([
            'Modules'
        ])->toArray();

        $this->set(compact('courses'));
        $this->set('_serialize', ['courses']);
    }

    public function refreshStudentOptions(){
        $this->viewBuilder()->layout('ajax');
        $modules = $this->request->query('modules');
        $students = $this->getUnenrolled($modules);
        $result = json_encode($students);
        $this->response->type('json');
        $this->response->body($result);
        $this->response->statusCode(200);
        return $this->response;
    }

    //Get list of user_ids of users who have not done the modules
    public function getUnenrolled($modules){
        $course_enrolled_modules = $this->Courses->CourseEnrolledUsers->CourseEnrolledModules
            ->find()
            ->where(['course_module_id IN' => $modules])
            ->extract('course_enrolled_user_id')
            ->toArray();

        $students_id = [];
        if(!empty($course_enrolled_modules)){

            $students_id = $this->Courses->CourseEnrolledUsers->find()
                ->where(['id IN' => $course_enrolled_modules])
                ->extract('user_id')
                ->toArray();
        }

        $students = $this->Courses->CourseEnrolledUsers->Users->find('list');
        if(!empty($students_id)){
            $students = $students->where(['Users.id NOT IN' => $students_id,'active'=>true]);
        }

        //$students = $students->where(['group_id' => 6]);
        return $students;
    }

    private function sendEmailInvite($email){
        return true;
        // $this->loadModel('Tokens');
        // $token = $this->Tokens->generate('email_invite');

        // if(!$token){
        //     return false;
        // }
        
        // $link = array_merge(['controller'=>'Users','action'=>'Registration','email'=>$email],$token);

        // define data to be read by template
        $userDataArr = array(
            'link' => Router::url(['controller'=>'Users','action'=>'Add','email'=>$email], true ),    
        );

        // compile and send email
        $emailTemplate = 'email_invite';
        $emailTo = $email;
        $emailName = $email;
        $emailSubject = 'You have been invited to create a user account at toro';
        $this->emailTo($userDataArr, $emailTemplate, $emailTo, $emailName, $emailSubject);
    }
}
