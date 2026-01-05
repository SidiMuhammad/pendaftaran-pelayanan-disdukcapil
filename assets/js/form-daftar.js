$(document).ready(function () {

    $('.list-container-syarat[data-jenis="'+ $('input[name="jenis[]"]:checked').val() +'"]').css('display', 'block');

    $('input[name="jenis[]"]').each(function () {
        $(this).on('change', function () {
            let jenis = $(this).val()
            let syarat = $('.list-container-syarat[data-jenis="'+ jenis +'"]');
            if (this.checked) {
                syarat.css('display', 'block');
            }
            else {
                syarat.css('display', 'none');
                syarat.find('input[type="checkbox"]:checked').prop('checked', false);
            }
        });
    });

    $('#form_daftar').on('submit', function(event) {
        event.preventDefault();
        $('.form-warning').empty();
        $.ajax({
            url: $(this).attr('action'),
            method: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function(resp) {
                if(resp.error) {
                    if(resp.jenis_error) {
                        $('#jenis_error').append('<i class="fa-solid fa-circle-exclamation"></i>'+resp.jenis_error);
                    }
                    if(resp.date_error) {
                        $('#date_error').append('<i class="fa-solid fa-circle-exclamation"></i>'+resp.date_error);
                    }
                    if(resp.syarat_error) {
                        $('#syarat_error').append('<i class="fa-solid fa-circle-exclamation"></i>'+resp.syarat_error);
                    }
                } else {
                    window.location.href = resp.url;
                }
            }
        });
    });

});