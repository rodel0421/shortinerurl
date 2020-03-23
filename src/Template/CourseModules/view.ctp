<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\CourseModule $courseModule
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Course Module'), ['action' => 'edit', $courseModule->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Course Module'), ['action' => 'delete', $courseModule->id], ['confirm' => __('Are you sure you want to delete # {0}?', $courseModule->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Course Modules'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Course Module'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Courses'), ['controller' => 'Courses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Course'), ['controller' => 'Courses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Course Machine Types'), ['controller' => 'CourseMachineTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Course Machine Type'), ['controller' => 'CourseMachineTypes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Resources'), ['controller' => 'Resources', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Resource'), ['controller' => 'Resources', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Course Enrolled Modules'), ['controller' => 'CourseEnrolledModules', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Course Enrolled Module'), ['controller' => 'CourseEnrolledModules', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Course Tests'), ['controller' => 'CourseTests', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Course Test'), ['controller' => 'CourseTests', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="courseModules view large-9 medium-8 columns content">
    <h3><?= h($courseModule->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Course') ?></th>
            <td><?= $courseModule->has('course') ? $this->Html->link($courseModule->course->name, ['controller' => 'Courses', 'action' => 'view', $courseModule->course->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Course Machine Type') ?></th>
            <td><?= $courseModule->has('course_machine_type') ? $this->Html->link($courseModule->course_machine_type->id, ['controller' => 'CourseMachineTypes', 'action' => 'view', $courseModule->course_machine_type->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Resource') ?></th>
            <td><?= $courseModule->has('resource') ? $this->Html->link($courseModule->resource->title, ['controller' => 'Resources', 'action' => 'view', $courseModule->resource->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($courseModule->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Code') ?></th>
            <td><?= h($courseModule->code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($courseModule->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($courseModule->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($courseModule->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($courseModule->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $courseModule->active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Course Enrolled Modules') ?></h4>
        <?php if (!empty($courseModule->course_enrolled_modules)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Course Enrolled User Id') ?></th>
                <th scope="col"><?= __('Course Module Id') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Date Complete') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($courseModule->course_enrolled_modules as $courseEnrolledModules): ?>
            <tr>
                <td><?= h($courseEnrolledModules->id) ?></td>
                <td><?= h($courseEnrolledModules->course_enrolled_user_id) ?></td>
                <td><?= h($courseEnrolledModules->course_module_id) ?></td>
                <td><?= h($courseEnrolledModules->status) ?></td>
                <td><?= h($courseEnrolledModules->date_complete) ?></td>
                <td><?= h($courseEnrolledModules->created) ?></td>
                <td><?= h($courseEnrolledModules->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'CourseEnrolledModules', 'action' => 'view', $courseEnrolledModules->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'CourseEnrolledModules', 'action' => 'edit', $courseEnrolledModules->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'CourseEnrolledModules', 'action' => 'delete', $courseEnrolledModules->id], ['confirm' => __('Are you sure you want to delete # {0}?', $courseEnrolledModules->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Course Tests') ?></h4>
        <?php if (!empty($courseModule->course_tests)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Course Module Id') ?></th>
                <th scope="col"><?= __('Type') ?></th>
                <th scope="col"><?= __('Active') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($courseModule->course_tests as $courseTests): ?>
            <tr>
                <td><?= h($courseTests->id) ?></td>
                <td><?= h($courseTests->course_module_id) ?></td>
                <td><?= h($courseTests->type) ?></td>
                <td><?= h($courseTests->active) ?></td>
                <td><?= h($courseTests->created) ?></td>
                <td><?= h($courseTests->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'CourseTests', 'action' => 'view', $courseTests->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'CourseTests', 'action' => 'edit', $courseTests->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'CourseTests', 'action' => 'delete', $courseTests->id], ['confirm' => __('Are you sure you want to delete # {0}?', $courseTests->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
