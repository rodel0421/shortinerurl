<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DashboardItems Model
 *
 * @property \App\Model\Table\DashboardsTable|\Cake\ORM\Association\BelongsTo $Dashboards
 *
 * @method \App\Model\Entity\DashboardItem get($primaryKey, $options = [])
 * @method \App\Model\Entity\DashboardItem newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DashboardItem[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DashboardItem|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DashboardItem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DashboardItem[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DashboardItem findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DashboardItemsTable extends Table
{

    public $filter_types = [
        'user1'=>'Only Show My Records',
        'department1'=>'Only Show Departments that I manage',
        'department2'=>'Only Show Departments that I am a membner of',
        'department3'=>'Filter a specific department',
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

        $this->setTable('dashboard_items');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Dashboards', [
            'foreignKey' => 'dashboard_id',
            'joinType' => 'INNER'
        ]);
        
        $this->addBehavior('ADmad/Sequence.Sequence', [
            'order' => 'order', // Field to use to store integer sequence. Default "position".
            'scope' => ['dashboard_id'], // Array of field names to use for grouping records. Default [].
            'start' => 1, // Initial value for sequence. Default 1.
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
        
        $validator
            ->notEmpty('title');
        

        $validator
            ->integer('order')
            ->allowEmpty('order');

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
        $rules->add($rules->existsIn(['dashboard_id'], 'Dashboards'));

        return $rules;
    }
}
