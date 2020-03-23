<style>

.skin-orange .main-header .navbar #navbar-collapse .nav > li:nth-child(2) > a {
   display: none;
}
</style>

<?php
// dump($user);

$avatar = 'img/profile.jpg';
if(!empty($user->profile_url)){
    $avatar = $user['profile_url'];
    $this->Dak->allow_file($avatar);
}
$this->assign('title', h($user->name).' Profile');
    
?>
<?php 
//If new user
if ( !$user->account_verified  ): ?>
<div class="alert alert-warning alert-dismissable">
<i class="fa fa-exclamation-circle"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <b>Email address has not been verified</b>
    
    <?= !$user->account_verified ?  $this->Html->link('Resend Verification Email',['action'=>'view',$user->id,'VerifyEmail'=>1],['class'=>'btn btn-success']) :''; ?>

</div>
<?php endif; ?>

<?php 
//If new user
if ( $user->group_id == 7 && ($isOfficer || $isAdmin) ): ?>
<div class="alert alert-info alert-dismissable">
<i class="fa fa-exclamation-circle"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <b>New user account. Please approve or Delete account.</b>
    
    
    <div class='row'>
    <div class='col-md-6'>
        <?= $this->Form->create($user,['url'=>['action'=>'edit',$user->id]]); ?>
    <div class='input-group'>
        <?= $this->Form->input('group_id',[
            'label'=>false,
            'templates'=>[
                'inputContainer' => '{{content}}'
            ],
            'div'=>false
            ])?>
    <div class="input-group-btn">
        <?= $this->Form->button(__('Approve Account'), ['bootstrap-type' => 'success']) ?>
        <ul class="dropdown-menu lookup-data"></ul>
    </div>
    </div>
        <?= $this->Form->end() ?>
    </div>
        <div class='col-md-6'>
            <?= $this->Form->postLink('Delete Account', ['action' => 'delete', $user->id], 
            ['confirm' => __('Are you sure you want to delete {0}?', $user->given_name), 'escape' => false, 
                            'class' => 'btn btn-danger', 'title' => __('Delete')]) ?>
        </div>
    </div>
    
    
    
    
</div>
<?php endif; ?>


<!-- <div class='box box-warning'>
    <div class='box-header'><h3 class='box-title'><?= h($user->name) ?></h3>
    	<div class="box-tools pull-right">
    	    		
    	<?= $this->element('guide', array("section" => 'users')) ?>
            
        <?= $this->Html->link('<span class="fa fa-file-pdf-o"></span><span class="sr-only">' . __('PDF') 
                        . '</span>',
                ['action'=>'view',$user->id,'_ext'=>'pdf'],
                ['escape'=>false,'class'=>'btn btn-sm btn-default','title'=>'Save As PDF'])?>
        <?php if($isAdmin || $isOfficer):?>
            
            <?php if($user->disabled):?>
            <?= $this->Form->postLink('<span class="fa fa-unlock"></span><span class="sr-only">' . __('Enable') 
                        . '</span>',
                ['action' => 'disable', $user->id],
                ['confirm' => __('Are you sure you want to enable this account?'), 'escape' => false, 
                 	'class' => 'btn btn-sm btn-danger', 'title' => __('Enable')])?>
            <?php else:?>
            <?= $this->Form->postLink('<span class="fa fa-lock"></span><span class="sr-only">' . __('Disable'),
                ['action' => 'disable', $user->id],
                ['confirm' => __('Are you sure you want to disable this account?'), 'escape' => false, 
                 	'class' => 'btn btn-sm btn-danger', 'title' => __('Disable')])?>
            
            <?php if($user->active):?>
            <?= $this->Form->postLink('<span class="fa fa-archive"></span><span class="sr-only">' . __('Archive'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('Are you sure you want to archive this account?', 
                $user->id), 'escape' => false, 
                 	'class' => 'btn btn-sm btn-info', 'title' => __('Archive')])?>
            
            <?php else:?>
            <?= $this->Form->postLink('<span class="fa fa-undo"></span><span class="sr-only">' . __('Restore') 
                        . '</span>', ['action' => 'delete', $user->id], 
                        ['confirm' => __('Are you sure you want to restore this account?'), 'escape' => false, 
                                        'class' => 'btn btn-sm btn-info', 'title' => __('Restore')]) ?>
            <?php endif;?>
            
            <?php endif;?>
            
            
            
    	
        <?php endif;?>
      </div>
    </div>
    <div class='box-body'>
        <div class='col-lg-3 col-md-4 col-sm-6'>
            <div class="box box-solid box-warning">
                <div class="box-body box-profile">
                    <?php echo $this->Html->image($avatar,
                            array('class'=>'profile-user-img img-responsive img-circle',
                                'id'=>'top-userimage'));?>
                    <?php if($user->disabled):?>
                    <h2 class="profile-username text-center text-red"><span class="fa fa-lock"></span> Account Disabled</h2>
                    <?php endif;?>

                    <p class="text-muted text-center"><?= ($user->has('group'))? h($user->group->name) : '' ?></p>
            
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <p><b>Username</b> <a class="pull-right"><?= h($user->username) ?></a></p>
                        </li>
                        <li class="list-group-item">
                            <p><b>Email</b> <a class="pull-right"><?= h($user->email) ?></a></p>
                        </li>
                        <li class="list-group-item">
                            <p><b>Type</b> <a class="pull-right"><?= h($user->account_type) ?></a></p>
                        </li>
                        <?php if (!empty($user->departments)): ?>
                        <li class="list-group-item">
                            <b>Departments</b>
                            <dd>
                                <?php foreach ($user->departments as $departments): ?>
                                <span class='badge'><?= h($departments->name) ?></span> 
                                <?php endforeach; ?>
                            </dd>
                        </li>
                        <?php endif; ?>
                        
                        <?php if (!empty($user->leads)): ?>
                        <li class="list-group-item">
                            <b>Manages Departments</b>
                            <dd>
                                <?php foreach ($user->leads as $departments): ?>
                                <span class='badge'><?= h($departments->name) ?></span> 
                                <?php endforeach; ?>
                            </dd>
                        </li>
                        <?php endif; ?>
                        
                        <?php if (($isOfficer || $isAdmin) && !empty($user->flags)): ?>
                        <li class="list-group-item">
                            <b>Flags</b>
                            <dd>
                                <?php foreach ($user->flags as $flag): ?>
                                <span class='badge'><?= h($flag->title) ?></span> 
                                <?php endforeach; ?>
                            </dd>
                        </li>
                        <?php endif; ?>
                        
                        
                    </ul>
                    <?php if($isAdmin || $isOfficer || $isOwner): ?>
                    <?= $this->Html->link('<span class="fa fa-pencil"></span> <b>' . __('Edit') . '</b>', ['action' => 'edit', $user->id], 
                        ['escape' => false, 'class' => 'btn btn-warning btn-block', 'title' => __('Edit')]) ?>
                    <?php if($user->provider == 'local'):?>
                    <?= $this->Html->link('<span class="fa fa-lock"></span> ' . __('Reset Password') , ['action' => 'reset',$user->id], 
                        ['escape' => false, 'class' => 'btn btn-default btn-block', 'title' => __('Reset Password')]) ?>
                    <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            </div>
            <div class='col-lg-9 col-md-8 col-sm-6'>
            <h4>Details</h4>
            <dl class="dl-horizontal">
                <dt><?= __('Email') ?></dt>
                <dd><?= $this->Html->link($user->email,'mailto:'.h($user->email)) ?></dd>
                <dt><?= __('Phone') ?></dt>
                <dd><?= h($user->phone) ?></dd>
                <dt><?= __('Mobile') ?></dt>
                <dd><?= h($user->mobile) ?></dd>
                <dt><?= __('Address') ?></dt>
                <dd><?= h($user->address) ?></dd>
                <dt><?= __('DOB') ?></dt>
                <dd><?= h($user->dob) ?></dd>
            </dl>
            <h4>Emergency Contact</h4>
            <dl class="dl-horizontal">
                
                <dt><?= __('Name') ?></dt>
                <dd><?= h($user->emergency_contact_name) ?></dd>
                <dt><?= __('Number') ?></dt>
                <dd><?= h($user->emergency_contact_number) ?></dd>
            </dl>
            <h4><?= __('Company, University or School Information') ?></h4>
            <dl class="dl-horizontal">
                <dt><?= __('Name') ?></dt>
                <dd><?= h($user->company_name) ?></dd>
                <dt><?= __('Contact Phone') ?></dt>
                <dd><?= h($user->company_contact) ?></dd>
                <dt><?= __('Address') ?></dt>
                <dd><?= h($user->company_address) ?></dd>
                <dt><?= __('Position') ?></dt>
                <dd><?= h($user->position) ?></dd>
                
                <dt><?= __('Supervisor') ?></dt>
                <dd><?= h($user->supervisor) ?></dd>
                <dt><?= __('Supervisor Email') ?></dt>
                <dd><?= h($user->supervisor_email) ?></dd>
                <dt><?= __('Supervisor Phone') ?></dt>
                <dd><?= h($user->supervisor_phone) ?></dd>
                
            </dl>
        </div>
    </div>
    <div class='box-footer'>
        <?php $footerHtml = '';?>
        <?php 
                $footerHtml .= "<b>". __('Created') .":</b> ";
                $footerHtml .= h($user->created)." ";
                ?>
                <?php 
                $footerHtml .= "<b>". __('Last Modified') .":</b> ";
                $footerHtml .= h($user->modified)." ";
                ?>
        <?= $footerHtml ?>
    </div>
