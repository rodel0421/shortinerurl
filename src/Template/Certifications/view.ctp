
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><i class="fa fa-certificate" aria-hidden="true"></i>  
        <i class="fa fa-circle status_<?= $certification->status ?>"></i> <?= $certification->has('certification_type') ? h($certification->certification_type->name):'' ?>
        for <?= $certification->has('user') ? $this->Html->link($certification->user->name, ['controller' => 'Users', 'action' => 'view', $certification->user->id]) : 'unknown' ?>
        </h3>
    	<div class="box-tools pull-right">
            <?php 
        $back = ($this->request->query('back')) ? $this->request->query('back') :['controller'=>'Users','action' => 'view',$certification->user->id];
        echo $this->Html->link('Back',$back , 
            ['escape' => false, 'class' => 'btn btn-default', 'title' => __('Back')]); ?>
            
    	<?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') 
                 		. '</span>', ['action' => 'edit', $certification->id], 
                 		['escape' => false, 'class' => 'btn btn-warning', 'title' => __('Edit')]) ?>
        
       <?php if($certification->active):?>
            
        <?php if($certification->status > 1):?>
            <?= $this->Html->link('<span class="fa fa-refresh"></span><span class="sr-only">' . __('Replace') 
                        . '</span>', ['controller' => 'Certifications', 'action' => 'add','replacing'=> $certification->id], 
                        ['escape' => false, 'class' => 'btn btn-info', 'title' => __('Replace')])?>


        <?php endif;?>
            
            
       <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') 
                 		. '</span>', ['action' => 'delete', $certification->id], 
                 		['confirm' => __('Are you sure you want to delete # {0}?', $certification->id), 'escape' => false, 
                 				'class' => 'btn btn-danger', 'title' => __('Delete')]) ?>
        <?php endif;?>
            
    	<?= $this->element('guide', array("section" => 'certifications')) ?>
      </div>
    </div>
    <div class='box-body'>
    <?php $footerHtml = '';?>
        <dl class="dl-horizontal">
            <dt><?= __('Certification Type') ?></dt>
            <dd><?= $certification->has('certification_type') ? $certification->certification_type->name : '' ?></dd>
            <dt><?= __('Issuer') ?></dt>
            <dd><?= h($certification->issuer) ?></dd>
            <dt><?= __('File Name') ?></dt>
            <dd><?php 
                if(!empty($certification->file_url)){
                    $icon = '<span class="file-icon-mini '.h($certification->extension).'-mini"></span> '.h($certification->file_name);
                    echo $this->Dak->link($icon,$certification->file_url,array('target'=>'_blank','escape'=>false));
                 }
                 ?></dd>
            <dt><?= __('Issued') ?></dt>
            <dd><?= h($certification->issued) ?></dd>
            <dt><?= __('Expires') ?></dt>
            <dd><?= h($certification->expires) ?></dd>
            <dt><?= __('Validated') ?></dt>
            <dd><?php if($certification->valid){
                echo 'Validated '. h($certification->validated_date);
                echo ($certification->has('validated'))?' by '. $certification->validated->name:''; 
            }else{
            	if(!$certification->active){
                    echo 'Archived';
            	}elseif(($isAdmin || $isOfficer) && !$owner){
                    echo $this->Form->create($certification,['url'=>['controller'=>'Certifications','action'=>'edit',$certification->id,'back'=>$back]]);
                    echo $this->Form->hidden('valid',['value'=>'1']);
                    echo $this->Form->submit('Validate');
                    echo $this->Form->end();
                }else{
                    echo 'Not yet validated';
                }
            } ?></dd>
            <dt><?= __('Active') ?></dt>
            <dd><?= $certification->active ? __('Yes') : __('No'); ?></dd>
        </dl>
        
        <dl class="dl-horizontal">
            <?php 
            $footerHtml .= "<b>". __('Created') .":</b> ";
            $footerHtml .= h($certification->created)." ";
            ?>
            <?php 
            $footerHtml .= "<b>". __('Modified') .":</b> ";
            $footerHtml .= h($certification->modified)." ";
            ?>
        </dl>
    <dl class="dl-horizontal">
       <dt><?= __('Notes') ?></dt>
       <dd><?= $this->Text->autoParagraph(h($certification->notes)); ?></dd>
    </dl>
</div>
<div class='box-footer'>
    <?= $footerHtml ?>
</div>
</div>
