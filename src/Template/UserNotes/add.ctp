
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Add User Note') ?></h3>
    	<div class="box-tools pull-right">
    	
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
                 		
    	
        <div class="btn-group">
          <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
          <ul class="dropdown-menu" role="menu">
						        <li><?= $this->Html->link(__('List Users'), 
			        	['controller' => 'Users', 'action' => 'index']) ?> </li>
			        <li><?= $this->Html->link(__('New User'), 
			        	['controller' => 'Users', 'action' => 'add']) ?> </li>
			         </ul>
        </div>
      </div>
    </div>
    <div class='box-body'>
    <?= $this->Form->create($userNote); ?>
        <?php
            echo $this->Form->input('created_by');
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('type');
            echo $this->Form->input('notes');
            echo $this->Form->input('internal');
            echo $this->Form->input('active');
        ?>
    <?= $this->Form->button(__('Submit'), ['bootstrap-type' => 'success']) ?>
    <?= $this->Form->end() ?>
</div>
</div>
