<div class='box box-solid box-primary'>
    <div class='box-header'><h3 class='box-title'><?= ($dashboardItem->title) ? h($dashboardItem->title):  __('Trips - Pending Approval')  ?></h3>
    	<div class="box-tools pull-right">
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['controller'=>'Trips','action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
      </div>
    </div>
    <div class='box-body dashboardModule'>
    <ul class="list-group list-group-unbordered">
        <?php 
        foreach ($trips as $trip): ?>
        <li class="list-group-item">
            <a href="<?= $this->Url->build(['controller'=>'Trips','action'=>'view',$trip->id])?>" class="product-title">
                
                <i class="fa fa-map-o" title='<?= h($trip->location)?>' ></i>
                <i class="fa fa-user" title='<?= $trip->has('user') ? $trip->user->name : '' ?>' ></i>
                
                <?php 
                    $types=[]; 
                    foreach($trip->trip_types as $trip_type){
                        $types[] = h($trip_type->title);
                    }?>
                <span title='Activities: <?= (!empty($types))? implode(', ',$types) :''; ?>'>
                <i class="fa fa-info-circle"></i>
                <?= h($trip->title) ?>
                </span>
                <?php 
                if(isset($trip->supervisor_check)){
                    echo ($trip->supervisor_check)?
                    ' <i class="fa fa-check-square text-success" title="Supervisor Approved"></i>':
                    ' <i class="fa fa-times text-red" title="Supervisor Not Approved"></i>';
                }
                ?>
                
              <span class="label label-default pull-right">
                    <?= $trip->start_date?><?= ($trip->start_date > $trip->end_date)? ' ~ '.$trip->end_date:''?>
              </span></a>
        </li>
        <?php 
        endforeach; ?>
    </ul>
</div>
    <div class="box-footer text-center">
    <?= $this->Html->link('See All',['controller'=>'Trips','action'=>'index','filter'=>1,'Trips[status]'=>'Pending'])?>
    </div>
</div>