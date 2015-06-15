/**
 * 1415 Lib Tech WordPress Theme - Snowboard Finder - http://www.lib-tech.com
 * Authors: brian.behrens@mervin.com & tony.keller@mervin.com - http://www.mervin.com
 */

(function() {
	'use strict';

	var app = angular.module('boardFinder.preloadImage', []);

	app.service('preloadImage', function PreloadImage($q) {
		this.loadImage = function(url, successCallback, errorCallback) {
			var deferred = $q.defer();
			angular.element(new Image()).bind('load', function(){
				deferred.resolve('Load complete');
			}).bind('error', function(){
				deferred.reject('Error loading the image');
			}).attr('src', url);
			return deferred.promise;
		};
	});
})();
