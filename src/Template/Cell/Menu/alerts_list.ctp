<?php foreach ($alerts as $alert): ?>
<a href="<?= $this->Url->build(['plugin' => null,'controller'=>'Alerts','action'=>'view',$alert->id])?>" class='noprint' title='<?= h($alert->title) ?>'>
<div class="alert alert-warning alert-mini">
  <i class="icon fa fa-warning"></i><?= h($alert->title) ?>
</div>
</a>
<?php endforeach; ?>