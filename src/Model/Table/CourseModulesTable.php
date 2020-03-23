<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CourseModules Model
 *
 * @property \App\Model\Table\CoursesTable|\Cake\ORM\Association\BelongsTo $Courses
 * @property \App\Model\Table\CourseMachineTypesTable|\Cake\ORM\Association\BelongsTo $CourseMachineTypes
 * @property \App\Model\Table\ResourcesTable|\Cake\ORM\Association\BelongsTo $Resources
 * @property \App\Model\Table\CourseEnrolledModulesTable|\Cake\ORM\Association\HasMany $CourseEnrolledModules
 * @property \App\Model\Table\CourseTestsTable|\Cake\ORM\Association\HasMany $CourseTests
 *
 * @method \App\Model\Entity\CourseModule get($primaryKey, $options = [])
 * @method \App\Model\Entity\CourseModule newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CourseModule[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CourseModule|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CourseModule patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CourseModule[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CourseModule findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CourseModulesTable extends Table
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

        $this->setTable('course_modules');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Courses', [
            'foreignKey' => 'course_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('RegisterClasses', [
            'foreignKey' => 'register_class_id'
        ]);

        $this->belongsTo('CourseMachineTypes', [
            'foreignKey' => 'course_machine_types_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Resources', [
            'foreignKey' => 'resources_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('CourseEnrolledModules', [
            'foreignKey' => 'course_module_id'
        ]);
        $this->hasMany('CourseTests', [
            'foreignKey' => 'course_module_id'
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
            ->allowEmpty('name');

        $validator
            ->allowEmpty('code');

        $validator
            ->allowEmpty('description');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active');

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
        $rules->add($rules->existsIn(['course_id'], 'Courses'));
        $rules->add($rules->existsIn(['course_machine_types_id'], 'CourseMachineTypes'));
        $rules->add($rules->existsIn(['resources_id'], 'Resources'));
        $rules->add($rules->existsIn(['register_class_id'], 'RegisterClasses'));

        return $rules;
    }
}
