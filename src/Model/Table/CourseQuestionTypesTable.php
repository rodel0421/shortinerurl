<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CourseQuestionTypes Model
 *
 * @property \App\Model\Table\CourseQuestionsTable|\Cake\ORM\Association\HasMany $CourseQuestions
 *
 * @method \App\Model\Entity\CourseQuestionType get($primaryKey, $options = [])
 * @method \App\Model\Entity\CourseQuestionType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CourseQuestionType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CourseQuestionType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CourseQuestionType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CourseQuestionType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CourseQuestionType findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CourseQuestionTypesTable extends Table
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

        $this->setTable('course_question_types');
        $this->setDisplayField('value');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('CourseQuestions', [
            'foreignKey' => 'course_question_type_id'
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
            ->requirePresence('value', 'create')
            ->notEmpty('value');

        return $validator;
    }
}
