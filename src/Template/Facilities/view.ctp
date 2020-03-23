
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><span class="glyphicon glyphicon-zoom-in"></span> <?= h($facility->title) ?></h3>
    	<div class="box-tools pull-right">
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
                 		
    	<?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') 
                 		. '</span>', ['action' => 'edit', $facility->id], 
                 		['escape' => false, 'class' => 'btn btn-warning', 'title' => __('Edit')]) ?>
        <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') 
                 		. '</span>', ['action' => 'delete', $facility->id], 
                 		['confirm' => __('Are you sure you want to delete # {0}?', $facility->id), 'escape' => false, 
                 				'class' => 'btn btn-danger', 'title' => __('Delete')]) ?>
    	
      </div>
    </div>
    <div class='box-body'>
    <?php $footerHtml = '';?>
        <dl class="dl-horizontal">
            <dt><?= __('Abv') ?></dt>
            <dd><?= h($facility->abv) ?></dd>
            <dt><?= __('Description') ?></dt>
            <dd><?= h($facility->description) ?></dd>
            <dt><?= __('Bookings Email') ?></dt>
            <dd><?= h($facility->bookings_email) ?></dd>
            <dt><?= __('Users Email') ?></dt>
            <dd><?= h($facility->users_email) ?></dd>
        </dl>
        <dl class="dl-horizontal">
            <?php 
            $footerHtml .= "<b>". __('Created') .":</b> ";
            $footerHtml .= h($facility->created)." ";
            ?>
            <?php 
            $footerHtml .= "<b>". __('Modified') .":</b> ";
            $footerHtml .= h($facility->modified)." ";
            ?>
        </dl>
    
    <dl class="dl-horizontal">
       <dt><?= __('Notes') ?></dt>
       <dd><?= $this->Text->autoParagraph(h($facility->notes)); ?></dd>
    </dl>
    <dl class="dl-horizontal">
       <dt><?= __('Enabled Areas') ?></dt>
       <dd><?= implode(', ',$facility->enabled_areas); ?></dd>
    </dl>
</div>
<div class='box-footer'>
    <?= $footerHtml ?>
</div>
</div>
