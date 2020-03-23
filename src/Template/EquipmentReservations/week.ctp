<?php $this->assign('title', 'Equipment Reservations - Week View');?>
<div class='box'>
    <div class='box-header'>
        <h3 class='box-title'><i class="fa fa-fighter-jet" aria-hidden="true"></i> Equipment Reservations - Week View</h3>
    	<div class="box-tools pull-right">
    	<div class="btn-group">
        <?= $this->Html->link('<i class="fa fa-plus" aria-hidden="true"></i>', 
            ['action' => 'add','back'=>$this->request->here],['escape'=>false,'class'=>'btn btn-default','title'=>'Add']) ?>
        
      </div>
      </div>
    </div>
    <div class='box-body'>
        <div class='row'>
            <div class='col-md-4'><?=$this->Html->link('Prev',['action'=>'week','date'=>date('Y-m-d',strtotime('- 1 week',$datetime))])?></div>
            <div class='col-md-4'></div>
            <div class='col-md-4'><?= $this->Html->link('Next',['action'=>'week','date'=>date('Y-m-d',strtotime('+ 1 week',$datetime))])?></div>
        </div>
        <table class='table'>
            <thead>
                <tr>
                    <th>Day</th>
                    <th>Equipment</th>
                    <th>Who</th>
                    <th>QTY</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($events as $event):?>
                <tr class='msg-parent'>
                    <td><?= h($event->start)?></td>
                    <td><?= h($event->equipment->title)?></td>
                    <td><?= h($event->user->name)?></td>
                    <td><?= h($event->qty) ?></td>
                    <td><?php if($isOfficer || $isAdmin):?>
                <div class='col-md-6'>
                    <?php 
                    $options = ['options'=>['0'=>'Not Approved','1'=>'Approved'],
                        'class'=>'update',
                        'data-url'=> $this->Url->build(['controller'=>'EquipmentReservations','action'=>'update']),
                        'default'=>$event->approved,
                        'type'=>'select',
                        'label'=>false];
                    
                    if(!isset($event->approved)){
                        $options['empty']='Pending...';
                    }
                    ?>
                <?= $this->Form->input($event->id.'.approved',$options)?></div>
                <div class='msg col-md-6'></div>
                <?php else:?>
                <?php if($event->approved === true):?>Approved<?php elseif($event->approved === false):?>
                Not Approved<?php else:?>Pending...<?php endif;?>
                
                <?php endif;?></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <div class='box-footer'>
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