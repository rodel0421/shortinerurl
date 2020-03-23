<?php 

$allowEdit = $register->status == 'Pending Submission';

?>
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'>
            <i class="fa fa-cubes" aria-hidden="true"></i> 
            <?= h($register->register_template->name) ?> for 
            <?= $register->has('user') ? $this->Html->link(h($register->user->name), ['controller' => 'Users', 'action' => 'view', $register->user->id]) : '' ?>
            [<?= $register->has('department') ? $register->department->name : '' ?>]
            <?php if(!($isOfficer || $isAdmin)):?>
            <span class='small'><?= h($register->status) ?> <?= $register->has('register_class') ? $register->register_class->title : '' ?></span>
            <?php endif;?>
        </h3>
    	<div class="box-tools pull-right">
        <?php 
        $back = ($this->request->query('back')) ? $this->request->query('back') :['controller'=>'Users','action' => 'view',$register->user_id];
        echo $this->Html->link('Back',$back , 
            ['escape' => false, 'class' => 'btn btn-default', 'title' => __('Back')]); ?>    
            
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
                 	
        <?php if($register->active):?>
        <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') 
                 		. '</span>', ['action' => 'delete', $register->id], 
                 		['confirm' => __('Are you sure you want to delete this?'), 'escape' => false, 
                 				'class' => 'btn btn-danger', 'title' => __('Delete')]) ?>
        <?php else:?>
            <?= $this->Form->postLink('<span class="fa fa-undo"></span><span class="sr-only">' . __('Restore') 
                 		. '</span>', ['action' => 'delete', $register->id], 
                 		['confirm' => __('Are you sure you want to restore this?'), 'escape' => false, 
                 				'class' => 'btn btn-info', 'title' => __('Restore')]) ?>
        <?php endif;?>    
            
    	<?= $this->element('guide', array("section" => 'registers')) ?>
        
      </div>
    </div>
    <div class='box-body'>
        <?= $register->register_template->about ?>
        
<?php 
$requiredForms = $register->register_template->required_forms;

if(!empty($requiredForms)):?>
<div class='box box-info'>
    <div class='box-header'><h3 class='box-title title-collapse'><?= __('Forms') ?></h3>
    	<div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class='box-body'>        
        
         <?php 
        $has = [];
        ?>
    <?php if (!empty($register->register_forms)): ?>
        
        <?php foreach ($register->register_forms as $registerForms): 
            $has[$registerForms->title] = true;
            ?>
        
        
        <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-sticky-note-o"></i>
          <h3 class="box-title title-collapse"><?= h($registerForms->title) ?></h3>
          <div class="box-tools pull-right">
              <?php if($allowEdit):?>
                <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') 
                 		. '</span>', ['controller' => 'RegisterForms', 'action' => 'edit', $registerForms->id], 
                 		['escape' => false, 'class' => 'btn btn-xs btn-warning btnPreview', 'title' => __('Edit ').h($registerForms->title)]) ?>
                <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') 
                 		. '</span>', ['controller' => 'RegisterForms', 'action' => 'delete', $registerForms->id], 
                 		['confirm' => __('Are you sure you want to delete this form?'), 'escape' => false, 
                 				'class' => 'btn btn-xs btn-danger', 'title' => __('Delete')]) ?>
              <?php endif;?>
      </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <?= $registerForms->content ?>
            <div>
            <?php 
                if(!empty($registerForms->file_url)){
                    $icon = '<span class="file-icon-mini '.h($registerForms->file_ext).'-mini"></span> '.h($registerForms->file_name);
                    echo $this->Dak->link($icon,$registerForms->file_url,array('target'=>'_blank','escape'=>false));
                 }
                 ?>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
        <?php endforeach; ?>
        
    <?php endif; ?>
        
        
 <div class='box-footer noprint'>
        
        <?php if(!empty($requiredForms)):?>
        <h4>Required Forms</h4>
        <?php foreach($requiredForms as $form):?>
        <?php if($form && !isset($has[$form])):?>
        <?php if($allowEdit):?>
        <?= $this->Html->link('<i class="fa fa-plus"></i> Add '.h($form), 
            ['controller'=>'RegisterForms','action' => 'add',$register->id,
            'form'=>$form
            ],
            ['escape'=>false,
                'title'=>'Add '.h($form),
             'class'=>'btn btn-danger btnPreview']) ?> 
             <?php else:?>
             <label class='label label-danger'>Missing: <?=h($form)?></label>
        <?php endif;?>
        <?php endif;?>
        <?php endforeach;?>
        <?php endif;?>
        
        
        </div>
