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
			angular.forEach(snowboards, function(snowboard) {
				// set default match to 0
        snowboard.match = 0;
        // SIZE FILTERS
        // Weight Filter
        // Height Filter
				if (user.height - 30 <= snowboard.length && user.height - 20 >= snowboard.length) {
					snowboard.match += 10;
				}
        // Boot Filter
        // STYLE FILTERS
        // Ability Filter
        // Terrain Filter

        if (snowboard.match !== 0) {
          filteredSnowboards.push(snowboard);
        }
			});
			// sort the filtered snowboards by their match, highest match first
			filteredSnowboards.sort(function (a, b) {
				if (a.match < b.match) {
					return 1;
				} else if (a.match > b.match) {
					return -1;
				}
				return 0; // a must be equal to b
			});
			return filteredSnowboards;
		};
	});

}());
