<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$id = 'ajax-'.rand();
?>
<div id='<?=$id?>'>
<?= $this->fetch('content') ?>
</div>
<script type="text/javascript"> 
//<![CDTA[
    $(document).ready(function(){
        //console.log('Scope: <?=$id?>');
        $scope = $('#<?=$id?>');
        $( ".datepicker" ,$scope).each(function(){
            if(/^\d{2}[/]\d{2}[/]\d{4}$/.test($(this).val())){
                $(this).val($(this).val().split('/').reverse().join("-"));
            }
        });
        if (checkInput("date")) {
            $('.datepicker',$scope).attr('type', 'date');
        }else{
            $( ".datepicker",$scope).datepicker({ format: "yyyy-mm-dd" });
        }
        
        if (checkInput("time")) {
            $('.timepicker',$scope).attr('type', 'time');
        }else{
            $(".timepicker",$scope).timepicker();
        }
            
        $('.required > label',$scope).after(' <i class="fa fa-asterisk fa-1 text-danger" aria-hidden="true"></i>');

        try { $(".editor",$scope).wysihtml5(); } 
        catch (error){ console.log(error); }

        $('form',$scope).preventDoubleSubmission();
        
        $('a.btnPreview',$scope).click(previewLink);
    });

//]]>
</script>