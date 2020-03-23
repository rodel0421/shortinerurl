<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserNotes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\UserNote get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserNote newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserNote[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserNote|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserNote patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserNote[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserNote findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UserNotesTable extends Table
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

        $this->table('user_notes');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'created_by',
            'joinType' => 'INNER',
            'finder'=>'short'
        ]);
        
        $this->addBehavior('ChrisShick/CakePHP3HtmlPurifier.HtmlPurifier', [
            'fields'=>['notes'],
            'config'=>[
                'HTML'=>[
                    'TidyLevel' => 'heavy'
                ],
                'AutoFormat'=>[
                    'RemoveSpansWithoutAttributes' => true,
                    'RemoveEmpty' => true],
                'Cache'=>[
                'SerializerPath'=>TMP]
                ]
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
            ->integer('created_by')
            ->requirePresence('created_by', 'create')
            ->notEmpty('created_by');

        $validator
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->requirePresence('notes', 'create')
            ->notEmpty('notes');

        $validator
            ->boolean('active');

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
