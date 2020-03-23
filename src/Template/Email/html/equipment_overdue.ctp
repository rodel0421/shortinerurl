<p class="lead" style="Margin:0;Margin-bottom:10px;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:20px;font-weight:400;line-height:1.6;margin:0;margin-bottom:10px;paspaning:0;text-align:left">
    Equipment Overdue</p>
<p>Hi <?= h($equipmentReservation->user->given_name)?>,</p>

<?php if(Cake\Core\Configure::check('CustomText.EquipmentOverdue')):?>
<p><?= h(Cake\Core\Configure::read('CustomText.EquipmentOverdue'))?></p>
<?php else:?>
<p>This is a friendly reminder that your borrowed item/s are due for return.</p>
<?php endif;?>
<p>
<?= $equipmentReservation->has('equipment') && $equipmentReservation->equipment->has('equipment_type')? h($equipmentReservation->equipment->equipment_type->title):'' ?> 
<?= $equipmentReservation->has('equipment') ? h($equipmentReservation->equipment->title) : '' ?> 
<?= ($equipmentReservation->qty > 1)? '('.h($equipmentReservation->qty).')' : '' ?> 
<b>Due back <?= h($equipmentReservation->end->timeAgoInWords( ['format' => 'MMM d, YYY', 'end' => '+1 year']))?></b><br/>

</p>
<p>Thank you!</p>