<?php 
$showTypes = count($userTypes->toArray()) > 0;
?>
<div class='box'>
    <div class='box-header'><h3 class='box-title'>
        <i class="fa fa-user" aria-hidden="true"></i> <?= $this->request->query('archived')?'Deleted':''?> People Lookup</h3>
    	<div class="box-tools pull-right">
    	<div class="btn-group">
       <?php if($isOfficer || $isAdmin):?>
        <?php if($this->request->query('archived')){
            echo $this->Form->hidden('archived',['value'=>1,'class'=>'search','id'=>'archived']);
            echo $this->Html->link('<i class="fa fa fa-bars" aria-hidden="true"></i>', 
                ['action' => 'index'],['escape'=>false,'class'=>'btn btn-default','title'=>'Show All']);
        }else{
            echo $this->Html->link('<i class="fa fa-trash-o" aria-hidden="true"></i>', 
                ['action' => 'index','archived'=>1],['escape'=>false,'class'=>'btn btn-default','title'=>'Show Deleted']);
        }?>
        <?php endif;?>
      </div>
      </div>
    </div>
    <div class='box-body'>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('name') ?></th>
                <?php if(!$userView):?>
                <th><?= $this->Paginator->sort('group_id','Access Level') ?></th>
                <?php if($showTypes):?>
                <th><?= $this->Paginator->sort('user_type_id','Type') ?></th>
                <?php endif;?>
                <th>Departments</th>
                <?php endif;?>
                <th colspan="2">Registers</th>
                <th>Certifications</th>
                <th>Status</th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <tr>
              <th><?= 
                 $this->Form->input('Users.name',array(
                    'class'=>'search', 'label' => false,
                    'style'=>'width:150px;',
                    'div' => false, 'required'=>false,
                    'type'=>'text'
                    ))?></th>
              <?php if(!$userView):?>
                <th><?= 
                 $this->Form->input('Users.group_id',array(
                    'class'=>'search', 'label' => false,
                    'style'=>'width:150px;',
                    'div' => false, 'required'=>false,
                    'options'=>$groups,'empty'=>true
                    ))?></th>
            <?php if($showTypes):?>
                <th><?= 
                 $this->Form->input('Users.user_type_id',array(
                    'class'=>'search', 'label' => false,
                    'style'=>'width:150px;',
                    'div' => false, 'required'=>false,
                    'options'=>$userTypes,'empty'=>true
                    ))?></th>
            <?php endif;?>
              <th><?= 
                 $this->Form->input('department_id',array(
                    'class'=>'search', 'label' => false,
                    'style'=>'width:150px;',
                    'div' => false, 'required'=>false,
                    'options'=>$departments,'empty'=>true
                    ))?></th>
                <?php endif;?>
              <th><?php
                echo $this->Form->input('register_template_id',array(
                    'class'=>'search select3', 'label' => false,
                    'style'=>'width:150px;',
                    'div' => false, 'required'=>false,
                    'options'=>$registerTemplates,'empty'=>true
                    ));?></th>
              <th><?php
                if(isset($registerClasses)){
                 echo $this->Form->input('register_class_id',array(
                    'class'=>'search', 'label' => false,
                    'style'=>'width:150px;',
                    'div' => false, 'required'=>false,
                    'options'=>$registerClasses,'empty'=>'(Any Class)'
                    ));
                }?></th>
              <th><?= 
                 $this->Form->input('certification_class_id',array(
                    'class'=>'search', 'label' => false,
                    'style'=>'width:150px;',
                    'div' => false, 'required'=>false,
                    'options'=>$certificationClasses,'empty'=>true
                    ))?></th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr data-id="<?= $user->id?>">
                <td><?php if($isOfficer || $isAdmin):?><?= $this->Html->link(h($user->name),['controller'=>'Users','action'=>'view',$user->id]) ?><?php else:?><?= h($user->name) ?><?php endif;?></td>
                <?php if(!$userView):?>
                <td class="<?= $user->has('group') ? h($user->group->style) : '' ?>">
                    <?= $user->has('group') ? $user->group->name : '' ?>
                </td>
                <?php if($showTypes):?>
                <td>
                    <?= $user->has('user_type') ? $user->user_type->title : '' ?>
                </td>
                <?php endif;?>
                <td>
                    <?php
                    $temp = [];
                    if ($user->has('departments')){
                        foreach($user->departments as $departments){
                            $temp[] = h($departments->name);
                        }
                    }                     
                    echo implode(', ', $temp) ?>&nbsp;
                </td>
                <?php endif;?>
                <td colspan="2"><?php foreach($user->registers as $register):
                    $title = $register->register_template->name;
                    $title .= ': '.$register->register_class->title;
                    $title .= ' - '.$this->Dak->getStatus($register->cert_status);
                    $class = 'inline_icon status_'.$register->cert_status;
                    ?>
                    <?= ($register->register_class->icon)? $this->Html->image($register->register_class->icon,
                        ['class'=>$class,'title'=>$title]) : $title ?>
                    <?php endforeach;?>&nbsp;</td>
                <td><?php foreach($user->certifications as $certification):
                    if($certification->has('certification_type') && $certification->certification_type->has('certification_class')):
                        $title = $certification->certification_type->certification_class->name;
                        $title .= ' - '.$this->Dak->getStatus($certification->status);
                        $class = 'inline_icon status_'.$certification->status;
                        ?>
                        <?=  $this->Html->image($certification->certification_type->certification_class->icon,
                            ['class'=>$class,'title'=>$title]) ?>
                    <?php endif;?>
                    <?php endforeach;?>&nbsp;</td>
                <td>
                    <?= $this->Dak->displayStatus($user->register_status) ?>
                    <?= $this->Dak->displayStatus($user->certification_status) ?>
                    <?= $this->Dak->displayStatus($user->equipment_status) ?>
                </td>
                <td class="actions">&nbsp;</td>
            </tr>

        <?php endforeach; ?>
        </tbody>
        </table>
    </div>
    </div>
    <div class='box-footer'>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
</div>
<script type="text/javascript"> 
//<![CDTA[

$(document).ready(function(){
    $('.select3').selectize();
});


//]]>
</script>