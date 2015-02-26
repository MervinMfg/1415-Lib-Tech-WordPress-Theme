/**
 * 1415 Lib Tech WordPress Theme - Snowboard Finder - http://www.lib-tech.com
 * Authors: brian.behrens@mervin.com & tony.keller@mervin.com - http://www.mervin.com
 */

(function() {
	'use strict';

	var app = angular.module('boardFinder.gender', ['ngRoute']);

	app.config(['$routeProvider', function($routeProvider) {
		$routeProvider.when('/', {
			templateUrl: '/wp-content/themes/1415-Lib-Tech-WordPress-Theme/_/apps/snowboard-finder/gender/gender.html',
			controller: 'GenderController',
			controllerAs: 'genderCtrl'
		});
	}]);

	app.controller('GenderController', ['$scope', '$routeParams', 'user', function ($scope, $routeParams, user) {
		$scope.name = "GenderController";
		$scope.params = $routeParams;
		$scope.user = user;

		$scope.getGender = function() {
			return $scope.user.gender;
		};

		$scope.setGender = function(newGender) {
			$scope.user.gender = newGender;
		};
	}]);
})();