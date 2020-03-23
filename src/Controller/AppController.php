<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\Routing\Router;
use Cake\Core\Configure;
use Cake\Mailer\Email;
use Cake\Utility\Hash;


/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    public $helpers = [
        'Dak',
        'Html' => [
            'className' => 'Bootstrap.BootstrapHtml'
        ],
        'Form' => [
            'className' => 'Bootstrap.BootstrapForm',
            'templates'=>[
                'checkbox' => '<input type="checkbox" name="{{name}}" value="{{value}}"{{attrs}}>&nbsp;',
                'inputContainer' => '<div class="input {{type}}{{required}}">{{content}} <p class="help-block">{{help}}</p></div>'
            ]
        ],
        //'Paginator' => [
        //		'className' => 'AdminLTE.AdminPaginator'
        //],
        'Modal' => [
                'className' => 'Bootstrap.BootstrapModal'
        ]
    ];
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Cookie');
        
        $authConfig = [
            //AuthComponent::ALL => ['fields' => ['username' => 'email']],
            'authorize' => ['Controller'],
            'loginRedirect' => [
                'controller' => 'Users',
                'action' => 'home'
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
            'authenticate' => [
                'Form' =>[
                   'finder'=>'auth'
                ],
                'Cookie' =>[
                   'finder'=>'auth'
                ],
            ],
            'flash'=>['element'=>'error']
        ];

        if(Configure::check('LDAP')){
            $authConfig['authenticate'][] = 'Ldap';
        }
        
        $this->loadComponent('Auth', $authConfig);

        /*
         * Enable the following components for recommended CakePHP security settings.
         * see http://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        $this->loadComponent('Security');
        $this->loadComponent('Csrf');
        
        Time::$defaultLocale = 'en_AU';
	    Time::setToStringFormat('dd/MM/yyyy');
    }
    
    public function isAuthorized($user){
        
        // Bare minimum to all
        /*
         * 
            1 	Admin
            2 	Officer / Manager
            3 	Read Only
            4 	Staff
            5 	User / Operator
            6 	Student
            7 	Limited
         */

        // Admin can access every action
        if (isset($user['group_id'])) {
            if($user['group_id'] === 1){
                return true;
            }
            elseif($user['group_id'] === 2){
                if(in_array($this->request->getParam('controller'), ['Users','UserAnswers','AllowedDomains','Courses', 'Modules', 'UserTests', 'Tests','CourseQuestions', 'Alerts', 'CourseQuestionChoices'])){
                    return true;
                }
                return false;
            }
            elseif($user['group_id'] === 3){
                
            }
            elseif($user['group_id'] === 4){
                
            }
            elseif($user['group_id'] === 5){
                
            }
            elseif($user['group_id'] === 6){
                ((int)$this->request->getParam('pass.0')) ? $item_id = (int)$this->request->getParam('pass.0') : $item_id = 0;
                $controller = $this->request->getParam('controller');
                $action = $this->request->getParam('action');
                if(in_array($controller, ['UserAnswers', 'Alerts'])){
                    return true;
                }
                if($controller == 'Courses'){
                    if(in_array($action, ['myCourses', 'acceptInvitation'] )){
                        return true;
                    }
                    $this->loadModel('CourseEnrolledUsers');
                    if($action == 'viewCourse'){
                        return $this->CourseEnrolledUsers->isUserEnrolled($user['id'], $item_id);
                    }
                }
                if($controller == 'Modules'){
                    $this->loadModel('CourseEnrolledModules');
                    if($this->CourseEnrolledModules->isUserEnrolled($user['id'], $item_id)){
                        return true;
                    }
                }
                if($controller == 'Tests'){
                    if(in_array($action, ['takeTest', 'login', 'logout'])){
                        return true;
                    }
                }
                if($controller == 'UserTests'){
                    if($action == 'generateTestLogin'){
                        return false;
                    }
                    return true;
                }
            }
            elseif($user['group_id'] === 7){
                
            }

        }                    
        // Default deny
        return false;
    }
    
    protected $_isAdmin = null;
    protected function isAdmin(){
        if(!isset($this->_isAdmin)){
            $this->_isAdmin = $this->Auth->user('group_id') == 1;
        }
        return $this->_isAdmin;
    }
    
    protected $_privacyLink = null;
    protected function privacyLink(){
        if(!isset($this->_privacyLink)){
            $privacyLink = null;   
            if (\Cake\Core\Configure::check('Client.privacy_policy_url')) {
                $privacyLink = \Cake\Core\Configure::read('Client.privacy_policy_url');   
            }
            //Remove invalid links
            if (filter_var($privacyLink, FILTER_VALIDATE_URL) === false) {
                $privacyLink = null;    
            }
            $this->_privacyLink = $privacyLink;
        }
        return $this->_privacyLink;
    }
    
    protected $_isOwner = null;
    protected function isOwner($id = ''){
        if(!isset($this->_isOwner)){
            $this->_isOwner = (!empty($id) && $id == $this->Auth->user('id'));
        }
        return $this->_isOwner;
    }
    
    protected $_isOfficer = null;
    protected function isOfficer(){
        if(!isset($this->_isOfficer)){
            $this->_isOfficer = $this->Auth->user('group_id') == 2;
        }
        return $this->_isOfficer;
    }
    
    protected $_has_facility = null;
    protected $_facility = null;
    protected $_facility_id = null;
    protected function has_facility(){
        if($this->_has_facility === null){
            if(isset($this->request->params['scope'])){
                $this->loadModel('Facilities');
                $facility = $this->Facilities->find()
                        ->where(['abv LIKE'=>$this->request->params['scope'],'active'=>true])
                        ->first();
                if(!empty($facility)){
                    $this->_facility = $facility;
                    $this->_facility_id = $facility->id;
                    $this->request->session()->write('facility_id',$facility->id);
                    $this->_has_facility = true;
                }else{
                    $this->_has_facility = false;
                    if($this->request->session()->check('facility_id')) $this->request->session()->delete('facility_id');
                }
            }else{
                $this->_has_facility = false;
                if($this->request->session()->check('facility_id')) $this->request->session()->delete('facility_id');
            }
        }
        return $this->_has_facility;
    }
    protected function facility(){
        if($this->has_facility()){
            return $this->_facility;
        }
        return false;
    }
    protected function facility_id(){
        if($this->has_facility()){
            return $this->_facility_id;
        }
        
        return null;
    }
    
    protected $_userDepartments = null;
    public function userDepartments(){
        if(!isset($this->_userDepartments)){
            $user = $this->Auth->user();
            //TODO: Troubleshoot this
            if($user && is_array($user)){
                $this->_userDepartments = Hash::combine($user, 'departments.{n}.id', 'departments.{n}.name');
            }else{
                $this->_userDepartments = [];
            }
        }
        
        return $this->_userDepartments;
    }
    
    protected $_siteSettings = null;
    protected function siteSettings(){
        if(!isset($this->_siteSettings)){
            $this->loadModel('Settings');
            $this->_siteSettings = $this->Settings->find()->contain([])->first();
        }
        return $this->_siteSettings;
    }
    

    public function beforeFilter(\Cake\Event\Event $event){     
        
        //Automaticaly Login.
        if (!$this->Auth->user() && $this->Cookie->read('CookieAuth')) {

            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
            } else {
                $this->Cookie->delete('CookieAuth');
            }
        }
        
        $isAjax = $this->request->is('ajax');
        $this->set('isAjax',$isAjax);
                
        if (!$this->Auth->user()) {
            $this->Auth->config('authError', false);
            
        if(!$isAjax)
                $this->viewBuilder()->layout('public');
        }elseif($this->Auth->user('group_id') <= 4 && !$isAjax){//Staff and greater
            $this->viewBuilder()->layout('staff');
        }
        
    if(isset($this->request->params['_ext'])&&$this->request->params['_ext'] === 'pdf'){
            $this->viewBuilder()->layout('default');
        }
        
        $this->Auth->allow(['display']);
        
        $this->loadModel('Facilities');
        //Get list of facilities
        $facilityList = $this->Facilities->find('list',['conditions'=>['active'=>true]])->toArray();
	//Get list of facilitie's abvs
        $facilityABV = $this->Facilities->find('list',array('conditions'=>['active'=>true],'valueField'=>'abv'))->toArray();
        
        $currentFacility = $this->facility();
        
        $this->set('collapsedBoxes',$this->Cookie->read('Box'));
        
        $this->set('currentFacility',$currentFacility);
        $this->set('currentFacility_id',$this->facility_id());
        $this->set('facilityList',$facilityList);
        $this->set('facilityABV',$facilityABV);
        
        //Get help guides
        /*$controller = $this->request->params['controller'];
        $this->loadModel('Guides');
        $guides = $this->Guides->find('list',[
            'conditions'=>['Guides.page'=>$controller]])->toArray();
        */
        $setting = $this->siteSettings();
        $this->set('client_name',($setting)?$setting->name:'');
        $this->set('client_abv',($setting)?$setting->abv:'');
        if($currentFacility){
            $this->set('enabled_areas',$currentFacility->enabled_areas);
        }else{
            $this->set('enabled_areas',($setting)?$setting->enabled_areas:[]);
        }
        
        if ($this->Cookie->check('training_data')) {
            $this->set('training_data',true);
        }
        
        //$this->set('current_guides',$guides);
        $this->set('isAdmin',$this->isAdmin());
        $this->set('isOfficer',$this->isOfficer());
        
        $this->set('thisUrl',rtrim(Router::url( $this->here, true ),"/"));
        $this->set('rootUrl',rtrim(Router::url('/', true ),"/"));
        $this->set('app_name','Data Management System');
        $app_logo_text = ($setting && $setting->short)?$setting->short:'DDMS';
        $this->set('app_logo_text',$app_logo_text);
        
        $this->set('app_tag_line','');
        //$this->set('isTrial', $this->isTrial());
       // $this->set('isExpired', $this->isExpired());
        
        if (isset($_COOKIE['defaultLayout_hideSidebar'])) {
            $this->set('layoutHideSidebar', true);
        }


        // Mobile check
        if ($this->RequestHandler->isMobile()) {
            $this->is_mobile = true;
            $this->set('is_mobile', true );
            $this->autoRender = false;
        }         
    }

    function afterFilter(\Cake\Event\Event $event) {
      
        // if in mobile mode, check for a valid view and use it
        if (isset($this->is_mobile) && $this->is_mobile && $event->subject->response->type() == 'text/html') {
            $filePath = APP . 'Template' . DS . 
                $this->request->getParam('controller') . DS . 
                'mobile' . DS . 
                $this->request->getParam('action'). '.ctp';
            $view_file = file_exists($filePath);
            //$layout_file = file_exists( 'LAYOUTS' . 'mobile'. DS . $this->viewBuilder()->getLayout() . '.ctp' );
            
            $this->render(($view_file?'mobile/':'').$this->request->getParam('action')) ;
        }
     }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     
    
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }*/
    
    protected function buildConditions($model,$extra = array()){
        //Dakedit: 2018-01-11
        $params = $this->request->query;
        $modelClass = $model->alias();
        $fields = $model->schema()->columns();
        $conditions = array();
        
        if(empty($params)) return;
         
        foreach($params as $controller => $arr){
            if(!is_array($arr)) continue; //Not valid - skip
            
	    foreach($arr as $col => $value){
                if(empty($value) && $value != 0 ) continue; //Not valid - skip
                
                $key = $controller.'.'.$col;
                $type = 'text';
              
                if(($controller == $modelClass && in_array($col,$fields,true))){
                    $type = $model->schema()->columnType($col);
                }elseif(array_key_exists($key,$extra)){//If custom or in related table
                    if(is_array($extra[$key]) && isset($extra[$key]['type'])){
                      $type = $extra[$key]['type'];
                    }elseif(!empty($extra[$key])){
                      $key = $extra[$key];
                    }
                }else{
                    continue; //Not safe do not add to search
                }
              
                switch($value){
                    case 'isnull':
                     $conditions[] = array("$key IS NULL");
                     break;
                    case 'notnull':
                     $conditions[] = array("$key IS NOT NULL");
                     break;
                    case 'empty':
                     $conditions[] = array("$key = ''");
                     break;
                    case 'notempty':
                     $conditions[] = array("$key != ''");
                     break;
                    default:
                        switch($type){
                            case 'text':
                            case 'string':
                                $conditions[] = array("$key LIKE" => '%'.$value.'%');
                                break;
                            default:
                                $conditions[] = array($key=>$value);
                        }
                }
	      
                $this->request->data[$controller][$col] = $value;
                //$this->request->setData("$controller.$col",$value);
            }
        }
        return $conditions;
    }
    
    protected function emailTo($dataArray, $emailTemplate, $emailTo, $emailName, $emailSubject, $emailAddToArray = NULL)
    {

        //testing
        //$emailTo = 'web-EWxq8O@mail-tester.com';
        /* 
         * dataArray is data to pass to template
         * emailTemplate is the name of the template to email
         * emailName is the receivers name.
         */
         
        if (!isset($dataArray['siteLink'])) {
            $dataArray['siteLink'] = Router::url('/', true);
        }

        if (!isset($dataArray['privacyLink']) && \Cake\Core\Configure::check('Client.privacy_policy_url')) {
            $dataArray['privacyLink'] = \Cake\Core\Configure::read('Client.privacy_policy_url');   
        }

        //Remove invalid links
        if (isset($dataArray['privacyLink']) && filter_var($url, FILTER_VALIDATE_URL) === false) {
            unset($dataArray['privacyLink']);      
        }

        if (!isset($dataArray['loginLink'])) {
            $dataArray['loginLink'] = Router::url('/', true).'users/login';
        }
        
        $setting = $this->siteSettings();
        $dataArray['client_name'] = ($setting) ? $setting->name:'';
        $dataArray['app_logo_text'] = ($setting && $setting->short)?$setting->short:'DDMS';

        if($emailTo){
            try{
                $email = new Email();//'mailgun'
                $email->emailFormat('html');
                $email->template($emailTemplate, 'styled');
                $email->to($emailTo, $emailName);
                if (isset($emailAddToArray)) {
                    foreach ($emailAddToArray as $emailAddTo) {
                        // check that email address is not in the $emailTo var.
                        if ($emailAddTo['email'] !== $emailTo) {
                            $email->addTo($emailAddTo['email'], $emailAddTo['name']);
                        }
                    }
                }
                //$email->from(array('no-reply@daktech.com.au' => 'Daktech'));
                $email->subject($emailSubject);
                $email->viewVars($dataArray);
                $email->send();
            
             } catch (\Exception $ex) {
                return false;
            }
            
            return true;
        }
        
        return false;
    }
}
