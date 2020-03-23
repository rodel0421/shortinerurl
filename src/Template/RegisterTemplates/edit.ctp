
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Edit Register Template') ?></h3>
    	<div class="box-tools pull-right">
    	
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
                 		
    	        <?= $this->Form->postLink(
        		'<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete'),
                ['action' => 'delete', $registerTemplate->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', 
                $registerTemplate->id), 'escape' => false, 
                 	'class' => 'btn btn-danger', 'title' => __('Delete')]
            )
        ?>
		
        
      </div>
    </div>
    <div class='box-body'>
    <?= $this->Form->create($registerTemplate); ?>
        <?php
            echo $this->Form->input('name');
            $this->Form->unlockField('_wysihtml5_mode');
            echo $this->Form->input('about',[
                'label'=>'Notes',
                'class'=>'editor',
                'required'=>false]);
            
            echo $this->Form->input('required_forms',[
                'options'=>$formTemplates,
                'multiple'=>true,
                'empty'=>'(None)',
                'class'=>'select3']);
            
            echo $this->Form->input('checklists',['help'=>'One per line']);
            echo $this->Form->input('required_certifications',[
                'label'=>'Required Certifications',
                'options'=>$certificationTypes,
                'multiple'=>true,
                'class'=>'select3']);
            echo $this->Form->input('optional_certifications',[
                'label'=>'Optional / Recommended Certifications',
                'options'=>$certificationTypes,
                'multiple'=>true,
                'class'=>'select3']);
            echo $this->Form->input('departments._ids',[
                'label'=>'Departments managing this register',
                'class'=>'select3']);
            
        ?>
    <?= $this->Form->button(__('Submit'), ['bootstrap-type' => 'success']) ?>
    <?= $this->Form->end() ?>
</div>
</div>
<script type="text/javascript"> 
//<![CDTA[

$(document).ready(function(){
    $('.select3').selectize();
});


//]]>
</script>