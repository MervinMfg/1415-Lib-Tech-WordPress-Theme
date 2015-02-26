/**
 * 1415 Lib Tech WordPress Theme - Snowboard Finder - http://www.lib-tech.com
 * Authors: brian.behrens@mervin.com & tony.keller@mervin.com - http://www.mervin.com
 */

(function() {
	'use strict';

	var app = angular.module('boardFinder.why', ['ngRoute']);

	app.config(['$routeProvider', function($routeProvider) {
		$routeProvider.when('/why/', {
			templateUrl: '/wp-content/themes/1415-Lib-Tech-WordPress-Theme/_/apps/snowboard-finder/why/why.html',
			controller: 'WhyController',
			controllerAs: 'whyCtrl'
		});
	}]);

	app.controller('WhyController', ['$scope', '$routeParams', function WhyController($scope, $routeParams) {
		$scope.name = "WhyController";
		$scope.params = $routeParams;
	}]);
}());