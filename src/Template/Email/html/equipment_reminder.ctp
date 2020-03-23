<p class="lead" style="Margin:0;Margin-bottom:10px;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:20px;font-weight:400;line-height:1.6;margin:0;margin-bottom:10px;paspaning:0;text-align:left">
    Equipment Return Reminder</p>
<p>Hi <?= h($user->given_name)?>,</p>

<?php if(Cake\Core\Configure::check('CustomText.EquipmentReturnReminder')):?>
<p><?= h(Cake\Core\Configure::read('CustomText.EquipmentReturnReminder'))?></p>
<?php else:?>
<p>This is a friendly reminder that your borrowed item/s are due for return.</p>
<?php endif;?>
<p>
<?php 
foreach($user->equipment_reservations as $equipmentReservation):?>
<?= $equipmentReservation->has('equipment') && $equipmentReservation->equipment->has('equipment_type')? h($equipmentReservation->equipment->equipment_type->title):'' ?> 
<?= $equipmentReservation->has('equipment') ? h($equipmentReservation->equipment->title) : '' ?> 
<?= ($equipmentReservation->qty > 1)? '('.h($equipmentReservation->qty).')' : '' ?> 
<b>Return: <?= h($equipmentReservation->end->i18nFormat('dd/MM/YYYY'))?></b><br/>
<?php 
endforeach;?>
</p>
<p>Thank you!</p>