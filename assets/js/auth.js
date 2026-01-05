$(document).ready(function() {

    // message animation show

    let messageTop = $('.message-wrapper').height();
    $('.message').css({"top": -messageTop, "visibility": "visible"});
    $('.message').animate({"top": '-0.5rem'});

    // message animation close

    $('.message .fa-xmark').on('click', function() {
        $('.message').animate({"top": -messageTop}, function() {$('.message').remove()});
    });

    // toggle password visibility for 0.5s

    function passwordVisible(visible) {
        $('#password').attr("type", visible ? "text" : "password");
        $('.toggle-visible').toggleClass("fa-eye-slash fa-eye");
    }

    $('.toggle-visible').on('click', function() {
        passwordVisible(true);
        setTimeout(function() {passwordVisible(false)}, 1000);
    });

    //send registration form and show warning when the rules are not met

    $('#auth_form').on('submit', function(event) {
        event.preventDefault();
        $('.form-warning').empty();
        $.ajax({
            url: $(this).attr('action'),
            method: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function(resp) {
                if(resp.error) {
                    if(resp.name_error) {
                        $('#name_error').append('<i class="fa-solid fa-circle-exclamation"></i>'+resp.name_error);
                    }
                    if(resp.email_error) {
                        $('#email_error').append('<i class="fa-solid fa-circle-exclamation"></i>'+resp.email_error);
                    }
                    if(resp.password_error) {
                        $('#password_error').append('<i class="fa-solid fa-circle-exclamation"></i>'+resp.password_error);
                    }
                } else {
                    window.location.href = resp.url;
                }
            }
        });
    });
});