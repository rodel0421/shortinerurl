
//submit function
$('.submit_button').click(() => {
    let data = $('#test_form').serializeArray();
    console.log(data);
    $.ajax({
        type : "POST",
        data:  data,
        url: '/user-tests/test',
        beforeSend: () => {
        },
        success: (result, _textStatus) => {
            alert(result.message);
            window.location.replace("/tests/index");
        },
        complete: () => {
        }
    });
});

$('.prev-btn').click((e) => {
    let questionNumber = $('.nav-li.active').find('a.nav-link').attr('question-number');
    if(questionNumber == 1){
        return;
    }
    let newQuestionNumber = questionNumber - 1;
    $('li a[question-number="'+newQuestionNumber+'"]').tab('show');
});

$('.next-btn').click((e) => {
    let questionNumber = $('.nav-li.active').find('a.nav-link').attr('question-number');
    if($('.nav-li').length == questionNumber){
        return;
    }
    let newQuestionNumber = parseInt(questionNumber) + 1;
    $('li a[question-number="'+newQuestionNumber+'"]').tab('show');
});


