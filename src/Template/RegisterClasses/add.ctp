
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Add Register Class for ') ?><?= h($registerTemplate->name)?></h3>
    	<div class="box-tools pull-right">
    	
    	<?= $this->Html->link('Back', ['controller'=>'RegisterTemplates','action' => 'view',$registerTemplate->id], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('Back')]) ?>
        
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
