
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Edit User Cost Center') ?></h3>
    	<div class="box-tools pull-right">
    	
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
                 		
    	        <?= $this->Form->postLink(
        		'<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete'),
                ['action' => 'delete', $userCostCenter->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', 
                $userCostCenter->id), 'escape' => false, 
                 	'class' => 'btn btn-danger', 'title' => __('Delete')]
            )
        ?>
		
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
    <?= $this->Form->create($userCostCenter); ?>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('title');
            echo $this->Form->input('code');
            echo $this->Form->input('active');
        ?>
    <?= $this->Form->button(__('Submit'), ['bootstrap-type' => 'success']) ?>
    <?= $this->Form->end() ?>
</div>
</div>
