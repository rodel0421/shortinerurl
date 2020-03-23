let answeredCounter;

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

$('.choice-radio').click(submitAnswer);

$('.written-answer').blur((e) => {
    let val = $(e.target).val().trim();
    if(val){
        submitAnswer(e);
    }
});


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

const incrementAnsweredCounter = () => {
    answeredCounter = parseInt($('.total_answered').first().text());
    answeredCounter++;
    console.log(answeredCounter);
    $('.total_answered').text(answeredCounter);
}

$('#testSubmit').click((e) => {
    let el = $(e.target);
    let data = $(el.closest('form')[0]).serializeArray();
    $.ajax({
        type : "POST",
        data:  data,
        url: '/user-tests/submit-user-test',
        beforeSend: () => {
        },
        success: (result, _textStatus) => {
            let data = result.data;

            if(result.status == "invalid"){
                alert(result.message);
                let invalid = [];
                data['questions'].forEach(question => {
                    if(question['status'] == 'wrong' || question['status'] == 'unanswered'){
                        invalid.push({
                            'id' : question['id'],
                            'status' : question['status']
                        })
                    }
                });
                invalid.forEach(question => {
                    $('.nav-link[question-id="'+question['id']+'"]').addClass(question['status']);
                    $('#question-'+question['id']+'_loading').addClass(question['status']);
                });
                $('.nav-link[question-id="'+invalid[0]['id']+'"]').tab('show');
                return;
            }else if(result.status == "submitted"){
                alert(result.message); 
                window.location.replace("/tests/logout");
            }

        },
        complete: () => {
        }
    });
});

$('#practicalTestSubmit').click((e) => {
    let el = $(e.target);
    let data = $(el.closest('form')[0]).serializeArray();
    $.ajax({
        type : "POST",
        data:  data,
        url: '/user-tests/submit-practical-test',
        beforeSend: () => {
        },
        success: (result, _textStatus) => {
            let data = result.data;
            alert(result.message);
            window.location.replace("/tests/");
            // if(result.status == "invalid"){
            //     alert(result.message);
            //     let invalid = [];
            //     data['questions'].forEach(question => {
            //         if(question['status'] == 'wrong' || question['status'] == 'unanswered'){
            //             invalid.push({
            //                 'id' : question['id'],
            //                 'status' : question['status']
            //             })
            //         }
            //     });
            //     invalid.forEach(question => {
            //         $('.nav-link[question-id="'+question['id']+'"]').addClass(question['status']);
            //         $('#question-'+question['id']+'_loading').addClass(question['status']);
            //     });
            //     $('.nav-link[question-id="'+invalid[0]['id']+'"]').tab('show');
            //     return;
            // }else if(result.status == "submitted" || result.status == "passed" || result.status == "failed"){
            //     alert(result.message); 
            //    
            // }

        },
        complete: () => {
        }
    });
});