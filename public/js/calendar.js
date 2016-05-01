var url = document.getElementById("url").textContent;
var jdays = [];
var shopSelector = $('#shop');
var calendar = $('#calendar');

var currentId;

cDate = moment();
$('#currentDate').text("今天是 " + cDate.format("YYYY年MM月DD日"));

$(document).ready(function () {

    calendar.datepicker({
        minDate: 0,
        dateFormat: 'yy-mm-dd',
        showMonthAfterYear: true,
        yearSuffix: '年',
        nextText: '下月',
        prevText: '上月',
        monthNames: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"],
        monthNamesShort: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"],
        dayNamesMin: ["日", "一", "二", "三", "四", "五", "六"],
        beforeShowDay: highlightDays,
        onChangeMonthYear: updateCalendar,
        onSelect: getTimes
    });

    change(1);
});

/**
 * Instantiates the calendar AFTER ajax call
 */
function updateCalendar(year, month) {
    if (!year)
        year = cDate._d.getFullYear();

    if (!month)
        month = cDate._d.getMonth() + 1;

    $.get(url + "/api/get-available-days", {id: currentId, year: year, month: month})
        .done(function (data) {
            jdays = [];

            $.each(data, function (index, value) {
                jdays.push(value.booking_datetime);
            });

            calendar.datepicker('refresh');

        });

    $('#dayTimes').empty();
}

/**
 * Highlights the days available for booking
 * @param  {datepicker date} date
 * @return {boolean, css}
 */
function highlightDays(date) {
    date = moment(date).format('YYYY-MM-DD');
    for (var i = 0; i < jdays.length; i++) {
        jDate = moment(jdays[i]).format('YYYY-MM-DD');
        if (jDate == date) {
            return [true, 'available'];
        }
    }
    return false;
}

/**
 * Gets times available for the day selected
 * Populates the daytimes id with dates available
 */
function getTimes(d) {

    var dateSelected = moment(d);
    document.getElementById('daySelect').innerHTML = dateSelected.format("YYYY年MM月DD日");
    $.get(url + "/booking/times?selectedDay=" + d + "&id=" + currentId, function (data) {
        $('#dayTimes').empty();
        $('#dayTimes').append('<h6>空闲时段</h6>');
        for (var i in data) {
            var rdate = data[i].booking_datetime;
            rdate = rdate.split(" ");

            var start = rdate[1];
            var end = Number(start.split(":")[0]) + 1;

            end = String(end) + ":00:00";

            $("#dayTimes").append('<b>' + start + ' - ' + end + '</b><br>');
        }
    });
}

var phone = [
    'tel:010-64254655',
    'tel:010-85696297',
    'tel:010-88689505',
    'tel:010-65525835',
    'tel:010-84258453',
    'tel:010-66086606'
];

function change(id) {
    currentId = id;

    updateCalendar(id);

    $('td').css('color', 'white');
    $('#shop' + id).css('color', 'dodgerblue');

    $('#shop_image').attr('src', 'img/shop' + id + '.jpg');

    $('#shop_phone').attr('href', phone[Number(id) - 1]);
}