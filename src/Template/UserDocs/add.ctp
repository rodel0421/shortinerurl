
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Add Document for ') ?><?= $user->name?></h3>
    	<div class="box-tools pull-right">
    	<?php 
        $back = ($this->request->query('back')) ? $this->request->query('back') :['controller'=>'Users','action' => 'view',$user->id];
        echo $this->Html->link('Back',$back , 
            ['escape' => false, 'class' => 'btn btn-default', 'title' => __('Back')]); ?>
        
      </div>
    </div>
    <div class='box-body'>
    <?= $this->Form->create($userDoc, ['type' => 'file']); ?>
        <div class='row'>
            <div class='col-md-3'><?php
            echo $this->Form->input('name');
        ?></div>
            <?php if($isAdmin || $isOfficer):?>
            <div class='col-md-1'><?= $this->Form->input('private',['label'=>'Office Only'])?></div>
            <?php endif;?>
            
            <div class='col-md-6'><?= $this->Form->input('file_url', [
                'type' => 'file',
                'help'=>'.pdf, .gif, .jpg, .png, .jpeg, .csv (max file size 5Mb)',
                'label' => 'Upload Document'
                ])?></div>
        </div>
    <?= $this->Form->button(__('Submit'), ['bootstrap-type' => 'success']) ?>
    <?= $this->Form->end() ?>
</div>
</div>
