<div class='box'>

<!-- 
<#?php 
dump($userTestSelect);
foreach ($userTestSelect as  $value) {
    dump($value->user_id); 
        
}
exit; ?> -->
<!-- <#?php dump($userTestSelect); exit; ?> -->
    <div class='box-header'>
        <h3 class='box-title'><i class="fa fa-fighter-jet" aria-hidden="true"></i> <?= $this->request->query('archived')?'Deleted':''?> Equipment</h3>
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
                <th><?= $this->Paginator->sort('title') ?></th>
                <th><?= $this->Paginator->sort('equipment_type_id') ?></th>
                <th><?= $this->Paginator->sort('department_id') ?></th>
                <th><?= $this->Paginator->sort('asset') ?></th>
                <th><?= $this->Paginator->sort('make') ?></th>
                <th><?= $this->Paginator->sort('next_service') ?></th>
                <th><?= $this->Paginator->sort('next_alert') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
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
                 $this->Form->input('Equipment.asset',array(
                    'class'=>'search', 'label' => false,
                    'style'=>'width:150px;',
                    'div' => false, 'required'=>false,
                    'type'=>'text'
                    ))?></th>
              <th><?= 
                 $this->Form->input('Equipment.make',array(
                    'class'=>'search', 'label' => false,
                    'style'=>'width:150px;',
                    'div' => false, 'required'=>false,
                    'type'=>'text'
                    ))?></th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($equipment as $value): ?>
           
            <tr data-id="<?= $value->id?>">
              <!-- <#?php dump($value->user_id);  exit; ?> -->
                <td><?= h($equipment->title) ?></td>
                <td>
                    <?= $equipment->has('equipment_type') ? $equipment->equipment_type->title : '' ?>
                </td>
                <td>
                    <?= $equipment->has('department') ? $equipment->department->name : '' ?>
                </td>
                <td><?= h($equipment->asset) ?></td>
                <td><?= h($equipment->make) ?></td>
                <td><?php if($equipment->status>0):?><i class="fa fa-circle status_<?= $equipment->status ?>"></i><?php endif;?> <?= h($equipment->next_service) ?></td>
                <td><?php if($equipment->alert_status>0):?><i class="fa fa-circle status_<?= $equipment->alert_status ?>"></i><?php endif;?> <?= h($equipment->next_alert) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span><span class="sr-only">' .
                            __('View') . '</span>', 
                    ['action' => 'view', $equipment->id], 
                ['escape' => false, 'class' => 'btn btn-xs btn-success', 'title' => __('View')]) ?>
                    
                <?php if(!$equipment->active):?>
                    <?= $this->Form->postLink('<span class="fa fa-undo"></span><span class="sr-only">' . __('Restore') 
                        . '</span>', ['action' => 'delete', $equipment->id], 
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