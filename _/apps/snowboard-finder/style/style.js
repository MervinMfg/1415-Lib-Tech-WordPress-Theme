/**
 * 1415 Lib Tech WordPress Theme - Snowboard Finder - http://www.lib-tech.com
 * Authors: brian.behrens@mervin.com & tony.keller@mervin.com - http://www.mervin.com
 */

(function() {
	'use strict';

	var app = angular.module('boardFinder.style', ['ngRoute']);

	app.config(['$routeProvider', function($routeProvider) {
		$routeProvider.when('/style/', {
			templateUrl: '/wp-content/themes/1415-Lib-Tech-WordPress-Theme/_/apps/snowboard-finder/style/style.html',
			controller: 'StyleController',
			controllerAs: 'styleCtrl'
		});
	}]);

	app.controller('StyleController', ['$scope', '$location', '$routeParams', '$log', 'user', function StyleController($scope, $location, $routeParams, $log, user) {
		$scope.name = "StyleController";
		$scope.params = $routeParams;
		$scope.quote = "";

		function getAbility() {
			return user.ability;
		}

		function setAbility(ability) {
			user.ability = ability;
			checkAdvance();
		}

		function getTerrain() {
			return user.terrain;
		}

		function setTerrain(terrain) {
			user.terrain = terrain;
			checkAdvance();
		}

		function checkAdvance() {
			if(user.ability != "Default" && user.terrain != "Default") {
				$location.path( '/results/' );
			}
		}

		function updateQuote(section) {
			switch(section) {
				case 'Beginner':
					$scope.quote = "Never Been? Been some but still trying to get the hang of it?";
					break;
				case 'Intermediate':
					$scope.quote = "You love turning your board, now you are looking to specialize your ripping?";
					break;
				case 'Advanced':
						$scope.quote = "So you know what you are doing? Looking for the World’s Best Board for an all-time adventure?";
						break;
				case 'Freestyle':
						$scope.quote = "Good for parks, rails, butters, side hits, jamming, bonking, slashing and sliding.";
						break;
				case 'Freeride':
						$scope.quote = "Good for resort ripping, groomers, steeps and trees.";
						break;
				case 'Powder':
						$scope.quote = "Good for pillows and deep days.";
						break;
			}
		}

		// set public methods
		$scope.getAbility = getAbility;
		$scope.setAbility = setAbility;
		$scope.getTerrain = getTerrain;
		$scope.setTerrain = setTerrain;
		$scope.updateQuote = updateQuote;
	}]);
}());
