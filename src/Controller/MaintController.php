<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Cache\Cache;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
use Migrations\Migrations;

/**
 * CertificationClasses Controller
 *
 * @property \App\Model\Table\CertificationClassesTable $CertificationClasses
 */
class MaintController extends AppController
{

    var $uses = false;
    
    const MAJOR = 1;
    const MINOR = 2;
    const PATCH = 3;

    public static function getVersion()
    {
        $commitHash = trim(exec('git log --pretty="%h" -n1 HEAD'));

        $commitDate = new \DateTime(trim(exec('git log -n1 --pretty=%ci HEAD')));
        $commitDate->setTimezone(new \DateTimeZone('UTC'));

        return sprintf('%s %s', $commitHash, $commitDate->format('Y-m-d H:m:s'));
    }
    
    
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index(){
        $responce = $this->getVersion();
        if($this->request->data('task') == 'runMaint'){
            $responce = exec(ROOT.DS.'bin'.DS.'cake Maintenance');
        }
        
        $this->Set('msg',$responce);
    }
    
    public function update(){
        $errors = [];
        $DBstatus = false;
        $connection = false;
        $runUpdate = $this->request->query('run')?true:false;
        
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
            
            if($runUpdate){
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
            
            if($hasGroups == 0 && $runUpdate){
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
        
        $this->set(compact('connected','errors','settings','DBstatus','reportsConnected','defaultConnected'));
    }

}
