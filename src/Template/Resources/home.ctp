<style>
.input-group .form-control {
    position: relative;
    z-index: 2;
    float: left;
    /* width: 50%; */
    margin-bottom: 0;
}

.bg_resource {
    padding-left: 15px;
    background: #ffffff;
    margin-top: 15px;
    border-radius: 3px;
}

.row.stresources {
    margin-left: -25px;
}


.info-box {
    box-shadow: 0px 3px 7px #e5e5e5;
    border-top: 1px solid #dcdcdc;
}

</style>


<?php 
$this->Form->templates(['inputContainer' => '{{content}}']);
?>
<div class="row">
<div class="col-md-6">
<?= $this->Form->create(); ?>
<div class="input-group">
<?= $this->Form->input('Resources.title',['div'=>false,'class'=>'search','label'=>false,'placeholder'=>'Search...'])?>
<span class="input-group-btn">
<?= $this->Form->button('<i class="fa fa-search"></i>', 
    ['class' => 'btn btn-flat','escape'=>false,'id'=>'search-btn','onClick'=>'return false;']) ?>
</span>
</div>
<?= $this->Form->end() ?>
</div>

<div class="col-md-6">
<!-- <div class='box'> -->
    <div class='box-header'><h3 class='box-title'>
        <i class="" aria-hidden="true"></i></h3>
    	<div class="box-tools pull-right">
    	<div class="btn-group">
        <?php if($isOfficer || $isAdmin):?>
        <?= $this->Html->link('<i class="fa fa-plus" aria-hidden="true"></i> Note', 
            ['action' => 'add'],['escape'=>false,'class'=>'btn btn-default','title'=>'Add Note']) ?>
        <?= $this->Html->link('<i class="fa fa-plus" aria-hidden="true"></i> Document', 
            ['action' => 'add','type'=>'Document'],['escape'=>false,'class'=>'btn btn-default','title'=>'Add Document']) ?>
        <?= $this->Html->link('<i class="fa fa-plus" aria-hidden="true"></i> Link', 
            ['action' => 'add','type'=>'Link'],['escape'=>false,'class'=>'btn btn-default','title'=>'Add Link']) ?>

            <?= $this->Html->link('<i class="fa fa-refresh" aria-hidden="true"></i>', 
                ['action' => 'index','rebuild'=>1],['escape'=>false,'class'=>'btn btn-default','title'=>'Rebuild Order']);?>
            
        <?php if($this->request->query('archived')){
            echo $this->Form->hidden('archived',['value'=>1,'class'=>'search','id'=>'archived']);
            echo $this->Html->link('<i class="fa fa fa-bars" aria-hidden="true"></i>', 
                ['action' => 'index'],['escape'=>false,'class'=>'btn btn-default','title'=>'Show All']);
        }else{
            echo $this->Html->link('<i class="fa fa-trash-o" aria-hidden="true"></i>', 
                ['action' => 'index','archived'=>1],['escape'=>false,'class'=>'btn btn-default','title'=>'Show Deleted']);
        }?>
            <?php endif;?>
        </div>
        </div>
        </div>
</div>

</div>


<div class="bg_resource">
<div class="row stresources">
    <div class='col-md-3'><?= $this->Html->link('All Resources',
    ['action'=>'home','filter'=>1],
    ['class'=>'btn-block btn-sm bg-purple btn-flat margin'])?></div>
<?php foreach($categories as $id => $title):?>
    <div class='col-md-3'><?= $this->Html->link($title,
    ['action'=>'home','filter'=>1,'category'=>$id],
    ['class'=>'btn-block btn-sm bg-maroon btn-flat margin'])?></div>
<?php endforeach;?>
</div>
<div class="row" style="padding-top: 15px;">
        
        <?php foreach ($resources as $resource): ?>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <?php 
            $options = ['escape' => false, 
             'title' => $resource->title,
             'target'=>'blank'];
            switch ($resource->type){
                case 'Document':
                    $link = '<span class="info-box-icon bg-aqua"><i class="file-icon '.$resource->doc_ext.'"></i></span>';
                    $url = $resource->doc;
                    break;
                case 'Link':
                    $link = '<span class="info-box-icon bg-aqua"><i class="fa fa-link"></i></span>';
                    $url = $resource->link;
                    break;
                default:
                    $link = '<span class="info-box-icon bg-aqua"><i class="fa fa-sticky-note-o"></i></span>';
                    $url = ['controller'=>'Resources','action'=>'view',$resource->id];
                    $options['class']='btnPreview';
            }
            ?>
            <?= $this->Dak->link(
            $link, 
            $url, 
            $options) ?>
            <div class="info-box-content">
                <?php if($isAdmin) echo $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') . '</span>', 
                ['action' => 'edit', $resource->id], 
                ['escape' => false, 'class' => 'btn btn-xs btn-warning pull-right', 'title' => __('Edit')]) ;?>
                <span class="info-box-number"><?= h($resource->title) ?></span>
                <?= h($resource->description) ?><br/>
                <?php if($resource->has('resource_categories')):?>
                <small>
                    <?php foreach($resource->resource_categories as $category):?>
                    <span class='label label-primary'><?= h($category->name)?></span>
                    <?php endforeach;?>
                </small>
                <?php endif;?>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <?php endforeach; ?>
</div>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
    </ul>
    <p><?= $this->Paginator->counter() ?></p>
</div>
</div>