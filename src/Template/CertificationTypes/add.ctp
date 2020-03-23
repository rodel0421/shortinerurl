
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Add Certification Type') ?></h3>
    	<div class="box-tools pull-right">
    	
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
        
      </div>
    </div>
    <div class='box-body'>
    <?= $this->Form->create($certificationType); ?>
        <?php
            echo $this->Form->input('category',['class'=>'select3-combo','options'=>$categories,'empty'=>true]);
            echo $this->Form->input('type',['class'=>'select3-combo','options'=>$types,'empty'=>true]);
            echo $this->Form->input('name');
            echo $this->Form->input('certification_class_id', ['options' => $certificationClasses, 'empty' => true]);
            echo $this->Form->input('description');
        ?>
    <?= $this->Form->button(__('Submit'), ['bootstrap-type' => 'success']) ?>
    <?= $this->Form->end() ?>
</div>
</div>
<script type="text/javascript"> 
//<![CDTA[

$(document).ready(function(){
    $('.select3-combo').selectize({create: true});
    
});


//]]>
</script>