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
    var disabledDates = [
     /* new Date(1437719836326),
      new Date(),
      new Date(2015, 07, 10), //months are 0-based, this is August, 10th!
      new Date('Wednesday, August 12, 2015'), //Works with any valid Date formats like long format
      new Date("11-11-2015"), //Short format
      new Date(1439676000000) //UNIX format*/
    ];
    var monthList = ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"];
    var weekDaysList = ["日", "一", "二", "三", "四", "五", "六"];
    $scope.datepickerObject = {
      titleLabel: '预约表',  //Optional
      todayLabel: '今日',  //Optional
      closeLabel: '关闭',  //Optional
      setLabel: '一键预约',  //Optional
      setButtonType : 'button-light',  //Optional
      todayButtonType : 'button-light',  //Optional
      closeButtonType : 'button-light',  //Optional
      inputDate: new Date(),  //Optional
      mondayFirst: false,  //Optional
      disabledDates: disabledDates, //Optional
      weekDaysList: weekDaysList, //Optional
      monthList: monthList, //Optional
      templateType: 'modal', //Optional
      showTodayButton: 'true', //Optional
      modalHeaderColor: 'bar-light', //Optional
      modalFooterColor: 'bar-light', //Optional
      from: new Date(2012, 8, 2), //Optional
      to: new Date(),  //Optional
      callback: function (val) {  //Mandatory
        /*datePickerCallback(val);*/
        if (typeof(val) === 'undefined') {
          console.log('No date selected');
        } else {
          console.log('Selected date is : ', val)
        }
      },
      dateFormat: 'dd-MM-yyyy', //Optional
      closeOnSelect: false, //Optional
    };

  })

  .controller('ChatDetailCtrl', function ($scope, $stateParams, Chats) {
    //$scope.chat = Chats.get($stateParams.chatId);
  })

  .controller('AccountCtrl', function ($scope) {
    $scope.settings = {
      enableFriends: true
    };
  });
