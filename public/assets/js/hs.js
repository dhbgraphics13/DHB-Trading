function printErrorMsg (msg) {
    $("#ajax-form-hsk").find(':submit').val("Submit")
    $("#ajax-form-hsk").find(':submit').removeAttr('disabled', 'disabled');

    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display','block');
    $.each( msg, function( key, value ) {
        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
    });
}
//end code
// disable button on click
$(function()
{
    $('#ajax-form-hsk').submit(function()
    {
        $("input[type='submit']", this)
            .val("Please Wait...")
            .attr('disabled', 'disabled');
        return true;
    });
});
//end code

$('#ajax-form-hsk').on('submit', function(event) {
    event.preventDefault();

    //$(".btn-hsk").html("Sending please wait... <i class=\"fa fa-cog fa-spin fa-ax fa-fw\"></i>");
    //$(".btn-hsk").addClass('disable');

    var formData = $(this).serialize(); // form data as string
    var formAction = $(this).attr('action'); // form handler url
    var formMethod = $(this).attr('method'); // GET, POST
    var redirectTo  = $(this).attr('redirectTo'); // GET, POST


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: formAction,
        method: formMethod,
        cache: false,
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        processData: false,
        success: function(data) {
            if($.isEmptyObject(data.error)){
                //swal("Wow!" , data.success, "success");

                //$(".swal-modal").load(data.success);

                /*var percentage = 0;
                var timer = setInterval(function(){
                    percentage = percentage + 20;
                    progress_bar_process(percentage, timer);
                }, 200);
*/
                $("#msg").html(data.success);
                $('#hideError').addClass('hidden');
                $("#msg").fadeOut(2000);
                $("#msg").removeClass('hidden').addClass('alert alert-success');
                window.setTimeout(function(){window.location.href = redirectTo },2000);
            }
            else{
                printErrorMsg(data.error);
                swal("error" , data.error, "error");
                $(".print-error-msg").fadeOut(2000);
            }
        }
    });

});
