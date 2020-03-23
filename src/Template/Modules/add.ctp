<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
 
</nav>
<div class="modules form large-9 medium-8 columns content">
    <?= $this->Form->create($module) ?>
    <?= $this->Form->unlockField('_wysihtml5_mode') ?>
    
    <fieldset>
        <legend><?= __('Add Module') ?></legend>
        <?php
            echo $this->Form->hidden('post_type',array('value' => 'module'));
            echo $this->Form->hidden('course_id', ['value' => $course->id]);
            echo $this->Form->control('resources_id', ['options' => $resources, 'empty'=>true]);
            echo $this->Form->control('register_class_id', ['options' => $register_classes, 'empty'=>true]);
            echo $this->Form->control('code'); 
            echo $this->Form->control('name'); 
            echo $this->Form->input('description',['class'=>'formTemplate','id'=>'TheForm']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
    
</div>

<?php 
echo $this->Html->script('/admin_l_t_e/lib/ckeditor/ckeditor.js');
?>
<script type="text/javascript"> 
//<![CDTA[
    $(document).ready(function(){
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
            extraPlugins: 'forms',
            allowedContent: true,
            removeButtons: 'Form,Button,ImageButton,HiddenField'
        });
        
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