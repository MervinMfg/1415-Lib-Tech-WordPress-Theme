/**
 * 1415 Lib Tech WordPress Theme - Snowboard Finder - http://www.lib-tech.com
 * Authors: brian.behrens@mervin.com & tony.keller@mervin.com - http://www.mervin.com
 */

(function() {
	'use strict';

	var app = angular.module('boardFinder.user', []);

	app.provider('user', function User() {
		var _gender = "Default"; // updated in gender step
		var _weight = -1; // updated in size step
		var _height = -1; // updated in size step
		var _bootSize = -1; // updated in size step
		var _ability = "Default"; // updated in style step
		var _terrain = "Default"; // updated in style step
		var _flex = "Default"; // updated in results step
		var _contours = []; // updated in results section
		var _bmi = 22; // average bmi, updated in results section
		var _lengthRange = ""; // updated in results

		this.checkGender = function() {
			if(_gender == "Default") {
				return false;
			} else {
				return true;
			}
		};

		this.checkSize = function() {
			if(_weight == -1 || typeof _weight == 'undefined' || _height == -1 || typeof _height == 'undefined' || _bootSize == -1 || typeof _bootSize == 'undefined') {
				return false;
			} else {
				return true;
			}
		};

		this.checkStyle = function() {
			if(_ability == "Default" || _terrain == "Default") {
				return false;
			} else {
				return true;
			}
		};

		this.$get = function() {
			return {
				gender: function(value) {
					return arguments.length ? (_gender = value) : _gender;
				},
				weight: function(value) {
					return arguments.length ? (_weight = value) : _weight;
				},
				height: function(value) {
					return arguments.length ? (_height = value) : _height;
				},
				bootSize: function(value) {
					return arguments.length ? (_bootSize = value) : _bootSize;
				},
				ability: function(value) {
					return arguments.length ? (_ability = value) : _ability;
				},
				terrain: function(value) {
					return arguments.length ? (_terrain = value) : _terrain;
				},
				flex: function(value) {
					return arguments.length ? (_flex = value) : _flex;
				},
				contours: function(value) {
					return arguments.length ? (_contours = value) : _contours;
				},
				bmi: function(value) {
					return arguments.length ? (_bmi = value) : _bmi;
				},
				lengthRange: function(value) {
					return arguments.length ? (_lengthRange = value) : _lengthRange;
				}
			};
		};
	});
})();
