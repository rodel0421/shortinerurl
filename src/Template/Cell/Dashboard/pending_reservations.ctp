<div class='box box-solid box-primary'>
    <div class='box-header'><h3 class='box-title'><?= ($dashboardItem->title) ? h($dashboardItem->title):  __('Equipment Reservations - Pending Approval')  ?></h3>
    	<div class="box-tools pull-right">
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['controller'=>'EquipmentReservations','action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
      </div>
    </div>
    <div class='box-body dashboardModule'>
    <ul class="list-group list-group-unbordered">
        <?php 
        foreach ($equipment_reservations as $equipment_reservation): ?>
        <li class="list-group-item">
            <a href="<?= $this->Url->build(['controller'=>'EquipmentReservations','action'=>'view',$equipment_reservation->id])?>" class="product-title">
                <?= $equipment_reservation->has('equipment') ? $equipment_reservation->equipment->title : '' ?>
                <?= $equipment_reservation->has('user') ? ' - '.$equipment_reservation->user->name : '' ?>
              <span class="label label-default pull-right"><?= $equipment_reservation->start?></span></a>
        </li>
        <?php 
        endforeach; ?>
    </ul>
</div>
    <div class="box-footer text-center">
    <?= $this->Html->link('See All',['controller'=>'EquipmentReservations','action'=>'index','filter'=>1,'EquipmentReservations[approved]'=>'isnull'])?>
    </div>
</div>