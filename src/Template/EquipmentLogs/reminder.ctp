
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= ($this->request->param['action'] == 'add')?'Add' : 'Edit'?> <?= $type ?></h3>
    	<div class="box-tools pull-right">
            
            
    	
    	<?= $this->Html->link('Back', ['controller'=>'Equipment','action' => 'view',$equipment->id], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('Back')]) ?>
        
      </div>
    </div>
    <div class='box-body'>
    <?= $this->Form->create($equipmentLog); ?>
        <div class='row'>
            <div class='col-md-6'>
                <?= $this->Form->input('notes',['type'=>'text','label'=>'Remider','required'=>true])?>
            </div>
            <div class='col-md-3'>
                <?= $this->Form->input('alert_date',['type'=>'text','class'=>'datepicker','label'=>'Reminder Date','required'=>true])?>
            </div>
            
        </div>
    <?= $this->Form->button(__('Submit'), ['bootstrap-type' => 'success']) ?>
    <?= $this->Form->end() ?>
</div>
</div>
