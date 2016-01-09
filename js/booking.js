/**
 * Created by hacker on 2016/1/8.
 */

$(document).ready(function () {

    $('#calendar').fullCalendar({
        height: 450,
        header: {
            left: 'title',
            center: '',
            right: 'prev,month,today,next'
        },
        allDaySlot: false,
        minTime: "10:00:00",
        maxTime: "22:00:00",
        timeFormat: 'H:mm',
        stick: true,
        dayClick: function (date, jsEvent, view) {
            var now = moment();
            if (!date.isBefore(now)) {
                $('#calendar').fullCalendar('gotoDate', date);
                $('#calendar').fullCalendar('changeView', 'agendaDay');
            }
        },
        eventClick: function (event, jsEvent, view) {
            var now = moment();
            if (!event.start.isBefore(now)) {
                $('#calendar').fullCalendar('gotoDate', event.start);
                $('#calendar').fullCalendar('changeView', 'agendaDay');
            }
        }
    });

});

var old_source;

function get_bookings(id) {

    var current_date = moment();

    $('#calendar').fullCalendar('gotoDate', current_date);
    $('#calendar').fullCalendar('changeView', 'month');
    if (old_source) {
        $('#calendar').fullCalendar('removeEventSource', old_source);
    }

    if (!id)
        return;

    var y = current_date.year();
    var m = current_date.month()+1;

    $.get("http://101.200.192.192:8888/calendar.php", {
        year: "2016",
        month: "1",
        studioNum: id
    }, function (data, status) {

        alert(data);

        var bookings = $.parseJSON(data);

        var events = {};
        events['events'] = [];
        $.each(bookings, function (i, booking) {
            var event = {};

            event["start"] = booking.StartTime;
            event["end"] = booking.FinishTime;

            events['events'].push(event);
        });

        events['borderColor'] = 'white';
        events['backgroundColor'] = 'red';
        events['color'] = 'black';
        events['textColor'] = 'yellow';

        old_source = events;
        $('#calendar').fullCalendar('addEventSource', events);
        $('#calendar').fullCalendar('rerenderEvents');
    });
}