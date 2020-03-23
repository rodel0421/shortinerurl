<?php //dump($tests);exit;?>
<?= $this->Html->css('questionaire');?>

<style>
input.form-control {
    visibility: collapse;
}
.nav-link.active {
    color: #4c5157 !important;
}
.d-block{
    display: inline-block !important;
}
.checkbox{
    margin-left: 20px;
}
.radio input[type="radio"], .radio-inline input[type="radio"], .checkbox input[type="checkbox"], .checkbox-inline input[type="checkbox"] {
    margin-left: -13px;
}
.question-numbering {
    min-height: 411px;
    max-height: 411px;
}
.col-md-2 {
    width: 13%;
}
.checkbox label, .radio label{
    font-weight: bold !important;
}
h4.question_content {
    margin-left: 10px;
    margin-bottom: 20px;
}
[type="radio"]:checked + label:before, [type="radio"]:not(:checked) + label:before {
    border-radius: 1%;
}
[type="radio"]:checked + label:after, [type="radio"]:not(:checked) + label:after {
    border-radius: 1%;
    background: #605ca8;
}

.squaredTwo {
  width: 28px;
  height: 28px;
  position: relative;
  margin: 20px auto;
  background: #fcfff4;
  background: linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
  box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0,0,0,0.5);
  label {
    width: 20px;
    height: 20px;
    cursor: pointer;
    position: absolute;
    left: 4px;
    top: 4px;
    background: linear-gradient(top, #222 0%, #45484d 100%);
    box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,1);
    &:after {
      content: '';
      width: 9px;
      height: 5px;
      position: absolute;
      top: 4px;
      left: 4px;
      border: 3px solid #fcfff4;
      border-top: none;
      border-right: none;
      background: transparent;
      opacity: 0;
      transform: rotate(-45deg);
    }
    &:hover::after {
      opacity: 0.3;
    }
  }
  /* input[type=checkbox] {
    visibility: hidden;
    &:checked + label:after {
      opacity: 1;
    }    
  } */
}

label.form-check-label.w-100.h-100.d-block {
    margin-left: 34px;
    margin-top: 2px;
    padding-top: 8px;
}

</style>
<!-- <#?php dump($userAnswersSelect); exit; ?> -->
<br>
<?php $this->assign('title', $tests->name);?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">
            <i class="glyphicon glyphicon-check"></i>
            <!-- APPLICANT’S PRACTICAL TEST CHECKLIST -->
            <?= h($tests->name)?>
        </h3>
    </div>
    <div class="box-body">
