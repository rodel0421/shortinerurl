<?php 
$this->assign('title', 'Notice Board');

$group = $this->request->session()->read('Auth.User.group_id');
$user_id = $this->request->session()->read('Auth.User.id');
?>
<div class='box'>
    <div class='box-header'>
        <h3 class='box-title'><i class="fa fa-sticky-note-o" aria-hidden="true"></i> <?= $this->request->query('archived')?'Deleted':''?> Messages</h3>
    	<div class="box-tools pull-right">
    	<div class="btn-group">
        <?= $this->Html->link('<i class="fa fa-plus" aria-hidden="true"></i>', 
            ['action' => 'add'],['escape'=>false,'class'=>'btn btn-default','title'=>'Add']) ?>
        
        <?php if($this->request->query('history')){
            echo $this->Form->hidden('history',['value'=>1,'class'=>'search','id'=>'history']);
            echo $this->Html->link('<i class="fa fa fa-bars" aria-hidden="true"></i>', 
                ['action' => 'index'],['escape'=>false,'class'=>'btn btn-default','title'=>'Show Current']);
        }else{
            echo $this->Html->link('<i class="fa fa-history" aria-hidden="true"></i>', 
                ['action' => 'index','history'=>1],['escape'=>false,'class'=>'btn btn-default','title'=>'Show Expired']);
        }?>
            
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
                <th><?= $this->Paginator->sort('expires') ?></th>
                <th><?= $this->Paginator->sort('user_id','Posted By') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($messages as $message): ?>
            <tr data-id="<?= $message->id?>">
                
                <td><?= h($message->title) ?></td>
                <td><?= h($message->expires) ?></td>
                <td>
                    <?= $message->has('user') ?$message->user->name: '' ?>
                </td>
                <td><?= h($message->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', ['action' => 'view', $message->id], ['escape' => false, 'class' => 'btn btn-xs btn-success', 'title' => __('View')]) ?>
                    <?php 
                    if(($group && $group <= 2) || $message->user_id == $user_id)://3 officer and below lock to own account
            
                        if($message->active):?>
                        <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') . '</span>', 
                            ['action' => 'delete', $message->id], ['confirm' => __('Are you sure you want to delete this record?'), 
                            'escape' => false, 'class' => 'btn btn-xs btn-danger', 'title' => __('Delete')]) ?>
                        <?php else:?>
                        <?= $this->Form->postLink('<span class="fa fa-undo"></span><span class="sr-only">' . __('Restore') 
                            . '</span>', ['action' => 'delete', $message->id], 
                            ['confirm' => __('Are you sure you want to restore this?'), 'escape' => false, 
                                            'class' => 'btn btn-xs btn-info', 'title' => __('Restore')]) ?>
                        <?php endif;?>
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