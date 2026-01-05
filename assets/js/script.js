$(document).ready(function () {

    $('#tambah_form').on('submit', function(event) {
        event.preventDefault();
        console.log($(this).serialize());
    });

    // toggle menu user dropdown

    $('.user-dropdown').on('click', function() {
        if ($('.dropdown-menu').css('display') == 'none') {
            console.log("keklik");
            $('.dropdown-menu').animate(
                {'top': '4.5rem', 'opacity': 1},
                {duration: 200, start: function() { $('.dropdown-menu').css('display', 'block'); }}
            );
        } else {
            $('.dropdown-menu').css('display', 'block');
            $('.dropdown-menu').animate(
                {'top': '5.5rem', 'opacity': 0},
                {duration: 200, done: function() { $('.dropdown-menu').css('display', 'none'); }}
            );
        }
    });

    function showSubMenu(content) {
        let subMenuHeight = 0;

        $(content).css('display', 'block');
        $(content).children().each(function() {
            subMenuHeight += $(this)[0].offsetHeight;
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
                $('.open').not(subMenuContainer).not('.active').each(function() {
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

var sortCol = document.getElementsByClassName('sort-arrow');

for (let i = 0; i < sortCol.length; i++) {
    sortCol[i].parentElement.addEventListener('click', function() { 
        for (let j = 0; j < sortCol.length; j++) {
            if (j == i) {
                if (sortCol[j].firstElementChild.classList.contains('sorted')) {
                    sortCol[j].firstElementChild.classList.remove('sorted');
                    sortCol[j].lastElementChild.classList.add('sorted');
                }
                else if (sortCol[j].lastElementChild.classList.contains('sorted')) {
                    sortCol[j].lastElementChild.classList.remove('sorted');
                    sortCol[j].firstElementChild.classList.add('sorted');
                }
                else {
                    sortCol[j].lastElementChild.classList.add('sorted');

                }
            }
            else {
                if (sortCol[j].firstElementChild.classList.contains('sorted')) {
                    sortCol[j].firstElementChild.classList.remove('sorted');
                }
                else if (sortCol[j].lastElementChild.classList.contains('sorted')) {
                    sortCol[j].lastElementChild.classList.remove('sorted');
                }
            }
        }
    });
}