<div class='box'>
    <div class='box-header'><h3 class='box-title'><i class="fa fa-bars"></i><span></h3>
    	<div class="box-tools pull-right">
    	<div class="btn-group">
        <?= $this->Html->link('<i class="fa fa-plus"></i>', ['action' => 'add'],['escape'=>false,'class'=>'btn btn-default']) ?>
    	<?= $this->element('guide', array("section" => 'dashboardItems')) ?>
        <div class="btn-group">
            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
            </button>
          <ul class="dropdown-menu" role="menu">
        <li><?= $this->Html->link(__('List Dashboards'), ['controller' => 'Dashboards', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Dashboard'), ['controller' => 'Dashboards', 'action' => 'add']) ?> </li>
          </ul>
        </div>
      </div>
      </div>
    </div>
    <div class='box-body'>
    <div class="table-responsive">
        <table class="table table-striped table-hover dbclick2open">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('dashboard_id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('row') ?></th>
                <th><?= $this->Paginator->sort('col') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($dashboardItems as $dashboardItem): ?>
                    <tr data-id="<?= $dashboardItem->id?>">
                <td><?= $this->Number->format($dashboardItem->id) ?></td>
                <td>
                    <?= $dashboardItem->has('dashboard') ? $this->Html->link($dashboardItem->dashboard->name, ['controller' => 'Dashboards', 'action' => 'view', $dashboardItem->dashboard->id]) : '' ?>
                </td>
            <td><?= h($dashboardItem->name) ?></td>
                    <td><?= $this->Number->format($dashboardItem->row) ?></td>
                    <td><?= $this->Number->format($dashboardItem->col) ?></td>
                <td><?= h($dashboardItem->created) ?></td>
                <td><?= h($dashboardItem->modified) ?></td>
                    <td class="actions">
                    <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', ['action' => 'view', $dashboardItem->id], ['escape' => false, 'class' => 'btn btn-xs btn-success', 'title' => __('View')]) ?>
                    <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') . '</span>', ['action' => 'edit', $dashboardItem->id], ['escape' => false, 'class' => 'btn btn-xs btn-warning', 'title' => __('Edit')]) ?>
                    <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') . '</span>', ['action' => 'delete', $dashboardItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dashboardItem->id), 'escape' => false, 'class' => 'btn btn-xs btn-danger', 'title' => __('Delete')]) ?>
                </td>
            </tr>

        <?php endforeach; ?>
        </tbody>
        </table>
    </div>
    </div>
    <div class='box-footer'>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
</div>