<?php
echo $this->Html->css('/admin_l_t_e/lib/bootstrap_v3.3.5/css/bootstrap.min.css');
echo $this->Html->css('/admin_l_t_e/lib/font-awesome-4.6.3/css/font-awesome.min.css');
echo $this->Html->css('/admin_l_t_e/lib/AdminLTE_v2.3.7/css/AdminLTE.min.css');
echo $this->Html->css('/admin_l_t_e/lib/AdminLTE_v2.3.7/css/skins/_all-skins.min.css');
echo $this->Html->css('/admin_l_t_e/lib/iCheck/all.css');
echo $this->Html->css('/admin_l_t_e/lib/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');
echo $this->Html->css('/admin_l_t_e/lib/datepicker/datepicker3.css');
echo $this->Html->css('/admin_l_t_e/lib/timepicker/bootstrap-timepicker.min.css');

echo $this->Html->css('/admin_l_t_e/lib/fullcalendar-3.1.0/fullcalendar.min.css');
echo $this->Html->css('/admin_l_t_e/lib/fullcalendar-3.1.0/fullcalendar.print.css',array('media'=>'print'));

echo $this->Html->css('/admin_l_t_e/lib/colorpicker/bootstrap-colorpicker.min.css');

echo $this->Html->css('/libs/selectize/css/selectize.css');
echo $this->Html->css('/libs/selectize/css/selectize.bootstrap3.css');
?>

<script>
  var AdminLTEOptions = {
    boxWidgetOptions: {
        boxWidgetIcons: {
          //Collapse icon
          collapse: 'fa-caret-down',
          //Open icon
          open: 'fa-caret-right',
          //Remove icon
          remove: 'fa-times'
        }
    }
  };
</script>

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<?php

echo $this->Html->script('/admin_l_t_e/lib/jQuery/jQuery-2.1.4.min.js');
echo $this->Html->script('/admin_l_t_e/lib/jQueryUI/jquery-ui.min.js');
echo $this->Html->script('/admin_l_t_e/lib/bootstrap_v3.3.5/js/bootstrap.min.js');
echo $this->Html->script('/admin_l_t_e/lib/slimScroll/jquery.slimscroll.min.js');
echo $this->Html->script('/admin_l_t_e/lib/fastclick/fastclick.js');
echo $this->Html->script('/admin_l_t_e/lib/AdminLTE_v2.3.7/js/app.min.js');
echo $this->Html->script('/admin_l_t_e/lib/iCheck/icheck.min.js');
echo $this->Html->script('/admin_l_t_e/lib/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js');
echo $this->Html->script('/admin_l_t_e/lib/datepicker/bootstrap-datepicker.js');
echo $this->Html->script('/admin_l_t_e/lib/timepicker/bootstrap-timepicker.min.js');

echo $this->Html->script('/admin_l_t_e/lib/moment/moment.min.js');
echo $this->Html->script('/admin_l_t_e/lib/fullcalendar-3.1.0/fullcalendar.min.js');

echo $this->Html->script('/admin_l_t_e/lib/colorpicker/bootstrap-colorpicker.min.js');
//echo $this->Html->script('/admin_l_t_e/lib/ckeditor/ckeditor.js');


echo $this->Html->script('/libs/selectize/js/standalone/selectize.min.js');
?>