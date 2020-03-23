
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Edit Dashboard Item') ?></h3>
    	<div class="box-tools pull-right">
    	
    	<?= $this->Html->link('Back', ['controller'=>'Dashboards','action' => 'edit',$dashboardItem->dashboard_id], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('Back')]) ?>
                 		
    	
      </div>
    </div>
    <div class='box-body'>
    <?= $this->Form->create($dashboardItem); ?>
        <?php
            $title = '';
            if(empty($dashboardItem->title)){
                $title = (isset($dashboard_items[$dashboardItem->name])) ? h($dashboard_items[$dashboardItem->name]): h($dashboardItem->name);
            }
        
            echo $this->Form->input('title',['default'=>$title]);
            
            echo $this->Form->input('filter_type',[
                'options'=>$filter_types,
                'empty'=>'Default'
            ]);
        ?>
        <div class="department_filter">
            <?= $this->Form->input('filter_value',[
                'label'=>'Filter to Department',
                'class'=>'select3',
                'empty'=>true,
                'options'=>$departments
            ]);?>
        </div>
    <?= $this->Form->button(__('Submit'), ['bootstrap-type' => 'success']) ?>
    <?= $this->Form->end() ?>
</div>
</div>
<script type="text/javascript"> 
//<![CDTA[

$(document).ready(function(){
    
    $('.select3').selectize();
    
    $('#filter-type').on('change',function(){
        if($(this).val() == 'department3'){
            $('.department_filter').show();
            $('#filter-value').prop('required',true);
        }else{
            $('.department_filter').hide();
            $('#filter-value').prop('required',false);
        }
    }).trigger('change');
    
});



//]]>
</script>