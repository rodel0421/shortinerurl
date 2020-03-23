<?php 

$this->assign('title', h($client_name));

$user = $this->request->session()->read('Auth.User');
?>

<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= h($client_name)?></h3>
    	<div class="box-tools pull-right">
        <?php if(!$user):?>
    	<?= $this->Html->link('Login', ['controller'=>'Users', 'action' => 'login'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('Login')]) ?>
    	<?php else:?>
            <?= $this->Html->link('Enter', ['controller'=>'Users', 'action' => 'login'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('Login')]) ?>
        <?php endif;?>
      </div>
    </div>
    <div class='box-body'>
        <ul class="list-unstyled">
        <?php foreach ($resources as $resource): 
            
            $options = ['escape' => false,
             'title' => h($resource->title)];
            switch ($resource->type){
                case 'Document':
                    $link = '<i class="file-icon-mini '.h($resource->doc_ext).'-mini"></i> '.h($resource->title);
                    $url = $resource->doc;
                    $options['target']='blank';
                    break;
                case 'Link':
                    $link = '<i class="fa fa-link"></i> '.h($resource->title);
                    $url = $resource->link;
                    $options['target']='blank';
                    break;
                default:
                    $link = '<i class="fa fa-sticky-note-o"></i> '.h($resource->title);
                    $url = ['controller'=>'Resources','action'=>'view',$resource->id];
                    $options['class']='btnPreview';
            }
            ?>
            <li>
            <?= $this->Dak->link($link, $url, $options) ?>
            </li>
        <?php endforeach; ?>
        </ul>
</div>
<div class='box-footer'>
    
</div>
</div>