<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\StringTemplateTrait;

class DakHelper extends Helper{
    
    public $helpers = ['Html'];
    
    public $classes = [
        0=>'default',
        1=>'success',
        2=>'warning',
        3=>'danger',
        4=>'info'
    ];
    
    public $status = array(
    	'0'=>'NA',
        '1'=>'Good',
        '2'=>'Expiring Soon/pending validation',
        '3'=>'Not Current',
        '4'=>'Incomplete'
    );
    
    public function link($title, $url, $options = []){
        $this->allow_file($url);
        
        return $this->Html->link($title, $url, $options);
    }
    
   

    public function image($url, $options = []){
        $this->allow_file($url);
        
        return $this->Html->image($url, $options);
    }
    
    public function allow_file($url){
        
        if(!is_array($url) && substr( $url, 0, 8 ) === '/upload/'){
            $allowed_files = $this->request->session()->check('Files.allowed') ? $this->request->session()->read('Files.allowed'):[];
            if (!in_array($url,$allowed_files)){
                $allowed_files[] = $url; 
            }
            $this->request->session()->write('Files.allowed',$allowed_files);
        }
        
        return true;
    }
    
    function getContrastYIQ($hexcolor){
	$r = hexdec(substr($hexcolor,0,2));
	$g = hexdec(substr($hexcolor,2,2));
	$b = hexdec(substr($hexcolor,4,2));
	$yiq = (($r*299)+($g*587)+($b*114))/1000;
	return ($yiq >= 128) ? 'black' : 'white';
    }
    
    public function showDateLabel($date){
        //if(method_exists )
        if(method_exists ($date,'format')){
            return '<span class="label label-'.$this->getDateClass($date).'">'.$date.'</span>';
        }
        
        return $date;
    }
    
    public function getDateClass($date){
        if(!method_exists ($date,'format')){
            return $this->classes[0];//no date
        }
        
        if($date && $date->format('Y-m-d') > date("Y-m-d", strtotime("+1 month"))){
            $status = 1; //Good
        }elseif($date && $date->format('Y-m-d') > date("Y-m-d")){
            //Will expire in the next month
            $status = 2;
        }else{
            //Has expired already
            $status = 3;
        }
        
        return $this->classes[$status];
    }
    
    public function getStatusClass($status){
        $status = (int) $status;
        if($status < 0) $status = 0;
        if($status > 4) $status = 4;
        
        return $this->classes[$status];
    }
    
    public function getStatus($status){
        $status = (int) $status;
        if($status < 0) $status = 0;
        if($status > 4) $status = 4;
        
        return $this->status[$status];
    }
    
    public function displayStatus($userStatus){
        $status = isset($userStatus->status)?$userStatus->status:0;
        $date = isset($userStatus->status_date) ? $userStatus->status_date:null;
        $type = isset($userStatus->type) ? $userStatus->type.' - ':'';
        $dateStatus = '';
        if($date && !$this->checkStatusDate($date)){
            $dateStatus = '<i class="fa fa-exclamation-circle text-danger" data-toggle="tooltip" title="Last updated - '.$date.'"></i>';
        }
        
        return '<i class="fa fa-circle status_'.$status.'" data-toggle="tooltip" title="'.$type.
                $this->getStatus($status).'"></i>'.$dateStatus;
    }
    
    public function checkStatusDate($date){
        if(!method_exists ($date,'format')){
            return false;
        }
        
        //If status date less than 1 week old it is considered good
        if($date && $date->format('Y-m-d') > date("Y-m-d", strtotime("-1 week"))){
            return true;
        }
        
        return false;
    }
    
    public function inlineCss($html, $css){
        $cssToInlineStyles = new \Utility\Utility\Email\CssToInlineStyles();
        
        return $cssToInlineStyles->convert(
            $html,
            $css
        );    
    }
}