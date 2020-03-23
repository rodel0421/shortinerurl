<div class='box'>
    <div class='box-header'><h3 class='box-title'><i class="fa fa-bars"></i><span></h3>
    	<div class="box-tools pull-right">
    	<div class="btn-group">
        <?= $this->Html->link('<i class="fa fa-plus"></i>', ['action' => 'add'],['escape'=>false,'class'=>'btn btn-default']) ?>
    	<?= $this->element('guide', array("section" => 'resourceCategories')) ?>
        <div class="btn-group">
            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
            </button>
          <ul class="dropdown-menu" role="menu">
        <li><?= $this->Html->link(__('List Resources Tags'), ['controller' => 'ResourcesTags', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Resources Tag'), ['controller' => 'ResourcesTags', 'action' => 'add']) ?> </li>
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
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('description') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($resourceCategories as $resourceCategory): ?>
                    <tr data-id="<?= $resourceCategory->id?>">
                <td><?= $this->Number->format($resourceCategory->id) ?></td>
                <td><?= h($resourceCategory->name) ?></td>
                <td><?= h($resourceCategory->description) ?></td>
                <td><?= h($resourceCategory->created) ?></td>
                <td><?= h($resourceCategory->modified) ?></td>
                    <td class="actions">
                    <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', ['action' => 'view', $resourceCategory->id], ['escape' => false, 'class' => 'btn btn-xs btn-success', 'title' => __('View')]) ?>
                    <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') . '</span>', ['action' => 'edit', $resourceCategory->id], ['escape' => false, 'class' => 'btn btn-xs btn-warning', 'title' => __('Edit')]) ?>
                    <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') . '</span>', ['action' => 'delete', $resourceCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $resourceCategory->id), 'escape' => false, 'class' => 'btn btn-xs btn-danger', 'title' => __('Delete')]) ?>
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