</div> -->


<div class="box box-warning">
    <div class="box-header">
        <h3 class="box-title">
            <i class="glyphicon glyphicon-user"></i>
            Profile
        </h3>
        
        <div class="box-tools pull-right">
            <?= $this->Html->Link('<i class="glyphicon glyphicon-pencil"></i>', ['action' => 'edit', $user->id], ['escape' => false, 'class'=>'btn btn-default','title'=>'Edit Profile']) ?>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-12 col-md-2">
                <?php echo $this->Html->image($avatar,
                    array('class'=>'profile-user-img img-responsive img-rounded',
                    'id'=>'top-userimage', 'pathPrefix' => ''));
                ?>
                <div class="text-center">
                    <h3 class="text-capitalize font-weight-bold" style="margin-bottom: 0 !important"><?= h($user->name) ?></h3>
                    <small class="text-muted"><?= h($user->group->name) ?></small>
                </div>
            </div>
            <div class="col-12 col-md-10">
                <div class="d-none d-md-block">
                    <ul class="nav nav-tabs">
                        <li class="nav-li active">
                            <a class="nav-link" data-toggle="tab" role="tab" href="#personal_details">Personal Details</a>
                        </li>
                        <li class="nav-li">
                            <a class="nav-link" data-toggle="tab" role="tab" href="#company_details">Company Details</a>
                        </li>
                        <li class="nav-li">
                            <a class="nav-link" data-toggle="tab" role="tab" href="#emergency_contact">Emergency Contact</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="personal_details">
                            <h3 class="font-weight-bold">
                                Personal Details
                            </h3>
                            <table class="table table-responsive table-hover">
                                <tbody>
                                    <tr>
                                        <td class="bg-gray td-type">name</td>
                                        <td class="td-desc"><?= $user->name ?></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-gray td-type">email</td>
                                        <td class="td-desc"><?= $this->Html->link($user->email,'mailto:'.h($user->email)) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-gray td-type">phone</td>
                                        <td class="td-desc"><?= $user->phone ?></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-gray td-type">address</td>
                                        <td class="td-desc"><?= $user->address ?></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-gray td-type">Date of Birth</td>
                                        <td class="td-desc"><?= date('Y-d-m', strtotime($user->dob)) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="company_details">
                            <h3 class="font-weight-bold">
                                Company Details
                            </h3>
                            <table class="table table-responsive table-hover">
                                <tbody>
                                    <tr>
                                        <td class="bg-gray td-type">name</td>
                                        <td class="td-desc"><?= $user->company_name ?></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-gray td-type">contact phone</td>
                                        <td class="td-desc"><?= $user->company_contact ?></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-gray td-type">position</td>
                                        <td class="td-desc"><?= $user->group->name ?></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-gray td-type">supervisor</td>
                                        <td class="td-desc"><?= $user->supervisor ?></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-gray td-type">supervisor email</td>
                                        <td class="td-desc"><?= $this->Html->link($user->supervisor_email,'mailto:'.h($user->supervisor_email)) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-gray td-type">supervisor phone</td>
                                        <td class="td-desc"><?= $user->supervisor_phone ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="emergency_contact">
                            <h3 class="font-weight-bold">
                                Emergency Contact
                            </h3>
                            <table class="table table-responsive table-hover">
                                <tbody>
                                    <tr>
                                        <td class="bg-gray td-type">name</td>
                                        <td class="td-desc"><?= $user->emergency_contact_name ?></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-gray td-type">contact number</td>
                                        <td class="td-desc"><?= $user->emergency_contact_number ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="d-block d-md-none d-sm">
                    <h3 class="font-weight-bold">
                        Personal Details
                    </h3>
                    <table class="table table-responsive table-hover">
                        <tbody>
                            <tr>
                                <td class="bg-gray td-type">name</td>
                                <td class="td-desc"><?= $user->name ?></td>
                            </tr>
                            <tr>
                                <td class="bg-gray td-type">email</td>
                                <td class="td-desc"><?= $this->Html->link($user->email,'mailto:'.h($user->email)) ?></td>
                            </tr>
                            <tr>
                                <td class="bg-gray td-type">phone</td>
                                <td class="td-desc"><?= $user->phone ?></td>
                            </tr>
                            <tr>
                                <td class="bg-gray td-type">address</td>
                                <td class="td-desc"><?= $user->address ?></td>
                            </tr>
                            <tr>
                                <td class="bg-gray td-type">Date of Birth</td>
                                <td class="td-desc"><?= $user->dob ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <h3 class="font-weight-bold">
                        Company Details
                    </h3>
                    <table class="table table-responsive table-hover">
                        <tbody>
                            <tr>
                                <td class="bg-gray td-type">name</td>
                                <td class="td-desc"><?= $user->company_name ?></td>
                            </tr>
                            <tr>
                                <td class="bg-gray td-type">contact phone</td>
                                <td class="td-desc"><?= $user->company_contact ?></td>
                            </tr>
                            <tr>
                                <td class="bg-gray td-type">position</td>
                                <td class="td-desc"><?= $user->group->name ?></td>
                            </tr>
                            <tr>
                                <td class="bg-gray td-type">supervisor</td>
                                <td class="td-desc"><?= $user->supervisor ?></td>
                            </tr>
                            <tr>
                                <td class="bg-gray td-type">supervisor email</td>
                                <td class="td-desc"><?= $this->Html->link($user->supervisor_email,'mailto:'.h($user->supervisor_email)) ?></td>
                            </tr>
                            <tr>
                                <td class="bg-gray td-type">supervisor phone</td>
                                <td class="td-desc"><?= $user->supervisor_phone ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <h3 class="font-weight-bold">
                        Emergency Contact
                    </h3>
                    <table class="table table-responsive table-hover">
                        <tbody>
                            <tr>
                                <td class="bg-gray td-type">name</td>
                                <td class="td-desc"><?= $user->emergency_contact_name ?></td>
                            </tr>
                            <tr>
                                <td class="bg-gray td-type">contact number</td>
                                <td class="td-desc"><?= $user->emergency_contact_number ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<?php 
