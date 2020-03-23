<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\MachineType $machineType
  */
?>
<!-- <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Machine Type'), ['action' => 'edit', $machineType->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Machine Type'), ['action' => 'delete', $machineType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $machineType->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Machine Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Machine Type'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Modules'), ['controller' => 'Modules', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Module'), ['controller' => 'Modules', 'action' => 'add']) ?> </li>
    </ul>
</nav> -->
<div class="machineTypes view large-9 medium-8 columns content">
    <table class="table table-striped">
        <thead>
            <tr class="bg-primary text-white">
                <th class="text-center" colspan="2"><h3>Details</h3></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="50%" class="bg-gray">ID</td>
                <td width="50%"><?= h($machineType->id)?></td>
            </tr>
            <tr>
                <td width="50%" class="bg-gray">Description</td>
                <td width="50%"><?= $machineType->description ?></td>
            </tr>
            <tr>
                <td width="50%" class="bg-gray">Icon</td>
                <td width="50%"><?= $machineType->icon ?></td>
            </tr>
        </tbody>
    </table>
    <?php if($machineType->modules):?>
        <div class="related">
        <table class="table table-striped">
            <thead>
                <tr class="bg-primary text-white">
                    <th class="text-center" colspan="2"><h3>Related Modules</h3></th>
                </tr>
                <tr>
                    <th>Module</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($machineType->modules as $module):?>
                <tr data-id="<?= $module->id?>">
          
                <td><?= h($module->name) ?></td>

                <td class="actions">
                    <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', ['action' => 'view', $module->id], ['escape' => false, 'class' => 'btn btn-xs btn-success', 'title' => __('View')]) ?>
                    <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') . '</span>', ['action' => 'edit', $module->id], ['escape' => false, 'class' => 'btn btn-xs btn-warning', 'title' => __('Edit')]) ?>
                    <?php if($module->active):?>
                    <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete'),['action' => 'delete', $module->id],['confirm' => __('Are you sure you want to delete # {0}?', $module->id), 'escape' => false, 'class' => 'btn btn-xs btn-danger', 'title' => __('Delete')])?>
                    <?php endif;?>
                    <?php if(!$module->active):?>
                    <?= $this->Form->postLink('<span class="fa fa-undo"></span><span class="sr-only">' . __('Restore') 
                        . '</span>', ['action' => 'restore', $module->id], 
                        ['confirm' => __('Are you sure you want to restore this?'), 'escape' => false, 
                                        'class' => 'btn btn-xs btn-info', 'title' => __('Restore')]) ?>
                <?php endif;?>
                </td>
            </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        </div>
    <?php endif;?>
</div>
