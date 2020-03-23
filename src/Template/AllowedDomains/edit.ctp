<?php
/**
  * @var \App\View\AppView $this
  */
?>

<div class="allowed-domains view large-9 medium-8 columns content">
<div class='box box-primary'>
    <div class='box-header'>
    	<div class="box-tools pull-right">    	
            <?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                            . '</span>', ['action' => 'index'], 
                            ['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
            <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') 
                            . '</span>', ['action' => 'delete', $allowedDomain->id], 
                            ['confirm' => __('Are you sure you want to delete # {0}?', $allowedDomain->id), 'escape' => false, 
                                    'class' => 'btn btn-danger', 'title' => __('Delete')]) ?>
            <?= $this->element('guide', array("section" => 'formTemplates')) ?>
      </div>
    </div>
    <div class='box-body'>
        <?= $this->Form->create($allowedDomain) ?>
            <fieldset>
                <legend><?= __('Edit Allowed Domain') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('domain');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
        
    </div>
</div>
