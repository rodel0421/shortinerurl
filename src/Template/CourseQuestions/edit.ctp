<style>
 select#question_type_select {
     background: #f1e2ab;
     pointer-events: none;
     box-shadow: inset
     -22px 0px 0px 0px #f1e2ab;
 }
 
 label.red-alert {
     color: #a94442;
     font-weight: 400;
 }
 </style>


<?php
/**
  * @var \App\View\AppView $this
  */
  $answer_array = [];
  foreach($courseQuestion->answers as $answer)
  {
      array_push($answer_array, $answer->id);
  }
  ?>
<div class="courseQuestions form large-9 medium-8 columns content card">
<div class='box-header'><h3 class='box-title'><?= __('Edit Module') ?></h3>
    	<div class="box-tools pull-right">
    	
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['action' => 'index'], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
                 		
        <?= $this->Form->postLink(
        		'<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete'),
                ['action' => 'delete', $courseQuestion->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', 
                $courseQuestion->id), 'escape' => false, 
                 	'class' => 'btn btn-danger', 'title' => __('Delete')]
            )
        ?>
		
      </div>
    </div>
    <?= $this->Form->create($courseQuestion) ?>
    <fieldset>
        <?php
            if($courseQuestion->course_test->course_test_type_id == '2'){
                echo $this->Form->control('course_test_id', ['options' => $courseTests,  'value' => $courseQuestion->course_test_id, ($courseQuestion->course_test_id) ? 'disabled' : '']);
            }else{
                echo $this->Form->control('course_test_id', ['options' => $courseTests]);
            }
                echo $this->Form->control('title');
                echo $this->Form->control('question');
            if($courseQuestion->course_test->course_test_type_id == '2'){
                echo $this->Form->hidden('course_question_type_id', ['value' => '2']);
            }else{
                echo $this->Form->control('course_question_type_id', ['options' => $courseQuestionTypes, 'id' => 'question_type_select']);
                echo $this->Form->label('answers'); echo '<label class="red-alert">: This is a required field !</label>'; 
                echo $this->Form->select('answers', $Choices, ['multiple' => true, 'class' => ['chosen-select', 'w-100'], 'value' => $answer_array]);
            }
                echo $this->Form->control('active');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
