<?php
    
?>
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'>
            <?= $equipment->has('equipment_type') && $equipment->equipment_type->icon ? $this->Html->image($equipment->equipment_type->icon,['class'=>'inline_icon']) : '' ?>
            <?= h($equipment->title) ?> <span class='small'><?= $equipment->has('equipment_type') ? $equipment->equipment_type->title : '' ?></span>
            <?= $equipment->has('user') ? $this->Html->link($equipment->user->name, ['controller' => 'Users', 'action' => 'view', $equipment->user->id]) : '' ?>
            <?= $equipment->active ? __('') : __('Archived'); ?>
        
        </h3>
    	<div class="box-tools pull-right">
    	<?php 
        if($this->request->query('back')){
            echo $this->Html->link('Back',$this->request->query('back') , 
                ['escape' => false, 'class' => 'btn btn-default', 'title' => __('Back')]);
        } ?>
            
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
                 		
    	<?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') 
                 		. '</span>', ['action' => 'edit', $equipment->id], 
                 		['escape' => false, 'class' => 'btn btn-warning', 'title' => __('Edit')]) ?>
        <?php if($equipment->active):?>
        <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') 
                 		. '</span>', ['action' => 'delete', $equipment->id], 
                 		['confirm' => __('Are you sure you want to delete this?'), 'escape' => false, 
                 				'class' => 'btn btn-danger', 'title' => __('Delete')]) ?>
        <?php else:?>
            <?= $this->Form->postLink('<span class="fa fa-undo"></span><span class="sr-only">' . __('Restore') 
                 		. '</span>', ['action' => 'delete', $equipment->id], 
                 		['confirm' => __('Are you sure you want to restore this?'), 'escape' => false, 
                 				'class' => 'btn btn-info', 'title' => __('Restore')]) ?>
        <?php endif;?>
    	<?= $this->element('guide', array("section" => 'equipment')) ?>
        
      </div>
    </div>
    <div class='box-body'>
    <div class='row'>
        <?php 
        $image = $equipment->picture_url;
        
        if(!$image && $equipment->has('equipment_type') && $equipment->equipment_type->image){
            $image = $equipment->equipment_type->image;
        }
        
        if(!empty($image)):?>
    <div class="col-md-2 col-xs-4">
        <div class="box ">
            <div class="box-body">
                <?php echo $this->Dak->image($image,
                        array('class'=>'img-responsive',
                            'alt'=>'Equipment Photo'));?>
                
            </div>
        </div>
    </div>
        <?php endif;?>
        <div class='col-md-3 col-sm-6'>

        <ul class="list-group list-group-unbordered">
                    
                    <li class="list-group-item">
                        <b>Make</b> <span class="pull-right"><?= h($equipment->make) ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Model</b> <span class="pull-right"><?= h($equipment->model) ?></span>
                    </li>
                    
                    <li class="list-group-item">
                        <b>Asset</b> <span class="pull-right"><?= h($equipment->asset) ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Serial</b> <span class="pull-right"><?= h($equipment->serial) ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Part Number</b> <span class="pull-right"><?= h($equipment->part_number) ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Location</b> <span class="pull-right"><?= h($equipment->location) ?></span>
                    </li>
                </ul>  
          
        </div>
        <div class='col-md-3 col-sm-6'>
            <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                    <b><?= __('Purchased') ?></b> <span class="pull-right"><?= h($equipment->purchased) ?></span>
                </li>
                <li class="list-group-item">
                    <b><?= __('Cost') ?></b> <span class="pull-right"><?= $this->Number->currency($equipment->cost) ?></span>
                </li>

                <li class="list-group-item">
                    <b><?= __('Depreciated Over Years') ?></b> <span class="pull-right"><?= $this->Number->format($equipment->depreciated_over_years) ?></span>
                </li>
                <li class="list-group-item">
                    <b><?= __('Cost Centre') ?></b> <span class="pull-right"><?= h($equipment->cost_centre) ?></span>
                </li>
                <li class="list-group-item">
                    <b>Department</b> <span class="pull-right"><?= ($equipment->has('department'))? h($equipment->department->name) : '' ?></span>
                </li>
                <li class="list-group-item">
                    <b><?= __('Issued To') ?></b> <span class="pull-right"><?=  h($equipment->issued_to) ?></span>
                </li>
                <?php if($equipment->for_hire):?>
                <li class="list-group-item">
                    <b><?= __('For Hire') ?></b> <span class="pull-right">
                        <?=  ($equipment->qty)?>
                        <?= ($equipment->hire_rate)? ' @ '. $this->Number->currency($equipment->hire_rate) :''?>
                        </span>
                </li>

                <?php endif;?>
            </ul>   
        </div>
        <div class='col-md-3 col-sm-6'>
            <ul class="list-group list-group-unbordered">
                <?php if($equipment->equipment_type->serviceable):?>
                <li class="list-group-item">
                    <b><?= __('Last Service') ?></b> <span class="pull-right"><?= h($equipment->last_service) ?></span>
                </li>
                <li class="list-group-item">
                    <b><?= __('Next Service') ?></b> <span class="pull-right"><?php if($equipment->status>0):?><i class="fa fa-circle status_<?= $equipment->status ?>"></i><?php endif;?> <?= h($equipment->next_service) ?></span>
                </li>
                <?php endif;?>
                <li class="list-group-item">
                    <b><?= __('Next Alert') ?></b> <span class="pull-right"><?php if($equipment->alert_status>0):?><i class="fa fa-circle status_<?= $equipment->alert_status ?>"></i><?php endif;?> <?= h($equipment->next_alert) ?></span>
                </li>
                <?php if($equipment->equipment_type->track_usage):?>
                <li class="list-group-item">
                    <b><?= __('Current Hours') ?></b> <span class="pull-right"><?= h($equipment->usage_hours) ?></span>
                </li>
                <li class="list-group-item">
                    <b><?= __('Current Km') ?></b> <span class="pull-right"><?= h($equipment->usage_km) ?></span>
                </li>
                <?php endif;?>
            </ul>   
        </div>
    </div>
    <?php if(!empty($equipment->equipment_type->data)):?>
    <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-info"></i>
          <h3 class="box-title"><?= __('Custom Fields') ?></h3>
          <div class="box-tools pull-right">
            <?= $this->Html->link('<i class="glyphicon glyphicon-pencil"></i> Edit', 
            ['controller'=>'Equipment','action' => 'custom',$equipment->id],
            ['escape'=>false,
             'class'=>'btn btn-warning']) ?>
      </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class='row'>
            <?php 
            $rows = 5;
            
            $custom_data = json_decode($equipment->type_data, true);
            if(is_array($custom_data)):
            foreach($custom_data as $title => $value):?>
                <div class="col-md-3 col-sm-6"><b><?= Cake\Utility\Inflector::humanize(h($title)) ?></b> <span class="pull-right"><?= h($value) ?></span></div>
            <?php endforeach;
            endif;
            
            ?>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
    <?php endif;?>
    <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-text-width"></i>
          <h3 class="box-title"><?= __('Notes') ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
         <?= $equipment->notes ?>
        </div>
        <!-- /.box-body -->
    </div>
        
    <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><?= __('Related Equipment') ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
         <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th><?= __('Title') ?></th>
                <th><?= __('Type') ?></th>
                <th><?= __('Asset') ?></th>
                <th><?= __('Make') ?></th>
                <th><?= __('Model') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php if($equipment->has('related_equipment')):?>
        <?php foreach ($equipment->related_equipment as $related_equipment): ?>
            <tr>
              
                <td><?= h($related_equipment->title) ?></td>
                <td>
                    <?= $related_equipment->has('equipment_type') ? $related_equipment->equipment_type->title : '' ?>
                </td>
                <td><?= h($related_equipment->asset) ?></td>
                <td><?= h($related_equipment->make) ?></td>
                <td><?= h($related_equipment->model) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', 
                        ['action' => 'view', $related_equipment->id], 
                        ['escape' => false, 'class' => 'btn btn-xs btn-success', 'title' => __('View')]) ?>
                    <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') . '</span>', 
                        ['controller'=>'EquipmentLinks','action' => 'delete', $related_equipment->_joinData->id], 
                        ['confirm' => __('Are you sure you want to remove this link?'), 
                            'escape' => false, 'class' => 'btn btn-xs btn-danger', 'title' => __('Delete')]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php endif;?>
        <?php if($equipment->has('related_to_equipment')):?>
        <?php foreach ($equipment->related_to_equipment as $related_equipment): ?>
            <tr>
              
                <td><?= h($related_equipment->title) ?></td>
                <td>
                    <?= $related_equipment->has('equipment_type') ? $related_equipment->equipment_type->title : '' ?>
                </td>
                <td><?= h($related_equipment->asset) ?></td>
                <td><?= h($related_equipment->make) ?></td>
                <td><?= h($related_equipment->model) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', 
                        ['action' => 'view', $related_equipment->id], 
                        ['escape' => false, 'class' => 'btn btn-xs btn-success', 'title' => __('View')]) ?>
                    <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') . '</span>', 
                        ['controller'=>'EquipmentLinks','action' => 'delete', $related_equipment->_joinData->id], 
                        ['confirm' => __('Are you sure you want to remove this link?'), 
                            'escape' => false, 'class' => 'btn btn-xs btn-danger', 'title' => __('Delete')]) ?>
                
                </td>
            </tr>
        <?php endforeach; ?>
        <?php endif;?>
        </tbody>
        </table>
            <?= $this->Form->create(null,['url'=>['controller'=>'EquipmentLinks','action'=>'add',$equipment->id]]); ?>
            <div class='row'>
                <div class='col-md-4'>
                    

            <?= $this->Form->input('related_equipment',[
                'placeholder'=>'Search for equipment to link to',
                'div'=>false,
                'label'=>false,
                'options'=>[],
                'multiple'=>false,
                'templates'=>[
                    'inputContainer' => '{{content}}'
                ],
                'class'=>'relatedLookup'])?>
                
          </div>
                <div class='col-md-1'>
                    <?= $this->Form->button(__('Link Equipment'), ['bootstrap-type' => 'success']) ?>
                </div>
            </div>
         <?= $this->Form->end() ?>
        </div>
        <!-- /.box-body -->
    </div>
        
