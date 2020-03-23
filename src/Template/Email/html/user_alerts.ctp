<p class="lead">Current Notifications</p>
<p>Hi <?= h($user->name)?>,</p>
<table class="table table-bordered table-hover data-table">
<thead>
    <tr>
        <th><?= __('Title') ?></th>
        <th><?= __('Created') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($user->alerts as $alert): ?>
    <tr>
        <td><?= $this->Html->link(h($alert->title), 
                    ['controller'=>'Alerts','action' => 'view', $alert->id,'_full' => true], 
                ['escape' => false, 'title' => __('Open')]) ?></td>
        <td><?= h($alert->created) ?>&nbsp;</td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<p></p>
<p>If you do not wish to be notified of these anymore, please login and dismiss the notifications.</p>
<?= $this->Html->link('Manage Notifications', 
                    ['controller'=>'Alerts','action' => 'index','_full' => true], 
                ['escape' => false, 'title' => __('Manage Notifications')]) ?>