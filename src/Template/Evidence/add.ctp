<?php
/**
  * @var \App\View\AppView $this
  */
?>

<div class='box'>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Evidence'), ['action' => 'index']) ?></li>
        <!-- <li><#?= $this->Html->link(__('List User Tests'), ['controller' => 'UserTests', 'action' => 'index']) ?></li>
        <li><#?= $this->Html->link(__('New User Test'), ['controller' => 'UserTests', 'action' => 'add']) ?></li>
        <li><#?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><#?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li> -->
        <!-- <li><#?= $this->Html->link(__('List Course Tests'), ['controller' => 'CourseTests', 'action' => 'index']) ?></li> -->
        <!-- <li><#?= $this->Html->link(__('New Course Test'), ['controller' => 'CourseTests', 'action' => 'add']) ?></li> -->
    </ul>
</nav>
<div class="evidence form large-9 medium-8 columns content">
    <?= $this->Form->create($evidence, ['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Add Evidence') ?></legend>
        <?php
            echo $this->Form->control('user_test_id', ['options' => $userTests]);
            echo $this->Form->control('user_id', ['options' => $users]);
            // echo $this->Form->control('course_test_id', ['options' => $courseTests]);
            echo $this->Form->control('answer_id' );
            echo $this->Form->input('photo_url', [
                'type' => 'file',
                'help'=>'.pdf, .gif, .jpg, .png, .jpeg, .csv (max file size 5Mb)',
                'label' => 'Upload Document'
                ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
</div>