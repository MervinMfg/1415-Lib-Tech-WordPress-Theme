/**
 * 1415 Lib Tech WordPress Theme - Snowboard Finder - http://www.lib-tech.com
 * Authors: brian.behrens@mervin.com & tony.keller@mervin.com - http://www.mervin.com
 */

(function() {
  'use strict';

  var app = angular.module('boardFinder.snowboardFilters', ['boardFinder.user']);

  app.filter('snowboardFilter', function() {
    return function(snowboards, user) {
      var filteredSnowboards = [];
      // method to update match
      function updateMatch(matchValue, updateValue) {
        return parseInt(matchValue) + parseInt(updateValue);
      }
      // loop and filter collection
      angular.forEach(snowboards, function(snowboard) {
        var userHeight;
        userHeight = user.height();
        // set default match to 0
        snowboard.match = 0;
        // SIZE FILTERS
        // Weight Filter
        // Convert LBS to KG - 0.453592 KG in 1 LBS
        if (user.weight() >= snowboard.minWeight * 0.453592) {
          snowboard.match = updateMatch(snowboard.match, 5);
        }
        // HEIGHT FILTER
        // DETERMINE BMI - kg/m2
        // http://en.wikipedia.org/wiki/Body_mass_index
        // http://www.calculator.net/bmi-calculator.html
        user.bmi(user.weight() / ((user.height() * 0.01) * (user.height() * 0.01)) );
        // shift length in cms based on weight
        if(user.bmi() < 15) {
          // Very severely underweight
          userHeight = userHeight - 6;
        } else if(user.bmi() < 16) {
          // Severely underweight	from
          userHeight = userHeight - 4;
        } else if(user.bmi() < 18.5) {
          // Underweight
          userHeight = userHeight - 2;
        } else if(user.bmi() < 25) {
          // Normal
          userHeight = userHeight;
        } else if(user.bmi() < 30) {
          // Overweight
          userHeight = userHeight + 2;
        } else if(user.bmi() < 35) {
          // Moderately obese
          userHeight = userHeight + 4;
        } else if(user.bmi() < 40) {
          // Severely obese
          userHeight = userHeight + 6;
        } else {
          // Very severely obese
          userHeight = userHeight + 8;
        }
        // size chart based on the-house.com's specs
        // http://www.the-house.com/helpdesk/snowboard-sizing/#Snowboard_Size_Chart
        // 100 is the smallest board we make
        // 180W is the biggest board we make
        if(userHeight <= 109) {
          user.lengthRange("100");
          if(snowboard.length < 110) {
            snowboard.match = updateMatch(snowboard.match, 20);
          }
        } else if(userHeight <= 124) {
          user.lengthRange("110-120");
          if(snowboard.length >= 110 && snowboard.length <= 120) {
            snowboard.match = updateMatch(snowboard.match, 20);
          }
        } else if(userHeight <= 137) {
          user.lengthRange("115-130");
          if(snowboard.length >= 115 && snowboard.length <= 130) {
            snowboard.match = updateMatch(snowboard.match, 20);
          }
        } else if(userHeight <= 147) {
          user.lengthRange("125-135");
          if(snowboard.length >= 125 && snowboard.length <= 135) {
            snowboard.match = updateMatch(snowboard.match, 20);
          }
        } else if(userHeight <= 155) {
          user.lengthRange("130-140");
          if(snowboard.length >= 130 && snowboard.length <= 140) {
            snowboard.match = updateMatch(snowboard.match, 20);
          }
        } else if(userHeight <= 160) {
          user.lengthRange("135-145");
          if(snowboard.length >= 135 && snowboard.length <= 145) {
            snowboard.match = updateMatch(snowboard.match, 20);
          }
        } else if(userHeight <= 163) {
          user.lengthRange("140-150");
          if(snowboard.length >= 140 && snowboard.length <= 150) {
            snowboard.match = updateMatch(snowboard.match, 20);
          }
        } else if(userHeight <= 165) {
          user.lengthRange("145-152");
          if(snowboard.length >= 145 && snowboard.length <= 152) {
            snowboard.match = updateMatch(snowboard.match, 20);
          }
        } else if(userHeight <= 168) {
          user.lengthRange("148-153");
          if(snowboard.length >= 148 && snowboard.length <= 153) {
            snowboard.match = updateMatch(snowboard.match, 20);
          }
        } else if(userHeight <= 170) {
          user.lengthRange("150-155");
          if(snowboard.length >= 150 && snowboard.length <= 155) {
            snowboard.match = updateMatch(snowboard.match, 20);
          }
        } else if(userHeight <= 173) {
          user.lengthRange("152-155");
          if(snowboard.length >= 152 && snowboard.length <= 155) {
            snowboard.match = updateMatch(snowboard.match, 20);
          }
        } else if(userHeight <= 175) {
          user.lengthRange("153-157");
          if(snowboard.length >= 153 && snowboard.length <= 157) {
            snowboard.match = updateMatch(snowboard.match, 20);
          }
        } else if(userHeight <= 178) {
          user.lengthRange("154-159");
          if(snowboard.length >= 154 && snowboard.length <= 159) {
            snowboard.match = updateMatch(snowboard.match, 20);
          }
        } else if(userHeight <= 180) {
          user.lengthRange("155-160");
          if(snowboard.length >= 155 && snowboard.length <= 160) {
            snowboard.match = updateMatch(snowboard.match, 20);
          }
        } else if(userHeight <= 183) {
          user.lengthRange("156-162");
          if(snowboard.length >= 156 && snowboard.length <= 162) {
            snowboard.match = updateMatch(snowboard.match, 20);
          }
        } else if(userHeight <= 185) {
          user.lengthRange("157-163");
          if(snowboard.length >= 157 && snowboard.length <= 163) {
            snowboard.match = updateMatch(snowboard.match, 20);
          }
        } else if(userHeight <= 188) {
          user.lengthRange("158-166");
          if(snowboard.length >= 158 && snowboard.length <= 166) {
            snowboard.match = updateMatch(snowboard.match, 20);
          }
        } else if(userHeight <= 191) {
          user.lengthRange("159-167");
          if(snowboard.length >= 159 && snowboard.length <= 167) {
            snowboard.match = updateMatch(snowboard.match, 20);
          }
        } else if(userHeight <= 193) {
          user.lengthRange("160-170");
          if(snowboard.length >= 160 && snowboard.length <= 170) {
            snowboard.match = updateMatch(snowboard.match, 20);
          }
        } else if(userHeight <= 195) {
          user.lengthRange("161-172");
          if(snowboard.length >= 161 && snowboard.length <= 172) {
            snowboard.match = updateMatch(snowboard.match, 20);
          }
        } else if(userHeight <= 198) {
          user.lengthRange("162-174");
          if(snowboard.length >= 162 && snowboard.length <= 174) {
            snowboard.match = updateMatch(snowboard.match, 20);
          }
        } else if(userHeight <= 200) {
          user.lengthRange("163-176");
          if(snowboard.length >= 163 && snowboard.length <= 176) {
            snowboard.match = updateMatch(snowboard.match, 20);
          }
        } else if(userHeight <= 203) {
          user.lengthRange("165-178");
          if(snowboard.length >= 165 && snowboard.length <= 178) {
            snowboard.match = updateMatch(snowboard.match, 20);
          }
        } else if(userHeight <= 205) {
          user.lengthRange("166-180");
          if(snowboard.length >= 166 && snowboard.length <= 180) {
            snowboard.match = updateMatch(snowboard.match, 20);
          }
        } else if(userHeight <= 208) {
          user.lengthRange("168-180");
          if(snowboard.length >= 168 && snowboard.length <= 180) {
            snowboard.match = updateMatch(snowboard.match, 20);
          }
        } else {
          user.lengthRange("169-180");
          if(snowboard.length >= 169) {
            snowboard.match = updateMatch(snowboard.match, 20);
          }
        }
        // BOOT SIZES
        var bootSize = user.bootSize();
        var bootSizePoints = 0;
        if (user.gender() == "Female") {
          // women's shoes are 1.5 sizes smaller than men
          bootSize = bootSize - 1.5;
        }
        // Modified Boot Size Chart
        if(bootSize <= 7.5) {
          // Size 0 to 7.5 - Waist Width 23.5 to 24.5
          if(snowboard.waistWidth <= 24.5) {
            bootSizePoints = 10;
          }
        }
        if(bootSize >= 7.5 && bootSize <= 10) {
          // Size 7.5 to 10 – Waist Width 24.5 to 25.5
          if(snowboard.waistWidth >= 24.5 && snowboard.waistWidth <= 25.5) {
            bootSizePoints = 10;
          }
        }
        if(bootSize >= 10 && bootSize <= 11.5) {
          // Size 10 to 11.5 – Waist Width 25.5 to 26
          if(snowboard.waistWidth >= 25.5 && snowboard.waistWidth <= 26) {
            bootSizePoints = 10;
          }
        }
        if(bootSize >= 11.5) {
          // Size 11.5+ – Waist Width 26+
          if(snowboard.waistWidth >= 26) {
            bootSizePoints = 10;
          }
        }
        snowboard.match = updateMatch(snowboard.match, bootSizePoints);
        // // STYLE FILTERS
        // // Ability Filter
        switch(user.ability()) {
          case 'Beginner':
            snowboard.match = updateMatch(snowboard.match, snowboard.ability.beginner);
            break;
          case 'Intermediate':
            snowboard.match = updateMatch(snowboard.match, snowboard.ability.intermediate);
            break;
          case 'Advanced':
            snowboard.match = updateMatch(snowboard.match, snowboard.ability.advanced);
            break;
          case 'Expert':
            snowboard.match = updateMatch(snowboard.match, snowboard.ability.expert);
            break;
        }
        // // Terrain Filter
        switch(user.terrain()) {
          case 'Jib':
            snowboard.match = updateMatch(snowboard.match, snowboard.terrain.jib);
            break;
          case 'Park':
            snowboard.match = updateMatch(snowboard.match, snowboard.terrain.park);
            break;
          case 'All Mountain':
            snowboard.match = updateMatch(snowboard.match, snowboard.terrain.allMountain);
            break;
          case 'Powder':
            snowboard.match = updateMatch(snowboard.match, snowboard.terrain.powder);
            break;
        }
        // check if flex filter is set and award points if it is based on rating
        if(user.flex() == "Soft" && snowboard.flex < 6) {
          snowboard.match = updateMatch(snowboard.match, 5);
        } else if(user.flex() == "Medium" && snowboard.flex >= 4 && snowboard.flex <= 6) {
          snowboard.match = updateMatch(snowboard.match, 5);
        } else if(user.flex() == "Stiff" && snowboard.flex > 6) {
          snowboard.match = updateMatch(snowboard.match, 5);
        }
        // push snowboard if it scored more than 2
        // ability and terrain give 1 point each by default
        if (snowboard.match > 30) {
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
