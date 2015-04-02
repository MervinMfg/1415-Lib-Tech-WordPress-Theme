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

	app.controller('ResultsController', ['$scope', '$routeParams', '$log', '$filter', '$compile', 'config', 'user', function ResultsController($scope, $routeParams, $log, $filter, $compile, config, user) {
		$scope.name = "ResultsController";
		$scope.params = $routeParams;
		$scope.config = config;
		$scope.user = user;
		$scope.productFilters = [
			{
				title: "Ability",
				classes: "ability left",
				filters: [
					{ title: "Beginner", value: "Beginner" },
					{ title: "Intermediate", value: "Intermediate" },
					{ title: "Advanced", value: "Advanced" }
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
			// do initial build
			var snowboardWatch = $scope.$watch(
				function() { return $scope.config.snowboards; },
				function() {
					if ($scope.config.snowboards.length > 0) {
						buildCarousel();
						snowboardWatch(); // kill this watch, only fire once
						watchUserChange();
					}
				},
				true
			);
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

		function watchUserChange() {
			$scope.$watch(
				function() { return $scope.user; },
				function() {
					buildCarousel();
				},
				true
			);
		}

		function buildCarousel() {
			var owl, owlStage, filteredSnowboards;
			// start setting up carousel
			owl = $('#snowboards');
			owlStage = owl.find('.owl-stage');
			// destroy old carousel if it exists
			if(owlStage.length) {
				owl.trigger('destroy.owl.carousel');
				// remove previous items from DOM
				angular.forEach(angular.element('.product-item'), function(element, key) {
					angular.element(element).remove();
				});
			}
			// filter boards based on custom snowboardFilter
			filteredSnowboards = $filter('snowboardFilter')($scope.config.snowboards, $scope.user);
			// limit to top 6 restuls
			filteredSnowboards = $filter('limitTo')(filteredSnowboards, 6);
			// loop through and render snowboard directive
			angular.forEach(filteredSnowboards, function(value, key) {
				// Insert directive programatically angular
				angular.element('#snowboards').append( $compile("<snowboard data-snowboard='" + angular.toJson(value) + "'></snowboard>")($scope) );
			});
			// build new
			owl.owlCarousel({
				loop: false,
				margin: 10,
				nav: true,
				responsive: {
					0: {
						items:2
					},
					600: {
						items:3
					},
					980: {
						items:4
					}
				}
			});
		}

		// set public methods
		$scope.resetUser = resetUser;

		init();
	}]);
}());
