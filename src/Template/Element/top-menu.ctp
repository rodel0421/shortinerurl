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
?>
<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
<ul class="nav navbar-nav">
<li <?= ($current == 'Users' && $action != 'view')?'class="active"':'' ?>>
    <?= $this->Html->link('<i class="fa fa-home"></i> '.'Home',['plugin' => null,'controller'=>'Users','action'=>'view'],['escape'=>false])?>
</li> 

<?php if(in_array('People',$enabled_areas)):?>
<?php if($group_id && $group_id <= 5)://User / Operator?>
<li <?= ($current == 'People' && $action != 'home')?'class="active"':'' ?>>
    <?= $this->Html->link('<i class="fa fa-user"></i> '.'People Lookup',['plugin' => null,'controller'=>'People','action'=>'index'],['escape'=>false])?>
</li> 
<?php endif;?>
<?php endif;?>

<li <?= ($current == 'Resources')?'class="active"':'' ?>>
    <?= $this->Html->link('<i class="fa fa-book"></i> '.'Resources',['plugin' => null,'controller'=>'Resources','action'=>'home'],['escape'=>false])?>
</li>
<li <?= ($current == 'Feedback')?'class="active"':'' ?>>
<?= $this->Html->link('<i class="fa fa-envelope"></i> Contact Us',['plugin' => null,'controller'=>'Feedback','action'=>'support'],['escape'=>false])?></li>
</ul>
<?php //Search would go here ?>
</div>