/**
 * 1415 Lib Tech WordPress Theme - Snowboard Finder - http://www.lib-tech.com
 * Authors: brian.behrens@mervin.com & tony.keller@mervin.com - http://www.mervin.com
 */

(function() {
	'use strict';

	var app = angular.module('boardFinder.results', ['ngRoute', 'boardFinder.snowboard', 'boardFinder.snowboardFilters']);

	app.config(['$routeProvider', function($routeProvider) {
		$routeProvider.when('/results/', {
			templateUrl: '/wp-content/themes/1415-Lib-Tech-WordPress-Theme/_/apps/snowboard-finder/results/results.html',
			controller: 'ResultsController',
			controllerAs: 'resultsCtrl'
		});
	}]);

	app.controller('ResultsController', ['$scope', '$routeParams', '$log', 'config', 'user', function ResultsController($scope, $routeParams, $log, config, user) {
		$scope.name = "ResultsController";
		$scope.params = $routeParams;
		$scope.config = config;
		$scope.user = user;

		function init() {
			// init
		}

		function resetUser() {
			$scope.user.gender = "Default";
			$scope.user.weight = -1;
			$scope.user.height = -1;
			$scope.user.bootSize = -1;
			$scope.user.ability = "Default";
			$scope.user.terrain = "Default";
		}

		// set public methods
		$scope.resetUser = resetUser;

		init();
	}]);

}());
