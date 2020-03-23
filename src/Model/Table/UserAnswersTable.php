<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use ArrayObject;
/**
 * UserAnswers Model
 *
 * @property \App\Model\Table\UserTestsTable|\Cake\ORM\Association\BelongsTo $UserTests
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\QuestionsTable|\Cake\ORM\Association\BelongsTo $Questions
 * @property \App\Model\Table\AnswersTable|\Cake\ORM\Association\BelongsTo $Answers
 *
 * @method \App\Model\Entity\UserAnswer get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserAnswer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserAnswer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserAnswer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserAnswer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserAnswer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserAnswer findOrCreate($search, callable $callback = null, $options = [])
 */
class UserAnswersTable extends Table
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

        $this->setTable('user_answers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('UserTests', [
            'foreignKey'    => 'user_test_id',
            'joinType'      => 'INNER'
        ]);

        $this->belongsTo('Users', [
            'foreignKey'    => 'user_id'
        ]);

        $this->belongsTo('CourseQuestions', [
            'foreignKey'    => 'question_id',
            'joinType'      => 'INNER'
        ]);

        $this->belongsTo('Answers', [
            'className'     => 'CourseQuestionChoices',
            'foreignKey'    => 'answer_id',
            'joinType'      => 'INNER'
        ]);
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
            ->allowEmpty('result');

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
        $rules->add($rules->existsIn(['user_test_id'], 'UserTests'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['question_id'], 'CourseQuestions'));
        $rules->add($rules->existsIn(['answer_id'], 'Answers'));

        return $rules;
    }

    public function isExisting($userID = null, $questionID = null, $userTestID = null){
        $toCheck = [];
        (isset($userID)) ? $toCheck['user_id'] = $userID : '';
        (isset($questionID)) ? $toCheck['question_id'] = $questionID : '';
        (isset($userTestID)) ? $toCheck['user_test_id'] = $userTestID : '';
        $exists = $this->exists($toCheck);
        if($exists){
            $result =  $this->find()->where($toCheck)->first();
            return $result;
        }
        return $exists;
    }

    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options){
        if(isset($data['answer_id'])){
            return $data;
        }
        if(isset($data['question-'.$data['question_id'].'_choice'])){
            $data['answer_id'] = $data['question-'.$data['question_id'].'_choice'];
            unset($data['question-'.$data['question_id'].'_choice']);
        }
    }    
}
