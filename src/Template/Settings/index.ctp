<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('First time setup') ?></h3>
        <div class="box-tools pull-right">
            <div class="btn-group">
            </div>
        </div>
    </div>
    <div class='box-body'>
        <?= $this->Form->create($setting); ?>
        <?php
            echo $this->Form->input('name',[
                'label'=>'Site Name',
                'help'=>'This is the name that shows at the top of every page.']);
            echo $this->Form->input('url',['label' => 'Site domain','default'=>$_SERVER['HTTP_HOST'],'help'=>'No http:// or https:// just the domain.']);
            //echo $this->Form->input('abn',['label' => 'ABN']);
            
            echo $this->Form->input('contact_email',[
                'label'=>'Admin Email address','help'=>'The user account created with this email address will become an admin after the validation process.'
                ]);
            
        ?>
    <?= $this->Form->button(__('Next'), ['bootstrap-type' => 'success']) ?>
    <?= $this->Form->end() ?>
</div>
</div>