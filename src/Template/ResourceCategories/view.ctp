
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><span class="glyphicon glyphicon-zoom-in"></span> <?= h($resourceCategory->name) ?></h3>
    	<div class="box-tools pull-right">
    	<?= $this->Html->link('<span class="glyphicon glyphicon-file"></span><span class="sr-only">' . __('New') 
                 		. '</span>', ['action' => 'add'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('New')]) ?>
    	
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
                 		
    	<?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') 
                 		. '</span>', ['action' => 'edit', $resourceCategory->id], 
                 		['escape' => false, 'class' => 'btn btn-warning', 'title' => __('Edit')]) ?>
        <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') 
                 		. '</span>', ['action' => 'delete', $resourceCategory->id], 
                 		['confirm' => __('Are you sure you want to delete # {0}?', $resourceCategory->id), 'escape' => false, 
                 				'class' => 'btn btn-danger', 'title' => __('Delete')]) ?>
    	<?= $this->element('guide', array("section" => 'resourceCategories')) ?>
        <div class="btn-group">
          <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
          <ul class="dropdown-menu" role="menu">
            
        <li><?= $this->Html->link(__('List Resources Tags'), ['controller' => 'ResourcesTags', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Resources Tag'), ['controller' => 'ResourcesTags', 'action' => 'add']) ?> </li>
         </ul>
        </div>
      </div>
    </div>
    <div class='box-body'>
    <?php $footerHtml = '';?>
        <dl class="dl-horizontal">
            <dt><?= __('Name') ?></dt>
            <dd><?= h($resourceCategory->name) ?></dd>
            <dt><?= __('Description') ?></dt>
            <dd><?= h($resourceCategory->description) ?></dd>
        </dl>
        <dl class="dl-horizontal">
            <dt><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($resourceCategory->id) ?></dd>
        </dl>
        <dl class="dl-horizontal">
            <?php 
            $footerHtml .= "<b>". __('Created') .":</b> ";
            $footerHtml .= h($resourceCategory->created)." ";
            ?>
            <?php 
            $footerHtml .= "<b>". __('Modified') .":</b> ";
            $footerHtml .= h($resourceCategory->modified)." ";
            ?>
        </dl>
    
</div>
<div class='box-footer'>
    <?= $footerHtml ?>
</div>
</div>
<div class='box box-info'>
    <div class='box-header'><h3 class='box-title'><?= __('Related ResourcesTags') ?></h3>
    	<div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class='box-body'>
    <?php if (!empty($resourceCategory->resources_tags)): ?>
    <div class="">
    <table class="table table-bordered table-hover data-table">
    <thead>
        <tr>
            <th><?= __('Resource Id') ?></th>
            <th><?= __('Resource Category Id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($resourceCategory->resources_tags as $resourcesTags): ?>
        <tr>
            <td><?= h($resourcesTags->resource_id) ?></td>
            <td><?= h($resourcesTags->resource_category_id) ?></td>

            <td class="actions">
                 <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') 
                 		. '</span>', ['controller' => 'ResourcesTags', 'action' => 'view', $resourcesTags->resource_id], 
                 		['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('View')]) ?>
                 <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') 
                 		. '</span>', ['controller' => 'ResourcesTags', 'action' => 'edit', $resourcesTags->resource_id], 
                 		['escape' => false, 'class' => 'btn btn-xs btn-warning', 'title' => __('Edit')]) ?>
                 <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') 
                 		. '</span>', ['controller' => 'ResourcesTags', 'action' => 'delete', $resourcesTags->resource_id], 
                 		['confirm' => __('Are you sure you want to delete # {0}?', $resourceCategory->id), 'escape' => false, 
                 				'class' => 'btn btn-xs btn-danger', 'title' => __('Delete')]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <?php endif; ?>
    </div>
</div>
