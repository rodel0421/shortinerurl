
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Edit Facility') ?></h3>
    	<div class="box-tools pull-right">
    	
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
                 		
    	        <?= $this->Form->postLink(
        		'<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete'),
                ['action' => 'delete', $facility->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', 
                $facility->id), 'escape' => false, 
                 	'class' => 'btn btn-danger', 'title' => __('Delete')]
            )
        ?>
		
      </div>
    </div>
    <div class='box-body'>
    <?= $this->Form->create($facility); ?>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('abv');
            echo $this->Form->input('description');
            echo $this->Form->input('notes');
            echo $this->Form->input('users_email');
            echo $this->Form->input('enabled_areas',[
                'options'=>$areas,
                'multiple'=>true,
                'class'=>'select3']);
            
            ?>
        <h3>Bookings</h3>
        <?php
            echo $this->Form->input('bookings_email');
            echo $this->Form->input('bookings_max_ppl');
            
            $this->Form->unlockField('bookings_calendar');
            echo $this->Form->hidden('bookings_calendar',['id'=>'custom-data']);
        ?>
        <h3>Custom Calendar Colours</h3>
        <p>To add custom display colours to the booking calendar. 
            Fill in the subform below and select add. 
            You can have as many custom colours as you like.
        </p>
        
        <table class='table'>
            <thead>
                <tr>
                    <th>From</th>
                    <th>To</th>
                    <th>Background Colour</th>
                    <th>Text Colour</th>
                    <td>&nbsp;</td>
                </tr>
            </thead>
            <tbody id='customDataDisplay'>
                
            </tbody>
            <tfoot id='custom-form'>
                <tr>
                    <td><?= $this->Form->input('custom_from',['label'=>false,'type'=>'number','id'=>'custom-from'])?></td>
                    <td><?= $this->Form->input('custom_to',['label'=>false,'type'=>'number','id'=>'custom-to'])?></td>
                    <td><?= $this->Form->input('custom_background',['label'=>false,'type'=>'text','id'=>'custom-background','class'=>'colorpicker'])?></td>
                    <td><?= $this->Form->input('custom_colour',['label'=>false,'type'=>'text','id'=>'custom-colour','class'=>'colorpicker'])?></td>
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
    $('.select3').selectize();
    $('.colorpicker').colorpicker()
    
    try {
        currentData = JSON.parse($('#custom-data').val());
        showCustomData();
    } catch (e) {

    }
    
    $('.select3-combo').selectize({create: true});
    
    
    $('#add-new-custom').click(function(){
        event.preventDefault();
        $('#custom-from').parent().removeClass('has-error');
        
        var row = {};
        row.custom_from = $('#custom-from').val();
        row.custom_to = $('#custom-to').val();
        row.custom_background = $('#custom-background').val();
        row.custom_colour = $('#custom-colour').val();
        
        //if has name
        if(row.custom_from && row.custom_to && row.custom_background && row.custom_colour){
            currentData.push(row);
            //console.log(current);
            currentData.sort(function(a, b){
                return a.custom_from - b.custom_from;
            });
            $('#custom-data').val(JSON.stringify(currentData));
            $('#custom-form').find('input[type=number],input[type=text], textarea').val('');
            showCustomData();
        }else{
            $('#custom-from').parent().addClass('has-error');
            $('#custom-from').focus();
        }
        
        return false;
    });
    
});

function showCustomData(){
    $('#customDataDisplay').empty();
    $.each(currentData, function( index, row ) {
        var markup = "<tr style='background-color:"
                +row.custom_background+";color:"+row.custom_colour
                +";'><td>" + row.custom_from + "</td><td>" + 
            row.custom_to + "</td><td>" + 
            row.custom_background + "</td><td>" + 
            row.custom_colour + "</td><td>" + 
            '<a href="#" class="remove-custom btn btn-warning" onclick="removeCustom('+index+')">Remove</a>'
            +"</td></tr>";
    
        $('#customDataDisplay').append(markup);
    });
}

function removeCustom(index){
    event.preventDefault();
    if (index > -1) {
        var row = currentData.splice(index, 1);
        
        $('#custom-from').val(row[0].custom_from);
        $('#custom-to').val(row[0].custom_to);
        $('#custom-background').val(row[0].custom_background);
        $('#custom-colour').val(row[0].custom_colour);
        
        $('#custom-data').val(JSON.stringify(currentData));
        showCustomData();
    }
    return false;
}

//]]>
</script>