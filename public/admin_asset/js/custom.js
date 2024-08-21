$(document).ready(function(){
    $('#changepassword').change(function(){
        if ($(this).is(":checked")) {
            $(".pass").removeAttr('disabled');
        }else{
            $(".pass").attr('disabled','');
        }
    });
});


