
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Edit User Document') ?></h3>
    	<div class="box-tools pull-right">
    	
        <?php 
        $back = ($this->request->query('back')) ? $this->request->query('back') :['action' => 'view',$userDoc->id];
        echo $this->Html->link('Back',$back , 
            ['escape' => false, 'class' => 'btn btn-default', 'title' => __('Back')]); ?>    
            
        <?= $this->Form->postLink(
        		'<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete'),
                ['action' => 'delete', $userDoc->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', 
                $userDoc->id), 'escape' => false, 
                 	'class' => 'btn btn-danger', 'title' => __('Delete')]
            )
        ?>
		
      </div>
    </div>
    <div class='box-body'>
    <?= $this->Form->create($userDoc); ?>
        <?php
            echo $this->Form->input('name');
            
            if($isAdmin || $isOfficer){
                echo $this->Form->input('private',['label'=>'Office Only']);
            }
            
            echo $this->Form->input('active');
        ?>
    <?= $this->Form->button(__('Submit'), ['bootstrap-type' => 'success']) ?>
    <?= $this->Form->end() ?>
</div>
</div>
