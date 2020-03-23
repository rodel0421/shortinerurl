<div class='box'>
    <div class='box-header'><h3 class='box-title'>
            <i class="fa fa-certificate" aria-hidden="true"></i> <?= $this->request->query('archived')?'Deleted':''?> Certification Types</h3>
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
                <th><?= $this->Paginator->sort('category') ?></th>
                <th><?= $this->Paginator->sort('type') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('certification_class_id') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <tr>
                <th><?= 
                 $this->Form->input('CertificationTypes.category',array(
                    'class'=>'search', 'label' => false,
                    'style'=>'width:150px;',
                    'div' => false, 'required'=>false,
                    'options'=>$categories,'empty'=>true
                    ))?></th>
                <th><?= 
                 $this->Form->input('CertificationTypes.type',array(
                    'class'=>'search', 'label' => false,
                    'style'=>'width:150px;',
                    'div' => false, 'required'=>false,
                    'options'=>$types,'empty'=>true
                    ))?></th>
                <th><?= 
                 $this->Form->input('CertificationTypes.name',array(
                    'class'=>'search', 'label' => false,
                    'style'=>'width:150px;',
                    'div' => false, 'required'=>false,
                    'type'=>'text'
                    ))?></th>
                <th><?= 
                 $this->Form->input('CertificationTypes.certification_class_id',array(
                    'class'=>'search', 'label' => false,
                    'style'=>'width:150px;',
                    'div' => false, 'required'=>false,
                    'options'=>$certificationClasses,'empty'=>true
                    ))?></th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($certificationTypes as $certificationType): ?>
            <tr data-id="<?= $certificationType->id?>">
                <td><?= h($certificationType->category) ?></td>
                <td><?= h($certificationType->type) ?></td>
                <td><?= h($certificationType->name) ?></td>
                <td>
                    <?= $certificationType->has('certification_class') ? $this->Html->image($certificationType->certification_class->icon,['class'=>'inline_icon']).$certificationType->certification_class->name : '' ?>
                </td>
            <td><?= h($certificationType->created) ?></td>
                <td><?= h($certificationType->modified) ?></td>
                <td class="actions">
                     <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') . '</span>', ['action' => 'edit', $certificationType->id], ['escape' => false, 'class' => 'btn btn-xs btn-warning', 'title' => __('Edit')]) ?>
                    
                    <?php if(!$certificationType->active):?>
                        <?= $this->Form->postLink('<span class="fa fa-undo"></span><span class="sr-only">' . __('Restore') 
                            . '</span>', ['action' => 'delete', $certificationType->id], 
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