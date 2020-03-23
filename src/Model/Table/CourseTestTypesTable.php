<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CourseTestTypes Model
 *
 * @property \App\Model\Table\CourseTestsTable|\Cake\ORM\Association\HasMany $CourseTests
 *
 * @method \App\Model\Entity\CourseTestType get($primaryKey, $options = [])
 * @method \App\Model\Entity\CourseTestType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CourseTestType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CourseTestType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CourseTestType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CourseTestType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CourseTestType findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CourseTestTypesTable extends Table
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

        $this->setTable('course_test_types');
        $this->setDisplayField('value');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('CourseTests', [
            'foreignKey' => 'course_test_type_id'
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
