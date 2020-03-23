<?php $this->assign('title', 'Login to take a test');?>
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
            <p><small>Login to take a test</small></p>
            <?= $this->Flash->render() ?>
            <?= $this->Form->create(null, ['type' => 'POST']); ?>
            <?= $this->Form->text('login_id', ['placeholder' => 'Login ID']) ?>
            <?= $this->Form->password('login_pin', ['placeholder' => 'Login Pin']) ?>
            <?= $this->Form->submit('login',['class' => ['mt-3', 'font-weight-bold']])?>
            <?= $this->Form->end(); ?>

        </div>
    </div>
</section>