<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="btn-group" role="group" aria-label="...">
    <?= $this->Html->link('<i class="fa fa fa-list" aria-hidden="true"></i> List Tests', ['controller' => 'Tests', 'action' => 'index'],['escape' => false, 'class'=>'btn btn-default' , 'title' => 'List Tests']) ?>
    <?= $this->Html->link('<i class="fa fa fa-list" aria-hidden="true"></i> List Modules', ['controller' => 'Modules', 'action' => 'index'],['escape' => false, 'class'=>'btn btn-default' , 'title' => 'List Modules']) ?>
    <?= $this->Html->link('<i class="fa fa fa-plus" aria-hidden="true"></i> Add Module', ['controller' => 'Modules', 'action' => 'add'] , ['escape' => false, 'class'=>'btn btn-default','title' => 'Add Module']) ?>
    <?= $this->Html->link('<i class="fa fa fa-list" aria-hidden="true"></i> List Questions', ['controller' => 'CourseQuestions', 'action' => 'index'],['escape' => false, 'class'=>'btn btn-default' , 'title' => 'List Questions']) ?>
    <?= $this->Html->link('<i class="fa fa fa-plus" aria-hidden="true"></i> Add Question', ['controller' => 'CourseQuestions', 'action' => 'add'] , ['escape' => false, 'class'=>'btn btn-default','title' => 'Add Question']) ?>
</div>
<div class="tests form large-9 medium-8 columns content">
    <?= $this->Form->create($test) ?>
    <fieldset>
        <legend><?= __('Add Test') ?></legend>
        <?php
            echo $this->Form->control('course_module_id',['options'=>$modules, 'value' => $moduleID, ($moduleID) ? 'disabled' : '']);
            echo ($moduleID) ? $this->Form->hidden('course_module_id', ['value' => $moduleID]) : '';
            echo $this->Form->control('name');
            echo $this->Form->control('course_test_type_id', ['options' => $types, 'value' => $test->course_test_type_id]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
