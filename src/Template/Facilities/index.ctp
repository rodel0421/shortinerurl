<div class='box'>
    <div class='box-header'><h3 class='box-title'><i class="fa fa-bars"></i> <?= $this->request->query('archived')?'Deleted':''?> Facilities</h3>
    	<div class="box-tools pull-right">
    	<?= $this->Html->link('<i class="fa fa-plus" aria-hidden="true"></i>', 
            ['action' => 'add'],['escape'=>false,'class'=>'btn btn-default','title'=>'Add']) ?>
        
        <?php if($this->request->query('archived')){
            echo $this->Form->hidden('archived',['value'=>1,'class'=>'search','id'=>'archived']);
            echo $this->Html->link('<i class="fa fa fa-bars" aria-hidden="true"></i>', 
                ['action' => 'index'],['escape'=>false,'class'=>'btn btn-default','title'=>'Show All']);
        }else{
            echo $this->Html->link('<i class="fa fa-trash-o" aria-hidden="true"></i>', 
                ['action' => 'index','archived'=>1],['escape'=>false,'class'=>'btn btn-default','title'=>'Show Deleted']);
        }?>
      </div>
    </div>
    <div class='box-body'>
    <div class="table-responsive">
        <table class="table table-striped table-hover dbclick2open">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('title') ?></th>
                <th><?= $this->Paginator->sort('abv') ?></th>
                <th><?= $this->Paginator->sort('description') ?></th>
                <th><?= $this->Paginator->sort('bookings_email') ?></th>
                <th><?= $this->Paginator->sort('users_email') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($facilities as $facility): ?>
            <tr data-id="<?= $facility->id?>">
                <td><?= h($facility->title) ?></td>
                <td><?= h($facility->abv) ?></td>
                <td><?= h($facility->description) ?></td>
                <td><?= h($facility->bookings_email) ?></td>
                <td><?= h($facility->users_email) ?></td>
                <td><?= h($facility->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', ['action' => 'view', $facility->id], ['escape' => false, 'class' => 'btn btn-xs btn-success', 'title' => __('View')]) ?>
                    <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') . '</span>', ['action' => 'edit', $facility->id], ['escape' => false, 'class' => 'btn btn-xs btn-warning', 'title' => __('Edit')]) ?>
                <?php if(!$facility->active):?>
                    <?= $this->Form->postLink('<span class="fa fa-undo"></span><span class="sr-only">' . __('Restore') 
                        . '</span>', ['action' => 'delete', $facility->id], 
                        ['confirm' => __('Are you sure you want to restore this?'), 'escape' => false, 
                                        'class' => 'btn btn-xs btn-info', 'title' => __('Restore')]) ?>
                    <?php else:?>
                    <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') . '</span>', 
                                ['action' => 'delete', $facility->id], ['confirm' => __('Are you sure you want to delete this?'), 
                                    'escape' => false, 'class' => 'btn btn-xs btn-danger', 'title' => __('Delete')]) ?>
                <?php endif;?>    
                
                
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