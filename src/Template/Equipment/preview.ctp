<?php
    
?>
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'>
            <?= $equipment->has('equipment_type') && $equipment->equipment_type->icon ? $this->Html->image($equipment->equipment_type->icon,['class'=>'inline_icon']) : '' ?>
            <?= h($equipment->title) ?> <span class='small'><?= $equipment->has('equipment_type') ? $equipment->equipment_type->title : '' ?></span>
            <?= $equipment->has('user') ? $this->Html->link($equipment->user->name, ['controller' => 'Users', 'action' => 'view', $equipment->user->id]) : '' ?>
            <?= $equipment->active ? __('') : __('Archived'); ?>
        
        </h3>
    	<div class="box-tools pull-right">
            <?php if(!$isAjax):?>
    	<?php 
        if($this->request->query('back')){
            echo $this->Html->link('Back',$this->request->query('back') , 
                ['escape' => false, 'class' => 'btn btn-default', 'title' => __('Back')]);
        } ?>
            
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
        <?php endif;?>
      </div>
    </div>
    <div class='box-body'>
    <div class='row'>
        <?php 
        $image = $equipment->picture_url;
        
        if(!$image && $equipment->has('equipment_type') && $equipment->equipment_type->icon){
            $image = $equipment->equipment_type->image;
        }
        
        if(!empty($image)):?>
    <div class="col-md-2 col-xs-4">
        <div class="box ">
            <div class="box-body">
                <?php echo $this->Dak->image($image,
                        array('class'=>'img-responsive',
                            'alt'=>'Equipment Photo'));?>
                
            </div>
        </div>
    </div>
        <?php endif;?>
        <div class='col-md-3 col-sm-6'>

        <ul class="list-group list-group-unbordered">
                    
                    <li class="list-group-item">
                        <b>Make</b> <span class="pull-right"><?= h($equipment->make) ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Model</b> <span class="pull-right"><?= h($equipment->model) ?></span>
                    </li>
                    
                    <li class="list-group-item">
                        <b>Asset</b> <span class="pull-right"><?= h($equipment->asset) ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Serial</b> <span class="pull-right"><?= h($equipment->serial) ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Part Number</b> <span class="pull-right"><?= h($equipment->part_number) ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Location</b> <span class="pull-right"><?= h($equipment->location) ?></span>
                    </li>
                    <?php if($equipment->for_hire):?>
                    <li class="list-group-item">
                        <b><?= __('For Hire') ?></b> <span class="pull-right">
                            <?=  ($equipment->qty)?>
                            <?= ($equipment->hire_rate)? ' @ '. $this->Number->currency($equipment->hire_rate) :''?>
                            </span>
                    </li>
                <?php endif;?>
                </ul>  
          
        </div>
    </div>
    <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-text-width"></i>
          <h3 class="box-title"><?= __('Notes') ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
         <?= $equipment->notes ?>
        </div>
        <!-- /.box-body -->
    </div>
    <?php if(!empty($equipment->equipment_logs)):?>
    <table class="table">
            <thead><tr>
                <th>Documents</th>
                <th>Uploaded</th>
                <th>Review Date</th>
            </tr></thead>
            <tbody>
                <?php foreach($equipment->equipment_logs as $log):?>
                <tr>
                    <td><?php if($log->file_url){
                            $icon = '<span class="file-icon-mini '.h($log->file_ext).'-mini"></span> '.
                                    h($log->file_name).' ['.
                                    $this->Number->toReadableSize($log->file_size).']';
                            echo $this->Dak->link($icon,$log->file_url,array('target'=>'_blank','escape'=>false));
                    }?></td>
                    <td><?= $log->created ?></td>
                    <td><?= $this->Dak->showDateLabel($log->date) ?></td>
                </tr>
                <?php endforeach;?>
            </tbody>
            </table>
    <?php endif;?>
</div>
    
<div class='box-footer'>
    <?php $footerHtml = '';?>
    <?php 
        $footerHtml .= "<b>". __('Created') .":</b> ";
        $footerHtml .= h($equipment->created)." ";
        ?>
        <?php 
        $footerHtml .= "<b>". __('Modified') .":</b> ";
        $footerHtml .= h($equipment->modified)." ";
        ?>
    <?= $footerHtml ?>
</div>
</div>

