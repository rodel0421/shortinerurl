<?php 
$current = $this->request->params['controller'];
$action = $this->request->params['action'];

$group_id = 1;
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
if($group_id && $group_id <= 4)://Staff

?>
<ul class="sidebar-menu">
    <?php if(in_array('People',$enabled_areas)):?>
        <li <?= ($current == 'People' && $action != 'home')?'class="active"':'' ?>>
            <?= $this->Html->link('<i class="fa fa-user"></i> '.'People Lookup',['plugin' => null,'controller'=>'People','action'=>'index'],['escape'=>false])?>
        </li> 
    <?php endif;?>

    <?php if($current == 'Resources'):?>
        <li class="active">
            <?= $this->Html->link('<i class="fa fa-book"></i> '.'Resources',['plugin' => null,'controller'=>'Resources','action'=>'home'],['escape'=>false])?>
            <!-- <ul class="treeview-menu"> -->
                <!-- <li <#?= ($current == 'Resources' && $action == 'home')?'class="active"':'' ?>><#?= $this->Html->link('<i class="fa fa-circle-o"></i> '.'List', -->
                    <!-- ['plugin' => null,'controller'=>'Resources','action'=>'home'],['escape'=>false])?></li> -->
                <!-- <li <#?= ($current == 'Resources' && $action == 'add')?'class="active"':'' ?>><#?= $this->Html->link('<i class="fa fa-circle-o"></i> '.'Add', -->
                    <!-- // ['plugin' => null,'controller'=>'Resources','action'=>'add'],['escape'=>false])?></li> -->
                <!-- <#?php if($isOfficer || $isAdmin):?> -->
                <!-- <li <#?= ($current == 'Resources' && $action == 'index')?'class="active"':'' ?>><#?= $this->Html->link('<i class="fa fa-circle-o"></i> '.'Edit', -->
                    <!-- // ['plugin' => null,'controller'=>'Resources','action'=>'index'],['escape'=>false])?></li> -->
                <!-- <#?php endif;?> -->
            <!-- </ul> -->
        </li>
    <?php else:?>
        <li><?= $this->Html->link('<i class="fa fa-book"></i> '.'Resources',
            ['plugin' => null,'controller'=>'Resources','action'=>'home'],['escape'=>false])?></li>
    <?php endif;?>


    <li <?= ($current == 'Messages')?'class="active"':'' ?>>
        <?= $this->Html->link('<i class="fa fa-sticky-note-o"></i> '.'Notice Board',['plugin' => null,'controller'=>'Messages','action'=>'index'],['escape'=>false])?>
    </li>


    <?php if(in_array($current,['Equipment','EquipmentTypes','EquipmentReservations','EquipmentLogs'])):?>
        <li class="active">
            <?= $this->Html->link('<i class="fa fa-fighter-jet"></i> '.'Equipment',['plugin' => null,'controller'=>'Equipment','action'=>'index'],['escape'=>false])?>
            <ul class="treeview-menu">
                <li <?= ($current == 'Equipment' && $action == 'index')?'class="active"':'' ?>><?= $this->Html->link('<i class="fa fa-circle-o"></i> '.'List',
                    ['plugin' => null,'controller'=>'Equipment','action'=>'index'],['escape'=>false])?></li>
                <li <?= ($current == 'Equipment' && $action == 'add')?'class="active"':'' ?>><?= $this->Html->link('<i class="fa fa-circle-o"></i> '.'Add',
                    ['plugin' => null,'controller'=>'Equipment','action'=>'add'],['escape'=>false])?></li>
                
                <li <?= ($current == 'EquipmentReservations' && $action == 'calendar')?'class="active"':'' ?>><?= $this->Html->link('<i class="fa fa-circle-o"></i> '.'Reservations - Calendar',
                    ['plugin' => null,'controller'=>'EquipmentReservations','action'=>'calendar'],['escape'=>false])?></li>
                
                <?php if($isOfficer || $isAdmin):?>
                <li <?= ($current == 'EquipmentReservations' && $action == 'index')?'class="active"':'' ?>><?= $this->Html->link('<i class="fa fa-circle-o"></i> '.'Reservations',
                    ['plugin' => null,'controller'=>'EquipmentReservations','action'=>'index'],['escape'=>false])?></li>
                
                <li <?= ($current == 'EquipmentReservations' && $action == 'week')?'class="active"':'' ?>><?= $this->Html->link('<i class="fa fa-circle-o"></i> '.'Reservations - Week View',
                    ['plugin' => null,'controller'=>'EquipmentReservations','action'=>'week'],['escape'=>false])?></li>
                
                <li <?= ($current == 'EquipmentTypes')?'class="active"':'' ?>><?= $this->Html->link('<i class="fa fa-circle-o"></i> '.'Types',
                    ['plugin' => null,'controller'=>'EquipmentTypes','action'=>'index'],['escape'=>false])?></li>
                
                <li <?= ($current == 'EquipmentLogs')?'class="active"':'' ?>><?= $this->Html->link('<i class="fa fa-circle-o"></i> '.'Logs',
                    ['plugin' => null,'controller'=>'EquipmentLogs','action'=>'index'],['escape'=>false])?></li>
                <?php endif;?>
                
            </ul>
        </li>
    <?php else:?>
        <li>
            <?= $this->Html->link('<i class="fa fa-fighter-jet"></i> '
                .'Equipment',['plugin' => null,'controller'=>'Equipment','action'=>'index'],['escape'=>false])?>
        </li>
    <?php endif;?>

    <?php if($isOfficer || $isAdmin):?>
    <li class="header">Manage</li>

    <li <?= ($current == 'Dashboards')?'class="active"':'' ?>>
        <?= $this->Html->link('<i class="fa fa-dashboard"></i> <span>Dashboard</span>',['plugin' => null,'controller'=>'Dashboards','action'=>'view'],['escape'=>false])?>
    </li>  

    <?php if(in_array('Registers',$enabled_areas)):?>
        <?php if(in_array($current,['Registers','RegisterTemplates'])):?>
            <li class="active">
                <?= $this->Html->link('<i class="fa fa-cubes"></i> '.'Registers',['plugin' => null,'controller'=>'Registers','action'=>'index'],['escape'=>false])?>
                <ul class="treeview-menu">
                    <li <?= ($current == 'Registers' && $action == 'index')?'class="active"':'' ?>><?= $this->Html->link('<i class="fa fa-circle-o"></i> '.'List',
                        ['plugin' => null,'controller'=>'Registers','action'=>'index'],['escape'=>false])?></li>
                    <li <?= ($current == 'Registers' && $action == 'add')?'class="active"':'' ?>><?= $this->Html->link('<i class="fa fa-circle-o"></i> '.'Add',
                        ['plugin' => null,'controller'=>'Registers','action'=>'add'],['escape'=>false])?></li>
                    <li <?= ($current == 'RegisterTemplates')?'class="active"':'' ?>><?= $this->Html->link('<i class="fa fa-circle-o"></i> '.'Templates',
                        ['plugin' => null,'controller'=>'RegisterTemplates','action'=>'index'],['escape'=>false])?></li>
                </ul>
            </li>
        <?php else:?>
            <li><?= $this->Html->link('<i class="fa fa-cubes"></i> '.'Registers',
                ['plugin' => null,'controller'=>'Registers','action'=>'index'],['escape'=>false])?></li>
        <?php endif;?>
    <?php endif;?>


    <?php if(in_array($current,['Certifications','CertificationTypes','CertificationClasses'])):?>
        <li class="active">
            <?= $this->Html->link('<i class="fa fa-certificate"></i> '.'Certifications',['plugin' => null,'controller'=>'Certifications','action'=>'index'],['escape'=>false])?>
            <ul class="treeview-menu">
                <li <?= ($current == 'Certifications' && $action == 'index')?'class="active"':'' ?>><?= $this->Html->link('<i class="fa fa-circle-o"></i> '.'List',
                    ['plugin' => null,'controller'=>'Certifications','action'=>'index'],['escape'=>false])?></li>
                <li <?= ($current == 'Certifications' && $action == 'add')?'class="active"':'' ?>><?= $this->Html->link('<i class="fa fa-circle-o"></i> '.'Add',
                    ['plugin' => null,'controller'=>'Certifications','action'=>'add'],['escape'=>false])?></li>
                <li <?= ($current == 'CertificationTypes')?'class="active"':'' ?>><?= $this->Html->link('<i class="fa fa-circle-o"></i> '.'Types',
                    ['plugin' => null,'controller'=>'CertificationTypes','action'=>'index'],['escape'=>false])?></li>
                <li <?= ($current == 'CertificationClasses')?'class="active"':'' ?>><?= $this->Html->link('<i class="fa fa-circle-o"></i> '.__('Classes'), 
                    ['plugin' => null,'controller' => 'CertificationClasses', 'action' => 'index'],['escape'=>false]) ?></li>
            </ul>
        </li>
    <?php else:?>
        <li><?= $this->Html->link('<i class="fa fa-certificate"></i> '.'Certifications',
            ['plugin' => null,'controller'=>'Certifications','action'=>'index'],['escape'=>false])?></li>
    <?php endif;?>


    <li <?= ($current == 'Courses' && $action != 'home')?'class="active"':'' ?>>
        <?= $this->Html->link('<i class="fa fa-graduation-cap"></i> '.'Courses',['plugin' => null,'controller'=>'Courses','action'=>'index'],['escape'=>false])?>
    </li>   

    <!-- <li <#?= ($current == 'Modules' && $action != 'home')?'class="active"':'' ?>>
        <#?= $this->Html->link('<i class="fa fa-tasks"></i> '.'Modules',['plugin' => null,'controller'=>'Modules','action'=>'index'],['escape'=>false])?>
    </li>    

    <li <#?= ($current == 'CourseQuestions' && $action != 'home')?'class="active"':'' ?>>
        <#?= $this->Html->link('<i class="fa fa-question-circle"></i> '.'Questions',['plugin' => null,'controller'=>'CourseQuestions','action'=>'index'],['escape'=>false])?>
    </li>    -->

    <!-- <li <#?= ($current == 'Tests' && $action != 'home')?'class="active"':'' ?>>
        <#?= $this->Html->link('<i class="fa fa-check"></i> '.'Tests',['plugin' => null,'controller'=>'Tests','action'=>'index'],['escape'=>false])?>
    </li>    -->

    <li <?= ($current == 'Users' && $action != 'home')?'class="active"':'' ?>>
        <?= $this->Html->link('<i class="fa fa-user"></i> '.'Users',['plugin' => null,'controller'=>'Users','action'=>'index'],['escape'=>false])?>
    </li>    
    
    <li <?= ($current == 'Departments')?'class="active"':'' ?>>
        <?= $this->Html->link('<i class="fa fa-users"></i> '.'Departments',['plugin' => null,'controller'=>'Departments','action'=>'index'],['escape'=>false])?>
    </li>

    <li <?= ($current == 'UserDocs')?'class="active"':'' ?>>
        <?= $this->Html->link('<i class="fa fa-folder-open"></i> '
                .'User Documents',['plugin' => null,'controller'=>'UserDocs','action'=>'index'],['escape'=>false])?>
    </li>

    <li <?= ($current == 'FormTemplates')?'class="active"':'' ?>>
        <?= $this->Html->link('<i class="fa fa-pencil-square-o"></i> '
                .'Form Templates',['plugin' => null,'controller'=>'FormTemplates','action'=>'index'],['escape'=>false])?>
    </li>

    <li <?= ($current == 'Alerts')?'class="active"':'' ?>>
        <?= $this->Html->link('<i class="fa fa-bell-o"></i> '
                .'Notifications',['plugin' => null,'controller'=>'Alerts','action'=>'index'],['escape'=>false])?>
    </li>
