<li class="dropdown notifications-menu">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-bell-o"></i>
    <?php if($count > 0):?><span class="label label-warning"><?= $count ?></span><?php endif;?>
  </a>
<ul class="dropdown-menu">
  <li class="header">You have <?= $count ?> notifications</li>
  <li>
    <!-- inner menu: contains the actual data -->
    <ul class="menu">
      <?php foreach ($alerts as $alert): ?>
      <li><!-- Task item -->
        <a href="<?= $alert->link ?>">
          <?= $alert->ack ? '' : '<i class="fa fa-exclamation text-red"></i>' ?><?= h($alert->title) ?>
        </a>
      </li>
      <?php endforeach; ?>
      <!-- end task item -->
    </ul>
  </li>
  <li class="footer">
    <?= $this->Html->link('View all notifications', [
        'plugin' => null,'controller'=>'Alerts','action' => 'index'
        ],['escape'=>false]) ?>
  </li>
</ul>
</li>