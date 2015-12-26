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

    $scope.changeView = function (view, calendar) {
      uiCalendarConfig.calendars[calendar].fullCalendar('changeView', view);
    };

    $scope.uiConfig = {
      calendar: {
        lang: "zh_cn",
        height: 600,
        header: {
          left: 'title',
          center: '',
          right: 'today prev,next'
        },
        dayClick: function (date, jsEvent, view) {
          uiCalendarConfig.calendars['booking'].fullCalendar('gotoDate', date);
          $scope.changeView('agendaDay', 'booking');
        }
      }
    };
  })

  .controller('AccountCtrl', function ($scope) {
    $scope.settings = {
      enableFriends: true
    };
  });
