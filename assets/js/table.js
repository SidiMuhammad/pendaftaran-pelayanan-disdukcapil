$(document).ready(function () {

    // hide modal on click button batal
    $('.modal-button > .batal').on('click', function () {
        $('.modal-container').css('display', 'none');
    });

    // show modal on click table option hapus
    $('.table-data-hapus').on('click', function (event) {
        event.preventDefault();
        console.log($(this).attr('href'));
        $('.modal-container').css('display', 'flex');
        $('.modal-body').text('Hapus operator dengan id ' + $(this).attr('data-id') + ' ?');
        $('.modal-button > .hapus').attr('href', $(this).attr('href'));
    });

    // show and hide table option dropdown
    $('.table-opt-dropdown').each(function () {
        let button = $(this.firstElementChild);
        let menu = $(this.lastElementChild);

        button.on('click', function (event) {
            event.stopPropagation();

            hideTableDropdown($('.table-opt:visible').not(menu));
            
            if (menu.css('display') == 'none') {
                menu.animate(
                    {'top': '2.5rem', 'opacity': 1},
                    {duration: 200, start: function() { menu.css('display', 'block'); }}
                );
            } else {
                hideTableDropdown(menu);
            }
        });
        
    });

    // hide table option dropdwon on document click
    $(document).on('click', function () {
        hideTableDropdown($('.table-opt:visible'));
    });

    // function hide table option dropdown
    function hideTableDropdown(menu) {
        menu.animate(
            {'top': '1.5rem', 'opacity': 0},
            {duration: 200, done: function() { menu.css('display', 'none'); }}
        );
    }
});