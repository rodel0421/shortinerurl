<div class='box'>
    <div class='box-header'><h3 class='box-title'><i class="fa fa-bars"></i><span></h3>
    	<div class="box-tools pull-right">
    	<div class="btn-group">
        <?= $this->Html->link('<i class="fa fa-plus"></i>', ['action' => 'add'],['escape'=>false,'class'=>'btn btn-default']) ?>
    	
        <?php if($this->request->query('archived')){
            echo $this->Form->hidden('archived',['value'=>1,'class'=>'search','id'=>'archived']);
            echo $this->Html->link('<i class="fa fa fa-bars" aria-hidden="true"></i>', 
                ['action' => 'index'],['escape'=>false,'class'=>'btn btn-default','title'=>'Show All']);
        }else{
            echo $this->Html->link('<i class="fa fa-trash-o" aria-hidden="true"></i>', 
                ['action' => 'index','archived'=>1],['escape'=>false,'class'=>'btn btn-default','title'=>'Show Deleted']);
        }?>
            
            <?php if($isAdmin):?>
            <?= $this->Html->link('<i class="fa fa-refresh" aria-hidden="true"></i>', 
                ['action' => 'index','rebuild'=>1],['escape'=>false,'class'=>'btn btn-default','title'=>'Rebuild Order']);?>
            <?php endif;?>
      </div>
      </div>
    </div>
    <div class='box-body'>
    <div class="table-responsive">
        <table class="table table-striped table-hover dbclick2open">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('controller','Section') ?></th>
                <th><?= $this->Paginator->sort('title') ?></th>
                <th><?= $this->Paginator->sort('action') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($guides as $guide): ?>
            <tr data-id="<?= $guide->id?>">
                <td><?= h($guide->controller) ?></td>
                <td><?= $guide->has('parent_guide')? '<i class="fa fa-long-arrow-right"></i> ' :'' ?><?= h($guide->title) ?></td>
                <td><?= h($guide->action) ?></td>
                <td><?= h($guide->created) ?></td>
                <td class="actions">
                    
                    <?= $this->Html->link('<i class="fa fa-arrow-circle-down"></i>', 
                            ['action' => 'view', $guide->id,'moveDown'=>1],
                            ['escape' => false,'class'=>'btn  btn-xs btn-info']) ?>
                    <?= $this->Html->link('<i class="fa fa-arrow-circle-up"></i>', ['action' => 'view', $guide->id,'moveUp'=>1], 
                            ['escape' => false,'class'=>'btn  btn-xs btn-info']) ?>
                    
                    
                    <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', ['action' => 'view', $guide->id], ['escape' => false, 'class' => 'btn btn-xs btn-success', 'title' => __('View')]) ?>
                    <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') . '</span>', ['action' => 'edit', $guide->id], ['escape' => false, 'class' => 'btn btn-xs btn-warning', 'title' => __('Edit')]) ?>
                    <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') . '</span>', ['action' => 'delete', $guide->id], ['confirm' => __('Are you sure you want to delete # {0}?', $guide->id), 'escape' => false, 'class' => 'btn btn-xs btn-danger', 'title' => __('Delete')]) ?>
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