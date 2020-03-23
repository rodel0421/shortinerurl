<div class='box box-solid box-primary'>
    <div class='box-header'><h3 class='box-title'><?= ($dashboardItem->title) ? h($dashboardItem->title):  __('Upcoming Services')  ?></h3>
    	<div class="box-tools pull-right">
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['controller'=>'Equipment','action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
      </div>
    </div>
    <div class='box-body dashboardModule'>
    <ul class="list-group list-group-unbordered">
        <?php 
        foreach ($equipment as $equipment): ?>
        <li class="list-group-item">
            <a href="<?= $this->Url->build(['controller'=>'Equipment','action'=>'view',$equipment->id])?>" class="product-title"><?= $equipment->title?>
              <span class="label label-warning pull-right"><?= $equipment->next_service ?></span></a>
        </li>
        <?php 
        endforeach; ?>
    </ul>
</div>
    <div class="box-footer text-center">
    <?= $this->Html->link('See All',['controller'=>'Equipment','action'=>'index','filter'=>1,'service'=>'+2 months'])?>
    </div>
</div>