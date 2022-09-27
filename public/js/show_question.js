
$(document).ready(function(){
    $('.submit-form').on('click', function(e){
        e.preventDefault();
        let form =  $(this).closest('form');
        let formActionUrl = form.attr('action');
        let type = form.attr('method');
        let formData = form.serialize();
        $.ajax({
            url: formActionUrl,
            type: type,
            data: formData,
        success: function(data) { 
            if($.isEmptyObject(data.error)){ }
            else{
            $.each( data.error, function( key, value ) {
            $('.'+key+'_err').text(value);
            });} 
        
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    });
  });
  

  var t =document.getElementById("t").value*60000;

  setTimeout(function() {
    alert("The time allowed has expired");
    window.location.href = "/"
}, t); 
