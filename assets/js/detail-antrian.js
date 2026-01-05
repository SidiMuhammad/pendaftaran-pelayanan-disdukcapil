$(document).ready(function () {
    $('.btn-step-pengecekan').on('click', function () {
        hideDetailPelayanan();
        $(this).addClass('active');
        $('.pelayanan-detail-container').eq(1).addClass('open');
    });
    $('.btn-step-pelayanan').on('click', function () {
        hideDetailPelayanan();
        $(this).addClass('active');
        $('.pelayanan-detail-container').eq(2).addClass('open');
    });
    $('.btn-step-pemrosesan').on('click', function () {
        hideDetailPelayanan();
        $(this).addClass('active');
        $('.pelayanan-detail-container').eq(3).addClass('open');
    });

    // hide current opened detail pelayanan container and active button step
    function hideDetailPelayanan() {
        $('.pelayanan-step-container > a.active').removeClass('active');
        $('.pelayanan-detail-container.open').removeClass('open');
    }
});