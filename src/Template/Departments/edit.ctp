
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Edit Department') ?></h3>
    	<div class="box-tools pull-right">
    	
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
                 		
    	<?= $this->Form->postLink(
        		'<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete'),
                ['action' => 'delete', $department->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', 
                $department->id), 'escape' => false, 
                 	'class' => 'btn btn-danger', 'title' => __('Delete')]
            )
        ?>
	
      </div>
    </div>
    <div class='box-body'>
    <?= $this->Form->create($department); ?>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('description');
            //echo $this->Form->input('email');
            echo $this->Form->input('leaders._ids', ['options' => $users, 'class'=>'select3','label'=>'Managers']);
            echo $this->Form->input('users._ids', ['options' => $users,'class'=>'select3']);
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