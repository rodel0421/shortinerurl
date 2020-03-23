
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Edit Form Template') ?></h3>
    	<div class="box-tools pull-right">
    	
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
                 		
        <?= $this->Form->postLink(
        		'<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete'),
                ['action' => 'delete', $formTemplate->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', 
                $formTemplate->id), 'escape' => false, 
                 	'class' => 'btn btn-danger', 'title' => __('Delete')]
            )
        ?>
		
      </div>
    </div>
    <div class='box-body'>
    <?= $this->Form->create($formTemplate); ?>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->hidden('revision',['value'=>($formTemplate->revision + 1)]);
            echo $this->Form->input('form',['class'=>'formTemplate','id'=>'TheForm']);
            //echo $this->Form->input('validation');
        ?>
    <?= $this->Form->button(__('Submit'), ['bootstrap-type' => 'success']) ?>
    <?= $this->Form->end() ?>
</div>
    <div class='box-footer'>
        <h4>Helper Classes</h4>
        <dl class="dl-horizontal">
            <dt>form-helptext</dt>
            <dd>This will hide the text after the form has been filled in.</dd>
            <dt>expandable</dt>
            <dd>When added to a table it will make the rows automatically grow as needed.</dd>
        </dl>
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
        
        $("form").on('submit', function(e) {
           
           var $form = $("<div id='specialwrapperthing'>" + CKEDITOR.instances.TheForm.getData() + "</div>");
           $(":input",$form).uniqueId();
           CKEDITOR.instances.TheForm.setData($form.html());
           CKEDITOR.instances.TheForm.updateElement();
        });
    });
    
//]]>
</script>