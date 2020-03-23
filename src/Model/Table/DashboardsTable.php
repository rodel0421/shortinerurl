<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Dashboards Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\DashboardItemsTable|\Cake\ORM\Association\HasMany $DashboardItems
 *
 * @method \App\Model\Entity\Dashboard get($primaryKey, $options = [])
 * @method \App\Model\Entity\Dashboard newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Dashboard[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Dashboard|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Dashboard patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Dashboard[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Dashboard findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DashboardsTable extends Table
{

    public $dashboard_items = [
        'new_users'=>'New Users',
        'certifications'=>'Certifications',
        'equipment_service'=>'Equipment Service',
        'registers_inprogress'=>'Registers In Progress',
        'registers_stats'=>'Registers Stats',
    ];
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('dashboards');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        
        $this->addBehavior('ADmad/Sequence.Sequence', [
            'order' => 'order', // Field to use to store integer sequence. Default "position".
            'scope' => ['user_id'], // Array of field names to use for grouping records. Default [].
            'start' => 1, // Initial value for sequence. Default 1.
        ]);
        
        $this->hasMany('DashboardItems', [
            'foreignKey' => 'dashboard_id'
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');


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

        return $rules;
    }
}
