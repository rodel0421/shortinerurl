<?php 
$current = $this->request->params['controller'];
$action = $this->request->params['action'];

$group_id = $this->request->session()->read('Auth.User.group_id');
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
if($group_id){
    if($group_id == 1){
        echo $this->element('menu_side_admin');
    }
    else{
        echo $this->element('menu_side_trainer');
    }
}
?>