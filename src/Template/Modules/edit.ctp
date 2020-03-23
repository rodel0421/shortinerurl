     
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="../">Module</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit</li>
  </ol>
</nav>

<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Edit Module') ?></h3>
    	<div class="box-tools pull-right">
    	
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['controller'=>'Courses','action' => 'view',$module->course_id], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
       
      </div>
    </div>
    <div class='box-body'>
    <?= $this->Form->create($module); ?>
        <?php
            echo $this->Form->control('resources_id', ['options' => $resources, 'empty'=>true]);
            echo $this->Form->control('register_class_id', ['options' => $register_classes, 'empty'=>true]);
            echo $this->Form->control('code'); 
            echo $this->Form->control('name'); 
            echo $this->Form->input('description',['class'=>'formTemplate','id'=>'TheForm']);
        ?>
    <?= $this->Form->button(__('Submit'), ['bootstrap-type' => 'success']) ?>
    <?= $this->Form->end() ?>
</div>
</div>
<?php 
echo $this->Html->script('/admin_l_t_e/lib/ckeditor/ckeditor.js');

?>
<script type="text/javascript"> 
//<![CDTA[
    $(document).ready(function(){
        var uuid = 0,runiqueId = /^ui-id-\d+$/;

        $.fn.extend({
                uniqueId: function() {
                        return this.each(function() {
                                if ( !this.id ) {
                                        this.id = "ui-id-" + (++uuid);
                                }
                        });
                },

                removeUniqueId: function() {
                        return this.each(function() {
                                if ( runiqueId.test( this.id ) ) {
                                        $( this ).removeAttr( "id" );
                                }
                        });
                }
        });
        
        CKEDITOR.replace( 'TheForm', {
            toolbarGroups: [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'forms' },
		{ name: 'tools' },
                { name: 'others' },
                { name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' }
            ],
            extraAllowedContent: '*[id](*)',
            allowedContent: true,
            extraPlugins: 'forms',
            removeButtons: 'Form,Button,ImageButton,HiddenField'
        });
        CKEDITOR.instances.TheForm.setData($("#TheForm").val());
        $("form").on('submit', function(e) {
            $("#TheForm").val(CKEDITOR.instances.TheForm.getData());
        //    var $form = $("<div id='specialwrapperthing'>" + CKEDITOR.instances.TheForm.getData() + "</div>");
        //    $(":input",$form).uniqueId();
        //    CKEDITOR.instances.TheForm.setData($form.html());
        //    CKEDITOR.instances.TheForm.updateElement();
        });
    });
    
//]]>
</script>