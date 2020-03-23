
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><span class="glyphicon glyphicon-zoom-in"></span> <?= h($formTemplate->title) ?> <span class='small'>Rev. <?= $this->Number->format($formTemplate->revision) ?></span></h3>
    	<div class="box-tools pull-right">
    	
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
                 		
    	<?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') 
                 		. '</span>', ['action' => 'edit', $formTemplate->id], 
                 		['escape' => false, 'class' => 'btn btn-warning', 'title' => __('Edit')]) ?>
        <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') 
                 		. '</span>', ['action' => 'delete', $formTemplate->id], 
                 		['confirm' => __('Are you sure you want to delete # {0}?', $formTemplate->id), 'escape' => false, 
                 				'class' => 'btn btn-danger', 'title' => __('Delete')]) ?>
    	<?= $this->element('guide', array("section" => 'formTemplates')) ?>
        
      </div>
    </div>
    <div class='box-body'>
 
    <?= $formTemplate->form?>
    
</div>
<div class='box-footer'>
    <?php $footerHtml = '';?>
    <?php 
            $footerHtml .= "<b>". __('Created') .":</b> ";
            $footerHtml .= h($formTemplate->created)." ";
            ?>
            <?php 
            $footerHtml .= "<b>". __('Modified') .":</b> ";
            $footerHtml .= h($formTemplate->modified)." ";
            ?>
    <?= $footerHtml ?>
</div>
</div>
