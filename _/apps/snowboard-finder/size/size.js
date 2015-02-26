/**
 * 1415 Lib Tech WordPress Theme - Snowboard Finder - http://www.lib-tech.com
 * Authors: brian.behrens@mervin.com & tony.keller@mervin.com - http://www.mervin.com
 */

(function() {
	'use strict';

	var app = angular.module('boardFinder.size', ['ngRoute']);

	app.config(['$routeProvider', function($routeProvider) {
		$routeProvider.when('/size/', {
			templateUrl: '/wp-content/themes/1415-Lib-Tech-WordPress-Theme/_/apps/snowboard-finder/size/size.html',
			controller: 'SizeController',
			controllerAs: 'sizeCtrl'
		});
	}]);

	app.controller('SizeController', ['$scope', '$location', '$routeParams', '$log', 'config', 'user', function ($scope, $location, $routeParams, $log, config, user) {
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
			{label: '40 lbs', value: 40}, {label: '50 lbs', value: 50}, {label: '60 lbs', value: 60}, {label: '70 lbs', value: 70},
			{label: '80 lbs', value: 80}, {label: '90 lbs', value: 90}, {label: '100 lbs', value: 100}, {label: '110 lbs', value: 110},
			{label: '120 lbs', value: 120}, {label: '130 lbs', value: 130}, {label: '140 lbs', value: 140}, {label: '150 lbs', value: 150},
			{label: '160 lbs', value: 160}, {label: '170 lbs', value: 170}, {label: '180 lbs', value: 180}, {label: '190 lbs', value: 190},
			{label: '200 lbs', value: 200}, {label: '210 lbs', value: 210}, {label: '220 lbs', value: 220}, {label: '230 lbs', value: 230},
			{label: '240 lbs', value: 240}, {label: '250 lbs', value: 250}, {label: '260 lbs', value: 260}, {label: '260+ lbs', value: 270}
		];
		$scope.weightMetric = [
			{label: '20 kg', value: 20}, {label: '25 kg', value: 25}, {label: '30 kg', value: 30}, {label: '35 kg', value: 35},
			{label: '40 kg', value: 40}, {label: '45 kg', value: 45}, {label: '50 kg', value: 50}, {label: '55 kg', value: 55},
			{label: '60 kg', value: 60}, {label: '65 kg', value: 65}, {label: '70 kg', value: 70}, {label: '75 kg', value: 75},
			{label: '80 kg', value: 80}, {label: '85 kg', value: 85}, {label: '90 kg', value: 90}, {label: '95 kg', value: 95},
			{label: '100 kg', value: 100}, {label: '105 kg', value: 105}, {label: '110 kg', value: 110}, {label: '115 kg', value: 115},
			{label: '120 kg', value: 120}, {label: '120+ kg', value: 125}
		];
		$scope.heightFeet = [
			{label: "2'", value: 2}, {label: "3'", value: 3}, {label: "4'", value: 4}, {label: "5'", value: 5},
			{label: "6'", value: 6}, {label: "7'", value: 7}
		];
		$scope.heightInches = [
			{label: '0"', value: 0}, {label: '1"', value: 1}, {label: '2"', value: 2}, {label: '3"', value: 3},
			{label: '4"', value: 4}, {label: '5"', value: 5}, {label: '6"', value: 6}, {label: '7"', value: 7},
			{label: '8"', value: 8}, {label: '9"', value: 9}, {label: '10"', value: 10}, {label: '11"', value: 11}
		];
		$scope.heightMetric = [
			{label: "60 cm", value: 60}, {label: "65 cm", value: 65}, {label: "70 cm", value: 70}, {label: "75 cm", value: 75},
			{label: "80 cm", value: 80}, {label: "85 cm", value: 85}, {label: "90 cm", value: 90}, {label: "95 cm", value: 95},
			{label: "100 cm", value: 100}, {label: "105 cm", value: 105}, {label: "110 cm", value: 110}, {label: "115 cm", value: 115},
			{label: "120 cm", value: 120}, {label: "125 cm", value: 125}, {label: "130 cm", value: 130}, {label: "135 cm", value: 135},
			{label: "140 cm", value: 140}, {label: "145 cm", value: 145}, {label: "150 cm", value: 150}, {label: "155 cm", value: 155},
			{label: "160 cm", value: 160}, {label: "165 cm", value: 165}, {label: "170 cm", value: 170}, {label: "175 cm", value: 175},
			{label: "180 cm", value: 180}, {label: "185 cm", value: 185}, {label: "190 cm", value: 190}, {label: "195 cm", value: 195},
			{label: "200 cm", value: 200}, {label: "205 cm", value: 205}, {label: "210 cm", value: 210}, {label: "215 cm", value: 215},
			{label: "220 cm", value: 220}
		];
		$scope.bootSizes = [
			{label: 4, value: 4}, {label: 4.5, value: 4.5}, {label: 5, value: 5}, {label: 5.5, value: 5.5},
			{label: 6, value: 6}, {label: 6.5, value: 6.5}, {label: 7, value: 7}, {label: 7.5, value: 7.5},
			{label: 8, value: 8}, {label: 8.5, value: 8.5}, {label: 9, value: 9}, {label: 9.5, value: 9.5},
			{label: 10, value: 10}, {label: 10.5, value: 10.5}, {label: 11, value: 11}, {label: 11.5, value: 11.5},
			{label: 12, value: 12}, {label: 12.5, value: 12.5}, {label: 13, value: 13}, {label: 13.5, value: 13.5},
			{label: 14, value: 14}, {label: 14.5, value: 14.5}, {label: 15, value: 15}
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

		function setSize() {
			$location.path( '/style/' );
		}

		// set public methods
		$scope.changeWeight = changeWeight;
		$scope.changeHeight = changeHeight;
		$scope.setSize = setSize;
	}]);
}());