
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Add Facility') ?></h3>
    	<div class="box-tools pull-right">
    	
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
                 
      </div>
    </div>
    <div class='box-body'>
    <?= $this->Form->create($facility); ?>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('abv');
            echo $this->Form->input('description');
            echo $this->Form->input('notes');
            echo $this->Form->input('bookings_email');
            echo $this->Form->input('users_email');
            echo $this->Form->input('enabled_areas',[
                'options'=>$areas,
                'multiple'=>true,
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