<section class="mb-3 mt-3">
    <div class="container pb-5">
        <?php if($tests->questions): ?>
            <div class="row">
                <div class="col-12 col-md-2 question-numbering">
                    <ul class="nav nav-tabs d-none d-md-block flex-column" role="tablist">
                        <?php foreach($tests->questions as $index=>$question):?>
                            <li class="nav-item question-list">
                                <?= 
                                    $this->Html->link(
                                        'Task #'.($index+1),
                                        '#question_div-'.$question->id,
                                        [
                                            'class' => [
                                                'nav-link',
                                                'font-weight-bold',
                                                ($index == 0) ? ' active' : '',
                                            ],
                                            'question-id' => $question->id,
                                            'question-number' => $index+1,
                                            'data-toggle' => 'tab',
                                            'role' => 'tab'
                                        ]
                                    );
                                ?>
                            </li>
                        <?php endforeach;?>
                    </ul>
                    <div class="d-xs-block d-md-none mb-4">
                        <!-- <div class="row">
                            <div class="col-6">
                                <small class="card-text">Time Left</small>
                                <h4 class="card-title timer">
                                ---
                                </h4>
                            </div>
                            <div class="col-6">
                                <small class="card-text">Answered</small>
                                <h4 class="card-title pl-2"> 
                            
                                </h4>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="tab-content">
                        <?php foreach($tests->questions as $index=>$question):?>
                            <div class="tab-pane fade in<?= ($index == 0) ? ' active' : ''; ?>" role="tabpanel" id="<?= 'question_div-'.$question->id ?>" question-number="<?= $index+1 ?>">
                                <h3 class="header-title"><?= $question->title; ?></h3>
                                <h4 class="question_content"><?= $question->question; ?></h4>
                                <?php $questionType = $question->course_question_type->value;?>
                                <?php if($questionType == 'Written Answer') : ?>
                                    <p><i class="fa fa-info-circle"></i> <small>Click outside the textbox to save your answer</small></p>
                                <?php endif; ?>
                                <div class="card position-relative" id="<?= 'question-'.$question->id.'_loading' ?>">
                                    <div class="card-body">
                                        <?php if($questionType == 'Multiple Choice') :?>
                                            <ul class="list-group list-group-flush">
                                                <?php if($question->course_question_choices):?>
                                                    <!-- <?php
                                                        $answer_id = null;
                                                        if($userTest->user_answers){
                                                            $key = array_search($question->id, array_column($userTest->user_answers, 'question_id'));
                                                            $user_answer = $userTest->user_answers[$key];
                                                            ($user_answer && $question->id == $user_answer['question_id']) ? $answer_id = $user_answer['answer_id'] : '' ;
                                                        }
                                                    ?> -->
                                                    <?php
                                                        echo $this->Form->create(false, [
                                                            'id'    => 'question-'.$question->id.'_form',
                                                            'url'   => [
                                                                'controller'    => 'userAnswers',
                                                                'action'        => 'answerchecklist'
                                                            ]
                                                        ]);
                                                        $this->Form->setTemplates([
                                                            'radioContainer'    => '<div class="form-check">{{content}}</div>',
                                                            'nestingLabel'      => '{{hidden}}{{input}}<label class="form-check-label w-100 h-100 d-block" {{attrs}}>{{text}}</label><hr>',
                                                            'formGroup'         => '<li class="list-group-item">{{input}}</li>'
                                                        ]);
                                                        echo $this->Form->hidden('user_test_id', ['value' => $userTestsId]);
                                                        echo $this->Form->hidden('user_id', ['value' => $studentId]);
                                                        echo $this->Form->hidden('question_id', ['value' => $question->id]);
                                                        echo $this->Form->text('result', [] );
                                                        
                                                        // echo $this->Form->hidden('question_choice', ['value' => '157']);
                                                        $choices = [];
                                                      
                                                    ?>
                                                     <div class ='form-check'>
                                                        <li class="list-group-item">
                                                        <?php foreach($question->course_question_choices as $index=>$choice): 
                                                            
                                                            ?>
                                                            
                                                            <?php
                                                        
                                                                array_push($choices,[
                                                                    'id'            => 'choice_id-'.$choice->id,
                                                                    'value'         => $choice->id,
                                                                    'text'          => $choice->value,
                                                                    'question_id'   => $question->id,
                                                                    // 'result' => 'true',
                                                                    'class'         => ['form-check-label', 'w-100', 'h-100', 'd-block', 'choice-radio','qInput', 'cBox', 'squaredTwo'],
                                                                ]);
                                                            ?>
                                                       
                                                        <?php
                                                            // dump($tests);
                                                            if($userAnswersSelect[$index]->result == 'correct'){
                                                                echo $this->Form->control($choice->value, [
                                                                    'type' => 'checkbox',
                                                                    'id'            => 'choice_id-'.$choice->id,
                                                                    'value'         => $choice->id,
                                                                    'question_id'   => $question->id,
                                                                    'name' => 'question_choice',
                                                                    // 'result' => 'FALSE',
                                                                    'class' => ['form-check-label', 'w-100', 'h-100', 'd-block', 'choice-radio', 'cBox', 'squaredTwo'],
                                                                    'checked',
                                                                    ]);
                                                                }
                                                            else{
                                                                echo $this->Form->control($choice->value, [
                                                                    'type' => 'checkbox',
                                                                    'id'            => 'choice_id-'.$choice->id,
                                                                    'value'         => $choice->id,
                                                                    'question_id'   => $question->id,
                                                                    'name' => 'question_choice',
                                                                    // 'result' => 'FALSE',
                                                                    'class' => ['form-check-label', 'w-100', 'h-100', 'd-block', 'choice-radio', 'cBox', 'squaredTwo'],
                                                                    
                                                                    ]);
                                                            }
                                                                    
                                                            ?>        
                                                       

                                                        <?php endforeach;?>
                                                            <!-- dz -->
                                                            </div>
                                                            </li>
                                                        <?php               
                                                        // echo $this->Form->control(
                                                        //     'question_choice',
                                                        //         [
                                                        //         'options'   => $choices,
                                                        //         'value'     => $answer_id, 
                                                        //         'type' => 'radio',           
                                                        //         // 'required' => false
                                                        //         ]);

                                                       
                                                        // echo $this->Form->select('question_choice', $choices, [
                                                        //     'name' => 'question_choice',
                                                        //     'multiple' => 'checkbox',
                                                        // ]);
                                                        
                                                       ?>
                                                    <?=
                                                    
                                                        $this->Form->end();
                                                    ?>
                                                <?php else:?>
                                                    <li class="list-group-item">
                                                        <p class="text-danger">There are no choices for this question yet, Please notify your trainer.</p>
                                                    </li>
                                                <?php endif;?>
                                            </ul>
                                        
                                        <?php endif;?>
                                    </div>
                                </div>
                                <div class="container mt-4 text-center text-md-right">
                                    <div class="btn-group mr-2" role="group" aria-label="Second group">
                                        <?= 
                                            $this->Form->button(
                                                '<i class="fa fa-arrow-left"></i> prev',
                                                [
                                                    'class' => [
                                                        'btn',
                                                        'btn-primary',
                                                        'font-weight-bold',
                                                        'prev-btn',
                                                        ($index == 0) ? 'disabled' : '',
                                                    ],
                                                    'escape' => false
                                                ]
                                            );
                                        ?>
                                        <?= 
                                            $this->Form->button(
                                                'next <i class="fa fa-arrow-right"></i>',
                                                [
                                                    'class' => [
                                                        'btn',
                                                        'font-weight-bold',
                                                        'btn-primary',
                                                        'next-btn',
                                                        ((count($tests->questions) - 1) == $index) ? 'disabled': '',
                                                    ],
                                                    'escape' => false
                                                ]
                                            );
                                        ?>
                                    </div>
                                </div>
                            </div>                                
                        <?php endforeach;?>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mt-3 mt-md-none float-right float-md-none">
                        <div class="d-none d-md-block">
                            <!-- <small class="card-text">Lorem Ipsum</small> -->
                            <h4 class="card-title timer">
                            Tasks:
                            <span class="total_questions"> 
                                     <?= (isset($tests->questions)) ? count($tests->questions) : '0' ; ?>
                                </span>
                            </h4>
                            <small class="card-text"></small>
                            <h4 class="card-title pl-2"> 
                                <span class="total_answered">
                                <!-- <?php #dump($userTestSelect); ?> -->
                                    <!-- <?= ($tests->answers) ? count($userTestSelect->user_answers) : '0' ; ?>
                                </span> /  -->
                                <!-- <span class="total_questions"> 
                                     <?= (isset($tests->questions)) ? count($tests->questions) : '0' ; ?>
                                </span> -->
                            </h4>
                        </div>
                        <?= 
                            $this->Form->create(false, [
                                'id'    => 'submit_form',
                                'url'   => [
                                    'controller'    => 'userTests',
                                    'action'        => 'submitPracticalTest'
                                ]
                            ]); 
                        ?>

                        <?= $this->Form->hidden('id', ['value' => $tests->id ]) ?>
                        <?= $this->Form->hidden('user_tests_id', ['value' => $userTestsId ]) ?>
                        <?= $this->Form->hidden('user_id', ['value' => $studentId]); ?>
                        <?= $this->Form->hidden('status', ['value' => 'submitted' ]) ?>
                        <?= $this->Form->button(
                            'Submit', 
                            [
                                'type' => 'button',
                                'class' => [
                                    'btn', 
                                    'btn-primary', 
                                    'btn-main'
                                ],
                                'id' => 'practicalTestSubmit'
                        ]) ?>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        <?php else:?>
            <h3 class="text-danger">No Question on this exam yet, please contact your trainer</h3>
        <?php endif;?>
    </div>
