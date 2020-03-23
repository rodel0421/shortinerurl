<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
/**
 * Tests Controller
 *
 * @property \App\Model\Table\TestsTable $Tests
 * @property \App\Model\Table\UserTestsTable $UserTests
 * @property \App\Model\Table\UserAnswersTable $UserAnswers
 * @property \App\Model\Table\EvidenceTable $evidence
 * 
 *
 * @method \App\Model\Entity\Test[] paginate($object = null, array $settings = [])
 */
class TestsController extends AppController
{


    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['takeTest', 'logout', 'login']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => 'CourseTestTypes'
        ];
        $tests = $this->paginate($this->Tests);
        $this->set(compact('tests'));
        $this->set('_serialize', ['tests']);
    }

    /**
     * View method
     *
     * @param string|null $id Test id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $test = $this->Tests->get($id, [
            'contain' => [
                'Questions' => function(Query $q){
                    return $q->contain(['CourseQuestionTypes', 'Answers','CourseQuestionChoices']);
                }, 
                'Modules',
                'CourseTestTypes'
            ]
        ]);
        $this->set('test', $test);
        $this->set('_serialize', ['test']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($moduleID = null)
    {
        $test = $this->Tests->newEntity();
        $modules = $this->Tests->Modules->find('list', ['limit' => 200])->toArray();
        (!array_key_exists($moduleID, $modules)) ? $moduleID = false : '';
        if ($this->request->is('post')) {
            $test = $this->Tests->patchEntity($test, $this->request->getData());
            if ($this->Tests->save($test)) {
                $this->Flash->success(__('The test has been saved.'));
                if($moduleID){
                    return $this->redirect(['controller' => 'Modules', 'action' => 'view', $moduleID]);
                }
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The test could not be saved. Please, try again.'));
        }
        $types = $this->Tests->CourseTestTypes->find('list', ['limit' => 200]);
        if(!$moduleID){
            $moduleID = false;
        }
        $this->set(compact('test','modules', 'types', 'moduleID'));
        $this->set('_serialize', ['test']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Test id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $test = $this->Tests->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $test = $this->Tests->patchEntity($test, $this->request->getData());
            if ($this->Tests->save($test)) {
                $this->Flash->success(__('The test has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The test could not be saved. Please, try again.'));
        }
        $modules = $this->Tests->Modules->find('list', ['limit' => 200]);
        $types = $this->Tests->CourseTestTypes->find('list', ['limit' => 200]);
        $this->set(compact('test','modules', 'types'));
        $this->set('_serialize', ['test']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Test id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $test = $this->Tests->get($id);
        if ($this->Tests->delete($test)) {
            $this->Flash->success(__('The test has been deleted.'));
        } else {
            $this->Flash->error(__('The test could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function takeTest()
    {
        // echo "test";
        // exit;
        $this->viewBuilder()->setLayout('taro');
        //Check that it is valid
        $redirect = $this->Tests->redirectLoggedIn($this->request->session()->read('userTestCredentials'));

        if($redirect['redirect']['action'] == 'takeTest'){
            $open_until = $redirect['open_until'];
            $timezone = $redirect['timezone'];
        }else{
            ($redirect['error_message']) ? $this->Flash->login_error(__($redirect['error_message'])) : '' ;
            return $this->redirect($redirect['redirect']);
            
        }
        $userTest = $this->Tests->UserTests->get($redirect['usertest_credential_id'],[
            'contain' => [
                'CourseTests' => function(Query $q){
                    return $q->contain([
                        'Questions' => [ 
                            'sort' => 'Questions.position',
                            'queryBuilder' => function (Query $q){
                                return $q->contain([
                                    'CourseQuestionChoices',
                                    'Answers',
                                    'CourseQuestionTypes'

                                ]);
                            },
                        ]
                    ]);
                },
                'UserAnswers' =>function(Query $q){
                    return $q->enableHydration(false);
                },
                'Users',
            ]
        ]);
        $this->set(compact('userTest', 'open_until', 'timezone'));
    }
    public function checklist($id = null, $student_id = null)
    {
        // dump($this->UserAnswers);
        // exit;
        
        // dump($userAnswersSelect);exit;
        $userTestsTable = TableRegistry::get('UserTests');
        $userTestSelect = $userTestsTable->find()
        ->where(['user_id' => $student_id, 'course_test_id' => $id])
        ->toArray();

        if(empty($userTestSelect)){
            $userTests = $userTestsTable->newEntity();
 
            $userTests->user_id = $student_id;
            $userTests->course_test_id = $id;

            $userTestsTable->save($userTests);
        }
        
        $user_test_id = $userTestSelect[0]->id;

        $UserAnswersTable = TableRegistry::get('UserAnswers');
        $userAnswersSelect = $UserAnswersTable->find()
        ->where(['user_test_id' => $user_test_id])
        ->toArray();
 
        $userTestSelect = $userTestsTable->find()
        ->where(['user_id' => $student_id, 'course_test_id' => $id])
        ->toArray();

        $studentId = $student_id;
        $userTestsId = $userTestSelect[0]->id;
        // dump($this->Tests);exit; 
        $tests = $this->Tests->get($id, [
            'contain' => [
                'Questions' => function(Query $q){
                    return $q->contain(['CourseQuestionTypes', 'Answers',
                    'CourseQuestionChoices' => ['sort' => ['CourseQuestionChoices.id' => 'DESC']]]);
                }, 
                'Modules',
                'CourseTestTypes',
                
            ]
        ]);

        // $query->contain([
        //     'Comments' => [
        //         'sort' => ['Comment.created' => 'DESC']
        //     ]
        // ]);

        // dump($tests);exit;
        $this->set(compact('tests', 'studentId', 'userTestsId','userAnswersSelect'));
    }

    public function manage($id){
        $test = $this->Tests->get($id);
        $module = $this->Tests->Modules->get($test->course_module_id);
        $course_enrolled_user_ids = $this->Tests->Modules->CourseEnrolledModules
        ->find()
        ->where(['course_module_id' => $module->id, 'status' => 'accepted'])
        ->extract('course_enrolled_user_id')->toArray();
        // dump($course_enrolled_user_ids);exit;
        $students = [];
        
        if($course_enrolled_user_ids){
            $student_ids = $this->Tests->Modules->CourseEnrolledModules->CourseEnrolledUsers
                ->find()
                ->where(['id IN' => $course_enrolled_user_ids])
                ->extract('user_id')
                ->toArray();
            $students = $this->Tests->Modules->CourseEnrolledModules->CourseEnrolledUsers->Users
                ->find()
                ->where(['id IN' => $student_ids])
                ->contain([
                    'userTests' => function (Query $q) use ($id){
                        return $q->where(['course_test_id' => $id])
                            ->contain('UserTestCredentials');
                    }
                ])
                ->toArray();
            foreach($students as $index=>$student){
                ($student->user_tests) ? $students[$index]->user_tests[0] = $this->Tests->UserTests->checkExpired($student->user_tests[0]) : '';
            }
        }
        $this->set(compact('test','students'));
      
    }

    public function login(){
        $this->viewBuilder()->setLayout('taro');
        if($this->request->session()->check('userTestCredentials')){
            $this->Flash->login_error(__('Login ID is expired.'));
            return $this->redirect(['action' => 'takeTest']);
        }
        if ($this->request->is('post')) {
            $loginID = $this->request->getData('login_id');
            $loginPin = $this->request->getData('login_pin');

            if(!$this->Tests->UserTests->UserTestCredentials->exists(['login_id' => $loginID, 'login_pin' => $loginPin ])){
                $this->Flash->login_error(__('Invalid id or pin, try again'));
                return $this->redirect($this->referer());
            }
            $userTestCredentials = $this->Tests->UserTests->UserTestCredentials
                ->find()
                ->where([
                    'login_id' => $loginID,
                    'login_pin' => $loginPin
                ])
                ->contain('UserTests')
                ->first();
                
            $userTest = $this->Tests->UserTests->checkExpired($userTestCredentials->user_test);
            $this->request->session()->write('userTestCredentials', $userTestCredentials);
            $redirect = $this->Tests->redirectLoggedIn($userTestCredentials);

            ($redirect['error_message']) ? $this->Flash->login_error(__($redirect['error_message'])) : '' ;

            if($redirect['redirect']['action'] != 'login'){
                return $this->redirect($redirect['redirect']);
            }
        }
    }

    public function logout($submit = false){
        $this->autoRender = false;

        $creds = $this->request->session()->read('userTestCredentials');
        
        if($creds){
            if($submit){
                $usertest = $this->Tests->UserTests->get($creds->user_test->id);
                $usertest->status = 'submitted';
                $this->Tests->UserTests->save($usertest);
                $this->Tests->UserTests->sendExamFinishedNotification($creds->user_test->id, $creds->user_test->user_id);
            }
            $this->request->session()->delete('userTestCredentials');
        }

        
        return $this->redirect(['action' => 'login']);//Allways return to login
        
    }


    public function evidence($id = null, $student_id = null){       
     
        $EvidenceTable = TableRegistry::get('evidence');
        // $UserAnswersTable = TableRegistry::get('UserAnswers');
        $evidenceSelect = $EvidenceTable->find()
        ->where(['user_id' => $student_id, 'course_test_id' => $id])
        ->toArray();
        
        // dump($evidenceSelect[0]->user_test_id);exit;
        $emptyArray = array();
                // dump($emptyArray);exit;
        if($evidenceSelect != $emptyArray ){
        $user_test_id = $evidenceSelect[0]->user_test_id;

        $UserAnswersTable = TableRegistry::get('user_answers');
        // $UserAnswersTable = TableRegistry::get('UserAnswers');
        $UserAnswersSelect = $UserAnswersTable->find()
        ->where(['user_id' => $student_id, 'user_test_id' => $user_test_id])
        ->toArray();

        // dump($UserAnswersSelect);exit;

        $students = $this->Tests->Modules->CourseEnrolledModules->CourseEnrolledUsers->Users
        ->find()
        ->where(['id IN' => $student_id])        
        ->toArray();


        $userTestsTable = TableRegistry::get('UserTests');
        $userTestSelect = $userTestsTable->find()
        ->where(['user_id' => $student_id, 'course_test_id' => $id])
        ->toArray();


        $userTestSelect = $userTestsTable->find()
        ->where(['user_id' => $student_id, 'course_test_id' => $id])
        ->toArray();

        $studentId = $student_id;
        $userTestsId = $userTestSelect[0]->id;
        // dump($this->Tests);exit; 
        $tests = $this->Tests->get($id, [
            'contain' => [
                'Questions' => function(Query $q){
                    return $q->contain(['CourseQuestionTypes', 'Answers',
                    'CourseQuestionChoices' => ['sort' => ['CourseQuestionChoices.id' => 'DESC']]]);
                }, 
                'Modules',
                'CourseTestTypes',
                // 'Answers',
                
            ]
        ]);
        }else{
            $UserAnswersTable = TableRegistry::get('user_answers');
            // $UserAnswersTable = TableRegistry::get('UserAnswers');
            // $UserAnswersSelect = $UserAnswersTable->find()
            // ->where(['user_id' => $student_id, 'user_test_id' => $user_test_id])
            // ->toArray();
    
            // dump($UserAnswersSelect);exit;
    
            $students = $this->Tests->Modules->CourseEnrolledModules->CourseEnrolledUsers->Users
            ->find()
            ->where(['id IN' => $student_id])        
            ->toArray();
    
    
            $userTestsTable = TableRegistry::get('UserTests');
            $userTestSelect = $userTestsTable->find()
            ->where(['user_id' => $student_id, 'course_test_id' => $id])
            ->toArray();
    
    
            $userTestSelect = $userTestsTable->find()
            ->where(['user_id' => $student_id, 'course_test_id' => $id])
            ->toArray();
    
            $studentId = $student_id;
            $userTestsId = $userTestSelect[0]->id;
            // dump($this->Tests);exit; 
            $tests = $this->Tests->get($id, [
                'contain' => [
                    'Questions' => function(Query $q){
                        return $q->contain(['CourseQuestionTypes', 'Answers',
                        'CourseQuestionChoices' => ['sort' => ['CourseQuestionChoices.id' => 'DESC']]]);
                    }, 
                    'Modules',
                    'CourseTestTypes',
                    // 'Answers',
                    
                ]
            ]);
        }

        $this->set(compact('evidenceSelect','students','UserAnswersSelect','tests'));

    }
    
}