</div>       
        
<?php endif;?>
       
<?php 
$requered = $register->register_template->required_certifications;
$optional = $register->register_template->optional_certifications;

$has = [];
?>
<?php if(!empty($requered) || !empty($optional)):?>
<div class='box <?= (in_array($register->cert_status,[1,2]) || empty($requered))? 'box-success collapsed-box' :'box-danger'?>'>
    <div class='box-header'><h3 class='box-title title-collapse'>
            <?= __('Certifications') ?>
            <span class='small'><?= !empty($requered) ?__('[Required]'):__('[Optional]') ?></span>
        </h3>
    	<div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-<?= (in_array($register->cert_status,[1,2]) || empty($requered))? 'plus' :'minus'?>"></i></button>
      </div>
    </div>
    <div class='box-body'>
    <table class="table table-bordered table-hover data-table">
    <thead>
        <tr>
            <th colspan="3"><?= __('Certification') ?></th>
            <th><?= __('Type') ?></th>
            <th><?= __('Issuer') ?></th>
            <th><?= __('Issued') ?></th>
            <th><?= __('Expires') ?></th>
            <th><?= __('Validated') ?></th>
            <th class="actions">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
            <?php if (!empty($register->user->certifications)): ?>
        <?php foreach ($register->user->certifications as $certifications): ?>
        <tr>
            <td><i class="fa fa-circle status_<?= $certifications->status ?>"></i>&nbsp;</td>
            <td><?php 
                if(!empty($certifications->file_url)){
                    $icon = '<span class="file-icon-mini '.h($certifications->extension).'-mini"></span>';
                    echo $this->Dak->link($icon,$certifications->file_url,array('target'=>'_blank','escape'=>false));
                 }
                 ?>&nbsp;</td>
            <td><?= $certifications->has('certification_type') ? $certifications->certification_type->name : '' ?></td>
            <td><?php 
            $type = $certifications->has('certification_type') ? $certifications->certification_type->type : '';
            if($type){
                //If already has type - take the most current one
                if(isset($has[$type])){
                    $has[$type] = ($has[$type] > $certifications->status)? $certifications->status : $has[$type];
                }else{
                    $has[$type] = $certifications->status;
                }
            }
            ?><?=  $type?></td>
            <td><?= h($certifications->issuer) ?></td>
            <td><?= h($certifications->issued) ?></td>
            <td><?= h($certifications->expires) ?></td>
            <td>
            <?php if($certifications->valid){
                echo 'Validated '. h($certifications->validated_date);
                echo ($certifications->has('validated'))?' by '. $certifications->validated->name:''; 
            }else{
            	if(!$certifications->active){
                    echo 'Archived';
            	}elseif($isAdmin || $isOfficer){
                    echo $this->Form->create($certifications,['url'=>['controller'=>'Certifications','action'=>'edit',$certifications->id,
                        'back'=>$this->Url->build(['action'=>'view',$register->id])]]);
                    echo $this->Form->hidden('valid',['value'=>'1']);
                    echo $this->Form->submit('Validate');
                    echo $this->Form->end();
                }else{
                    echo 'Not yet validated';
                }
            } ?></td>
            <td class="actions">
                 <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') 
                 		. '</span>', ['controller' => 'Certifications', 'action' => 'view', $certifications->id,
            'back'=>$this->Url->build(['action'=>'view',$register->id])], 
                 		['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('View')]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
    <h4>Required Certifications</h4>
    <?php foreach($requered as $cert):?>
    <?php 
    $class = (isset($has[$cert]))? $this->Dak->getStatusClass($has[$cert]):'danger';
    ?>
    <?= $this->Html->link('<i class="fa fa-plus"></i> Add '.h($cert), 
            ['controller'=>'Certifications','action' => 'add',$register->user_id,
            'type'=>$cert,
            'back'=>$this->Url->build(['action'=>'view',$register->id])
            ],
            ['escape'=>false,
             'class'=>'btn btn-'.$class]) ?>   
    <?php endforeach;?>
    <h4>Optional Certifications</h4>
    <?php foreach($optional as $cert):?>
    <?php 
    $class = (isset($has[$cert]))? $this->Dak->getStatusClass($has[$cert]):'danger';
    ?>
    <?= $this->Html->link('<i class="fa fa-plus"></i> Add '.h($cert), 
            ['controller'=>'Certifications','action' => 'add',$register->user_id,
            'type'=>$cert,
            'back'=>$this->Url->build(['action'=>'view',$register->id])
            ],
            ['escape'=>false,
             'class'=>'btn btn-'.$class]) ?>       
    <?php endforeach;?>
    </div>
</div>
<?php endif;?>
        
<div class='box collapsed-box'>
    <div class='box-header'><h3 class='box-title title-collapse'><?= __('Documents') ?> <span class='small'><?= __('[Optional]') ?></span></h3>
    	<div class="box-tools pull-right">
            <?= $this->Html->link('<i class="fa fa-plus"></i> Add Document', 
            ['controller'=>'UserDocs','action' => 'add',$register->user_id,
            'back'=>$this->Url->build(['action'=>'view',$register->id])],
            ['escape'=>false,
             'class'=>'btn btn-default']) ?>
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
      </div>
    </div>
    <div class='box-body'>
        <?php if (!empty($register->user->user_docs)): ?>
    <div class="">
    <table class="table table-bordered table-hover data-table">
    <thead>
        <tr>
            <th><?= __('Name') ?></th>
            <th><?= __('Filesize') ?></th>
            <th><?= __('Created') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($register->user->user_docs as $userDocs): ?>
        <tr>
            <td><?php 
                if(!empty($userDocs->file_url)){
                    $icon = '<span class="file-icon-mini '.h($userDocs->extension).'-mini"></span> '.h($userDocs->name);
                    echo $this->Dak->link($icon,$userDocs->file_url,array('target'=>'_blank','escape'=>false));
                 }
                 ?>&nbsp;<?= ($userDocs->private)?'<i class="fa fa-eye-slash" title="Private - Office Use Only"></i>':'' ?></td>
            <td><?= $this->Number->toReadableSize($userDocs->filesize) ?></td>
            <td><?= h($userDocs->created) ?></td>

            <td class="actions">
                <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>',
                        ['controller' => 'UserDocs','action' => 'view', $userDocs->id,
            'back'=>$this->Url->build(['action'=>'view',$register->id])], ['escape' => false, 'class' => 'btn btn-xs btn-success', 'title' => __('View')]) ?>
                
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <?php endif; ?>
    </div>
