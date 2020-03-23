<?php $this->assign('title','Create Account');?>
<?= $this->Form->create($user); ?>
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Create User Account') ?></h3>
    	<div class="box-tools pull-right">
      </div>
    </div>
    <div class='box-body'>
    
        <div class='row'>
            <div class='col-sm-3'><?= $this->Form->input('username')?></div>
            <div class='col-sm-3'><?= $this->Form->input('password')?> <?= (isset($groupTypeID) && $groupTypeID <= 2) ? $this->Form->control('ask_for_new_password', ['type' => 'checkbox', 'id' => 'new_password']) : '' ;?></div>
        </div>
       
</div>
</div>

<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Personal Information') ?></h3>
    	<div class="box-tools pull-right">
      </div>
    </div>
    <div class='box-body'>
        <div class='row'>
            <div class='col-sm-3'><?= $this->Form->input('given_name')?></div>
            <div class='col-sm-3'><?= $this->Form->input('surname')?></div>
            <?php if($user->errors('name')):?>
            <div class='col-sm-3'><?= $this->Form->input('name',['label'=>'Display Name'])?></div>
            <?php endif;?>
            <div class='col-sm-3'><?= $this->Form->input('email', ['value' => $email])?></div>
        </div>
        <div class='row'>
            <?php if(!empty($userTypes)):?>
            <div class='col-sm-3'><?= $this->Form->input('user_type_id',['empty'=>'(Select One)','options'=>$userTypes,'label'=>'Type'])?></div>
            <?php endif;?>
            <div class='col-sm-3'><?= $this->Form->input('dob',['type'=>'text','class'=>'datepicker','label'=>'DOB'])?></div>
            <div class='col-sm-3'><?= $this->Form->input('phone')?></div>
            <div class='col-sm-3'><?= $this->Form->input('mobile')?></div>
            
        </div>
        <div class="row">
            <div class='col-sm-6'><?= $this->Form->input('address')?></div>
        </div>
        <div class='row'>
            <div class='col-sm-3'><?= $this->Form->input('emergency_contact_name')?></div>
            <div class='col-sm-3'><?= $this->Form->input('emergency_contact_number')?></div>
        </div>
</div>
</div>

<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Company, University or School Information') ?></h3>
    	<div class="box-tools pull-right">
      </div>
    </div>
    <div class='box-body'>
        <div class='row'>
            <div class='col-sm-3'><?= $this->Form->input('company_name')?></div>
            <div class='col-sm-3'><?= $this->Form->input('company_contact')?></div>
            <div class='col-sm-3'><?= $this->Form->input('position',['label'=>'Position at Company'])?></div>
        </div>
        <div class='row'>
            <div class='col-sm-6'><?= $this->Form->input('company_address')?></div>
        </div>
        <div class='row'>
            <div class='col-sm-3'><?= $this->Form->input('supervisor',['label'=>'Supervisor Name'])?></div>
            <div class='col-sm-3'><?= $this->Form->input('supervisor_email')?></div>
            <div class='col-sm-3'><?= $this->Form->input('supervisor_phone')?></div>
        </div>
</div>
</div>
<?= $this->Form->button(__('Submit'), ['bootstrap-type' => 'success']) ?>
    <?= $this->Form->end() ?>