$collapsed = isset($collapsedBoxes['Certifications'])?(bool) $collapsedBoxes['Certifications']:true;

$testtypes = array();
foreach ($test as $key => $ts) {
        foreach ($TestTypes as $key => $testtype) {
            if($ts['course_test_type_id'] == $testtype['id'] ) {
                $testtypes[] =  $testtype['value'];
            }
            
        }
    }
    ?>


<div class='box box-info <?= $collapsed ? 'collapsed-box':''?>'>
    <div class='box-header'><h3 class='box-title title-collapse'>Course Resources</h3>

    	<div class="box-tools pull-right">
        <div class="box-tools pull-right">
    	<div class="btn-group">
    <?php 
// If new user
if ( $isOfficer || $isAdmin ): ?>
        <?= $this->Html->link('<i class="fa fa-plus" aria-hidden="true"> Note </i>', 
            ['controller' => 'Resources','action' => 'add'],['escape'=>false,'class'=>'btn btn-default','title'=>'Add']) ?>
        <?= $this->Html->link('<i class="fa fa-plus" aria-hidden="true"> Document </i>', 
            ['controller' => 'Resources','action'=>'add','type' => 'Document'],['escape'=>false,'class'=>'btn btn-default','title'=>'Add']) ?>
        <?= $this->Html->link('<i class="fa fa-plus" aria-hidden="true"> Link </i>', 
            ['controller' => 'Resources','action'=>'add','type' => 'Link'],['escape'=>false,'class'=>'btn btn-default','title'=>'Add']) ?>
<?php endif; ?>
        <button class="btn btn-box-tool" data-boxid='Certifications' data-widget="collapse"><i class="fa fa-caret-<?= $collapsed ? 'right':'down'?>"></i></button>
      </div>
      </div>
      </div>
    </div>
    <div class='box-body'>
    <!-- <#?php if (!empty($user->certifications)): ?> -->
    <div class="">
    <table class="table table-bordered table-hover data-table">
    <thead>
        <tr>
            <!-- <th colspan="3"></th> -->
            <th>Title</th>
            <th>Resources</th>
            <th>Type</th>
            <th>Created</th>
            <th>Action</th>
           
        </tr>
        </thead>
       
        <!-- <#?php if($resources->active == 1 ) ?> -->
        <?php foreach ($resources as $resource): ?>
            <!-- <#?php var_dump(($resource->doc)); ?> -->
            <tr data-id="<?= $resource->id?>">
                <td><?= h($resource->title) ?></td>
                <td><?php if($resource->type == 'Document'):?>
                <?php 
                    $icon = '<span class="file-icon-mini '.h($resource->doc_ext).'-mini"></span> '.h($resource->title);
                    echo $this->Dak->link($icon,$resource->doc,array('target'=>'_blank','escape'=>false));
                ?>
                <?php elseif($resource->type == 'Link'):?>
                <?= $this->Html->link(h($resource->title),$resource->link) ?>
                <?php else:?>
                    <?= $this->Html->link(h($resource->title),['controller'=>'Resources','action'=>'view',$resource->id],['class'=>'btnPreview']) ?>
                <?php endif;?></td>
                <td><?= h($resource->type) ?></td>
                <td><?= h($resource->created) ?></td>
               <td class="actions">
                  <?php $link =  h($resource->doc); 
                //   var_dump($download);
                  ?>
                    <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', ['controller'=>'Resources','action' => 'view', $resource->id], ['escape' => false, 'class' => 'btn btn-xs btn-success', 'title' => __('View')]) ?>
                    <?php echo '<a href="http://dev.taro.training' .  $link . '" download ><i class="glyphicon glyphicon-download-alt btn btn-xs btn-primary"></i></a>'; ?>
               </td>
            </tr>

        <?php endforeach; ?>
                <!-- <#?php endif; ?> -->
            </tbody>
        
    </table>
    </div>
    <!-- <#?php endif; ?> -->
    </div>
