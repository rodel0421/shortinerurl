<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Routing\Router;

/**
 * Alerts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Alert get($primaryKey, $options = [])
 * @method \App\Model\Entity\Alert newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Alert[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Alert|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Alert patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Alert[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Alert findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AlertsTable extends Table
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

        $this->setTable('alerts');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
            ->requirePresence('title', 'create')
            ->notEmpty('title');
        
        $validator
            ->requirePresence('link', 'create')
            ->notEmpty('link');
        
        $validator
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->requirePresence('controller', 'create')
            ->notEmpty('controller');

        $validator
            ->integer('item')
            ->requirePresence('item', 'create')
            ->notEmpty('item');

        $validator
            ->dateTime('ack')
            ->allowEmpty('ack');

        $validator
            ->dateTime('first_sent')
            ->allowEmpty('first_sent');

        $validator
            ->boolean('active')
            ->allowEmpty('active');

        return $validator;
    }
    
    public function create($title, $type, $controller, $item,$user_id,$link = null){
        if(!isset($link)){
            $link = Router::url(['controller'=>$controller,'action'=>'view',$item]);
        }
        $active = 1;
        $alert = $this->newEntity(compact('title', 'type', 'controller', 'item','user_id','link','active'));
        
        $this->save($alert);
    }
    
    public function clear($type, $controller, $item){
        $this->updateAll(['active'=>0], ['type'=>$type,'controller'=>$controller,'item'=>$item]);
        
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
