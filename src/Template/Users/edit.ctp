<style>
label#errorpass {
    color: red;
    font-weight: 200;
}
</style>


<?php 
    $this->assign('title', h($user->name).' Edit Profile');
    $avatar = 'img/profile.jpg';
    if(!empty($user->profile_url)){
        $avatar = $user['profile_url'];
        $this->Dak->allow_file($avatar);
    }
    $user->dob = date('Y-d-m', strtotime($user->dob));
    ?>
<!-- 
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Edit User Account') ?></h3>
    	<div class="box-tools pull-right">
    	
    	<?= $this->Html->link('Back', ['action' => 'view',$user->id], 
                ['escape' => false, 
                'class' => 'btn btn-default', 
                'title' => __('Back')]) ?>
        
        <?php if($isAdmin || $isOfficer):?>
    	<?= $this->Form->postLink(
        		'<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', 
                $user->id), 'escape' => false, 
                 	'class' => 'btn btn-danger', 'title' => __('Delete')]
            )
        ?>
        <?php endif;?>
		
      </div>
    </div>
    <div class='box-body'>
    <?= $this->Form->create($user, ['type' => 'file']); ?>
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Personal Information') ?></h3>
    	<div class="box-tools pull-right">
      </div>
    </div>
    <div class='box-body'>
        <div class='row'>
            <div class='col-sm-3'><?= $this->Form->input('given_name')?></div>
            <div class='col-sm-3'><?= $this->Form->input('surname')?></div>
            <div class='col-sm-3'><?= $this->Form->input('name',['label'=>'Display Name'])?></div>
            <div class='col-sm-3'><?= $this->Form->input('email')?></div>
        </div>
        <div class='row'>
            <?php if(!empty($userTypes)):?>
            <div class='col-sm-3'><?= $this->Form->input('user_type_id',['empty'=>'(Select One)','options'=>$userTypes,'label'=>'Type'])?></div>
            <?php endif;?>
            <div class='col-sm-3'><?= $this->Form->input('phone')?></div>
            <div class='col-sm-3'><?= $this->Form->input('mobile')?></div>
            <div class='col-sm-3'><?= $this->Form->input('dob',
                ['type'=>'text',
                'class'=>'datepicker',
                'label'=>'DOB'])?></div>
        </div>
        <div class="row">
            <div class='col-sm-6'><?= $this->Form->input('address')?></div>
        </div>
        <div class='row'>
            <div class='col-sm-3'><?= $this->Form->input('emergency_contact_name')?></div>
            <div class='col-sm-3'><?= $this->Form->input('emergency_contact_number')?></div>
        </div>
        <div class='row'>
            <div class='col-sm-6'><?=  $this->Form->input('profile_url', [
                'type' => 'file',
                'help'=>'.gif, .jpg, .png, .jpeg',
                'label' => 'Upload Profile Picture'
                ])?></div>
        </div>
</div>
</div>

<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Company, University or School Information') ?></h3>
    	<div class="box-tools pull-right">
      </div>
    </div>
    <div class='box-body'>
        <div class='row'>
            <div class='col-sm-3'><?= $this->Form->input('company_name')?></div>
            <div class='col-sm-3'><?= $this->Form->input('company_contact')?></div>
            <div class='col-sm-3'><?= $this->Form->input('position',['label'=>'Position at Company'])?></div>
        </div>
        <div class='row'>
            <div class='col-sm-6'><?= $this->Form->input('company_address')?></div>
        </div>
        <div class='row'>
            <div class='col-sm-3'><?= $this->Form->input('supervisor',['label'=>'Supervisor Name'])?></div>
            <div class='col-sm-3'><?= $this->Form->input('supervisor_email')?></div>
            <div class='col-sm-3'><?= $this->Form->input('supervisor_phone')?></div>
        </div>
</div>




<?php if($isOfficer || $isAdmin):?>
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><?= __('Office Use Only') ?></h3>
    	<div class="box-tools pull-right">
      </div>
    </div>
    <div class='box-body'>
        <div class='row'>
            <div class='col-sm-3'><?= $this->Form->input('username')?></div>
            <div class='col-sm-3'><?= $this->Form->input('group_id')?></div>
            <div class='col-sm-6 select-departments'><?= $this->Form->input('departments._ids',['class'=>'select3'])?></div>
        </div>
        <div class='row'>
            <div class='col-sm-6'><?= $this->Form->input('flag',[
                'class'=>'flag_select',
                'multiple'=>true,
                'options'=>$flags,
                'help'=>'Select from existing flags or enter a new flag in the box.'
                ]);?></div>
            
            <div class='col-sm-6 select-departments'><?= $this->Form->input('leads._ids',
                    ['class'=>'select3',
                        'label'=>'Manages',
                    'options'=>$departments])?></div>
        </div>
        <?php if(isset($providers) && count($providers) > 1):?>
        <div class='row'>
            <div class='col-sm-3'><?= $this->Form->input('provider',
                    ['label'=>'Login Type','help'=>'Only change if you know what you are doing.'])?></div>
        </div>
        <?php endif;?>
