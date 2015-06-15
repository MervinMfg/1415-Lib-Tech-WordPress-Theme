/**
 * 1415 Lib Tech WordPress Theme - Snowboard Finder - http://www.lib-tech.com
 * Authors: brian.behrens@mervin.com & tony.keller@mervin.com - http://www.mervin.com
 */

(function() {
	'use strict';

	var app = angular.module('boardFinder.gender', ['ngRoute', 'boardFinder.user', 'boardFinder.preloadImage']);

	app.config(['$routeProvider', function($routeProvider) {
		$routeProvider.when('/', {
			templateUrl: '/wp-content/themes/1415-Lib-Tech-WordPress-Theme/_/apps/snowboard-finder/gender/gender.html',
			controller: 'GenderController',
			controllerAs: 'genderCtrl',
			resolve: {
				preloadImage: ['preloadImage', function(preloadImage){
          return preloadImage.loadImage('/wp-content/themes/1415-Lib-Tech-WordPress-Theme/_/img/board-finder/bf-step-1-kraftsman.png');
	      }]
			}
		});
	}]);

	app.controller('GenderController', ['$scope', '$routeParams', 'user', function ($scope, $routeParams, user) {
		$scope.name = "GenderController";
		$scope.params = $routeParams;
		$scope.user = user;
		$scope.showQuote = false;
		$scope.quote = "";

		function init() {
			//
		}

		function updateQuote(section) {
			switch(section) {
				case 'Male':
					$scope.quote = "The geometries of the men and women are different. Your gender helps to determine the perfect construction for your dream board.";
					break;
				case 'Female':
					$scope.quote = "No need to settle, we make women's specific boards.";
					break;
			}
		}

		// set public methods
		$scope.updateQuote = updateQuote;

		init();
	}]);
})();