</div>


<?php 
// If new user
if ( $isOfficer || $isAdmin ): ?>

<?php 
$collapsed = isset($collapsedBoxes['Certifications'])?(bool) $collapsedBoxes['Certifications']:true;

$testtypes = array();
foreach ($test as $key => $ts) {
        foreach ($TestTypes as $key => $testtype) {
            if($ts['course_test_type_id'] == $testtype['id'] ) {
                $testtypes[] =  $testtype['value'];
            }
            
        }
    }
    ?>



<div class='box box-info <?= $collapsed ? 'collapsed-box':''?>'>
    <div class='box-header'><h3 class='box-title title-collapse'>Courses</h3>
    	<div class="box-tools pull-right">
        <div class="box-tools pull-right">
    	<div class="btn-group">
        <?= $this->Html->link('<i class="fa fa-plus" aria-hidden="true"> Add Test</i>', 
            ['controller' => 'Tests','action' => 'add'],['escape'=>false,'class'=>'btn btn-default','title'=>'Add']) ?>
        
        <?php if($this->request->query('archived')){
            echo $this->Form->hidden('archived',['value'=>1,'class'=>'search','id'=>'archived']);
            echo $this->Html->link('<i class="fa fa fa-bars" aria-hidden="true"></i>', 
                ['action' => 'index'],['escape'=>false,'class'=>'btn btn-default','title'=>'Show All']);
        }else{
            echo $this->Html->link('<i class="fa fa-trash-o" aria-hidden="true"> Delete Test</i>', 
                ['controller'=>'Tests','action' => 'index','archived'=>1],['escape'=>false,'class'=>'btn btn-default','title'=>'Show Deleted']);
        }?>
        <button class="btn btn-box-tool" data-boxid='Certifications' data-widget="collapse"><i class="fa fa-caret-<?= $collapsed ? 'right':'down'?>"></i></button>
      </div>
      </div>
      </div>
    </div>
    <div class='box-body'>
    <?php if (!empty($user->certifications)): ?>
    <div class="">
    <table class="table table-bordered table-hover data-table">
    <thead>
        <tr>
            <!-- <th colspan="3"></th> -->
            <th>ID</th>
            <th>Name</th>
            <th>Type</th>
            <th>Action</th>
           
        </tr>
        </thead>
        
        <?php 
        foreach ($test as $key => $value): ?>
           <tbody>
           <tr>
            <td><?= h($value['id'])?> </td>
            <td><?= h($value['name'])?> </td>
            <td><?= h($testtypes[$key]) ?> </td>
            <td class="actions">
                    <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', ['controller' => 'Tests','action' => 'view', $value->id], ['escape' => false, 'class' => 'btn btn-xs btn-success', 'title' => __('View')]) ?>
                    <?= $this->Html->link('<span class="glyphicon glyphicon-cog"></span><span class="sr-only">' . __('Manage') . '</span>', ['controller' => 'Tests','action' => 'manage', $value->id], ['escape' => false, 'class' => 'btn btn-xs btn-primary', 'title' => __('Manage')]) ?>
                    <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') . '</span>', ['controller' => 'Tests','action' => 'edit', $value->id], ['escape' => false, 'class' => 'btn btn-xs btn-warning', 'title' => __('Edit')]) ?>
                    <?php if($value->active):?>
                    <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete'),['controller' => 'Tests','action' => 'delete', $value->id],['confirm' => __('Are you sure you want to delete # {0}?', $value->id), 'escape' => false, 'class' => 'btn btn-xs btn-danger', 'title' => __('Delete')])?>
                    <?php endif;?>
                    <?php if(!$value->active):?>
                    <?= $this->Form->postLink('<span class="fa fa-undo"></span><span class="sr-only">' . __('Restore') 
                        . '</span>', ['action' => 'delete', $value->id], 
                        ['confirm' => __('Are you sure you want to restore this?'), 'escape' => false, 
                                        'class' => 'btn btn-xs btn-info', 'title' => __('Restore')]) ?>
                    <?php endif;?>
                </td>
                
            
            </tr>
            </tbody>
        
       <?php endforeach ?>
            
    </table>
    </div>
    <?php endif; ?>
    </div>
</div>
<?php endif; ?>


<?php 
// If new user
if ( $isOfficer || $isAdmin ): ?>

<?php 
$collapsed = isset($collapsedBoxes['Certifications'])?(bool) $collapsedBoxes['Certifications']:true;

$testtypes = array();
foreach ($test as $key => $ts) {
        foreach ($TestTypes as $key => $testtype) {
            if($ts['course_test_type_id'] == $testtype['id'] ) {
                $testtypes[] =  $testtype['value'];
            }
            
        }
    }
    ?>


