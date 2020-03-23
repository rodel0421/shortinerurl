Dear <?= $booking->has('supervisor_user')? $booking->supervisor_user->given_name : h($booking->supervisor) ?>,<br />
<?php if(isset($booking->supervisor_check)):?>
<p><strong>Note:</strong>This booking has been updated.</p> 
<?php endif;?>
<p>
As the delegated supervisor of this upcoming booking, 
do you authorise this activity, and are you confident that persons involved are competent to undertake the tasks?</p>

<h2 style='color:green;display:inline;'><?php 
echo $this->Html->link('Open to authorise or not authorise booking',
    ['controller'=>'Bookings','action'=>'view', 
    $booking->id,'key'=> $booking->key,'_full' => true], 
    array('target'=>'blank')); ?></h2>

<dl>
    <dt><?php echo __('Leader'); ?></dt>
    <dd><?= $booking->has('user') ? h($booking->user->name) : '' ?>&nbsp;</dd>    
    <dt><?php echo __('Status'); ?></dt>
    <dd><?php echo h($booking->status); ?>&nbsp;</dd>
    <dt><?php echo __('Supervisor'); ?></dt>
    <dd>
        <?= h($booking->supervisor) ?>
        <?php 
        if(isset($booking->supervisor_check)){
            if($booking->supervisor_check){
                echo ' <span style="color:green;">Approved</span>';
            }else{
                echo ' <span style="color:red;">Not Approved</span>';
            }
        }
        
        ?>
        &nbsp;
    </dd>
    <dt><?php echo __('Start Date'); ?></dt>
    <dd>
        <?= h($booking->start_date) ?>
        &nbsp;
    </dd>
    <dt><?php echo __('End Date'); ?></dt>
    <dd>
        <?= h($booking->end_date) ?>
        &nbsp;
    </dd>
</dl>

<h2><?php 
echo $this->Html->link(
    'Open Booking',
    ['controller'=>'Bookings','action'=>'view', 
    $booking->id,'key'=> $booking->key,'_full' => true], array('target'=>'blank')); ?></h2>

<p>If you have received this information in error, please notify us.</p>