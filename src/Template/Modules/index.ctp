
<!-- //asdasdasda -->

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Module</li>
    <!-- <li class="breadcrumb-item active" aria-current="page">View</li> -->
  </ol>
</nav>

<div class='box'>
    
    <div class='box-header'><h3 class='box-title'>
            <i class="fa fa-pencil-square-o"></i> <?= $this->request->query('archived')?'Deleted':''?> Module</h3>
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
        <table class="table table-striped table-hover dbclick2open">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('Header') ?></th>
                <th><?= $this->Paginator->sort('course_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <tr>
                
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        
            <?php foreach ($modules as $module): ?>
            <tr data-id="<?= $module->id?>">
          
                <td><?= h($module->name) ?></td>
                <td><?= $module->has('course') ? $this->Html->link($module->course->name, ['controller' => 'Courses', 'action' => 'view', $module->course->id]) : '' ?></td>

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