<div class='box box-info <?= $collapsed ? 'collapsed-box':''?>'>
    <div class='box-header'><h3 class='box-title title-collapse'>Tests</h3>
    	<div class="box-tools pull-right">
        <div class="box-tools pull-right">
    	<div class="btn-group">
        <?= $this->Html->link('<i class="fa fa-plus" aria-hidden="true"> Add Test</i>', 
            ['controller' => 'Tests','action' => 'add'],['escape'=>false,'class'=>'btn btn-default','title'=>'Add']) ?>
        
        <?php if($this->request->query('archived')){
            echo $this->Form->hidden('archived',['value'=>1,'class'=>'search','id'=>'archived']);
            echo $this->Html->link('<i class="fa fa fa-bars" aria-hidden="true"></i>', 
                ['action' => 'index'],['escape'=>false,'class'=>'btn btn-default','title'=>'Show All']);
        }else{
            echo $this->Html->link('<i class="fa fa-trash-o" aria-hidden="true"> Delete Test</i>', 
                ['controller'=>'Tests','action' => 'index','archived'=>1],['escape'=>false,'class'=>'btn btn-default','title'=>'Show Deleted']);
        }?>
        <button class="btn btn-box-tool" data-boxid='Certifications' data-widget="collapse"><i class="fa fa-caret-<?= $collapsed ? 'right':'down'?>"></i></button>
      </div>
      </div>
      </div>
    </div>
    <div class='box-body'>
    <?php if (!empty($user->certifications)): ?>
    <div class="">
    <table class="table table-bordered table-hover data-table">
    <thead>
        <tr>
            <!-- <th colspan="3"></th> -->
            <th>ID</th>
            <th>Name</th>
            <th>Type</th>
            <th>Action</th>
           
        </tr>
        </thead>
        
        <?php 
        foreach ($test as $key => $value): ?>
           <tbody>
           <tr>
            <td><?= h($value['id'])?> </td>
            <td><?= h($value['name'])?> </td>
            <td><?= h($testtypes[$key]) ?> </td>
            <td class="actions">
                    <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', ['controller' => 'Tests','action' => 'view', $value->id], ['escape' => false, 'class' => 'btn btn-xs btn-success', 'title' => __('View')]) ?>
                    <?= $this->Html->link('<span class="glyphicon glyphicon-cog"></span><span class="sr-only">' . __('Manage') . '</span>', ['controller' => 'Tests','action' => 'manage', $value->id], ['escape' => false, 'class' => 'btn btn-xs btn-primary', 'title' => __('Manage')]) ?>
                    <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') . '</span>', ['controller' => 'Tests','action' => 'edit', $value->id], ['escape' => false, 'class' => 'btn btn-xs btn-warning', 'title' => __('Edit')]) ?>
                    <?php if($value->active):?>
                    <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete'),['controller' => 'Tests','action' => 'delete', $value->id],['confirm' => __('Are you sure you want to delete # {0}?', $value->id), 'escape' => false, 'class' => 'btn btn-xs btn-danger', 'title' => __('Delete')])?>
                    <?php endif;?>
                    <?php if(!$value->active):?>
                    <?= $this->Form->postLink('<span class="fa fa-undo"></span><span class="sr-only">' . __('Restore') 
                        . '</span>', ['action' => 'delete', $value->id], 
                        ['confirm' => __('Are you sure you want to restore this?'), 'escape' => false, 
                                        'class' => 'btn btn-xs btn-info', 'title' => __('Restore')]) ?>
                    <?php endif;?>
                </td>
                
            
            </tr>
            </tbody>
        
       <?php endforeach ?>
            
    </table>
    </div>
    <?php endif; ?>
    </div>
</div>
 <?php endif; ?> 


 <?php if ( $user->group_id == 6): ?>

 <div class='box box-warning collapsed-box'>
    <div class='box-header'><h3 class='box-title title-collapse'><?= __(' Enrolled Course') ?></h3>
    	<div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-boxid='Enrolled_Course' data-widget="collapse"><i class="fa fa-caret-right"></i></button>
      </div>
    </div>
    <div class='box-body'>
        <?php if($user->enrolled_courses) : ?>
            <ul>
            <?php foreach($user->enrolled_courses as $course): ?>
                <li><?= $this->Html->link($course->name, ['controller' => 'Courses', 'action' => 'viewCourse', $course->id])?></li>
            <?php endforeach;?>
            </ul>
        <?php else: ?>
            <h3 class="text-danger">You are not enrolled to any courses yet.</h3>
        <?php endif; ?>
    </div>
    <div class='box-footer noprint'>
    </div>
</div>


<?php 

$showNotes = isset($this->request->query['hide_notes'])? !($this->request->query['hide_notes']):true;
if($showNotes):
    
    $collapsed = isset($collapsedBoxes['Notes'])?(bool) $collapsedBoxes['Notes']:true;
?>
<div class='box box-warning <?= $collapsed ? 'collapsed-box':''?>'>
    <div class='box-header'><h3 class='box-title title-collapse'><?= __(' Notes') ?></h3>
    	<div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-boxid='Notes' data-widget="collapse"><i class="fa fa-caret-<?= $collapsed ? 'right':'down'?>"></i></button>
      </div>
    </div>
    <div class='box-body'>
<ul class="timeline">
    <?php if (!empty($user->user_notes)):
        $lastDate = '';
        foreach($user->user_notes as $user_note):    ?>
<?php 

    $isAudit = $user_note->type == 'Audit';
    $isEmail = $user_note->type == 'Email';//fa fa-envelope
    $commentDate = strtotime($user_note->created->i18nFormat('yyyy-MM-dd HH:mm:ss'));
    $dateNice = date("D, d-M-y", $commentDate);
    
    $icon = 'fa-comment-o bg-blue';
    if($isAudit){
        $icon = 'fa-book bg-green';
    }
    if($isEmail){
        $icon = 'fa-envelope bg-red';
    }
    
    ?>
    <?php if($dateNice != $lastDate):
       $lastDate = $dateNice;?>
        <li class="time-label">
        <span class="bg-red">
            <?= $dateNice ?>
        </span>
    </li>
    <?php endif;?>
<li>

<i class="fa <?= $icon ?>"></i>
<div class="timeline-item">
<span class="time"><i class="fa fa-clock-o"></i> <?= date("g:i A", $commentDate) ?></span>
<h3 class="timeline-header"><?= $user_note->has('user') && !$isEmail ?$user_note->user->name:'' ?> <?= $isAudit || $isEmail? $user_note->notes : ''; ?></h3>
<?php if(!$isAudit && !$isEmail):?>
<div class="timeline-body"><div class='tools'>
        <?php if($user_note->created->i18nFormat('yyyy-MM-dd') == date("Y-m-d")):?>
        <?= $this->Html->link('<i class="fa fa-edit"></i>', ['controller'=>'UserNotes','action' => 'edit', $user_note->id], ['escape' => false, 'title' => __('Edit')]) ?>
        <?php endif;?>
        <?= $this->Form->postLink('<i class="fa fa-trash-o"></i>', ['controller'=>'UserNotes','action' => 'delete', $user_note->id], ['confirm' => __('Are you sure you want to delete this note?'), 'escape' => false, 'title' => __('Delete')]) ?>
        </div>
    <?php echo $user_note->notes;?>
</div>
<?php endif;?>
</div>
</li>
<?php endforeach; ?>    
</ul>

