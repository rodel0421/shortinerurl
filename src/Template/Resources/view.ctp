<?php if(!$isAjax):?>
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><i class="fa fa-book" aria-hidden="true"></i> <?= h($resource->title) ?>
        <?php if($resource->has('resource_categories')):?>
    <?php foreach($resource->resource_categories as $category):?>
    <span class='label label-primary'><?= h($category->name)?></span>
    <?php endforeach;?>
    <?php endif;?>
        
        </h3>
    	<div class="box-tools pull-right">
    	
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
        <?php if($isOfficer || $isAdmin):?> 
    	<?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') 
                 		. '</span>', ['action' => 'edit', $resource->id], 
                 		['escape' => false, 'class' => 'btn btn-warning', 'title' => __('Edit')]) ?>
        
        <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') 
                 		. '</span>', ['action' => 'delete', $resource->id], 
                 		['confirm' => __('Are you sure you want to delete # {0}?', $resource->id), 'escape' => false, 
                 				'class' => 'btn btn-danger', 'title' => __('Delete')]) ?>
    	<?php endif;?>
      </div>
    </div>
    <div class='box-body'>
<?php endif;?>
        <i><?= h($resource->description) ?></i>
        <?php if($resource->type == 'Document'):?>
        <?php 
            $icon = '<span class="file-icon-mini '.h($resource->doc_ext).'-mini"></span> '.h($resource->title);
            echo $this->Dak->link($icon,$resource->doc,array('target'=>'_blank','escape'=>false));
        ?>
        <?php elseif($resource->type == 'Link'):?>
        <?= $this->Html->link(h($resource->title),$resource->link) ?>
        <?php else:?>
        <?= $resource->notes; ?>
        <?php endif;?>
        
        
<?php if(!$isAjax):?>        
</div>
<div class='box-footer'>
    
    <?php $footerHtml = '';?>
     <?php 
            $footerHtml .= "<b>". __('Created') .":</b> ";
            $footerHtml .= h($resource->created)." ";
            ?>
            <?php 
            $footerHtml .= "<b>". __('Modified') .":</b> ";
            $footerHtml .= h($resource->modified)." ";
            ?>
    <b><?= __('Added By') ?></b>
    <?= $resource->has('user') ? $resource->user->name : '' ?>
    <?= $footerHtml ?>
</div>
</div>
<?php endif;?>