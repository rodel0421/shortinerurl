
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><i class="fa fa-envelope"></i> <?= __('Contact Us') ?></h3>
    	<div class="box-tools pull-right">
    	        
      </div>
    </div>
    <div class='box-body'>
    <?php 
    echo $this->Form->create($contact);
    echo $this->Form->input('name');
    echo $this->Form->input('email',['label'=>'From','help'=>'Email Address']);
    echo $this->Form->input('message');
    echo $this->Form->button('Send');
    echo $this->Form->end();
    ?>
</div>
</div>
<script type="text/javascript"> 
//<![CDTA[
    $(document).ready(function(){
        
    });
//]]>
</script>