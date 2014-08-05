/**
 * 1415 Lib Tech WordPress Theme - Shop - http://www.lib-tech.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var LIBTECH = LIBTECH || {};

LIBTECH.Shop = function () {
	this.config = {
		shopKeyUS: "rbb5pr37",
		shopKeyCanada: "tqwzzawb",
		shopKeyInternational: "95tuotu0"
	};
	this.init();
};
LIBTECH.Shop.prototype = {
	init: function () {
		var self, lang, regionCookie, shopAPIKey, shopAPIKeyString;
		self = this;
		// check the language on the cookie
		regionCookie = LIBTECH.main.utilities.cookie.getCookie('libtech_region');
		if (regionCookie !== null || regionCookie !== "") {
			lang = regionCookie;
		}
		if (lang) {
			if (lang === 'ca') {
				shopAPIKey = self.config.shopKeyCanada; // CA Key
				// set shopatron footer links for Canada
				$('#link-privacy').attr('href', 'http://libtech-ca.shptron.com/k/privacy');
				$('#link-policies').attr('href', 'http://libtech-ca.shptron.com/k/policies');
				$('#link-login').attr('href', 'http://libtech-ca.shptron.com/account/?mfg_id=4374.5&language_id=1');
				$('#link-safety').attr('href', 'http://libtech-ca.shptron.com/k/security');
				$('#link-returns').attr('href', 'http://libtech-ca.shptron.com/k/policies#Returns');
				$('#link-ordering').attr('href', 'http://libtech-ca.shptron.com/k/ordering');
				// set my account in header for Canada
				$('header .nav-utility .link-account a').attr('href', 'http://libtech-ca.shptron.com/account/?mfg_id=4374.5&language_id=1');
			} else if (lang === 'int') {
				shopAPIKey = self.config.shopKeyInternational; // International key
				// set shopatron footer links for International
				$('#link-privacy').attr('href', 'http://libtech-int.shptron.com/k/privacy');
				$('#link-policies').attr('href', 'http://libtech-int.shptron.com/k/policies');
				$('#link-login').attr('href', 'http://libtech-int.shptron.com/account/?mfg_id=4374.5&language_id=1');
				$('#link-safety').attr('href', 'http://libtech-int.shptron.com/k/security');
				$('#link-returns').attr('href', 'http://libtech-int.shptron.com/k/policies#Returns');
				$('#link-ordering').attr('href', 'http://libtech-int.shptron.com/k/ordering');
				// set my account in header for International
				$('header .nav-utility .link-account a').attr('href', 'http://libtech-int.shptron.com/account/?mfg_id=4374.5&language_id=1');
			} else {
				shopAPIKey = self.config.shopKeyUS; // US Key
			}
		} else {
			shopAPIKey = self.config.shopKeyUS; // US Key
		}
		shopAPIKeyString = '{"apiKey": "' + shopAPIKey + '"}';
		// add key to the body of the page for shopatron's api to grab via ID
		$("body").append('<div id="shopatronCart">' + shopAPIKeyString + '</div>');
		// request the shopatron api
		$.ajax({
			url: "//mediacdn.shopatron.com/media/js/product/shopatronAPI-2.5.0.min.js",
			dataType: "script",
			success: function (data) {
				// request other aditional api for quick cart and shopping cart
				$.ajax({
					url: "//mediacdn.shopatron.com/media/js/product/shopatronJST-2.5.0.min.js",
					dataType: "script",
					success: function (data) {
						// init the shopatron page elements
						self.quickCartInit();
						if ($('body').hasClass('page-template-page-templatespage-shopping-cart-php')) {
							self.shoppingCartInit();
						}
					}
				});
			}
		});
	},
	quickCartInit: function (visible) {
		Shopatron.getCart({
			success: function (data, textStatus) {
				var itemsInCart = 0;
				// find quantity of items in cart
				$.each(data.cartItems, function (key, value) {
					itemsInCart += parseInt(value.quantity, 10);
				});
				$('#quick-cart a span').html(itemsInCart);
			},
		});
	},
	shoppingCartInit: function () {
		var self, lang, regionCookie;
		self = this;

		Shopatron('#shopping-cart').getCart({
			imageWidth: 100,
			imageHeight: 100
		}, {
			success: function (cartData) {},
			error: function () {},
			complete: function () {}
		});
		// check for the region
		regionCookie = LIBTECH.main.utilities.cookie.getCookie('libtech_region');
		if (regionCookie !== null || regionCookie !== "") {
			lang = regionCookie;
		} else {
			lang = 'us';
		}
		// update links on page
		if (lang === 'ca') {
			$("a.link-ordering-info").prop("href", "http://libtech-ca.shptron.com/k/ordering");
			$("a.link-return-policy").prop("href", "http://libtech-ca.shptron.com/k/policies#Returns");
		} else if (lang === 'int') {
			$("a.link-ordering-info").prop("href", "http://libtech-int.shptron.com/k/ordering");
			$("a.link-return-policy").prop("href", "http://libtech-int.shptron.com/k/policies#Returns");
		} else {
			$("a.link-ordering-info").prop("href", "http://checkout.lib-tech.com/k/ordering");
			$("a.link-return-policy").prop("href", "http://checkout.lib-tech.com/k/policies#Returns");
		}
		// region selector trigger
		$('.link-region-selector').click(function (e) {
			e.preventDefault();
			e.stopPropagation(); // kill even from firing further
			if (navigator.cookieEnabled === false) {
				alert('Enable cookies in your browser in order to select your region.');
			} else {
				self.regionSelectorOverlayInit();
			}
		});
	}
};
