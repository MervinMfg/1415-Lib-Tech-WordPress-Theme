/**
 * 1415 Lib Tech WordPress Theme - Snowboard Finder - http://www.lib-tech.com
 * Authors: brian.behrens@mervin.com & tony.keller@mervin.com - http://www.mervin.com
 */

(function() {
  'use strict';

  var app = angular.module('boardFinder.snowboardFilters', []);

  app.filter('snowboardFilter', function() {
    return function(snowboards, user) {
      var filteredSnowboards = [];
      // sliding height percentage
      var boardHeightPercentage = 0.87;
      if(user.height > 160) {
        boardHeightPercentage = 0.85;
      }
      // method to update match
      function updateMatch(matchValue, updateValue) {
        return parseInt(matchValue) + parseInt(updateValue);
      }
      // loop and filter collection
      angular.forEach(snowboards, function(snowboard) {
        // set default match to 0
        snowboard.match = 0;
        // SIZE FILTERS
        // Weight Filter
        if (user.weight >= snowboard.minWeight) {
          snowboard.match = updateMatch(snowboard.match, 5);
        }
        // Height Filter
        var idealHeight = boardHeightPercentage * user.height;
        // add points if within range of ideal snowboard height
        if (idealHeight - 2 <= snowboard.length && idealHeight + 3 >= snowboard.length) {
          snowboard.match = updateMatch(snowboard.match, 20);
        }
        // BOOT SIZES
        var bootSize = user.bootSize;
        var bootSizePoints = 0;
        if (user.gender == "Female") {
          // women's shoes are 1.5 sizes smaller than men
          bootSize = bootSize - 1.5;
        }
        // Modified Boot Size Chart
        if(bootSize <= 7.5) {
          // Size 0 to 7.5 - Waist Width 23.5 to 24.5
          if(snowboard.waistWidth <= 24.5) {
            bootSizePoints = 3;
          }
        }
        if(bootSize >= 7.5 && bootSize <= 10) {
          // Size 7.5 to 10 – Waist Width 24.5 to 25.5
          if(snowboard.waistWidth >= 24.5 && snowboard.waistWidth <= 25.5) {
            bootSizePoints = 3;
          }
        }
        if(bootSize >= 10 && bootSize <= 11.5) {
          // Size 10 to 11.5 – Waist Width 25.5 to 26
          if(snowboard.waistWidth >= 25.5 && snowboard.waistWidth <= 26) {
            bootSizePoints = 3;
          }
        }
        if(bootSize >= 11.5) {
          // Size 11.5+ – Waist Width 26+
          if(snowboard.waistWidth >= 26) {
            bootSizePoints = 3;
          }
        }
        snowboard.match = updateMatch(snowboard.match, bootSizePoints);
        // // STYLE FILTERS
        // // Ability Filter
        switch(user.ability) {
          case 'Advanced':
            snowboard.match = updateMatch(snowboard.match, snowboard.ability.advanced);
            break;
          case 'Intermediate':
            snowboard.match = updateMatch(snowboard.match, snowboard.ability.intermediate);
            break;
          default:
            snowboard.match = updateMatch(snowboard.match, snowboard.ability.beginner);
        }
        // // Terrain Filter
        switch(user.terrain) {
          case 'Freestyle':
            snowboard.match = updateMatch(snowboard.match, snowboard.terrain.freestyle);
            break;
          case 'Powder':
            snowboard.match = updateMatch(snowboard.match, snowboard.terrain.powder);
            break;
          default:
            snowboard.match = updateMatch(snowboard.match, snowboard.terrain.freeride);
        }
        // push snowboard if it scored more than 2
        // ability and terrain give 1 point each by default
        if (snowboard.match > 2) {
          filteredSnowboards.push(snowboard);
        }
      });
      // sort the filtered snowboards by their match, highest match first
      filteredSnowboards.sort(function(a, b) {
        if (a.match < b.match) {
          return 1;
        } else if (a.match > b.match) {
          return -1;
        }
        return 0; // a must be equal to b
      });
      var filteredSnowboardReduced = [];
      // remove duplicate snowboards beyond 2 sizes of same model
      angular.forEach(filteredSnowboards, function(forEachSnowboard, key) {
        var duplicateBoards = _.filter(filteredSnowboardReduced, function(filterSnowboard){ return filterSnowboard.title == forEachSnowboard.title; });
        if(duplicateBoards.length < 2) {
          filteredSnowboardReduced.push(forEachSnowboard);
        }
      });
      return filteredSnowboardReduced;
    };
  });
}());
