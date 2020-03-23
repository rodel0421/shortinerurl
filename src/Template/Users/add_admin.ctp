<?php $this->assign('title','Create Admin Account');?>
<?= $this->Form->create($user); ?>
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Create Admin Account') ?></h3>
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
        </div>
        <div class='row'>
            <div class='col-sm-3'><?= $this->Form->input('username')?></div>
            <div class='col-sm-3'><?= $this->Form->input('password')?></div>
        </div>
</div>
</div>
<?= $this->Form->button(__('Create Account'), ['bootstrap-type' => 'success']) ?>
<?= $this->Form->end() ?>