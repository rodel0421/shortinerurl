<div class='box'>
    <div class='box-header'>
        <h3 class='box-title'><i class="fa fa-fighter-jet" aria-hidden="true"></i> <?= $this->request->query('archived')?'Deleted':''?> Equipment Logs</h3>
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
        <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('Equipment.title') ?></th>
                <th><?= $this->Paginator->sort('Equipment.equipment_type_id') ?></th>
                <th><?= $this->Paginator->sort('Equipment.department_id') ?></th>
                <th><?= $this->Paginator->sort('type') ?></th>
                <th><?= $this->Paginator->sort('file_url','File') ?></th>
                <th><?= $this->Paginator->sort('notes') ?></th>
                <th><?= $this->Paginator->sort('alert_date') ?></th>
                <th><?= $this->Paginator->sort('cost') ?></th>
            </tr>
            <tr>
              <th><?= 
                 $this->Form->input('Equipment.title',array(
                    'class'=>'search', 'label' => false,
                    'style'=>'width:150px;',
                    'div' => false, 'required'=>false,
                    'type'=>'text'
                    ))?></th>
              <th><?= 
                 $this->Form->input('Equipment.equipment_type_id',array(
                    'class'=>'search', 'label' => false,
                    'style'=>'width:150px;',
                    'div' => false, 'required'=>false,
                    'options'=>$equipmentTypes,'empty'=>true
                    ))?></th>
              <th><?= 
                 $this->Form->input('Equipment.department_id',array(
                    'class'=>'search', 'label' => false,
                    'style'=>'width:150px;',
                    'div' => false, 'required'=>false,
                    'options'=>$departments,'empty'=>true
                    ))?></th>
              <th><?= 
                 $this->Form->input('EquipmentLogs.type',array(
                    'class'=>'search', 'label' => false,
                    'style'=>'width:150px;',
                    'div' => false, 'required'=>false,
                    'options'=>[
                        'Document'=>'Document',
                        'Note'=>'Note',
                        'Reminder'=>'Reminder',
                        'Service'=>'Service'
                        ],'empty'=>true
                    ))?></th>
              <th>&nbsp;</th>
              <th><?= 
                 $this->Form->input('EquipmentLogs.notes',array(
                    'class'=>'search', 'label' => false,
                    'style'=>'width:150px;',
                    'div' => false, 'required'=>false,
                    'type'=>'text'
                    ))?></th>
              <th><?= 
                 $this->Form->input('date_filter',array(
                    'class'=>'search', 'label' => false,
                    'style'=>'width:150px;',
                    'div' => false, 'required'=>false,
                    'options'=>[
                        '0'=>'Expired',
                        '30'=>'Expiring next 30 Days',
                        '60'=>'Expiring next 60 Days',
                        '365'=>'Expiring next 12 Months'
                        ],'empty'=>true
                    ))?></th>
              <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($equipmentLogs as $equipmentLog): ?>
            <tr data-id="<?= $equipmentLog->id?>">
                <td><?= h($equipmentLog->equipment->title) ?></td>
                <td>
                    <?= $equipmentLog->equipment->has('equipment_type') ? $equipmentLog->equipment->equipment_type->title : '' ?>
                </td>
                <td>
                    <?= $equipmentLog->equipment->has('department') ? $equipmentLog->equipment->department->name : '' ?>
                </td>
              <td><?= $equipmentLog->type?></td>
              <td><?php if($equipmentLog->file_url){
        $icon = '<span class="file-icon-mini '.h($equipmentLog->file_ext).'-mini"></span> '.
                h($equipmentLog->file_name).' ['.
                $this->Number->toReadableSize($equipmentLog->file_size).']';
        echo $this->Dak->link($icon,$equipmentLog->file_url,array('target'=>'_blank','escape'=>false));
    }?></td>
              <td><?= ($equipmentLog->type == 'Reminder') ? h($equipmentLog->notes) :'' ?></td>
              <td><?= $this->Dak->showDateLabel($equipmentLog->alert_date) ?>&nbsp;</td>
              <td><?= $equipmentLog->cost?$this->Number->currency($equipmentLog->cost):''?>&nbsp;</td>
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