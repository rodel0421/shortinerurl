
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Edit Config') ?></h3>
    	<div class="box-tools pull-right">
    	
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
                 		
    	        <?= $this->Form->postLink(
        		'<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete'),
                ['action' => 'delete', $config->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', 
                $config->id), 'escape' => false, 
                 	'class' => 'btn btn-danger', 'title' => __('Delete')]
            )
        ?>
		
        <div class="btn-group">
          <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
          <ul class="dropdown-menu" role="menu">
			         </ul>
        </div>
      </div>
    </div>
    <div class='box-body'>
    <?= $this->Form->create($config); ?>
        <?php
            if(!empty($facilityList)){
                echo $this->Form->input('facility_id',[
                  'options'=>$facilityList,
                  'empty'=>'All',
                  'default'=>$currentFacility_id
                ]);
              }
            echo $this->Form->input('title');
            echo $this->Form->input('type');
            echo $this->Form->input('data');
        ?>
    <?= $this->Form->button(__('Submit'), ['bootstrap-type' => 'success']) ?>
    <?= $this->Form->end() ?>
</div>
</div>
