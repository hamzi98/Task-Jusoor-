$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
$('#LoginAdmin').submit(function(e) {
    e.preventDefault();

    let formData = new FormData(this);
    $('.username_err').text('');
    $('.password_err').text('');

    $.ajax({
        type:'POST',
        url: '/admin/login',
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {printMsg(data);   }});  }); 
        
    function printMsg (msg) {
    if($.isEmptyObject(msg.error)){
    window.location.href = "/admin/manage"
    }
    else{
    $.each( msg.error, function( key, value ) {
    $('.'+key+'_err').text(value);
    });
    }
}    