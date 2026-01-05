$(document).ready(function () {

    // toggle password visibility for 1s
    function passwordVisible(visible) {
        $('#password').attr("type", visible ? "text" : "password");
        $('.toggle-visible').toggleClass("fa-eye-slash fa-eye");
    }

    $('.toggle-visible').on('click', function() {
        passwordVisible(true);
        setTimeout(function() {passwordVisible(false)}, 1000);
    });

    // toggle disabled input meja operator when role operator is other than operator pelayanan
    if ($('input[name="role"]:checked').val() != "Operator Pelayanan") {
        $('input[name="meja"]').prop('disabled', true);
    }

    $('input[name="role"]').each(function () {
        $(this).on('change', function () {
            let role = $(this).val();
            if (this.checked && role == "Operator Pelayanan") {
                $('input[name="meja"]').prop('disabled', false);
            }
            else {
                $('input[name="meja"]').prop('disabled', true);
                $('input[name="meja"]').val('');
            }
        });
    });

    // form submit
    $('#form_tambah_operator').on('submit', function(event) {
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
                    if(resp.password_error) {
                        $('#password_error').append('<i class="fa-solid fa-circle-exclamation"></i>'+resp.password_error);
                    }
                    if(resp.role_error) {
                        $('#role_error').append('<i class="fa-solid fa-circle-exclamation"></i>'+resp.role_error);
                    }
                    if(resp.meja_error) {
                        $('#meja_error').append('<i class="fa-solid fa-circle-exclamation"></i>'+resp.meja_error);
                    }
                } else {
                    window.location.href = resp.url;
                }
            }
        });
    });
});