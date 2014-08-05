/**
 * 1415 Lib Tech WordPress Theme - Takeover - http://www.lib-tech.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var LIBTECH = LIBTECH || {};

LIBTECH.Takeover = function (showTakeover) {
	this.init(showTakeover);
};
LIBTECH.Takeover.prototype = {
	init: function (showTakeover) {
		var self = this;
		if (typeof (showTakeover) === 'undefined') showTakeover = true;

		// make sure we're not on an international page, we don't show it there
		//if ($('body').hasClass('international') === false) {};
			
		// on click of takeover, check expansion / contraction
		$('.takeover').on('click.takeover', function (e) {
			if ($('.takeover .takeover-content .contracted').hasClass('hide')) {
				self.hide();
			} else {
				self.show();
			}
		});
		// check if we should diplay the takeover or not based on cookies
		if (navigator.cookieEnabled !== false && showTakeover === true) {
			var takeoverCookie = LIBTECH.main.utilities.cookie.getCookie('libtech_takeover');
			if (takeoverCookie !== 'ExtensionRamp4') {
				LIBTECH.main.utilities.cookie.setCookie('libtech_takeover', 'ExtensionRamp4', 7);
				setTimeout(function () {
					self.show();
				}, 2000);
			}
		}
	},
	show: function () {
		var contracted, expanded;
		contracted = $('.takeover .takeover-content .contracted');
		expanded = $('.takeover .takeover-content .expanded');
		$('.takeover').height(contracted.height());
		$('.takeover').animate({
			height: expanded.height()
		}, 500, function () {
			$('.takeover').height('auto');
		});
		contracted.toggleClass('hide');
		expanded.toggleClass('show');
	},
	hide: function () {
		var contracted, expanded;
		contracted = $('.takeover .takeover-content .contracted');
		expanded = $('.takeover .takeover-content .expanded');
		$('.takeover').height(expanded.height());
		$('.takeover').animate({
			height: contracted.height()
		}, 500, function () {
			$('.takeover').height('auto');
		});
		contracted.toggleClass('hide');
		expanded.toggleClass('show');
	}
}
