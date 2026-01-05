$(document).ready(function () {
    $('.tambah-syarat').on('click', function () {
        let jumlahSyarat = $('.input-list').children().length;
        $('.input-list').append('<li><span>'+(jumlahSyarat+1)+'</span><textarea id="syarat" name="syarat[]" cols="1" rows="1" class="form-input" placeholder="Syarat Layanan"></textarea></li>');
    });

    $('#form_tambah_layanan').on('submit', function(event) {
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
                    if(resp.bagian_error) {
                        $('#bagian_error').append('<i class="fa-solid fa-circle-exclamation"></i>'+resp.bagian_error);
                    }
                    if(resp.deskripsi_error) {
                        $('#deskripsi_error').append('<i class="fa-solid fa-circle-exclamation"></i>'+resp.deskripsi_error);
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