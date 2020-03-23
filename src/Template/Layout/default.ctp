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
    <link rel="stylesheet" href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <title>
        <?= $this->fetch('title') ?> :: <?= h($app_logo_text)?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->element('adminlte_default')?>
    <?= $this->fetch('css') ?>
    
    <?= $this->Html->css('custom.css?v1.1')?>
    <?= $this->Html->script('demo') ?>
    <?= $this->Html->script('google') ?>
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
$auth_user = $this->request->session()->read('Auth');

$body_class = 'hold-transition skin-orange layout-top-nav';
$body_other = '';
if(isset($this->request->query['print'])){
    $body_other = 'onload="window.print();"';
}

?>

<body class='<?= $body_class?>' <?= $body_other?>>
<!-- <?= 'default' ?> -->
<div class="wrapper">  
    <header class="main-header">

        <?= $this->cell('Menu::messages_ticker',['facility_id'=>$currentFacility_id])?>
        <nav class="navbar navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <?= $this->Html->image('ddms.png',[
                                            'style' => 'margin-left: 10px;height:30px;vertical-align: top; margin-top: 7px;',
                                            'alt'=>'Icon'
                                            ])?>
                    <span style="font-weight: bold; font-size: 30px; color: #FFFFFF; margin-right: 10px;"><?= $app_logo_text?></span>
                </div>
                <?= $this->element('top-menu')?>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <?= $this->element('menu-guides') ?>
                        <?= $this->cell('Menu::messages',['facility_id'=>$currentFacility_id])?>
                        <?= $this->cell('Menu::alerts',['user_id'=>(int)$auth_user['User']['id'] ])?>
                        <?= $this->element('facilities',compact('currentFacility_id','facilityList','facilityABV'))?>
                        <?= $this->element('user-top-menu');?>

                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="content-wrapper">
        <a class="g-signin2 btn-block btn-google-plus btn-flat"  data-width="350" data-height="30" data-onsuccess="onSuccess" data-onfailure="onSuccess">Sign up with Google+</a>
        <div class='container'>
            <section class="content">
                <?php 
                if(isset($auth_user['User']['id'])){
                    echo $this->cell('Menu::alerts_list',['user_id'=>(int)$auth_user['User']['id'] ]);
                }?>
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </section>
        </div>
    </div>
    <?= $this->element('adminlte_footer');?>    
</div>
    
<?= $this->element('previewModel'); ?>
<?= $this->fetch('script') ?>
<script type="text/javascript"> 
//<![CDTA[

        // jQuery plugin to prevent double submission of forms
    jQuery.fn.preventDoubleSubmission = function() {
      $(this).on('submit',function(e){
        var $form = $(this);

        if ($form.data('submitted') === true) {
          // Previously submitted - don't submit again
          e.preventDefault();
        } else {
          // Mark it so that the next submit can be ignored
          $form.data('submitted', true);
        }
      });

      // Keep chainability
      return this;
    };

    $(document).ready(function(){
        $('table.dbclick2open tbody tr').dblclick(function (){
                var url = "<?php echo $this->Url->build(array('action'=>'view'));?>/"+$(this).attr('data-id');    
                window.location.href = url;
        });


        $('.index-filter').change(function(){
                url = "<?php echo $this->Url->build(array('action'=>'index','go'=>'1')); ?>/";
                $('.index-filter').each(function(){
                        if($(this).val()){
                                $name = $(this).attr('name').replace("][",".").replace('data[','').replace(']','') ;
                                url += $name +":"+$(this).val()+"/";
                        }
                });
            window.location = url;
        });

        $('.search').change(function(){
                url = "<?php echo $this->Url->build(array('action'=>$this->request->action,'?'=>['filter'=>'1'])); ?>";
                $('.search').each(function(){
                        var $this_id = "#"+$(this).attr('id');

            if($(this).is(':checkbox') && !$(this).is(':checked')){
                $this_id = "#"+$(this).attr('id')+"_";
            }

            if($($this_id).val()){
                url += "&"+ $(this).attr('name') +"="+$($this_id).val();
            }
            });
            window.location = url;
            
        });
        
        $('.datepicker').attr('type', 'date');
            if (!checkInput("date")) {
                $( ".datepicker" ).datepicker({ dateFormat: "dd-mm-yyyy" });
                $( ".datepicker" ).datepicker("setDate",new Date($('.datepicker').attr('value')));
            }
            
        $('.required > label').after(' <i class="fa fa-asterisk fa-1 text-danger" aria-hidden="true"></i>');

            /*
            $("table.data-table").dataTable();

            $(".colorpicker").colorpicker();

            
            $('.timepicker').attr('type', 'time');
            $(".select2").select2();

            **/



            $('form').preventDoubleSubmission();
    });

    function checkInput(type) {
        var input = document.createElement("input");
        input.setAttribute("type", type);
        return input.type == type;
    }
//]]>
</script>
</body>
</html>