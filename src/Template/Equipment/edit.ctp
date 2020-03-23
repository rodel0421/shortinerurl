
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Edit Equipment') ?></h3>
    	<div class="box-tools pull-right">
    	
        <?= $this->Html->link('Back', ['action' => 'view',$equipment->id], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('Back')]) ?>
                 		    
            
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
                 		
    	<?= $this->Form->postLink(
        		'<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete'),
                ['action' => 'delete', $equipment->id],
                ['confirm' => __('Are you sure you want to delete this?'), 'escape' => false, 
                 	'class' => 'btn btn-danger', 'title' => __('Delete')]
            )
        ?>
		
      </div>
    </div>
    <div class='box-body'>
    <?= $this->Form->create($equipment, ['type' => 'file']); ?>
       <?php $this->Form->unlockField('_wysihtml5_mode');?>
        <div class='row'>
            <div class='col-md-3'><?= $this->Form->input('title')?></div>
            <div class='col-md-3'><?= $this->Form->input('equipment_type_id', ['options' => $equipmentTypes,'empty'=>true])?></div>
            <div class='col-md-3'><?= $this->Form->input('model')?></div>
            <div class='col-md-3'><?= $this->Form->input('make')?></div>
        </div>
        <div class='row'>
            <div class='col-md-3'><?= $this->Form->input('serial')?></div>
            <div class='col-md-3'><?= $this->Form->input('asset')?></div>
            <div class='col-md-3'><?= $this->Form->input('part_number')?></div>
            <div class='col-md-3'><?= $this->Form->input('location')?></div>
        </div>
        <div class='row'>
            <div class='col-md-6'><?= $this->Form->input('picture_url', [
                'type' => 'file',
                'help'=>'.gif, .jpg, .png, .jpeg (max file size 500kb)',
                'label' => 'Equipment Picture'
                ])?></div>
        </div>
        
        <div class='row'>
            <?php if($equipment->has('equipment_type') && $equipment->equipment_type->serviceable): ?>
            <div class='col-md-3'><?= $this->Form->input('last_service',['type'=>'text','class'=>'datepicker'])?></div>
            <div class='col-md-3'><?= $this->Form->input('next_service',['type'=>'text','class'=>'datepicker'])?></div>
            <?php endif;?>
            <?php if($equipment->has('equipment_type') && $equipment->equipment_type->track_usage): ?>
            <div class='col-md-3'><?= $this->Form->input('usage_hours',['label'=>'Current Hours'])?></div>
            <div class='col-md-3'><?= $this->Form->input('usage_km',['label'=>'Current Km'])?></div>
            <?php endif;?>
        </div>
        
        <div class='row'>
            <div class='col-md-12'><?= $this->Form->input('notes',[ 'class'=>'editor'])?></div>
        </div>
        
        <div class='row'>
            <div class='col-md-3'><?= $this->Form->input('purchased',['type'=>'text','class'=>'datepicker'])?></div>
            <div class='col-md-3'><?= $this->Form->input('cost')?></div>
            <div class='col-md-3'><?= $this->Form->input('cost_centre')?></div>
            <div class='col-md-3'><?= $this->Form->input('depreciated_over_years')?></div>
        </div>
        
        <div class='row'>
            <div class='col-md-3'><?= $this->Form->input('department_id', ['options' => $departments, 'empty' => true])?></div>
            <div class='col-md-3'><?= $this->Form->input('issued_to')?></div>
        </div>
        <h4>Hire Out</h4>
        <div class='row'>
            <div class='col-md-3'><?= $this->Form->input('for_hire')?></div>
            <div class='col-md-3'><?= $this->Form->input('hire_rate')?></div>
            <div class='col-md-3'><?= $this->Form->input('qty')?></div>
        </div>
        
    <?= $this->Form->button(__('Submit'), ['bootstrap-type' => 'success']) ?>
    <?= $this->Form->end() ?>
</div>
</div>
