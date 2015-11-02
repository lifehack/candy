angular.module('starter.controllers', [])


  .controller('DashCtrl', function ($scope, Parties) {
    $scope.parties = Parties.all();
    $scope.remove = function (party) {
      Parties.remove(party);
    };
  })

  .controller('EventCtrl', function ($scope, Parties) {
    $scope.parties = Parties.all();
    $scope.remove = function (party) {
      Parties.remove(party);
    };
  })

  .controller('BookingCtrl', function ($scope) {

  })

  .controller('ChatDetailCtrl', function ($scope, $stateParams, Chats) {
    //$scope.chat = Chats.get($stateParams.chatId);
  })

  .controller('AccountCtrl', function ($scope) {
    $scope.settings = {
      enableFriends: true
    };
  });
