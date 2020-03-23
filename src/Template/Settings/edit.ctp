<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Edit Setting') ?></h3>
        <div class="box-tools pull-right">
            <div class="btn-group">
            </div>
        </div>
    </div>
    <div class='box-body'>
        
        <?= $this->Form->create($setting); ?>
        <?php
            echo $this->Form->input('name',[
                'label'=>'Organisation Name',
                'help'=>'This is the name that shows at the top of every page.']);
            echo $this->Form->input('short',[
                'label'=>'Short Name',
                'help'=>'This is the name in the top left on every page. Between 3 and 5 characters']);
            //echo $this->Form->input('abv',['label' => 'ABV']);
            //echo $this->Form->input('abn',['label' => 'ABN']);
            echo $this->Form->input('enabled_areas',[
                'options'=>$areas,
                'multiple'=>true,
                'class'=>'select3']);
            //echo $this->Form->input('contact_email');
            //echo $this->Form->input('postal_address');
            //echo $this->Form->input('billing_email');
            echo $this->Form->input('auth_domain_csv',[
                'label' => 'List of email associated domains.',
                'help'=>'Enter one per line. Example domain: domain.com'
                ]);
            /*echo $this->Form->input('email_disabled',[
                'label' => 'Disable email transmissions for testing purposes.',
                'help'=>'You may disable email transmissions for testing purposes.<br>This has no effect on system emails needed for User Registration and other purposes.<br/>Please keep this On for it to function correctly.'
                ]);*/
        ?>
    <?= $this->Form->button(__('Save'), ['bootstrap-type' => 'success']) ?>
    <?= $this->Form->end() ?>
</div>
</div>
<script type="text/javascript"> 
//<![CDTA[

        
   $(document).ready(function(){
       
       $('.select3').selectize();
       
   });

</script>