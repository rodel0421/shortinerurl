<?php
 $classes = ($isAjax)?'btnPreview':'';
?>
<?php if(!$isAjax):?>
    <div class='box box-solid'>
    <div class='box-header'><h3 class='box-title'>Documentation</h3>
        <div class="box-tools pull-right">
            <div class="btn-group"><?= $this->Html->link('Index', ['action' => 'open'], 
                 		['escape' => false, 'class' => 'btn btn-default '.$classes, 'title' => __('Index')]) ?></div>
        </div>
    </div>
    <div class='box-body'>
<?php else:?>
<div class="box-tools pull-right">
    <div class="btn-group"><?= $this->Html->link('Index', ['action' => 'open'], 
                        ['escape' => false, 'class' => 'btn btn-default btn-xs '.$classes, 'title' => __('Index')]) ?></div>
</div>
<?php endif;?>

<?php foreach($guides as $list_guide):
    $h = empty($list_guide->parent_id)?'h2':'h3'
    ?>
    <a name="guide_<?= $list_guide->id ?>"></a>
<<?=$h?>><?= h($list_guide->title) ?><?php if($isAdmin):?>
    <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') 
                            . '</span>', ['action' => 'edit', $list_guide->id], 
                            ['escape' => false, 'class' => 'btn btn-warning btn-xs', 'title' => __('Edit')]) ?>
    
    <?php endif;?></<?=$h?>>
<?= $list_guide->notes; ?>
<?php endforeach;?>


<?php if(!$isAjax):?>
</div>
</div>
<?php endif; ?>
