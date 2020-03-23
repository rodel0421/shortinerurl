<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $courseModule->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $courseModule->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Course Modules'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Courses'), ['controller' => 'Courses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Course'), ['controller' => 'Courses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Course Machine Types'), ['controller' => 'CourseMachineTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Course Machine Type'), ['controller' => 'CourseMachineTypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Resources'), ['controller' => 'Resources', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Resource'), ['controller' => 'Resources', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Course Enrolled Modules'), ['controller' => 'CourseEnrolledModules', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Course Enrolled Module'), ['controller' => 'CourseEnrolledModules', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Course Tests'), ['controller' => 'CourseTests', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Course Test'), ['controller' => 'CourseTests', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="courseModules form large-9 medium-8 columns content">
    <?= $this->Form->create($courseModule) ?>
    <fieldset>
        <legend><?= __('Edit Course Module') ?></legend>
        <?php
            echo $this->Form->control('course_id', ['options' => $courses]);
            echo $this->Form->control('course_machine_types_id', ['options' => $courseMachineTypes]);
            echo $this->Form->control('resources_id', ['options' => $resources]);
            echo $this->Form->control('name');
            echo $this->Form->control('code');
            echo $this->Form->control('description');
            echo $this->Form->control('active');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
