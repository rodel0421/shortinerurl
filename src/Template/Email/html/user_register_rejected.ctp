<p class="lead" style="Margin:0;Margin-bottom:10px;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:20px;font-weight:400;line-height:1.6;margin:0;margin-bottom:10px;padding:0;text-align:left">
    <?= h($register->register_template->name) ?>  
    <?= $register->has('user') ? ' for '. h($register->user->name) : '' ?>
    [<?= $register->has('department') ? $register->department->name : '' ?>] has been rejected for the following reason:
</p>
<p><?= $this->Text->autoParagraph(h($reason)); ?></p>
<br/>