<div class='box'>
    <div class='box-header'><h3 class='box-title'><i class="fa fa-lock"></i> Security Groups</h3>
    	<div class="box-tools pull-right">
    	<div class="btn-group">
    	<?= $this->element('guide', array("section" => 'groups')) ?>
        
      </div>
      </div>
    </div>
    <div class='box-body'>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($groups as $group): ?>
            <tr data-id="<?= $group->id?>">
                <td><?= $this->Number->format($group->id) ?></td>
                <td class="<?= h($group->style)?>"><?= h($group->name) ?></td>
                <td><?= h($group->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') . '</span>', ['action' => 'edit', $group->id], ['escape' => false, 'class' => 'btn btn-xs btn-warning', 'title' => __('Edit')]) ?>
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