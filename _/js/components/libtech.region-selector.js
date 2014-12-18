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
		var self, $body, regionCookie, currencyCookie, takover;
		self = this;
		$body = $('body');
		regionCookie = LIBTECH.main.utilities.cookie.getCookie('libtech_region');
		currencyCookie = LIBTECH.main.utilities.cookie.getCookie('libtech_currency');
		// check if cookies are set
		if (regionCookie !== null || currencyCookie !== null) {
			if (currencyCookie !== 'INT') {
				$body.removeClass("international");
			} else {
				$body.addClass("international");
			}
			var currencyClass = "currency-" + currencyCookie;
			$body.addClass(currencyClass.toLowerCase());
			$(".region-selector a").html(regionCookie);
			takeover = new LIBTECH.Takeover();
		} else {
			if (navigator.cookieEnabled === true) {
				// if no region cookie has been set, open selector if on product page
				if ($('body').hasClass('page-template-page-templatessnowboard-builder-php') || $('body').hasClass('page-template-page-templatessnowboard-builder-share-php') || $('body').hasClass('page-template-page-templatespage-shopping-cart-php') || $('body').hasClass('page-template-page-templatesoverview-products-php') || $('body').hasClass('single-libtech_snowboards') || $('body').hasClass('single-libtech_nas') || $('body').hasClass('single-libtech_surfboards') || $('body').hasClass('single-libtech_skateboards') || $('body').hasClass('single-libtech_apparel') || $('body').hasClass('single-libtech_accessories') || $('body').hasClass('single-libtech_luggage') || $('body').hasClass('single-libtech_outerwear')) {
					// Check to make sure IP Address is not Crazy Egg tracking
					$.getJSON( "/feeds/ip/", function( data ) {
						if (data.ip !== "80.74.134.135") {
							// if not crazy egg ip, show region selector
							self.overlayInit();
							takeover = new LIBTECH.Takeover(false);
						}
					}).fail(function() {
						// failed, so show region selector
						self.overlayInit();
						takeover = new LIBTECH.Takeover(false);
					});
				} else {
					takeover = new LIBTECH.Takeover();
				}
				// US picked by default, but don't set cookie
			} else {
				// cookies are disabled, US picked by default
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
		// scroll to top
		LIBTECH.main.utilities.pageScroll('#region-selector', 0.5);
		// add click events
		$("#region-selector .location-group .location-list a").on('click.region', function (e) {
			var selectedCurrency, selectedRegion;
			e.preventDefault();
			selectedCurrency = $(this).attr('data-currency');
			selectedRegion = $(this).html();
			LIBTECH.main.utilities.cookie.setCookie('libtech_currency', selectedCurrency, 60);
			LIBTECH.main.utilities.cookie.setCookie('libtech_region', selectedRegion, 60);
			window.location.reload();
		});
		// listen for escape key
		$(document).on('keyup.region', function (e) {
			if (e.keyCode == 27) {
				self.overlayUninit();				
			}
		});
		// don't hide if clicked within region selector
		$('#region-selector .choose-region').on('click.region', function (e) {
			e.stopPropagation();
		});
		// hide if clicked anywhere outside region selector
		$(document).on('click.region', function () {
			self.overlayUninit();
		});
	},
	overlayUninit: function () {
		var self = this;
		$('#region-selector').toggleClass('visible');
		// kill event listeners
		$(document).off('keyup.region').off('click.region');
		$('#region-selector .choose-region').off('click.region');
		$("#region-selector .location-group .location-list a").off('click.region');
	}
};
