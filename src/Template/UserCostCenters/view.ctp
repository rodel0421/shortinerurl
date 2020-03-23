
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><span class="glyphicon glyphicon-zoom-in"></span> <?= h($userCostCenter->title) ?></h3>
    	<div class="box-tools pull-right">
    	<?= $this->Html->link('<span class="glyphicon glyphicon-file"></span><span class="sr-only">' . __('New') 
                 		. '</span>', ['action' => 'add'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('New')]) ?>
    	
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
                 		
    	<?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') 
                 		. '</span>', ['action' => 'edit', $userCostCenter->id], 
                 		['escape' => false, 'class' => 'btn btn-warning', 'title' => __('Edit')]) ?>
        <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') 
                 		. '</span>', ['action' => 'delete', $userCostCenter->id], 
                 		['confirm' => __('Are you sure you want to delete # {0}?', $userCostCenter->id), 'escape' => false, 
                 				'class' => 'btn btn-danger', 'title' => __('Delete')]) ?>
    	<?= $this->element('guide', array("section" => 'userCostCenters')) ?>
        <div class="btn-group">
          <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
          <ul class="dropdown-menu" role="menu">
            
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
         </ul>
        </div>
      </div>
    </div>
    <div class='box-body'>
    <?php $footerHtml = '';?>
        <dl class="dl-horizontal">
            <dt><?= __('User') ?></dt>
            <dd><?= $userCostCenter->has('user') ? $this->Html->link($userCostCenter->user->name, ['controller' => 'Users', 'action' => 'view', $userCostCenter->user->id]) : '' ?></dd>
            <dt><?= __('Title') ?></dt>
            <dd><?= h($userCostCenter->title) ?></dd>
            <dt><?= __('Code') ?></dt>
            <dd><?= h($userCostCenter->code) ?></dd>
        </dl>
        <dl class="dl-horizontal">
            <dt><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($userCostCenter->id) ?></dd>
        </dl>
        <dl class="dl-horizontal">
            <?php 
            $footerHtml .= "<b>". __('Created') .":</b> ";
            $footerHtml .= h($userCostCenter->created)." ";
            ?>
            <?php 
            $footerHtml .= "<b>". __('Modified') .":</b> ";
            $footerHtml .= h($userCostCenter->modified)." ";
            ?>
        </dl>
        <dl class="dl-horizontal">
            <dt><?= __('Active') ?></dt>
            <dd><?= $userCostCenter->active ? __('Yes') : __('No'); ?></dd>
        </dl>
    
</div>
<div class='box-footer'>
    <?= $footerHtml ?>
</div>
</div>
