<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?php echo $this->element('adminlte_pdf')?>
    
    <?= $this->Html->css('custom', ['fullBase' => true])?>
    <style>
    <?php echo include WWW_ROOT.'admin_l_t_e/css/print.css' ?>
    </style>
</head>
<body>
    <?= $this->fetch('content') ?>
</body>
</html>