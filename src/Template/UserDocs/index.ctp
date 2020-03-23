<div class='box'>
    <div class='box-header'><h3 class='box-title'>
            <i class="fa fa-folder-open"></i> <?= $this->request->query('archived')?'Deleted':''?> User Documents</h3>
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
                <th><?= $this->Paginator->sort('name','Document Name') ?></th>
                <th><?= $this->Paginator->sort('filesize') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($userDocs as $userDoc): ?>
            <tr data-id="<?= $userDoc->id?>">
                <td>
                    <?= $userDoc->has('user') ? $this->Html->link($userDoc->user->name, ['controller' => 'Users', 'action' => 'view', $userDoc->user->id]) : '' ?>
                </td>
                <td><?php 
                if(!empty($userDoc->file_url)){
                    $icon = '<span class="file-icon-mini '.h($userDoc->extension).'-mini"></span> '.h($userDoc->name);
                    echo $this->Dak->link($icon,$userDoc->file_url,array('target'=>'_blank','escape'=>false));
                 }
                 ?>&nbsp;<?= ($userDoc->private)?'<i class="fa fa-eye-slash" title="Private - Office Use Only"></i>':'' ?></td>
                <td><?= $this->Number->toReadableSize($userDoc->filesize) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', ['action' => 'view', $userDoc->id], ['escape' => false, 'class' => 'btn btn-xs btn-success', 'title' => __('View')]) ?>
                    <?php if(!$userDoc->active):?>
                    <?= $this->Form->postLink('<span class="fa fa-undo"></span><span class="sr-only">' . __('Restore') 
                        . '</span>', ['action' => 'delete', $userDoc->id], 
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