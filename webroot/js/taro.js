$(window).load(() => {
    questionTypeToggle($('#question_type_select').val());
})
$('#question_type_select').change(() => {
    let typeID = $('#question_type_select').val();
    questionTypeToggle(typeID);
});

const questionTypeToggle = (typeID) => {
    if(typeID == 4 || typeID == 2){
        $('#choices-container').hide();
        (typeID == 4 ? $('#img-div').show() : $('#img-div').hide() );
    }else{
        $('#img-div').hide();
        $('#choices-container').show()
    }
}
