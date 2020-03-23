<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Mailer\Email;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Security;
use Cake\Routing\Router;
use Cake\Core\Configure;
use Cake\Log\Log;
use Cake\ORM\TableRegistry;
use App\Form\RecoverForm;
use Cake\ORM\Query;
use Cake\Database\Expression\QueryExpression;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @property \App\Model\Table\TestsTable $Tests
 * @property \App\Model\Table\CourseTable $Course
 * @property \App\Model\Table\ResourcesTable $Resouces
 * @property \App\Model\Table\CourseQuestionTypesTable $TestType
 */
class UsersController extends AppController
{ 

    
    public function isAuthorized($user){
        return parent::isAuthorized($user);
    }

    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->viewBuilder()->helpers(['Javascript']);
        $this->Auth->allow(['logout','recover','password','add','registration','auth','gmaillogin','facebooklogin', 'newPassword']);
        
        $this->Security->config('unlockedActions', ['settings']);
        
        if (isset($this->request->query['t']) && isset($this->request->query['p'])) {
            $this->Auth->allow(['reset']);
        }
    }
    
    public function initialize(){
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->Auth->allow(['home','view','settings','verify', 'search','edit']);
    }
    
    public function settings(){
        $this->request->allowMethod(['post', 'patch','put']);
        
        $type = $this->request->data('type');
        
        switch ($type){
            case 'box-state':
                $box = $this->request->data('box');
                $box = preg_replace("/[^a-zA-Z0-9]+/", "", $box);//clean string
                
                if($box){
                    $state = (bool) $this->request->data('state');
                    $this->Cookie->write('Box.', $state);
                }
                break;
        }
    }
    
    public function auth(){
        
        
        //If here user has authed with https://myregister.jcu.edu.au/Shibboleth.sso/Login
        // if vars are set they are trusted
        /*
         * AUTH_TYPE
         * REMOTE_USER
         * COMMONNAME
         * GIVENNAME
         * SN
         * EMAIL
         * ORGANIZATIONNAME
         * TELEPHONENUMBER
         * UNSCOPED_AFFILIATION
         * MOBILENUMBER
         * UID - should be JC number - not required by all providers - Will fall back to using email account
         * 
         */
        
        $username = !empty($_SERVER['UID']) ? $_SERVER['UID'] : $_SERVER['EMAIL'];
        
        //If empty redirect with error.
        if(empty($_SERVER['AUTH_TYPE']) || empty($username)){
            $this->Flash->error(__('Sorry, something went wrong, please try again'));
            return $this->redirect(['action'=>'login']);
        }
        
        $username = substr($username,0,255); //Trim for DB
        //If set, look for local user account
        $user = $this->Users->find('anyauth')
                ->where(['username'=>$username])->first();
        
        //TODO look at using REMOTE_USER as unique identifer - update DB field -varchar(2306) - cannot be a KEY
        
        if($user){
            //Update account
            $user->active = true;
            $this->Users->save($user);
        }else{
            //If no account found create
            $data = [
                'group_id'=>7,
                'given_name'=>substr($_SERVER['GIVENNAME'],0,100),
                'surname'=>substr($_SERVER['SN'],0,100),
                'name'=>substr($_SERVER['COMMONNAME'],0,255),
                'email'=>substr($_SERVER['EMAIL'],0,255),
                'phone'=>substr($_SERVER['TELEPHONENUMBER'],0,15),
                'mobile'=>substr($_SERVER['MOBILENUMBER'],0,15),
                'company_department'=>substr($_SERVER['UNSCOPED_AFFILIATION'],0,100),
                'username'=>$username,
                'password'=> substr(Security::hash($_SERVER['EMAIL'].date('YmdHHMMII'), 'sha1', true),0,50)
            ];//Update - and test
            
            $user = $this->Users->newEntity($data,['validate' => 'external']);
            
            $user->account_verified = true; //Trust AAF email account
            $user->account_type = 'AAF';
            $user->provider = 'shibboleth';
            $user->active = true;
            
            $saved = $this->Users->save($user);
            if(!$saved){
                $errors = $user->getErrors();
                //check if the only error is a duplicate name
                unset($errors['name']);
                if(empty($errors)){
                    //try add username to name then save again
                    $user->name = substr($_SERVER['COMMONNAME'],0,120) . ' - ' .substr($username,0,100);
                    $saved = $this->Users->save($user);
                }
            }
            
            
            //TODO: ERROR: This email is already in use
            if(!$saved){//Still not saving
                Log::write('debug', 'Error creating user from shibboleth');
                Log::write('debug', $user);
                Log::write('debug', $_SERVER);
                Log::write('debug', $user->getErrors());
                $this->Flash->error(__('Sorry, something went wrong, please let us know.'));
                return $this->redirect(['action'=>'login']);
            }
        }
        
        //If found login
        $this->Auth->setUser($user);
        
        //debug($user);
        return $this->redirect(['controller'=>'Users','action'=>'home']);
    }
    
    public function home(){
        $user = $this->Auth->user();
        if(!$user) return $this->redirect(['controller'=>'Pages','action'=>'home']);

        $group = $user['group_id'];

        if(!$user['account_verified']){
            $this->logout();
            $this->Flash->error('User email not verified');
            return $this->redirect(['action'=>'login']);
        }

        if((!$group || $group >= 3)){//RO and above
         
            return $this->redirect(['action'=>'view',$user['id']]);
        }
        if($user['user_type_id'] == '1'){
            return $this->redirect(['controller'=> 'Dashboards','action'=>'view']);
        }else if($user['user_type_id'] == '2'){
            return $this->redirect(['controller' => 'People', 'action'=>'index']);
        }else{
            return $this->redirect(['action'=>'index']);
        }
    }
    
    public function login(){

      
        if(!$this->siteSettings()){
            return $this->redirect(['controller'=>'Settings','action'=>'index']);
        }
        $user = $this->Auth->user();
        
        $this->viewBuilder()->layout('login');
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                if(!$user['active']){//If not active - reactivate account
                    $currentUser =$this->Users->get($user['id'],['contain'=>[]]);
                    $currentUser->active = true;
                    $this->Users->save($currentUser);
                }
                
                if($this->request->data('remember_me')){
                    $this->setRememberMe($user['id']);
                }
                // log user activity
                //$this->userAudit($user['id'],'login');
                
                // dump($this->Auth->redirectUrl());
                // exit;
                
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
        
        $title = \Cake\Core\Configure::read('Shibboleth.title');
        $url = \Cake\Core\Configure::read('Shibboleth.url');
        $dataSource = \Cake\Core\Configure::read('Shibboleth.dataSource');
        
        if($title && $url && $dataSource){
            $this->set(compact('title','url','dataSource'));
            $this->render('auth');
        }
        
        //check if first signup and redirect to signup if so.
        /*
        $users = $this->Users->find('all')->count();
        if($users == 0){
            $this->Flash->success('Your site is ready, please create your admin account.');
            return $this->redirect(['action'=>'add','view'=>'new']);
        }*/
    }
    
    private function setRememberMe($id){
        $this->Cookie->configKey('CookieAuth', [
            'expires' => '+1 month',
            'httpOnly' => true
        ]);
        
        $this->loadModel('Tokens');
        $token = $this->Tokens->generate('CookieAuth',$id,date('Y-m-d H:i:s', strtotime('+1 month')));

        if($token){
         
            $data = [
                'id' => $id,
                't' => $token['t'],
                'p' => $token['p']
            ];
            
            $this->Cookie->write('CookieAuth', $data);
            return true;
        }
        
        return false;
    }
    
    public function logout()
    {
        $this->Cookie->delete('RememberMe');
       
        return $this->redirect($this->Auth->logout());
    }
    
    // Form to send password recovery email
    public function recover()
    {
        //show public layout
        $this->viewBuilder()->layout('login');
        $recover = new RecoverForm();
        if ($this->request->is(['post'])) {
            
            if($recover->execute($this->request->getData())){
                
                $email = $this->request->data('email');
            
                $msgEmailSent = "Your password reset link has been emailed.  Please follow the link in your email to reset your password.";
                $user = $this->Users->findByEmail($email)->first();
               

                if (!$user) {
                    // email is not registered!
                    $this->Flash->error('Account not found');
                    return $this->redirect($this->referer());
                }

                if ($user->provider != 'local') {
                  
                    $msg = 'Your account is managed by an external provider. Please contact them to recover your account password.';
                    switch($user->provider){
                        case 'ldap':
                            $config = Configure::check('LDAP')? Configure::read('LDAP'):[];
                            if(isset($config['name']) && isset($config['password_help']) && isset($config['password_link'])){
                                $this->set('provider_name',$config['name']);
                                $this->set('password_help',$config['password_help']);
                                $this->set('password_link',$config['password_link']);
                            }

                            break;
                        case 'shibboleth':
                           /* $config = Configure::check('Shibboleth')? Configure::read('Shibboleth'):[];
                            if(isset($config['title']) && isset($config['password_help']) && isset($config['password_link'])){
                                $this->set('provider_name',$config['title']);
                                $this->set('password_help',$config['password_help']);
                                $this->set('password_link',$config['password_link']);
                            }*/
                            break;
                    }
                    $this->Flash->error($msg);
                    $this->set('recover', $recover);
                    return;
                }

               
                $this->loadModel('Tokens');
                $token = $this->Tokens->generate('password_reset',$user->id, date('Y-m-d H:i:s', strtotime("+1 day")));

                if(!$token){
                    $this->Flash->error('Could not create invitation for '.h($email).' issue creating secure token.');
                    return;
                }

                $link = array_merge(['controller'=>'Users','action'=>'reset',$user->id],$token);
                // from here, the email address is registered.
                // define data to be read by template
                $userDataArr = array(
                    'link' => Router::url($link, true ) ,  
                    'name' => $user->name,  
                    'userName' => $user->username,    
                    'userEmail' => $user->email,    
                    'siteLink' => Router::url('/', true),    
                    'loginLink' => Router::url('/', true).'users/login',    
                    'support' => 'mailto:support@daktech.com.au'
                );
                
                $hash = Router::url($link, true ) ;
                // compile and send email
                Email::configTransport('gmail', [
                    'host' => 'ssl://smtp.gmail.com',
                    'port' => 465,
                    'username' => 'testtesting2111@gmail.com',
                    'password' => 'qazwsx0421',
                    'className' => 'Smtp'
                  ]);
                    $ms = 'Click on the link below to complete registration ';
                 
                $ms .=$hash;
                $ms = wordwrap($ms, 500);
               
                $emailTo = $user->email;
                $emailName = $user->name;
                  $email = new Email('default');
                  $email->transport('gmail');
                  $email->emailFormat('html');
                  $email->from("testtesting2111@gmail.com",'Recover');
                  $email->subject('Your Password reset request');
                  $email->to($emailTo);
                  $email->send($ms);

                // compile and send email
                // $emailTemplate = 'password_reset';
                // $emailTo = $user->email;
                // $emailName = $user->name;
                // $emailSubject = 'Your password reset request';
                // $this->emailTo($userDataArr, $emailTemplate, $emailTo, $emailName, $emailSubject);

                $this->Flash->success($msgEmailSent);
                return $this->redirect($this->Auth->logout());
                
            }else{
                $this->Flash->error('There was a problem submitting your form.');
                
            }
            
        }
        
        $this->set('recover', $recover);
    }   
    
    //Password reset form
    public function reset($id = null)
    {
        //if token and password set - authorize
        if((isset($this->request->query['t']) && isset($this->request->query['p']))){
            $this->loadModel('Tokens');
            $token = $this->request->query['t'];
            $password = $this->request->query['p'];
            $autherized = $this->Tokens->check('password_reset',$token,$password,$id);
            
            if(!$autherized){
                
                $this->Flash->error('Invalid link or link has expired, please try again.');
                $this->redirect(['action'=>'recover']);
            }
            
            //All good set public view
            $this->viewBuilder()->layout('login');
        }else{
            $cuerrent_user = $this->Auth->user('id');
            //if not owner or admin reject
            if($id != $cuerrent_user && !$this->isAdmin()){
                $this->Flash->error('You do not have permission to reset another users password.');
                $this->redirect($this->referer());
            }
        }
        
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        
        if($user->provider != 'local'){
            $this->Flash->error('You cannot reset passwords from external auth providers.');
            $this->redirect($this->referer());
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, 
                    $this->request->data,
                    ['validate' => 'password']);
            
            if ($this->Users->save($user)) {
                $this->Flash->success('The password has been saved.');
                if(isset($token)){
                    //if token - delete tokens for user password reset
                    $this->Tokens->deleteAll(['user_id'=>$user->id,'type'=>'password_reset']);
                }
                return $this->redirect(['action'=>'view',$id]);
            } else {
                $this->Flash->error('The password is not changed.');
            }
        }
        
        $this->set(compact('user'));
    }
    
    public function registration($id = null){
        $action = $this->request->query('task');
        
        switch($action){
            case 'email_verify':
                $this->loadModel('Tokens');
                $token = $this->request->query('t');
                $password = $this->request->query('p');
                $autherized = $this->Tokens->check('email_verify',$token,$password,$id);
                $test = "test";
                // var_dump($autherized);exit;
                if($autherized != $test ){
                    $user = $this->Users->get($id, ['contain' => []]);
                    $user->account_verified = true;
                    
                    //Check if admin
                    $this->loadModel('Settings');
                    $setting = $this->Settings->find()->contain([])->first();
                    if($user->email == $setting->contact_email){
                        $user->group_id = 1;
                    }
           
                    if ($this->Users->save($user)) {
                        $this->Flash->success(__('Email address has been verified!'));
                        $this->Auth->setUser($user);
                        return $this->redirect(['action'=>'home']);
                    }else{
                        $this->Flash->error('Issue verifying email address: System issue - please let us know about this.');
                    }
                    
                }else{
                    $this->Flash->error('Issue verifying email address: Invalid link or link has expired, please try again.');
                }
            break;
        }
        return $this->redirect(['action'=>'home']);
    }
    
    
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->set('page_heading', 'Search Users');
        
        $contain = ['Groups','Departments','UserTypes'];
    	
    	$conditions = array();
    	
    	$alt = [];
    	
    	$conditions = $this->buildConditions($this->Users,$alt);
        
    	if(!$this->request->query('archived')){
            $conditions['Users.active']=1;
        }else{
            $conditions['Users.active']=0;
        }
        
        if($this->request->query('department_id')){
            $user_ids = $this->Users->DepartmentsUsers->find()
                    ->select('user_id')
                    ->contain([])
                    ->where(['department_id'=>$this->request->query('department_id')])
                    ->extract('user_id')->toArray();
            
            $this->request->data['department_id'] = $this->request->query('department_id');
            if(!empty($user_ids)){
                $conditions['Users.id IN'] = $user_ids;
            }else{
                $conditions['Users.id'] = 0;
            }
            
        }
        
        $this->paginate = [
            'contain' => $contain,
                'conditions'=>$conditions,
                'limit' => 30,
                'order' => [
                    'Users.given_name'
                ]
        ];
        
        $groups = $this->Users->Groups->find('list');
        $users = $this->paginate($this->Users);
        $departments = $this->Users->Departments->find('list', ['order' => 'name'])->where(['active'=>true]);
        $userTypes = $this->Users->UserTypes->find('list', ['order' => 'title'])->where(['active'=>true]);

        $this->set(compact('users','groups','departments','userTypes'));
        //
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if(!isset($id) && $this->Auth->user('id')){
            return $this->redirect(['action'=>'view',$this->Auth->user('id')]);
        }

        $TestsTable = TableRegistry::get('course_tests');
        $test = $TestsTable->find()
        ->toArray();
        
        $TestsTypeTable = TableRegistry::get('course_test_types');
        $TestTypes = $TestsTypeTable->find()
        ->toArray();

        $CourseTable = TableRegistry::get('courses');
        $course = $CourseTable->find()
        ->toArray();
        
        $ResoucesTable = TableRegistry::get('resources');
        $resources = $ResoucesTable->find()->where(['active' => 1])
        ->toArray();


        
        // var_dump($resources);exit;


        
        $isOwner = $this->isOwner($id);
        if(!$isOwner && !$this->isAdmin() && !$this->isOfficer()){
            $this->Flash->error(__('Sorry you do not have access to this record.'));
            return $this->redirect($this->referer());
        }        
      
        $user = $this->Users->get($id, [
            'contain' => [
                'Groups', 
                'Departments', 
                // 'test',
                'Leads',
                'Flags', 
                'UserTypes',
                'Certifications'=>[
                    'CertificationTypes','Validated'
                    ], 
                'UserNotes', 
                'Equipment',
                'Registers'=>[
                    'Departments','RegisterClasses','RegisterTemplates'=>['fields'=>['id','name']]],
                'EquipmentReservations'=>[
                    'conditions'=>[
                        'OR'=>[
                            'EquipmentReservations.end >='=>date('Y-m-d')
                            ]],
                    'Equipment.EquipmentTypes'],
                'UserDocs', 
                'UserStatuses',
                'EnrolledCourses',
                'EnrolledModules'
                ]
        ]);
        
        // var_dump($user);exit;

        if($this->request->query('VerifyEmail')){
            $this->validateEmail($user);
            
            $this->Flash->success(__('Verify Email Sent.'));
            // $this->loadComponent('Email', ['className' => 'Email']);
            // $to = "testtesting2111@gmail.com";
            // $subject = "Hi buddy, i got a message for you";
            // $message = 'hai '.'testtesting2111@gmail.com'.'<br/>Please confirm your email link below<br><a href="http://localhost:8765/users/verification/testtesting2111@gmail.com">Verification Email</a><br/>Thank you for joining';
            // try {
            //     $mail = $this->Email->send_mail($to, $subject, $message);
            // } catch (Exception $e) {
            //     echo "Messenge count send ",$mail->ErrrInfo;
            // }
            $hash = substr(Security::hash($user->email.date('YmdHHMMII'), 'sha1', true),0,50);
          
            Email::configTransport('gmail', [
                'host' => 'ssl://smtp.gmail.com',
                'port' => 465,
                'username' => 'testtesting2111@gmail.com',
                'password' => 'qazwsx0421',
                'className' => 'Smtp'
              ]);
                $ms = 'Click on the link below to complete registration ';
            $ms .= 'http://localhost/taro/users/verify?t=' . $hash . '&n=' . $user->email . '';
            $ms = wordwrap($ms, 70);
              $email = new Email('default');
              $email->transport('gmail');
              $email->emailFormat('html');
              $email->from("testtesting2111@gmail.com",'dededede');
              $email->subject('Please Confirm you entry');
              $email->to("testtesting2111@gmail.com");
              $email->send($ms);
            $user->hash =  $hash;
            $this->Users->save($user);
        
             $this->redirect(['action'=>'view',$id]);

        }
        
        if($this->request->query('StatusEmail')){
            $this->Users->sendStatusEmail($user->id);
            $this->Flash->success(__('Status Email Sent.'));
            $this->redirect(['action'=>'view',$id]);
        }
        
        // dump((!$isOwner || $this->isAdmin() || $this->isOfficer()));exit;
        // if($isOwner && !$user->complete){//If profile not configured redirect to setup
        //     return $this->redirect(['action' => 'edit',$id]);
        // }
        
        
        $userNote = $this->Users->UserNotes->newEntity();
        if ($this->request->is('post') && $this->request->data('post_type')=='UserNotes') {
            $this->request->data['type'] = 'Note';
            $this->request->data['user_id'] = $id;
            $this->request->data['created_by'] = $this->Auth->user('id');
            $userNote = $this->Users->UserNotes->patchEntity($userNote, $this->request->data);
            if ($this->Users->UserNotes->save($userNote)) {
                $this->Flash->success(__('The user note has been saved.'));

                return $this->redirect(['action' => 'view',$id]);
            }
            $this->Flash->error(__('The user note could not be saved. Please, try again.'));
        }
        
        
        if($user->group_id == 7 && ($this->isAdmin() || $this->isOfficer())){
            $groups = $this->Users->Groups->find('list', [
                'conditions'=>[
                    'id >='=>(int)$this->Auth->user('group_id'),
                    'id <'=> 7
                    ],
                'order' => ['id'=>'DESC']]);
            $this->set('groups', $groups);            
        }
        
        //Get trips and logs
    
        
        $this->set('page_heading', $user->name);
        $this->set(compact('user', 'isOwner','userNote','test','TestTypes','course','resources'));
        if($this->request->query('pdf')){
            $this->viewBuilder()->layout('pdf');
            $this->render('pdf/view');
        }
        
        $this->viewBuilder()->options([
                'pdfConfig' => [
                    'filename' => h($user->given_name).'_'.h($user->surname).'.pdf'
                ]
            ]);
        
        //
    }

    public function verify($id = null)
    {
        $value = $this->request->getQuery('t');
        $user = $this->Users->find('all')->where(['hash'=>$value])->first();
        $user->account_verified = 1;
        $this->Users->save($user);
    }
    
    public function gmaillogin()
    {
        if( $this->request->is('ajax') ) {
        // echo $_POST['value_to_send'];
          $value = $this->request->data('userdata');
          $userData = $this->request->input('json_decode');
         
          if(!empty($userData->userdata->id)){
          $first_name  =!empty($userData->userdata->given_name)?$userData->userdata->given_name:'';
          $last_name  =!empty($userData->userdata->family_name)?$userData->userdata->family_name:'';
          $email  =!empty($userData->userdata->email)?$userData->userdata->email:'';
             
          $count = $this->Users->find()->where(['email'=>$email])->count();
          $success = false;
          if ($count > 0) {
              // Update user data if already exists
            $user = $this->Users->find()->where(['email'=>$email])->first();
          
            $user->given_name = $first_name;
            $user->surname = $last_name;
            $user->email = $email;
            if ($this->Users->save($user)) {
                // If not authed login as user
                if(!$this->Auth->user()){
                    $this->Auth->setUser($user);
                }
                
                //Send email to validate account
                $this->validateEmail($user);
                
                $success = true;
               
                echo json_encode(["status"=>$success,"url"=>Router::url([ 'action' => 'home'])]);
                exit;
            }
          

          

          }
          else{
            $user = $this->Users->newEntity();
            $user->group_id = 7;
            $user->user_type_id = 1;
            $user->given_name = $first_name;
            $user->surname = $last_name;
            $user->name =  $first_name.' '.$last_name;
            $user->email = $email;
            $user->account_verified = true;
            $user->account_type = 'External';
            $user->provider = 'local';
            $user->active = true;
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user account has been created.'));
                //If not authed login as user
                if(!$this->Auth->user()){
                    $this->Auth->setUser($user);
                }
                
                //Send email to validate account
                $this->validateEmail($user);
                
                $success = true;
               
                echo json_encode(["status"=>$success,"url"=>Router::url([ 'action' => 'view',$user->id])]);
                exit;
            }
          }
          
         
         return false;
         
       }
    }
    }    

    public function facebooklogin()
    {
        if( $this->request->is('ajax') ) {
        // echo $_POST['value_to_send'];
          $value = $this->request->data('userdata');
          $userData = $this->request->input('json_decode');
        
          if(!empty($userData->userdata->id)){
            $first_name  =!empty($userData->userdata->first_name)?$userData->userdata->first_name:'';
            $last_name  =!empty($userData->userdata->last_name)?$userData->userdata->last_name:'';
            $email  =!empty($userData->userdata->email)?$userData->userdata->email:'';
            $name = $first_name.' '.$last_name;
             
          $count = $this->Users->find()->where(['name'=>$name])->orWhere(['email'=>$email])->count();
          $success = false;
          if ($count > 0) {
              // Update user data if already exists
            $user = $this->Users->find()->where(['name'=>$name])->orWhere(['email'=>$email])->first();
          
            $user->surname = $name;
            if ($this->Users->save($user)) {
                // If not authed login as user
                if(!$this->Auth->user()){
                    $this->Auth->setUser($user);
                }
                
                //Send email to validate account
                $this->validateEmail($user);
                
                $success = true;
               
                echo json_encode(["status"=>$success,"url"=>Router::url([ 'action' => 'home'])]);
                exit;
            }
          

          

          }
          else{
            $user = $this->Users->newEntity();
            $user->group_id = 7;
            $user->user_type_id = 1;
            $user->given_name = $first_name;
            $user->surname = $last_name;
            $user->name =  $first_name.' '.$last_name;
            $user->email = $email;
            $user->account_verified = true;
            $user->account_type = 'External';
            $user->provider = 'local';
            $user->active = true;
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user account has been created.'));
                //If not authed login as user
                if(!$this->Auth->user()){
                    $this->Auth->setUser($user);
                }
                
                //Send email to validate account
                $this->validateEmail($user);
                
                $success = true;
               
                echo json_encode(["status"=>$success,"url"=>Router::url([ 'action' => 'view',$user->id])]);
                exit;
            }
          }
          
         
         return false;
         
       }
    }
    }
    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $setting = $this->siteSettings();
        $email = $this->request->query('email');
        if($this->request->query('admin') && $this->Users->find('all')->where(['email'=>$setting->contact_email])->count() > 0){
            
            $this->Flash->error(__('The admin account has already been setup.'));
            return $this->redirect(['action' => 'login']);
        }
        
        
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            
            if($this->request->query('admin')){
                
                $this->request->data['email'] = ($setting)?$setting->contact_email:'';
            }
            
            if(!$this->request->data('name')){
                $this->request->data['name'] = $this->request->data['given_name'].' '.$this->request->data['surname'];
            }
            
            //If group is not set, or user is non admin
            if(!$this->request->data('group_id') || !($this->isAdmin() || $this->isOfficer())){
                $this->request->data['group_id'] = $this->request->data['user_type_id'];

                
            }
            
            $user = $this->Users->patchEntity($user, $this->request->data);
            $user->account_verified = false;
            $user->account_type = 'External';
            $user->provider = 'local';
            $user->active = true;
                        
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user account has been created.'));
                //If not authed login as user
                // if(!$this->Auth->user()){
                //     $this->Auth->setUser($user);
                // }
                
                //Send email to validate account
                $this->validateEmail($user);
                
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $groupTypeID = null;
        if($this->Auth->user()){
            $groupTypeID = $this->Auth->user('group_id');
            $conditions = [
                'active' => true,
                'id >= ' => $this->Auth->user('group_id')
            ];
        }else{
            $conditions = [
                'active' => true,
                'id' => 6
            ];
        }
        $userTypes = $this->Users->UserTypes->find('list', ['order' => 'title'])->where($conditions)->toArray();
        
        $this->set(compact('user','userTypes','groupTypeID', 'email'));
        
        if($this->request->query('admin')){
            $this->render('add_admin');
        }
    }
    
    private function validateEmail($user){
        
        $this->loadModel('Tokens');
        
        if($user->ask_for_new_password){
            $token = $this->Tokens->generate('new_password',$user->id);
            $link = array_merge(['controller'=>'Users','action'=>'newPassword',$user->id,'task'=>'new_password'],$token);
            // dump(Router::url($link, true ));exit;
            if(!$token){
                return false;
            }
        }else{
            $token = $this->Tokens->generate('email_verify',$user->id);
            $link = array_merge(['controller'=>'Users','action'=>'registration',$user->id,'task'=>'email_verify'],$token);
            if(!$token){
                return false;
            }
        }
        // dump(Router::url($link, true ));exit;
        // define data to be read by template
        $userDataArr = array(
            'link' => Router::url($link, true ),    
            'userName' => $user->name,    
            'userEmail' => $user->email
        );

        // compile and send email
        $emailTemplate = 'confirm_email';
        $emailTo = $user['email'];
        $emailName = $user['name'];
        $emailSubject = 'Confirm your email address';
        $this->emailTo($userDataArr, $emailTemplate, $emailTo, $emailName, $emailSubject);

        return true;
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */


    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Departments', 'Flags','Leads']
            ]);
           
     
            //Check they are higher or equal group
            if($user->group_id < $this->Auth->user('group_id')){
                $this->Flash->error(__('Access denied'));
                return $this->redirect($this->referer());
            }
            
            // if($this->isAdmin()){
                $providers['local'] = 'External';
                if(\Cake\Core\Configure::check('LDAP')){
                    $providers['ldap'] = \Cake\Core\Configure::read('LDAP.name');
                }
                
                if(\Cake\Core\Configure::check('Shibboleth')){
                    $providers['shibboleth'] = \Cake\Core\Configure::read('Shibboleth.title');
                }
                $this->set('providers',$providers);
                // var_dump($providers);exit;
        // }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['complete'] = true;//if save works profile is complete
            $true = true;            
            if($this->request->data('provider')
                    // || isset($true)  
                    && isset($providers) 
                    && isset($providers[$this->request->data('provider')])){
                           
                $this->request->data['account_type'] = $providers[$this->request->data('provider')];
            }else{
                unset($this->request->data['provider']);
            }
            
            $user = $this->Users->patchEntity($user, $this->request->data);
            
            
            if ($this->Users->save($user)) {
                if(array_key_exists('profile_url', $this->request->data)){
                    if($this->request->data['profile_url']['size']){
                        if(!file_exists(WWW_ROOT.'upload/users/'. $user->id)){
                            mkdir(WWW_ROOT.'upload/users/'. $user->id, 0077, true);
                        }
                        move_uploaded_file($this->request->data['profile_url']['tmp_name'], WWW_ROOT . $user->profile_url);
                        var_dump($this->request->data['profile_url']['tmp_name'], WWW_ROOT . $user->profile_url);exit;
                    }
                }
                $this->Flash->success(__('Profile has been updated.'));
                ($this->Auth->user('id') == $user->id) ? $this->Auth->setUser($user) : '';
                return $this->redirect(['action' => 'view', $user->id]);
            }
            $this->Flash->error(__('The profile could not be saved. Please, try again.'));
        }
        
        $groups = $this->Users->Groups->find('list', [
            'conditions'=>['id >='=>(int)$this->Auth->user('group_id')],
            'order' => ['id'=>'DESC']]);
        
        $userTypes = $this->Users->UserTypes->find('list', ['order' => 'title'])->where(['active'=>true])->toArray();
        
        //$facilities = $this->Users->Facilities->find('list', ['limit' => 200]);
        $departments = $this->Users->Departments->find('list', ['order' => 'name'])->where(['active'=>true]);
        $flags = $this->Users->Flags->find('list', ['order' => 'title','keyField'=>'title']);
        $this->set(compact('user', 'groups', 'departments', 'flags','userTypes'));
        
        if(!$user->complete){//If profile has not been setup - make public layout.
            $this->Flash->error(__('Please review and update your profile before continuing. Ensure all fields are up to date and correct.'));
            $this->viewBuilder()->layout('public');
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        
        if($user->group_id != 7){
            //Can only delete new users - Mark others inactive
            $msg = 'deleted';
            if($user->active){
                $user->active = 0;
            }else{
                $user->active = 1;
                $msg = 'restored';
            }
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been '.$msg.'.'));
            } else {
                $this->Flash->error(__('The user could not be '.$msg.'. Please, try again.'));
            }
            return $this->redirect(['action' => 'index']);
        }
            
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function disable($id = null){
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        
        $msg = 'disabled';
        if($user->disabled){
            $user->disabled = 0;
            $user->active = 1;
            $msg = 'enabled';
        }else{
            $user->disabled = 1;
            $user->active = 0; //Also make inactive so not showing in views
        }
        if ($this->Users->save($user)) {
            $this->Flash->success(__('The user has been '.$msg.'.'));
        } else {
            $this->Flash->error(__('The user could not be '.$msg.'. Please, try again.'));
        }
        return $this->redirect(['action' => 'view',$id]);
    }

    public function listTests($id = null){
        if(!isset($id) && $this->Auth->user('id')){
            return $this->redirect(['action'=>'view',$this->Auth->user('id')]);
        }
        
        
        $isOwner = $this->isOwner($id);
        if(!($isOwner || $this->isAdmin() || $this->isOfficer())){
            $this->Flash->error(__('Sorry you do not have access to this record.'));
            return $this->redirect($this->referer());
        }

        $this->Users->get($id, [
            'contain' => [
                
            ]
        ]);
    }

    public function search(){
        $value = $this->request->getQuery('search');
        $this->viewBuilder()->setLayout('taro');
        $users = $this->Users->find()->where(['user_type_id' => 6]);
        if($value) {
            $users = $users->where([ 'OR' => 
                [
                    'given_name LIKE' => '%'.$value.'%',
                    'surname LIKE' => '%'.$value.'%',
                    'name LIKE' => '%'.$value.'%',
                    'username LIKE' => '%'.$value.'%',
                ]
            ]);
        }
        $users = $users->toArray();
        $this->set(compact('users', 'value'));
    }

    public function invite(){
        if($this->request->is('ajax')){
            $success = [];
            $failed = [];
            $this->viewBuilder()->layout('ajax');
            $emails = $this->request->query('emails');
            foreach($emails as $email){
                if($this->sendEmailInvite($email)){
                    array_push($success, $email);
                }else{
                    array_push($failed, $email);
                }
            }
            $result = json_encode(['success' => $success, 'failed' => $failed]);
            $this->response->type('json');
            $this->response->body($result);
            $this->response->statusCode(200);
            return $this->response;
        }
    }

    private function sendEmailInvite($email){
        // dump(Router::url(['controller'=>'Users','action'=>'Add','email'=>$email], true ));exit;
        return true;
        // $this->loadModel('Tokens');
        // $token = $this->Tokens->generate('email_invite');

        // if(!$token){
        //     return false;
        // }
        
        // $link = array_merge(['controller'=>'Users','action'=>'Registration','email'=>$email],$token);

        // define data to be read by template
        $userDataArr = array(
            'link' => Router::url(['controller'=>'Users','action'=>'Add','email'=>$email], true ),    
        );

        // compile and send email
        $emailTemplate = 'email_invite';
        $emailTo = $email;
        $emailName = $email;
        $emailSubject = 'You have been invited to create a user account at toro';
        $this->emailTo($userDataArr, $emailTemplate, $emailTo, $emailName, $emailSubject);
    }

    public function newPassword($id){
        $this->loadModel('Tokens');
        $token = $this->request->query('t');
        $password = $this->request->query('p');
        $autherized = $this->Tokens->check('new_password',$token,$password,$id);
        $user = $this->Users->get($id);
        if($autherized && !$user->account_verified){
            $this->viewBuilder()->layout('taro');
            $this->set(compact('user', 'autherized'));
            if ($this->request->is(['patch', 'post', 'put'])) {
                $password = $this->request->getData('password');
                $confirm_password = $this->request->getData('confirm_password');
                if($password != $confirm_password){
                    $this->Flash->login_error(__("Passwords do not match"));
                    return $this->redirect($this->referer());
                }
                $user->password = $password;
                $user->account_verified = true;
                if($this->Users->save($user)){
                    $this->Flash->success(__("Password Saved"));
                    return $this->redirect(['controller'=>'Users','action'=>'login']);
                }
            }
        }
        else{
            $this->Flash->error(__("Link expired"));
            return $this->redirect(['controller'=>'Users','action'=>'login']);
        }
    }

}
