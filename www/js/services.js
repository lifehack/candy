angular.module('starter.services', [])

  .factory('Parties', function () {
    // Might use a resource here that returns a JSON array

    // Some fake testing data
    var parties = [{
      id: 0,
      name: '万圣节欢唱',
      lastText: '你准备好了么？',
      cover: 'img/recommend/4.jpg'
    }, {
      id: 1,
      name: '圣诞狂欢夜',
      lastText: '等你来战！',
      cover: 'img/recommend/2.png'
    }, {
      id: 2,
      name: '元旦特辑',
      lastText: '单曲首发！',
      cover: 'img/recommend/3.png'
    }];

    return {
      all: function () {
        return parties;
      },
      remove: function (party) {
        parties.splice(parties.indexOf(party), 1);
      },
      get: function (partyId) {
        for (var i = 0; i < parties.length; i++) {
          if (parties[i].id === parseInt(partyId)) {
            return parties[i];
          }
        }
        return null;
      }
    };
  })
  .factory('Shops', function ($http) {
    // Might use a resource here that returns a JSON array

    // Some fake testing data
    var shops = [
      {id: 1, name: "雍和宫一店"},
      {id: 5, name: "雍和宫五店"},
      {id: 2, name: "工体店"},
      {id: 4, name: "日坛店"}
    ];

    var bookings = [];

    return {
      all: function () {
        return shops;
      },
      getBooking: function (shop_id, year, month) {
        return $http.get("http://101.200.192.192:8080/calendar.php?year="+year+"&month="+month+"&studioNum="+shop_id+"店")
          .then(function(response)
          {
            bookings = response.data;
            return bookings;
          });
      }
    };
  });
