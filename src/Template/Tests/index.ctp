<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Test[]|\Cake\Collection\CollectionInterface $tests
  */
?>
<div class="btn-group" role="group" aria-label="...">
    <?= $this->Html->link('<i class="fa fa fa-list" aria-hidden="true"></i> List Modules', ['controller' => 'Modules', 'action' => 'index'],['escape' => false, 'class'=>'btn btn-default' , 'title' => 'List Modules']) ?>
    <?= $this->Html->link('<i class="fa fa fa-plus" aria-hidden="true"></i> Add Module', ['controller' => 'Modules', 'action' => 'add'] , ['escape' => false, 'class'=>'btn btn-default','title' => 'Add Module']) ?>
    <?= $this->Html->link('<i class="fa fa fa-list" aria-hidden="true"></i> List Questions', ['controller' => 'CourseQuestions', 'action' => 'index'],['escape' => false, 'class'=>'btn btn-default' , 'title' => 'List Questions']) ?>
    <?= $this->Html->link('<i class="fa fa fa-plus" aria-hidden="true"></i> Add Question', ['controller' => 'CourseQuestions', 'action' => 'add'] , ['escape' => false, 'class'=>'btn btn-default','title' => 'Add Question']) ?>
</div>
<div class='box'>
<div class='box-header'><h3 class='box-title'>
        <i class="fa fa-pencil-square-o"></i> <?= $this->request->query('archived')?'Deleted':''?> Tests</h3>
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
    <div class="table-responsive">
        <table class="table table-striped table-hover dbclick2open">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('ID') ?></th>
                <th><?= $this->Paginator->sort('Name') ?></th>
                <th><?= $this->Paginator->sort('Type') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
      
        <?php foreach ($tests as $test): ?>
            <tr data-id="<?= $test->id?>">
                <td><?= h($test->id) ?></td>
                <td><?= h($test->name) ?></td>
                <td><?= h($test->course_test_type->value) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', ['action' => 'view', $test->id], ['escape' => false, 'class' => 'btn btn-xs btn-success', 'title' => __('View')]) ?>
                    <?= $this->Html->link('<span class="glyphicon glyphicon-cog"></span><span class="sr-only">' . __('Manage') . '</span>', ['action' => 'manage', $test->id], ['escape' => false, 'class' => 'btn btn-xs btn-primary', 'title' => __('Manage')]) ?>
                    <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') . '</span>', ['action' => 'edit', $test->id], ['escape' => false, 'class' => 'btn btn-xs btn-warning', 'title' => __('Edit')]) ?>
                    <?php if($test->active):?>
                    <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete'),['action' => 'delete', $test->id],['confirm' => __('Are you sure you want to delete # {0}?', $test->id), 'escape' => false, 'class' => 'btn btn-xs btn-danger', 'title' => __('Delete')])?>
                    <?php endif;?>
                    <?php if(!$test->active):?>
                    <?= $this->Form->postLink('<span class="fa fa-undo"></span><span class="sr-only">' . __('Restore') 
                        . '</span>', ['action' => 'delete', $test->id], 
                        ['confirm' => __('Are you sure you want to restore this?'), 'escape' => false, 
                                        'class' => 'btn btn-xs btn-info', 'title' => __('Restore')]) ?>
                    <?php endif;?>
                </td>
            </tr>

        <?php endforeach; ?>
        </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