<?php else: //User?>
    <li <?= ($current == 'Users' && $action == 'home')?'class="active"':'' ?>>
        <?= $this->Html->link('<i class="fa fa-home"></i> <span>Home</span>','/',['escape'=>false])?>
    </li>  

    <li <?= ($current == 'Trips')?'class="active"':'' ?>>
        <?= $this->Html->link('<i class="fa fa-map-o"></i> '
                .'Trips',['plugin' => null,'controller'=>'Trips','action'=>'index'],['escape'=>false])?>
    </li>

<?php endif;?>

<?php if($isAdmin):?>
    <li class="header">Admin Settings</li>
    <li <?= ($current == 'Facilities')?'class="active"':'' ?>>
        <?= $this->Html->link('<i class="fa fa-bars"></i> '.'Facilities',['plugin' => null,'controller'=>'Facilities','action'=>'index'],['escape'=>false])?>
    </li>

    <li <?= ($current == 'Utility')?'class="active"':'' ?>>
        <?= $this->Html->link('<i class="fa fa-wrench"></i> '.'Maintenance',['plugin' => 'Utility','controller'=>'Utility','action'=>'index'],['escape'=>false])?>
    </li>

    <li <?= ($current == 'Groups')?'class="active"':'' ?>>
        <?= $this->Html->link('<i class="fa fa-lock"></i> '.'Security Groups',['plugin' => null,'controller'=>'Groups','action'=>'index'],['escape'=>false])?>
    </li>

    <li <?= ($current == 'UserTypes')?'class="active"':'' ?>>
        <?= $this->Html->link('<i class="fa fa-cube"></i> '.'User Types',['plugin' => null,'controller'=>'UserTypes','action'=>'index'],['escape'=>false])?>
    </li>

    <li <?= ($current == 'Settings')?'class="active"':'' ?>>
            <?= $this->Html->link('<i class="fa fa-cog"></i> Settings',['plugin' => null,'controller'=>'Settings','action'=>'edit'],['escape'=>false])?></li>
    <?php endif;?>
    <li <?= ($current == 'Feedback')?'class="active"':'' ?>>
            <?= $this->Html->link('<i class="fa fa-envelope"></i> Contact Us',['plugin' => null,'controller'=>'Feedback','action'=>'support'],['escape'=>false])?></li>
    <?php endif;?>
</ul>