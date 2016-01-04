angular.module('starter.controllers', [])


  .controller('DashCtrl', function ($scope, Parties) {
    $scope.parties = Parties.all();

  })

  .controller('EventCtrl', function ($scope, Parties) {
    $scope.parties = Parties.all();

  })

  .controller('BookingCtrl', function ($scope, Shops, uiCalendarConfig) {
    $scope.shops = Shops.all();

    $scope.eventSources = [];

    var old_source;

    $scope.selectedShop = function (pShop) {
      var current_date = moment();

      uiCalendarConfig.calendars['booking'].fullCalendar('gotoDate', current_date);
      uiCalendarConfig.calendars['booking'].fullCalendar('changeView', 'month');
      if (old_source) {
        uiCalendarConfig.calendars['booking'].fullCalendar('removeEventSource', old_source);
      }

      if (!pShop)
        return;
      Shops.getBooking(pShop.id, current_date.year(), current_date.month() + 1).then(function (bookings) {

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
        uiCalendarConfig.calendars['booking'].fullCalendar('addEventSource', events);
      });
    };

    $scope.changeView = function (view, calendar) {
      uiCalendarConfig.calendars[calendar].fullCalendar('changeView', view);
    };

    $scope.uiConfig = {
      calendar: {
        lang: "zh_cn",
        height: 450,
        header: {
          left: '',
          center: '',
          right: 'title prev,month,today,next'
        },
        allDaySlot: false,
        minTime: "10:00:00",
        maxTime: "22:00:00",
        timeFormat: 'H:mm',
        stick: true,
        dayClick: function (date, jsEvent, view) {
          var now = new Date();
          now.getDate();

          if (!date.isBefore(now)) {
            uiCalendarConfig.calendars['booking'].fullCalendar('gotoDate', date);
            $scope.changeView('agendaDay', 'booking');
          }
        },
        eventClick: function (event, jsEvent, view) {
          var now = moment();
          if (!event.start.isBefore(now)) {
            uiCalendarConfig.calendars['booking'].fullCalendar('gotoDate', event.start);
            $scope.changeView('agendaDay', 'booking');
          }
        }
      }
    };
  })

  .controller('AccountCtrl', function ($scope) {
    $scope.settings = {
      enableFriends: true
    };
  });
