<?php $this->assign('title', 'Equipment Types');?>
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Edit Equipment Type') ?></h3>
    	<div class="box-tools pull-right">
    	
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
                 		
    	<?= $this->Form->postLink(
        		'<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete'),
                ['action' => 'delete', $equipmentType->id],
                ['confirm' => __('Are you sure you want to delete this?'), 'escape' => false, 
                 	'class' => 'btn btn-danger', 'title' => __('Delete')]
            )
        ?>
      </div>
    </div>
    <div class='box-body'>
    <?= $this->Form->create($equipmentType, ['type' => 'file']); ?>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('category',[
                    'class'=>'select3-combo',
                    'options'=>$categories,
                    'empty'=>true]);
            echo $this->Form->input('icon', [
                'type' => 'file',
                'help'=>'.gif, .jpg, .png, .jpeg',
                'label' => 'Upload Icon'
                ]);
            
            echo $this->Form->input('image', [
                'type' => 'file',
                'help'=>'.gif, .jpg, .png, .jpeg',
                'label' => 'Upload Picture'
                ]);
            
            $this->Form->unlockField('data');
            echo $this->Form->hidden('data',['id'=>'custom-data']);
            
            echo $this->Form->input('serviceable',['label'=>'Show and track last service and next service dates']);
            echo $this->Form->input('track_usage',['label'=>'Show and track hours and KM']);
            
            echo $this->Form->input('hourly_booking',['label'=>'Hourly Booking: The default for reserving equipment is per day. Selecting this will allow reserving equipment to the hour.']);
                       
            echo $this->Form->input('auto_approval');
            
            echo $this->Form->input('user_equipment');
            
        ?>
        <h3>Custom Fields</h3>
        <p>To add custom fields to this equipment type. Fill in the subform below and select add. You can have as many custom fields as you like.</p>
        
        <table class='table'>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Help Text</th>
                    <th>Required</th>
                    <td>&nbsp;</td>
                </tr>
            </thead>
            <tbody id='customDataDisplay'>
                
            </tbody>
            <tfoot id='custom-form'>
                <tr>
                    <td><?= $this->Form->input('custom_name',['label'=>false,'type'=>'text','id'=>'custom-name'])?></td>
                    <td><?= $this->Form->input('custom_type',['label'=>false,'id'=>'custom-type',
                'options'=>[
                    'text'=>'text',
                    'number'=>'number',
                    'date'=>'date',
                    'time'=>'time',
                    'textarea'=>'textarea']
                ])?></td>
                    <td><?= $this->Form->input('custom_help',['label'=>false,'type'=>'text','id'=>'custom-help'])?></td>
                    <td><?= $this->Form->input('custom_required',['label'=>'Required','type'=>'checkbox','id'=>'custom-required'])?></td>
                    <td><a href='#' class='btn btn-success' id='add-new-custom'>Add</a></td>
                </tr>
            </tfoot>
        </table>
    <?= $this->Form->button(__('Submit'), ['bootstrap-type' => 'success']) ?>
    <?= $this->Form->end() ?>
</div>
</div>
<script type="text/javascript"> 
//<![CDTA[
var currentData = [];

$(document).ready(function(){
    
    try {
        currentData = JSON.parse($('#custom-data').val());
        showCustomData();
    } catch (e) {

    }
    
    $('.select3-combo').selectize({create: true});
    
    
    $('#add-new-custom').click(function(){
        $('#custom-name').parent().removeClass('has-error');
        
        var row = {};
        row.custom_name = $('#custom-name').val();
        row.custom_type = $('#custom-type').val();
        row.custom_help = $('#custom-help').val();
        row.custom_required = $('#custom-required').prop('checked');
        
        //if has name
        if(row.custom_name){
            currentData.push(row);
            //console.log(current);
            $('#custom-data').val(JSON.stringify(currentData));
            $('#custom-form').find('input[type=text], textarea').val('');
            showCustomData();
        }else{
            $('#custom-name').parent().addClass('has-error');
            $('#custom-name').focus();
        }
        
        
    });
    
});

function showCustomData(){
    $('#customDataDisplay').empty();
    $.each(currentData, function( index, row ) {
        var markup = "<tr><td>" + row.custom_name + "</td><td>" + 
            row.custom_type + "</td><td>" + 
            row.custom_help + "</td><td>" + 
            ((row.custom_required == 1) ? 'Yes' : 'No') + "</td><td>"+
            '<a href="#" class="remove-custom btn btn-warning" onclick="removeCustom('+index+')">Remove</a>'
            +"</td></tr>";
    
        $('#customDataDisplay').append(markup);
    });
}

function removeCustom(index){
    if (index > -1) {
        currentData.splice(index, 1);
        $('#custom-data').val(JSON.stringify(currentData));
        showCustomData();
    }
}

//]]>
</script>