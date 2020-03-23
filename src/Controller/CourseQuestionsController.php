<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\Query;
use Cake\Filesystem\File;
/**
 * CourseQuestions Controller
 *
 * @property \App\Model\Table\CourseQuestionsTable $CourseQuestions
 * 
 * @method \App\Model\Entity\CourseQuestion[] paginate($object = null, array $settings = [])
 */
class CourseQuestionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['CourseTests', 'CourseQuestionTypes', 'Answers', 'CourseQuestionChoices']
        ];
        $courseQuestions = $this->paginate($this->CourseQuestions->find()->order(['position']));
        $this->set(compact('courseQuestions'));
        $this->set('_serialize', ['courseQuestions']);
        
    }

    /**
     * View method
     *
     * @param string|null $id Course Question id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $courseQuestion = $this->CourseQuestions->get($id, [
            'contain' => ['CourseTests', 'CourseQuestionTypes', 'Answers', 'CourseQuestionChoices']
        ]);
        // echo dump($courseQuestion);exit;
        $this->set('courseQuestion', $courseQuestion);
        $this->set('_serialize', ['courseQuestion']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($courseTestID = null)
    {
        $courseTests = $this->CourseQuestions->CourseTests->find('list', ['limit' => 200])->toArray();
        (!array_key_exists($courseTestID, $courseTests)) ? $courseTestID = false : '';
        $courseQuestion = $this->CourseQuestions->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            // dump($data);exit;
            $courseQuestion = $this->CourseQuestions->patchEntity($courseQuestion, $data, [
                'associated' => ['CourseQuestionChoices']
            ]);
            if ($this->CourseQuestions->save($courseQuestion)) {
                $data = $data;
                $this->Flash->success(__('The course question has been saved.'));
                if($courseTestID){
                    return $this->redirect(['controller' => 'Tests', 'action' => 'view', $courseTestID]);
                }
                return $this->redirect(['action' => 'index']);
            }
            // dump($courseQuestion->errors());exit;
            $this->Flash->error(__('The course question could not be saved. Please, try again.'));
        }
        $courseQuestionTypes = $this->CourseQuestions->courseQuestionTypes->find('list', ['limit' => 200]);
        $Choices = [];
        $this->set(compact('courseQuestion', 'courseTests', 'Choices', 'courseQuestionTypes', 'courseTestID'));
        $this->set('_serialize', ['courseQuestion']);
    }
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function practicaladd($courseTestID = null)
    {
        $courseTests = $this->CourseQuestions->CourseTests->find('list', ['limit' => 200])->toArray();
        (!array_key_exists($courseTestID, $courseTests)) ? $courseTestID = false : '';
        $courseQuestion = $this->CourseQuestions->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            // dump($data);exit;
            $courseQuestion = $this->CourseQuestions->patchEntity($courseQuestion, $data, [
                'associated' => ['CourseQuestionChoices']
            ]);
            if ($this->CourseQuestions->save($courseQuestion)) {
                $data = $data;
                $this->Flash->success(__('The course question has been saved.'));
                if($courseTestID){
                    return $this->redirect(['controller' => 'Tests', 'action' => 'view', $courseTestID]);
                }
                return $this->redirect(['action' => 'index']);
            }
            // dump($courseQuestion->errors());exit;
            $this->Flash->error(__('The course question could not be saved. Please, try again.'));
        }
        $courseQuestionTypes = $this->CourseQuestions->courseQuestionTypes->find('list', ['limit' => 200]);
        $Choices = [];
        $this->set(compact('courseQuestion', 'courseTests', 'Choices', 'courseQuestionTypes', 'courseTestID'));
        $this->set('_serialize', ['courseQuestion']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Course Question id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $courseQuestion = $this->CourseQuestions->get($id, [
            'contain' => ['CourseTests', 'CourseQuestionTypes', 'Answers', 'CourseQuestionChoices']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $courseQuestion = $this->CourseQuestions->patchEntity($courseQuestion, $this->request->getData(), [
                'associated' => ['answers']
            ]);
            // dump($courseQuestion);exit; 
            if ($this->CourseQuestions->save($courseQuestion)) {
                $this->Flash->success(__('The course question has been saved.'));

                return $this->redirect(['action' => 'view',$id]);
            }
            $this->Flash->error(__('The course question could not be saved. Please, try again.'));
        }
        $courseTests = $this->CourseQuestions->CourseTests->find('list', ['limit' => 200]);
        $courseQuestionTypes = $this->CourseQuestions->courseQuestionTypes->find('list', ['limit' => 200]);
        $Choices = $this->CourseQuestions->CourseQuestionChoices->find('list', ['limit' => 200])->where(['course_question_id' => $id]);
        $this->set(compact('courseQuestion', 'courseTests','courseQuestionTypes', 'Choices', 'courseQuestionAnswers'));
        $this->set('_serialize', ['courseQuestion']);
        // dump($courseTests);exit;
    }

    /**
     * Delete method
     *
     * @param string|null $id Course Question id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $courseQuestion = $this->CourseQuestions->get($id);
        if ($this->CourseQuestions->delete($courseQuestion)) {
            $this->Flash->success(__('The course question has been deleted.'));
        } else {
            $this->Flash->error(__('The course question could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function reorder($id){
        $courseQuestion = $this->CourseQuestions->get($id);
        
        $group = $this->Auth->user('group_id');
        
        if($this->request->query('position')){
            $courseQuestion->position = (int) $this->request->query('position');
            ($this->CourseQuestions->save($courseQuestion)) ? $message = 'success' : $message = 'failed' ;
            $result = array('message' => $message);
            $this->response->type('json');
            $this->response->body(json_encode($result));
            return $this->response;
        }
    }
}