<?php endif; ?>



    </div>
    <div class='box-footer noprint'>
        <?= $this->Form->create($userNote); ?>
        <?php
            $this->Form->unlockField('_wysihtml5_mode');
            echo $this->Form->hidden('post_type',array('value' => 'UserNotes'));
            echo $this->Form->input('notes',[
                'class'=>'editor',
                'label'=>'Comment',
                'required'=>false]);
        ?>
        <?= $this->Form->button(__('Add Note'), ['bootstrap-type' => 'success']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
<?php endif; ?>
<?php endif; ?>

<?php 
$collapsed = isset($collapsedBoxes['Certifications'])?(bool) $collapsedBoxes['Certifications']:true;
?>
<div class='box box-info <?= $collapsed ? 'collapsed-box':''?>'>
    <div class='box-header'><h3 class='box-title title-collapse'><?= __('Certifications') ?></h3>
    	<div class="box-tools pull-right">
            <?= $this->Html->link('<i class="fa fa-plus"></i> Add Certification', 
            ['controller'=>'Certifications','action' => 'add',$user->id],
            ['escape'=>false,
             'class'=>'btn btn-sm btn-default']) ?>
        <button class="btn btn-box-tool" data-boxid='Certifications' data-widget="collapse"><i class="fa fa-caret-<?= $collapsed ? 'right':'down'?>"></i></button>
      </div>
    </div>
    <div class='box-body'>
    <?php if (!empty($user->certifications)): ?>
    <div class="">
    <table class="table table-bordered table-hover data-table">
    <thead>
        <tr>
            <th colspan="3"><?= __('Certification') ?></th>
            <th><?= __('Issuer') ?></th>
            <th><?= __('Issued') ?></th>
            <th><?= __('Expires') ?></th>
            <th><?= __('Validated') ?></th>
            <th class="actions">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($user->certifications as $certifications): ?>
        <tr <?= (!$certifications->valid) ? 'class="danger"':''?>>
            <td><i class="fa fa-circle status_<?= $certifications->status ?>"></i>&nbsp;</td>
            <td><?php 
                if(!empty($certifications->file_url)){
                    $icon = '<span class="file-icon-mini '.h($certifications->extension).'-mini"></span>';
                    echo $this->Dak->link($icon,$certifications->file_url,array('target'=>'_blank','escape'=>false));
                 }
                 ?>&nbsp;</td>
            <td><?= $certifications->has('certification_type') ? h($certifications->certification_type->name) : '' ?></td>
            <td><?= h($certifications->issuer) ?></td>
            <td><?= h($certifications->issued) ?></td>
            <td><?= h($certifications->expires) ?></td>
            <td>
            <?php if($certifications->valid){
                echo 'Validated '. h($certifications->validated_date);
                echo ($certifications->has('validated'))?' by '. h($certifications->validated->name):''; 
            }else{
            	if(!$certifications->active){
                    echo 'Archived';
            	}elseif(($isAdmin || $isOfficer) && !$isOwner){
                    echo $this->Form->create($certifications,['url'=>['controller'=>'Certifications','action'=>'edit',$certifications->id]]);
                    echo $this->Form->hidden('valid',['value'=>'1']);
                    echo $this->Form->submit('Validate');
                    echo $this->Form->end();
                }else{
                    echo 'Not yet validated';
                }
            } ?></td>
            <td class="actions">
                 <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') 
                 		. '</span>', ['controller' => 'Certifications', 'action' => 'view', $certifications->id], 
                 		['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('View')]) ?>
                <?php if($certifications->status > 1 && $certifications->active):?>
                    <?= $this->Html->link('<span class="fa fa-refresh"></span><span class="sr-only">' . __('Replace') 
                 		. '</span>', ['controller' => 'Certifications', 'action' => 'add',$user->id, 'replacing'=> $certifications->id], 
                 		['escape' => false, 'class' => 'btn btn-xs btn-info', 'title' => __('Replace')])?>
                    
                    <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') 
                 		. '</span>', ['controller' => 'Certifications', 'action' => 'delete', $certifications->id], 
                 		['confirm' => __('Are you sure you want to delete this?'), 'escape' => false, 
                 				'class' => 'btn btn-xs btn-danger', 'title' => __('Delete')])?>
                <?php endif;?>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <?php endif; ?>
    </div>
</div>
<!-- 
<#?php 
$collapsed = isset($collapsedBoxes['Equipment'])?(bool) $collapsedBoxes['Equipment']:true;
?>
<div class='box box-info <#?= $collapsed ? 'collapsed-box':''?>'>
    <div class='box-header'><h3 class='box-title title-collapse'><#?= __('My Equipment') ?></h3>
    	<div class="box-tools pull-right">
        <#?= $this->Html->link('<i class="fa fa-plus"></i> Add Equipment', 
            ['controller'=>'Equipment','action' => 'add',$user->id,'back'=>$this->request->here],
            ['escape'=>false,
             'class'=>'btn btn-sm btn-default']) ?>
        <button class="btn btn-box-tool" data-boxid='Equipment' data-widget="collapse"><i class="fa fa-caret-<?= $collapsed ? 'right':'down'?>"></i></button>
      </div>
    </div>
    <div class='box-body'>
    <#?php if (!empty($user->equipment)): ?>
    <div class="">
    <table class="table table-bordered table-hover data-table">
    <thead>
        <tr>
            <th colspan="2"><#?= __('Title') ?></th>
            <th><#?= __('Make') ?></th>
            <th><#?= __('Model') ?></th>
            <th><#?= __('Last Service') ?></th>
            <th><#?= __('Next Service') ?></th>
            <th class="actions"><#?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <#?php foreach ($user->equipment as $equipment): ?>
        <tr>
            <td><i class="fa fa-circle status_<#?= $equipment->status ?>"></i>&nbsp;</td>
            <td><#?= h($equipment->title) ?></td>
            <td><#?= h($equipment->make) ?></td>
            <td><#?= h($equipment->model) ?></td>
            <td><#?= h($equipment->last_service) ?></td>
            <td><#?= h($equipment->next_service) ?></td>
            <td class="actions">
                 <#?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') 
                 		. '</span>', ['controller' => 'Equipment', 'action' => 'view', $equipment->id,'back'=>$this->request->here], 
                 		['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('View')]) ?>
            </td>
        </tr>
        <#?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <#?php endif; ?>
    </div>
</div> -->
<!-- 
<#?php 
$collapsed = isset($collapsedBoxes['EquipmentHire'])?(bool) $collapsedBoxes['EquipmentHire']:true;
?>
<a name="EquipmentHire"></a>
<div class='box box-info <#?= $collapsed ? 'collapsed-box':''?>'>
    <div class='box-header'><h3 class='box-title title-collapse'><#?= __('Reserve') ?> <?= $app_logo_text ?> <?= __('Equipment') ?></h3>
    	<div class="box-tools pull-right">
            <#?php 
            $link = ['controller'=>'EquipmentReservations','action' => 'add',$user->id];
            ?>
            <#?= $this->Html->link('<i class="fa fa-plus"></i> Reserve Equipment', 
            $link,
            ['escape'=>false,
             'title'=>'Reserve Equipment',
             'class'=>'btn btn-default btnPreview']) ?>
            <#?= $this->Html->link('<i class="fa fa-history"></i> History', 
            ['controller'=>'EquipmentReservations',
            'action' => 'index',
            'EquipmentReservations[user_id]'=>$user->id,
            'userview'=>1,
            'archived'=>'1'],
            ['escape'=>false,
             'title'=>'View History',
             'class'=>'btn btn-default']) ?>
            <#?= $this->Html->link('<i class="fa fa-calendar"></i>', 
            ['controller'=>'EquipmentReservations','action' => 'calendar'],
            ['escape'=>false,
             'title'=>'Equipment Reservations Calendar',
             'class'=>'btn btn-default']) ?>
        <button class="btn btn-box-tool" data-boxid='EquipmentHire' data-widget="collapse"><i class="fa fa-caret-<?= $collapsed ? 'right':'down'?>"></i></button>
      </div>
    </div>
    <div class='box-body'>
    
    <#?php if (!empty($user->equipment_reservations)): ?>
    <table class="table table-bordered table-hover data-table">
    <thead>
        <tr>
            <th><#?= __('Pickup') ?></th>
            <th><#?= __('Return') ?></th>
            <th><#?= __('Type') ?></th>
            <th><#?= __('Details') ?></th>
            <th><#?= __('Qty') ?></th>
            <th style='width:300px;'><?= __('Approved') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <#?php foreach ($user->equipment_reservations as $equipmentReservation): ?>
        <tr class='msg-parent'>
            <#?php if($equipmentReservation->all_day):?>
            <td><#?= h($equipmentReservation->start->format('d/m/Y')) ?></td>
            <td><#?= h($equipmentReservation->end->format('d/m/Y')) ?></td>
            <#?php else:?>
            <td><#?= h($equipmentReservation->start->format('d/m/Y h:i A')) ?></td>
            <td><#?= h($equipmentReservation->end->format('d/m/Y h:i A')) ?></td>
            <#?php endif;?>
            <td><#?= h($equipmentReservation->equipment->equipment_type->title) ?></td>
            <td><#?= $this->Html->link('<i class="fa fa-info"></i><span class="sr-only">' . __('Info') 
                 		. '</span>', ['controller' => 'Equipment', 'action' => 'preview', $equipmentReservation->equipment_id], 
                 		['escape' => false, 'class' => 'btn btn-xs btn-info btnPreview', 'title' => __('Equipment Info')]) ?>
                <#?= h($equipmentReservation->equipment->title) ?>
            
                </td>
            <td><#?= h($equipmentReservation->qty) ?></td>
            <td>
                <#?php if($equipmentReservation->approved === true):?>Approved<#?php elseif($equipmentReservation->approved === false):?>
                Not Approved<#?php else:?>Pending...<#?php endif;?>
                
            </td>
            <td class="actions">
                <#?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', 
                        ['controller' => 'EquipmentReservations', 'action' => 'view', $equipmentReservation->id,
                        'back' => $this->Url->build(['controller'=>'Users','action'=>'view',$user->id], ['fullBase' => true])], 
                 		['escape' => false, 'class' => 'btn btn-xs btn-success btnPreview', 'title' => __('View')]) ?>
                
                <#?php if($equipmentReservation->start->format('Y-m-d H:i') > date('Y-m-d H:i')):?>
                <#?php if($equipmentReservation->approved === null ):?>
                <#?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') 
                 		. '</span>', ['controller' => 'EquipmentReservations', 'action' => 'edit', $equipmentReservation->id,
                                        'back' => $this->Url->build(['controller'=>'Users','action'=>'view',$user->id], ['fullBase' => true])], 
                 		['escape' => false, 'class' => 'btn btn-xs btn-warning btnPreview', 'title' => __('Edit')]) ?>
                <#?php endif;?>
                <#?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Cancel') 
                                    . '</span>', ['controller' => 'EquipmentReservations', 'action' => 'delete', $equipmentReservation->id,
                                        'back' => $this->Url->build(['controller'=>'Users','action'=>'view',$user->id], ['fullBase' => true])], 
                                    ['confirm' => __('Are you sure you want to cancel this equipment reservation?'), 'escape' => false, 
                                                    'class' => 'btn btn-xs btn-danger', 'title' => __('Cancel')]) ?>
                <#?php endif;?>

            </td>
        </tr>
        <#?php endforeach; ?>
        </tbody>
        </table>
        <#?php endif; ?>
    </div>
