<div class='box'>
    <div class='box-header'>
        <h3 class='box-title'><i class="fa fa-calendar-minus-o" aria-hidden="true"></i> <?= $this->request->query('archived')?'Deleted':''?> Client Types</h3>
    	<div class="box-tools pull-right">
    	<div class="btn-group">
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
    </div>
    <div class='box-body'>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('title') ?></th>
                <th><?= $this->Paginator->sort('description') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <tr>
                <th><?= 
                 $this->Form->input('ClientTypes.title',array(
                    'class'=>'search', 'label' => false,
                    'style'=>'width:150px;',
                    'div' => false, 'required'=>false,
                    'type'=>'text'
                    ))?></th>
                <th><?= 
                 $this->Form->input('ClientTypes.description',array(
                    'class'=>'search', 'label' => false,
                    'style'=>'width:150px;',
                    'div' => false, 'required'=>false,
                    'type'=>'text'
                    ))?></th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($clientTypes as $clientType): ?>
            <tr data-id="<?= $clientType->id?>">
                <td><?= h($clientType->title) ?></td>
                <td><?= h($clientType->description) ?></td>
                <td><?= h($clientType->created) ?></td>
                <td><?= h($clientType->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') . '</span>', ['action' => 'edit', $clientType->id], ['escape' => false, 'class' => 'btn btn-xs btn-warning', 'title' => __('Edit')]) ?>
                    <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') . '</span>', ['action' => 'delete', $clientType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clientType->id), 'escape' => false, 'class' => 'btn btn-xs btn-danger', 'title' => __('Delete')]) ?>
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