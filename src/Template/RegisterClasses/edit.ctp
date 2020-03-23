
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Edit Register Class') ?></h3>
    	<div class="box-tools pull-right">
    	
    	<?= $this->Html->link('Back', ['controller'=>'RegisterTemplates','action' => 'view',$registerClass->register_template_id], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('Back')]) ?>
                 		
    	<?= $this->Form->postLink(
        		'<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete'),
                ['action' => 'delete', $registerClass->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', 
                $registerClass->id), 'escape' => false, 
                 	'class' => 'btn btn-danger', 'title' => __('Delete')]
            )
        ?>
		
      </div>
    </div>
    <div class='box-body'>
    <?= $this->Form->create($registerClass, ['type' => 'file']); ?>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('short_hand');
            echo $this->Form->input('description');
            echo $this->Form->input('icon', [
                'type' => 'file',
                'help'=>'.gif, .jpg, .png, .jpeg',
                'label' => 'Upload Icon'
                ]);
        ?>
    <?= $this->Form->button(__('Submit'), ['bootstrap-type' => 'success']) ?>
    <?= $this->Form->end() ?>
</div>
</div>
