<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Alert $alert
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Alert'), ['action' => 'edit', $alert->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Alert'), ['action' => 'delete', $alert->id], ['confirm' => __('Are you sure you want to delete # {0}?', $alert->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Alerts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Alert'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="alerts view large-9 medium-8 columns content">
    <h3><?= h($alert->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($alert->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Controller') ?></th>
            <td><?= h($alert->controller) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $alert->has('user') ? $this->Html->link($alert->user->name, ['controller' => 'Users', 'action' => 'view', $alert->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Link') ?></th>
            <td><?= h($alert->link) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= h($alert->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($alert->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item') ?></th>
            <td><?= $this->Number->format($alert->item) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ack') ?></th>
            <td><?= h($alert->ack) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('First Sent') ?></th>
            <td><?= h($alert->first_sent) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($alert->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($alert->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $alert->active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
