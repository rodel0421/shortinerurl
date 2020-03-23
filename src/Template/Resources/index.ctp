<div class='box'>
    <div class='box-header'>
        <h3 class='box-title'><i class="fa fa-book" aria-hidden="true"></i> <?= $this->request->query('archived')?'Deleted':''?> Resources</h3>
    	<div class="box-tools pull-right">
    	<div class="btn-group">
            <?php if($isOfficer || $isAdmin):?>
        <?= $this->Html->link('<i class="fa fa-plus" aria-hidden="true"></i> Note', 
            ['action' => 'add'],['escape'=>false,'class'=>'btn btn-default','title'=>'Add Note']) ?>
        <?= $this->Html->link('<i class="fa fa-plus" aria-hidden="true"></i> Document', 
            ['action' => 'add','type'=>'Document'],['escape'=>false,'class'=>'btn btn-default','title'=>'Add Document']) ?>
        <?= $this->Html->link('<i class="fa fa-plus" aria-hidden="true"></i> Link', 
            ['action' => 'add','type'=>'Link'],['escape'=>false,'class'=>'btn btn-default','title'=>'Add Link']) ?>

            <?= $this->Html->link('<i class="fa fa-refresh" aria-hidden="true"></i>', 
                ['action' => 'index','rebuild'=>1],['escape'=>false,'class'=>'btn btn-default','title'=>'Rebuild Order']);?>
            
        <?php if($this->request->query('archived')){
            echo $this->Form->hidden('archived',['value'=>1,'class'=>'search','id'=>'archived']);
            echo $this->Html->link('<i class="fa fa fa-bars" aria-hidden="true"></i>', 
                ['action' => 'index'],['escape'=>false,'class'=>'btn btn-default','title'=>'Show All']);
        }else{
            echo $this->Html->link('<i class="fa fa-trash-o" aria-hidden="true"></i>', 
                ['action' => 'index','archived'=>1],['escape'=>false,'class'=>'btn btn-default','title'=>'Show Deleted']);
        }?>
            <?php endif;?>
      </div>
      </div>
    </div>
    <div class='box-body'>
    <div class="table-responsive">
        <table class="table table-striped table-hover dbclick2open">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('title') ?></th>
                <th>Categories</th>
                <th><?= $this->Paginator->sort('group_id') ?></th>
                <th>Resource</th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <tr>
              <th><?= 
                 $this->Form->input('Resources.title',array(
                    'class'=>'search', 'label' => false,
                    'style'=>'width:150px;',
                    'div' => false, 'required'=>false,
                    'type'=>'text'
                    ))?></th>
              <th><?= 
                 $this->Form->input('category',array(
                    'class'=>'search', 'label' => false,
                    'style'=>'width:150px;',
                    'div' => false, 'required'=>false,
                    'empty'=>'(Any)',
                    'options'=>$categories
                    ))?></th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($resources as $resource): ?>
            <tr data-id="<?= $resource->id?>">
                <td><?= h($resource->title) ?></td>
                <td><?php if($resource->has('resource_categories')):?>
                    <?php foreach($resource->resource_categories as $category):?>
                    <span class='label label-primary'><?= h($category->name)?></span>
                    <?php endforeach;?>
                <?php endif;?></td>
                <td>
                    <?= $resource->has('group') ? $resource->group->name : 'Public' ?>
                </td>
                <td><?php if($resource->type == 'Document'):?>
                <?php 
                    $icon = '<span class="file-icon-mini '.h($resource->doc_ext).'-mini"></span> '.h($resource->title);
                    echo $this->Dak->link($icon,$resource->doc,array('target'=>'_blank','escape'=>false));
                ?>
                <?php elseif($resource->type == 'Link'):?>
                <?= $this->Html->link(h($resource->title),$resource->link) ?>
                <?php else:?>
                    <?= $this->Html->link(h($resource->title),['controller'=>'Resources','action'=>'view',$resource->id],['class'=>'btnPreview']) ?>
                <?php endif;?></td>
                <td><?= h($resource->created) ?></td>
               <td class="actions">
                   <?= $this->Html->link('<i class="fa fa-arrow-circle-down"></i>', 
                            ['action' => 'view', $resource->id,'moveDown'=>1],
                            ['escape' => false,'class'=>'btn  btn-xs btn-info']) ?>
                    <?= $this->Html->link('<i class="fa fa-arrow-circle-up"></i>', ['action' => 'view', $resource->id,'moveUp'=>1], 
                            ['escape' => false,'class'=>'btn  btn-xs btn-info']) ?>
                    <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', ['action' => 'view', $resource->id], ['escape' => false, 'class' => 'btn btn-xs btn-success', 'title' => __('View')]) ?>
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