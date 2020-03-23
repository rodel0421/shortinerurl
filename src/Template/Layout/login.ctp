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
    <script src="https://apis.google.com/js/client:platform.js?onload=renderButton" async defer></script>
    <meta name="google-signin-client_id" content="612896420009-ceh0npi25i8idpgu7c49dlgjhdveg27r.apps.googleusercontent.com">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <?= $this->Html->script('icon') ?>
    <title>
        <?= $this->fetch('title') ?> :: <?= h($app_logo_text)?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->element('adminlte_default')?>
   

    <?= $this->fetch('css') ?>
    <?= $this->Html->script('demo') ?>

    <?= $this->Html->script('google') ?>
  
    <?= $this->Html->script('facebook') ?>
 
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

$body_class = 'login-page';
$body_other = '';
if(isset($this->request->query['print'])){
    $body_other = 'onload="window.print();"';
    $body_class += ' sidebar-collapse';
}
?>
<style>
h1#logoImage {
  margin: 0 auto;
  text-align: center;
  padding-bottom: 25px;
}
img#logoImage1 {
  height: auto;
  max-height: 100px;
  width: auto;
  /* align-items: center; */
  max-width: 100%;
  margin: 0 auto;
}
</style>
<body class='<?= $body_class?>' <?= $body_other?>>
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
    
    <script>
      $(document).ready(function(){
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>