</div>
 -->

<?php 
$collapsed = isset($collapsedBoxes['Documents'])?(bool) $collapsedBoxes['Documents']:true;
?>
<div class='box box-info <?= $collapsed ? 'collapsed-box':''?>'>
    <div class='box-header'><h3 class='box-title title-collapse'><?= __('Documents') ?></h3>
    	<div class="box-tools pull-right">
            <?= $this->Html->link('<i class="fa fa-plus"></i> Add Document', 
            ['controller'=>'UserDocs','action' => 'add',$user->id],
            ['escape'=>false,
             'class'=>'btn btn-sm btn-default']) ?>
        <button class="btn btn-box-tool" data-boxid='Documents' data-widget="collapse"><i class="fa fa-caret-<?= $collapsed ? 'right':'down'?>"></i></button>
      </div>
    </div>
    <div class='box-body'>
    <?php if (!empty($user->user_docs)): ?>
    <div class="">
    <table class="table table-bordered table-hover data-table">
    <thead>
        <tr>
            <th><?= __('Name') ?></th>
            <th><?= __('Filesize') ?></th>
            <th><?= __('Created') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($user->user_docs as $userDocs): ?>
        <tr>
            <td><?php 
                if(!empty($userDocs->file_url)){
                    $icon = '<span class="file-icon-mini '.h($userDocs->extension).'-mini"></span> '.h($userDocs->name);
                    echo $this->Dak->link($icon,$userDocs->file_url,array('target'=>'_blank','escape'=>false));
                 }
                 ?>&nbsp;<?= ($userDocs->private)?'<i class="fa fa-eye-slash" title="Private - Office Use Only"></i>':'' ?></td>
            <td><?= $this->Number->toReadableSize($userDocs->filesize) ?></td>
            <td><?= h($userDocs->created) ?></td>

            <td class="actions">
                <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>',
                        ['controller' => 'UserDocs','action' => 'view', $userDocs->id], ['escape' => false, 'class' => 'btn btn-xs btn-success', 'title' => __('View')]) ?>
                
                 <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') 
                 		. '</span>', ['controller' => 'UserDocs', 'action' => 'delete', $userDocs->id], 
                 		['confirm' => __('Are you sure you want to delete this?'), 'escape' => false, 
                 				'class' => 'btn btn-xs btn-danger', 'title' => __('Delete')]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <?php endif; ?>
    </div>
