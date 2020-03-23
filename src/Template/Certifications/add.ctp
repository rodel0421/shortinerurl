
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Add Certification for ') ?><?= $user->name?>
    <?php
    if(isset($replacing)){
        echo ' replacing ';
        echo $replacing->has('certification_type') ? h($replacing->certification_type->name) : ' Certification';
    }
    ?></h3>
    	<div class="box-tools pull-right">
    	<?php 
        $back = ($this->request->query('back')) ? $this->request->query('back') :['controller'=>'Users','action' => 'view',$user->id];
        echo $this->Html->link('Back',$back , 
            ['escape' => false, 'class' => 'btn btn-default', 'title' => __('Back')]); ?>
      </div>
    </div>
    <div class='box-body'>
    <?= $this->Form->create($certification, ['type' => 'file']); ?>
        <div class='row'>
            <div class='col-md-3'>
                <?php
                $default = null;
                if(isset($replacing)){
                    $default = $replacing->certification_type_id;
                }
                
                echo $this->Form->input('certification_type_id', ['options' => $certificationTypes,'empty'=>'(Select Certificaton Type)','default'=>$default])?>
            </div>
            <div class='col-md-3'><?= $this->Form->input('issuer')?></div>
            <div class='col-md-3'><?= $this->Form->input('issued',['type'=>'text','class'=>'datepicker'])?></div>
            <div class='col-md-3'><?= $this->Form->input('expires',['type'=>'text','class'=>'datepicker'])?></div>
        </div>
        <div class='row'>
            <div class='col-md-6'><?= $this->Form->input('file_url', [
                'type' => 'file',
                'help'=>'.pdf, .gif, .jpg, .png, .jpeg (max file size 5Mb)',
                'label' => 'Upload Scanned Document'
                ])?></div>
        </div>
    <?= $this->Form->button(__('Submit'), ['bootstrap-type' => 'success']) ?>
    <?= $this->Form->end() ?>
</div>
</div>
