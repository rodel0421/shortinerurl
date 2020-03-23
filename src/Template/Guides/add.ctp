<?php //http://tableizer.journalistopia.com/ ?>
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Add Guide') ?></h3>
    	<div class="box-tools pull-right">
    	
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
        
      </div>
    </div>
    <div class='box-body'>
    <?= $this->Form->create($guide); ?>
        <?php
            echo $this->Form->input('controller',[
                'empty'=>'(Select)',
                'label'=>'Section',
                'options'=>$controllers]);
            echo $this->Form->input('action',
                ['options'=>[
                    'add'=>'Add','edit'=>'Edit','index'=>'List'
                ],'empty'=>'(n/a)']);
            //echo $this->Form->input('page');
            //echo $this->Form->input('section');
            
            echo $this->Form->input('parent_id',['empty'=>'TOP','label'=>'Parent Guide']);
            
            echo $this->Form->input('title');
            echo $this->Form->input('notes',[
                'id'=>'TheForm',
                'label'=>'Documentation',
                'required'=>false]);
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
        
        CKEDITOR.replace( 'TheForm', {
            toolbarGroups: [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'tools' },
		{ name: 'insert' },
                { name: 'others' },
                { name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' }
            ],
            extraAllowedContent: '*[id](*)',
            extraPlugins: 'videoembed',
            allowedContent: true,
            filebrowserUploadUrl: '/common/ckupload'
        });
        
        $('#TheForm').removeAttr('required');
    });
    
//]]>
</script>