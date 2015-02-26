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

		// set public methods
		$scope.getAbility = getAbility;
		$scope.setAbility = setAbility;
		$scope.getTerrain = getTerrain;
		$scope.setTerrain = setTerrain;
	}]);
}());