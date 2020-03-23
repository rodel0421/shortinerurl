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
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <?= $this->Html->css('custom.css?v1.1')?>
    <?= $this->Html->css('bootstrap-chosen')?>
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
</head>

<?php 

    $auth_user = $this->request->session()->read('Auth');

    $body_class = 'skin-purple-light';
    $body_other = '';
    if(isset($this->request->query['print'])){
        $body_other = 'onload="window.print();"';
        $body_class += ' sidebar-collapse';
    }

?>
<body class='<?= $body_class?>' <?= $body_other?>>
<!-- <?= 'staff' ?> -->
<div class="wrapper">
    <header class="main-header">
        <?= $this->cell('Menu::messages_ticker',['facility_id'=>$currentFacility_id])?>
        <a href="#" class="logo hidden-xs" data-toggle="offcanvas" role="button" id="sidebar-toggle" title="Toggle Menu">
            <?= '<span style="font-weight: bold;
    font-size: 30px;
    color: #FFFFFF;
    ">'.$app_logo_text.$this->Html->image('ddms.png',[
                                'class' => 'pull-right',
                                'style' => 'margin-top: 10px;height:30px',
                                'alt'=>'Icon'
                                ]).'</span>' ?>

            <div class="sidebar-toggle h3" style="position: relative; top: -23px; padding-bottom: 11px; padding-right: 2px;">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </div>
        </a>

    <nav class="navbar navbar-static-top">
        <span class='client-name hidden-xs' style='cursor: default;' id='client_name'><?= h($client_name)?><?php if(isset($training_data)) echo " - Training" ;?></span>

      <div class="navbar-custom-menu">
          
        <ul class="nav navbar-nav">
            <div class="sidebar-toggle visible-xs-block" data-toggle="offcanvas" >
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </div>
            <?= $this->element('menu-guides') ?>
            <?= $this->cell('Menu::messages',['facility_id'=>$currentFacility_id])?>
            <?= $this->cell('Menu::alerts',['user_id'=>(int)$auth_user['User']['id'] ])?>
            <?= $this->element('facilities',compact('currentFacility_id','facilityList','facilityABV'))?>
            <?php echo $this->element('user-top-menu');?>
        </ul>
      </div>
    </nav>
    </header>
    
    
    <?php echo $this->element('adminlte_left_sidebar');?>
    
    <div class="content-wrapper">
        <section class="content">
            <?php 
          if(isset($auth_user['User']['id'])){
            echo $this->cell('Menu::alerts_list',['user_id'=>(int)$auth_user['User']['id'] ]);
          }?>
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
        </section>
    </div>
           
    <?php echo $this->element('adminlte_footer');?>     
    
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
            
        }).keypress(function(e) {
            if ((e.keyCode || e.which) == 13) {
                $(this).trigger('change');
            }
        });
        
        $('.title-collapse').click(function(){
            $(this).closest('.box-header').find("[data-widget='collapse']").click();
        });
        
        
        $("[data-widget='collapse']").on('click',
                function(){
            $box = $(this).data('boxid');
            if($(this).children().first().hasClass('fa-caret-down')){
                $collapsed = 1;
            }else{
                $collapsed = 0;
            }
            
            $data = {
                type: "box-state", 
                box: $box, 
                state: $collapsed,
                _csrfToken: '<?= $this->request->param('_csrfToken')?>'
            };
            $.post( "<?= $this->Url->build(['controller'=>'Users','action'=>'settings'])?>", $data);
            
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
        
        //Timepicker
        if (checkInput("time")) {
            $('.timepicker').attr('type', 'time');
        }else{
            $(".timepicker").timepicker();
        }
            
        $('.required > label').after(' <i class="fa fa-asterisk fa-1 text-danger" aria-hidden="true"></i>');

            /*
            $("table.data-table").dataTable();

            $(".colorpicker").colorpicker();

            
            $('.timepicker').attr('type', 'time');
            $(".select2").select2();

            **/

        
        try { $(".editor").wysihtml5(); } 
        catch (error){ console.log(error); }
            
        $('form').preventDoubleSubmission();
    });

    function checkInput(type) {
        var input = document.createElement("input");
        input.setAttribute("type", type);
        return input.type == type;
    }
    
//]]>
</script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<?= $this->Html->script('jquery.ellipsis')?>
<?= $this->Html->script('chosen.jquery')?>
<?= $this->Html->script('chosen')?>
<?= $this->Html->script('taro'); ?>
</body>
</html>
