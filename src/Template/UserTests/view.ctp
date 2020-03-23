<?php $this->assign('title', $userTest->course_test->name);?>
<?= $this->Html->css('questionaire');?>

<section class="banner">	
</section>
<section class="mb-3">
    <div class="container">
        <h3 class="header-title">
            <?= ($userTest->status == 'submitted') ? 'View User Test' : 'Exam Results'?>
        </h3>
        <div class="d-block d-md-none text-left">
            <small class="card-text">Test</small>
            <h5 class="card-title pl-2 text-capitalize"> 
                <?= $userTest->course_test->name; ?>
            </h5>
            <small class="card-text">Student</small>
            <h5 class="card-title pl-2 text-capitalize"> 
                <?= $userTest->user->name; ?>
            </h5>
        </div>
        <br>
        <div class="row">
            <div class="col-md-2 question-numbering">
                <ul class="nav nav-tabs d-none d-md-block flex-column" role="tablist">
                    <?php foreach($questions as $index=>$question):?>
                        <li class="nav-item question-list <?= ($index == 0) ? ' active' : '' ?> <?= ($question->user_answers) ? $question->user_answers[0]->result : '' ?>">
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
            </div>
            <div class="col-md-8">
                <div class="tab-content">
                    <?php foreach($questions as $index=>$question): ?>
                        <div class="tab-pane fade show <?= ($index == 0) ? ' active' : ''; ?>" id="<?= 'question_div-'.$question->id ?>" role="tabpanel" question-number="<?= $index+1 ?>">
                            <h3 class="header-title"><?= $question->title; ?></h3>
                            <p class="question_content"><?= $question->question; ?></p>
                            <div class="container">
                                <?php foreach( $question->course_question_choices as $choice ):?>
                                    <div class="choices-container <?= ($userTest->status == 'submitted') ? 'unchecked' : '' ?> <?= (isset($question->user_answers[0]) && $question->user_answers[0]->answer_id == $choice->id) ? 'user-answer' : '' ?> <?= (isset($question->user_answers[0]) && $question->answers[0]->id == $choice->id) ? 'correct-answer' : '' ?>">
                                        <p><?= h($choice->value); $userTest->status ?></p>
                                    </div>
                                <?php endforeach;?>
                                <?php if($question->user_answers[0]['answer_content'] != null): ?>
                                    <h5>Answer: </h5>
                                    <p class="px-4"><?= $question->user_answers[0]['answer_content'] ?></p>
                                <?php endif; ?> 
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
                                                    ((count($questions) - 1) == $index) ? 'disabled': '',
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
            <div class="d-none d-md-block col-md-2">
                <div class="text-left">
                    <small class="card-text">Name</small>
                    <h5 class="card-title pl-2 text-capitalize"> 
                        <?= $userTest->user->name; ?>
                    </h5>
                    <small class="card-text">Test</small>
                    <h5 class="card-title pl-2 text-capitalize"> 
                        <?= $userTest->course_test->name; ?>
                    </h5>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
$('.prev-btn').click((e) => {
    let el = $(e.target);
    let tab = $(el.closest('div.tab-pane')[0]);
    let questionNumber = tab.attr('question-number');
    if(questionNumber == 1){
        return;
    }
    let newQuestionNumber = questionNumber - 1;
    $('li a[question-number="'+newQuestionNumber+'"]').tab('show');
});

$('.next-btn').click((e) => {
    let el = $(e.target);
    let tab = $(el.closest('div.tab-pane')[0]);
    let questionNumber = tab.attr('question-number');
    if($('.next-btn').length == questionNumber){
        return;
    }
    let newQuestionNumber = parseInt(questionNumber) + 1;
    $('li a[question-number="'+newQuestionNumber+'"]').tab('show');
});
</script>