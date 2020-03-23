<div class='box box-solid box-primary'>
    <div class='box-header'><h3 class='box-title'><?= ($dashboardItem->title) ? h($dashboardItem->title):  __('Bookings - Pending Approval')  ?></h3>
    	<div class="box-tools pull-right">
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['controller'=>'Bookings','action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
      </div>
    </div>
    <div class='box-body dashboardModule'>
    <ul class="list-group list-group-unbordered">
        <?php 
        foreach ($bookings as $booking): ?>
        <li class="list-group-item">
            <a href="<?= $this->Url->build(['controller'=>'Bookings','action'=>'view',$booking->id])?>" class="product-title">
                <i class="fa fa-map-o"></i>
                <?= ($booking->supervisor_check)?'<i class="fa fa-check-square text-success" title="Supervisor Approved"></i>':''?>
                <?= $booking->has('user') ? $booking->user->name : '' ?>
                <?= $booking->has('booking_templates') ? $booking->booking_templates->title : '' ?>
              <span class="label label-default pull-right"><?= $booking->start_date?><?= ($booking->start_date > $booking->end_date)? ' ~ '.$booking->end_date:''?></span></a>
        </li>
        <?php 
        endforeach; ?>
    </ul>
</div>
    <div class="box-footer text-center">
    <?= $this->Html->link('See All',['controller'=>'Bookings','action'=>'index','filter'=>1,'Bookings[status]'=>'Pending Approval'])?>
    </div>
</div>