<?php

$avatar = 'profile.jpg';
if(!empty($user['profile_url'])){
    $avatar = $user['profile_url'];
    $this->Dak->allow_file($avatar);
}

$this->assign('title', h($user->name).' Profile');
    
?>

<div class='box box-primary'>
    <div class='box-header'><h2 class='box-title'><?= h($user->name) ?></h2></div>
    <div class='box-body'>
        <div class='col-xs-6'>
        
                <?php echo $this->Html->image($avatar,
                        array('class'=>'profile-user-img img-responsive img-circle',
                            'alt'=>h($user->name).'\'s profile picture', 
                            'fullBase' => true,
                            'id'=>'top-userimage'));?>
            <h3 class="profile-username text-center"><?= h($user->name) ?></h3>
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
          
        </div>
        <div class='col-xs-6'>
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
        <?php 
            $footerHtml .= "<b>". __('Printed') .":</b> ";
            $footerHtml .= date('d/m/Y')." ";
            ?>
    <?= $footerHtml ?>
</div>
</div>

<?php if(in_array('Trips',$enabled_areas) && !empty($trips)):?>
<div class='box box-info'>
    <div class='box-header'><h3 class='box-title title-collapse'><?= __('Trips') ?></h3></div>
    <div class='box-body'>
    <?php if (!empty($trips)): ?>
    <div class="">
    <table class="table table-bordered table-hover data-table">
    <thead>
        <tr>
            <th><?= __('ID') ?></th>
            <th><?= __('Title') ?></th>
            <th><?= __('Date') ?></th>
            <th><?= __('End Date') ?></th>
            <th><?= __('Attachments') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($trips as $trip): ?>
        <tr>
            <td><?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span> ' . h($trip->id)
                 		, ['controller' => 'Trips', 'action' => 'view', $trip->id], 
                 		['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('View')]) ?></td>
           <td><?= h($trip->title) ?></td>
            <td><?= h($trip->start_date) ?></td>
            <td><?= h($trip->end_date) ?></td>
            <td>
                <?php if($trip->has('trip_logs')): //add files?>
                <?php 
    		foreach($trip->trip_logs as $notes){
    			if(!empty($notes->file_url)){
		            $icon = '<span class="file-icon-mini '.$notes->file_ext.'-mini"></span>';
		            echo $this->Dak->link($icon,$notes->file_url,array('target'=>'_blank','escape'=>false));
		         } 
    		}
    		?>&nbsp;
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
<?php endif; ?>

<?php if(in_array('Registers',$enabled_areas) && !empty($user->registers)):?>
<div class='box box-info'>
    <div class='box-header'><h3 class='box-title title-collapse'><?= __('Registers') ?></h3></div>
    <div class='box-body'>
    <?php if (!empty($user->registers)): ?>
    <div class="">
    <table class="table table-bordered table-hover data-table">
    <thead>
        <tr>
            <th><?= __('Department') ?></th>
            <th><?= __('Type') ?></th>
            <th><?= __('Certs') ?></th>
            <th><?= __('Status') ?></th>
            <th><?= __('Class') ?></th>
            <th><?= __('Started') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($user->registers as $registers): ?>
        <tr>
            <td><?= $registers->has('department')?h($registers->department->name):'' ?></td>
            <td><?= $registers->has('register_template') ? h($registers->register_template->name) :''?></td>
            <td><?= $this->Dak->getStatus($registers->cert_status)?>&nbsp;</td>
            <td><?= h($registers->status) ?></td>
            <td><?= $registers->has('register_class')? h($registers->register_class->title):'' ?></td>
            <td><?= h($registers->created) ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <?php endif; ?>
    </div>
</div>
<?php endif; ?>

<?php if(!empty($user->certifications)):?>
<div class='box box-info'>
    <div class='box-header'><h3 class='box-title title-collapse'><?= __('Certifications') ?></h3></div>
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
        </tr>
        </thead>
        <tbody>
        <?php foreach ($user->certifications as $certifications): ?>
        <tr <?= (!$certifications->valid) ? 'class="danger"':''?>>
            <td><?= $this->Dak->getStatus($certifications->status)?>&nbsp;</td>
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
            	}else{
                    echo 'Not yet validated';
                }
            } ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <?php endif; ?>
    </div>
</div>
<?php endif;?>

<?php if(!empty($user->equipment)):?>
<div class='box box-info'>
    <div class='box-header'><h3 class='box-title title-collapse'><?= __('Equipment') ?></h3></div>
    <div class='box-body'>
    <?php if (!empty($user->equipment)): ?>
    <div class="">
    <table class="table table-bordered table-hover data-table">
    <thead>
        <tr>
            <th colspan="2"><?= __('Title') ?></th>
            <th><?= __('Make') ?></th>
            <th><?= __('Model') ?></th>
            <th><?= __('Last Service') ?></th>
            <th><?= __('Next Service') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($user->equipment as $equipment): ?>
        <tr>
            <td><?= $this->Dak->getStatus($equipment->status)?>&nbsp;</td>
            <td><?= h($equipment->title) ?></td>
            <td><?= h($equipment->make) ?></td>
            <td><?= h($equipment->model) ?></td>
            <td><?= h($equipment->last_service) ?></td>
            <td><?= h($equipment->next_service) ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <?php endif; ?>
    </div>
</div>
<?php endif;?>