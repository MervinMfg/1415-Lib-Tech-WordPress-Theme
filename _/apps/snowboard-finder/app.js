/**
 * 1415 Lib Tech WordPress Theme - Snowboard Finder - http://www.lib-tech.com
 * Authors: brian.behrens@mervin.com & tony.keller@mervin.com - http://www.mervin.com
 */

(function() {
	'use strict';

	// angular needs base element because of HTML5 Push State use
	//angular.element(document.getElementsByTagName('head')).append(angular.element('<base href="/snowboarding/snowboard-finder/" />'));

	var app = angular.module('boardFinder', [
		'ngRoute',
		'ngCookies',
		'boardFinder.gender',
		'boardFinder.size',
		'boardFinder.style',
		'boardFinder.results',
		'boardFinder.why'
	]);

	app.config(['$routeProvider', '$locationProvider', function($routeProvider, $locationProvider) {
		$routeProvider.otherwise({
			redirectTo: '/'
		});
		// configure html5 to get links working in jsfiddle
		//$locationProvider.html5Mode(true);
	}]);

	app.controller('BoardFinderController', ['$scope', '$route', '$routeParams', '$location', '$http', '$cookies', 'config', function BoardFinderController($scope, $route, $routeParams, $location, $http, $cookies, config) {
		$scope.$route = $route;
		$scope.$location = $location;
		$scope.$routeParams = $routeParams;
		$scope.config = config;

		function init() {
			$http.get('/feeds/snowboard-finder/').success(function(data, status) {
				$scope.status = status;
				$scope.config.snowboards = data;
			}).error(function(data, status) {
				$scope.data = data || "Request failed";
				$scope.status = status;
			});
			// look up currency, if none, keep default USD
			if(typeof $cookies.libtech_currency !== 'undefined') {
				$scope.config.currency = $cookies.libtech_currency;
			}
		}
		init();
	}]);

	// APP SERVICES
	app.service('config', function Config() {
		var config = this;
		config.currency = "USD";
		config.measurement = "imperial"; // or metric
		config.snowboards = [];
	});

	app.service('user', function User() {
		var user = this;
		user.gender = "Default"; // updated in gender step
		user.weight = -1; // updated in size step
		user.height = -1; // updated in size step
		user.bootSize = -1; // updated in size step
		user.ability = "Default"; // updated in style step
		user.terrain = "Default"; // updated in style step
		user.flex = "Default"; // updated in results step
		user.contours = []; // updated in results section
		user.bmi = 22; // average bmi, updated in results section
		user.lengthRange = ""; // updated in results
	});

	// DIRECTIVE TO CHECK FOR REQUIRED SELECT FIELDS
	app.directive('requiredSelect', function() {
		return {
			restrict: 'A',
			require: 'ngModel',
			link: function(scope, elem, attr, ctrl) {
				if (!ctrl) return;
				attr.requiredSelect = true; // force truthy in case we are on non input element=
				var validator = function(value) {
					if (attr.requiredSelect && ctrl.$isEmpty(value) || attr.requiredSelect && value == -1) {
						ctrl.$setValidity('requiredSelect', false);
						return;
					} else {
						ctrl.$setValidity('requiredSelect', true);
						return value;
					}
				};
				ctrl.$formatters.push(validator);
				ctrl.$parsers.unshift(validator);
				attr.$observe('requiredSelect', function() {
					validator(ctrl.$viewValue);
				});
			}
		};
	});
})();