</div>
    
<div class='box-footer'>
    <?php $footerHtml = '';?>
    <?php 
        $footerHtml .= "<b>". __('Created') .":</b> ";
        $footerHtml .= h($equipment->created)." ";
        ?>
        <?php 
        $footerHtml .= "<b>". __('Modified') .":</b> ";
        $footerHtml .= h($equipment->modified)." ";
        ?>
    <?= $footerHtml ?>
</div>
</div>



<?php 
$showNotes = isset($this->request->query['hide_notes'])? !($this->request->query['hide_notes']):true;
if($showNotes):
?>
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_notes" data-toggle="tab">Notes</a></li>
        <li><a href="#tab_service" data-toggle="tab">Service History</a></li>
        <li><a href="#tab_docuemtns" data-toggle="tab">Documents</a></li>
        <li><a href="#tab_reminders" data-toggle="tab">Reminders</a></li>
        <li class="pull-right"><?= $this->Html->link('<i class="fa fa-plus"></i> Add Reminder', 
            ['controller'=>'EquipmentLogs','action' => 'add',$equipment->id,'type'=>'Reminder'],
            ['escape'=>false,
             'class'=>'btn btn-default']) ?></li>
        <li class="pull-right"><?= $this->Html->link('<i class="fa fa-plus"></i> Add Document', 
            ['controller'=>'EquipmentLogs','action' => 'add',$equipment->id,'type'=>'Document'],
            ['escape'=>false,
             'class'=>'btn btn-default']) ?></li>
        <li class="pull-right"><?= $this->Html->link('<i class="fa fa-plus"></i> Add Service Log', 
            ['controller'=>'EquipmentLogs','action' => 'add',$equipment->id,'type'=>'Service'],
            ['escape'=>false,
             'class'=>'btn btn-default']) ?></li>
        <li class="pull-right"><?= $this->Html->link('<i class="fa fa-plus"></i> Add Notes', 
            ['controller'=>'EquipmentLogs','action' => 'add',$equipment->id,'type'=>'Notes'],
            ['escape'=>false,
             'class'=>'btn btn-default']) ?></li>        
    </ul>
    
    <div class="tab-content">
        <div class="tab-pane active" id="tab_notes">
            <ul class="timeline">
    <?php if (!empty($equipment->equipment_logs)):
        $lastDate = '';
        foreach($equipment->equipment_logs as $equipment_logs):    ?>
