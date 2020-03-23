Dear <?= h($trip->user->name) ?>,<br />
<p><strong>Note:</strong>This trip has been updated.</p> 
<?php if(!empty($note)):?>
<strong>Comment:</strong>
<?= $note?>
<?php endif;?>
<h3>Trip Details:</h3>
<dl>
    <dt><?php echo __('Trip Leader'); ?></dt>
    <dd><?= $trip->has('user') ? h($trip->user->name) : '' ?>&nbsp;</dd>    
    <dt><?php echo __('Status'); ?></dt>
    <dd><?php 
        echo h($trip->status); 
        if($trip->approved_by){
            echo ' At '.h($trip->approved_date). $trip->has('approved_by_user') ? ' by '.h($trip->approved_by_user->name): '';
        }
        ?>&nbsp;</dd>
    <dt><?php echo __('Supervisor'); ?></dt>
    <dd>
        <?= h($trip->supervisor) ?>
        <?php 
        if(isset($trip->supervisor_check)){
            if($trip->supervisor_check){
                echo ' <span style="color:green;">Approved</span>';
            }else{
                echo ' <span style="color:red;">Not Approved</span>';
            }
        }
        
        ?>
        &nbsp;
    </dd>
    <dt><?php echo __('Location'); ?></dt>
    <dd>
        <?php echo h($trip->location); ?>
        &nbsp;
    </dd>
    <dt><?php echo __('Start Date'); ?></dt>
    <dd>
        <?= h($trip->start_date) ?>
        &nbsp;
    </dd>
    <dt><?php echo __('End Date'); ?></dt>
    <dd>
        <?= h($trip->end_date) ?>
        &nbsp;
    </dd>
    <?php if(!empty($trip->trip_types)):?>
    <dt><?= __('Activities') ?></dt>
    <?php foreach($trip->trip_types as $trip_type):?>
    <dd><?= h($trip_type->title); ?></dd>
    <?php endforeach;?>
    <?php endif;?>
    <dt><?= __('Account Holder') ?></dt>
    <dd><?= h($trip->account_holder) ?></dd>
    <dt><?= __('Charge Code') ?></dt>
    <dd><?= h($trip->charge_code) ?></dd>
</dl>

<h2><?php 
echo $this->Html->link(
    'Open Trip',
    ['controller'=>'Trips','action'=>'view', 
    $trip->id,'key'=> $trip->key,'_full' => true], array('target'=>'blank')); ?></h2>

<p>If you have received this information in error, please notify us.</p>