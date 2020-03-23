<?php if(!$isAjax):?>
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Edit Reservation') ?></h3>
    	<div class="box-tools pull-right">
    	<?php $referer = ($this->request->query('back'))?$this->request->query('back'): ['controller'=>'EquipmentReservations','action' => 'view',$equipmentReservation->id]; ?>
    	<?= $this->Html->link('Back', $referer, 
        ['escape' => false, 'class' => 'btn btn-default', 'title' => __('Back')]) ?>
          	
      </div>
    </div>
    <div class='box-body'>
<?php endif;?>
    <?= $this->Form->create($editEquipmentReservation);

        $used = 0;
        $pending = 0;
        $beforeEnd = ($equipmentReservation->end->format('Y-m-d H:i') > date('Y-m-d H:i'));

        if(isset($avaiability[$equipmentReservation->equipment_id])){

            foreach($avaiability[$equipmentReservation->equipment_id] as $date => $data){
                if($data['num_approved'] > $used) $used = (int)$data['num_approved'];
                if($data['pending'] > $pending) $pending = (int)$data['pending'];
            }
        }

        $free = $equipmentReservation->equipment->qty - $used;
        $maybe_free = $free - $pending;   
?>
        <dl class="dl-horizontal">
            <dt><?= __('Equipment') ?></dt>
            <dd><?= $equipmentReservation->has('equipment') ? h($equipmentReservation->equipment->title) : '' ?></dd>
            <dt><?= __('Date Reserved') ?></dt>
            <dd>
                From 
                <?= ($equipmentReservation->all_day)?h($equipmentReservation->start->i18nFormat('dd/MM/YYYY')):h($equipmentReservation->start->format('d/m/Y h:i A'))?>
                 To 
                 <?= ($equipmentReservation->all_day)?h($equipmentReservation->end->i18nFormat('dd/MM/YYYY')):h($equipmentReservation->end->format('d/m/Y h:i A'))?>
            </dd>
            <?php if($beforeEnd):?>
            <dd>
                <p>
                You can change the date to a later pickup or an earlier drop off but you cannot extend the booking from here. 
                If you want to extend the booking you must first delete this booking and create a new one.</p>
            <?php if($equipmentReservation->all_day):?>
                
                
                <div class="col-sm-4"><?= $this->Form->input('start_date',['label'=>'Pickup','type'=>'text','class'=>'datepicker ajax-search','default'=>$start_date])?></div>
                <div class="col-sm-4"><?= $this->Form->input('end_date',['label'=>'Return','type'=>'text','class'=>'datepicker ajax-search','default'=>$end_date])?></div>
                <?= $this->Form->hidden('all_day',['value'=>'1'])?>
            <?php else:?>        
                    
            <?= $this->Form->hidden('all_day',['value'=>'0'])?> 
            <div class="col-sm-3"><?= $this->Form->input('start_date',['label'=>'Pickup Date','type'=>'text','class'=>'datepicker ajax-search','default'=>$start_date])?></div>
                <div class="col-sm-2">
                        <?= $this->Form->input('start_time',[
                            'options'=>$times,
                            'empty'=>'Select Time',
                            'default'=>$start_time,
                            'label'=>'Time',
                            'class'=>'datepicker ajax-search'])?></div>
                <div class="col-sm-3">
                        <?= $this->Form->input('end_date',['label'=>'Return Date','type'=>'text','class'=>'datepicker ajax-search','default'=>$end_date])?></div>
                <div class="col-sm-2">
                        <?= $this->Form->input('end_time',[
                            'label'=>'Time',
                            'empty'=>'Select Time',
                            'default'=>$end_time,
                            'options'=>$times,
                            'class'=>'datepicker ajax-search'])?></div>        
            <?php endif;?>
            </dd>
            <?php endif;?>
            
            <dt><?= __('Total QTY') ?></dt>
            <dd><?= $equipmentReservation->equipment->qty ?></dd>
            <dt><?= __('Available') ?></dt>
            <dd><?php if($used > 0):?><span class='label label-info' title='Confirmed Reservations'><?= $used?></span><?php endif;?>
            <?php if($pending > 0):?>
                <span class='label label-warning' title='Pending Reservations'><?= $pending?></span>
                <?php 
                endif;
                if($maybe_free > 0):?>
                <span class='label label-success' title='Avaiable'><?= $maybe_free?></span>
                <?php else:?>
                <span class='label label-danger' title='Avaiable'><?= $maybe_free?></span>
            <?php endif;?>
            </dd>
        </dl>
        <?php 
        //not yet approved allow number to change.
        if($maybe_free > 0 && $equipmentReservation->approved === null && $beforeEnd){
            $max = $maybe_free + $equipmentReservation->qty;//Allow reserve more
            echo $this->Form->input('qty',['min'=>1,'max'=>$max,'label'=>'Reserve #']);
            
        }else{
            echo 'Cannot make changes to booking qty';
        }
        ?>
        
        <?= $this->Form->input('notes');?>
        
        <?= $this->Form->button(__('Submit'), ['bootstrap-type' => 'success']);?>
    
    <?= $this->Form->end() ?>
<?php if(!$isAjax):?>
</div>
</div>
<?php endif;?>