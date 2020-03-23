
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><span class="fa fa-users"></span> <?= h($department->name) ?></h3>
    	<div class="box-tools pull-right">
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
                 		
    	<?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') 
                 		. '</span>', ['action' => 'edit', $department->id], 
                 		['escape' => false, 'class' => 'btn btn-warning', 'title' => __('Edit')]) ?>
        
       <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') 
                 		. '</span>', ['action' => 'delete', $department->id], 
                 		['confirm' => __('Are you sure you want to delete # {0}?', $department->id), 'escape' => false, 
                 				'class' => 'btn btn-danger', 'title' => __('Delete')]) ?>
    	
       <?= $this->element('guide', array("section" => 'departments')) ?>
        
      </div>
    </div>
    <div class='box-body'>
    <?php $footerHtml = '';?>
        <dl class="dl-horizontal">
            <dt><?= __('Description') ?></dt>
            <dd><?= h($department->description) ?></dd>
            <dt><?= __('Email') ?></dt>
            <dd><?= h($department->email) ?></dd>
            <dt><?= __('Managers') ?></dt>
            <dd>
                <?php if (!empty($department->leaders)): ?>
                <?php foreach ($department->leaders as $users): ?>
                <span class='badge'><?= h($users->name) ?></span>  
                <?php endforeach; ?>
                <?php endif; ?>
            </dd>
            <dt><?= __('Members') ?></dt>
            <dd>
                <?php if (!empty($department->users)): ?>
                <?php foreach ($department->users as $users): ?>
                <span class='badge'><?= h($users->name) ?></span> 
                <?php endforeach; ?>
                <?php endif; ?>
            </dd>
        </dl>
        <dl class="dl-horizontal">
            <?php 
            $footerHtml .= "<b>". __('Created') .":</b> ";
            $footerHtml .= h($department->created)." ";
            ?>
            <?php 
            $footerHtml .= "<b>". __('Modified') .":</b> ";
            $footerHtml .= h($department->modified)." ";
            ?>
        </dl>
        <table class='table'>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Expiring Certifications</th>
                    <th>Expiring Registers</th>
                </tr>
            </thead>
            <tbody>
                
        <?php 
        foreach($users as $user):
            if(!empty($user->registers) || !empty($user->certifications)):?>
                <tr>
                    <th><?= h($user->name)?></th>
                    <td>
                        <?php 
                        if(!empty($user->certifications)):
                        foreach($user->certifications as $certification):?>
                        <?= $certification->has('certification_type')? h($certification->certification_type->name) : 'Unknown' ?>
                        (<?=  $certification->expires->timeAgoInWords(); ?>)
                        
                        <br/>
                        <?php endforeach;
                        else:
                            echo '&nbsp;';
                        endif;
                        ?>
                    </td>
                    <td>
                        <?php 
                        if(!empty($user->registers)):
                        foreach($user->registers as $register):?>
                        <?= $register->has('register_template')? h($register->register_template->name) : 'Unknown' ?><br/>
                        <?php endforeach;
                        else:
                            echo '&nbsp;';
                        endif;
                        ?>
                    </td>
                </tr>
        <?php 
            endif;
        endforeach;?>
            </tbody>
        </table>
</div>
<div class='box-footer'>
    <?= $footerHtml ?>
</div>
</div>
