<?php
namespace App\View\Cell;

use Cake\View\Cell;

class MenuCell extends Cell
{

    public function display(){
        
    }
    
    //Custom credits
    public function credits($facility_id = null){
        $this->loadModel('Configs');
        
        $credits = $this->Configs->find()->where(['title'=>'Credits'])->order(['modified'=>'DESC'])->first();
        $this->set('credits',$credits);
    }
    
    public function alerts($user_id){
        $this->loadModel('Alerts');
        
        $conditions = ['active'=>true,'user_id'=>$user_id];
        
        $this->set('alerts',$this->Alerts->find('all',
            [
                'limit'=>10,
                'order'=>['ack'=>'asc','id'=>'desc'],
                'conditions'=>$conditions]
            ));
        
        $conditions[]='ack IS NULL';
        $this->set('count',$this->Alerts->find('all',
            ['conditions'=>$conditions]
            )->count());
    }
    
    public function alerts_list($user_id){
        $this->loadModel('Alerts');
        
        $conditions = ['active'=>true,'user_id'=>$user_id,'ack IS NULL'];
        
        $this->set('alerts',$this->Alerts->find('all',
            [
                'limit'=>10,
                'order'=>['ack'=>'asc','id'=>'desc'],
                'conditions'=>$conditions]
            ));
    }
    
    public function messages($facility_id = null){
        $this->loadModel('Messages');
        
        $conditions = [
                'expires >='=>date('Y-m-d'),
                'active'=>true];
        if($facility_id){
            $conditions['Messages.facility_id']=$facility_id;
        }else{
            $conditions[]='Messages.facility_id IS NULL';
        }
        
        
        $this->set('count',$this->Messages->find('all',
            ['conditions'=>$conditions]
            )->count());
        
        $this->set('messages',$this->Messages->find('all',
            ['fields'=>['id','title','created'],
            'limit'=>10,
            'order'=>['created'=>'desc'],
            'conditions'=>$conditions]
            ));
    }
    
    public function messages_ticker($facility_id = null){
        $this->loadModel('Messages');
        
        $conditions = [
                'expires >='=>date('Y-m-d'),
                'active'=>true];
        if($facility_id){
            $conditions['Messages.facility_id']=$facility_id;
        }else{
            $conditions[]='Messages.facility_id IS NULL';
        }
        
        
        $this->set('count',$this->Messages->find('all',
            ['conditions'=>$conditions]
            )->count());
        
        $this->set('messages',$this->Messages->find('all',
            ['fields'=>['id','title','created'],
            'limit'=>10,
            'order'=>['created'=>'desc'],
            'conditions'=>$conditions]
            ));
    }
    
    
}