<?php $this->assign('title', h($user->name).' Reset Password');?>
<?= $this->Flash->render('auth') ?>
<div class="login-box" style="max-width:350px;">
    <div class="login-box-body">
        
        <p class="login-box-msg"><b>Enter new password</b></p>
        <?= $this->Form->create($user); ?>
        <?php
            echo $this->Form->input('password',['value'=>'']);
            echo $this->Form->input('confirm_password',['type'=>'password','value'=>'']);
            
        ?>
    <?= $this->Form->button(__('Submit'), ['bootstrap-type' => 'success']) ?>
    <?= $this->Form->end() ?>        
    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->