</div>
<?php 

$showNotes = isset($this->request->query['hide_notes'])? !($this->request->query['hide_notes']):true;
if($showNotes):
    
    $collapsed = isset($collapsedBoxes['Notes'])?(bool) $collapsedBoxes['Notes']:true;
?>
<div class='box box-info <?= $collapsed ? 'collapsed-box':''?>'>
    <div class='box-header'><h3 class='box-title title-collapse'><?= __('Private Notes') ?></h3>
    	<div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-boxid='Notes' data-widget="collapse"><i class="fa fa-caret-<?= $collapsed ? 'right':'down'?>"></i></button>
      </div>
    </div>
    <div class='box-body'>
<ul class="timeline">
    <?php if (!empty($user->user_notes)):
        $lastDate = '';
        foreach($user->user_notes as $user_note):    ?>
<?php 

    $isAudit = $user_note->type == 'Audit';
    $isEmail = $user_note->type == 'Email';//fa fa-envelope
    $commentDate = strtotime($user_note->created->i18nFormat('yyyy-MM-dd HH:mm:ss'));
    $dateNice = date("D, d-M-y", $commentDate);
    
    $icon = 'fa-comment-o bg-blue';
    if($isAudit){
        $icon = 'fa-book bg-green';
    }
    if($isEmail){
        $icon = 'fa-envelope bg-red';
    }
    
    ?>
    <?php if($dateNice != $lastDate):
       $lastDate = $dateNice;?>
        <li class="time-label">
        <span class="bg-red">
            <?= $dateNice ?>
        </span>
    </li>
    <?php endif;?>
<li>

<i class="fa <?= $icon ?>"></i>
<div class="timeline-item">
<span class="time"><i class="fa fa-clock-o"></i> <?= date("g:i A", $commentDate) ?></span>
<h3 class="timeline-header"><?= $user_note->has('user') && !$isEmail ?$user_note->user->name:'' ?> <?= $isAudit || $isEmail? $user_note->notes : ''; ?></h3>
<?php if(!$isAudit && !$isEmail):?>
<div class="timeline-body"><div class='tools'>
        <?php if($user_note->created->i18nFormat('yyyy-MM-dd') == date("Y-m-d")):?>
        <?= $this->Html->link('<i class="fa fa-edit"></i>', ['controller'=>'UserNotes','action' => 'edit', $user_note->id], ['escape' => false, 'title' => __('Edit')]) ?>
        <?php endif;?>
        <?= $this->Form->postLink('<i class="fa fa-trash-o"></i>', ['controller'=>'UserNotes','action' => 'delete', $user_note->id], ['confirm' => __('Are you sure you want to delete this note?'), 'escape' => false, 'title' => __('Delete')]) ?>
        </div>
    <?php echo $user_note->notes;?>
</div>
<?php endif;?>
</div>
</li>
<?php endforeach; ?>    
</ul>

<?php endif; ?>

    </div>
    <div class='box-footer noprint'>
        <?= $this->Form->create($userNote); ?>
        <?php
            $this->Form->unlockField('_wysihtml5_mode');
            echo $this->Form->hidden('post_type',array('value' => 'UserNotes'));
            echo $this->Form->input('notes',[
                'class'=>'editor',
                'label'=>'Comment',
                'required'=>false]);
        ?>
        <?= $this->Form->button(__('Add Note'), ['bootstrap-type' => 'success']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
<?php endif; ?>

<!-- <#?php elseif ( $user->group_id == 6): ?>


<#?php endif; ?> -->

<!-- <#?php 
//If new user
// if ( $isOfficer || $isAdmin ): ?> -->

<!-- // <#?php if(in_array('Registers',$enabled_areas)):
    
//     $collapsed = isset($collapsedBoxes['Registers'])?(bool) $collapsedBoxes['Registers']:true;
//     ?>
// <div class='box box-info <#?= $collapsed ? 'collapsed-box':''?>'>
//     <div class='box-header'><h3 class='box-title title-collapse'><?= __('Registers') ?></h3>
//     	<div class="box-tools pull-right">
//             <#?= $this->Html->link('<i class="fa fa-plus"></i> Add Register', 
//             ['controller'=>'Registers','action' => 'add',$user->id],
//             ['escape'=>false,
//                 'title'=>'Add Register',
//              'class'=>'btn btn-sm btn-default btnPreview']) ?>
//         <button class="btn btn-box-tool" data-boxid='Registers' data-widget="collapse"><i class="fa fa-caret-<?= $collapsed ? 'right':'down'?>"></i></button>
//       </div>
//     </div>
//     <div class='box-body'>
//     <#?php if (!empty($user->registers)): ?>
//     <div class="">
//     <table class="table table-bordered table-hover data-table">
//     <thead>
//         <tr>
//             <th><?= __('Department') ?></th>
//             <th><?= __('Type') ?></th>
//             <th><?= __('Certs') ?></th>
//             <th><?= __('Status') ?></th>
//             <th><?= __('Class') ?></th>
//             <th><?= __('Started') ?></th>
//             <th class="actions"><?= __('Actions') ?></th>
//         </tr>
//         </thead>
//         <tbody>
//         <#?php foreach ($user->registers as $registers): ?>
//         <tr>
//             <td><#?= $registers->has('department')?h($registers->department->name):'' ?></td>
//             <td><#?= $registers->has('register_template') ? h($registers->register_template->name) :''?></td>
//             <td><i class="fa fa-circle status_<?= $registers->cert_status ?>"></i>&nbsp;</td>
//             <td><#?= h($registers->status) ?></td>
//             <td><#?= $registers->has('register_class')? h($registers->register_class->title):'' ?></td>
//             <td><#?= h($registers->created) ?></td>
//             <td class="actions">
//                 <#?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') 
//                     . '</span>', ['controller' => 'Registers', 'action' => 'view', $registers->id], 
//                     ['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('View')]) ?>
//             </td>
//         </tr>
//         <#?php endforeach; ?>
//         </tbody>
//     </table>
//     </div>
//     <#?php endif; ?>
//     </div>
// </div>
// <#?php endif; ?> -->
