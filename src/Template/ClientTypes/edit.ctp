
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Edit Client Type') ?></h3>
    	<div class="box-tools pull-right">
    	
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
                 		
        <?= $this->Form->postLink(
        		'<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete'),
                ['action' => 'delete', $clientType->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', 
                $clientType->id), 'escape' => false, 
                 	'class' => 'btn btn-danger', 'title' => __('Delete')]
            )
        ?>
      </div>
    </div>
    <div class='box-body'>
    <?= $this->Form->create($clientType); ?>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('description');
        ?>
    <?= $this->Form->button(__('Submit'), ['bootstrap-type' => 'success']) ?>
    <?= $this->Form->end() ?>
</div>
</div>
