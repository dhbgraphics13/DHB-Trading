// ******************************************
// use for hide  all icon show perticuller content
// ******************************************
/*$(function(){
    $("#icon1").click(function () {
        $('.bg_none').addClass('hide');
        $('.newboxes').removeClass('hide');
    });



    $("#back").click(function () {
        $('.bg_none').removeClass('hide');
        $('.newboxes').addClass('hide');
    });
})*/



$(document).ready(function() {
    $('#popup').click(function() {
        $('.popupchat').toggle("slide");
    });
});


