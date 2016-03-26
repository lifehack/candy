var url = document.getElementById("url").textContent;
var jdays = [];
var shopSelector = $('#shop');
var calendar = $('#calendar');

cDate = moment();
$('#currentDate').text("今天是 " + cDate.format("YYYY年MM月DD日"));

$(document).ready(function () {

    calendar.datepicker({
        minDate: 0,
        dateFormat: 'yy-mm-dd',
        showMonthAfterYear: true,
        beforeShowDay: highlightDays,
        yearSuffix: '年',
        nextText: '下月',
        prevText: '上月',
        monthNames: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"],
        monthNamesShort: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"],
        dayNamesMin: ["日", "一", "二", "三", "四", "五", "六"],
        onSelect: getTimes
    });

    updateCalendar();

    shopSelector.change(function () {
        updateCalendar();
    });
});

/**
 * Instantiates the calendar AFTER ajax call
 */
function updateCalendar() {
    var id = shopSelector.val();

    //console.log(calendar.datepicker('getDate'));

    $.get(url + "/api/get-available-days/" + id, function (data) {
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
    var id = shopSelector.val();

    var dateSelected = moment(d);
    document.getElementById('daySelect').innerHTML = dateSelected.format("YYYY年MM月DD日");
    $.get(url + "/booking/times?selectedDay=" + d + "&id=" + id, function (data) {
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