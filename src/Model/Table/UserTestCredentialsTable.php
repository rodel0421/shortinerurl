<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserTestCredentials Model
 *
 * @property \App\Model\Table\UserTestsTable|\Cake\ORM\Association\BelongsTo $UserTests
 * @property \App\Model\Table\LoginsTable|\Cake\ORM\Association\BelongsTo $Logins
 *
 * @method \App\Model\Entity\UserTestCredential get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserTestCredential newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserTestCredential[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserTestCredential|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserTestCredential patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserTestCredential[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserTestCredential findOrCreate($search, callable $callback = null, $options = [])
 */
class UserTestCredentialsTable extends Table
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

        $this->setTable('user_test_credentials');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('UserTests', [
            'foreignKey' => 'user_test_id',
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
            ->requirePresence('login_pin', 'create')
            ->notEmpty('login_pin');

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
        $rules->add($rules->existsIn(['user_test_id'], 'UserTests'));
        return $rules;
    }
}
