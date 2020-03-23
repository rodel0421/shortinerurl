<div class='box'>
    <div class='box-header'><h3 class='box-title'>
            <i class="fa fa-certificate" aria-hidden="true"></i> <?= $this->request->query('archived')?'Deleted':''?> Certifications</h3>
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
        <table class="data-table-render table table-striped table-hover dbclick2open">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th>Departments</th>
                <th><?= $this->Paginator->sort('certification_type_id') ?></th>
                <th><?= $this->Paginator->sort('issuer') ?></th>
                <th><?= $this->Paginator->sort('issued') ?></th>
                <th><?= $this->Paginator->sort('expires') ?></th>
                <th><?= $this->Paginator->sort('validated_by') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($certifications as $certification): ?>
        <tr data-id="<?= $certification->id?>" <?= (!$certification->valid) ? 'class="danger"':''?>>
            <td>
                <?= $certification->has('user') ? $this->Html->link($certification->user->name, ['controller' => 'Users', 'action' => 'view', $certification->user->id]) : '' ?>
            </td>
            <td>
                <?php
                    if ($certification->has('user') && $certification->user->has('departments')){
                        $temp = [];
                        foreach($certification->user->departments as $departments){
                            $temp[] = h($departments->name);
                        }
                    }                     
                    echo implode(', ', $temp) ?>&nbsp;
            </td>
            <td>
                <?= $certification->has('certification_type') ? $certification->certification_type->name : '' ?>
            </td>
            <td><?= h($certification->issuer) ?></td>
            <td><?= h($certification->issued) ?></td>
            <td><?= h($certification->expires) ?></td>
            <td><?php if($certification->valid){
                echo 'Validated '. h($certification->validated_date);
                echo ($certification->has('validated'))?' by '. $certification->validated->name:''; 
            }else{
            	echo 'Not yet validated';
            } ?></td>
            <td class="actions">
                <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', 
                    ['action' => 'view', $certification->id], ['escape' => false, 'class' => 'btn btn-xs btn-success', 'title' => __('View')]) ?>
                <?php if(!$certification->active):?>
                        <?= $this->Form->postLink('<span class="fa fa-undo"></span><span class="sr-only">' . __('Restore') 
                            . '</span>', ['action' => 'delete', $certification->id], 
                            ['confirm' => __('Are you sure you want to restore this?'), 'escape' => false, 
                                            'class' => 'btn btn-xs btn-info', 'title' => __('Restore')]) ?>
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