</div>
</div>
<?php endif;?>
    
</div>
    <?= $this->Form->button(__('Submit'), ['bootstrap-type' => 'success']) ?>
    <?= $this->Form->end() ?>
</div>
</div>
<script type="text/javascript"> 
//<![CDTA[

$(document).ready(function(){
    $('.flag_select').selectize({
        delimiter: ',',
        persist: false,
        create: function(input) {
            return {
                value: input,
                text: input
            }
        }
    });
    
    
    $('.select3').selectize();
});

//]]>
</script> -->

<div class="box box-warning">
    <?= $this->Form->create($user, ['type' => 'file']); ?>
        <div class="box-header">
            <h3 class="box-title">
                <i class="glyphicon glyphicon-user"></i>
                Edit Profile
            </h3>
        </div>
        <div class="box-body">
            <h3 class="font-weight-bold">
                Personal Details
            </h3>
            <hr>
            <div class="row">
                <div class="col-12 col-md-2 text-center">
                    <?php echo $this->Html->image($avatar,
                        array('class'=>'profile-user-img img-responsive img-rounded',
                        'id'=>'profile_url_preview', 'pathPrefix' => ''));
                    ?>
                    <br>
                    <div class="proflie_picture_upload-wrapper">
                        <button type="button">Change Profile Picture</button>
                        <?=  $this->Form->input('profile_url', [
                            'type' => 'file',
                            'help'=>'.gif, .jpg, .png, .jpeg',
                            'label' => false,
                            'title' => '',
                            'id' => 'profile_url',
                            'accept' => 'image/*;capture=camera'
                        ])?>
                    </div>
                </div>
                <div class="col-12 col-md-10">
                    <div class="row">
                        <div class='col-12 col-md-3'><?= $this->Form->input('given_name')?></div>
                        <div class='col-12 col-md-3'><?= $this->Form->input('surname')?></div>
                        <div class='col-12 col-md-3'><?= $this->Form->input('name',['label'=>'Display Name'])?></div>
                        <?php if(!empty($userTypes)):?>
                            <div class="col-12 col-md-3">
                                <?= $this->Form->input('user_type_id',['empty'=>'(Select One)','options'=>$userTypes,'label'=>'Type'])?>
                            </div>
                        <?php endif;?>
                        <div class='col-12 col-md-6'><?= $this->Form->input('email', ['type' => 'email'])?></div>
                        <div class='col-12 col-md-6'><?= $this->Form->input('password', ['value'=> 'zxcvbnmlkj'])?></div>
                        <div class='col-sm-4'><?= $this->Form->input('phone')?></div>
                        <div class='col-sm-4'><?= $this->Form->input('mobile')?></div>

                        <div class='col-sm-4'><?= $this->Form->input('dob',
                            ['type'=>'text',
                            'class'=>'datepicker',
                            'label'=>'DOB',
                            ])?>
                        </div>
                    </div>
                </div>
            </div>
            <h3 class="font-weight-bold">
                Company Details
            </h3>
            <hr>
            <div class="row">
                <div class='col-12 col-md-8'>
                    <?= $this->Form->input('company_name')?>
                </div>

                <div class='col-12 col-md-4'>
                    <?= $this->Form->input('company_contact')?>
                </div>
                <div class='col-12 col-md-4'>
                    <?= $this->Form->input('position',['label'=>'Position at Company'])?>
                </div>
                <div class='col-12 col-md-8'>
                    <?= $this->Form->input('company_address')?>
                </div>
                <div class='col-12 col-md-4'>
                    <?= $this->Form->input('supervisor',['label'=>'Supervisor Name'])?>
                </div>
                <div class='col-12 col-md-4'>
                    <?= $this->Form->input('supervisor_email')?>
                </div>
                <div class='col-12 col-md-4'>
                    <?= $this->Form->input('supervisor_phone')?>
                </div>

            </div>
            <h3 class="font-weight-bold">
                Emergency Contact
            </h3>
            <hr>
            <div class="row">
                <div class='col-12 col-md-6'>
                    <?= $this->Form->input('emergency_contact_name')?>
                </div>
                <div class='col-12 col-md-6'>
                    <?= $this->Form->input('emergency_contact_number')?>
                </div>
            </div>
        </div>
        <div class="box-footer text-right">
            <?= $this->Form->button(__('Submit'), ['bootstrap-type' => 'success']) ?>
        </div>
    <?= $this->Form->end();?>
</div>

<script type="text/javascript">
    $('#profile_url').change(() => {
        el = document.getElementById('profile_url');
        if (el.files && el.files[0]) {
            let reader = new FileReader();
            
            reader.onload = function(e) {
                $('#profile_url_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(el.files[0]);
        }
    })

    $('#password-button').click(() => {
    var pass1 = $('input[name=newpassword]').val();
    var pass2 = $('input[name=confirmpassword]').val();
    if(pass1 != '' && pass1 != pass2) {
    //show error
    document.getElementById("errorpass").innerHTML = "Password doesn't match, Please Check and try again.";
    
}
});
</script>