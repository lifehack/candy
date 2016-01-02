angular.module('starter.controllers', [])


  .controller('DashCtrl', function ($scope, Parties) {
    $scope.parties = Parties.all();

  })

  .controller('EventCtrl', function ($scope, Parties) {
    $scope.parties = Parties.all();

  })

  .controller('BookingCtrl', function ($scope, Shops, uiCalendarConfig) {
    $scope.shops = Shops.all();

    $scope.eventSources = [
      //{
      //  events: [
      //    {
      //      start: '2016-01-08 12:30:00',
      //      end: '2016-01-08 16:30:00'
      //    },
      //    {
      //      start: '2016-01-09 12:30:00',
      //      end: '2016-01-09 16:30:00'
      //    }
      //  ],
      //  color: 'black',     // an option!
      //  textColor: 'yellow', // an option!
      //  backgroundColor: 'red',
      //  rendering: 'background'
      //}
    ];

    $scope.selectedShop = function (pShop) {
      var current_date = uiCalendarConfig.calendars['booking'].fullCalendar('getDate');
      Shops.getBooking(pShop.id, current_date.year(), current_date.month() + 1).then(function (bookings) {

        var events = {};
        events['events'] = [];
        $.each(bookings, function (i, booking) {
          var start = moment(booking.StartTime);
          var end = moment(booking.FinishTime);

          var event = {};

          event["start"] = start.format();
          event["end"] = end.format();

          events['events'].push(event);
        });

        events['backgroundColor'] = 'red';
        events['color'] = 'black';
        events['textColor'] = 'yellow';
        //events['rendering'] = 'background';
        console.log(events);

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

          console.log(event.start);
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