</section>
</div>
</div>


<?= $this->Html->script('waitMe.min'); ?>

<script>
$( document ).ready(function() {
    // $choice = rawr
    // $('input[name=""]')
    const submitAnswer = (e) => {
                    let el = $(e.target);
                    let data = $(el.closest('form')[0]).serializeArray();
                    let url = $(el.closest('form')[0]).attr('action');
                    let question_id = el.attr('question_id');
                    $.ajax({
                        type : "POST",
                        data:  data,
                        url: url,
                        beforeSend: () => {
                            $('#question-'+question_id+'_loading').waitMe({
                                effect : 'rotateplane',
                                text : 'Saving Answer',
                                bg : 'rgba(0,0,0,0.5)',
                                color : '#FFC107'
                            });
                        },
                        success: (result, _textStatus) => {
                            (result.method == 'add' ? incrementAnsweredCounter(): '');
                            el.attr('checked', 'checked');
                            $('a[question-id="'+question_id+'"]').removeClass(['wrong','unanswered']);
                            $('#question-'+question_id+'_loading').removeClass(['wrong','unanswered']);
                        },
                        complete: () => {
                            $('#question-'+question_id+'_loading').waitMe('hide');
                        }
                    });
                }

    // $('.cBox').each(function(){
    //     let value = $(this).val()
    //     $(this).parents('.checkbox').find(":first-child").val(value)
    // })
    let value
    
    $('input[type="checkbox"]').click(function(e){
  
            if($(this).is(":checked")){
      
                value = $(this).val()
                $('.checkbox').find('.form-control').val(value)
                $('input[name=result]').val("correct");
                
          

                $('.written-answer').blur((e) => {
                    let val = $(e.target).val().trim();
                    if(val){
                        submitAnswer(e);
                    }
                });
                //set input result value
                $('.result input').val("correct");
            }
            else if($(this).is(":not(:checked)")){
                $('input[name=result]').val("wrong");
                // alert('false');
                }
     
        });
        $('.choice-radio').click(submitAnswer);
              
});
</script>
<?= $this->Html->script('questionaire'); ?>
