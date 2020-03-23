<style>
a.btn.btn-default.pr-2 {
   margin-right: 6px;
}

td {
    padding-bottom: 0px !important;
}

.box{
    border-top: none;
}

     box-shadow: 0 1px 1px rgba(79, 109, 122); 
}


.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
border-top: none;

}


.btn-group.header-course a {
    background: #918fb5;
    color: white;
}



</style>
<!-- //sfsfsfs -->

<div class="btn-group header-course" role="group" aria-label="...">
    <?= $this->Html->link('<i class="fa fa fa-list" aria-hidden="true"></i> List Modules', ['controller' => 'Modules', 'action' => 'index'],['escape' => false, 'class'=>'btn btn-default' , 'title' => 'List Modules']) ?>
    <?= $this->Html->link('<i class="fa fa fa-plus pr-2" aria-hidden="true"></i> Add Module', ['controller' => 'Modules', 'action' => 'add'] , ['escape' => false, 'class'=>'btn btn-default pr-2','title' => 'Add Module']) ?>
    <?= $this->Html->link('<i class="fa fa fa-list" aria-hidden="true"></i> List Tests', ['controller' => 'Tests', 'action' => 'index'],['escape' => false, 'class'=>'btn btn-default','title' => 'List all tests']) ?>
    <?= $this->Html->link('<i class="fa fa fa-plus pr-2" aria-hidden="true"></i> Add Test', ['controller' => 'Tests', 'action' => 'add'],['escape' => false, 'class'=>'btn btn-default pr-2' , 'title' => 'Add test']) ?>
    <?= $this->Html->link('<i class="fa fa fa-list" aria-hidden="true"></i> List Questions', ['controller' => 'CourseQuestions', 'action' => 'index'],['escape' => false, 'class'=>'btn btn-default' , 'title' => 'List Questions']) ?>
    <?= $this->Html->link('<i class="fa fa fa-plus pr-2" aria-hidden="true"></i> Add Question', ['controller' => 'CourseQuestions', 'action' => 'add'] , ['escape' => false, 'class'=>'btn btn-default pr-2','title' => 'Add Question']) ?>
</div>

<div class='box'>
    <div class='box-header'><h3 class='box-title'>
        <i class="fa fa-user" aria-hidden="true"></i> <?= $this->request->query('archived')?'Archived':''?> Courses</h3>
    	<div class="box-tools pull-right">
    	<div class="btn-group">
        <?= $this->Html->link('<i class="fa fa-plus" aria-hidden="true"></i>', 
            ['action' => 'add'],['escape'=>false,'class'=>'btn btn-default','title'=>'Add Course']) ?>
        
        <?php if($this->request->query('archived')){
            echo $this->Form->hidden('archived',['value'=>1,'class'=>'search','id'=>'archived']);
            echo $this->Html->link('<i class="fa fa fa-bars" aria-hidden="true"></i>', 
                ['action' => 'index'],['escape'=>false,'class'=>'btn btn-default','title'=>'Show All']);
        }else{
            echo $this->Html->link('<i class="fa fa-archive" aria-hidden="true"></i>', 
                ['action' => 'index','archived'=>1],['escape'=>false,'class'=>'btn btn-default','title'=>'Show Archived']);
        }?>
      </div>
      </div>
    </div>
    <div class='box-body'>
    <div class="table-responsive">
        <table class="table table-striped table-hover dbclick2open">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('Code') ?></th>
                <th><?= $this->Paginator->sort('Course_name') ?></th>
                <th><?= $this->Paginator->sort('Description') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <tr>
                <th><?= 
                $this->Form->input('Course.code',array(
                    'class'=>'search', 'label' => false,
                    'style'=>'width:150px;',
                    'div' => false, 'required'=>false,
                    'type'=>'text'
                    ))?></th>
                <th><?= 
                    $this->Form->input('Course.name',array(
                    'class'=>'search', 'label' => false,
                    'style'=>'width:150px;',
                    'div' => false, 'required'=>false,
                    'type'=>'text'
                    ))?></th>
                <th><?= 
                    $this->Form->input('Course.description',array(
                    'class'=>'search', 'label' => false,
                    'style'=>'width:150px;',
                    'div' => false, 'required'=>false,
                    'type'=>'text'
                    ))?></th>
                
                
                <th>&nbsp;</th>
                <th>&nbsp;</th>
              
            </tr>
        </thead>
        <tbody>
      
        <?php foreach ($courses as $course): ?>
            <tr data-id="<?= $course->id?>">
                <td><?= h($course->code) ?></td>
                <td><?= h($course->name) ?></td>
                <td class="long-desc"><?= $course->description ?></td>
                <td class="actions">
                    <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', ['action' => 'view', $course->id], ['escape' => false, 'class' => 'btn btn-xs btn-success', 'title' => __('View Course')]) ?>
                    <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') . '</span>', ['action' => 'edit', $course->id], ['escape' => false, 'class' => 'btn btn-xs btn-warning', 'title' => __('Edit Course')]) ?>
                    <?php if($course->disabled):?>
                        <?= $this->Form->postLink('<span class="fa fa-unlock"></span><span class="sr-only">' . __('Enable') 
                        . '</span>',
                ['action' => 'disable', $course->id],
                ['confirm' => __('Are you sure you want to enable this account?'), 'escape' => false, 
                 	'class' => 'btn btn-sm btn-danger', 'title' => __('Enable')])?>
                    <?php else:?>
                    
                    <?php if(!$course->active):?>
                    <?= $this->Form->postLink('<span class="fa fa-undo"></span><span class="sr-only">' . __('Restore') 
                        . '</span>', ['action' => 'delete', $course->id], 
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