<?php 

    $isAudit = $equipment_logs->type == 'Audit';
    $isEmail = $equipment_logs->type == 'Email';//fa fa-envelope
    $commentDate = strtotime($equipment_logs->created->i18nFormat('yyyy-MM-dd HH:mm:ss'));
    $dateNice = date("D, d-M-y", $commentDate);
    
    $icon = 'fa-comment-o bg-blue';
    if($isAudit){
        $icon = 'fa-book bg-green';
    }
    if($isEmail){
        $icon = 'fa-envelope bg-red';
    }
    
    switch($equipment_logs->type){
        case 'Document':
            $icon = 'fa-folder-o bg-blue';
            break;
        case 'Service':
            $icon = 'fa-wrench bg-blue';
            break;
        
        case 'Reminder':
            $icon = 'fa-calendar-check-o bg-blue';
            break;
    }
    
    ?>
    <?php if($dateNice != $lastDate):
       $lastDate = $dateNice;?>
        <li class="time-label">
        <span class="bg-red">
            <?= $dateNice ?>
        </span>
    </li>
    <?php endif;?>
<li>

<i class="fa <?= $icon ?>"></i>
<div class="timeline-item">
<span class="time"><i class="fa fa-clock-o"></i> <?= date("g:i A", $commentDate) ?></span>
<h3 class="timeline-header"><?= $equipment_logs->has('user') && !$isEmail ?$equipment_logs->user->name:'' ?> <?= $isAudit || $isEmail? $equipment_logs->notes : ''; ?></h3>
<?php 
if(!$isAudit && !$isEmail):?>
<div class="timeline-body">
    <div class='tools'>
    <?php 
    if($equipment_logs->created->i18nFormat('yyyy-MM-dd') == date("Y-m-d")):?>
    <?= $this->Html->link('<i class="fa fa-edit"></i>', 
    ['controller'=>'EquipmentLogs','action' => 'edit', $equipment_logs->id], 
    ['escape' => false, 'title' => __('Edit')]) ?>
    <?php endif;?>
    <?= $this->Form->postLink('<i class="fa fa-trash-o"></i>', 
    ['controller'=>'EquipmentLogs','action' => 'delete', $equipment_logs->id], 
    ['confirm' => __('Are you sure you want to delete this note?'), 'escape' => false, 'title' => __('Delete')]) ?>