</div>        
        
<?php if($register->status == 'Pending Submission'):?>
<div class='box box-info'>
    <div class='box-header'><h3 class='box-title title-collapse'><?= __('Submit to ') ?><?= $register->has('department') ? $register->department->name : 'office' ?> for processing</h3>
    	<div class="box-tools pull-right">
      </div>
    </div>
    <div class='box-body'>
    <?= $this->Form->create($register); ?>
    <?= $this->Form->hidden('status',['value'=>'In Progress'])?>
    <?= $this->Form->button(__('Submit for Processing'), ['bootstrap-type' => 'success']) ?>
    <?= $this->Form->end() ?>
    </div>
</div>
<?php else:?>
<div class='box box-info'>
    <div class='box-header'><h3 class='box-title title-collapse'>Edit Register</h3>
    	<div class="box-tools pull-right">
      </div>
    </div>
    <div class='box-body'>
    <?= $this->Form->create($register,['url'=>['action'=>'view',$register->id,'back'=>$this->request->here]]); ?>
    <?= $this->Form->hidden('status',['value'=>'Pending Submission'])?>
    <?= $this->Form->button(__('Edit'), ['bootstrap-type' => 'warning']) ?>
    <p><i>This will change the current status to 'In Progress'. The Register will need to be resubmitted after changes.</i></p>
    <?= $this->Form->end() ?>
    </div>
