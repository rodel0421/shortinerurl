<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CourseEnrolledModules Model
 *
 * @property \App\Model\Table\CourseEnrolledUsersTable|\Cake\ORM\Association\BelongsTo $CourseEnrolledUsers
 * @property \App\Model\Table\CourseModulesTable|\Cake\ORM\Association\BelongsTo $CourseModules
 *
 * @method \App\Model\Entity\CourseEnrolledModule get($primaryKey, $options = [])
 * @method \App\Model\Entity\CourseEnrolledModule newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CourseEnrolledModule[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CourseEnrolledModule|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CourseEnrolledModule patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CourseEnrolledModule[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CourseEnrolledModule findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CourseEnrolledModulesTable extends Table
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

        $this->setTable('course_enrolled_modules');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('CourseEnrolledUsers', [
            'foreignKey' => 'course_enrolled_user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('CourseModules', [
            'foreignKey' => 'course_module_id',
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

        $validator
            ->allowEmpty('status');

        $validator
            ->date('date_complete')
            ->allowEmpty('date_complete');

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
        $rules->add($rules->existsIn(['course_enrolled_user_id'], 'CourseEnrolledUsers'));
        $rules->add($rules->existsIn(['course_module_id'], 'CourseModules'));

        return $rules;
    }

    public function isUserEnrolled($userID, $moduleID)
    {
        $module = $this->CourseModules->find()->where(['id' => $moduleID])->first();
        if(!$module){
            return false;
        }
        $courseID = $module->course_id;
        $CourseEnrolledUser = $this->CourseModules->Courses->CourseEnrolledUsers->find()->where(['user_id' => $userID, 'course_id' => $courseID, 'status !=' => 'invited'])->first();
        if($CourseEnrolledUser){
            if($this->exists(['course_enrolled_user_id' => $CourseEnrolledUser->id, 'course_module_id' => $moduleID, 'status !=' => 'invited'])){
                return true;
            }
        }
        return false;
    }
}
