 /**
 * 1415 Lib Tech WordPress Theme - Snowboard Finder - http://www.lib-tech.com
 * Authors: brian.behrens@mervin.com & tony.keller@mervin.com - http://www.mervin.com
 */

(function() {
	'use strict';

	var app = angular.module('boardFinder.style', ['ngRoute', 'boardFinder.user']);

	app.config(['$routeProvider', 'userProvider', function($routeProvider, userProvider) {
		$routeProvider.when('/style/', {
			templateUrl: '/wp-content/themes/1415-Lib-Tech-WordPress-Theme/_/apps/snowboard-finder/style/style.html',
			controller: 'StyleController',
			controllerAs: 'styleCtrl',
			resolve: {
				// be sure we have the data we need, if not redirect
				dataCheck: ['$location', function ($location) {
					if(userProvider.checkGender()) {
						if(userProvider.checkSize()) {
							return true;
						} else {
							$location.path('/size/');
						}
					} else {
						$location.path('/');
					}
				}]
			}
		});
	}]);

	app.controller('StyleController', ['$scope', '$location', '$routeParams', '$log', 'user', function StyleController($scope, $location, $routeParams, $log, user) {
		$scope.name = "StyleController";
		$scope.params = $routeParams;
		$scope.user = user;
		$scope.quote = "";

		function setAbility(value) {
			user.ability(value);
			checkAdvance();
		}

		function setTerrain(value) {
			user.terrain(value);
			checkAdvance();
		}

		function checkAdvance() {
			if(user.ability() != "Default" && user.terrain() != "Default") {
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
				case 'Expert':
						$scope.quote = "We need an expert quote!!!";
						break;
				case 'Jib':
						$scope.quote = "We need a jib quote!!!";
						break;
				case 'Park':
						$scope.quote = "Good for parks, rails, butters, side hits, jamming, bonking, slashing and sliding.";
						break;
				case 'All Mountain':
						$scope.quote = "Good for resort ripping, groomers, steeps and trees.";
						break;
				case 'Powder':
						$scope.quote = "Good for pillows and deep days.";
						break;
			}
		}

		// set public methods
		$scope.setAbility = setAbility;
		$scope.setTerrain = setTerrain;
		$scope.updateQuote = updateQuote;
	}]);
}());
