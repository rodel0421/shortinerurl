<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CourseQuestionAnswers Model
 *
 * @property \App\Model\Table\CourseQuestionsTable|\Cake\ORM\Association\BelongsTo $CourseQuestions
 * @property \App\Model\Table\ChoicesTable|\Cake\ORM\Association\BelongsTo $Choices
 *
 * @method \App\Model\Entity\CourseQuestionAnswer get($primaryKey, $options = [])
 * @method \App\Model\Entity\CourseQuestionAnswer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CourseQuestionAnswer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CourseQuestionAnswer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CourseQuestionAnswer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CourseQuestionAnswer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CourseQuestionAnswer findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CourseQuestionAnswersTable extends Table
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

        $this->setTable('course_question_answers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('CourseQuestions', [
            'foreignKey' => 'course_question_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Choices', [
            'className' => 'course_question_choices',
            'foreignKey' => 'course_question_choice_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('UserAnswers', [
            'foreignKey' => 'course_question_choice_id',
            'joinType' => 'INNER'
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
        $rules->add($rules->existsIn(['course_question_id'], 'CourseQuestions'));
        $rules->add($rules->existsIn(['course_question_choice_id'], 'Choices'));

        return $rules;
    }
}
