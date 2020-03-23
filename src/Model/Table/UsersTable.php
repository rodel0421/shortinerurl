<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Security;
use Cake\Mailer\Email;
use Cake\Routing\Router;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Groups
 * @property \Cake\ORM\Association\BelongsTo $Facilities
 * @property \Cake\ORM\Association\HasMany $BookingLogs
 * @property \Cake\ORM\Association\HasMany $BookingPersonnels
 * @property \Cake\ORM\Association\HasMany $Bookings
 * @property \Cake\ORM\Association\HasMany $Certifications
 * @property \Cake\ORM\Association\HasMany $ContactLogs
 * @property \Cake\ORM\Association\HasMany $Equipment
 * @property \Cake\ORM\Association\HasMany $EquipmentLogs
 * @property \Cake\ORM\Association\HasMany $Forms
 * @property \Cake\ORM\Association\HasMany $Messages
 * @property \Cake\ORM\Association\HasMany $Photos
 * @property \Cake\ORM\Association\HasMany $Registers
 * @property \Cake\ORM\Association\HasMany $Resources
 * @property \Cake\ORM\Association\HasMany $RosterUsers
 * @property \Cake\ORM\Association\HasMany $TripLogs
 * @property \Cake\ORM\Association\HasMany $TripPersonnels
 * @property \Cake\ORM\Association\HasMany $Trips
 * @property \Cake\ORM\Association\HasMany $UserDocs
 * @property \Cake\ORM\Association\HasMany $UserStatuses
 * @property \Cake\ORM\Association\BelongsToMany $Departments
 * @property \Cake\ORM\Association\BelongsToMany $Facilities
 * @property \Cake\ORM\Association\BelongsToMany $Flags
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */

function profileHash($data,$field){
    $currentName = $data['name'];
    // return random int so browser does not cache profile image if changed in same date.
    return rand(1000,9999) . Security::hash($currentName.date('YmdHHMMII'), 'sha1', true).substr($currentName,strrpos($currentName,"."));
}

