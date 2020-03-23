
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Edit User Note') ?></h3>
    	<div class="box-tools pull-right">
    	
    	<?= $this->Html->link('Back', ['controller'=>'Users','action' => 'view',$userNote->user_id], 
                ['escape' => false, 'class' => 'btn btn-default', 'title' => __('Back')]) ?>
        
        <?php if($userNote->active):?>
    	<?= $this->Form->postLink(
        		'<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete'),
                ['action' => 'delete', $userNote->id],
                ['confirm' => __('Are you sure you want to delete this note?'), 'escape' => false, 
                 	'class' => 'btn btn-danger', 'title' => __('Delete')]
            )
        ?><?php endif;?>
		
      </div>
    </div>
    <div class='box-body'>
    <?= $this->Form->create($userNote); ?>
        <?php
        $this->Form->unlockField('_wysihtml5_mode');
            echo $this->Form->input('notes',[ 'class'=>'editor']);
            if($userNote->active == 0){
                echo $this->Form->input('active');
            }
            
        ?>
    <?= $this->Form->button(__('Submit'), ['bootstrap-type' => 'success']) ?>
    <?= $this->Form->end() ?>
</div>
</div>
