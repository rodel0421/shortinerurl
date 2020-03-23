
<style>
.box{
    padding-bottom: 60px;
}
</style>
<?= $this->Html->css('test-check') ?>
<div class="view large-9 medium-8 columns content">
    <h4>
        <small>
            Name: 
        </small>
        <?= $this->Html->link($userTest->user->name, ['controller' => 'Users', 'action' => 'View', $userTest->user->id])?>
    </h4>
    <div class="box box-primary">
        <div class="box-header">
            <h4><?= $userTest->course_test->name ?></h4>
            <div class="box-tools pull-right">
                <div class="btn-group d-none d-md-block">
                    <button class="prev-btn btn btn-default">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        prev
                    </button>
                    <button class="next-btn btn btn-default">
                        next
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </button>
                </div>
                <?php if($userTest->status == 'submitted'): ?>
                    <div class="text-right d-block d-md-none">
                        <?= $this->Form->button('Submit',[
                            'type' => 'button',
                            'class' => [
                                'btn',
                                'btn-default',
                                'pull-right',
                                'submit_button'
                            ]
                        ]) ?>
                    </div>
                <?php endif;?>
            </div>
        </div>
        <div class="box-body">
            <div class="d-block d-md-none col-md-3">
                <p class="font-weight-bold"><small>Passing: </small>75%</p>
                <p class="font-weight-bold"><small>Score: </small><span class="score"><?= $initial_result['correct'] ?></span> / <span class="total_items"><?= count($initial_result['questions']) ?></span></p>
                <p class="font-weight-bold"><small>Remarks: </small><span class="remarks <?= $initial_result['remarks'] ?>"><?= $initial_result['remarks'] ?></span></p>
            </div> 
            <div class="row">
                <div class="d-none d-md-block col-md-2 question-numbering">
                    <ul class="nav nav-tabs nav-stacked">
                        <?php foreach($initial_result['questions'] as $index=>$question):?>
                                
                            <?php 
                                foreach ($question->user_answers as $key => $value) {
                                    $value->result;
                                }
                                
                                 ?>

                            <li class=" nav-li<?= ($index == 0) ? ' active '  : 'wrong' ?> <?= $value->result; ?>" question_id="<?= $question->id?>">
                                 <?= 
                                    $this->Html->link(
                                        'Tast #'.($index+1),
                                        '#question_div-'.$question->id,
                                        [
                                            'class' => [
                                                'nav-link',
                                                'font-weight-bold',
                                            ],
                                            'question-id' => $question->id,
                                            'question   -number' => $index+1,
                                            'data-toggle' => 'tab',
                                            'role' => 'tab',
                                        ]
                                    );
                                ?>
                            </li>
                        <?php endforeach;?>
                    </ul>
                </div>
                <div class="col-12 col-md-7">
                    <?= $this->Form->create(false, [
                        'id' => 'test_form',
                        'url'   => [
                            'controller'    => 'userTests',
                            'action'        => 'test'
                        ]
                    ]); ?>
                    <?= $this->Form->hidden(
                        'id',
                        ['value' => $userTest->id]
                    );?>
                    <?= $this->Form->unlockField('status'); ?>
                    <?= $this->Form->hidden(
                        'status',
                        [
                            'value' => $initial_result['remarks'],
                            'id' => 'status_field'
                        ]
                    );?>
                    <div class="tab-content">
                        <?php foreach($initial_result['questions'] as $index=>$question):?>
                            
                            <div class="tab-pane<?= ($index == 0) ? ' active' : ''; ?>" id="<?= 'question_div-'.$question->id ?>" question-number="<?= $index+1 ?>">
                                <h3><?= $question->title ?></h3>
                                <p><?= h($question->question); ?></p>

                                <!-- 
                                question types
                                1 = multiple choice
                                2 = written answer
                                3 = drag and drop   
                                        
                                4 = draw over images
                                 -->
                                <?php if($question->course_question_type_id == 1) :?>

                                    <?php 
                                        foreach( $question->course_question_choices as $index => $choice ){
                                            foreach( $question->user_answers as $key => $val ){
                                                    if($choice->id == $val->answer_id){
                                                        $question->course_question_choices[$index]->result = $val->result;
                                                    }
                                            }
                                        }
                                    ?>
                                  
                              

                                       <?php foreach( $question->course_question_choices as $index => $choice ):?>

                                        <!-- <#?php if($choice->result == ): ?> -->
                                                    <!-- <#?php dump($question->user_answers[$index]->answer_id);?>
                                                    <#?php dump($question->user_answers);?>                                        -->
                                        <div class="choices-container <?= ($choice->result == "correct") ? 'correct-answer' : 'user-answer' ?>">
                                            <p><?= h($choice->value); ?></p>
                                        </div>
                                       
                                        <?php endforeach;?>
                                   

                                <?php elseif($question->course_question_type_id == 2): ?>
                                    <?php if($question->user_answers): ?>
                                        <div class="answer_info" user_answer_id="<?= $question->user_answers[0]->id ?>">
                                            <h5>Answer: </h5>
                                            <p class="px-4"><?= $question->user_answers[0]->answer_content ?></p>
                                            <?php if($userTest->status == 'submitted'): ?>
                                                <div class="btn-group pull-right">
                                                    <button type="button" mark="wrong" class="mark-answer btn btn-default">
                                                        <i mark="wrong"  class="fa fa-times" aria-hidden="true"></i>
                                                        wrong
                                                    </button>
                                                    <button type="button" mark="correct" class="mark-answer btn btn-default">
                                                        <i mark="correct" class="fa fa-check" aria-hidden="true"></i>
                                                        correct
                                                    </button>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?> 
                            </div>
                                         
                        <?php endforeach;?>
                    </div>
                    <?= $this->Form->end(); ?>
                </div>
                <div class="d-none d-md-block col-md-3">
                    <p class="font-weight-bold"><small>Passing: </small>75%</p>
                    <p class="font-weight-bold"><small>Score: </small><span class="score"><?= $initial_result['correct'] ?></span> / <span class="total_items"><?= count($initial_result['questions']) ?></span></p>
                    <p class="font-weight-bold"><small>Remarks: </small><span class="remarks <?= $initial_result['remarks'] ?>"><?= $initial_result['remarks'] ?></span></p>
                    <?php if($userTest->status == 'submitted'): ?>
                        <div class="text-right">
                            <?= $this->Form->button('Submit',[
                                'type' => 'button',
                                'class' => [
                                    'btn',
                                    'btn-default',
                                    'submit_button'
                                ]
                            ]) ?>
                        </div>
                    <?php endif;?>
                </div>
                <div class="col-12 d-block col-md-none">
                    <div class="container">
                        <div class="pull-right btn-group d-block d-md-none">
                            <button class="prev-btn btn btn-default">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                prev
                            </button>
                            <button class="next-btn btn btn-default">
                                next
                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript"> 
    $('button.mark-answer').click((e) => {
        let el = $(e.target);
        let user_answer_id = el.closest('.answer_info').attr('user_answer_id');
        let mark = el.attr('mark');
        let url = "<?= $this->Url->build(['controller' => 'UserAnswers','action' => 'markAnswer']) ?>/" + user_answer_id + '?mark=' + mark;
        let classes = ['correct', 'unchecked', 'wrong'];
        $.ajax({
            type : "GET",
            url: url,
            async: false,
            beforeSend: () => {
            },
            success: (result, _textStatus) => {
                if(result.success){
                    $('#status_field').val(result.remarks);
                    let question_nav = $('.nav-li[question_id="'+result.user_answer.question_id+'"]');
                    $('#question-'+result.user_answer.question_id+'-result').val(result.user_answer.result);
                    $.each(['wrong', 'unchecked', 'correct'], function(i, v){
                        question_nav.removeClass(v);
                    });
                    question_nav.addClass(result.user_answer.result);
                    $('span.score').text(result.correct);
                    let span = $('span.remarks');
                    $.each(['failed', 'passed'], function(i, v){
                        span.removeClass(v);
                    });
                    span.addClass(result.remarks);
                    span.text(result.remarks);
                }
            },
            complete: () => {
            }
        });
    });
</script>
<?= $this->Html->script('checker') ?>