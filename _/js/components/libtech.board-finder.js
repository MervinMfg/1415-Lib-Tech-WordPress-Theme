/**
 * 1415 Lib Tech WordPress Theme - Takeover - http://www.lib-tech.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var LIBTECH = LIBTECH || {};

LIBTECH.BoardFinder = function () {
	this.init();
};
LIBTECH.BoardFinder.prototype = {
	init: function () {
		var self = this;
	}
};

(function(angular) {
	'use strict';
	var app = angular.module('board-finder', ['ngRoute']);
	// angular needs base element because of HTML5 Push State use
	// angular.element(document.getElementsByTagName('head')).append(angular.element('<base href="' + window.location.pathname + '" />'));
	angular.element(document.getElementsByTagName('head')).append(angular.element('<base href="/snowboarding/snowboard-finder/" />'));
	// set main controller
	app.controller('BoardFinderController', function BoardFinderController($scope, $route, $routeParams, $location) {
		$scope.$route = $route;
		$scope.$location = $location;
		$scope.$routeParams = $routeParams;
	});
	// APP CONFIG
	app.config(function($routeProvider, $locationProvider) {
		$routeProvider.when('/', {
			templateUrl: '/wp-content/themes/1415-Lib-Tech-WordPress-Theme/_/views/board-finder/gender.html',
			controller: 'GenderController',
			controllerAs: 'genderCtrl'
		}).when('/size/', {
			templateUrl: '/wp-content/themes/1415-Lib-Tech-WordPress-Theme/_/views/board-finder/size.html',
			controller: 'SizeController',
			controllerAs: 'sizeCtrl'
		}).when('/style/', {
			templateUrl: '/wp-content/themes/1415-Lib-Tech-WordPress-Theme/_/views/board-finder/style.html',
			controller: 'StyleController',
			controllerAs: 'styleCtrl'
		}).when('/results/', {
			templateUrl: '/wp-content/themes/1415-Lib-Tech-WordPress-Theme/_/views/board-finder/results.html',
			controller: 'ResultsController',
			controllerAs: 'resultsCtrl'
		}).when('/why/', {
			templateUrl: '/wp-content/themes/1415-Lib-Tech-WordPress-Theme/_/views/board-finder/why.html',
			controller: 'WhyController',
			controllerAs: 'whyCtrl'
		}).otherwise({
			redirectTo: '/'
		});
		// configure html5 to get links working in jsfiddle
		//$locationProvider.html5Mode(true);
	});
	// APP SERVICE
	app.service('config', function Config() {
		var config = this;
		config.measurement = "imperial"; // or metric
	});
	app.service('user', function User() {
		var user = this;
		user.gender = "Default";
		user.weight = -1;
		user.height = -1;
		user.bootSize = -1;
		user.ability = "Starter";
		user.terrain = "Freeride";
	});
	// STEP 1
	app.controller('GenderController', function GenderController($scope, $routeParams, user) {
		$scope.name = "GenderController";
		$scope.params = $routeParams;
		$scope.user = user;
		$scope.setGender = function(user, newGender) {
			user.gender = newGender;
		};
	});
	// STEP 2
	app.controller('SizeController', function SizeController($scope, $routeParams, $log, config, user) {
		$scope.name = "SizeController";
		$scope.params = $routeParams;
		$scope.config = config;
		$scope.user = user;
		$scope.inputHeight = {
			feet: -1,
			inches: -1,
			cm: -1
		};
		$scope.inputWeight = {
			lbs: -1,
			kg: -1
		};
		$scope.weightImperial = [
			{label: 'Pounds', value: -1}, {label: '40 lbs', value: 40}, {label: '50 lbs', value: 50}, {label: '60 lbs', value: 60},
			{label: '70 lbs', value: 70}, {label: '80 lbs', value: 80}, {label: '90 lbs', value: 90}, {label: '100 lbs', value: 100},
			{label: '110 lbs', value: 110}, {label: '120 lbs', value: 120}, {label: '130 lbs', value: 130}, {label: '140 lbs', value: 140},
			{label: '150 lbs', value: 150}, {label: '160 lbs', value: 160}, {label: '170 lbs', value: 170}, {label: '180 lbs', value: 180},
			{label: '190 lbs', value: 190}, {label: '200 lbs', value: 200}, {label: '210 lbs', value: 210}, {label: '220 lbs', value: 220},
			{label: '230 lbs', value: 230}, {label: '240 lbs', value: 240}, {label: '250 lbs', value: 250}, {label: '260 lbs', value: 260},
			{label: '260+ lbs', value: 270}
		];
		$scope.weightMetric = [
			{label: 'Kilograms', value: -1}, {label: '20 kg', value: 20}, {label: '25 kg', value: 25}, {label: '30 kg', value: 30},
			{label: '35 kg', value: 35}, {label: '40 kg', value: 40}, {label: '45 kg', value: 45}, {label: '50 kg', value: 50},
			{label: '55 kg', value: 55}, {label: '60 kg', value: 60}, {label: '65 kg', value: 65}, {label: '70 kg', value: 70},
			{label: '75 kg', value: 75}, {label: '80 kg', value: 80}, {label: '85 kg', value: 85}, {label: '90 kg', value: 90},
			{label: '95 kg', value: 95}, {label: '100 kg', value: 100}, {label: '105 kg', value: 105}, {label: '110 kg', value: 110},
			{label: '115 kg', value: 115}, {label: '120 kg', value: 120}, {label: '120+ kg', value: 125}
		];
		$scope.heightFeet = [
			{label: 'Feet', value: -1}, {label: "2'", value: 2}, {label: "3'", value: 3}, {label: "4'", value: 4},
			{label: "5'", value: 5}, {label: "6'", value: 6}, {label: "7'", value: 7}
		];
		$scope.heightInches = [
			{label: 'Inches', value: -1}, {label: '0"', value: 0}, {label: '1"', value: 1}, {label: '2"', value: 2},
			{label: '3"', value: 3}, {label: '4"', value: 4}, {label: '5"', value: 5}, {label: '6"', value: 6},
			{label: '7"', value: 7}, {label: '8"', value: 8}, {label: '9"', value: 9}, {label: '10"', value: 10},
			{label: '11"', value: 11}
		];
		$scope.heightMetric = [
			{label: 'Centimeters', value: -1}, {label: "60 cm", value: 60}, {label: "65 cm", value: 65}, {label: "70 cm", value: 70},
			{label: "75 cm", value: 75}, {label: "80 cm", value: 80}, {label: "85 cm", value: 85}, {label: "90 cm", value: 90},
			{label: "95 cm", value: 95}, {label: "100 cm", value: 100}, {label: "105 cm", value: 105}, {label: "110 cm", value: 110},
			{label: "115 cm", value: 115}, {label: "120 cm", value: 120}, {label: "125 cm", value: 125}, {label: "130 cm", value: 130},
			{label: "135 cm", value: 135}, {label: "140 cm", value: 140}, {label: "145 cm", value: 145}, {label: "150 cm", value: 150},
			{label: "155 cm", value: 155}, {label: "160 cm", value: 160}, {label: "165 cm", value: 165}, {label: "170 cm", value: 170},
			{label: "175 cm", value: 175}, {label: "180 cm", value: 180}, {label: "185 cm", value: 185}, {label: "190 cm", value: 190},
			{label: "195 cm", value: 195}, {label: "200 cm", value: 200}, {label: "205 cm", value: 205}, {label: "210 cm", value: 210},
			{label: "215 cm", value: 215}, {label: "220 cm", value: 220}
		];
		$scope.bootSizes = [
			{label: 'Size', value: -1}, {label: 4, value: 4}, {label: 4.5, value: 4.5}, {label: 5, value: 5},
			{label: 5.5, value: 5.5}, {label: 6, value: 6}, {label: 6.5, value: 6.5}, {label: 7, value: 7},
			{label: 7.5, value: 7.5}, {label: 8, value: 8}, {label: 8.5, value: 8.5}, {label: 9, value: 9},
			{label: 9.5, value: 9.5}, {label: 10, value: 10}, {label: 10.5, value: 10.5}, {label: 11, value: 11},
			{label: 11.5, value: 11.5}, {label: 12, value: 12}, {label: 12.5, value: 12.5}, {label: 13, value: 13},
			{label: 13.5, value: 13.5}, {label: 14, value: 14}, {label: 14.5, value: 14.5}, {label: 15, value: 15}
		];
		// check values on init of controller
		if($scope.user.weight != -1) {
			$scope.inputWeight.lbs = $scope.user.weight;
			$scope.inputWeight.kg = Math.round($scope.user.weight * 0.453592 / 5) * 5;
		}
		if($scope.user.height != -1) {
			$scope.inputHeight.feet = Math.floor($scope.user.height/12);
			$scope.inputHeight.inches = $scope.user.height % 12;
			$scope.inputHeight.cm = Math.round($scope.user.height * 2.54 / 5) * 5;
		}
		function changeWeight() {
			var updatedWeight = -1;
			if ($scope.config.measurement == "imperial") {
				if($scope.inputWeight.lbs != -1) {
					updatedWeight = $scope.inputWeight.lbs; // store in lbs, as is
					$scope.inputWeight.kg = Math.round(updatedWeight * 0.453592 / 5) * 5;
				} else {
					$scope.inputWeight.kg = -1;
				}
			} else {
				if($scope.inputWeight.kg != -1) {
					updatedWeight = Math.round($scope.inputWeight.kg * 2.20462 / 10) * 10; // convert kg to lbs, round to nearest 10 lbs
					$scope.inputWeight.lbs = updatedWeight;
				} else {
					$scope.inputWeight.lbs = -1;
				}
			}
			$scope.user.weight = updatedWeight;
		}
		function changeHeight() {
			var updatedHeight = -1;
			// check measurement
			if ($scope.config.measurement == "imperial") {
				// update height in inches based on fields that are complete
				if($scope.inputHeight.feet != -1 && $scope.inputHeight.inches != -1) {
					updatedHeight = ($scope.inputHeight.feet * 12) + $scope.inputHeight.inches;
				} else if ($scope.inputHeight.feet != -1) {
					updatedHeight = $scope.inputHeight.feet * 12;
				} // do nothing if only inches are set
				if(updatedHeight != -1) {
					$scope.inputHeight.cm = Math.round(updatedHeight * 2.54 / 5) * 5; // convert inches to cm and round to nearest multiple of 5
				} else {
					$scope.inputHeight.cm = -1;
				}
			} else {
				// update height in cm
				if($scope.inputHeight.cm != -1) {
					updatedHeight = Math.round($scope.inputHeight.cm * 0.393701); // convert cm to inches
					// convert inches into values for form fields
					$scope.inputHeight.feet = Math.floor(updatedHeight/12);
					$scope.inputHeight.inches = updatedHeight % 12;
				}
			}
			$scope.user.height = updatedHeight;
		}
		// make methods public
		$scope.changeWeight = changeWeight;
		$scope.changeHeight = changeHeight;
	});
	// STEP 3
	app.controller('StyleController', function StepThreeController($scope, $routeParams) {
		$scope.name = "StyleController";
		$scope.params = $routeParams;
	});
	// RESULTS
	app.controller('ResultsController', function ResultsController($scope, $routeParams) {
		$scope.name = "ResultsController";
		$scope.params = $routeParams;

		// BOOT SIZES
		// OUR MODIFIED CHART
		// 0 to 7.5 - 23.5 to 24.5
		// 7.5 to 10 – 24.5 to 25.5
		// 10 to 11.5 – 25.5 to 26
		// 11.5+ – 26+
	});
	// WHY
	app.controller('WhyController', function WhyController($scope, $routeParams) {
		$scope.name = "WhyController";
		$scope.params = $routeParams;
	});

	/*// use service to load json $http, $log, $filter
	app.controller('BoardFinderCtrl', ['$http', '$log', function($http, $log){
		var finder = this;
		finder.snowboards = [];
		$http.get('_/json/snowboards.json').success(function(data){
			store.products = data;
		});
	}]);*/
	/*app.controller('PanelController', function() {
		this.tab = 1;
		this.selectTab = function(setTab) {
			this.tab = setTab;
		};
		this.isSelected = function(checkTab) {
			return this.tab === checkTab;
		};
	});*/
})(window.angular);