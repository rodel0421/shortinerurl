
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Edit Certification') ?></h3>
    	<div class="box-tools pull-right">
    	<?= $this->Html->link('Back', ['controller'=>'Users','action' => 'view',$certification->user_id], 
                ['escape' => false, 'class' => 'btn btn-default', 'title' => __('Back')]) ?>

        <?php if($certification->active):?>
    	<?= $this->Form->postLink(
        		'<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete'),
                ['action' => 'delete', $certification->id],
                ['confirm' => __('Are you sure you want to delete this?'), 'escape' => false, 
                 	'class' => 'btn btn-danger', 'title' => __('Delete')]
            )
        ?>
        <?php endif;?>
            
      </div>
    </div>
    <div class='box-body'>
    
        <?php if($certification->valid):?>
        <?= $this->Form->create($certification); ?>
        <div class="alert alert-info alert-dismissable">
        <i class="fa fa-exclamation-circle"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <b>The Certification has been validated, certain fields are locked.</b>
            <?= $this->Form->hidden('valid',['value'=>0])?>
            <?= $this->Form->button(__('Remove Validation'), ['bootstrap-type' => 'warning']) ?>
        </div>
        <?= $this->Form->end() ?>
        <?php endif;?>
        
        <?= $this->Form->create($certification); ?>
        <?php if(!$certification->valid):?>
        <div class='row'>
            <div class='col-md-3'><?= $this->Form->input('certification_type_id', 
                ['options' => $certificationTypes,'empty'=>'(Select Certificaton Type)'])?></div>
            <div class='col-md-3'><?= $this->Form->input('issuer')?></div>
            <div class='col-md-3'><?= $this->Form->input('issued',
                ['type'=>'text','class'=>'datepicker'])?></div>
            <div class='col-md-3'><?= $this->Form->input('expires',
                ['type'=>'text','class'=>'datepicker'])?></div>
        </div>
        <?php endif;?>
        <div class='row'>
            <div class='col-md-6'><?= $this->Form->input('notes')?></div>
        </div>
        <div class='row'>
            <div class='col-md-6'><?= $this->Form->input('active')?></div>
        </div>
    <?= $this->Form->button(__('Submit'), ['bootstrap-type' => 'success']) ?>
    <?= $this->Form->end() ?>
</div>
</div>
