/**
 * 1415 Lib Tech WordPress Theme - Snowboard Finder - http://www.lib-tech.com
 * Authors: brian.behrens@mervin.com & tony.keller@mervin.com - http://www.mervin.com
 */

(function() {
	'use strict';

	var app = angular.module('boardFinder.results', ['ngRoute']);

	app.config(['$routeProvider', function($routeProvider) {
		$routeProvider.when('/results/', {
			templateUrl: '/wp-content/themes/1415-Lib-Tech-WordPress-Theme/_/apps/snowboard-finder/results/results.html',
			controller: 'ResultsController',
			controllerAs: 'resultsCtrl'
		});
	}]);

	app.controller('ResultsController', ['$scope', '$routeParams', '$log', 'config', function ResultsController($scope, $routeParams, $log, config) {
		$scope.name = "ResultsController";
		$scope.params = $routeParams;
		$scope.config = config;

		angular.forEach($scope.config.snowboards, function(item, i) {
			/*$log.info(i + " - " + item.title);
			$log.log(item.link, item.slug);
			$log.log(item.meta.libtech_product_price_us, item.meta.libtech_product_price_ca, item.meta.libtech_product_price_eur);
			$log.log("prod image id: " + item.meta.libtech_product_image);
			$log.log("--------------------------------");*/
		});
		// BOOT SIZES
		// OUR MODIFIED CHART
		// 0 to 7.5 - 23.5 to 24.5
		// 7.5 to 10 – 24.5 to 25.5
		// 10 to 11.5 – 25.5 to 26
		// 11.5+ – 26+
	}]);
}());