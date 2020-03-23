<?php $this->assign('title', 'Recover Password');?>
<?= $this->Flash->render('auth') ?>
<div class="login-box" style="max-width:350px;">
    <div class="login-box-body">
<?php if(isset($provider_name)):?>
     <p class="login-box-msg"><b>Your account is managed by <?= h($provider_name)?></b></p>
     <?= $this->Html->link( h($password_help), $password_link)?>
     <hr/>
     <?= $this->Html->link(__('Home'), '/',['class'=>'btn btn-default']) ?>
<?php else:?>
        <p class="login-box-msg"><b>Enter your registered email address to reset your password.</b></p>
        <?= $this->Form->create($recover); ?>
        
        <?= $this->Form->input('email'); ?>
 
        <?= $this->Form->button(__('Submit'), ['bootstrap-type' => 'success']) ?>
        <?= $this->Html->link(__('Cancel'), '/',['class'=>'pull-right btn btn-default']) ?>
        <?= $this->Form->end() ?>          
<?php endif;?>
 </div><!-- /.login-box-body -->
</div><!-- /.login-box -->