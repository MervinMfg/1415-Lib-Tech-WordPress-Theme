/**
 * 1415 Lib Tech WordPress Theme - Snowboard Finder - http://www.lib-tech.com
 * Authors: brian.behrens@mervin.com & tony.keller@mervin.com - http://www.mervin.com
 */

(function() {
	'use strict';

	var app = angular.module('boardFinder.user', ['ngCookies']);

	app.provider('user', function User() {
		var _cookie = 'libtech_bf_user';
		var _gender = 'Default'; // updated in gender step
		var _weight = -1; // updated in size step
		var _height = -1; // updated in size step
		var _bootSize = -1; // updated in size step
		var _ability = 'Default'; // updated in style step
		var _terrain = 'Default'; // updated in style step
		var _flex = 'Default'; // updated in results step
		var _contours = []; // updated in results section
		var _bmi = 22; // average bmi, updated in results section
		var _lengthRange = ''; // updated in results

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

		this.$get = ['$cookies', function($cookies) {
			return {
				gender: function(value) {
					if(arguments.length) {
						_gender = value;
						this.updateCookie();
					} else {
						return _gender;
					}
				},
				weight: function(value) {
					if(arguments.length) {
						_weight = value;
						this.updateCookie();
					} else {
						return _weight;
					}
				},
				height: function(value) {
					if(arguments.length) {
						_height = value;
						this.updateCookie();
					} else {
						return _height;
					}
				},
				bootSize: function(value) {
					if(arguments.length) {
						_bootSize = value;
						this.updateCookie();
					} else {
						return _bootSize;
					}
				},
				ability: function(value) {
					if(arguments.length) {
						_ability = value;
						this.updateCookie();
					} else {
						return _ability;
					}
				},
				terrain: function(value) {
					if(arguments.length) {
						_terrain = value;
						this.updateCookie();
					} else {
						return _terrain;
					}
				},
				flex: function(value) {
					if(arguments.length) {
						_flex = value;
						this.updateCookie();
					} else {
						return _flex;
					}
				},
				contours: function(value) {
					if(arguments.length) {
						_contours = value;
						this.updateCookie();
					} else {
						return _contours;
					}
				},
				bmi: function(value) {
					if(arguments.length) {
						_bmi = value;
						this.updateCookie();
					} else {
						return _bmi;
					}
				},
				lengthRange: function(value) {
					if(arguments.length) {
						_lengthRange = value;
						this.updateCookie();
					} else {
						return _lengthRange;
					}
				},
				checkCookie: function() {
					if(typeof $cookies.get('libtech_bf_user') !== 'undefined') {
						var user = $cookies.getObject('libtech_bf_user');
						_gender = user.gender;
						_weight = user.weight;
						_height = user.height;
						_bootSize = user.bootSize;
						_ability = user.ability;
						_terrain = user.terrain;
						_flex = user.flex;
						_contours = user.contours;
						_bmi = user.bmi;
						_lengthRange = user.lengthRange;
					}
				},
				updateCookie: function() {
					var user = {};
					user.gender = _gender;
					user.weight = _weight;
					user.height = _height;
					user.bootSize = _bootSize;
					user.ability = _ability;
					user.terrain = _terrain;
					user.flex = _flex;
					user.contours = _contours;
					user.bmi = _bmi;
					user.lengthRange = _lengthRange;
					$cookies.putObject('libtech_bf_user', user);
				}
			};
		}];
	});
})();
