
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><span class="file-icon-mini <?= h($userDoc->extension)?>-mini"></span>
        <?= h($userDoc->name) ?>
        (<?= $this->Number->toReadableSize($userDoc->filesize) ?>)
        <?= ($userDoc->private)?'<i class="fa fa-eye-slash" title="Private - Office Use Only"></i>':'' ?>
        <?= $userDoc->active ? '' : 'Archived'; ?>
        </h3>
    	<div class="box-tools pull-right">
    	<?php 
        $back = ($this->request->query('back')) ? $this->request->query('back') :['controller'=>'Users','action' => 'view',$userDoc->user_id];
        echo $this->Html->link('Back',$back , 
            ['escape' => false, 'class' => 'btn btn-default', 'title' => __('Back')]); ?>
            
            
    	<?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') 
                 		. '</span>', ['action' => 'edit', $userDoc->id], 
                 		['escape' => false, 'class' => 'btn btn-warning', 'title' => __('Edit')]) ?>
        
       <?php if($userDoc->active):?>
       <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') 
                 		. '</span>', ['action' => 'delete', $userDoc->id], 
                 		['confirm' => __('Are you sure you want to delete # {0}?', $userDoc->id), 'escape' => false, 
                 				'class' => 'btn btn-danger', 'title' => __('Delete')]) ?>
        <?php endif;?>   
    	<?= $this->element('guide', array("section" => 'userDocs')) ?>
        
      </div>
    </div>
<div class='box-body'>

    <?php 
    //Save this for later. Will view doc, ppt, xls but not CSV
    // $url = '//docs.google.com/gview?url='.$this->Url->build($url,true).'&embedded=true';
    
    if(in_array($userDoc->extension,['gif', 'jpeg', 'png', 'jpg','pdf'])):?>
    <div class="row">
    <iframe frameborder="0" class="col-lg-12 col-md-12 col-sm-12" style='height:600px' src="<?= h($userDoc->file_url)?>">
    <h3>Loading...</h3>
    </iframe>
    </div>
    <?php else:?>
    <a class="btn btn-block" href='<?= h($userDoc->file_url)?>' target='_blank'>
        <span class="file-icon-mini <?= h($userDoc->extension)?>-mini"></span> Download
      </a>
    <?php endif; ?>


</div>
<div class='box-footer'>
    <?php $footerHtml = '';?>
    <?php 
            $footerHtml .= "<b>". __('Created') .":</b> ";
            $footerHtml .= h($userDoc->created)." ";
            ?>
            <?php 
            $footerHtml .= "<b>". __('Modified') .":</b> ";
            $footerHtml .= h($userDoc->modified)." ";
            ?>
    <?= $footerHtml ?>
</div>
</div>
