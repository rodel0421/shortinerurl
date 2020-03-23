
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= ($this->request->param['action'] == 'add')?'Add' : 'Edit'?> <?= $type ?></h3>
    	<div class="box-tools pull-right">
            
            
    	
    	<?= $this->Html->link('Back', ['controller'=>'Equipment','action' => 'view',$equipment->id], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('Back')]) ?>
        
      </div>
    </div>
    <div class='box-body'>
    <?= $this->Form->create($equipmentLog, ['type' => 'file']); ?>
        <div class='row'>
            <div class='col-md-6'>
            <?= $this->Form->input('file_url', [
                'type' => 'file',
                'help'=>'.pdf, .gif, .jpg, .png, .jpeg, .csv (max file size 5Mb)',
                'label' => 'Upload Document'
                ])?></div>
            <div class='col-md-3'>
                <?= $this->Form->input('alert_date',['type'=>'text','class'=>'datepicker','label'=> 'Review Date'])?>
            </div>
            <div class='col-md-3'>
                <?= $this->Form->input('public')?>
            </div>
        </div>
    <?= $this->Form->button(__('Submit'), ['bootstrap-type' => 'success']) ?>
    <?= $this->Form->end() ?>
</div>
</div>
