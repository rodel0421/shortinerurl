<?php 
$hourly_booking = ($equipment_type && $equipment_type->hourly_booking);

if($hourly_booking){
    $timeString = ' From '.date('d/m/Y h:i A', strtotime($start)). ' To '. date('d/m/Y h:i A',strtotime($end));
}else{
    $timeString = ' From '.date('d/m/Y',strtotime($start)). ' To '. date('d/m/Y',strtotime($end));
}

?>
<?php if(!$isAjax):?>
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Reserve Equipment') ?> From <?= h($trip->start_date) ?> To <?= h($trip->end_date) ?></h3>
    	<div class="box-tools pull-right">
    	
    	<?= $this->Html->link('Back', ['controller'=>'Trips','action' => 'view',$trip->id], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('Back')]) ?>
            
      </div>
    </div>
    <div class='box-body'>
<?php endif;?>
        
        <div id='EquipmentPageinate'>
            <div class="row">
                <div class="col-sm-2"><?= 
                 $this->Form->input('Equipment.equipment_type_id',array(
                    'class'=>'ajax-search', 
                     'empty'=>'(Select Type)',
                    'div' => false, 'required'=>false,
                    'options'=>$equipmentTypes
                    ))?></div>
                <?php if($hourly_booking):?>
                <div class="col-sm-3"><?= $this->Form->input('start_date',['label'=>'Pickup Date','type'=>'text','class'=>'datepicker ajax-search','default'=>$start_date])?></div>
                <div class="col-sm-2">
                        <?= $this->Form->input('start_time',['options'=>$times,'empty'=>'Select Time','label'=>'Time','class'=>'datepicker ajax-search'])?></div>
                <div class="col-sm-3">
                        <?= $this->Form->input('end_date',['label'=>'Return Date','type'=>'text','class'=>'datepicker ajax-search','default'=>$end_date])?></div>
                <div class="col-sm-2">
                        <?= $this->Form->input('end_time',['label'=>'Time','empty'=>'Select Time','options'=>$times,'class'=>'datepicker ajax-search'])?></div>
                <?php else:?>
                <div class="col-sm-4"><?= $this->Form->input('start_date',['label'=>'Pickup','type'=>'text','class'=>'datepicker ajax-search','default'=>$start_date])?></div>
                <div class="col-sm-4"><?= $this->Form->input('end_date',['label'=>'Return','type'=>'text','class'=>'datepicker ajax-search','default'=>$end_date])?></div>
                <?php endif;?>
            </div>
            <?php if(isset($equipment)):?>
        <table class="table table-striped table-hover">
        <thead class='ajax-paginator'>
            <tr>
                <th><?= $this->Paginator->sort('title') ?></th>
                <th><?= $this->Paginator->sort('department_id') ?></th>
                <th><?= $this->Paginator->sort('qty') ?></th>
                <th><?= __('Available') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <tr>
              <th><?= 
                 $this->Form->input('Equipment.title',array(
                    'class'=>'ajax-search', 'label' => false,
                    'style'=>'width:150px;',
                    'div' => false, 'required'=>false,
                    'type'=>'text'
                    ))?></th>
              <th><?= 
                 $this->Form->input('Equipment.department_id',array(
                    'class'=>'ajax-search', 'label' => false,
                    'style'=>'width:150px;',
                    'div' => false, 'required'=>false,
                    'options'=>$departments,'empty'=>true
                    ))?></th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($equipment as $equipment): ?>
            <tr data-id="<?= $equipment->id?>">
              
                <td><?= h($equipment->title) ?></td>
                <td><?= $equipment->has('department') ? $equipment->department->name : '' ?></td>
                <td><?= h($equipment->qty) ?></td>
                <td><?php 
                $used = 0;
                $pending = 0;
                
                if(isset($avaiability[$equipment->id])){
                    
                    foreach($avaiability[$equipment->id] as $date => $data){
                        if($data['num_approved'] > $used) $used = (int)$data['num_approved'];
                        if($data['pending'] > $pending) $pending = (int)$data['pending'];
                    }
                }
                
                $free = $equipment->qty - $used;
                $maybe_free = $free - $pending;
                
                if(isset($avaiability['ERROR'])):?>
                <span class='label label-danger' title='<?= $avaiability['ERROR']?>'><?= $avaiability['ERROR']?></span>
                <?php
                else:
                if($used > 0):?>
                    <span class='label label-info' title='Confirmed Reservations'><?= $used?></span>
                <?php 
                endif;
                if($pending > 0):?>
                <span class='label label-warning' title='Pending Reservations'><?= $pending?></span>
                <?php 
                endif;
                if($maybe_free > 0):?>
                <span class='label label-success' title='Available'><?= $maybe_free?></span>
                <?php else:?>
                <span class='label label-danger' title='None Available'><?= $maybe_free?></span>
                <?php endif;?>
                <?php endif;?>
                </td>
                <td class="actions">
                    <?php 
                    if($maybe_free > 0):?>
                    <?php echo $this->Form->create($equipmentReservation,
                        ['data-confirm'=>'Reserve '.h($equipment->title).$timeString,
                            'class'=>'inline','id'=>'bookingForm']); ?>
                    <?php echo $this->Form->hidden('equipment_id',['value'=>$equipment->id]); ?>
                    <?php if($equipment->qty == 1):?>
                    <?php echo $this->Form->hidden('qty',['value'=>1]); ?>
                    
                        <?= $this->Form->button(__('Book'), ['bootstrap-type' => 'success','bootstrap-size'=>'sm']) ?>
                    
                    <?php else:?>
                    <div class="input-group input-group-sm">
                    <?php
                        echo $this->Form->input('qty',[
                            'value'=>1,
                            'min'=>1,
                            'max'=>$maybe_free,
                            'templates'=>[
                                'inputContainer' => '{{content}}'
                            ],'type'=>'number',
                            'label'=>false,'div'=>false]);
                        
                    ?>
                    <span class="input-group-btn">
                      <?= $this->Form->button(__('Book'), ['bootstrap-type' => 'success']) ?>
                    </span>
                    </div>
                    <?php endif;?>
                    <?= $this->Form->end()?>
                    <?php endif;?>
                </td>
            </tr>

        <?php endforeach; ?>
        </tbody>
        </table>
            <b>Availability Colour Index: </b>
            <span class='label label-info' title='Confirmed Reservations'>Number of Confirmed Reservations</span>
            <span class='label label-warning' title='Pending Reservations'>Number of Pending Reservations</span>
            <span class='label label-success' title='Available'>Number Available</span>
            <span class='label label-danger' title='None Available'>None Available</span>
        <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
        
        <?php else:?>
        
        <?php endif;?>
    </div>
    </div>
