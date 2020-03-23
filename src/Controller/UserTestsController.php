<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\Query;
use Cake\Event\Event;
/**
 * UserTests Controller
 *
 * @property \App\Model\Table\UserTestsTable $UserTests
 *
 * @method \App\Model\Entity\UserTest[] paginate($object = null, array $settings = [])
 */
class UserTestsController extends AppController
{


    public function initialize()
    {
        parent::initialize();
        $userTestCredentials = $this->request->session()->read('userTestCredentials');
        if($userTestCredentials){
            $this->Auth->allow(['submitUserTest', 'view']);
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $userID = $this->Auth->user('id');     
        $this->paginate = [
            'contain' => [
                'Tests' => function(Query $q) use ($userID){
                    return $q->contain([
                        'Questions' => function(Query $q){
                            return $q->contain(['CourseQuestionChoices', 'Answers', 'UserAnswers']);
                        }
                    ]);
                }]
        ];
        $userTests = $this->paginate($this->UserTests->find()->where(['user_id' => $userID]));
        $this->set(compact('userTests'));
        $this->set('_serialize', ['userTests']);
    }

    /**
     * View method
     *
     * @param string|null $id User Test id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->layout('taro');
        $test = $this->request->session()->read('userTestCredentials');
        if(!$this->Auth->user() || $test){
            $redirect = $this->UserTests->CourseTests->redirectLoggedIn($test);
            ($redirect['error_message']) ? $this->Flash->login_error(__($redirect['error_message'])) : '' ;
            if($redirect['redirect']['controller'] != 'UserTests' && $redirect['redirect']['action'] != 'view'){
                return $this->redirect($redirect['redirect']);
            }
        }
        $userTest = $this->UserTests->get($id, [
            'contain' => ['Users', 'CourseTests', 'UserAnswers', 'UserTestCredentials']
        ]);

        // dump($userTest);exit;
        $questions = $this->UserTests->CourseTests->Questions->find()
        
            ->where(['Questions.course_test_id' => $userTest->course_test->id])->contain([
                'CourseQuestionChoices',
                'Answers',
                'CourseQuestionTypes',
                'UserAnswers' => function(Query $q) use ($userTest){
                    return $q->where(['UserAnswers.user_id' => $userTest->user_id ]);
                }
            ])->order(['position' => 'ASC'])->toArray();
        $this->set(compact(['userTest','questions', 'test']));
        $this->set('_serialize', ['userTest']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userTest = $this->UserTests->newEntity();
        if ($this->request->is('post')) {
            $userTest = $this->UserTests->patchEntity($userTest, $this->request->getData());
            if ($this->UserTests->save($userTest)) {
                $this->Flash->success(__('The user test has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user test could not be saved. Please, try again.'));
        }
        $users = $this->UserTests->Users->find('list', ['limit' => 200]);
        $courseTests = $this->UserTests->Tests->find('list', ['limit' => 200]);
        $this->set(compact('userTest', 'users', 'courseTests'));
        $this->set('_serialize', ['userTest']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Test id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userTest = $this->UserTests->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userTest = $this->UserTests->patchEntity($userTest, $this->request->getData());
            if ($this->UserTests->save($userTest)) {
                $this->Flash->success(__('The user test has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user test could not be saved. Please, try again.'));
        }
        $users = $this->UserTests->Users->find('list', ['limit' => 200]);
        $courseTests = $this->UserTests->CourseTests->find('list', ['limit' => 200]);
        $this->set(compact('userTest', 'users', 'courseTests'));
        $this->set('_serialize', ['userTest']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Test id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userTest = $this->UserTests->get($id);
        if ($this->UserTests->delete($userTest)) {
            $this->Flash->success(__('The user test has been deleted.'));
        } else {
            $this->Flash->error(__('The user test could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function submitUserTest()
    {
        $this->viewBuilder()->layout('ajax');
        $this->response->type('json');

        //Make sure user is authorised
        $userTestCredentials = $this->request->session()->read('userTestCredentials');

        if(!$userTestCredentials){ //Test has session
            $this->response->body(json_encode([
                'message' => 'Not logged in',
                'status'    => 'invalid',
            ]));
            $this->response->statusCode(401);//Unauthorized
            return $this->response;
        }

        $request  = $this->request->getData();

        //Check if correct user
        if($userTestCredentials->user_test_id != $request['id']){
            $this->response->body(json_encode([
                'message' => 'Test ID not matching',
                'status'    => 'invalid',
            ]));
            $this->response->statusCode(401);//Unauthorized
            return $this->response;
        }
        
        $userTest = $this->UserTests->get($request['id'], [
            'contain' => [
                'CourseTests',
                'Users',
                'UserAnswers' => function(Query $q) {
                    return $q->group(['question_id']);
                }
            ]
        ]);


        $questions = $this->UserTests->CourseTests->Questions->find()
        ->where(['Questions.course_test_id' => $userTest->course_test->id])->contain([
            'CourseQuestionChoices',
            'Answers',
            // 'user_answers',
            'CourseQuestionTypes',
            'UserAnswers' => function(Query $q) use ($userTest){
                return $q->where(['UserAnswers.user_id' => $userTest->user_id ]);
            }
        ])->toArray();
        
        // dump($questions);
        $initial_result = $this->UserTests->evaluate($questions);
        foreach($initial_result['questions'] as $question){
            unset($question['answers']);
        }
        if($initial_result['unanswered'] || $initial_result['wrong']){
            $result = array(
                'message' => 'Please finish the exam or repeat wrong answers before submitting.',
                'status'    => 'invalid',
                'data'    => $initial_result
            );          
            $code = 200;  
        }
        else{ 
            if ($this->request->is(['patch', 'post', 'put'])) {
                $userTest = $this->UserTests->get($request['id']);
                $userTest = $this->UserTests->patchEntity($userTest, $request);
                if ($this->UserTests->save($userTest)) {
                    $this->UserTests->sendExamFinishedNotification($request['id'], $request['user_id']);                    
                    $result = array(
                        'message'   => 'successfully submitted the exam',
                        'status'    => 'submitted',
                        'data'    => []
                    );
                    $code = 200;
                }else{
                    $result = array(
                        'message' => 'The test could not be saved.',
                        'status'    => 'error',
                        'data'    => []
                    );          
                    $code = 200;  
                }

            }
        }


        $result = json_encode($result);
       
        $this->response->body($result);
        $this->response->statusCode($code);
        return $this->response;
    }

    public function clview($id){
        // dump($id);exit;
        $userTest = $this->UserTests->get($id, [
            'contain' => [
                'CourseTests',
                'Users',
                'UserAnswers' => function(Query $q) {
                    return $q->group(['question_id']);
                }
            ]
        ]);
        // dump($userTest); exit;
        $test_id = $userTest->course_test->id;
        $conditions = [];
        $contain = [
            'CourseQuestionChoices',
            'Answers',
            'CourseQuestionTypes',
            'UserAnswers' => function(Query $q) use ($userTest){
                return $q->where(['UserAnswers.user_id' => $userTest->user_id ]);
            }
        ];
        $questions = $this->UserTests->CourseTests->getRelatedQuestions($test_id, $conditions, $contain);

        $initial_result = $this->UserTests->clevaluate($questions);
        // dump($questions);
        // exit;

        $this->set(compact(['userTest','initial_result']));
        $this->set('_serialize', ['userTest']);
    }


    public function check($id) {

        $userTest = $this->UserTests->get($id, [
            'contain' => [
                'CourseTests',
                'Users',
                'UserAnswers' => function(Query $q) {
                    return $q->group(['question_id']);
                }
            ]
        ]);
        // dump($userTest); exit;
        $test_id = $userTest->course_test->id;
        $conditions = [];
        $contain = [
            'CourseQuestionChoices',
            'Answers',
            'CourseQuestionTypes',
            'UserAnswers' => function(Query $q) use ($userTest){
                return $q->where(['UserAnswers.user_id' => $userTest->user_id ]);
            }
        ];
        $questions = $this->UserTests->CourseTests->getRelatedQuestions($test_id, $conditions, $contain);

        $initial_result = $this->UserTests->evaluate($questions);

        $this->set(compact(['userTest','initial_result']));
        $this->set('_serialize', ['userTest']);
    }

    public function submitPracticalTest(){
        $this->viewBuilder()->layout('ajax');
        $request  = $this->request->getData();
        $query = $this->UserTests->query();
        // dump($request);exit;    
        if ($this->request->is(['patch', 'post', 'put'])) {
                $userTest = $this->UserTests->get($request['user_tests_id'], [
                    'contain' => [
                        'UserAnswers' => function(Query $q) {
                            return $q->group(['question_id']);
                        }
                    ]
                ]);
                // dump($userTest->user_answers);exit;  
            foreach ($userTest->user_answers as $key => $value) {
                $data[] = $value['result'];
            }
            // dump($data);exit;
            
            if (in_array('wrong', $data, true)) {
                $status = 'failed';
            }else{
                $status = 'passed';
            }   

            // dump($userTest->user_answers[0]->answer_content);exit;

        if($request['user_tests_id']){
            $query->update()
            ->set(['status' => $status, 'user_id' => $request['user_id'], 'course_test_id' => $request['id']])
            ->where([
                'id' => $request['user_tests_id']])
            ->execute();
            
            if ($query) {          
              
                $result = array(
                    'message'   => 'successfully submitted the Test',
                    'status'    => 'submitted',
                    'data'    => []
                );
                $code = 200;
            }else{
                $result = array(
                    'message' => 'The test could not be saved.',
                    'status'    => 'error',
                    'data'    => []
                );          
                $code = 500;  
            }
        }
           
       }
        $result = json_encode($result);
        $this->response->type('json');
        $this->response->body($result);
        $this->response->statusCode($code);
        return $this->response;
    }

    public function test(){
        $this->viewBuilder()->layout('ajax');
        $request = $this->request->getData();
        $userTest = $this->UserTests->get($request['id']);
        $userTest = $this->UserTests->patchEntity($userTest, $request);
        if($this->UserTests->save($userTest)){
            $result = array(
                'message'   => 'The user test has been saved.'  ,
            );
            $code = 200;
            $this->loadModel('Alerts');
            $alert = $this->Alerts->newEntity();
            
            $data = array(
                'title' => 'You '. $request['status']. ' an exam',
                'controller' => 'UserTests',
                'item' => $request['id'],
                'user_id' => $userTest->user_id,
                'link' => '/user-tests/view/'.$request['id'],
                'type' => 'UserTest',
                'active' => 1,
            );
            $alert = $this->Alerts->patchEntity($alert, $data);
            $this->Alerts->save($alert);
        }
        else{
            $result = array(
                'message' => 'The user test could not be saved.'  
            );          
            $code = 500;  
        }

        $result = json_encode($result);
        $this->response->type('json');
        $this->response->body($result);
        $this->response->statusCode($code);
        
        return $this->response;
    }

    function openUserTest(){
        $request = $this->request;
            $data = [
                'user_id' => $request->query('student_id'),
                'status' => 'open',
                'course_test_id' => $request->query('test_id'),
                'user_test_credential' => [
                    'login_id' => $request->query('test_id').$request->query('student_id'),
                    'login_pin' => $this->generateRandomPassword(),
                    'date_opened' =>  new \DateTime()
                ],
                'CourseTests'
            ];

            $userTest = $this->UserTests->newEntity();
            $userTest = $this->UserTests->patchEntity($userTest, $data,[
                'associated' => ['UserTestCredentials']
            ]);

            if($this->UserTests->save($userTest)){
                $userTest = $this->UserTests->get($userTest->id, [
                    'contain' => ['UserTestCredentials', 'Users']
                ]);
                $code = 200;
            }
            else
            {
                $userTest = [
                    'message' => 'Error generating credentials. please try again'
                ];
                $code = 500;
            }
            
        
        $result = json_encode($userTest);
        $this->response->type('json');
        $this->response->body($result);
        $this->response->statusCode($code);
        return $this->response;
    }

    function generateRandomPassword() {
        $alphabet = '1234567890';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 6; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }

    function disableUserTest($request){
        $userTestID = (int)$request->query('user_test_id');
        $userTest = $this->UserTests->setUserTestStatus($userTestID, 'disabled', ['UserTestCredentials', 'Users']);
        $result = json_encode($userTest);
        $this->response->type('json');
        $this->response->body($result);
        $this->response->statusCode(200);
        return $this->response;
    }

    public function reopenUserTest($request){
        $userTestID = $request->query('user_test_id');
        $userTest = $this->UserTests->setUserTestStatus($userTestID, 'open', ['UserTestCredentials', 'Users']);
        $result = json_encode($userTest);
        $this->response->type('json');
        $this->response->body($result);
        $this->response->statusCode(200);
        return $this->response;
    }

    public function changeUserTestStatus(){
        $this->viewBuilder()->layout('ajax');
        $request = $this->request;
        // dump($request);
        $status = $request->query('status');
        if($status == 'open'){
            $response = $this->openUserTest($request);
        }else if($status == 'disable'){
            $response = $this->disableUserTest($request);
        }
        else if($status == 'reopen'){
            $response = $this->reopenUserTest($request);
        }

        return $response;
    }

    public function getCredentials(){
        $request = $this->request;
        $creds = $this->UserTests->get($request->query('user_test_id'),[
            'contain' => ['UserTestCredentials', 'Users']
        ]);
        $result = json_encode($creds);
        $this->response->type('json');
        $this->response->body($result);
        $this->response->statusCode(200);
        return $this->response;
    }

}
