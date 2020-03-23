
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Edit Register Form') ?></h3>
    	<div class="box-tools pull-right">
    	
    	<?= $this->Html->link('Back', ['controller'=>'Registers','action' => 'view',$registerForm->register_id], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('Back')]) ?>
                 		
    	        <?= $this->Form->postLink(
        		'<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete'),
                ['action' => 'delete', $registerForm->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', 
                $registerForm->id), 'escape' => false, 
                 	'class' => 'btn btn-danger', 'title' => __('Delete')]
            )
        ?>
		
      </div>
    </div>
    <div class='box-body'>
    <div id="TheForm"><?= $form->form?></div>
    <?= $this->Form->create($registerForm, ['type' => 'file','class'=>'custom-form']); ?>
        <?php
            $this->Form->unlockField('content');
            echo $this->Form->hidden('content',['id'=>'FormData']);
        ?>
         <?php
            echo $this->Form->input('file_url', [
                'type' => 'file',
                'help'=>'.pdf, .gif, .jpg, .png, .jpeg, .csv (max file size 5Mb)',
                'label' => 'Attach Document'
                ]);
        ?>
    <?= $this->Form->button(__('Submit'), ['bootstrap-type' => 'success']) ?>
    <?= $this->Form->end() ?>
</div>
</div>
<script type="text/javascript"> 
//<![CDTA[
    $(document).ready(function(){
        if($('#FormData').val()){
            var $form = $("<div id='specialwrapperthing'>" + $('#FormData').val() + "</div>");
            $("span.ans:not(:empty)",$form).each(function() {
                $id = $(this).attr('data-id');
                $type = $(this).attr('data-type');
                
                if($type=='checkbox' || $type=='radio'){
                    $('#'+$id,'#TheForm').prop('checked', true);
                }else{
                    $('#'+$id,'#TheForm').val($(this).html().replace("<br />","\n").replace("<br>","\n"));
                }
            });
        }
        
        $("form").on('submit', function(e) {
           $submittedFrom = $('#TheForm').clone();
           
            $(":checkbox,:radio",$submittedFrom).replaceWith(function() {
                $type = $( this ).attr('type');
                $id = $( this ).attr('id');
                if($( this ).is(':checked')){
                    return '<span data-type="'+$type+'" data-id="'+$id+'" class="ans">YES</span>';
                }else{
                    return '<span data-type="'+$type+'" data-id="'+$id+'" class="ans">NO</span>';
                }
            });
           
            $(":input",$submittedFrom).replaceWith(function() {
                $type = $( this ).attr('type');
                $id = $( this ).attr('id');
                if(typeof $type === "undefined"){
                    $type = $( this ).prop('tagName').toLowerCase();
                }
                return '<span class="ans" data-type="'+$type+'" data-id="'+$id+'">'+ $( this ).val().replace("\n", "<br />") + '</span>';
            });
            
            $('#FormData').val($submittedFrom.html());
            
        });
    });
    
//]]>
</script>