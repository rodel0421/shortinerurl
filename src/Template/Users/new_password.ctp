<?php $this->assign('title', 'Set up new password');?>
<?= $this->Html->css('test_login') ?>
<section class="banner">	
</section>
<section class="mb-3">
    <div class="wrapper">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div>
            <?=
                $this->Html->image('taronew.png',[
                    'id' => 'icon',
                    'alt' => 'taro icon'
                ])
            ?>
            </div>
            <p><small>Set up new password for</small></p>
            <h6><?= $user->name ?></h6>
            <?= $this->Flash->render() ?>
            <?= $this->Form->create(null, ['type' => 'POST']); ?>
            <?= $this->Form->password('password', ['placeholder' => 'Password']) ?>
            <?= $this->Form->password('confirm_password', ['placeholder' => 'Confirm Password']) ?>
            <?= $this->Form->submit('set password',['class' => ['mt-3', 'font-weight-bold']])?>
            <?= $this->Form->end(); ?>

        </div>
    </div>
</section>