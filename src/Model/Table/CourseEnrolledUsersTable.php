<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CourseEnrolledUsers Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\CoursesTable|\Cake\ORM\Association\BelongsTo $Courses
 * @property \App\Model\Table\CourseEnrolledModulesTable|\Cake\ORM\Association\HasMany $CourseEnrolledModules
 * @property \App\Model\Table\CourseEnrolledTestsTable|\Cake\ORM\Association\HasMany $CourseEnrolledTests
 *
 * @method \App\Model\Entity\CourseEnrolledUser get($primaryKey, $options = [])
 * @method \App\Model\Entity\CourseEnrolledUser newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CourseEnrolledUser[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CourseEnrolledUser|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CourseEnrolledUser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CourseEnrolledUser[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CourseEnrolledUser findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CourseEnrolledUsersTable extends Table
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

        $this->setTable('course_enrolled_users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Courses', [
            'foreignKey' => 'course_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('CourseEnrolledModules', [
            'foreignKey' => 'course_enrolled_user_id',
            'saveStrategy' => 'replace'
        ]);
        $this->hasMany('CourseEnrolledTests', [
            'foreignKey' => 'course_enrolled_user_id'
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
            ->date('date_start')
            ->allowEmpty('date_start');

        $validator
            ->date('date_complete')
            ->allowEmpty('date_complete');

        $validator
            ->allowEmpty('status');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['course_id'], 'Courses'));

        return $rules;
    }

    public function isUserEnrolled($userID, $courseID)
    {
        return $this->exists(['user_id' => $userID, 'course_id' => $courseID, 'status !=' => 'invited']);
    }
}
