
<div class='box box-primary'>
    <div class='box-header'><h3 class='box-title'><i class="fa fa-cubes" aria-hidden="true"></i> <?= h($registerTemplate->name) ?></h3>
    	<div class="box-tools pull-right">
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
                 		
    	<?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') 
                 		. '</span>', ['action' => 'edit', $registerTemplate->id], 
                 		['escape' => false, 'class' => 'btn btn-warning', 'title' => __('Edit')]) ?>
        
        <?php if($registerTemplate->active):?>
        <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') 
                 		. '</span>', ['action' => 'delete', $registerTemplate->id], 
                 		['confirm' => __('Are you sure you want to delete this?'), 'escape' => false, 
                 				'class' => 'btn btn-danger', 'title' => __('Delete')]) ?>
        <?php else:?>
            <?= $this->Form->postLink('<span class="fa fa-undo"></span><span class="sr-only">' . __('Restore') 
                 		. '</span>', ['action' => 'delete', $registerTemplate->id], 
                 		['confirm' => __('Are you sure you want to restore this?'), 'escape' => false, 
                 				'class' => 'btn btn-info', 'title' => __('Restore')]) ?>
        <?php endif;?>
            
    	<?= $this->element('guide', array("section" => 'registerTemplates')) ?>
        
      </div>
    </div>
    <div class='box-body'>
    <?php $footerHtml = '';?>
        <dl class="dl-horizontal">
            <dt><?= __('Name') ?></dt>
            <dd><?= h($registerTemplate->name) ?></dd>
            <dt><?= __('Required Forms') ?></dt>
            <dd><?= implode(', ', $registerTemplate->required_forms) ?></dd>
        </dl>
        <dl class="dl-horizontal">
            <?php 
            $footerHtml .= "<b>". __('Created') .":</b> ";
            $footerHtml .= h($registerTemplate->created)." ";
            ?>
            <?php 
            $footerHtml .= "<b>". __('Modified') .":</b> ";
            $footerHtml .= h($registerTemplate->modified)." ";
            ?>
        </dl>
    
    <dl class="dl-horizontal">
       <dt><?= __('About') ?></dt>
       <dd><?= $registerTemplate->about ?></dd>
    </dl>
    <dl class="dl-horizontal">
       <dt><?= __('Checklists') ?></dt>
       <dd><?= $this->Text->autoParagraph(h($registerTemplate->checklists)); ?></dd>
    </dl>
    <dl class="dl-horizontal">
       <dt><?= __('Required Certifications') ?></dt>
       <dd><?= implode(', ', $registerTemplate->required_certifications) ?></dd>
       <dt><?= __('Optional Certifications') ?></dt>
       <dd><?= implode(', ', $registerTemplate->optional_certifications) ?></dd>
    </dl>
</div>
<div class='box-footer'>
    <?= $footerHtml ?>
</div>
</div>
<div class='box box-info'>
    <div class='box-header'><h3 class='box-title'><?= __('Register Classes') ?></h3>
    	<div class="box-tools pull-right">
            <?= $this->Html->link('<i class="fa fa-plus"></i> Add Register Class', ['controller'=>'RegisterClasses','action' => 'add',$registerTemplate->id],
    ['escape'=>false,'class'=>'btn btn-default']) ?>
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-caret-down"></i></button>
      </div>
    </div>
    <div class='box-body'>
    <?php if (!empty($registerTemplate->register_classes)): ?>
    <div class="">
    <table class="table table-bordered table-hover data-table">
    <thead>
        <tr>
            <th><?= __('Title') ?></th>
            <th><?= __('Short Hand') ?></th>
            <th><?= __('Description') ?></th>
            <th><?= __('Icon') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($registerTemplate->register_classes as $registerClasses): ?>
        <tr class="<?= $registerClasses->active?'': 'danger'?>">
            <td><?= h($registerClasses->title) ?></td>
            <td><?= h($registerClasses->short_hand) ?></td>
            <td><?= h($registerClasses->description) ?></td>
            <td><?= ($registerClasses->icon)? $this->Html->image($registerClasses->icon,['class'=>'inline_icon']) : '&nbsp;' ?></td>
            <td><?= h($registerClasses->created) ?></td>
            <td><?= h($registerClasses->modified) ?></td>
            <td class="actions">
                 
                
                <?php if($registerClasses->active):?>
                    <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') 
                 		. '</span>', ['controller' => 'RegisterClasses', 'action' => 'edit', $registerClasses->id], 
                 		['escape' => false, 'class' => 'btn btn-xs btn-warning', 'title' => __('Edit')]) ?>
                    <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') 
                 		. '</span>', ['controller' => 'RegisterClasses', 'action' => 'delete', $registerClasses->id], 
                 		['confirm' => __('Are you sure you want to delete # {0}?', $registerTemplate->id), 'escape' => false, 
                 				'class' => 'btn btn-xs btn-danger', 'title' => __('Delete')]) ?>
                <?php else:?>

                    <?= $this->Form->postLink('<span class="fa fa-undo"></span><span class="sr-only">' . __('Restore') 
                        . '</span>', ['controller' => 'RegisterClasses', 'action' => 'delete', $registerClasses->id], 
                        ['confirm' => __('Are you sure you want to restore this?'), 'escape' => false, 
                                        'class' => 'btn btn-xs btn-info', 'title' => __('Restore')]) ?>
                
                
                <?php endif;?>
                
                
                 
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <?php endif; ?>
    </div>
</div>

