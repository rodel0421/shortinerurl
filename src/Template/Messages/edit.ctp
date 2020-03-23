
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Edit Message') ?></h3>
    	<div class="box-tools pull-right">
    	
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
                 		
    	<?= $this->Form->postLink(
        		'<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete'),
                ['action' => 'delete', $message->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', 
                $message->id), 'escape' => false, 
                 	'class' => 'btn btn-danger', 'title' => __('Delete')]
            )
        ?>
      </div>
    </div>
    <div class='box-body'>
    <?= $this->Form->create($message); ?>
        <?php
            echo $this->Form->input('title');
            $this->Form->unlockField('_wysihtml5_mode');
            echo $this->Form->input('notes',[
                'class'=>'editor',
                'label'=>'Note',
                'required'=>false]);
            echo $this->Form->input('expires',['type'=>'text','class'=>'datepicker']);
            if($isOfficer || $isAdmin):
        ?>
            <?=  $this->Form->input('block_send_alert',['type'=>'checkbox','class'=>'sendalert','label'=>'Send Alert'])?>
        <div class='AlertTo'><?=  $this->Form->input('department_id',
                    ['label'=>'Send Alert to:','empty'=>'Everyone'])?></div>
        <script type="text/javascript"> 
        //<![CDTA[
            $(document).ready(function(){

                $('.sendalert').on('change',function(){
                    if(event.target.checked){
                        $('.AlertTo').show();
                    }else{
                        $('.AlertTo').hide();
                    }
                });

                $('.sendalert').trigger('change');
            });
        //]]>
        </script>
        <?php endif;?>
    <?= $this->Form->button(__('Submit'), ['bootstrap-type' => 'success']) ?>
    <?= $this->Form->end() ?>
</div>
</div>
