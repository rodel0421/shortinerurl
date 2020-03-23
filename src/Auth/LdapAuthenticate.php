<?php

namespace App\Auth;

use Cake\Auth\BaseAuthenticate;
use Cake\Log\Log;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use Cake\Utility\Security;
use Cake\Core\Configure\Engine\PhpConfig;
//use adLDAP;
use Adldap\Adldap;

class LdapAuthenticate extends BaseAuthenticate
{
    public function authenticate(\Cake\Network\Request $request, \Cake\Network\Response $response)
    {
        //do not continue with missing or empty account details

        $username = $request->getData('username')? $request->getData('username') : $request->env('PHP_AUTH_USER');
        $password = $request->getData('password')? $request->getData('password') : $request->env('PHP_AUTH_PW');

        if (!is_string($username) || $username === '' || !is_string($password) || $password === '') {
            return false;
        }

        $ldapUser = $this->_ldapAuth($username,$password);

        if (!$ldapUser) {//if no user returned then auth failed with provider
            return false;
        }

        $userModel = $this->_config['userModel'];
        list(, $model) = pluginSplit($userModel);
        $fields = $this->_config['fields'];
        $conditions = [
            $model . '.' . $fields['username'] => $username,
            'provider'=>'ldap'
        ];

        $users = TableRegistry::get($userModel);

        //Get local user using username
        $user = $users->find('anyauth')
                ->where($conditions)
                ->first();

        //if no user then check for local account with same email
        if(!$user && isset($ldapUser['email']) && !empty($ldapUser['email'])){
            
            $user = $users->find('anyauth')
                ->where([
                    'email' => $ldapUser['email'],
                    'provider'=>'local'
                ])
                ->first();
        }
        
        if (!$user) {
            //Create user
            $user = $users->newEntity();
            $user->group_id = 7;
            Log::write('debug', 'Create new user: '.$ldapUser['username']);
        }

        $user = $users->patchEntity($user, $ldapUser);

        //try save
        $saved = $users->save($user);
        if(!$saved){
            $errors = $user->getErrors();
            //check if the only error is a duplicate name
            unset($errors['name']);
            if(empty($errors)){
                //try add username to name then save again
                $user->name = $ldapUser['name'] . ' - ' .$user->username;
                $saved = $users->save($user);
            }
            
        }
        
        
        if (!$saved) {
            //debug($user);
            Log::write('debug', 'Error saving user: '.$user->username);
            Log::write('debug', $user->getErrors());
            
            //allow login without save if they are existing user
            if($user->isNew()) return false;
        }

        //get user after save with groups
        $user = $users->find('anyauth')
                ->where([$model . '.id'=>$user->id])
                ->first();

        return $user->toArray();
    }

    /**
 * Lets check LDAP
 *
 * @return mixed Array of user data from ldap, or false if bind fails
 */
    function _ldapAuth($username,$password) {
        //Log::write('debug', '_ldapAuth: '.$username);
        if(!Configure::check('LDAP')){
            Log::write('debug', 'LDAP dosnt exist in config');
            return false;
        }
        
        $config = Configure::read('LDAP');

        try {
            $adldap = new Adldap($config['ldap']);
            $provider = $adldap->connect('default');
        }catch (\Adldap\Exceptions\AdldapException $e) {
            Log::write('debug', 'Error: AdldapException');
            //debug($e);
            //$adldap->getConnection()->showErrors();
            //throw new NotFoundException($e);
            return false;
        }
        //Log::write('debug', 'Test login name: '.$username);

        $ldapUser = array();
        try {
            //test auth binding as user
            $authUser = $provider->auth()->attempt($username, $password, $bindAsUser = true);
            
        }catch (\Adldap\Exceptions\AdldapException $e) {
            Log::write('debug', 'Error ');
            //debug($e);
            //throw new NotFoundException($e);
            return false;
        }
                
        if ($authUser === true) {

            $search = $provider->search();
            $user = $search->findBy('uid', $username);
            
            $name = (!empty($user->displayname[0]))?$user->displayname[0]:$user->cn[0];
            $ldapUser = array(
                'name'=>$name,
                'given_name'=>$user->givenname[0],
                'surname'=>$user->sn[0],
                'username'=>$username,
                'email'=>(!empty($user->mail[0]))?$user->mail[0]:'',
                'account_type'=>isset($config['name'])?$config['name']:'Uni',
                'provider'=>'ldap',
                'account_verified'=>1,
                'password'=>Security::hash(date('YmdHHMMII'), 'sha1', true),
                'active'=>1
            );

        }else{
                //throw new NotFoundException($adldap->getLastError());
            Log::write('debug', 'Not found or bad pass: '.$username);
            return false;
        }
        return $ldapUser;
    }
}
