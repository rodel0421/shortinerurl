<li class="dropdown notifications-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
  <i class="fa fa-sticky-note-o"></i><?php if($count > 0):?><span class="label label-success"><?= $count?></span><?php endif;?>
</a>
<ul class="dropdown-menu">
  <li class="header">Notice Board</li>
  <li>
    <ul class="menu">
    <?php foreach ($messages as $message): ?>
      <li>
        <a href="<?= $this->Url->build(['plugin' => null,'controller'=>'Messages','action' => 'view',$message->id])?>" class='btnPreview' title='<?= h($message->title) ?>'>
          <h4><?= h($message->title) ?>
              <small><i class="fa fa-clock-o"></i> <?= h($message->created->timeAgoInWords(['accuracy' => 'day'])) ?></small>
          </h4>
        </a>
      </li>
      <?php endforeach; ?>
</ul>
  </li>
  <?php if($count > count($messages)):?>
  <li class="footer"><?= $this->Html->link('More...', ['plugin' => null,'controller'=>'Messages','action' => 'index'], 
                 		['escape' => false, 'title' => __('See all Messages')]) ?></li>
<?php endif;?>
</ul>
</li> 