class UsersTable extends Table
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
        
        $this->table('users');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Groups', [
            'foreignKey' => 'group_id',
            'joinType' => 'INNER'
        ]);
        
        $this->belongsTo('UserTypes', [
            'foreignKey' => 'user_type_id'
        ]);
               
        
        $this->hasMany('Certifications', [
            'foreignKey' => 'user_id',
            'dependent' => true,
            'conditions' => ['Certifications.active'=>1]
        ]);
        $this->hasMany('UserNotes', [
            'foreignKey' => 'user_id',
            'dependent' => true,
            'conditions' => ['UserNotes.active'=>1]
        ]);
        $this->hasMany('Equipment', [
            'foreignKey' => 'user_id',
            'dependent' => true,
            'conditions' => ['Equipment.active'=>1]
        ]);
        $this->hasMany('Registers', [
            'foreignKey' => 'user_id',
            'dependent' => true,
            'conditions' => ['Registers.active'=>1]
        ]);
        $this->hasMany('Trips', [
            'dependent' => true,
            'foreignKey' => 'user_id'
        ]);
        
        $this->hasMany('UserDocs', [
            'dependent' => true,
            'foreignKey' => 'user_id',
            'conditions' => ['UserDocs.active'=>1]
        ]);
        $this->hasMany('UserStatuses', [
            'dependent' => true,
            'foreignKey' => 'user_id'
        ]);
        $this->belongsToMany('Departments', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'department_id',
            'joinTable' => 'departments_users'
        ]);
        
        $this->hasMany('Alerts', [
            'foreignKey' => 'user_id',
            'dependent' => true,
            'conditions' => ['Alerts.active'=>1]
        ]);
        
        $this->hasMany('DepartmentsUsers');
        
        $this->belongsToMany('Flags', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'flag_id',
            'joinTable' => 'flags_users'
        ]);
        
        $this->hasMany('MyAppointments', [
            'dependent' => true,
            'className' => 'Appointments',
            'foreignKey' => 'organiser',
            'conditions' => ['MyAppointments.active'=>1,
                'MyAppointments.dtstart >='=>date('Y-m-d')]
        ]);
        
        $this->hasMany('Appointments', [
            'dependent' => true,
            'foreignKey' => 'user_id',
            'conditions' => ['Appointments.active'=>1,
                'Appointments.dtstart >='=>date('Y-m-d')]
        ]);
        
        $this->hasMany('EquipmentReservations', [
            'dependent' => true,
            'foreignKey' => 'user_id'
        ]);
        
        $this->hasOne('EquipmentStatus' , 
                [
                'className' => 'UserStatuses',
                'conditions' => ['EquipmentStatus.type' => 'Equipment'],
                'dependent' => true
            ]);
        
        $this->hasOne('CertificationStatus', [
                'className' => 'UserStatuses',
                'conditions' => ['CertificationStatus.type' => 'Certifications'],
                'dependent' => true
            ]);
        $this->hasOne('RegisterStatus', [
                'className' => 'UserStatuses',
                'conditions' => ['RegisterStatus.type' => 'Registers'],
                'dependent' => true
            ]);
        
        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'profile_url'=>[
                'path'=>'secupload{DS}users{DS}{field-value:id}{DS}',
                'nameCallback' => '\App\Model\Table\profileHash'
            ],
        ]);
        
        $this->belongsToMany('Leads', [
            'className'=>'Departments',
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'department_id',
            'joinTable' => 'departments_leaders',
            'propertyName' => 'leads'
        ]);

        $this->belongsToMany('EnrolledCourses', [
            'className' => 'Courses',
            'joinTable' => 'course_enrolled_users',
            'targetForeignKey' => 'user_id',
        ]);
        
        $this->belongsToMany('EnrolledModules', [
            'className' => 'CourseModules',
            'joinTable' => 'course_enrolled_users',
            'targetForeignKey' => 'user_id',
        ]);
        
        $this->hasMany('UserTests');

    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $allowed_domains = TableRegistry::get('AllowedDomains')->find('list', ['limit' => 200])->toArray();
        $validator->add('email', 'custom', [
            'rule' => function ($value, $context) use ($allowed_domains) {
                $explode = explode('@', $value);
                $domain = end($explode);
                foreach ($allowed_domains as $key => $value){
                    if($domain == $value || true ){
                        return true;
                    }
                }
                return false;
            },
            'message' => 'Email domain is invalid'
        ]);
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('username', 'create')
            ->notEmpty('username')
            ->add('username',[
                    'alphaNumeric'=>[
                        'rule'=>'alphaNumeric',
                        'last' => true,
                        'message' => 'Only numbers and letters allowed'
                    ],
                    'minLength' => [
                        'rule' => ['minLength', 3],
                        'last' => true,
                        'message' => 'Username must be atleast 3 characters long'
                    ],
                    'maxLength' => [
                        'rule' => ['maxLength', 255],
                        'last' => true,
                        'message' => 'Username must be less than 50 characters long'
                    ],
                    'unique'=> [
                        'rule' => 'validateUnique',
                        'message' => 'Username is already in use', 
                        'provider' => 'table'
                    ]
                 ]);
        
        $validator
            ->integer('user_type_id')
            ->notEmpty('user_type_id');
        
        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');
        
        $validator
            ->requirePresence('given_name', 'create')
            //->scalar('given_name')
            ->maxLength('given_name', 100)
            ->notEmpty('given_name');

        $validator
            ->requirePresence('surname', 'create')
            //->scalar('surname')
            ->maxLength('surname', 100)
            ->notEmpty('surname');
        
        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name')
            ->add('name',[
                    'unique'=> [
                        'rule' => 'validateUnique',
                        'message' => 'Display Name is already in use, please include your middle initial.', 
                        'provider' => 'table'
                    ]
                 ]);

        $validator
            ->email('email')
            ->maxLength('phone', 255)
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->date('dob')
            ->allowEmpty('dob');

        $validator
            //->scalar('phone')
            ->maxLength('phone', 15)
            ->allowEmpty('phone');

        $validator
            //->scalar('mobile')
            ->maxLength('mobile', 15)
            ->allowEmpty('mobile');

        $validator
            //->scalar('emergency_contact_name')
            ->maxLength('emergency_contact_name', 150)
            ->allowEmpty('emergency_contact_name');

        $validator
            //->scalar('emergency_contact_number')
            ->maxLength('emergency_contact_number', 100)
            ->allowEmpty('emergency_contact_number');

        $validator
            //->scalar('position')
            ->maxLength('position', 100)
            ->allowEmpty('position');

        $validator
            //->scalar('company_department')
            ->maxLength('company_department', 100)
            ->allowEmpty('company_department');

        $validator
            //->scalar('address')
            ->maxLength('address', 255)
            ->allowEmpty('address');

        $validator
            //->scalar('company_name')
            ->maxLength('company_name', 255)
            ->allowEmpty('company_name');

        $validator
            //->scalar('company_contact')
            ->maxLength('company_contact', 255)
            ->allowEmpty('company_contact');

        $validator
            //->scalar('company_address')
            ->maxLength('company_address', 255)
            ->allowEmpty('company_address');


        $validator
            //->scalar('supervisor')
            ->maxLength('supervisor', 255);

        if(Configure::check('Client.requiredFields.User_supervisor')){
            $validator->notEmpty('supervisor');
        }else{
            $validator->allowEmpty('supervisor');
        }
            

        $validator
            ->email('supervisor_email')
            ->maxLength('supervisor_email', 255);

        if(Configure::check('Client.requiredFields.User_supervisor_email')){
            $validator->notEmpty('supervisor_email');
        }else{
            $validator->allowEmpty('supervisor_email');
        }

        $validator
            //->scalar('supervisor_phone')
            ->maxLength('supervisor_phone', 15);

        if(Configure::check('Client.requiredFields.User_supervisor_phone')){
            $validator->notEmpty('supervisor_phone');
        }else{
            $validator->allowEmpty('supervisor_phone');
        }

        

        $validator
            //->scalar('account_type')
            ->maxLength('account_type', 255)
            ->requirePresence('account_type', 'create')
            ->notEmpty('account_type');


        $validator
            ->allowEmpty('key');

        $validator->provider('upload', \Josegonzalez\Upload\Validation\UploadValidation::class);
        
        $validator
            ->allowEmpty('profile_url')
            ->add('profile_url', [
                'validExtension' => [
                    'last' => true,
                    'rule' => ['extension',['gif', 'jpeg', 'png', 'jpg']],
                    'provider' => 'table',
                    'message' => __('These files extension are allowed: .gif, .jpg, .png, .jpeg')
                ],
                'file'=>[
                    'rule' => 'isFileUpload',
                    'message' => 'There was no file found to upload',
                    'provider' => 'upload',
                    'last' => true,
                ],
                'filesize'=>[
                    'last' => true,
                    'rule' => ['isBelowMaxSize', 512000],
                    'message' => 'The image is too large, needs to be below 500 Kb',
                    'provider' => 'upload'
                ]
            ]);

        $validator
            ->allowEmpty('facilities_access');

        $validator
            ->boolean('admin_only')
            ->allowEmpty('admin_only');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active');
        
        $validator
            ->boolean('disabled')
            ->allowEmpty('disabled');
        
        $validator
            ->boolean('send_alerts')
            ->allowEmpty('send_alerts');

        $validator
            ->boolean('account_verified')
            ->requirePresence('account_verified', 'create')
            ->notEmpty('account_verified');

        return $validator;
    }
    
    public function validationExternal(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('username', 'create')
            ->notEmpty('username')
            ->add('username',[
                    'minLength' => [
                        'rule' => ['minLength', 6],
                        'last' => true,
                        'message' => 'Username must be atleast 6 characters long'
                    ],
                    'maxLength' => [
                        'rule' => ['maxLength', 255],
                        'last' => true,
                        'message' => 'Username must be less than 50 characters long'
                    ],
                    'unique'=> [
                        'rule' => 'validateUnique',
                        'message' => 'Username is already in use', 
                        'provider' => 'table'
                    ]
                 ]);
        
        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');
        
        $validator
            ->requirePresence('given_name', 'create')
            ->notEmpty('given_name');

        $validator
            ->requirePresence('surname', 'create')
            ->notEmpty('surname');
        
        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name')
            ->add('name',[
                    'unique'=> [
                        'rule' => 'validateUnique',
                        'message' => 'Display Name is already in use, please include your middle initial.', 
                        'provider' => 'table'
                    ]
                 ]);

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->date('dob')
            ->allowEmpty('dob');

        $validator
            ->allowEmpty('phone');

        $validator
            ->allowEmpty('mobile');

        $validator
            ->allowEmpty('emergency_contact_name');

        $validator
            ->allowEmpty('emergency_contact_number');

        $validator
            ->allowEmpty('position');

        $validator
            ->allowEmpty('company_department');

        $validator
            ->allowEmpty('address');

        $validator
            ->allowEmpty('company_name');

        $validator
            ->allowEmpty('company_contact');

        $validator
            ->allowEmpty('company_address');

        $validator
            ->allowEmpty('supervisor');

        $validator
            ->allowEmpty('supervisor_email');

        $validator
            ->allowEmpty('supervisor_phone');

        

        $validator
            ->requirePresence('account_type', 'create')
            ->notEmpty('account_type');


        $validator
            ->allowEmpty('key');

        $validator
            ->allowEmpty('facilities_access');

        $validator
            ->boolean('admin_only')
            ->allowEmpty('admin_only');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active');

        $validator
            ->boolean('account_verified')
            ->requirePresence('account_verified', 'create')
            ->notEmpty('account_verified');

        return $validator;
    }
    
    public function getIDfromEmail($email){
        if(empty($email)) return null;
        
        $user = $this->find()->select('id')->where(['email'=>$email])->first();
        
        if($user) return $user->id;
        
        return null;
    }
    
    public function validationPassword($validator)
    {
        $validator
            ->requirePresence('password')
            ->notEmpty('password')
            ->add('password', [
                'length' => [
                    'rule' => ['minLength', 6],
                    'message' => 'Passwords must contain at least 6 characters.',
                ]
            ]);
        
        $validator
            ->requirePresence('confirm_password')
            ->notEmpty('confirm_password');
        
        $validator->add('password', [
                'compare' => [
                    'rule' => ['compareWith', 'confirm_password'],
                    'message'=>'The passwords do not match'
                ]
            ]);
        return $validator;
    }
    
    public static function extension($check, $extensions = ['gif', 'jpeg', 'png', 'jpg'])
    {
        if (is_array($check)) {
            if(isset($check['name'])){
                return static::extension($check['name'], $extensions);
            }
            
            return false;
        }
        $extension = strtolower(pathinfo($check, PATHINFO_EXTENSION));
        foreach ($extensions as $value) {
            if ($extension === strtolower($value)) {
                return true;
            }
        }

        return false;
    }
    
    public function findFlagged(Query $query, array $options){
        return $this->find()
            ->distinct(['Tasks.id'])
            ->matching('Flags', function ($q) use ($options) {
                if (empty($options['flags'])) {
                    return $q->where(['Flags.title IS' => null]);
                }
                return $q->where(['Flags.title IN' => $options['flags']]);
            });
    }
    
    public function beforeSave($event, $entity, $options)
    {
        if ($entity->flag_string) {
            $entity->flags = $this->_buildFlagsFromString($entity->flag_string);
        }
        
        if ($entity->flag && is_array($entity->flag)) {
            $entity->flags = $this->_buildFlags($entity->flag);
        }
        if($entity->id){
            $user = $this->get($entity->id);
            if(!empty($entity->profile_url) && !empty($entity->id) &&
                (strpos($entity->profile_url, '/upload/') === false &&
                strpos($entity->profile_url, 'https://') === false) 
                    ){
                if($user->profile_url != $entity->profile_url){
                    $entity->profile_url = 'upload/users/'.$entity->id.'/' . $entity->profile_url;
                }
            }
        }
    }
    
    public function findShort(Query $query, array $options){
        
       // debug($query);
        
        $query->select(['id','name','given_name','group_id','profile_url','email']);
        //$query->autoFields(true);
        
        //debug($query);
        //        ->contain();
        return $query;
    }
    
    public function findNameonly(Query $query, array $options){
        
       // debug($query);
        
        $query->select(['id','name']);
        //$query->autoFields(true);
        
        //debug($query);
        //        ->contain();
        return $query;
    }
    
    /*
    * Finder for local users.
    */
    public function findAuth(Query $query, array $options){
        $query
            ->select(['id','name','active','group_id','user_type_id','profile_url','email','password','created','modified', 'account_verified'])
            ->contain(['Groups','Departments','Leads'])
            ->where(['Users.disabled'=>false,'Users.provider'=>'local']);

        return $query;
    }
    
    /*
    * Finder for any authed accounts.
    */
    public function findAnyauth(Query $query, array $options){
        $query
            ->select(['id','name','active','group_id','user_type_id','profile_url','email','password','created','modified', 'account_verified'])
            ->contain(['Groups','Departments','Leads'])
            ->where(['Users.disabled'=>false]);

        return $query;
    }

    protected function _buildFlagsFromString($flag_string){
        return $this->_buildFlags(array_map('trim', explode(',', $flag_string)));
    }
    
    protected function _buildFlags($flags)
    {
        $new = array_unique($flags);
        $out = [];
        $query = $this->Flags->find()
            ->where(['Flags.title IN' => $new]);

        // Remove existing flags from the list of new flags.
        foreach ($query->extract('title') as $existing) {
            $index = array_search($existing, $new);
            if ($index !== false) {
                unset($new[$index]);
            }
        }
        // Add existing flags.
        foreach ($query as $flag) {
            $out[] = $flag;
        }
        // Add new flags.
        foreach ($new as $flag) {
            $out[] = $this->Flags->newEntity(['title' => $flag]);
        }
        return $out;
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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['name']));
        $rules->add($rules->existsIn(['group_id'], 'Groups'));
        $rules->add($rules->existsIn(['user_type_id'], 'UserTypes'));

        return $rules;
    }
    
    
    public function sendStatusEmail($id = null){
        $user = $this->get($id, [
            'contain' => [
               // 'Groups', 
               // 'Departments', 
               // 'Flags', 
                'Certifications'=>[
                    'conditions'=>[
                        'Certifications.status >' => 1,
                        'Certifications.active' => true,
                        'Certifications.valid' => true
                    ],
                    'CertificationTypes'], 
               // 'UserNotes', 
                'Equipment',
                'Registers'=>[
                    //'RegisterForms'=>['fields'=>['id']],
                    'conditions'=>[
                        'Registers.status' => 'Registered',
                        'Registers.active' => true,
                        'Registers.cert_status >' => 1,
                    ],
                   // 'Departments',
                    'RegisterClasses',
                    'RegisterTemplates'=>['fields'=>['id','name']]],
               // 'Trips', 
               // 'UserDocs', 
                'UserStatuses'
                ]
        ]);
        
        //Dont send to inactive users
        if(!$user->active){
            return false;
        }
        
        //Check if there is something to send
        if(($user->has('registers') && count($user->registers) > 0) ||
                ($user->has('certifications') && count($user->certifications) > 0)
                ){
            $dataArray['user'] = $user;
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
            $email->template('user_status', 'cssstyled');
            $email->helpers(['Html', 'Dak']);
            $email->to($user->email, $user->name);
            $email->subject($dataArray['app_logo_text'].': Account Status Update');
            $email->viewVars($dataArray);
            $email->send();
        }
    }
    
}
