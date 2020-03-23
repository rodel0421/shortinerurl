<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * UserTests Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\CourseTestsTable|\Cake\ORM\Association\BelongsTo $CourseTests
 * @property \App\Model\Table\UserAnswersTable|\Cake\ORM\Association\HasMany $UserAnswers
 *
 * @method \App\Model\Entity\UserTest get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserTest newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserTest[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserTest|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserTest patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserTest[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserTest findOrCreate($search, callable $callback = null, $options = [])
 */
class UserTestsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('user_tests');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('CourseTests', [
            'className' => 'Tests',
            'foreignKey' => 'course_test_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('UserAnswers', [
            'foreignKey' => ['user_test_id','user_id'],
            'bindingKey' => ['id','user_id'],
            'saveStrategy' => 'replace'
        ]);
        
        $this->hasOne('UserTestCredentials');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('status');

        $validator
            ->allowEmpty('answer');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['course_test_id'], 'CourseTests'));

        return $rules;
    }
/*
    public function afterSave($event, $entity, $options) {

        //Only process if there is a change and it is set to passed
        if(!($entity->dirty('status') && $entity->status == 'passed')){
            return true;
        }
                
        //Find other tests in course
        $course_test = $this->CourseTests->get($entity->course_test_id);
        //Get list of other tests
        $otherTests = $this->CourseTests->find()
            ->where([
                'course_module_id'=>$course_test->course_module_id,
                'active'=>true
            ])
            ->extract('id');

        //Check all tests have passed
        $FailedTests = $this->find()
            ->where([
                'user_id'=>$entity->user_id,
                'id IN ('.implode(',',$otherTests).')',
                'status !'=>'passed'
            ])->toArray();

        //If there are no failed / incomplete tests for this module
        //Then create the register
        if(!$FailedTests){
            $module = $this->CourseTests->Modules->get($course_test->course_module_id);

            if(!$module->register_class_id){
                return true;//No register so nothing to do
            }
            
            $this->Registers = TableRegistry::get('Registers');

            $registerClass =  $this->Registers->RegisterClasses->get($module->register_class_id,['contain'=>['RegisterTemplates']]);

            $register = $this->Registers->newEntity([
                'register_template_id'=>$registerClass->register_template_id,
                'user_id'=>$entity->user_id,
                'register_class_id'=>$registerClass->id,
                'status'=>'Registered',
                'active'=>true
            ]);

            return $this->Registers->save($register);//Save register
        }

        return true;
        
    }*/

    public function checkExpired($userTest){
        if($userTest->status == 'open'){
            if($userTest->user_test_credential){
                $open_until = new \DateTime(date_format($userTest['user_test_credential']['date_opened'], 'Y-m-d H:i:s'));
            }else{
                $userTest1 = $this->get($userTest->id,[
                    'contain' => 'UserTestCredentials'
                ])->toArray();
                $open_until = new \DateTime(date_format($userTest1['user_test_credential']['date_opened'], 'Y-m-d H:i:s'));
            }
            $open_until->add(new \DateInterval("PT8H"));
            $date_now = new \DateTime();
            if($open_until <= $date_now){
                $userTest->status = 'expired';
                $this->save($userTest);
            }
        }
        return $userTest;
    }

    public function clevaluate(Array $questions){
        // dump($questions); exit;
        $correct = 0;
        $wrong = 0;
        $unchecked = 0;
        $unanswered = 0;
        //    dump($questions); exit; 
        foreach($questions as $index=>$question){
            // dump($question);
            // dump($question['user_answers'][0]['answer_id']);
            // dump($question['user_answers']); exit;
            // dump($question['user_answers'][0]); exit;
            if($question['course_question_type']['value'] == 'Multiple Choice'){
                if(isset($question['user_answers'][0])){
            
                    if($question['user_answers'][0]['result'] == "correct"){

                        $questions[$index]['status'] = 'correct';
                        $correct++;
                    }else{
                        $questions[$index]['status'] = 'wrong';
                        $wrong++;
                    }
                }
                else{
                    $questions[$index]['status'] = 'unanswered';
                    $unanswered++;
                }
            }else{
                if(isset($question['user_answers'][0])){
                    if($question['user_answers'][0]['result'] == 'unchecked') {
                        $question['user_answers'][0]['result'] = 'unchecked';
                        $questions[$index]['status'] = 'unchecked';
                        $unchecked++;
                    }
                    elseif($question['user_answers'][0]['result'] == 'correct') {
                        $questions[$index]['status'] = 'correct';
                        $correct++;
                    }
                    elseif($question['user_answers'][0]['result'] == 'wrong') {
                        $questions[$index]['status'] = 'wrong';
                        $wrong++;
                    }
                }
                else{
                    $questions[$index]['status'] = 'unanswered';
                    $unanswered++;
                }
            }
        }
        ((($correct / count($questions)) * 100 ) >= 75) ? $remarks = 'passed' : $remarks =  'failed';
        $initial_result = array(
            'correct' => $correct,
            'wrong' => $wrong,
            'unchecked' => $unchecked,
            'unanswered' => $unanswered,
            'remarks' => $remarks
        );
        $initial_result['questions'] = $questions;
        return $initial_result;
    }

    public function evaluate(Array $questions){
        // dump($questions); exit;
        $correct = 0;
        $wrong = 0;
        $unchecked = 0;
        $unanswered = 0;
        //    dump($questions); exit; 
        foreach($questions as $index=>$question){
            // dump($question);
            // dump($question['user_answers'][0]['answer_id']);
            // dump($question['user_answers']); exit;
            // dump($question['user_answers'][0]); exit;
            if($question['course_question_type']['value'] == 'Multiple Choice'){
                if(isset($question['user_answers'][0]) && isset($question['answers'][0]['id'])){
            
                    if($question['user_answers'][0]['answer_id'] == $question['answers'][0]['id']){

                        $questions[$index]['status'] = 'correct';
                        $correct++;
                    }else{
                        $questions[$index]['status'] = 'wrong';
                        $wrong++;
                    }
                }
                else{
                    $questions[$index]['status'] = 'unanswered';
                    $unanswered++;
                }
            }else{
                if(isset($question['user_answers'][0])){
                    if($question['user_answers'][0]['result'] == 'unchecked') {
                        $question['user_answers'][0]['result'] = 'unchecked';
                        $questions[$index]['status'] = 'unchecked';
                        $unchecked++;
                    }
                    elseif($question['user_answers'][0]['result'] == 'correct') {
                        $questions[$index]['status'] = 'correct';
                        $correct++;
                    }
                    elseif($question['user_answers'][0]['result'] == 'wrong') {
                        $questions[$index]['status'] = 'wrong';
                        $wrong++;
                    }
                }
                else{
                    $questions[$index]['status'] = 'unanswered';
                    $unanswered++;
                }
            }
        }
        ((($correct / count($questions)) * 100 ) >= 75) ? $remarks = 'passed' : $remarks =  'failed';
        $initial_result = array(
            'correct' => $correct,
            'wrong' => $wrong,
            'unchecked' => $unchecked,
            'unanswered' => $unanswered,
            'remarks' => $remarks
        );
        $initial_result['questions'] = $questions;
        return $initial_result;
    }
  
    public function sendExamFinishedNotification($userTestID, $userID){
        $this->Alerts = TableRegistry::get('Alerts');
        $userTest = $this->get($userTestID, [
                'contain' => ['CourseTests']
            ]);
        $user = $this->Users->get($userID);
        $trainers = $this->Users->find()->where(['group_id' => 2])->toArray();
        foreach($trainers as $trainer){
            $alert = $this->Alerts->newEntity();
            $data = array(
                'title' => $user->name. ' submitted the exam "'. $userTest->course_test->name.'"',
                'controller' => 'UserTests',
                'item' => $userTestID,
                'user_id' => $trainer->id,
                'link' => '/user-tests/check/'.$userTestID,
                'type' => 'UserTest',
                'active' => 1,
            );
            $alert = $this->Alerts->patchEntity($alert, $data);
            $this->Alerts->save($alert);
        }
    }

    public function setUserTestStatus(int $id, string $status,Array $contain = []){
        $userTest = $this->get($id, [
            'contain' => $contain
        ]);

        if($status == 'open'){
            $utc = $this->UserTestCredentials->get($userTest->user_test_credential->id);
            $utc->date_opened = new \DateTime();
            $this->UserTestCredentials->save($utc);
            $userTest->user_test_credential = $utc;
        }

        $userTest->status = $status;

        $this->save($userTest);
        return $userTest;
    }

}