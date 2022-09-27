//Add Question
$('#AddNewQuestions').submit(function(e) {
    e.preventDefault();

    var t_data =document.getElementById("tableQuestion");
    
    let formData = new FormData(this);
    $('.question_err').text('');
    $('.answer1_err').text('');
    $('.answer2_err').text('');
    $('.answer3_err').text('');
    $('.answer4_err').text('');
    $('.correct_err').text('');

      var question = $("textarea[name=question]").val();
      var answer1 = $("input[name=answer1]").val();
      var answer2 = $("input[name=answer2]").val();
      var answer3 = $("input[name=answer3]").val();
      var answer4 = $("input[name=answer4]").val();
      var correct = $('.CheckboxCorrect:checked').val();
    $.ajax({
        type:'POST',
        url: '/admin/storeQuestion',
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) { 
   
    if($.isEmptyObject(data.error)){
        t_data.innerHTML+="<tr><td>"+question+"</td><td>"+answer1+"</td><td>"+answer2+"</td><td>"+answer3+"</td><td>"+answer4+"</td><td>answer"+correct+"</td><td>"+
            " <a href='javascript:void(0)'  onclick='DeleteQuestion("+data.id+")' id='borrar_"+data.id+"' name='borrar_"+data.id+"' class='btn btn-danger'>Delete</a></td></tr>";

        $("#AddNewQuestions")[0].reset();}
    else{
    $.each( data.error, function( key, value ) {
    $('.'+key+'_err').text(value);
    });} 
}}); 
}); 



//Delete Question
function DeleteQuestion(id){
var _token = $('input[name="_token"]').val();
$.ajax({
    url: "/admin/delete-question/"+id,
    type: 'DELETE',
    data: {
        "id": id,
        "_token": _token,},
    success: function (){
        $("#borrar_"+id).closest('tr').fadeOut();
        }
});

}