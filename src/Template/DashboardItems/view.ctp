
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><span class="glyphicon glyphicon-zoom-in"></span> <?= h($dashboardItem->name) ?></h3>
    	<div class="box-tools pull-right">
    	<?= $this->Html->link('<span class="glyphicon glyphicon-file"></span><span class="sr-only">' . __('New') 
                 		. '</span>', ['action' => 'add'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('New')]) ?>
    	
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
                 		
    	<?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') 
                 		. '</span>', ['action' => 'edit', $dashboardItem->id], 
                 		['escape' => false, 'class' => 'btn btn-warning', 'title' => __('Edit')]) ?>
        <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') 
                 		. '</span>', ['action' => 'delete', $dashboardItem->id], 
                 		['confirm' => __('Are you sure you want to delete # {0}?', $dashboardItem->id), 'escape' => false, 
                 				'class' => 'btn btn-danger', 'title' => __('Delete')]) ?>
    	<?= $this->element('guide', array("section" => 'dashboardItems')) ?>
        <div class="btn-group">
          <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
          <ul class="dropdown-menu" role="menu">
            
        <li><?= $this->Html->link(__('List Dashboards'), ['controller' => 'Dashboards', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Dashboard'), ['controller' => 'Dashboards', 'action' => 'add']) ?> </li>
         </ul>
        </div>
      </div>
    </div>
    <div class='box-body'>
    <?php $footerHtml = '';?>
        <dl class="dl-horizontal">
            <dt><?= __('Dashboard') ?></dt>
            <dd><?= $dashboardItem->has('dashboard') ? $this->Html->link($dashboardItem->dashboard->name, ['controller' => 'Dashboards', 'action' => 'view', $dashboardItem->dashboard->id]) : '' ?></dd>
            <dt><?= __('Name') ?></dt>
            <dd><?= h($dashboardItem->name) ?></dd>
        </dl>
        <dl class="dl-horizontal">
            <dt><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($dashboardItem->id) ?></dd>
            <dt><?= __('Row') ?></dt>
            <dd><?= $this->Number->format($dashboardItem->row) ?></dd>
            <dt><?= __('Col') ?></dt>
            <dd><?= $this->Number->format($dashboardItem->col) ?></dd>
        </dl>
        <dl class="dl-horizontal">
            <?php 
            $footerHtml .= "<b>". __('Created') .":</b> ";
            $footerHtml .= h($dashboardItem->created)." ";
            ?>
            <?php 
            $footerHtml .= "<b>". __('Modified') .":</b> ";
            $footerHtml .= h($dashboardItem->modified)." ";
            ?>
        </dl>
    
</div>
<div class='box-footer'>
    <?= $footerHtml ?>
</div>
</div>
