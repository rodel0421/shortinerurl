<div class='box'>
    <div class='box-header'><h3 class='box-title'>
        <i class="fa fa-user" aria-hidden="true"></i> <?= $this->request->query('archived')?'Archived':''?> Users</h3>
    	<div class="box-tools pull-right">
    	<div class="btn-group">
        <!-- <?= $this->Html->link('<i class="fa fa-search" aria-hidden="true"></i>', 
            ['action' => 'search'],['escape'=>false,'class'=>'btn btn-default','title'=>'Add']) ?> -->
        <?= $this->Html->link('<i class="fa fa-plus" aria-hidden="true"></i>', 
            ['action' => 'add'],['escape'=>false,'class'=>'btn btn-default','title'=>'Add']) ?>
        <?= $this->Html->link('<i class="fa fa-paper-plane" aria-hidden="true"></i>', 
            ['action' => 'invite'],['escape'=>false,'class'=>'btn btn-default','title'=>'Invite via email']) ?>
        
        <?php if($this->request->query('archived')){
            echo $this->Form->hidden('archived',['value'=>1,'class'=>'search','id'=>'archived']);
            echo $this->Html->link('<i class="fa fa fa-bars" aria-hidden="true"></i>', 
                ['action' => 'index'],['escape'=>false,'class'=>'btn btn-default','title'=>'Show All']);
        }else{
            echo $this->Html->link('<i class="fa fa-archive" aria-hidden="true"></i>', 
                ['action' => 'index','archived'=>1],['escape'=>false,'class'=>'btn btn-default','title'=>'Show Archived']);
        }?>
      </div>
      </div>
    </div>
    <div class='box-body'>
    <div class="table-responsive">
        <table class="data-table-render table table-striped table-hover dbclick2open">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('given_name') ?></th>
                <th><?= $this->Paginator->sort('surname') ?></th>
                <th><?= $this->Paginator->sort('group_id','Access Level') ?></th>
                <th><?= $this->Paginator->sort('user_type_id','Type') ?></th>
                <th>Departments</th>
                <th><?= $this->Paginator->sort('created') ?></th>
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
            <th><?= 
                 $this->Form->input('Users.surname',array(
                    'class'=>'search', 'label' => false,
                    'style'=>'width:150px;',
                    'div' => false, 'required'=>false,
                    'type'=>'text'
                    ))?></th>
            <th><?= 
                 $this->Form->input('Users.group_id',array(
                    'class'=>'search', 'label' => false,
                    'style'=>'width:150px;',
                    'div' => false, 'required'=>false,
                    'options'=>$groups,'empty'=>true
                    ))?></th>
            <th><?= 
                 $this->Form->input('Users.user_type_id',array(
                    'class'=>'search', 'label' => false,
                    'style'=>'width:150px;',
                    'div' => false, 'required'=>false,
                    'options'=>$userTypes,'empty'=>true
                    ))?></th>

            </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr data-id="<?= $user->id?>">
                <td><?= h($user->given_name) ?></td>
                <td><?= h($user->surname) ?></td>
                <td class="<?= $user->has('group') ? h($user->group->style) : '' ?>">
                    <?= $user->has('group') ? $user->group->name : '' ?>
                </td>
                <td>
                    <?= $user->has('user_type') ? $user->user_type->title : '' ?>
                </td>
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
                <td><?= h($user->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', ['action' => 'view', $user->id], ['escape' => false, 'class' => 'btn btn-xs btn-success', 'title' => __('View')]) ?>
                    <?php if($user->disabled):?>
                        <?= $this->Form->postLink('<span class="fa fa-unlock"></span><span class="sr-only">' . __('Enable') 
                        . '</span>',
                ['action' => 'disable', $user->id],
                ['confirm' => __('Are you sure you want to enable this account?'), 'escape' => false, 
                 	'class' => 'btn btn-sm btn-danger', 'title' => __('Enable')])?>
                    <?php else:?>
                    <?php if(!$user->active):?>
                    <?= $this->Form->postLink('<span class="fa fa-undo"></span><span class="sr-only">' . __('Restore') 
                        . '</span>', ['action' => 'delete', $user->id], 
                        ['confirm' => __('Are you sure you want to restore this?'), 'escape' => false, 
                                        'class' => 'btn btn-xs btn-info', 'title' => __('Restore')]) ?>
                        <?php else: ?>
                    <?= $this->Form->postLink('<span class="fa fa-ban"></span><span class="sr-only deactivate">' . __('Deactivate') 
                        . '</span>', ['action' => 'delete', $user->id], 
                        ['confirm' => __('Are you sure you want to deactivate this?'), 'escape' => false, 
                                        'class' => 'btn btn-xs btn-danger', 'title' => __('Deactivate Account!')]) ?>
                    <?php endif;?>
                    
                    <?php endif;?>
                </td>
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