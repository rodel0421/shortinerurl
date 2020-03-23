<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\CourseQuestion $courseQuestion
  */
?>


<style>
.inner-header h3{
    margin-top: 5px;
    margin-bottom: 5px;
    margin-left: 5px;
    /* text-align: left; */
    display: inline-block;

}

.inner-header thead th a {
    margin-top: 3px;
}

th.text-center {
    text-align: left !important;
}
th.text-center{
background: #4f6d7a;

}


</style>


<!-- <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Course Question'), ['action' => 'edit', $courseQuestion->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Course Question'), ['action' => 'delete', $courseQuestion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $courseQuestion->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Course Questions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Course Question'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Course Tests'), ['controller' => 'Tests', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Course Test'), ['controller' => 'Tests', 'action' => 'add']) ?> </li>
    </ul>
</nav> -->

<div class="tests view large-9 medium-8 columns content">
    <div class='box box-primary'>
        <div class='box-header'>
        <h3><?= h($courseQuestion->title) ?></h3>
            <div class="box-tools pull-right">    	
            <?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                            . '</span>', ['action' => 'index'], 
                            ['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
                            
            <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') 
                            . '</span>', ['action' => 'edit', $courseQuestion->id], 
                            ['escape' => false, 'class' => 'btn btn-warning', 'title' => __('Edit')]) ?>
            <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') 
                            . '</span>', ['action' => 'delete', $courseQuestion->id], 
                            ['confirm' => __('Are you sure you want to delete # {0}?', $courseQuestion->id), 'escape' => false, 
                                    'class' => 'btn btn-danger', 'title' => __('Delete')]) ?>
            <?= $this->element('guide', array("section" => 'formTemplates')) ?>
            
        </div>
        </div>
        <div class='box-body'>
        <table class="table table-striped inner-header">
            <thead>
                <tr class="bg-primary text-white">
                    <th class="text-center" colspan="2"><h3><?= 'Details' ?></h3></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td width="50%" class="bg-gray">Test</td>
                    <td width="50%"><?= $courseQuestion->has('course_test') ? $this->Html->link($courseQuestion->course_test->id, ['controller' => 'CourseTests', 'action' => 'view', $courseQuestion->course_test->id]) : '' ?></td>
                </tr>
                <tr>
                    <td width="50%" class="bg-gray">Type</td>
                    <td width="50%">
                    <?php if($courseQuestion->course_question_type_id == null || $courseQuestion->course_test->course_test_type_id == '2'): ?>
                   
                    <?php else: ?>
                        <?= $courseQuestion->course_question_type->value ?>
                    <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td width="50%" class="bg-gray">Question</td>
                    <td width="50%"><?= $courseQuestion->question ?></td>
                </tr>
                <tr>
                    <td width="50%" class="bg-gray">Choices</td>
                    <td width="50%">
                    <?php if($courseQuestion->course_question_type_id == null || $courseQuestion->course_test->course_test_type_id == '2'): ?>
                        <?php
                        $output = "";
                        foreach($courseQuestion->course_question_choices as $index => $choice)
                        {
                            $output .= $choice->value;
                            if($index < (count($courseQuestion->course_question_choices) - 1)){
                                $output .= ',<br> ';
                            }
                        }
                        echo $output;
                    ?>
                   <?php else: ?>
                       <?= $courseQuestion->course_question_type->value ?>
                   <?php endif; ?>
                    
                    </td>
                </tr>
                <tr>
                    <td width="50%" class="bg-gray">Answer</td>
                    <td width="50%">
                    <?php if($courseQuestion->course_question_type_id == null || $courseQuestion->course_test->course_test_type_id == '2'): ?>
                   
                   <?php else: ?>
                    <?php
                        $output = "";
                        foreach($courseQuestion->answers as $index => $answer)
                        {
                            $output .= $answer->value;
                            if($index < (count($courseQuestion->answers) - 1)){
                                $output .= ',<br> ';
                            }
                        }
                        echo $output;
                    ?>
                   <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td width="50%" class="bg-gray">Position</td>
                    <td width="50%"><?= $courseQuestion->position ?></td>
                </tr>
            </tbody>
        </table>
        
    </div>
</div>

