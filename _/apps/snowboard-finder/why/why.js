/**
 * 1415 Lib Tech WordPress Theme - Snowboard Finder - http://www.lib-tech.com
 * Authors: brian.behrens@mervin.com & tony.keller@mervin.com - http://www.mervin.com
 */

(function() {
	'use strict';

	var app = angular.module('boardFinder.why', ['ngRoute', 'ngAnimate', 'boardFinder.contour']);

	app.config(['$routeProvider', function($routeProvider) {
		$routeProvider.when('/why/', {
			templateUrl: '/wp-content/themes/1415-Lib-Tech-WordPress-Theme/_/apps/snowboard-finder/why/why.html',
			controller: 'WhyController',
			controllerAs: 'whyCtrl'
		});
	}]);

	app.controller('WhyController', ['$scope', '$routeParams', '$animate', 'config', 'user', function WhyController($scope, $routeParams, $animate, config, user) {
		$scope.name = "WhyController";
		$scope.params = $routeParams;
		$scope.currentSection = "Length";
		$scope.config = config;
		$scope.user = user;
		$scope.feet = 0;
		$scope.inches = 0;
		$animate.enabled($('.bf-step-5'), false); // disable ngAnimate inside this step

		function init() {
			// set
			if($scope.user.weight != -1) {
				$scope.lbs = Math.round($scope.user.weight * 2.20462 / 10) * 10; // convert kg to lbs, round to nearest 10 lbs
			}
			// set imperial measurements
			if($scope.user.height != -1) {
				$scope.feet = Math.floor($scope.user.height/30.48);
				$scope.inches = Math.round(($scope.user.height/2.54) % 12);
			}
		}

		function checkContour($contour) {
			for(var i=0; i < $scope.user.contours.length; i++){
				if($scope.user.contours[i] === $contour){
					return true;
				}
			}
			return false;
		}

		// set public methods
		$scope.checkContour = checkContour;

		init();
	}]);
}());
