<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Mailer\Email;
use Cake\Routing\Router;
use Cake\ORM\TableRegistry;

/**
 * Departments Model
 *
 * @property \Cake\ORM\Association\HasMany $Equipment
 * @property \Cake\ORM\Association\HasMany $RegisterAdmins
 * @property \Cake\ORM\Association\HasMany $Registers
 * @property \Cake\ORM\Association\BelongsToMany $Users
 *
 * @method \App\Model\Entity\Department get($primaryKey, $options = [])
 * @method \App\Model\Entity\Department newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Department[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Department|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Department patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Department[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Department findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DepartmentsTable extends Table
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

        $this->table('departments');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Equipment', [
            'foreignKey' => 'department_id'
        ]);
        $this->hasMany('RegisterAdmins', [
            'foreignKey' => 'department_id'
        ]);
        $this->hasMany('Registers', [
            'foreignKey' => 'department_id'
        ]);
        $this->belongsToMany('Users', [
            'foreignKey' => 'department_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'departments_users'
        ]);
        
        $this->belongsToMany('Leaders', [
            'className'=>'Users',
            'foreignKey' => 'department_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'departments_leaders',
            'propertyName' => 'leaders'
        ]);
        
        $this->hasMany('DepartmentsLeaders');
    }
    
    public function findShort(Query $query, array $options){
        
       // debug($query);
        
        $query->select(['id','name','email']);
        //$query->autoFields(true);
        
        //debug($query);
        //        ->contain();
        return $query;
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
            ->allowEmpty('description');

        $validator
            ->email('email')
            ->allowEmpty('email');

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
        return $rules;
    }
    
    
    public function sendStatusEmail($id = null)
    {
        $department = $this->get($id, [
            'contain' => ['Leaders']
        ]);
        
        $to = \Cake\Utility\Hash::extract($department->leaders,'{n}.email');
        if(empty($to)){
            //No leaders to send to
            return false;
        }
        //Get list of users in this department
        $user_ids = $this->Users->DepartmentsUsers->find()
            ->select('user_id')
            ->where(['department_id'=>$id])
            ->extract('user_id')->toArray();
        
        $contain = [
            'Certifications.CertificationTypes'=>[
                'fields'=>['id','category','type','name']],
            'Certifications.CertificationTypes.CertificationClasses'=>[
                'fields'=>['id','name','icon']],
            'Certifications'=>[
                'fields'=>['id','status','user_id','expires'],
                // Only get certs that are expiring
                'conditions'=>[
                    'Certifications.status >' => 1,
                    'Certifications.valid' => true,
                    'Certifications.active'=>true]],
            'Registers.RegisterClasses'=>[
                'fields'=>['id','title','icon']],
            'Registers.RegisterTemplates'=>[
                'fields'=>['id','name']],
            'Registers'=>[
                // Only get registers that are expiring
                'fields'=>['id','cert_status','user_id','cert_status_date','register_template_id'],
                'conditions'=>[
                    'Registers.cert_status >' => 1,
                    'Registers.status'=>'Registered',
                    'Registers.active'=>true]]];
    	
    	$conditions = ['Users.active'=>1];
    	
        
        if(!empty($user_ids)){
            $conditions[]['Users.id IN'] = $user_ids;
        }else{
            $conditions[]['Users.id'] = 0;//Return none
        }
        
        $users = $this->Users->find()
                ->select(['id','name'], true)
                ->autoFields(false)
                ->contain($contain)
                ->where($conditions)->toArray();

        $send = false;
        //Check if data not empty
        foreach($users as $user){
            if(!empty($user->registers) || !empty($user->certifications)){
                $send = true;
                break;
            }
        }
        
        
        
        //Check if there is something to send
        if($send){
            $dataArray['users'] = $users;
            $dataArray['department'] = $department;
            $dataArray['siteLink'] = Router::url('/', true);
            $privacyLink = null;   
            
            if (\Cake\Core\Configure::check('Client.privacy_policy_url')) {
                $privacyLink = \Cake\Core\Configure::read('Client.privacy_policy_url');   
            }
            //Remove invalid links
            if (filter_var($privacyLink, FILTER_VALIDATE_URL) === false) {
                $privacyLink = null;    
            }
            $dataArray['privacyLink'] = $privacyLink;    
            $dataArray['loginLink'] = Router::url('/', true).'users/login';
            
            $setting = TableRegistry::get('Settings')->find()->first();
            $dataArray['client_name'] = ($setting) ? $setting->name:'';
            $dataArray['app_logo_text'] = ($setting && $setting->short)?$setting->short:'DDMS';
        

            $email = new Email();
            $email->emailFormat('html');
            $email->template('department_status', 'cssstyled');
            $email->helpers(['Html', 'Dak']);
            $email->to($to);
            $email->subject($dataArray['app_logo_text'].': Department Status Update for '.h($department->name));
            $email->viewVars($dataArray);
            $email->send();
            return true;
        }
        
        return false;
        
    }
}
