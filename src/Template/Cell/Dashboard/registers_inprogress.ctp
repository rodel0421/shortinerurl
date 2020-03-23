<div class='box box-solid box-primary'>
    <div class='box-header'><h3 class='box-title'><?= ($dashboardItem->title) ? h($dashboardItem->title):  __('Registers')  ?></h3>
    	<div class="box-tools pull-right">
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['controller'=>'Registers','action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
      </div>
    </div>
    <div class='box-body dashboardModule'>
    <ul class="list-group list-group-unbordered">
        <?php 
        foreach ($registers as $register): ?>
        <li class="list-group-item">
            <a href="<?= $this->Url->build(['controller'=>'Registers','action'=>'view',$register->id])?>" class="product-title"><?= $register->register_template->name?>
              <span class="label label-default pull-right"><?= $register->user->name?></span></a>
        </li>
        <?php 
        endforeach; ?>
    </ul>
</div>
    <div class="box-footer text-center">
    <?= $this->Html->link('See All',['controller'=>'Registers','action'=>'index','filter'=>1,'status'=>'In Progress'])?>
    </div>
</div>