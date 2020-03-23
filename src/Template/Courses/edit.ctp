<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="btn-group" role="group" aria-label="...">
    <?= $this->Form->postLink('<i class="fa fa fa-trash" aria-hidden="true"></i> Delete Course',
        [   
            'action' => 'delete', $course->id
        ],
        [
            'confirm' => __('Are you sure you want to delete # {0}?', $course->id),
            'escape' => false,
            'class'=>'btn btn-default',
            'title' => 'List Tests'
        ]
    )?>
    <?= $this->Html->link('<i class="fa fa fa-list" aria-hidden="true"></i> List Courses',
        ['action' => 'index'],
        [
            'escape' => false,
            'class'=>'btn btn-default',
            'title' => 'List Courses'
        ]
    )?>
</div>
<div class="courses form large-9 medium-8 columns content">
    <?= $this->Form->create($course) ?>
    <fieldset>
        <legend><?= __('Edit Course') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('code');
            echo $this->Form->control('description',['class'=>'formTemplate','id'=>'TheForm']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
<?=$this->Html->script('/admin_l_t_e/lib/ckeditor/ckeditor.js');?>
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
            extraPlugins: 'forms',
            allowedContent: true,
            removeButtons: 'Form,Button,ImageButton,HiddenField'
        });

        CKEDITOR.instances.TheForm.setData($("#TheForm").val());
        
        $("form").on('submit', function(e) {
            $("#TheForm").val(CKEDITOR.instances.TheForm.getData());
        });
    });
    
//]]>
</script>
