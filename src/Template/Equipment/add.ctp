
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Add Equipment') ?></h3>
    	<div class="box-tools pull-right">
    	
        <?php 
        if($this->request->query('back')){
            echo $this->Html->link('Back',$this->request->query('back') , 
                ['escape' => false, 'class' => 'btn btn-default', 'title' => __('Back')]);
        } ?>    
            
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
                 		
    	
        
      </div>
    </div>
    <div class='box-body'>
    <?= $this->Form->create($equipment); ?>
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
