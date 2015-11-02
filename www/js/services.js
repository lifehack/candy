angular.module('starter.services', [])

  .factory('Parties', function () {
    // Might use a resource here that returns a JSON array

    // Some fake testing data
    var parties = [{
      id: 0,
      name: '万圣节欢唱',
      lastText: '你准备好了么？',
      cover: 'img/recommend/1.png'
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
  });
