
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><i class="fa fa-book" aria-hidden="true"></i> <?= __('Add Resource') ?></h3>
    	<div class="box-tools pull-right">
    	
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
         
      </div>
    </div>
    <div class='box-body'>
    <?= $this->Form->create($resource, ['type' => 'file']); ?>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('description');
            echo $this->Form->input('categories',[
                'class'=>'tag_select2',
                'multiple'=>true,
                'options'=>$categories,
                'help'=>'Select from existing category or enter a new category in the box. Tip: Use a comma (,) to enter multiple.'
                ]);
            echo $this->Form->input('group_id', [
                'options' => $groups, 
                'empty' => 'Public',
                'label'=>'Security',
                'help'=>'This group and above will be able to access this resource.']);
            
            switch ($type){
                case 'Note':
                    $this->Form->unlockField('_wysihtml5_mode');
            echo $this->Form->input('notes',[
                'class'=>'editor',
                'label'=>'Notes',
                'required'=>false]);
                    break;
                case 'Document':
                    echo $this->Form->input('doc', [
                'type' => 'file',
                'help'=>'.pdf, .gif, .jpg, .png, .jpeg, .csv (max file size 5Mb)',
                'label' => 'Upload Document'
                ]);
                    break;
                case 'Link':
                    echo $this->Form->input('link',['help'=>'Must be a valid URL. i.e. Starts with http:// or https://']);
                    break;
            }
            
            
            
            
            
            
        ?>
    <?= $this->Form->button(__('Submit'), ['bootstrap-type' => 'success']) ?>
    <?= $this->Form->end() ?>
</div>
</div>
<script type="text/javascript"> 
//<![CDTA[
    $(document).ready(function(){
        
        
        $('.tag_select2').selectize({
            delimiter: ',',
            persist: false,
            create: function(input) {
                return {
                    value: input,
                    text: input
                }
            }
        });
        
    });
//]]>
</script>