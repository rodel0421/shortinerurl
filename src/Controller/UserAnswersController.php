<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Response;
use Cake\Event\Event;
use Cake\ORM\Query;
/**
 * UserAnswers Controller
 *
 * @property \App\Model\Table\UserAnswersTable $UserAnswers
 * 
 * 
 *
 * @method \App\Model\Entity\UserAnswer[] paginate($object = null, array $settings = [])
 */
class UserAnswersController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        if($this->request->session()->check('userTestCredentials')){
            $this->Auth->allow(['answer']);
        }
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['UserTests', 'Users', 'Questions', 'Answers']
        ];
        $userAnswers = $this->paginate($this->UserAnswers);

        $this->set(compact('userAnswers'));
        $this->set('_serialize', ['userAnswers']);
    }

    /**
     * View method
     *
     * @param string|null $id User Answer id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userAnswer = $this->UserAnswers->get($id, [
            'contain' => ['UserTests', 'Users', 'Questions', 'Answers']
        ]);

        $this->set('userAnswer', $userAnswer);
        $this->set('_serialize', ['userAnswer']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userAnswer = $this->UserAnswers->newEntity();
        if ($this->request->is('post')) {
            $userAnswer = $this->UserAnswers->patchEntity($userAnswer, $this->request->getData());
            if ($this->UserAnswers->save($userAnswer)) {
                $this->Flash->success(__('The user answer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user answer could not be saved. Please, try again.'));
        }
        $userTests = $this->UserAnswers->UserTests->find('list', ['limit' => 200]);
        $users = $this->UserAnswers->Users->find('list', ['limit' => 200]);
        $questions = $this->UserAnswers->Questions->find('list', ['limit' => 200]);
        $answers = $this->UserAnswers->Answers->find('list', ['limit' => 200]);
        $this->set(compact('userAnswer', 'userTests', 'users', 'questions', 'answers'));
        $this->set('_serialize', ['userAnswer']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Answer id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userAnswer = $this->UserAnswers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userAnswer = $this->UserAnswers->patchEntity($userAnswer, $this->request->getData());
            if ($this->UserAnswers->save($userAnswer)) {
                $this->Flash->success(__('The user answer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user answer could not be saved. Please, try again.'));
        }
        $userTests = $this->UserAnswers->UserTests->find('list', ['limit' => 200]);
        $users = $this->UserAnswers->Users->find('list', ['limit' => 200]);
        $questions = $this->UserAnswers->Questions->find('list', ['limit' => 200]);
        $answers = $this->UserAnswers->Answers->find('list', ['limit' => 200]);
        $this->set(compact('userAnswer', 'userTests', 'users', 'questions', 'answers'));
        $this->set('_serialize', ['userAnswer']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Answer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userAnswer = $this->UserAnswers->get($id);
        if ($this->UserAnswers->delete($userAnswer)) {
            $this->Flash->success(__('The user answer has been deleted.'));
        } else {
            $this->Flash->error(__('The user answer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function answerchecklist(){
        $this->viewBuilder()->layout('ajax');
        $request = $this->request->getData();
        $questionChoice = $request['question_choice'];
        // dump($request);exit;
            
            $total = $this->UserAnswers->find()->where(['user_id' => $request['user_id'], 'question_id' => $request['question_id'], 'user_test_id' => $request['user_test_id'], 'answer_id' => $request['question_choice']])->count();

            if($total == '1'){    
                $query = $this->UserAnswers->query()
                ->update()
                ->set(['result' => $request['result']])
                ->where(['user_id' => $request['user_id'], 'question_id' => $request['question_id'], 'user_test_id' => $request['user_test_id'], 'answer_id' => $request['question_choice']])
                ->execute();
                // dump($query);
                // exit;
            }else{
                $query = $this->UserAnswers->query();
                $query->insert(['user_test_id', 'user_id', 'question_id', 'answer_id','result', 'answer_content'])
                ->values([
                    'user_test_id' => $request['user_test_id'],
                    'user_id' => $request['user_id'],
                    'question_id' => $request['question_id'],
                    'answer_id' => $request['question_choice'],
                    'result' => $request['result'],
                    'answer_content' => 'test'
                    ])
                    ->execute();
                }
                // dump($questionChoice[0]);exit;
        if($query){
            $result = array(
                'message'   => 'The answer has been saved.'  ,
                );
                $code = 200;
            }
            else{
                $result = array(
                    'message' => 'The answer could not be saved.',
                );          
                $code = 500;  
            }

        $result = json_encode($result);

        $this->response->type('json');
        $this->response->body($result);
        $this->response->statusCode($code);
        return $this->response; 
        }


    public function answer(){
        //TODO: Validate correct user in $this->request->session()->read('userTestCredentials')
        // Otherwise this is open for hacking
        
        $this->viewBuilder()->layout('ajax');
        $request    = $this->request->getData();
        // dump($request);exit;
        $questionChoice = $request['question_choice'];
        
                $exists     = $this->UserAnswers->isExisting($request['user_id'], $request['question_id'], $request['user_test_id']);
                
                if($exists){
                    $answer = $this->UserAnswers->patchEntity($exists, $request);
                    $method = 'update';
                }else{
                    $answer = $this->UserAnswers->newEntity();
                    $answer = $this->UserAnswers->patchEntity($answer, $request);
                    $method = 'add';
                }
                if($this->UserAnswers->save($answer)){
                    $result = array(
                        'message'   => 'The answer has been saved.'  ,
                        'method'    => $method
                    );
            $code = 200;
        }

    
    $result = json_encode($result);

    $this->response->type('json');
    $this->response->body($result);
    $this->response->statusCode($code);
    return $this->response;
    }

    public function markAnswer($id){
        $this->viewBuilder()->layout('ajax');
        $userAnswer = $this->UserAnswers->get($id);
        $previousMark = $userAnswer->result;
        $userAnswer->result = $this->request->query('mark');

        if($this->UserAnswers->save($userAnswer)){
            $userTest = $this->UserAnswers->UserTests->get($userAnswer['user_test_id'], [
                'contain' => [
                    'CourseTests',
                    'Users',
                    'UserAnswers' => function(Query $q) {
                        return $q->group(['question_id']);
                    }
                ]
            ]);
            $questions = $this->UserAnswers->UserTests->CourseTests->Questions->find()
            ->where(['Questions.course_test_id' => $userTest->course_test->id])->contain([
                'CourseQuestionChoices',
                'Answers',
                'CourseQuestionTypes',
                'UserAnswers' => function(Query $q) use ($userTest){
                    return $q->where(['UserAnswers.user_id' => $userTest->user_id ]);
                }
            ])->toArray();
            
            $result = $this->UserAnswers->UserTests->evaluate($questions);
            $result['user_answer'] = $userAnswer;
            $result['success'] = true;
            unset($result['questions']);
            $code = 200;
        }
        else{
            $result = array(
                'success'   => false,
            );          
            $code = 500;  
        }
        $result = json_encode($result);

        $this->response->type('json');
        $this->response->body($result);
        $this->response->statusCode($code);
        
        return $this->response;


    }

}
