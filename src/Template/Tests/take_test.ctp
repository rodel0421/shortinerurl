<?php //dump($userTest);exit;?>
<?= $this->Html->css('questionaire');?>
<section class="banner">	
</section>
<?php $this->assign('title', $userTest->course_test->name);?>
<section class="mb-3">
    <div class="container pb-5">
        <?php if($userTest->course_test->questions): ?>
            <div class="row">
                <div class="col-12 col-md-2 question-numbering">
                    <ul class="nav nav-tabs d-none d-md-block flex-column" role="tablist">
                        <?php foreach($userTest->course_test->questions as $index=>$question):?>
                            <li class="nav-item question-list">
                                <?= 
                                    $this->Html->link(
                                        'Question #'.($index+1),
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
                        <div class="row">
                            <div class="col-6">
                                <small class="card-text">Time Left</small>
                                <h4 class="card-title timer">
                                ---
                                </h4>
                            </div>
                            <div class="col-6">
                                <small class="card-text">Answered</small>
                                <h4 class="card-title pl-2"> 
                                    <span class="total_answered">
                                        <?= ($userTest->user_answers) ? count($userTest->user_answers) : '0' ; ?>
                                    </span> / 
                                    <span class="total_questions"> 
                                        <?= (isset($userTest->course_test->questions)) ? count($userTest->course_test->questions) : '0' ; ?>
                                    </span>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="tab-content">
                        <?php foreach($userTest->course_test->questions as $index=>$question):?>
                            <div class="tab-pane fade show<?= ($index == 0) ? ' active' : ''; ?>" role="tabpanel" id="<?= 'question_div-'.$question->id ?>" question-number="<?= $index+1 ?>">
                                <h3 class="header-title"><?= $question->title; ?></h3>
                                <p class="question_content"><?= $question->question; ?></p>
                                <?php $questionType = $question->course_question_type->value;?>
                                <?php if($questionType == 'Written Answer') : ?>
                                    <p><i class="fa fa-info-circle"></i> <small>Click outside the textbox to save your answer</small></p>
                                <?php endif; ?>
                                <div class="card position-relative" id="<?= 'question-'.$question->id.'_loading' ?>">
                                    <div class="card-body">
                                        <?php if($questionType == 'Multiple Choice') :?>
                                            <ul class="list-group list-group-flush">
                                                <?php if($question->course_question_choices):?>
                                                    <?php
                                                        $answer_id = null;
                                                        if($userTest->user_answers){
                                                            $key = array_search($question->id, array_column($userTest->user_answers, 'question_id'));
                                                            $user_answer = $userTest->user_answers[$key];
                                                            ($user_answer && $question->id == $user_answer['question_id']) ? $answer_id = $user_answer['answer_id'] : '' ;
                                                        }
                                                    ?>
                                                    <?php
                                                        echo $this->Form->create(false, [
                                                            'id'    => 'question-'.$question->id.'_form',
                                                            'url'   => [
                                                                'controller'    => 'userAnswers',
                                                                'action'        => 'answer'
                                                            ]
                                                        ]);
                                                        $this->Form->setTemplates([
                                                            'radioContainer'    => '<div class="form-check">{{content}}</div>',
                                                            'nestingLabel'      => '{{hidden}}{{input}}<label class="form-check-label w-100 h-100 d-block" {{attrs}}>{{text}}</label><hr>',
                                                            'formGroup'         => '<li class="list-group-item">{{input}}</li>'
                                                        ]);
                                                        echo $this->Form->hidden('user_test_id', ['value' => $userTest->id]);
                                                        echo $this->Form->hidden('user_id', ['value' => $userTest->user_id]);
                                                        echo $this->Form->hidden('question_id', ['value' => $question->id]);
                                                        echo $this->Form->hidden('result', ['value' => 'unchecked']);
                                                        $choices = [];
                                                    ?>
                                                        <?php foreach($question->course_question_choices as $choice): ?>
                                                            <?php
                                                                array_push($choices,[
                                                                    'id'            => 'choice_id-'.$choice->id,
                                                                    'value'         => $choice->id,
                                                                    'text'          => $choice->value,
                                                                    'question_id'   => $question->id,
                                                                    'class'         => ['form-check-label', 'w-100', 'h-100', 'd-block', 'choice-radio'],
                                                                ]);
                                                            ?>
                                                        <?php endforeach;?>
                                                        <?= 
                                                            $this->Form->control(
                                                                'question-'.$choice->course_question_id.'_choice',
                                                                [
                                                                    'options'   => $choices,
                                                                    'value'     => $answer_id, 
                                                                    'type'      => 'radio'
                                                                ]
                                                            );
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
                                        <?php elseif($questionType == 'Written Answer') : ?>
                                            <?php
                                                $answer_content = null;
                                                if($userTest->user_answers){
                                                    $key = array_search($question->id, array_column($userTest->user_answers, 'question_id'));
                                                    $user_answer = $userTest->user_answers[$key];
                                                    ($user_answer && $question->id == $user_answer['question_id']) ? $answer_content = $user_answer['answer_content'] : '' ;
                                                }
                                            ?>
                                            <?= $this->Form->create(false, [
                                                'id'    => 'question-'.$question->id.'_form',
                                                'url'   => [
                                                    'controller'    => 'userAnswers',
                                                    'action'        => 'answer'
                                                ]
                                            ]) ?>
                                            <?= $this->Form->label('answer')?>
                                            <?= 
                                                $this->Form->textarea('answer_content', ['class' => ['written-answer'], 'id' => 'question-'.$question->id.'-answer', 'question_id' => $question->id, 'value' => $answer_content]);
                                            ?>
                                            <?php
                                                echo $this->Form->hidden('user_test_id', ['value' => $userTest->id]);
                                                echo $this->Form->hidden('user_id', ['value' => $userTest->user_id]);
                                                echo $this->Form->hidden('question_id', ['value' => $question->id]);
                                                echo $this->Form->hidden('result', ['value' => 'unchecked']);
                                            ?>
                                            <?=
                                                $this->Form->end();
                                            ?>
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
                                                        'btn-warning',
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
                                                        'btn-warning',
                                                        'next-btn',
                                                        ((count($userTest->course_test->questions) - 1) == $index) ? 'disabled': '',
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
                            <small class="card-text">Time Left</small>
                            <h4 class="card-title timer">
                            ---
                            </h4>
                            <small class="card-text">Answered</small>
                            <h4 class="card-title pl-2"> 
                                <span class="total_answered">
                                    <?= ($userTest->user_answers) ? count($userTest->user_answers) : '0' ; ?>
                                </span> / 
                                <span class="total_questions"> 
                                    <?= (isset($userTest->course_test->questions)) ? count($userTest->course_test->questions) : '0' ; ?>
                                </span>
                            </h4>
                        </div>
                        <?= 
                            $this->Form->create(false, [
                                'id'    => 'submit_form',
                                'url'   => [
                                    'controller'    => 'userTests',
                                    'action'        => 'submitUserTest'
                                ]
                            ]); 
                        ?>
                        <?= $this->Form->hidden('id', ['value' => $userTest->id ]) ?>
                        <?= $this->Form->hidden('user_id', ['value' => $userTest->user_id]); ?>
                        <?= $this->Form->hidden('status', ['value' => 'submitted' ]) ?>
                        <?= $this->Form->button(
                            'Submit', 
                            [
                                'type' => 'button',
                                'class' => [
                                    'btn', 
                                    'btn-warning', 
                                    'btn-main'
                                ],
                                'id' => 'testSubmit'
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
<script type="text/javascript">
    const initTimer = () => {
        
        var dateString = "<?= $open_until ?>";
        let end_time = new Date(dateString.replace(' ', 'T'));
        let now = new Date().toLocaleString("en-US", {timeZone: "<?= $timezone ?>"})

        end_time = (Date.parse(end_time) / 1000);
        now = (Date.parse(now) / 1000);
        
        let time_left = end_time - now;
        let hours_left = Math.floor((time_left / 60)/ 60);
        let minutes_left = Math.floor((time_left - (hours_left * 3600))/60);
        let seconds_left = Math.floor(time_left - (hours_left * 3600) - (minutes_left * 60));
        let timer = ("0" + hours_left).slice(-2) + ':' + ("0" + minutes_left).slice(-2) +':' + ("0" + seconds_left).slice(-2);
        if(!hours_left && !minutes_left && !seconds_left){
            clearInterval(timer_interval);
            alert('Times Up ');
            window.location.replace('/tests/logout/' + true);
        }
        $('.timer').text(timer);
    }
    let timer_interval = setInterval( () => { initTimer() },1000);
</script>
<?= $this->Html->script('waitMe.min'); ?>
<?= $this->Html->script('questionaire'); ?>