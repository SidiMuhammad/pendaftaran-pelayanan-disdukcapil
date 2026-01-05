$(document).ready(function() {
    const calendarDay = $('.calendar > .days-number');
    const calendarMonthYear =  $('.calendar-month-year');
    const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    
    let today = new Date();
    let maxDate = new Date(new Date().setDate(today.getDate()+7));
    let currentMonth = today.getMonth();
    let currentYear = today.getFullYear();
    
    showCalendar(currentMonth, currentYear);

    $('.calendar-arrow.prev').on('click', function() {
        currentYear = (currentMonth == 0) ? currentYear - 1 : currentYear;
        currentMonth = (currentMonth == 0) ? 11 : currentMonth - 1;
        showCalendar(currentMonth, currentYear);
    });
    
    
    $('.calendar-arrow.next').on('click', function() {
        currentYear = (currentMonth == 11) ? currentYear + 1 : currentYear;
        currentMonth = (currentMonth + 1) % 12;
        showCalendar(currentMonth, currentYear);
    });

    $('.calendar').on('click', '.available', function () {
        $('.calendar .selected').removeClass('selected');
        $(this).addClass('selected');
        $('input[id="date_daftar"]').val(currentYear+'-'+(((currentMonth+1) < 10) ? '0'+(currentMonth+1) : (currentMonth+1))+'-'+(($(this).text() < 10) ? '0'+$(this).text() : $(this).text()));
    });
    
    function showCalendar(month, year) {
    
        if (month == today.getMonth() && year == today.getFullYear()) {
            $('.calendar-arrow.prev').addClass('hidden');
        }
        else {
            $('.calendar-arrow.prev').removeClass('hidden');
        }
        if (month == maxDate.getMonth() && year == maxDate.getFullYear()) {
            $('.calendar-arrow.next').addClass('hidden');
        }
        else {
            $('.calendar-arrow.next').removeClass('hidden');
        }
    
        let firstDay = (new Date(year, month)).getDay();
    
        calendarMonthYear.html(months[month]+' '+year);
        calendarDay.empty();
    
        let date = 1;
        for (let i = 0; i < 6; i++) {
            for (let j = 0; j < 7; j++) {
                let dayBlock = $('<div></div>');
                
                if (i == 0 && j < firstDay) {
                    dayBlock.text('');
                    calendarDay.append(dayBlock);
                }
                else if (date > daysInMonth(month, year)) {
                    break;
                }
                else {
                    dayBlock.text(date);
                    if (
                        (date <= today.getDate() && month == today.getMonth()) ||
                        (month < today.getMonth() && year == today.getFullYear()) ||
                        year < today.getFullYear() ||
                        (date > maxDate.getDate() && month == maxDate.getMonth()) ||
                        (month > maxDate.getMonth() && year == maxDate.getFullYear()) ||
                        year > maxDate.getFullYear()
                        ) {
                        dayBlock.addClass('unavailable');
                    }
                    else if (j == 6) {
                        dayBlock.addClass('close');
                    }
                    else {
                        dayBlock.addClass('available');
                    }
                    if (date == today.getDate() && month == today.getMonth() && year == today.getFullYear()) {
                        dayBlock.addClass('current');
                    }
                    date++;
                }
                calendarDay.append(dayBlock);
            }
        }
    
    }
    
    function daysInMonth(iMonth, iYear) {
        return 32 - new Date(iYear, iMonth, 32).getDate();
    }
    
});