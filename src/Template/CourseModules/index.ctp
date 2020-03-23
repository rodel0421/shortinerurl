<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\CourseModule[]|\Cake\Collection\CollectionInterface $courseModules
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Course Module'), ['action' => 'add']) ?></li>
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
<div class="courseModules index large-9 medium-8 columns content">
    <h3><?= __('Course Modules') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('course_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('course_machine_types_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('resources_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                <th scope="col"><?= $this->Paginator->sort('active') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($courseModules as $courseModule): ?>
            <tr>
                <td><?= $this->Number->format($courseModule->id) ?></td>
                <td><?= $courseModule->has('course') ? $this->Html->link($courseModule->course->name, ['controller' => 'Courses', 'action' => 'view', $courseModule->course->id]) : '' ?></td>
                <td><?= $courseModule->has('course_machine_type') ? $this->Html->link($courseModule->course_machine_type->id, ['controller' => 'CourseMachineTypes', 'action' => 'view', $courseModule->course_machine_type->id]) : '' ?></td>
                <td><?= $courseModule->has('resource') ? $this->Html->link($courseModule->resource->title, ['controller' => 'Resources', 'action' => 'view', $courseModule->resource->id]) : '' ?></td>
                <td><?= h($courseModule->name) ?></td>
                <td><?= h($courseModule->code) ?></td>
                <td><?= h($courseModule->description) ?></td>
                <td><?= h($courseModule->active) ?></td>
                <td><?= h($courseModule->created) ?></td>
                <td><?= h($courseModule->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $courseModule->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $courseModule->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $courseModule->id], ['confirm' => __('Are you sure you want to delete # {0}?', $courseModule->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
