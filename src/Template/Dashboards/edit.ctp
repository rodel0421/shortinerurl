
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Edit Dashboard') ?></h3>
    	<div class="box-tools pull-right">
    	
    	<?= $this->Html->link('View Dashboard', ['action' => 'view',$dashboard->id], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('Open Dashboard')]) ?>
                 		
    	<?= $this->Form->postLink(
        		'<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete'),
                ['action' => 'delete', $dashboard->id],
                ['confirm' => __('Are you sure you want to delete this dashboard?'), 'escape' => false, 
                 	'class' => 'btn btn-danger', 'title' => __('Delete')]
            )
        ?>
      </div>
    </div>
    <div class='box-body'>
    <?= $this->Form->create($dashboard); ?>
        <?php
            echo $this->Form->input('name');
        ?>
    <?= $this->Form->button(__('Rename'), ['bootstrap-type' => 'success']) ?>
    <?= $this->Form->end() ?>
        
    
</div>
    <div class="box-footer">
        <div class='box box-info'>
    <div class='box-header'><h3 class='box-title'><?= __('Dashboard Modules') ?></h3>
    	<div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class='box-body'>
    <?php if (!empty($dashboard->dashboard_items)): ?>
    <div class="">
    <table class="table table-bordered table-hover data-table">
    <thead>
        <tr>
            <th><?= __('Name') ?></th>
            <th><?= __('Filter') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($dashboard->dashboard_items as $dashboardItems): ?>
        <tr>
           
            <td>
            <?php if($dashboardItems->title):?>
                <?= h($dashboardItems->title)?>
            <?php else:?>
                <?= (isset($dashboard_items[$dashboardItems->name])) ? h($dashboard_items[$dashboardItems->name]): h($dashboardItems->name) ?>
            <?php endif;?>
            </td>
            <td><?= (isset($filter_types[$dashboardItems->filter_type])) ? h($filter_types[$dashboardItems->filter_type]): h($dashboardItems->filter_type) ?></td>
            <td class="actions">
                <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') . '</span>', 
                        ['controller' => 'DashboardItems','action' => 'edit', $dashboardItems->id], 
                        ['escape' => false, 'class' => 'btn btn-xs btn-warning', 'title' => __('Edit')]) ?>
                   
                 <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') 
                 		. '</span>', ['controller' => 'DashboardItems', 'action' => 'delete', $dashboardItems->id], 
                 		['confirm' => __('Are you sure you want to remove this module?'), 'escape' => false, 
                 				'class' => 'btn btn-xs btn-danger', 'title' => __('Remove')]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <?php endif; ?>
    </div>
    <div class="box-footer">
        <?php foreach($dashboard_items as $value => $name):?>
        <?= $this->Html->link('<i class="fa fa-plus"></i> '.$name, 
                ['controller'=>'DashboardItems','action' => 'add',$dashboard->id,'name'=>$value],
                ['escape'=>false,'class'=>'btn btn-default']) ?>
        <?php endforeach;?>
    </div>
</div>
        </div>
</div>
