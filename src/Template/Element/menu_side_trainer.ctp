<?php 
$current = $this->request->params['controller'];
$action = $this->request->params['action'];


?>
<ul class="sidebar-menu">
    <?php if(in_array('People',$enabled_areas)):?>
        <li <?= ($current == 'People' && $action != 'home')?'class="active"':'' ?>>
            <?= $this->Html->link('<i class="fa fa-user"></i> '.'People Lookup',['plugin' => null,'controller'=>'People','action'=>'index'],['escape'=>false])?>
        </li> 
    <?php endif;?>
    <li class="header">Manage</li>
    <li <?= ($current == 'Resources' && $action == 'home')?'class="active"':'' ?>><?= $this->Html->link('<i class="fa fa-circle-o"></i> '.'Resources',
                    ['plugin' => null,'controller'=>'Resources','action'=>'home'],['escape'=>false])?></li>
    <li <?= ($current == 'Users' && $action != 'home')?'class="active"':'' ?>>
        <?= $this->Html->link('<i class="fa fa-user"></i> '.'Users',['plugin' => null,'controller'=>'Users','action'=>'index'],['escape'=>false])?>
    </li>  
    <li <?= ($current == 'Courses' && $action != 'home' && $action != 'inviteUsers')?'class="active"':'' ?>>
        <?= $this->Html->link('<i class="fa fa-graduation-cap"></i> '.'Courses',['plugin' => null,'controller'=>'Courses','action'=>'index'],['escape'=>false])?>
    </li>
    <li <?= ($current == 'Tests' && $action != 'home')?'class="active"':'' ?>>
        <?= $this->Html->link('<i class="fa fa-check"></i> '.'Tests',['plugin' => null,'controller'=>'Tests','action'=>'index'],['escape'=>false])?>
    </li>
    <!-- <li <?= ($current == 'PracticalTests' && $action != 'home')?'class="active"':'' ?>>
        <?= $this->Html->link('<i class="fa fa-question-circle"></i> '.'Practical Test',['plugin' => null,'controller'=>'PracticalTests','action'=>'index'],['escape'=>false])?>
    </li> -->
    <li <?= ($current == 'AllowedDomains' && $action != 'home')?'class="active"':'' ?>>
        <?= $this->Html->link('<i class="fa fa-cloud"></i> '.'Domains',['plugin' => null,'controller'=>'AllowedDomains','action'=>'index'],['escape'=>false])?>
    </li>
    <!-- <li class="header">Invite Users</li>
    <li <?= ($current == 'Courses' && $action == 'inviteUsers')?'class="active"':'' ?>>
        <?= $this->Html->link('<i class="fa fa-plus"></i> '.'Invite Users',['plugin' => null,'controller'=>'Courses','action'=>'inviteUsers'],['escape'=>false])?>
    </li>    -->
</ul>