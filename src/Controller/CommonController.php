<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Routing\Router;

/**
 * Documents Controller
 *
 * @property \App\Model\Table\DocumentsTable $Documents
 */
class CommonController extends AppController
{

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
        
        
        //managers can add / edit delete
        if (in_array($this->request->action, ['ckupload'])) {
            if ($user['group_id'] <= 2) {
                return true;
            }
        }
        
        //Admins have all
        return parent::isAuthorized($user);
    }
    
    public function beforeFilter(\Cake\Event\Event $event){
         $this->Security->config('unlockedActions', ['ckupload']);
         $this->eventManager()->off($this->Csrf);
         return parent::beforeFilter($event);
    }
    
    function ckupload() {
    	$this->layout = 'ckupload';
    	$basePath = WWW_ROOT.'upload'.DS.'ckeditor'.DS;
    	
    	$baseUrl = Router::url('/upload/ckeditor/');
    	    	
    	$CKEditor = (($this->request->query('CKEditor')))?$this->request->query('CKEditor'):'' ;
    	
    	$funcNum = (($this->request->query('CKEditorFuncNum')))?$this->request->query('CKEditorFuncNum'):'' ;
    	
    	$langCode = (($this->request->query('langCode')))?$this->request->query('langCode'):'' ;
    	
    	$url = '' ;
    	
    	// Optional message to show to the user (file renamed, invalid file, not authenticated...)
    	$message = '';
    	
    	// in CKEditor the file is sent as 'upload'
    	if (isset($_FILES['upload'])) {
            $name = $_FILES['upload']['name'];
            if (!file_exists($basePath)) {
                mkdir($basePath, 0777, true);
            }
            move_uploaded_file($_FILES["upload"]["tmp_name"], $basePath . $name);
            $url = $baseUrl . $name ;
    	}else{
            $message = 'No file has been sent';
    	}
    	
    	$this->set(compact('message','url','funcNum'));
    } //end ckupload()
    
}
