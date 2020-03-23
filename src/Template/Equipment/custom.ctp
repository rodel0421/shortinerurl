
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Edit Custom Fields') ?></h3>
    	<div class="box-tools pull-right">
    	
    	<?= $this->Html->link('Back', ['action' => 'view',$equipment->id], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('Back')]) ?>
             
      </div>
    </div>
    <div class='box-body'>
    <?= $this->Form->create($equipment); ?>
    <?php 
    
    $custom_form = null;
    if($equipment->has('equipment_type')){
        $custom_form = json_decode($equipment->equipment_type->data, true);
    }
    
    if(!$custom_form){
        $custom_form = [];//???
    }
    
    foreach($custom_form as $input){
        if(!isset($input['custom_name'])) continue;
        
        $name = $input['custom_name'];
        
        $name = preg_replace("/[^A-Za-z0-9 ]/", '', $name);
        $name = Cake\Utility\Inflector::underscore($name);
        $options = [];
        if(isset($input['custom_type']) && in_array($input['custom_type'],['text','textarea','time','number'])){
            $options['type'] = $input['custom_type'];
        }elseif(isset($input['custom_type']) && $input['custom_type'] == 'date'){
            $options['type'] = 'text';
            $options['class'] = 'datepicker';
        }
        if(isset($input['custom_help'])){
            $options['help'] = h($input['custom_help']);
        }
        if(isset($input['custom_required']) && $input['custom_required']){
            $options['required'] = $input['custom_required'];
        }
        
        echo $this->Form->input('Custom.'.$name,$options);
    }
    
    ?>        
    <?= $this->Form->button(__('Submit'), ['bootstrap-type' => 'success']) ?>
    <?= $this->Form->end() ?>
</div>
</div>
