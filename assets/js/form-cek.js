$(document).ready(function () {

     $('input[type="checkbox"]').each(function () {
        $(this).on('change', function () {
            if (this.checked) {
                $(this).val(1);
            }
            else {
                $(this).val(0);
            }
        });
    });


    $('#form_cek').on('submit', function(event) {
        event.preventDefault();
        $('input[type="checkbox"]:not(:checked)').prop('checked', true);
        $('.form-warning').empty();
        console.log($(this).serialize());
        $.ajax({
            url: $(this).attr('action'),
            method: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function(resp) {
                window.location.href = resp.url;
            }
        });
    });
    
    
});