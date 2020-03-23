<?php if(!$isAjax):?>
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Add Register') ?></h3>
    	<div class="box-tools pull-right">
    	<?php 
        $back = ($this->request->query('back')) ? $this->request->query('back') :['controller'=>'Users','action' => 'view',$user->id];
        echo $this->Html->link('Back',$back , 
            ['escape' => false, 'class' => 'btn btn-default', 'title' => __('Back')]); ?>
      </div>
    </div>
    <div class='box-body'>
<?php endif;?>
<?php foreach($registerTemplates as $registerTemplate):?>

<div class='box box-success box-solid'>
    <div class='box-header'><h3 class='box-title'><?= $registerTemplate->name ?></h3>
    	<div class="box-tools pull-right">
      </div>
    </div>
    <div class='box-body'>
    <?= $registerTemplate->about ?>
<?= $this->Form->create($register); ?>
    <?php
        echo $this->Form->hidden('register_template_id', [
            'value' => $registerTemplate->id]);
        if(isset($departments[$registerTemplate->id])){
            if(count($departments[$registerTemplate->id])==1){
                $department = $departments[$registerTemplate->id];
                reset($department);
                
                echo $this->Form->hidden('department_id', 
                    ['value'=>key($department)]);
            }else{
                echo $this->Form->input('department_id', ['options' => 
                    $departments[$registerTemplate->id],
                    'empty'=>'(Select Department)']);
            }
        }
        
        echo $this->Form->hidden('status',['value'=>'Pending Submission']);
    ?>
<?= $this->Form->button('Start '.$registerTemplate->name.' Register', ['bootstrap-type' => 'success']) ?>
<?= $this->Form->end() ?>
</div>
</div>

<?php endforeach;?>
<?php if(!$isAjax):?>
</div>
</div>
<?php endif;?>