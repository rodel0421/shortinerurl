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
namespace App\Controller\Rep;

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

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        
        $authConfig = [
            //AuthComponent::ALL => ['fields' => ['username' => 'email']],
            'authorize' => ['Controller'],
            'unauthorizedRedirect' => false,
            'loginAction' => false,
            'authenticate' => [
                'Basic' =>[
                   'finder'=>'auth'
                ],
            ],
        ];
        
        if(Configure::check('LDAP')){
            $authConfig['authenticate'][] = 'Ldap';
        }
        
        $this->loadComponent('Auth', $authConfig);

        $this->loadComponent('Security');
        $this->loadComponent('Csrf');
        
        Time::$defaultLocale = 'en_AU';
	    Time::setToStringFormat('dd/MM/yyyy');
    }
    
    public function isAuthorized($user){
        
        //Readonly, officer and admin can use report API
        if (isset($user['group_id']) && $user['group_id'] <= 3) {
            return true;
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
                    $this->_has_facility = true;
                }else{
                    $this->_has_facility = false;
                }
            }else{
                $this->_has_facility = false;
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
        if (!$this->Auth->user()) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
            }else{
               throw new \Cake\Network\Exception\UnauthorizedException(__('You don\'t belong here.'));
            }
        }
        
    }

    
    public function beforeRender(Event $event)
    {
        $this->viewBuilder()->className('Json');
        
    }
    
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
            }
        }
        return $conditions;
    }
    
}
