<div class="modal fade" id="previewModel" tabindex="-1" role="dialog" 
         aria-labelledby="previewModelLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="previewModelLabel"></h4>
        </div>
        <div class="modal-body" id="previewModel-body" ></div>
        <div class="modal-footer" id="previewModel-footer">
          <button type="button" class="btn btn-success" id="bottom-submit">Submit</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" id="bottom-close-button">Close</button>
        </div>

      </div>

    </div>
</div>        
<script type="text/javascript"> 
//<![CDTA[
    $(document).ready(function(){
       $('a.btnPreview').click(previewLink);

       $("#bottom-submit").click(function(){
         
         $(this).closest('#previewModel').find('form').submit();
       });
    });
    
    function previewLink(){
        var $url = this.href;
        $('#previewModel-body').html('<img src="<?php echo $this->Url->build('/img/ajax_indicator.gif');?>"/>');

        var $title = 'Preview';
        if($(this).attr('title')){
            $title = $(this).attr('title');
        }
        $('#previewModelLabel').html($title);
        $('#previewModel').modal();

        var $isForm = $(this).attr('isForm');
        
        if($isForm){
          $("#bottom-close-button").hide();
          $("#bottom-submit").show();
        }else{
          $("#bottom-submit").hide();
          $("#bottom-close-button").show();
        }
        
        $.ajax({
            url     : $url,
            type    : 'get',
            success : function (response) {
              $('#previewModel-body').html( response );
              if($isForm){
                $("#previewModel-body").find(':submit').hide();
              }
            },
            error : function(jqXHR,textStatus,errorThrown ){
                window.location = $url;
            }
        });
        return false;
    }
//]]>
</script>