</div>
    <?php echo $equipment_logs->notes;?>
    <?php if($equipment_logs->file_url){
        $icon = '<span class="file-icon-mini '.h($equipment_logs->file_ext).'-mini"></span> '.
                h($equipment_logs->file_name).' ['.
                $this->Number->toReadableSize($equipment_logs->file_size).']';
        echo $this->Dak->link($icon,$equipment_logs->file_url,array('target'=>'_blank','escape'=>false));
    }?>
    <?php if($equipment_logs->cost):?><span class='label bg-yellow'><?= $this->Number->currency($equipment_logs->cost) ?></span><?php endif;?>
<?php if($equipment_logs->date):?><span class='label bg-blue'><?= $equipment_logs->date ?></span><?php endif;?>
</div>
<?php endif;?>
</div>
</li>
<?php endforeach; ?>  
<?php endif; ?>
</ul>
        </div>
        <div class="tab-pane" id="tab_service">
            <table class="table">
            <thead><tr>
                <th>Service Date</th>
                <th>Notes</th>
                <th>Attachment</th>
                <th>Cost</th>
                <th>&nbsp;</th>
            </tr></thead>
            <tbody>
                <?php if(isset($equipmentLogs['Service'])):?>
                <?php foreach($equipmentLogs['Service'] as $id => $log):?>
                <tr>
                    <td><?= $log->date?></td>
                    <td><?= $log->notes?></td>
                    <td><?php if($log->file_url){
                            $icon = '<span class="file-icon-mini '.h($log->file_ext).'-mini"></span> '.
                                    h($log->file_name).' ['.
                                    $this->Number->toReadableSize($log->file_size).']';
                            echo $this->Dak->link($icon,$log->file_url,array('target'=>'_blank','escape'=>false));
                    }?></td>
                    <td><?= $this->Number->currency($log->cost) ?></td>
                    <td class='hidden-tools' style='width:80px'>
                        <div class='tools'>
                        <?php if($log->created->i18nFormat('yyyy-MM-dd') == date("Y-m-d")):?>
                        <?= $this->Html->link('<i class="fa fa-edit"></i>', 
                        ['controller'=>'EquipmentLogs','action' => 'edit', $log->id], 
                        ['escape' => false, 'title' => __('Edit')]) ?>
                        <?php endif;?>
                        <?= $this->Form->postLink('<i class="fa fa-trash-o"></i>', 
                        ['controller'=>'EquipmentLogs','action' => 'delete', $log->id], 
                        ['confirm' => __('Are you sure you want to delete this note?'), 'escape' => false, 'title' => __('Delete')]) ?>
                            </div>
                    </td>
                </tr>
                <?php endforeach;?>
                <?php endif;?>
            </tbody>
            </table>
        </div>
        <div class="tab-pane" id="tab_docuemtns">
            <table class="table">
            <thead><tr>
                <th>Documents</th>
                <th>Uploaded</th>
                <th>Review Date</th>
                <th>&nbsp;</th>
            </tr></thead>
            <tbody>
                <?php if(isset($equipmentLogs['Document'])):?>
                <?php foreach($equipmentLogs['Document'] as $id => $log):?>
                <tr>
                    <td><?php if($log->file_url){
                            $icon = '<span class="file-icon-mini '.h($log->file_ext).'-mini"></span> '.
                                    h($log->file_name).' ['.
                                    $this->Number->toReadableSize($log->file_size).']';
                            echo $this->Dak->link($icon,$log->file_url,array('target'=>'_blank','escape'=>false));
                    }?></td>
                    <td><?= $log->created ?></td>
                    <td><?= $this->Dak->showDateLabel($log->alert_date) ?></td>
                    <td class='hidden-tools' style='width:80px'>
                        <div class='tools'>
                        <?php if($log->created->i18nFormat('yyyy-MM-dd') == date("Y-m-d")):?>
                        <?= $this->Html->link('<i class="fa fa-edit"></i>', 
                        ['controller'=>'EquipmentLogs','action' => 'edit', $log->id], 
                        ['escape' => false, 'title' => __('Edit')]) ?>
                        <?php endif;?>
                        <?= $this->Form->postLink('<i class="fa fa-trash-o"></i>', 
                        ['controller'=>'EquipmentLogs','action' => 'delete', $log->id], 
                        ['confirm' => __('Are you sure you want to delete this note?'), 'escape' => false, 'title' => __('Delete')]) ?>
                            </div>
                    </td>
                </tr>
                <?php endforeach;?>
                <?php endif;?>
            </tbody>
            </table>
        </div>
        <div class="tab-pane" id="tab_reminders">
            <table class="table">
            <thead><tr>
                <th>Reminder</th>
                <th>Reminder Date</th>
                <th>&nbsp;</th>
            </tr></thead>
            <tbody>
                <?php if(isset($equipmentLogs['Reminder'])):?>
                <?php foreach($equipmentLogs['Reminder'] as $id => $log):?>
                <tr>
                    <td><?= h($log->notes) ?></td>
                    <td><?= $this->Dak->showDateLabel($log->alert_date) ?></td>
                    <td class='hidden-tools' style='width:80px'>
                        <div class='tools'>
                        <?php if($log->created->i18nFormat('yyyy-MM-dd') == date("Y-m-d")):?>
                        <?= $this->Html->link('<i class="fa fa-edit"></i>', 
                        ['controller'=>'EquipmentLogs','action' => 'edit', $log->id], 
                        ['escape' => false, 'title' => __('Edit')]) ?>
                        <?php endif;?>
                        <?= $this->Form->postLink('<i class="fa fa-trash-o"></i>', 
                        ['controller'=>'EquipmentLogs','action' => 'delete', $log->id], 
                        ['confirm' => __('Are you sure you want to delete this note?'), 'escape' => false, 'title' => __('Delete')]) ?>
                            </div>
                    </td>
                </tr>
                <?php endforeach;?>
                <?php endif;?>
            </tbody>
            </table>
        </div>
    </div>
</div>

<?php endif; ?>

<script type="text/javascript"> 
//<![CDTA[

$(document).ready(function(){
    $('.relatedLookup').selectize({
        valueField: 'id',
        labelField: 'title',
        searchField: ['title','make','model','asset','serial'],
        options: [],
        loadThrottle: 600,
        create: false,
        render: {
        option: function(item, escape) {
            return '<div>' +
                '<span class="title">' +
                    '<span class="name">' + escape(item.title) + '</span>' +
                '</span>' +
                '<span class="description">Make: ' + escape(item.make) + '</span>' +
                '<span class="description">Model: ' + escape(item.model) + '</span>' +
                '<span class="description">Asset: ' + escape(item.asset) + '</span>' +
                '<span class="description">Serial: ' + escape(item.serial) + '</span>' +
            '</div>';
        }
    },
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: '<?= $this->Url->build(['action'=>'index','_ext'=>'json'])?>',
                type: 'GET',
                dataType: 'json',
                data: {
                    search: query
                }
                }).done(function(res) {
                    callback(res.equipment);
              })
              .fail(function(err) {
                    callback();
              });
        }
    });
    
});


//]]>
</script>