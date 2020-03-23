<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * CertificationClasses Controller
 *
 * @property \App\Model\Table\CertificationClassesTable $CertificationClasses
 */
class FilesController extends AppController
{

    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow(['index']);
        
    }
    
    var $uses = false;
    
    public function index(){
        //File paths will be /upload/<<path to file>> in the links
        
        //File will contain just the <<path to file>>
        $file = isset($this->request->params['pass']) ? implode( DS,$this->request->params['pass']):false;
        
        if($file === false) throw new \Cake\Network\Exception\NotFoundException('Invalid link.');
        
        if(isset($this->request->params['_ext'])) $file .= '.'.$this->request->params['_ext'];
        
        //Check if access has been allowed to current user
        //It will live in the session
        $allowed_files = $this->request->session()->read('Files.allowed');
        
        
        if(!is_array($allowed_files) || !in_array('/upload/'.$file,$allowed_files)){
            //Is not allowed access
            throw new \Cake\Network\Exception\UnauthorizedException('File link expired.');
        }
        
        //is allowed so check if file exists
        //Set file to real path
        $file = realpath(ROOT.DS.'secupload'.DS.$file);
        
        if(file_exists($file)){
            //Check folder is safe
            $Folder = new Folder(dirname ( $file));
            //Folder is safe
            if($Folder->inPath(realpath(ROOT.DS.'secupload'.DS))){
                $this->response->file($file);
                return $this->response;
            }
        }
                
        //file not found
        throw new \Cake\Network\Exception\NotFoundException('File not found.');
        
    }

}
