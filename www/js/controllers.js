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
    $scope.update = function() {
      $scope.item.size.code = $scope.selectedItem.code
      // use $scope.selectedItem.code and $scope.selectedItem.name here
      // for other stuff ...
    }
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
x
