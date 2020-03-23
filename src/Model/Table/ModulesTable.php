<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Modules Model
 *
 * @property \App\Model\Table\CoursesTable|\Cake\ORM\Association\BelongsTo $Courses
 * @property \App\Model\Table\MachineTypesTable|\Cake\ORM\Association\BelongsTo $MachineTypes
 * @property \App\Model\Table\ResourcesTable|\Cake\ORM\Association\BelongsTo $Resources
 * @property \App\Model\Table\TestsTable|\Cake\ORM\Association\BelongsTo $Tests
 * @property \App\Model\Table\EnrolledModulesTable|\Cake\ORM\Association\HasMany $EnrolledModules
 * @property \App\Model\Table\TestsTable|\Cake\ORM\Association\HasOne $Test
 *
 * @method \App\Model\Entity\Module get($primaryKey, $options = [])
 * @method \App\Model\Entity\Module newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Module[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Module|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Module patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Module[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Module findOrCreate($search, callable $callback = null, $options = [])
 */
class ModulesTable extends Table
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

        $this->belongsTo('Courses');
        $this->belongsTo('Resources', [
            'foreignKey' => 'resources_id'
        ]);
        $this->hasMany('Tests', [
            'foreignKey' => 'course_module_id'
        ]);
        $this->hasMany('CourseEnrolledModules');
        $this->belongsTo('RegisterClasses', [
            'foreignKey' => 'register_class_id'
        ]);
        // $this->hasMany('Tests', [
        //     'foreignKey' => 'course_module_id'
        // ]);
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
            ->allowEmpty('id', 'create')
            ->allowEmpty('created_at')
            ->allowEmpty('updated_at');
            

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
        $rules->add($rules->existsIn(['resource_id'], 'Resources'));
        $rules->add($rules->existsIn(['register_class_id'], 'RegisterClasses'));
        // $rules->add($rules->existsIn(['test_id'], 'Tests'));

        return $rules;
    }

    public function serializeMachineType($machineTypes){
        $serialized = serialize($machineTypes);
        return $serialized;
       
    }
    public function unserializeMachineType($machineTypes){
        $unserialized = unserialize($serialized);
        return $unserialized;
    }
}
