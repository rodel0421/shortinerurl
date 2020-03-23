<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Auth;

use Cake\Auth\BaseAuthenticate;
use Cake\Controller\ComponentRegistry;
use Cake\Network\Request;
use Cake\Event\Event;
use Cake\Network\Response;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use Cake\Controller\Component\CookieComponent;

class CookieAuthenticate extends BaseAuthenticate
{
    public function __construct(ComponentRegistry $registry, array $config = [])
    {
        $this->_registry = $registry;
        $this->config([
            'cookie' => [
                'name' => 'CookieAuth'
            ]
        ]);
        $this->config($config);
    }
    
    public function authenticate(Request $request, Response $response)
    {
        if (!isset($this->_registry->Cookie) || !$this->_registry->Cookie instanceof CookieComponent) {
            throw new \RuntimeException('You need to load the CookieComponent.');
        }
        
        // Do things for OpenID here.
        // Return an array of user if they could authenticate the user,
        // return false if not.
        $user = $this->_registry->Cookie->read($this->_config['cookie']['name']);
        
        if($user && isset($user['t']) && isset($user['p'])&& isset($user['id'])){
            
            $tokens = TableRegistry::get('Tokens');
            //check if auth is good
            $autherized = $tokens->check('CookieAuth',$user['t'],$user['p'],$user['id']);
            
            if(!$autherized) return false;
            
            $userModel = $this->_config['userModel'];
            $users = TableRegistry::get($userModel);
            
            //check if user exists and is active
            $authUser = $users->find('anyauth')
                ->where(['Users.id'=>$user['id']])
                ->first();
            
            //happy
            if($authUser) return $authUser->toArray();
            
        }
            
        //No cookie set or no user with id
        return false;
    }
    
    /**
     * Returns a list of all events that this authenticate class will listen to.
     *
     * @return array
     */
    public function implementedEvents()
    {
        return [
            'Auth.logout' => 'logout'
        ];
    }
    /**
     * Delete cookies when an user logout.
     *
     * @param \Cake\Event\Event  $event The logout Event.
     * @param array $user The user about to be logged out.
     *
     * @return void
     */
    public function logout(Event $event, array $user)
    {
        $this->_registry->Cookie->delete($this->_config['cookie']['name']);
    }
}