</div>    
<?php endif;?>
<?php if($register->status != 'Pending Submission' && ($isOfficer || $isAdmin || $departmentMember) && !$isOwner):?>
<div class='box box-info'>
    <div class='box-header'><h3 class='box-title title-collapse'><?= __('Process Register') ?> <span class='small'>[Office Use Only]</span></h3>
    	<div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-caret-down"></i></button>
      </div>
    </div>
    <div class='box-body'>
    <?php if (!empty($register->register_checklists)): ?>
 
    <table class="table table-bordered table-hover data-table">
    <thead>
        <tr>
            <th><?= __('Title') ?></th>
            <th><?= __('Date') ?></th>
            <th><?= __('Status') ?></th>
            <th colspan="2"><?= __('Comments') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($register->register_checklists as $registerChecklists): ?>
        <tr class='msg-parent'>
            <td><?= h($registerChecklists->title) ?></td>
            
            <td class='col-md-2'><?= $this->Form->input($registerChecklists->id.'.date',
                    ['label'=>false,
                    'default'=>$registerChecklists->date ? $registerChecklists->date->i18nFormat('yyyy-MM-dd') : '',
                    'type'=>'text','class'=>'datepicker update'])?></td>
            <td class='col-md-2'>
                <?= $this->Form->input($registerChecklists->id.'.status',
                ['options'=>[
                    'To be done'=>'To be done',
                    'Complete'=>'Complete',
                    'Not applicable'=>'Not applicable'],
                'class'=>'update',
                'default'=>$registerChecklists->status,
                'type'=>'select',
                'label'=>false])?></td>
            <td class='col-md-4'><?= $this->Form->input($registerChecklists->id.'.comments',
                    ['class'=>'update','label'=>false,
                    'default'=>h($registerChecklists->comments),
                    'type'=>'text'])?>
                </td>
            <td class='col-md-2 msg'><span class="status"></span></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
        <?= $this->Form->create($register); 
            $this->Form->unlockField('_wysihtml5_mode');?>
        <div class='msg-parent'>
                <?= $this->Form->input('notes',
                    ['type'=>'textarea','class'=>'editor'])?>
        </div>
        <div class='row msg-parent'>
            <div class='col-md-4'><?= $this->Form->input('status',
                    ['id'=>'status-update',
                        'options'=>['In Progress'=>'In Progress',
                        'Registered'=>'Registered',
                        'Rejected'=>'Rejected'],
                   ])?></div>
            <div class='col-md-4'><?= $this->Form->input('register_class_id',
                    [
                    'options'=>$registerClasses,
                    'empty'=>'Pending',
                    ])?></div>
            <div class='col-md-4 msg'></div>
        </div>
        <div class="rejected-reson">
            <?= $this->Form->input('reason',['type'=>'textarea'])?>
        </div>
        <?= $this->Form->button('Save', ['bootstrap-type' => 'success']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
<?php endif;?>        
        
</div>
<div class='box-footer'> 
    <?php $footerHtml = '';?>
    <?php 
            $footerHtml .= "<b>". __('Created') .":</b> ";
            $footerHtml .= h($register->created)." ";
            ?>
            <?php 
            $footerHtml .= "<b>". __('Modified') .":</b> ";
            $footerHtml .= h($register->modified)." ";
            ?>
    <?= $footerHtml ?>
</div>
</div>
<script type='text/javascript'>
//<![CDTA[
function updateNotes(){
    $('#register-notes').trigger('change');
            
    return false;
}

$(document).ready(function(){
    var $tk = '<?= $this->request->param('_csrfToken')?>';
    
    <?php if(!isset($this->request->data['reason'])):?>
        $('.rejected-reson').hide();
    <?php endif;?>
    
    $('#status-update').change(function(){
        if($(this).val()=='Rejected'){
            $('.rejected-reson').show();
        }else{
            $('.rejected-reson').hide();   
        }
    });
    
    $('.form-helptext').hide();
    
    $('.update').change(function(){
        $name = $(this).attr('name');
        if($(this).is(':checkbox') && !$(this).is(':checked')){
            $data = $("[name='"+$name+"']").first().serializeArray();
        }else{
            $data = $(this).serializeArray();
        }
        
        var $this_msg = $(this).closest('.msg-parent').find('.msg');
        $this_msg.find('.status').html('<i class="fa fa-refresh fa-spin"></i>');
        if($data){
            $data.push({name: "_csrfToken", value: $tk});
            $.post(
                "<?= $this->Url->build(['controller'=>'RegisterChecklists','action'=>'update'])?>",
                $.param($data),
                function(data){
                    $this_msg.html(data);
                    setTimeout(function(){$this_msg.find('.status').empty()},5000);
                }
                );
        }else{
            $this_msg.find('.status').html('<span class="status"><i class="fa fa-times"></i></span>');
            setTimeout(function(){$this_msg.find('.status').empty()},10000);
        }
    });
    
    
    $('.updateregister').change(function(){
        $name = $(this).attr('name');
        if($(this).is(':checkbox') && !$(this).is(':checked')){
            $data = $("[name='"+$name+"']").first().serializeArray();
        }else{
            $data = $(this).serializeArray();
        }
        
        var $this_msg = $(this).closest('.msg-parent').find('.msg');
        $this_msg.html('<i class="fa fa-refresh fa-spin"></i>');
        if($data){
            $data.push({name: "_csrfToken", value: $tk});
            $.post(
                "<?= $this->Url->build(['action'=>'update'])?>",
                $.param($data),
                function(data){
                    $this_msg.html(data);
                    setTimeout(function(){$this_msg.empty()},5000);
                }
                );
        }else{
            $this_msg.html('<span class="status"><i class="fa fa-times"></i></span>');
            setTimeout(function(){$this_msg.empty()},10000);
        }
    });
});
//]]>
</script>