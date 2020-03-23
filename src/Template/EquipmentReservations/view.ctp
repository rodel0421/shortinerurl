<?php
$afterStart = ($equipmentReservation->start->format('Y-m-d H:i') < date('Y-m-d H:i'));
$beforeEnd = ($equipmentReservation->end->format('Y-m-d H:i') > date('Y-m-d H:i'));
$canEdit = ($isOwner || $isAdmin || $isOfficer);
//$beforeStart = (date("Y-m-d H:i") > $equipmentReservation->start->format('Y-m-d H:i'));
?>
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'>
        <i class="fa fa-fighter-jet" aria-hidden="true"></i> <?= h($equipmentReservation->equipment->title) ?>
        <span class='small'>
        <?php if($equipmentReservation->approved === true):?>Approved<?php elseif($equipmentReservation->approved === false):?>
                Denied<?php else:?>Pending...<?php endif;?></span>
        </h3>
    	<div class="box-tools pull-right">
    	
        <?php 
        //Allow return early per hour items
        if($canEdit && $afterStart && $beforeEnd):?>
        <?= $this->Form->create($updateReservation,[
            'class'=>'inline',
            'url'=>['action'=>'view',$equipmentReservation->id,'back'=>$referer]
            ])?>
        <?php 
        
        if($equipmentReservation->all_day){
            echo $this->Form->hidden('end',['value'=>date("Y-m-d")]);
            echo $this->Form->hidden('all_day',['value'=>'1']);
        }else{
            echo $this->Form->hidden('end',['value'=>date("Y-m-d H:00")]);
            echo $this->Form->hidden('all_day',['value'=>'0']);
        }
        ?>
        <?= $this->Form->button(__('Return Now'), ['bootstrap-type' => 'success',
            'confirm' => __('I have returned this equipment early.')
            ])?>
        <?= $this->Form->end() ?>
        <?php endif;?>
            
        <?php 
        if($canEdit):?>
        <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') 
                        . '</span>', [
                            'controller' => 'EquipmentReservations', 'action' => 'edit', $equipmentReservation->id
                            ,'back'=>$referer], 
                        ['escape' => false, 'class' => 'btn btn-warning btnPreview', 'title' => __('Edit')]) ?>
        <?php endif;?>
    	<?php 
        //All edit if before the end date.
        if(($canEdit && $beforeEnd) || ($isAdmin || $isOfficer)):?>
        
        <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Cancel') 
                        . '</span>', ['controller' => 'EquipmentReservations', 'action' => 'delete', $equipmentReservation->id,'back'=>$referer], 
                        ['confirm' => __('Are you sure you want to cancel this equipment reservation?'), 'escape' => false, 
                                        'class' => 'btn btn-danger', 'title' => __('Cancel')]) ?>
        <?php endif;?>
      </div>
    </div>
    <div class='box-body'>
        <dl class="dl-horizontal">
            
            <dt><?= __('Equipment') ?></dt>
            <dd><?= $equipmentReservation->has('equipment') ? $this->Html->link($equipmentReservation->equipment->title, ['controller' => 'Equipment', 'action' => 'view', $equipmentReservation->equipment->id]) : '' ?></dd>
            <dt><?= __('User') ?></dt>
            <dd><?= $equipmentReservation->has('user') ? h($equipmentReservation->user->name) : '' ?></dd>
            <?php if($isAdmin):?>
            <dt><?= __('Type') ?></dt>
            <dd>
                <?php if($equipmentReservation->table):?>
                <?= $this->Html->link(h($equipmentReservation->type).'#'.$equipmentReservation->tableid, 
                        ['controller' => $equipmentReservation->table , 'action' => 'view', $equipmentReservation->tableid])?>
                <?php else:?>
                    <?= h($equipmentReservation->type)?>
                <?php endif;?>
            </dd>
            <?php endif;?>
            <dt><?= __('Start') ?></dt>
            <dd>
                <?= ($equipmentReservation->all_day)?h($equipmentReservation->start->i18nFormat('dd/MM/YYYY')):h($equipmentReservation->start->format('d/m/Y h:i A'))?>
            </dd>
            <dt><?= __('End') ?></dt>
            <dd>
                <?= ($equipmentReservation->all_day)?h($equipmentReservation->end->i18nFormat('dd/MM/YYYY')):h($equipmentReservation->end->format('d/m/Y h:i A'))?>
                
            </dd>
            <dt><?= __('QTY') ?></dt>
            <dd>
                <?= h($equipmentReservation->qty) ?>
            </dd>
            <dt><?= __('Status') ?></dt>
            <dd>
                <div class='row msg-parent'>
                <?php if($isOfficer || $isAdmin):?>
                <div class='col-md-6'>
                    <?php 
                    $options = ['options'=>['0'=>'Not Approved','1'=>'Approved'],
                        'class'=>'update',
                        'data-url'=> $this->Url->build(['controller'=>'EquipmentReservations','action'=>'update'], ['fullBase' => true]),
                        'default'=>$equipmentReservation->approved,
                        'type'=>'select',
                        'label'=>false];
                    
                    if(!isset($equipmentReservation->approved)){
                        $options['empty']='Pending...';
                    }
                    ?>
                <?= $this->Form->input($equipmentReservation->id.'.approved',$options)?></div>
                
                <div class='msg col-md-1'>
                    
                </div>
                </div>
                <div class='row msg-parent'>
                    <div class='col-md-6'><?php 
                    if($afterStart){
                        $options = ['options'=>['0'=>'Not Returned','1'=>'Returned'],
                            'class'=>'update',
                            'data-url'=> $this->Url->build(['controller'=>'EquipmentReservations','action'=>'update'], ['fullBase' => true]),
                            'default'=>$equipmentReservation->returned,
                            'type'=>'select',
                            'label'=>false];
                        echo $this->Form->input($equipmentReservation->id.'.returned',$options);
                    }
                        ?></div>
                    <div class='msg col-md-6'></div>
                </div>
                <?php else:?>
                <?php if($equipmentReservation->approved === true):?>Approved<?php elseif($equipmentReservation->approved === false):?>
                Not Approved<?php else:?>Pending...<?php endif;?><br/>
                <?php if($afterStart):?>
                <?= ($equipmentReservation->returned)?'Returned':'Not Returned' ;?>
                <?php endif;?>
                <?php endif;?>
            </dd>
        </dl>
   
    <dl class="dl-horizontal">
       <dt><?= __('Notes') ?></dt>
       <dd><?= $this->Text->autoParagraph(h($equipmentReservation->notes)); ?></dd>
    </dl>
</div>
<div class='box-footer'>
    <?php $footerHtml = '';?>
    <?php 
            $footerHtml .= "<b>". __('Created') .":</b> ";
            $footerHtml .= h($equipmentReservation->created)." ";
            ?>
            <?php 
            $footerHtml .= "<b>". __('Modified') .":</b> ";
            $footerHtml .= h($equipmentReservation->modified)." ";
            ?>
    <?= $footerHtml ?>
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