<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tests Model
 *
 * @property \App\Model\Table\ModulesTable|\Cake\ORM\Association\BelongsTo $Modules
 * @property \App\Model\Table\ModulesTable|\Cake\ORM\Association\HasOne $Modules
 * @property \App\Model\Table\CourseQuestionsTable|\Cake\ORM\Association\HasMany $Questions
 * @property \App\Model\Table\UserTestsTable|\Cake\ORM\Association\HasMany $UserTests
 * @property \App\Model\Table\UserAnswersTable $UserAnswers
 *
 * @method \App\Model\Entity\Test get($primaryKey, $options = [])
 * @method \App\Model\Entity\Test newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Test[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Test|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Test patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Test[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Test findOrCreate($search, callable $callback = null, $options = [])
 */
class TestsTable extends Table
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

        $this->setTable('course_tests');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Modules',[
            'foreignKey' => 'course_module_id'
        ]);
        $this->hasMany('Questions', [
            'className' => 'CourseQuestions',
            'foreignKey' => 'course_test_id',
        ]);
        $this->hasMany('UserTests');
        $this->belongsTo('CourseTestTypes');
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
            ->allowEmpty('type');

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
        $rules->add($rules->existsIn(['module_id'], 'Modules'));

        return $rules;
    }

    public function redirectLoggedIn($userTestCredentials){
        
        if($userTestCredentials){
            if($userTestCredentials->user_test->status == 'expired'){
                $data = [
                    'error_message' => 'Login ID is expired.',
                    'redirect' => ['action' => 'login'],
                    'usertest_credential_id' => $userTestCredentials->user_test->id,
                ];
            }
            elseif($userTestCredentials->user_test->status == 'open'){
                $data = [
                    'error_message' => '',
                    'redirect' => ['controller' => 'Tests','action' => 'takeTest'],
                    'usertest_credential_id' => $userTestCredentials->user_test->id,
                    'date_opened' => $userTestCredentials->date_opened,
                    'open_until' => $userTestCredentials->open_until,
                    'timezone' => $userTestCredentials->timezone
                ];
            }
            elseif(
                $userTestCredentials->user_test->status == 'passed' ||
                $userTestCredentials->user_test->status == 'failed' || 
                $userTestCredentials->user_test->status == 'submitted'
            )
            {
                $data = [
                    'error_message' => '',
                    'redirect' => ['controller' => 'UserTests','action' => 'view', $userTestCredentials->user_test->id],
                    'usertest_credential_id' => $userTestCredentials->user_test->id,
                ];
            }
        }else{
            $data = [
                'error_message' => 'Please login first',
                'redirect' => ['action' => 'login']
            ];
        }
        return $data;
    }

    public function getRelatedQuestions($id, Array $conditions = [], Array $contain = []){
        return $this->Questions->find()
            ->where(['Questions.course_test_id' => $id])
            ->where($conditions)
            ->contain($contain)
            ->toArray();
    }

}
