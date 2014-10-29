/**
 * 1415 Lib Tech WordPress Theme - Region Selector - http://www.lib-tech.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var LIBTECH = LIBTECH || {};

LIBTECH.RegionSelector = function () {
	this.init();
};
LIBTECH.RegionSelector.prototype = {
	init: function () {
		// check language cookie on load
		var self, lang, regionCookie, takover;
		self = this;
		regionCookie = LIBTECH.main.utilities.cookie.getCookie('libtech_region');
		if (regionCookie !== null || regionCookie !== "") {
			lang = regionCookie;
		}
		if (lang) {
			if (lang === 'ca') {
				$(".country-ca").addClass("selected");
				$("body").removeClass("international");
			} else if (lang === 'int') {
				$("body").addClass("international");
				$(".country-int").addClass("selected");
			} else {
				$(".country-us").addClass("selected");
				$("body").removeClass("international");
			}
			takeover = new LIBTECH.Takeover();
		} else {
			if (navigator.cookieEnabled === true) {
				// if no region cookie has been set, open selector if on product page
				if ($('body').hasClass('page-template-page-templatespage-snowboard-builder-php') || $('body').hasClass('page-template-page-templatespage-snowboard-builder-share-php') || $('body').hasClass('page-template-page-templatespage-shopping-cart-php') || $('body').hasClass('page-template-page-templatesoverview-products-php') || $('body').hasClass('single-libtech_snowboards') || $('body').hasClass('single-libtech_nas') || $('body').hasClass('single-libtech_surfboards') || $('body').hasClass('single-libtech_skateboards') || $('body').hasClass('single-libtech_apparel') || $('body').hasClass('single-libtech_accessories') || $('body').hasClass('single-libtech_luggage') || $('body').hasClass('single-libtech_outerwear')) {
					self.overlayInit();
					takeover = new LIBTECH.Takeover(false);
				} else {
					takeover = new LIBTECH.Takeover();
				}
				// pick us by default, but don't set cookie
				$(".country-us").addClass("selected");
			} else {
				// cookies are disabled
				$(".country-us").addClass("selected");
				takeover = new LIBTECH.Takeover();
			}
		}
		// add click events
		$(".region-selector").click(function (e) {
			e.preventDefault();
			e.stopPropagation(); // kill even from firing further
			if (navigator.cookieEnabled === false) {
				alert('Enable cookies in your browser in order to select your region.');
			} else {
				self.overlayInit();
			}
		});
	},
	overlayInit: function () {
		var self = this;
		$('#region-selector').toggleClass('visible');
		// add click events
		$("#region-selector .us").click(function (e) {
			e.preventDefault();
			LIBTECH.main.utilities.cookie.setCookie('libtech_region', 'us', 60);
			window.location.reload();
		});
		$("#region-selector .ca").click(function (e) {
			e.preventDefault();
			LIBTECH.main.utilities.cookie.setCookie('libtech_region', 'ca', 60);
			window.location.reload();
		});
		$("#region-selector .int").click(function (e) {
			e.preventDefault();
			LIBTECH.main.utilities.cookie.setCookie('libtech_region', 'int', 60);
			window.location.reload();
		});
		// listen for escape key
		$(document).keyup(function (e) {
			if (e.keyCode == 27) {
				$('#region-selector').toggleClass('visible');
				// kill event listeners
				$(document).unbind('keyup');
				$(document).unbind('click');
				$('#region-selector .choose-region ul li').unbind('click');
			}
		});
		// don't hide if clicked within region selector
		$('#region-selector .choose-region ul li').click(function (e) {
			e.stopPropagation();
		});
		// hide if clicked anywhere outside region selector
		$(document).click(function () {
			$('#region-selector').toggleClass('visible');
			// kill event listeners
			$(document).unbind('keyup');
			$(document).unbind('click');
			$('#region-selector .choose-region ul li').unbind('click');
		});
	},
	overlayUninit: function () {
		var self = this;
		$('#region-selector').toggleClass('hide');
		$('#main').toggleClass('hide');
		// kill event listeners
		$("#region-selector .location-group .location-list a").off('click.region');
		$(document).off('keyup.region').off('click.region');
		$('#region-selector .choose-region').off('click.region');
		$('#region-selector .btn-close').off('click.region');
	}
};
