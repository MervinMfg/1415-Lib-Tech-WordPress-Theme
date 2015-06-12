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
		'ngAnimate',
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

	app.controller('BoardFinderController', ['$scope', '$route', '$routeParams', '$location', '$http', '$cookies', 'config', 'snowboards', function BoardFinderController($scope, $route, $routeParams, $location, $http, $cookies, config, snowboards) {
		$scope.$route = $route;
		$scope.$location = $location;
		$scope.$routeParams = $routeParams;
		$scope.config = config;
		$scope.loading = true;

		function init() {
			// snowboard data starts loading automagically by injecting the service into the controller
			// look up currency, if none, keep default USD
			if(typeof $cookies.libtech_currency !== 'undefined') {
				$scope.config.currency = $cookies.libtech_currency;
			}
			// set up preloader display
			$scope.$on('$routeChangeStart', function() {
				TweenMax.from($('.loading'), 0.5, {autoAlpha: 0, y: '40px', ease: 'Back.easeOut', overwrite: true, delay: 1});
			});
			$scope.$on('$routeChangeSuccess', function() {
				TweenMax.to($('.loading'), 0.5, {autoAlpha: 0, y: '40px', ease: 'Back.easeIn', overwrite: true});
			});
			$scope.$on('$routeChangeError', function() {
				TweenMax.to($('.loading'), 0.5, {autoAlpha: 0, y: '40px', ease: 'Back.easeIn', overwrite: true});
			});
		}
		init();
	}]);

	// APP SERVICES
	app.service('config', function Config() {
		var config = this;
		config.currency = "USD";
		config.measurement = "imperial"; // or metric
	});

	app.service('snowboards', function Snowboards($http, $q) {
		var deferred = $q.defer();
		$http({
			method: 'GET',
			url: '/feeds/snowboard-finder/'
		}).success(function(data) {
			deferred.resolve(data);
		}).error(function() {
			deferred.reject('There was an error loading snowboards data!');
		});
		return deferred.promise;
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
