
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Add Dashboard') ?></h3>
    	<div class="box-tools pull-right">
    	
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
           
      </div>
    </div>
    <div class='box-body'>
    <?= $this->Form->create($dashboard); ?>
        <?php
            echo $this->Form->input('name');
        ?>
    <?= $this->Form->button(__('Submit'), ['bootstrap-type' => 'success']) ?>
    <?= $this->Form->end() ?>
</div>
</div>
