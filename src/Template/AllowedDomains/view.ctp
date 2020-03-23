<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\AllowedDomain $allowedDomain
  */
?>
<div class="allowed-domains view large-9 medium-8 columns content">
<div class='box box-primary'>
    <div class='box-header'>
        <h3><?= h($allowedDomain->name) ?></h3>
    	<div class="box-tools pull-right">    	
            <?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                            . '</span>', ['action' => 'index'], 
                            ['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
                            
            <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') 
                            . '</span>', ['action' => 'edit', $allowedDomain->id], 
                            ['escape' => false, 'class' => 'btn btn-warning', 'title' => __('Edit')]) ?>
            <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') 
                            . '</span>', ['action' => 'delete', $allowedDomain->id], 
                            ['confirm' => __('Are you sure you want to delete # {0}?', $allowedDomain->id), 'escape' => false, 
                                    'class' => 'btn btn-danger', 'title' => __('Delete')]) ?>
            <?= $this->element('guide', array("section" => 'formTemplates')) ?>
      </div>
    </div>
    <div class='box-body'>
        <table class="table table-striped">
            <thead>
                <tr class="bg-primary text-white">
                    <th class="text-center" colspan="2"><h3><?= 'Details' ?></h3></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td width="50%" class="bg-gray">Name</td>
                    <td width="50%"><?= h($allowedDomain->name) ?></td>
                </tr>
                <tr>
                    <td width="50%" class="bg-gray">Domain</td>
                    <td width="50%"><?= $allowedDomain->domain ?></td>
                </tr>
            </tbody>
        </table>
        
    </div>
</div>
