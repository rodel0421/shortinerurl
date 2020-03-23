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


use App\Controller\AppController;
use App\Form\ContactForm;
use Cake\Routing\Router;


/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class FeedbackController extends AppController
{
    var $uses = false;
    var $page_heading = 'Feedback';
    
    public function isAuthorized($user){
        return true;
    }
    
    public function support(){
        
        $contact = new ContactForm();
        if ($this->request->is('post')) {
            
            $data = $this->request->data;
            $data['home'] = Router::url('/', true );
            $data['browser'] = $this->browser_name();
            $data['agent'] = $this->useragent();
            
            if ($contact->execute($data)) {
                $this->Flash->success('Thanks for your message.');
                $this->redirect('/');
            } else {
                $this->Flash->error('There was a problem submitting your form.');
            }
        }

        if ($this->request->is('get')) {
            $user = $this->Auth->user();
            // Values from the User Model e.g.
            $this->request->data('name', $user['name']);
            $this->request->data('email', $user['email']);
        }

        $this->set('contact', $contact);
    }


    protected function browser_name() {

        $ua = $this->useragent();

        if (
            strpos(strtolower($ua), 'safari/') &&
            strpos(strtolower($ua), 'opr/')
        ) {
            // Opera
            $res = 'Opera';
        } elseif (
            strpos(strtolower($ua), 'safari/') &&
            strpos(strtolower($ua), 'chrome/')
        ) {
            // Chrome
            $res = 'Chrome';
        } elseif (
            strpos(strtolower($ua), 'msie') ||
            strpos(strtolower($ua), 'trident/')
        ) {
            // Internet Explorer
            $res = 'Internet Explorer';
        } elseif (strpos(strtolower($ua), 'firefox/')) {
            // Firefox
            $res = 'Firefox';
        } elseif (
            strpos(strtolower($ua), 'safari/') &&
            (strpos(strtolower($ua), 'opr/') === false) &&
            (strpos(strtolower($ua), 'chrome/') === false)
        ) {
            // Safari
            $res = 'Safari';
        } else {
            // Out of data
            $res = $ua;
        }

        return $res;
    }

    protected function useragent(){
        if ( isset( $_SERVER ) ) {
            return $_SERVER['HTTP_USER_AGENT'] ;
        } else {
            global $HTTP_SERVER_VARS ;
            if ( isset( $HTTP_SERVER_VARS ) ) {
                return $HTTP_SERVER_VARS['HTTP_USER_AGENT'] ;
            } else {
                global $HTTP_USER_AGENT ;
                return $HTTP_USER_AGENT ;
            }
        }
    }


}
