<?php $this->assign('title', 'Equipment Reservations');
$userview = $this->request->query('userview');
?>
<div class='box'>
    <div class='box-header'><h3 class='box-title'>
        <i class="fa fa-fighter-jet" aria-hidden="true"></i> Equipment Reservations <?= $this->request->query('archived')?'History':''?></h3>
    	<div class="box-tools pull-right">
    	<div class="btn-group">
            <?php if(!$userview):?>
        <?= $this->Html->link('<i class="fa fa-plus" aria-hidden="true"></i>', 
            ['action' => 'add','back'=>$this->request->here],['escape'=>false,'class'=>'btn btn-default','title'=>'Add']) ?>
        <?php endif;?>
        <?php if($this->request->query('archived')){
            echo $this->Form->hidden('archived',['value'=>1,'class'=>'search','id'=>'archived']);
            echo $this->Html->link('<i class="fa fa fa-bars" aria-hidden="true"></i>', 
                ['action' => 'index'],['escape'=>false,'class'=>'btn btn-default','title'=>'Show All']);
        }else{
            echo $this->Html->link('<i class="fa fa-history" aria-hidden="true"></i>', 
                ['action' => 'index','archived'=>1],['escape'=>false,'class'=>'btn btn-default','title'=>'Show History']);
        }?>
            <?php if($isAdmin || $isOfficer):?>
            <?= $this->Html->link('<i class="fa fa-file-excel-o"></i>', array_merge(['action'=>'export'],$this->request->query),['escape'=>false,'class'=>'btn btn-default']) ?>
            <?php endif;?>
      </div>
      </div>
    </div>
    <div class='box-body'>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('start') ?></th>
                <th><?= $this->Paginator->sort('end') ?></th>
                <th>Trip</th>
                <th><?= $this->Paginator->sort('Equipment.equipment_type_id','Type') ?></th>
                <th><?= $this->Paginator->sort('Equipment.department_id','Department') ?></th>
                <th><?= $this->Paginator->sort('equipment_id') ?></th>
                <th><?= $this->Paginator->sort('qty') ?></th>
                <?php if(!$userview):?>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <?php endif;?>
                <th><?= $this->Paginator->sort('approved') ?></th>
                <th><?= $this->Paginator->sort('returned') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <tr>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
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
                 $this->Form->input('Equipment.title',array(
                    'class'=>'search', 'label' => false,
                    'div' => false, 
                    'required'=>false,
                    'type'=>'text'
                    ))?></th>
                <th>&nbsp;</th>
                <?php if(!$userview):?>
                <th><?= 
                 $this->Form->input('Users.name',array(
                    'class'=>'search', 'label' => false,
                    'div' => false, 
                    'required'=>false,
                    'type'=>'text'
                    ))?></th>
                <?php endif;?>
                <th><?= 
                 $this->Form->input('EquipmentReservations.approved',array(
                    'class'=>'search', 'label' => false,
                    'style'=>'width:150px;',
                    'div' => false, 'required'=>false,
                    'options'=>['1'=>'Approved','0'=>'Not Approved','isnull'=>'Pending'],'empty'=>true
                    ))?></th>
                <th><?= 
                 $this->Form->input('EquipmentReservations.returned',array(
                    'class'=>'search', 'label' => false,
                    'style'=>'width:150px;',
                    'div' => false, 'required'=>false,
                    'options'=>['1'=>'Returned','0'=>'Not Returned'],'empty'=>true
                    ))?></th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($equipmentReservations as $equipmentReservation): 
            $afterStart = ($equipmentReservation->start->format('Y-m-d H:i') < date('Y-m-d H:i'));
            $afterEnd = ($equipmentReservation->end->format('Y-m-d H:i') < date('Y-m-d H:i'));
            ?>
            <tr data-id="<?= $equipmentReservation->id?>">
                
                <td><?= h($equipmentReservation->start)?></td>
                <td><?= h($equipmentReservation->end)?></td>
                <td><?php 
                if($equipmentReservation->has('trip')):
                    $label = isset($status_classes[$equipmentReservation->trip->status])?$status_classes[$equipmentReservation->trip->status]:'label label-primary'; ?>
                    <a href="<?= $this->Url->build(['controller'=>'Trips','action'=>'view',$equipmentReservation->tableid])?>">
                        <span class="<?= $label ?>" title="<?= h($equipmentReservation->trip->status)?>"><?= h($equipmentReservation->tableid) ?></span></a>
                <?php endif;?>&nbsp;</td>
                <td><?= h($equipmentReservation->equipment->equipment_type->title)?></td>
                <td><?= $equipmentReservation->equipment->has('department') ? h($equipmentReservation->equipment->department->name) : '&nbsp;'?></td>
                <td><?= h($equipmentReservation->equipment->title)?></td>
                <td><?= h($equipmentReservation->qty)?></td>
                <?php if(!$userview):?>
                <td><?= h($equipmentReservation->user->name)?></td>
                <?php endif;?>
                <td>
                    <?php if(($equipmentReservation->approved !== true) && ($isOfficer || $isAdmin) && !$userview):?>
                    <div class='row msg-parent'>
                    <div class='col-xs-10'>
                    <?php 
                    $options = ['options'=>[
                        '0'=>'Not Approved','1'=>'Approved'],
                        'class'=>'update',
                        'data-url'=> $this->Url->build(['controller'=>'EquipmentReservations','action'=>'update']),
                        'default'=>$equipmentReservation->approved,
                        'type'=>'select',
                        'label'=>false];
                    
                    if(!isset($equipmentReservation->approved)){
                        $options['empty']='Pending...';
                    }
                    ?>
                    <?= $this->Form->input($equipmentReservation->id.'.approved',$options)?></div>
                    <div class='msg col-xs-2'></div>
                    </div>
                    <?php else:?>
                    <?php if($equipmentReservation->approved === true):?>Approved<?php elseif($equipmentReservation->approved === false):?>
                    Not Approved<?php else:?>Pending...<?php endif;?>
                    <?php endif;?></td>
                <td>
                <?php if($afterStart && ($isOfficer || $isAdmin) && !$userview):?>
                <div class='row msg-parent'>
                    <div class='col-xs-10'><?php 
                    if($afterStart){
                        $options = ['options'=>['0'=>'Not Returned','1'=>'Returned'],
                            'class'=>'update',
                            'data-url'=> $this->Url->build(['controller'=>'EquipmentReservations','action'=>'update']),
                            'default'=>$equipmentReservation->returned,
                            'type'=>'select',
                            'label'=>false];
                        echo $this->Form->input($equipmentReservation->id.'.returned',$options);
                    }
                        ?></div>
                    <div class='msg col-xs-2'></div>
                </div>
                <?php else:?>
                <?= ($equipmentReservation->returned)?'Yes':'No' ?>
                <?php endif;?>
                    
                    
                </td>
                <td class="actions">
                    <?php 
                    if($afterEnd && !$equipmentReservation->returned && $equipmentReservation->approved === true && ($isOfficer || $isAdmin) ):?>
                    <?= $this->Html->link('<span class="fa fa-envelope-o"></span><span class="sr-only">' . __('Send Reminder') . '</span>', 
                        ['controller' => 'EquipmentReservations', 'action' => 'view', $equipmentReservation->id,'sendOverdue'=>'1'], 
                        ['escape' => false, 'class' => 'btn btn-xs btn-warning', 'title' => __('Send Reminder')]) ?>
                    <?php endif;?>
                    
                    <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', 
                        ['controller' => 'EquipmentReservations', 'action' => 'view', $equipmentReservation->id,
                        'back' => $this->Url->build(['controller'=>'EquipmentReservations','action'=>'index'], ['fullBase' => true])], 
                 		['escape' => false, 'class' => 'btn btn-xs btn-success btnPreview', 'title' => __('View')]) ?>
                
                    <?php if($equipmentReservation->start->format('Y-m-d H:i') > date('Y-m-d H:i')):?>
                    <?php if($equipmentReservation->approved === null ):?>
                    <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') 
                                    . '</span>', ['controller' => 'EquipmentReservations', 'action' => 'edit', $equipmentReservation->id,
                                        'back' => $this->Url->build(['controller'=>'EquipmentReservations','action'=>'index'], ['fullBase' => true])], 
                                    ['escape' => false, 'class' => 'btn btn-xs btn-warning btnPreview', 'title' => __('Edit')]) ?>
                    <?php endif;?>
                    <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Cancel') 
                                    . '</span>', [
                                        'controller' => 'EquipmentReservations', 'action' => 'delete', $equipmentReservation->id,
                                        'back' => $this->Url->build(['controller'=>'EquipmentReservations','action'=>'index'], ['fullBase' => true])
                                        ], 
                                    ['confirm' => __('Are you sure you want to cancel this equipment reservation?'), 'escape' => false, 
                                                    'class' => 'btn btn-xs btn-danger', 'title' => __('Cancel')]) ?>
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
<script type='text/javascript'>
//<![CDTA[
$(document).ready(function(){
    var $tk = '<?= $this->request->param('_csrfToken')?>';
    
    $('.update').change(function(){
        $name = $(this).attr('name');
        $url = $(this).attr('data-url');
        if($(this).is(':checkbox') && !$(this).is(':checked')){
            $data = $("[name='"+$name+"']").first().serializeArray();
        }else{
            $data = $(this).serializeArray();
        }
        
        var $this_msg = $(this).closest('.msg-parent').find('.msg');
        $this_msg.html('<i class="fa fa-refresh fa-spin"></i>');
        
        if(!$url){
            $this_msg.html('<span class="status"><i class="fa fa-times"></i></span>');
            setTimeout(function(){$this_msg.empty()},5000);
            return;
        }
        
        if($data){
            $data.push({name: "_csrfToken", value: $tk});
            $.post(
                $url,
                $.param($data),
                function(data){
                    $this_msg.html(data);
                    setTimeout(function(){$this_msg.empty()},5000);
                }
                );
        }else{
            $this_msg.html('<span class="status"><i class="fa fa-times"></i></span>');
            setTimeout(function(){$this_msg.empty()},5000);
        }
    });
    
});
//]]>
</script>