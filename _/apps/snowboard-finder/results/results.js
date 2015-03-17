/**
 * 1415 Lib Tech WordPress Theme - Snowboard Finder - http://www.lib-tech.com
 * Authors: brian.behrens@mervin.com & tony.keller@mervin.com - http://www.mervin.com
 */

(function() {
	'use strict';

	var app = angular.module('boardFinder.results', ['ngRoute', 'boardFinder.productFilter', 'boardFinder.snowboard', 'boardFinder.snowboardFilters']);

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
		$scope.productFilters = [
			{
				title: "Ability",
				classes: "ability left",
				filters: [
					{ title: "Easy", value: "Beginner" },
					{ title: "All Around", value: "Intermediate" },
					{ title: "Agressive", value: "Advanced" }
				]
			},
			{
				title: "Terrain",
				classes: "terrain center",
				filters: [
					{ title: "Park", value: "Freestyle" },
					{ title: "All Mountain", value: "Freeride" },
					{ title: "Powder", value: "Powder" }
				]
			},
			{
				title: "Flex",
				classes: "flex right",
				filters: [
					{ title: "Soft", value: "Soft" },
					{ title: "Medium", value: "Medium" },
					{ title: "Stiff", value: "Stiff" }
				]
			}
		];

		function init() {
			// listen for filters to update
			$scope.$on('filterSelected', function (event, arg) {
				updateFilters(arg.filter, arg.value);
			});
		}

		function resetUser() {
			$scope.user.gender = "Default";
			$scope.user.weight = -1;
			$scope.user.height = -1;
			$scope.user.bootSize = -1;
			$scope.user.ability = "Default";
			$scope.user.terrain = "Default";
			$scope.user.flex = "Default";
		}

		function updateFilters(filter, value) {
			switch(filter) {
				case 'Ability':
					$scope.user.ability = value;
					break;
				case 'Terrain':
					$scope.user.terrain = value;
					break;
				case 'Flex':
					$scope.user.flex = value;
					break;
			}
		}

		// set public methods
		$scope.resetUser = resetUser;

		init();
	}]);

}());
