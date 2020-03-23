<?php
 $classes = ($isAjax)?'btnPreview':'';
?>
<?php if(!$isAjax):?>
    <div class='box box-solid'>
    <div class='box-header'><h3 class='box-title'>Documentation</h3>
    </div>
    <div class='box-body'>
<?php endif;?>

<?php if($index):?>
<p>Please pick a topic from below</p>
<ul>
<?php foreach($index as $guide):?>
    <li>
    <?= $this->Html->link($guide->title,['action'=>'view',$guide->id,'#'=>'guide_'.$guide->id],['class'=>$classes,'title'=>$guide->title]) ?>
    <?php if($guide->has('child_guides')):?>
    <ul class="treeview-menu">
    <?php foreach($guide->child_guides as $sub):?>
    <li><?= $this->Html->link($sub->title,['action'=>'view',$sub->id,'#'=>'guide_'.$sub->id],['class'=>$classes,'title'=>$guide->title]) ?></li>
    <?php endforeach;?>
    </ul>
    <?php endif;?>
    </li>
<?php endforeach; ?>
</ul>
<?php else:?>
<h1>Documentation Coming Soon</h1>
<?php endif;?>
<?php if($isAdmin):?>
    <?= $this->Html->link('<i class="fa fa-plus" aria-hidden="true"></i>', 
    ['action' => 'add'],['escape'=>false,'class'=>'btn btn-default','title'=>'Add']) ?>
    <?= $this->Html->link('<i class="fa fa-list" aria-hidden="true"></i>', 
    ['action' => 'index'],['escape'=>false,'class'=>'btn btn-default','title'=>'Manage']) ?>
<?php endif;?>

<?php if(!$isAjax):?>
</div>
</div>
<?php endif; ?>
