<?php
            
    $status = array(
        'Pending Submission'=>'Pending Submission',
        'In Progress'=>'In Progress',
        'Registered'=>'Registered',
        'Rejected'=>'Rejected'
    );

    ?>
<div class='box'>
    <div class='box-header'><h3 class='box-title'>
        <i class="fa fa-cubes" aria-hidden="true"></i> <?= $this->request->query('archived')?'Deleted':''?> Registers
        </h3>
    	<div class="box-tools pull-right">
    	<div class="btn-group">
        <?= $this->Html->link('<i class="fa fa-plus" aria-hidden="true"></i>', 
            ['action' => 'add'],['escape'=>false,'class'=>'btn btn-default','title'=>'Add']) ?>
        
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
        <table class="data-table-render table table-striped table-hover dbclick2open">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('register_template_id') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('register_class_id') ?></th>
                <th><?= $this->Paginator->sort('department_id') ?></th>
                <th><?= $this->Paginator->sort('status') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($registers as $register): ?>
            <tr data-id="<?= $register->id?>">
            <td>
                    <?= $register->has('register_template') ? $register->register_template->name : '' ?>
                </td>
            <td>
                    <?= $register->has('user') ? $this->Html->link($register->user->name, ['controller' => 'Users', 'action' => 'view', $register->user->id]) : '' ?>
                </td>
            <td>
                    <?= $register->has('register_class') ? $register->register_class->title : '' ?>
                </td>
            <td>
                    <?= $register->has('department') ? $register->department->name : '' ?>
                </td>
            <td><?= h($register->status) ?></td>
                <td><?= h($register->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', 
                        ['action' => 'view', $register->id,'back'=>$this->request->here], ['escape' => false, 'class' => 'btn btn-xs btn-success', 'title' => __('View')]) ?>
                    
                    <?php if(!$register->active):?>
                    <?= $this->Form->postLink('<span class="fa fa-undo"></span><span class="sr-only">' . __('Restore') 
                        . '</span>', ['action' => 'delete', $register->id], 
                        ['confirm' => __('Are you sure you want to restore this?'), 'escape' => false, 
                                        'class' => 'btn btn-xs btn-info', 'title' => __('Restore')]) ?>
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