/**
 * Created by hacker on 2016/1/8.
 */


function get_bookings(id) {

    var calendar = $("#calendar").calendar({
        tmpl_path: "/tmpls/",
        language: 'zh-CN',
        events_source: "../php/calendar.php?studioNum="+id
    });

    return;
}

get_bookings("1店");