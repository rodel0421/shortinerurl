<p class="lead" style="Margin:0;Margin-bottom:10px;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:20px;font-weight:400;line-height:1.6;margin:0;margin-bottom:10px;padding:0;text-align:left">
    Appointment</p>
<p>Hi <?= h($appointment->user->given_name)?>,</p>
<?php if($type == 'New'):?>
<p><?= h($appointment->organiser_user->name)?> has made the following appointment:</p>
<?php elseif($type == 'deleted'):?>
<p>This appointment has been canceled:</p>
<?php else: //Update?>
<p>This appointment has been updated:</p>
<?php endif;?>
<p>
    <b>From: </b> <?= $appointment->dtstart ?><br/>
    <b>To: </b> <?= $appointment->dtend ?><br/>
    <b>Summary: </b><br/>
    <?= h($appointment->summary) ?>
</p>
<?php if(!empty($appointment->comment)):?>
<h3>Comment: </h3>
<?= $this->Text->autoParagraph(h($appointment->comment)); ?>
<?php endif;?>
<p>Thank you!</p>