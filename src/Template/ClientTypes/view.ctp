
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><span class="glyphicon glyphicon-zoom-in"></span> <?= h($clientType->title) ?></h3>
    	<div class="box-tools pull-right">
    	<?= $this->Html->link('<span class="glyphicon glyphicon-file"></span><span class="sr-only">' . __('New') 
                 		. '</span>', ['action' => 'add'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('New')]) ?>
    	
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
                 		
    	<?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') 
                 		. '</span>', ['action' => 'edit', $clientType->id], 
                 		['escape' => false, 'class' => 'btn btn-warning', 'title' => __('Edit')]) ?>
        <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') 
                 		. '</span>', ['action' => 'delete', $clientType->id], 
                 		['confirm' => __('Are you sure you want to delete # {0}?', $clientType->id), 'escape' => false, 
                 				'class' => 'btn btn-danger', 'title' => __('Delete')]) ?>
    	<?= $this->element('guide', array("section" => 'clientTypes')) ?>
        <div class="btn-group">
          <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
          <ul class="dropdown-menu" role="menu">
            
        <li><?= $this->Html->link(__('List Facilities'), ['controller' => 'Facilities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Facility'), ['controller' => 'Facilities', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Booking Fees'), ['controller' => 'BookingFees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Booking Fee'), ['controller' => 'BookingFees', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Booking Personnel'), ['controller' => 'BookingPersonnel', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Booking Personnel'), ['controller' => 'BookingPersonnel', 'action' => 'add']) ?> </li>
         </ul>
        </div>
      </div>
    </div>
    <div class='box-body'>
    <?php $footerHtml = '';?>
        <dl class="dl-horizontal">
            <dt><?= __('Title') ?></dt>
            <dd><?= h($clientType->title) ?></dd>
            <dt><?= __('Facility') ?></dt>
            <dd><?= $clientType->has('facility') ? $this->Html->link($clientType->facility->title, ['controller' => 'Facilities', 'action' => 'view', $clientType->facility->id]) : '' ?></dd>
            <dt><?= __('Description') ?></dt>
            <dd><?= h($clientType->description) ?></dd>
        </dl>
        <dl class="dl-horizontal">
            <dt><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($clientType->id) ?></dd>
            <dt><?= __('Active') ?></dt>
            <dd><?= $this->Number->format($clientType->active) ?></dd>
        </dl>
        <dl class="dl-horizontal">
            <?php 
            $footerHtml .= "<b>". __('Created') .":</b> ";
            $footerHtml .= h($clientType->created)." ";
            ?>
            <?php 
            $footerHtml .= "<b>". __('Modified') .":</b> ";
            $footerHtml .= h($clientType->modified)." ";
            ?>
        </dl>
    
</div>
<div class='box-footer'>
    <?= $footerHtml ?>
</div>
</div>
<div class='box box-info'>
    <div class='box-header'><h3 class='box-title'><?= __('Related BookingFees') ?></h3>
    	<div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class='box-body'>
    <?php if (!empty($clientType->booking_fees)): ?>
    <div class="">
    <table class="table table-bordered table-hover data-table">
    <thead>
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Facility Id') ?></th>
            <th><?= __('Booking Item Id') ?></th>
            <th><?= __('Client Type Id') ?></th>
            <th><?= __('Name') ?></th>
            <th><?= __('Category') ?></th>
            <th><?= __('Min') ?></th>
            <th><?= __('Max') ?></th>
            <th><?= __('Cost') ?></th>
            <th><?= __('Unit') ?></th>
            <th><?= __('Active') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($clientType->booking_fees as $bookingFees): ?>
        <tr>
            <td><?= h($bookingFees->id) ?></td>
            <td><?= h($bookingFees->facility_id) ?></td>
            <td><?= h($bookingFees->booking_item_id) ?></td>
            <td><?= h($bookingFees->client_type_id) ?></td>
            <td><?= h($bookingFees->name) ?></td>
            <td><?= h($bookingFees->category) ?></td>
            <td><?= h($bookingFees->min) ?></td>
            <td><?= h($bookingFees->max) ?></td>
            <td><?= h($bookingFees->cost) ?></td>
            <td><?= h($bookingFees->unit) ?></td>
            <td><?= h($bookingFees->active) ?></td>
            <td><?= h($bookingFees->created) ?></td>
            <td><?= h($bookingFees->modified) ?></td>

            <td class="actions">
                 <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') 
                 		. '</span>', ['controller' => 'BookingFees', 'action' => 'view', $bookingFees->id], 
                 		['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('View')]) ?>
                 <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') 
                 		. '</span>', ['controller' => 'BookingFees', 'action' => 'edit', $bookingFees->id], 
                 		['escape' => false, 'class' => 'btn btn-xs btn-warning', 'title' => __('Edit')]) ?>
                 <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') 
                 		. '</span>', ['controller' => 'BookingFees', 'action' => 'delete', $bookingFees->id], 
                 		['confirm' => __('Are you sure you want to delete # {0}?', $clientType->id), 'escape' => false, 
                 				'class' => 'btn btn-xs btn-danger', 'title' => __('Delete')]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <?php endif; ?>
    </div>
</div>
<div class='box box-info'>
    <div class='box-header'><h3 class='box-title'><?= __('Related BookingPersonnel') ?></h3>
    	<div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class='box-body'>
    <?php if (!empty($clientType->booking_personnel)): ?>
    <div class="">
    <table class="table table-bordered table-hover data-table">
    <thead>
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Booking Id') ?></th>
            <th><?= __('User Id') ?></th>
            <th><?= __('Client Type Id') ?></th>
            <th><?= __('Name') ?></th>
            <th><?= __('Email') ?></th>
            <th><?= __('From') ?></th>
            <th><?= __('Transfer Required') ?></th>
            <th><?= __('To') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($clientType->booking_personnel as $bookingPersonnel): ?>
        <tr>
            <td><?= h($bookingPersonnel->id) ?></td>
            <td><?= h($bookingPersonnel->booking_id) ?></td>
            <td><?= h($bookingPersonnel->user_id) ?></td>
            <td><?= h($bookingPersonnel->client_type_id) ?></td>
            <td><?= h($bookingPersonnel->name) ?></td>
            <td><?= h($bookingPersonnel->email) ?></td>
            <td><?= h($bookingPersonnel->from) ?></td>
            <td><?= h($bookingPersonnel->transfer_required) ?></td>
            <td><?= h($bookingPersonnel->to) ?></td>
            <td><?= h($bookingPersonnel->created) ?></td>
            <td><?= h($bookingPersonnel->modified) ?></td>

            <td class="actions">
                 <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') 
                 		. '</span>', ['controller' => 'BookingPersonnel', 'action' => 'view', $bookingPersonnel->id], 
                 		['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('View')]) ?>
                 <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') 
                 		. '</span>', ['controller' => 'BookingPersonnel', 'action' => 'edit', $bookingPersonnel->id], 
                 		['escape' => false, 'class' => 'btn btn-xs btn-warning', 'title' => __('Edit')]) ?>
                 <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') 
                 		. '</span>', ['controller' => 'BookingPersonnel', 'action' => 'delete', $bookingPersonnel->id], 
                 		['confirm' => __('Are you sure you want to delete # {0}?', $clientType->id), 'escape' => false, 
                 				'class' => 'btn btn-xs btn-danger', 'title' => __('Delete')]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <?php endif; ?>
    </div>
</div>
