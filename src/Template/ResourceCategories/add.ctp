
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Add Resource Category') ?></h3>
    	<div class="box-tools pull-right">
    	
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
                 		
    	
        <div class="btn-group">
          <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
          <ul class="dropdown-menu" role="menu">
						        <li><?= $this->Html->link(__('List Resources Tags'), 
			        	['controller' => 'ResourcesTags', 'action' => 'index']) ?> </li>
			        <li><?= $this->Html->link(__('New Resources Tag'), 
			        	['controller' => 'ResourcesTags', 'action' => 'add']) ?> </li>
			         </ul>
        </div>
      </div>
    </div>
    <div class='box-body'>
    <?= $this->Form->create($resourceCategory); ?>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('description');
        ?>
    <?= $this->Form->button(__('Submit'), ['bootstrap-type' => 'success']) ?>
    <?= $this->Form->end() ?>
</div>
</div>
