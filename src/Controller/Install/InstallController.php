<?php
namespace App\Controller\Install;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
use Migrations\Migrations;
use App\Form\TestEmailForm;


/**
 * CertificationClasses Controller
 *
 * @property \App\Model\Table\CertificationClassesTable $CertificationClasses
 */
class InstallController extends AppController
{

    function beforeFilter(\Cake\Event\Event $event) {
        if (file_exists(TMP.'installed.txt')) {
            echo 'Application already installed.';
            exit();
        }
    }
    
    var $uses = false;
    
    
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index(){
        $errors = [];
        $DBstatus = false;
        $connection = false;
        try {
            $connection = ConnectionManager::get('default');
            $defaultConnected = $connection->connect();
        } catch (\Exception $connectionError) {
            $defaultConnected = false;
            $errorMsg = $connectionError->getMessage();
            if (method_exists($connectionError, 'getAttributes')):
                $attributes = $connectionError->getAttributes();
                if (isset($errorMsg['message'])):
                    $errorMsg .= '<br />' . $attributes['message'];
                endif;
            endif;
            
            $errors['default'] = $errorMsg;
        }
        
        try {
            $connection = ConnectionManager::get('migrate');
            $connected = $connection->connect();
        } catch (\Exception $connectionError) {
            $connected = false;
            $errorMsg = $connectionError->getMessage();
            if (method_exists($connectionError, 'getAttributes')):
                $attributes = $connectionError->getAttributes();
                if (isset($errorMsg['message'])):
                    $errorMsg .= '<br />' . $attributes['message'];
                endif;
            endif;
            
            $errors['migrate'] = $errorMsg;
        }
        
        try {
            $connection = ConnectionManager::get('reports');
            $reportsConnected = $connection->connect();
        } catch (\Exception $connectionError) {
            $reportsConnected = false;
            $errorMsg = $connectionError->getMessage();
            if (method_exists($connectionError, 'getAttributes')):
                $attributes = $connectionError->getAttributes();
                if (isset($errorMsg['message'])):
                    $errorMsg .= '<br />' . $attributes['message'];
                endif;
            endif;
            
            $errors['reports'] = $errorMsg;
        }
        
        //Test if datbase created
        if($connected){
            $migrations = new Migrations();
            try {
                $migrate = $migrations->migrate(['connection' => 'migrate']);
            } catch (\Exception $connectionError) {
                $errorMsg = $connectionError->getMessage();
                if (method_exists($connectionError, 'getAttributes')):
                    $attributes = $connectionError->getAttributes();
                    if (isset($errorMsg['message'])):
                        $errorMsg .= '<br />' . $attributes['message'];
                    endif;
                endif;
                $errors['migrations'] = $errorMsg;
            }
            
            $hasGroups = 0;
            try {
                $hasGroups = count($connection
                    ->execute('SELECT * FROM groups')->fetchAll('assoc'));
            } catch (\Exception $connectionError) {
                $errorMsg = $connectionError->getMessage();
                if (method_exists($connectionError, 'getAttributes')):
                    $attributes = $connectionError->getAttributes();
                    if (isset($errorMsg['message'])):
                        $errorMsg .= '<br />' . $attributes['message'];
                    endif;
                endif;
                $errors['checkgroup'] = $errorMsg;
            }
            
            if($hasGroups == 0){
                try {
                    $seeded = $migrations->seed(['seed'=>'GroupsSeed']);
                } catch (\Exception $connectionError) {
                    $errorMsg = $connectionError->getMessage();
                    if (method_exists($connectionError, 'getAttributes')):
                        $attributes = $connectionError->getAttributes();
                        if (isset($errorMsg['message'])):
                            $errorMsg .= '<br />' . $attributes['message'];
                        endif;
                    endif;
                }
            }
            
            $DBstatus = $migrations->status();
            
        }
        
        $settings = Cache::config('_cake_core_');

        $email_test = new TestEmailForm();
        if ($this->request->is('post')) {
            $data = $this->request->data;
            if ($email_test->execute($data)) {
                $this->Flash->success('Email has been sent, please check that you have received it.');
            } else {
                $this->Flash->error('Email could not be sent.');
            }
        }
        
        $this->set(compact('connected','errors','settings','DBstatus','reportsConnected','defaultConnected', 'email_test'));
    }

    
    function complete() {
        file_put_contents(TMP.'installed.txt', date('Y-m-d, H:i:s'));
        
        return $this->redirect('/');
    }

}
