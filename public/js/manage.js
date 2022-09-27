//Add Quiz
$('#AddNewQuiz').submit(function(e) {
    e.preventDefault();

    let formData = new FormData(this);
    $('.title_err').text('');
    $('.description_err').text('');
    $('.period_err').text('');

      var title = $("input[name=title]").val();
      var description = $("textarea[name=description]").val();
      var period = $("input[name=period]").val();

    $.ajax({
        type:'POST',
        url: '/admin/AddQuiz',
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) { 
   
    if($.isEmptyObject(data.error)){
          t_data.innerHTML+="<tr><td>"+title+"</td><td>"+description+"</td><td>"+period+"</td><td>"+ 
            "<a href='javascript:void(0)'  onclick='DeleteQuiz("+data.id+")' id='borrar_"+data.id+"' name='borrar_"+data.id+"' class='btn btn-danger'>Delete</a>"+
            "<a onclick='myFunction("+data.id+")'  data-toggle='modal' data-target='#EditeQuiz' class='btn btn-primary'>Edite</a> <a href='/admin/AddQuestion/"+data.id+"' class='btn btn-success'>Create New Question</a>"
            +"</td></tr>";
        $("#AddNewQuiz")[0].reset();}
    else{
    $.each( data.error, function( key, value ) {
    $('.'+key+'_err').text(value);
    });} 
}}); 
}); 

//Edite Quiz
$('#editedata').submit(function(e) {
    e.preventDefault();
    var t_data =document.getElementById("tablequiz");

    let formData = new FormData(this);
    $('.title_err').text('');
    $('.description_err').text('');
    $('.period_err').text('');
   
    var title = $("input[name=title]").val();
    var description = $("textarea[name=description]").val();
    var period = $("input[name=period]").val();

    $.ajax({
        type:'Post',
        url: '/admin/EditeQuiz',
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) { 
   
    if($.isEmptyObject(data.error)){
        alert("Edited successfully");
        window.location.href = "/admin/manage"

     }

    else{
    $.each( data.error, function( key, value ) {
    $('.'+key+'_err').text(value);
    });} 
}}); 
}); 
  
//Delete Quiz
function DeleteQuiz(id){
var _token = $('input[name="_token"]').val();
$.ajax({
    url: "/admin/delete/"+id,
    type: 'DELETE',
    data: {
        "id": id,
        "_token": _token,},
    success: function (){
        $("#borrar_"+id).closest('tr').fadeOut();
        }
});

}


//Get Quiz
var t_data =document.getElementById("tablequiz");
var req=new XMLHttpRequest();
req.open("GET","/admin/fetch",true);
req.send();

req.onreadystatechange=function(){
if(req.readyState ==4 && req.status==200 ){
var obj=JSON.parse(req.responseText);

for ( i=0; i < obj.quiz.length; i++) {
t_data.innerHTML+="<tr><td>"+obj.quiz[i]['title']+"</td><td>"+obj.quiz[i]['description']+"</td><td>"+obj.quiz[i]['period']+
"</td><td><a href='javascript:void(0)'  onclick='DeleteQuiz("+obj.quiz[i]['id']+")' id='borrar_"+obj.quiz[i]['id']+"' name='borrar_"+obj.quiz[i]['id']+
"'class='btn btn-danger'>Delete</a> <a onclick='myFunction("+obj.quiz[i]['id']+")'  data-toggle='modal' data-target='#EditeQuiz' class='btn btn-primary'>Edite</a> <a href='/admin/AddQuestion/"+obj.quiz[i]['id']+"' class='btn btn-success'>Create New Question</a></td></tr>";

}}};


function myFunction (id) { 

var f_data =document.getElementById("Edite");
var req2=new XMLHttpRequest();
req2.open("GET","/admin/fetch/"+id,true);
req2.send();

req2.onreadystatechange=function(){
if(req2.readyState ==4 && req2.status==200 ){
var obj=JSON.parse(req2.responseText);
f_data.innerHTML="<input class='form-control' value='"+obj.quiz['title']+"' type='text' id='title' name='title' placeholder='title'>"+
"<span class='text-danger error-text title_err'></span>"+
"<textarea class='form-control' name='description' id='description'  placeholder='description'>"+obj.quiz['description']+"</textarea>"+
"<span class='text-danger error-text description_err'></span>"+
"<input class='form-control' value='"+obj.quiz['period']+"' type='text' id='period' name='period' placeholder='period'>"+
"<input  value='"+obj.quiz['id']+"' type='hidden' id='id' name='id'>"+
"<span class='text-danger error-text period_err'></span>"+"<br>"+
"<button type='submit' class='btn btn-success '>Save</button>";
}};}

