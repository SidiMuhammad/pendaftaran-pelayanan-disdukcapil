$(document).ready(function () {

    // flash message show
    let messageTop = $('.message-wrapper').height();
    $('.message').css({"top": -messageTop, "visibility": "visible"});
    $('.message').animate({"top": '-0.5rem'});

    // flash message close
    $('.message .btn-close').on('click', function() {
        $('.message').animate({"top": -messageTop}, function() {$('.message').remove()});
    });

    // toggle sidebar visibility
    $('.navbar .fa-bars').on('click', function () {
        if ($('.sidebar-container').css('left') == '0px') {
            $('.sidebar-container').css('left', '-23.5rem');
            $('.app-container').css('padding-left', '2rem');
        } else {
            $('.sidebar-container').css('left', 0);
            $('.app-container').css('padding-left', '23.5rem');
        }
    });

    // toggle menu user dropdown
    $('.user-dropdown').on('click', function(event) {
        event.stopPropagation();

        if ($('.dropdown-menu.user').css('display') == 'none') {
            $('.dropdown-menu.user').animate(
                {'top': '4.5rem', 'opacity': 1},
                {duration: 200, start: function() { $('.dropdown-menu.user').css('display', 'block'); }}
            );
        } else {
            hideUserMenu();
        }
    });

    // hide user dropdown on document click
    $(document).on('click', function () {
        hideUserMenu();
    });

    // function hide user dropdown
    function hideUserMenu() {
        $('.dropdown-menu.user').css('display', 'block');
            $('.dropdown-menu.user').animate(
                {'top': '5.5rem', 'opacity': 0},
                {duration: 200, done: function() { $('.dropdown-menu.user').css('display', 'none'); }}
            );
    }

    // function show active sidebar
    function showSubMenu(content) {
        let subMenuHeight = 0;

        $(content).css('display', 'block');
        $(content).children().each(function() {
            subMenuHeight += this.offsetHeight;
        });
        $(content).animate(
            {'height': subMenuHeight},
            {duration: 200}
        );
    }

    // open currently active side bar
    let subMenuActive = $('.menu-active').parents('.list-level-1');
    if (subMenuActive.children().length > 1) {
        subMenuActive.addClass('active open');
        showSubMenu($(subMenuActive[0].lastElementChild));
    }

    // toggle side bar menu dropdown
    $('.list-level-1').each(function() {
        let subMenuContainer = $(this);
        if (subMenuContainer.children().length > 1) {
            let subMenuHeader = $(this.firstElementChild);
            let subMenuContent = $(this.lastElementChild);
            $(subMenuHeader).on('click', function() {
                $('.list-level-1.open').not(subMenuContainer).not('.active').each(function() {
                    $(this).removeClass('open');
                    $(this.lastElementChild).animate(
                        {'height': 0},
                        {duration: 200, done: function() { $(this).css('display', 'none'); }}
                    );
                });
                $(subMenuContainer).toggleClass('open');
                if ($(subMenuContainer).hasClass('open')) {
                    showSubMenu(subMenuContent);
                } else {
                    $(subMenuContent).animate(
                        {'height': 0},
                        {duration: 200, done: function() { $(subMenuContent).css('display', 'none'); }}
                    );
                }
            });
        }
    });
    
});