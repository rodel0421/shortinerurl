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
    
    <?= $this->Html->css('custom.css?v1.1')?>
    
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
          <span class='client-name hidden-xs' style='cursor: default;' id='client_name'><?= h($client_name)?><?php if(isset($training_data)) echo " - Training" ;?></span>
      </div>
     </nav>
</header>
<div class="content-wrapper">
    <section class="content">
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
    </section>
</div>
<?php echo $this->element('adminlte_footer');?>    
</div>
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
        
        $( ".datepicker" ).each(function(){
            if(/^\d{2}[/]\d{2}[/]\d{4}$/.test($(this).val())){
                $(this).val($(this).val().split('/').reverse().join("-"));
            }else if(/^\d{1}[/]\d{2}[/]\d{4}$/.test($(this).val())){
                var $date = '0' + $(this).val();
                $(this).val($date.split('/').reverse().join("-"));
            }
        });
        if (checkInput("date")) {
            $('.datepicker').attr('type', 'date');
        }else{
            $( ".datepicker" ).datepicker({ format: "yyyy-mm-dd" });
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