<!DOCTYPE html><?php
if(!isset($app_logo_text)){
    $app_logo_text = 'DDMS';
}
?>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>
        <?= $this->fetch('title') ?> :: <?= h($app_logo_text)?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->element('adminlte_default')?>
    <?= $this->fetch('css') ?>
    
    <?= $this->Html->css('custom')?>
    
    <?php
    if(isset($this->request->query['print'])){
        echo $this->Html->css('/admin_l_t_e/css/print');
        if($this->request->query['print']== 2){
           echo $this->Html->css('/admin_l_t_e/css/print_landscape'); 
        }
    }else{
        echo $this->Html->css('/admin_l_t_e/css/print',array('media'=>'print'));
    }
    ?>
</head><?php 
$body_class = 'skin-purple-light layout-boxed layout-top-nav';
$body_other = '';
if(isset($this->request->query['print'])){
    $body_other = 'onload="window.print();"';
}

?>
<body class='<?= $body_class?>' <?= $body_other?>>
<div class="wrapper">
    
    
<header class="main-header">
     <nav class="navbar navbar-static-top">
      <div class="container">
          <div class="navbar-header">
            <span style="font-weight: bold; font-size: 30px; color: #FFFFFF;"><?= $app_logo_text?></span><?= $this->Html->image('ddms.png',[
                                'style' => 'margin-left: 10px;height:30px;vertical-align: top; margin-top: 7px;',
                                'alt'=>'Icon'
                                ])?>
            </div>
          <span class='client-name hidden-xs' style='cursor: default;' id='client_name'></span>
      </div>
     </nav>
</header>
<div class="content-wrapper">
    <section class="content">
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
    <?= $this->Html->link(__('Back'), 'javascript:history.back()') ?>
    </section>
</div>
<?php echo $this->element('adminlte_footer');?>    
</div>
<?= $this->fetch('script') ?>