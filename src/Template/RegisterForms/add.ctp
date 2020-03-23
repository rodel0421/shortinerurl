
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Complete Register Form') ?></h3>
    	<div class="box-tools pull-right">
    	
    	<?= $this->Html->link('Back', ['controller'=>'Registers','action' => 'view',$register->id], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('Back')]) ?>
              
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
        
        $("form").on('submit', function(e) {
           /* 
            $("input",'#TheForm').attr("value", function() {
                return this.value;
            }).attr('disabled','disabled');
            
            $(":input",'#TheForm').each(function() {
                return this.val;
            }).attr('disabled','disabled');
            */
           
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