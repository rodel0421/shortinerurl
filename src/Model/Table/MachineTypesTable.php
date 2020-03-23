<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MachineTypes Model
 *
 * @property \App\Model\Table\ModulesTable|\Cake\ORM\Association\HasMany $Modules
 *
 * @method \App\Model\Entity\MachineType get($primaryKey, $options = [])
 * @method \App\Model\Entity\MachineType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MachineType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MachineType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MachineType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MachineType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MachineType findOrCreate($search, callable $callback = null, $options = [])
 */
class MachineTypesTable extends Table
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

        $this->setTable('course_machine_types');
        $this->setDisplayField('description');
        $this->setPrimaryKey('id');

        $this->hasMany('Modules', [
            'foreignKey' => 'course_machine_types_id'
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
            ->allowEmpty('description');

        $validator
            ->allowEmpty('icon');

        return $validator;
    }
}