<?php if(!$isAjax):?>
</div>
</div>
<?php endif;?>

<script type="text/javascript"> 
//<![CDTA[

$(document).ready(function(){
    
    $(document).off('submit','#bookingForm');
    $(document).on('submit', '#bookingForm', function(){
        $title = $(this).data('confirm');
        if(!$title) $title = 'Create booking?';
        
        if(!confirm($title)) return false;
    });
    
    $(document).off('click','.pagination a');
    $(document).off('click','thead.ajax-paginator a');
    
    $(document).on('click', '.pagination a', ajax_pagination_click);
    $(document).on('click', 'thead.ajax-paginator a', ajax_pagination_click);
    
    $(document).off('change','.ajax-search');
    $(document).on('change', '.ajax-search', function(){
        url = "<?php echo $this->Url->build(array('action'=>'add-trip',$trip->id,'?'=>['filter'=>'1'])); ?>";
        $('.ajax-search').each(function(){
                var $this_id = "#"+$(this).attr('id');

        if($(this).is(':checkbox') && !$(this).is(':checked')){
            $this_id = "#"+$(this).attr('id')+"_";
        }

        if($($this_id).val()){
            url += "&"+ $(this).attr('name') +"="+$($this_id).val();
        }
        });
        ajax_load_this(url);
    });
    
    $(document).off('keypress','.ajax-search');
    $(document).on('keypress', '.ajax-search', function(e){
        if ((e.keyCode || e.which) == 13) {
                $(this).trigger('change');
            }
    });
});

function ajax_pagination_click(){
    ajax_load_this($(this).attr('href'));
    return false;
}

function ajax_load_this(target){
    
    if(!target) return false;
    //console.log('ajax_load_this',target);
    $( "#EquipmentPageinate" ).load(target);
    //window.location = target;
    /*$.get(target, function(data) {
        var div = $('#EquipmentPageinate', $(data)).html();
            $('#EquipmentPageinate').html( div );
        }, 'html');*/
}

//]]>
</script>