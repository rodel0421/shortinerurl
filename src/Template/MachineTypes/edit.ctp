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
                ['action' => 'delete', $machineType->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $machineType->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Machine Types'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Modules'), ['controller' => 'Modules', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Module'), ['controller' => 'Modules', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="machineTypes form large-9 medium-8 columns content">
    <?= $this->Form->create($machineType) ?>
    <fieldset>
        <legend><?= __('Edit Machine Type') ?></legend>
        <?php
            echo $this->Form->control('description');
            echo $this->Form->control('icon');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
