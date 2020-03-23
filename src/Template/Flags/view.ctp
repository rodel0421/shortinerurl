
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><span class="glyphicon glyphicon-zoom-in"></span> <?= h($flag->title) ?></h3>
    	<div class="box-tools pull-right">
    	<?= $this->Html->link('<span class="glyphicon glyphicon-file"></span><span class="sr-only">' . __('New') 
                 		. '</span>', ['action' => 'add'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('New')]) ?>
    	
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
                 		
    	<?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') 
                 		. '</span>', ['action' => 'edit', $flag->id], 
                 		['escape' => false, 'class' => 'btn btn-warning', 'title' => __('Edit')]) ?>
        <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') 
                 		. '</span>', ['action' => 'delete', $flag->id], 
                 		['confirm' => __('Are you sure you want to delete # {0}?', $flag->id), 'escape' => false, 
                 				'class' => 'btn btn-danger', 'title' => __('Delete')]) ?>
    	<?= $this->element('guide', array("section" => 'flags')) ?>
        <div class="btn-group">
          <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
          <ul class="dropdown-menu" role="menu">
            
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
         </ul>
        </div>
      </div>
    </div>
    <div class='box-body'>
    <?php $footerHtml = '';?>
        <dl class="dl-horizontal">
            <dt><?= __('Title') ?></dt>
            <dd><?= h($flag->title) ?></dd>
            <dt><?= __('Category') ?></dt>
            <dd><?= h($flag->category) ?></dd>
        </dl>
        <dl class="dl-horizontal">
            <dt><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($flag->id) ?></dd>
        </dl>
        <dl class="dl-horizontal">
            <?php 
            $footerHtml .= "<b>". __('Created') .":</b> ";
            $footerHtml .= h($flag->created)." ";
            ?>
            <?php 
            $footerHtml .= "<b>". __('Modified') .":</b> ";
            $footerHtml .= h($flag->modified)." ";
            ?>
        </dl>
    
    <dl class="dl-horizontal">
       <dt><?= __('Description') ?></dt>
       <dd><?= $this->Text->autoParagraph(h($flag->description)); ?></dd>
    </dl>
</div>
<div class='box-footer'>
    <?= $footerHtml ?>
</div>
</div>
<div class='box box-info'>
    <div class='box-header'><h3 class='box-title'><?= __('Related Users') ?></h3>
    	<div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-caret-down"></i></button>
      </div>
    </div>
    <div class='box-body'>
    <?php if (!empty($flag->users)): ?>
    <div class="">
    <table class="table table-bordered table-hover data-table">
    <thead>
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Group Id') ?></th>
            <th><?= __('Facility Id') ?></th>
            <th><?= __('Given Name') ?></th>
            <th><?= __('Surname') ?></th>
            <th><?= __('Email') ?></th>
            <th><?= __('Dob') ?></th>
            <th><?= __('Phone') ?></th>
            <th><?= __('Mobile') ?></th>
            <th><?= __('Emergency Contact Name') ?></th>
            <th><?= __('Emergency Contact Number') ?></th>
            <th><?= __('Position') ?></th>
            <th><?= __('Department') ?></th>
            <th><?= __('Address') ?></th>
            <th><?= __('Company Name') ?></th>
            <th><?= __('Company Contact') ?></th>
            <th><?= __('Company Address') ?></th>
            <th><?= __('Supervisor') ?></th>
            <th><?= __('Supervisor Email') ?></th>
            <th><?= __('Supervisor Phone') ?></th>
            <th><?= __('Username') ?></th>
            <th><?= __('Account Type') ?></th>
            <th><?= __('Password') ?></th>
            <th><?= __('Key') ?></th>
            <th><?= __('Profile Url') ?></th>
            <th><?= __('Facilities Access') ?></th>
            <th><?= __('Admin Only') ?></th>
            <th><?= __('Active') ?></th>
            <th><?= __('Account Verified') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($flag->users as $users): ?>
        <tr>
            <td><?= h($users->id) ?></td>
            <td><?= h($users->group_id) ?></td>
            <td><?= h($users->facility_id) ?></td>
            <td><?= h($users->given_name) ?></td>
            <td><?= h($users->surname) ?></td>
            <td><?= h($users->email) ?></td>
            <td><?= h($users->dob) ?></td>
            <td><?= h($users->phone) ?></td>
            <td><?= h($users->mobile) ?></td>
            <td><?= h($users->emergency_contact_name) ?></td>
            <td><?= h($users->emergency_contact_number) ?></td>
            <td><?= h($users->position) ?></td>
            <td><?= h($users->department) ?></td>
            <td><?= h($users->address) ?></td>
            <td><?= h($users->company_name) ?></td>
            <td><?= h($users->company_contact) ?></td>
            <td><?= h($users->company_address) ?></td>
            <td><?= h($users->supervisor) ?></td>
            <td><?= h($users->supervisor_email) ?></td>
            <td><?= h($users->supervisor_phone) ?></td>
            <td><?= h($users->username) ?></td>
            <td><?= h($users->account_type) ?></td>
            <td><?= h($users->password) ?></td>
            <td><?= h($users->key) ?></td>
            <td><?= h($users->profile_url) ?></td>
            <td><?= h($users->facilities_access) ?></td>
            <td><?= h($users->admin_only) ?></td>
            <td><?= h($users->active) ?></td>
            <td><?= h($users->account_verified) ?></td>
            <td><?= h($users->created) ?></td>
            <td><?= h($users->modified) ?></td>

            <td class="actions">
                 <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') 
                 		. '</span>', ['controller' => 'Users', 'action' => 'view', $users->id], 
                 		['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('View')]) ?>
                 <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') 
                 		. '</span>', ['controller' => 'Users', 'action' => 'edit', $users->id], 
                 		['escape' => false, 'class' => 'btn btn-xs btn-warning', 'title' => __('Edit')]) ?>
                 <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') 
                 		. '</span>', ['controller' => 'Users', 'action' => 'delete', $users->id], 
                 		['confirm' => __('Are you sure you want to delete # {0}?', $flag->id), 'escape' => false, 
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
