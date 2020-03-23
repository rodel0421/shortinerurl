
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Edit Certification Class') ?></h3>
    	<div class="box-tools pull-right">
    	
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
                 		
    	        <?= $this->Form->postLink(
        		'<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete'),
                ['action' => 'delete', $certificationClass->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', 
                $certificationClass->id), 'escape' => false, 
                 	'class' => 'btn btn-danger', 'title' => __('Delete')]
            )
        ?>
		
      </div>
    </div>
    <div class='box-body'>
    <?= $this->Form->create($certificationClass, ['type' => 'file']); ?>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('short_hand');
            echo $this->Form->input('description');
            echo $this->Form->input('icon', [
                'type' => 'file',
                'help'=>'.gif, .jpg, .png, .jpeg',
                'label' => 'Upload Profile Picture'
                ]);
        ?>
    <?= $this->Form->button(__('Submit'), ['bootstrap-type' => 'success']) ?>
    <?= $this->Form->end() ?>
</div>
</div>
