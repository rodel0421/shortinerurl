<?php $this->assign('title', 'Notifications');?>
<div class='box'>
    <div class='box-header'>
        <h3 class='box-title'><i class="fa fa-bell-o" aria-hidden="true"></i> <?= $this->request->query('archived')?'Deleted':''?> Notifications for 
        <?= $this->Html->link($user->name, ['controller' => 'Users', 'action' => 'view', $user->id]) ?></h3>
    	<div class="box-tools pull-right">
    	<div class="btn-group">
        <?php if($this->request->query('archived')){
            echo $this->Form->hidden('archived',['value'=>1,'class'=>'search','id'=>'archived']);
            echo $this->Html->link('<i class="fa fa fa-bars" aria-hidden="true"></i>', 
                ['action' => 'index'],['escape'=>false,'class'=>'btn btn-default','title'=>'Show All']);
        }else{
            echo $this->Html->link('<i class="fa fa-trash-o" aria-hidden="true"></i>', 
                ['action' => 'index','archived'=>1],['escape'=>false,'class'=>'btn btn-default','title'=>'Show Deleted']);
        }?>
      </div>
      </div>
    </div>
    <div class='box-body'>
    <div class="table-responsive">
        <table class="table table-striped table-hover dbclick2open">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('title') ?></th>
                <th><?= $this->Paginator->sort('controller','Item') ?></th>
                <th><?= $this->Paginator->sort('ack','Opened') ?></th>
                <th><?= $this->Paginator->sort('first_sent','Emailed') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($alerts as $alert): ?>
            <tr data-id="<?= $alert->id?>">
                <td><?= h($alert->title) ?></td>
                <td><?= h($alert->controller) ?><?= $this->Number->format($alert->item) ?></td>
                <td><?= h($alert->ack) ?></td>
                <td><?= h($alert->first_sent) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', 
                    ['action' => 'view', $alert->id], ['escape' => false, 'class' => 'btn btn-xs btn-success', 'title' => __('View')]) ?>
                    <?php if(!$alert->active):?>
                    <?= $this->Form->postLink('<span class="fa fa-undo"></span><span class="sr-only">' . __('Restore') 
                        . '</span>', ['action' => 'delete', $alert->id], 
                        ['confirm' => __('Are you sure you want to restore this?'), 'escape' => false, 
                                        'class' => 'btn btn-xs btn-info', 'title' => __('Restore')]) ?>
                    <?php else:?>
                    <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') . '</span>', 
                        ['action' => 'delete', $alert->id], 
                        ['confirm' => __('Are you sure you want to delete this?'), 'escape' => false, 'class' => 'btn btn-xs btn-danger', 'title' => __('Delete')]) ?>
                    <?php endif;?>
                        
                        
                </td>
            </tr>

        <?php endforeach; ?>
        </tbody>
        </table>
    </div>
    </div>
    <div class='box-footer'>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
</div>