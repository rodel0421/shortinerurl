<?php if(!$isAjax):?>
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><i class="fa fa-sticky-note-o" aria-hidden="true"></i> <?= h($message->title) ?></h3>
    	<div class="box-tools pull-right">
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
                 		
    	<?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') 
                 		. '</span>', ['action' => 'edit', $message->id], 
                 		['escape' => false, 'class' => 'btn btn-warning', 'title' => __('Edit')]) ?>
        <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') 
                 		. '</span>', ['action' => 'delete', $message->id], 
                 		['confirm' => __('Are you sure you want to delete # {0}?', $message->id), 'escape' => false, 
                 				'class' => 'btn btn-danger', 'title' => __('Delete')]) ?>
    	
      </div>
    </div>
    <div class='box-body'>
    <?php endif;?>
    <?= $message->notes ?>
        <?php if(!$isAjax):?>
</div>
<div class='box-footer'>
    <?php $footerHtml = '';?>
     <?php 
            $footerHtml .= "<b>". __('Created') .":</b> ";
            $footerHtml .= h($message->created)." ";
            ?>
            <?php 
            $footerHtml .= "<b>". __('Modified') .":</b> ";
            $footerHtml .= h($message->modified)." ";
            ?>
    <b><?= __('Added By') ?></b>
    <?= $message->has('user') ? $message->user->name : '' ?>
    <b><?= __('Expires') ?></b> <?= h($message->expires) ?>
    <?= $footerHtml ?>
</div>
</div>
<?php endif;?>