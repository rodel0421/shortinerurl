<style>
td.table-data {
    transform: translateY(7px); 
    vertical-align: top !important;
}

tr:nth-child(even)>td {
    border-top: none !important;
}

.main-thead tr th {
    background: #e5e5e5;
    display: inline-block !important;
    border-radius: 5px 5px 0px 0px;
    padding: 5px 50px;
    position: relative;
    top: 0px;
    color: #000;
}

.main-tbody{
    border: 1px solid #e5e5e5;
}

tr:nth-child(1)>td{
    border: none !important;
    vertical-align: initial;
}

.inner-header h3{
    margin-top: 5px;
    margin-bottom: 5px;
    margin-left: 5px;
    /* text-align: left; */
    display: inline-block;

}

.inner-header thead th a {
    margin-top: 3px;
}

th.text-center {
    text-align: left !important;
}
th.text-center{
background: #4f6d7a;

}

td.td-title {
    font-weight: 600;
}

</style>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="../">Module</a></li>
    <li class="breadcrumb-item active" aria-current="page">View</li>
  </ol>
</nav>
<div class='box box-primary'>
    <div class='box-header'>
    <h3 class="timeline-header"><?= $module->name?></h3>

    	<div class="box-tools pull-right">
    	
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['controller'=>'Courses','action' => 'view',$module->course_id], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
                 		
    	<?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') 
                 		. '</span>', ['action' => 'edit', $module->id], 
                 		['escape' => false, 'class' => 'btn btn-warning', 'title' => __('Edit')]) ?>
        <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') 
                 		. '</span>', ['action' => 'delete', $module->id], 
                 		['confirm' => __('Are you sure you want to delete # {0}?', $module->id), 'escape' => false, 
                 				'class' => 'btn btn-danger', 'title' => __('Delete')]) ?>
    	<?= $this->element('guide', array("section" => 'formTemplates')) ?>
        
      </div>
    </div>
    <div class='box-body'>

    <div>
    <table class="main-table" width="100%">
    <thead class="main-thead"> <th colspan="2">Details</th></thead>
    <tbody class="main-tbody">
    <tr>
    <td width="50%">
    <table class="table">
        <!-- <thead>
            <tr class="bg-primary text-white">
                <th class="text-center" colspan="2"><h3><#?= 'Details' ?></h3></th>
            </tr>
        </thead> -->
        <tbody>
            <tr>
                <td class="td-title" >Course:</td>
            </tr>
            <tr>
                <td ><?= $module->has('course') ? $this->Html->link($module->course->name, ['controller' => 'Course', 'action' => 'view', $module->course->id]) : '' ?></td>
            </tr>
            <tr>
                <td class="td-title"> Resource:</td>
            </tr>
            <tr>
                <td ><?= $module->has('resource') ? $this->Html->link($module->resource->title, ['controller' => 'Resources', 'action' => 'view', $module->resource->id]) : '' ?></td>
            </tr>
            <tr>
                <td class="td-title">Code:</td>
            </tr>
            <tr>
                <td ><?= $module->code ?></td>
            </tr>
            <tr>
                <td class="td-title">Register Class:</td>
            </tr>
            <tr>
                <td ><?= $module->has('register_class') ? h($module->register_class->title) : '' ?></td>
            </tr>
            <!-- <tr> -->
            <!-- </tr> -->
        </tbody>
    </table>
    </td>
    <!-- <br> -->
    <td class="table-data" width="50%">
    <table class="table ">
        <!-- <thead>
            <tr class="bg-primary text-white">
                <th class="text-center"><h3><#?= 'Content' ?></h3></th>
            </tr>
        </thead> -->
        <tbody>
            
            <tr>
                <td class="td-title" >Description:</td>
            </tr>
            <tr>
                <td ><?= $module->description; ?></td>
            </tr>
        </tbody>
    </table>
    </td>
    </tr>
    </tbody>
    </table>
    <br>
    <table class="table table-striped inner-header">
        <thead>
            <tr class="bg-primary text-white">
                <th class="text-center" colspan="4">
                    <h3><?='Related Tests'?></h3>
                    <?= $this->Html->link('Add Tests', [
                        'controller' => 'Tests',
                        'action' => 'add',
                        $module->id
                    ],
                    [
                        'type' => 'button',
                        'class' => [
                            'btn',
                            'btn-sm',
                            'btn-success',
                            'pull-right'
                        ]
                    ]); ?>
                </th>
            </tr>
            <tr>
                <th><?= __('ID') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Type') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($module->tests as $index=>$test): ?> 
                <tr data-id="<?= $test->id?>">
                    <td><?= h($test->id) ?></td>
                    <td><?= h($test->name) ?></td>
                    <td><?= h($test->course_test_type->value) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', ['controller'=> 'Tests','action' => 'view', $test->id], ['escape' => false, 'class' => 'btn btn-xs btn-success', 'title' => __('View')]) ?>
                        <?= $this->Html->link('<span class="glyphicon glyphicon-cog"></span><span class="sr-only">' . __('Manage') . '</span>', ['controller'=> 'Tests','action' => 'manage', $test->id], ['escape' => false, 'class' => 'btn btn-xs btn-primary', 'title' => __('Manage')]) ?>
                        <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') . '</span>', ['controller'=> 'Tests','action' => 'edit', $test->id], ['escape' => false, 'class' => 'btn btn-xs btn-warning', 'title' => __('Edit')]) ?>
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

</div>
