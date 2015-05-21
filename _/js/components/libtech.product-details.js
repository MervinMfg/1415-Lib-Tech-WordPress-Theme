/**
 * 1415 Lib Tech WordPress Theme - Product Details - http://www.lib-tech.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var LIBTECH = LIBTECH || {};

LIBTECH.ProductDetails = function () {
	this.config = {
		slider: null,
		zoomThumbSlider: null,
		thumbSliderWidth: 100,
		prodNavSlider: null,
		currency: null
	};
	this.init();
};
LIBTECH.ProductDetails.prototype = {
	init: function () {
		var self, thumbSlider, techConstructionSlider;
		self = this;
		// set availability
		self.initAvailability();
		// BEGIN EXECUTING DETAIL CODE
		$(".product-tech-major").fitVids();
		$(".product-video").fitVids();
		// setup main product image slider
		if ($('body').hasClass('single-libtech_nas')) {
			self.config.slider = $('#image-list').bxSlider({
				controls: true,
				pager: false,
				mode: 'fade'
			});
		} else {
			self.config.slider = $('#image-list').bxSlider({
				controls: false,
				mode: 'fade',
				pagerCustom: '#image-list-thumbs'
			});
		}
		$(window).load(function () {
			// init product navigation at top of page
			self.initProductNav();
			// init image sliders
			if (typeof self.config.slider !== 'undefined') {
				if (self.config.slider.length > 0) self.config.slider.reloadSlider();
			}
			if (typeof thumbSlider !== 'undefined') {
				if (thumbSlider.length > 0) thumbSlider.reloadSlider();
			}
			if (typeof techConstructionSlider !== 'undefined') {
				if (techConstructionSlider.length > 0) techConstructionSlider.reloadSlider();
			}
		});
		// navigation when displayed below 600px (mobile phone)
		$('.product-extras .product-mobile-nav ul li a').click(function (e) {
			e.preventDefault();
			// update extras, video and gallery display
			$('.product-extras, .product-video-top, .product-video, .product-gallery-top, .product-gallery').removeClass('info specs tech');
			$('.product-extras, .product-video-top, .product-video, .product-gallery-top, .product-gallery').addClass($(this).attr('id'));
			// update nav item state
			$('.product-extras .product-mobile-nav ul li a').each(function () {
				$(this).removeClass('selected');
			});
			$(this).addClass('selected');
			// reload slider to fix responsive bug when visible
			if ($('body').hasClass('single-libtech_skateboards') && $(this).attr('id') == 'tech') {
				techConstructionSlider.reloadSlider();
			}
		});
		// init gallery if it exists
		if ($('.gallery')) {
			new LIBTECH.Gallery();
		}
		// check for browser resize and see if desktop zoom should occur
		$(window).on('resize.productZoom', function () {
			if (LIBTECH.main.utilities.responsiveCheck() != 'base') { // if not mobile, trigger zoom on click
				// zoom listener
				$('.product-images #image-list li a').on('click.productZoom', function (e) {
					e.preventDefault();
					// do not zoom nas
					if (!$('body').hasClass('single-libtech_nas')) {
						self.initZoom($(this).parent().index());
					}
				});
				// surf zoom listener
				$('.product-images .surfboard-top, .product-images .surfboard-side, .product-images .surfboard-bottom').on('click.productZoom', function (e) {
					e.preventDefault();
					// determine active graphic option
					var zoomIndex = $('#image-list-thumbs li a.active').parent().index();
					if(zoomIndex < 0) {zoomIndex = 0;} // if it's still default
					self.initZoom(zoomIndex);
				});
			} else { // if mobile, do not zoom on click
				$('.product-images #image-list li a').off('click.productZoom');
			}
		});
		$(window).resize(); // trigger resize to init features
		// grab view all specs link and turn into lightbox
		$('.product-specs a.view-all-specs, .product-quick-specs a.specs-link').magnificPopup({
			type: 'iframe',
			disableOn: '768',
			closeOnBgClick: false
		});
		// grab sizing chart link on outerwear
		$('.product-quick-specs a.sizing-chart-link').on('click', function (e) {
			e.preventDefault();
			var url = $(this).attr('href');
			LIBTECH.main.utilities.pageScroll(url, 0.5);
		});
		// CHECK WHICH PRODUCT WE'RE ON AND RUN THE CORRECT CODE
		if ($('body').hasClass('single-libtech_surfboards')) {
			self.initBuySurf();
		} else if ($('body').hasClass('single-libtech_outerwear') || $('body').hasClass('single-libtech_accessories') || $('body').hasClass('single-libtech_apparel')) {
			self.initBuyWithTwoVariations();
		} else {
			self.initBuyWithOneVariation();
		}
		// set up thumbnail slider
		if ($('body').hasClass('single-libtech_surfboards')) { self.config.thumbSliderWidth = 45; }
		thumbSlider = $('#image-list-thumbs').bxSlider({
			slideWidth: self.config.thumbSliderWidth,
			minSlides: 2,
			maxSlides: 8,
			slideMargin: 10,
			controls: true,
			pager: false,
			mode: 'horizontal',
			moveSlides: 2,
			infiniteLoop: false,
			hideControlOnEnd: true
		});
		// setup skate tech slider
		techConstructionSlider = $('.product-tech-construction ul').bxSlider({
			video: true,
			useCSS: false,
			auto: true,
			autoHover: true,
			speed: 500,
			controls: true,
			pager: false,
			mode: 'horizontal'
		});
	},
	initAvailability: function () {
		var self, currencyCookie;
		self = this;
		currencyCookie = LIBTECH.main.utilities.cookie.getCookie('libtech_currency');
		if (currencyCookie !== null || currencyCookie !== "") {
			self.config.currency = currencyCookie;
		} else {
			self.config.currency = "USD";
		}
		if (self.config.currency) {
			if (self.config.currency === 'CAD') {
				if ($('.product-buy').data('avail-ca') == "Yes") {
					$('.product-details').addClass('available');
				}
			} else if (self.config.currency === 'EUR') {
				if ($('.product-buy').data('avail-eur') == "Yes") {
					$(".product-details").addClass('available');
				}
			} else {
				if ($('.product-buy').data('avail-us') == "Yes") {
					$(".product-details").addClass('available');
				}
			}
		}
	},
	initProductNav: function () {
		var self, navState, $prodNav, $prodNavContent, $navLink, prodNavHeight, imageWidth, closedMargin, openedMargin;
		self = this;
		navState = "closed";
		$prodNav = $('.product-details-nav');
		$prodNavContent = $('.product-details-nav .section-content');
		$navLink = $('.product-details-nav-btn');
		// reset prod nav content position
		$prodNavContent.removeAttr('style');
		$navLink.find('.toggle-btn').removeClass('expanded');
		// remove resize listener
		$(window).off('resize.productNav');
		// show nav if we're tablet+
		$prodNav.addClass('active');
		// remove super banana if we're not in US
		if (self.config.currency !== 'USD') {
			$('.product-details-nav .product-listing .superbanana').remove();
		}
		if(LIBTECH.main.utilities.responsiveCheck() == 'base' || LIBTECH.main.utilities.responsiveCheck() == 'small') {
			// destroy slider if it exists
			if (self.config.prodNavSlider) {
				self.config.prodNavSlider.uninit();
				self.config.prodNavSlider = null;
			}
		} else if(!self.config.prodNavSlider) {
			// setup product slider
			self.config.prodNavSlider = new LIBTECH.ProductSlider(false, false);
			updateSlider();
		} else {
			updateSlider();
		}

		function updateSlider() {
			prodNavHeight = $prodNavContent.outerHeight();
			closedMargin = (prodNavHeight - 80) * -1;
			openedMargin = 60;
			// show prod nav in closed state
			TweenMax.to($prodNavContent, 0.3, {marginTop: closedMargin});
			// toggle prod nav on click
			$navLink.off('mousedown.productNav');
			$navLink.on('mousedown.productNav', function() {
				if (navState == "opened") {
					TweenMax.to($prodNavContent, 0.3, {marginTop: closedMargin});
					navState = "closed";
					$(this).find('.toggle-btn').removeClass('expanded');
				} else {
					TweenMax.to($prodNavContent, 0.3, {marginTop: openedMargin});
					navState = "opened";
					$(this).find('.toggle-btn').addClass('expanded');
				}
			});
		}
		$(window).on('resize.productNav', function () {
			self.initProductNav();
		});
	},
	// ADD TO CART COMPLETION METHODS
	addToCartSuccess: function () {
		$('.product-buy .cart-success').removeClass('hidden');
		$('.product-buy .cart-failure').addClass('hidden');
		// update quickcart
		LIBTECH.main.config.shop.quickCartInit();
	},
	addToCartError: function () {
		$('.product-buy .cart-failure').removeClass('hidden');
		$('.product-buy .cart-success').addClass('hidden');
	},
	addToCartComplete: function () {
		$('.product-buy ul li.loading').addClass('hidden');
		$('.product-buy ul li.cart-button').removeClass('hidden');
	},
	// PRODUCT ZOOM METHODS
	// add product image zoom features
	initZoom: function (clickIndex) {
		var self = this;
		$('.product-zoom').addClass('show');
		$('.product-details').addClass('hide');
		// add close event
		$('.product-zoom .zoom-close').on('click.productZoom', function (e) {
			e.preventDefault();
			self.uninitZoom();
		});
		// get thumbnail images from page
		var thumbnailList = $('#image-list-thumbs').html();
		$('#zoom-thumbnails').html(thumbnailList);
		// reset style and classes on thumbnails
		$('#zoom-thumbnails li').attr('style', '');
		$('#zoom-thumbnails li a').attr('class', '');
		// determine if there is only 1 thumbnail, if so hide
		if ($('#image-list-thumbs li').length == 1) {
			$('#zoom-thumbnails').addClass('hidden');
		}
		// if surfboard, init slider for thumbnails
		if ($('body').hasClass('single-libtech_surfboards')) {
			self.config.zoomThumbSlider = $('#zoom-thumbnails').bxSlider({
				slideWidth: self.config.thumbSliderWidth,
				minSlides: 2,
				maxSlides: 20,
				slideMargin: 10,
				controls: true,
				pager: false,
				mode: 'horizontal',
				moveSlides: 2,
				infiniteLoop: false,
				hideControlOnEnd: true
			});
		}
		// listen for clicks on thumbnails to load proper image
		$('#zoom-thumbnails li a').on('click.productZoom', function (e) {
			e.preventDefault();
			var zoomTitle, zoomAlt, zoomSubAlt;
			// change source of zoom image
			if ($('body').hasClass('single-libtech_surfboards')) {
				// if we're on surf, do it differently
				$('.product-zoom .zoom-image img.surfboard-top').attr('src', $(this).attr('href'));
				//$('.product-zoom .zoom-image img.surfboard-top').attr('src', $('.product-images .surfboard-top img').attr('data-img-full'));
				$('.product-zoom .zoom-image img.surfboard-side').attr('src', $('.product-images .surfboard-side img').attr('data-img-full'));
				$('.product-zoom .zoom-image img.surfboard-bottom').attr('src', $('.product-images .surfboard-bottom img').attr('data-img-full'));
				// use name to determine input selection
				var selector = "#product-variation-graphic option[value='" + $(this).find('img').attr('data-sub-alt') + "']";
				$(selector).prop('selected', true);
				$('#product-variation-graphic').change();
			} else {
				$('.product-zoom .zoom-image img').attr('src', $(this).attr('href'));
			}
			// remove active class from all and add to selected
			$('#zoom-thumbnails li a').removeClass('active');
			$(this).addClass('active');
			// update title above product
			zoomTitle = "";
			zoomAlt = $(this).children('img').attr('alt');
			zoomSubAlt = $(this).children('img').attr('data-sub-alt');
			if (zoomSubAlt === "" || zoomSubAlt === undefined) {
				zoomTitle = "<div class=\"h2\">" + zoomAlt + "</div>";
			} else {
				zoomTitle = "<div class=\"h2\">" + zoomAlt + "</div>" + "<div class=\"h5\">" + zoomSubAlt + "</div>";
			}
			$('.product-zoom .zoom-title').html(zoomTitle);
		});
		// trigger click of correct indexed image
		$('#zoom-thumbnails li a:eq(' + clickIndex + ')').click();
	},
	// remove product image zoom features
	uninitZoom: function () {
		var self, activeThumbnail;
		self = this;
		// kill listeners
		$('.product-zoom .zoom-close').off('click.productZoom');
		$('#zoom-thumbnails li a').off('click.productZoom');
		// swap display
		$('.product-zoom').removeClass('show');
		$('.product-details').removeClass('hide');
		// destroy thumbnail slider if it exists
		if (self.config.zoomThumbSlider) {
			self.config.zoomThumbSlider.destroySlider();
			self.config.zoomThumbSlider = null;
		}
		// grab active thumbnail so we know what to select after slider reset
		activeThumbnail = $('#image-list-thumbs li a.active');
		// reset slider
		if(self.config.slider.length > 0) self.config.slider.reloadSlider();
		// select active color
		activeThumbnail.click();
	},
	initBuyWithOneVariation: function () {
		var self = this;
		// check avail on each size option
		$('#product-variation option').each(function (index) {
			var skuAvail, $this;
			skuAvail = "No";
			$this = $(this);
			// check available options
			switch(self.config.currency) {
				case 'USD':
					skuAvail = $this.data('avail-us');
					break;
				case 'CAD':
					skuAvail = $this.data('avail-ca');
					break;
				case 'EUR':
					skuAvail = $this.data('avail-eur');
					break;
				default:
					// international
					skuAvail = $this.data('avail-us');
			}
			if ($this.val() != "-1") {
				if (($('body').hasClass('single-libtech_snowboards') && self.config.currency === 'USD') || ($('body').hasClass('single-libtech_snowboards') && self.config.currency === 'CAD')) {
					// snowboards in US and CA are not handled direct
					if (skuAvail === "No") {
						$this.prop('disabled', true);
					} else {
						$this.prop('disabled', false);
					}
				} else {
					// everything else is handled direct
					if (skuAvail == "Yes" || skuAvail > 0) {
						$this.prop('disabled', false);
					} else {
						$this.prop('disabled', true);
					}
				}
			}
		});
		// check for luggage and do colorway click if so
		if($('body').hasClass('single-libtech_luggage')){
			// check thumbnails on right
			$('#image-list-thumbs li a').on('click', function (e) {
				e.preventDefault();
				// select this image visually
				$('#image-list-thumbs li a').removeClass('active');
				$(this).addClass('active');
				// use name to determine input selection
				var selector = "#product-variation option[value='" + $(this).attr('data-sku') + "']";
				// make sure option is available, if it is... select it
				if(!$(selector).attr('disabled')) {
					$(selector).prop('selected', true);
					$('#product-variation').change();
				}
			});
		}
		// FUNCTIONALITY FOR PRODUCTS WITH ONLY 1 SELECTION
		$('#product-variation').on('change', function () {
			// display the correct image matching selected option
			var productSKU, productSKUs, productAvail, productThumbs;
			productSKU = $(this).val();
			productSKUs = [];
			if (productSKU != "-1") {
				$('#product-variation').removeClass('alert');
			}
			// check current stock based on currency
			if (self.config.currency == "CAD") {
				productAvail = $(this).find(':selected').data('avail-ca');
			} else if (self.config.currency == "EUR") {
				productAvail = $(this).find(':selected').data('avail-eur');
			} else {
				productAvail = $(this).find(':selected').data('avail-us');
			}
			// reset available alert message
			$('.product-alert').removeClass('no low');
			// check if we're a snowboard with none avail, or if we're a product with low avail
			if ( ($('body').hasClass('single-libtech_snowboards') && productAvail == "0") || ($('body').hasClass('single-libtech_snowboards') && productAvail === "")) {
				$('.product-alert').addClass('no');
			} else if (productAvail < 10) {
				$('.product-alert').addClass('low');
			}
			$(".image-list-thumbs li a").each(function () {
				var skus = $(this).attr('data-sku');
				productSKUs.push([$(this), skus]);
				$(this).removeClass('active');
			});
			for (var i = 0; i < productSKUs.length; i++) {
				var skus = productSKUs[i][1];
				if (skus.indexOf(productSKU) != -1) {
					//productSKUs[i][0].click();
					productSKUs[i][0].addClass('active');
					self.config.slider.goToSlide(i);
					break;
				}
			}
		});
		$('#product-variation').trigger('change');
		// add to cart api btn
		$('a.add-to-cart').click(function (e) {
			e.preventDefault();
			var productSKU;
			// check size selection
			productSKU = $('#product-variation').val();
			if (productSKU === "-1") {
				// add alert to class
				$('#product-variation').addClass('alert');
				return;
			}
			// hide add to cart, show loading while request is made
			$('.product-buy ul li.loading').removeClass('hidden');
			$('.product-buy ul li.cart-button').addClass('hidden');
			// make sure to hide cart messages on each add
			$('.product-buy .cart-success').addClass('hidden');
			$('.product-buy .cart-failure').addClass('hidden');
			// call shopatron's api
			Shopatron.addToCart({
				quantity: '1', // Optional: Defaults to 1 if not set
				partNumber: productSKU // Required: This is the product that will be added to the cart.
			}, {
				// All event handlers are optional
				success: function (data, textStatus) {
					self.addToCartSuccess();
				},
				error: function (textStatus, errorThrown) {
					self.addToCartError();
				},
				complete: function (textStatus) {
					self.addToCartComplete();
				}
			});
		});
	},
	initBuyWithTwoVariations: function () {
		var self = this;
		// check avail on each size option
		$('#product-variation-size option').each(function (index) {
			var size, productAvailable;
			size = $(this).val();
			productAvailable = "No";
			$.each(productArray, function (key, value) {
				if (value.size == size) {
					var skuAvail = "No";
					// check available options
					switch(self.config.currency) {
						case 'USD':
							skuAvail = value.available.us ? value.available.us.amount : "No";
							break;
						case 'CAD':
							skuAvail = value.available.ca ? value.available.ca.amount : "No";
							break;
						case 'EUR':
							skuAvail = value.available.eu ? value.available.eu.amount : "No";
							break;
						default:
							// international
							skuAvail = value.available.us ? value.available.us.amount : "No";
					}
					if (skuAvail == "Yes" || skuAvail > 0) {
						productAvailable = "Yes";
					}
				}
			});
			// enable or disable the option
			if (size != "-1" && productAvailable == "No") {
				$(this).prop('disabled', true);
			}
		});
		// check avail on each color option
		$('#product-variation-color option').each(function (index) {
			var color, productAvailable;
			color = $(this).val();
			productAvailable = "No";
			$.each(productArray, function (key, value) {
				if (value.color == color) {
					var skuAvail = "No";
					// check available options
					switch(self.config.currency) {
						case 'USD':
							skuAvail = value.available.us ? value.available.us.amount : "No";
							break;
						case 'CAD':
							skuAvail = value.available.ca ? value.available.ca.amount : "No";
							break;
						case 'EUR':
							skuAvail = value.available.eu ? value.available.eu.amount : "No";
							break;
						default:
							// international
							skuAvail = value.available.us ? value.available.us.amount : "No";
					}
					if (skuAvail == "Yes" || skuAvail > 0) {
						productAvailable = "Yes";
					}
				}
			});
			// enable or disable the option
			if (color != "-1" && productAvailable == "No") {
				$(this).prop('disabled', true);
			}
		});
		// FOR PRODCUTS WITH MORE THAN 1 VARTIATION SELECTION
		// change color selection when image is clicked
		$('#image-list-thumbs li a').on('click', function (e) {
			e.preventDefault();
			// select this image visually
			$('#image-list-thumbs li a').removeClass('active');
			$(this).addClass('active');
			// use name to determine input selection
			var selector = "#product-variation-color option[value='" + $(this).attr('data-color') + "']";
			// make sure option is available, if it is... select it
			if(!$(selector).attr('disabled')) {
				$(selector).prop('selected', true);
			}
			// if no color is in dropdown corresponding to clicked color, select default
			if ($(selector).length === 0) {
				$("#product-variation-color option[value='-1']").prop('selected', true);
			}
		});
		// select field for size
		$('#product-variation-size').on('change', function () {
			var sizeValue = $(this).val();
			// loop through color optioins and see what's available
			$('#product-variation-color option').each(function (index) {
				var productAvailable, colorValue;
				productAvailable = "No";
				colorValue = $(this).val();
				$.each(productArray, function (key, value) {
					if (value.size == sizeValue && value.color == colorValue) {
						var skuAvail = "No";
						// check available options
						switch(self.config.currency) {
							case 'USD':
								skuAvail = value.available.us ? value.available.us.amount : "No";
								break;
							case 'CAD':
								skuAvail = value.available.ca ? value.available.ca.amount : "No";
								break;
							case 'EUR':
								skuAvail = value.available.eu ? value.available.eu.amount : "No";
								break;
							default:
								// international
								skuAvail = value.available.us ? value.available.us.amount : "No";
						}
						if (skuAvail == "Yes" || skuAvail > 0) {
							productAvailable = "Yes";
						}
					}
				});
				// enable or disable the option
				if (colorValue == "-1" || productAvailable == "Yes") {
					$(this).prop('disabled', false);
				} else {
					$(this).prop('disabled', true);
					// deselect if disabled and already selected
					if ($(this).prop('selected') === true) {
						$(this).prop('selected', false);
					}
				}
			});
			// kill alert color, if it's added
			$('#product-variation-size').removeClass('alert');
			// check avail messaging
			checkProdAvail();
		});
		// select field for color
		$('#product-variation-color').on('change', function () {
			// select the correct image
			var colorValue, colorThumbs;
			colorValue = $(this).val();
			colorThumbs = $('.image-list-thumbs li a[data-color="' + colorValue + '"]');
			if (colorThumbs.length > 0) {
				$(colorThumbs[0]).click();
			}
			// kill alert color, if it's added
			$('#product-variation-color').removeClass('alert');
			// check avail messaging
			checkProdAvail();
		});
		// trigger default change
		$('#product-variation-size').trigger('change');
		$('#product-variation-color').trigger('change');
		function checkProdAvail() {
			var productSize, productColor, productSKU;
			// remove old alerts
			$('.product-alert').removeClass('no low');
			// check size selection
			productSize = $('#product-variation-size').val();
			// check color selection
			productColor = $('#product-variation-color').val();
			// check if either are -1, and return if they are
			if (productSize !== "-1" && productColor !== "-1") {
				// find the SKU in the product array
				productSKU = "";
				$.each(productArray, function (key, value) {
					if (productSize === value.size && productColor === value.color) {
						productSKU = value.sku;
						var skuAvail = "No";
						// check available options
						switch(self.config.currency) {
							case 'USD':
								skuAvail = value.available.us ? value.available.us.amount : "No";
								break;
							case 'CAD':
								skuAvail = value.available.ca ? value.available.ca.amount : "No";
								break;
							case 'EUR':
								skuAvail = value.available.eu ? value.available.eu.amount : "No";
								break;
							default:
								// international
								skuAvail = value.available.us ? value.available.us.amount : "No";
						}
						// check if above 0 but below 10
						if (skuAvail !== "Yes" && skuAvail !== "No" && skuAvail > 0 && skuAvail < 10) {
							$('.product-alert').addClass('low');
						}
						// exit each loop
						return;
					}
				});
			}
		}
		// add to cart api btn
		$('a.add-to-cart').click(function (e) {
			e.preventDefault();
			var productSize, productColor, productSKU;
			// check size selection
			productSize = $('#product-variation-size').val();
			if (productSize === "-1") {
				// add alert to class
				$('#product-variation-size').addClass('alert');
			}
			// check color selection
			productColor = $('#product-variation-color').val();
			if (productColor === "-1") {
				$('#product-variation-color').addClass('alert');
			}
			// check if either are -1, and return if they are
			if (productSize === "-1" || productColor === "-1") {
				return;
			}
			// find the SKU in the product array
			productSKU = "";
			$.each(productArray, function (key, value) {
				if (productSize === value.size && productColor === value.color) {
					productSKU = value.sku;
				}
			});
			if (productSKU === "") {
				$('.product-buy .cart-failure').addClass('visible').removeClass('hidden');
				return;
			}
			// hide add to cart, show loading while request is made
			$('.product-buy ul li.loading').addClass('visible').removeClass('hidden');
			$('.product-buy ul li.cart-button').addClass('hidden').removeClass('visible');
			// call shopatron's api
			Shopatron.addToCart({
				quantity: '1', // Optional: Defaults to 1 if not set
				partNumber: productSKU, // Required: This is the product that will be added to the cart.
				itemOptions: {
					'Color': productColor,
					'Size': productSize
				}
			}, {
				// All event handlers are optional
				success: function (data, textStatus) {
					self.addToCartSuccess();
				},
				error: function (textStatus, errorThrown) {
					self.addToCartError();
				},
				complete: function (textStatus) {
					self.addToCartComplete();
				}
			});
		});
	},
	initBuySurf: function () {
		var self = this;
		// don't allow build and ship in Europe
		if(self.config.currency == 'EUR') {
			$('#product-variation-graphic option').each(function(index) {
				var $option, optionValue, removeOption;
				$option = $(this);
				optionValue = $option.attr('value');
				removeOption = true;
				if(optionValue != "-1") {
					$.each(productArray, function (key, value) {
						if(value.name == optionValue) {
							if(value.available.eu !== null) {
								if(value.available.eu.amount != "No") {
									removeOption = false;
								}
							}
						}
					});
					if(removeOption === true) {
						$option.remove();
						if(optionValue != "Logo") {
							$('#image-list-thumbs img[data-sub-alt="' + optionValue + '"]').parent().parent().remove();
						}
					}
				}
			});
		}
		var updatePrice = function () {
			var selectedGraphic, selectedSize, defaultFinValue;
			selectedGraphic = $('#product-variation-graphic').val();
			selectedSize = $('#product-variation-size').val();
			$('.product-price div').removeClass('active');

			if (selectedGraphic == "Logo" || selectedGraphic == -1) {
				if (selectedSize.indexOf("3 Fin") !== -1) {
					$('.product-price .price-logo').addClass('active');
				} else if (selectedSize.indexOf("5 Fin") !== -1) {
					$('.product-price .price-logo-five').addClass('active');
				} else {
					defaultFinValue = $('#product-variation-size option:eq(1)').val();
					if (defaultFinValue.indexOf("3 Fin") !== -1) {
						$('.product-price .price-logo').addClass('active');
					} else {
						$('.product-price .price-logo-five').addClass('active');
					}
				}
			} else {
				if (selectedSize.indexOf("3 Fin") !== -1) {
					$('.product-price .price-graphic').addClass('active');
				} else if (selectedSize.indexOf("5 Fin") !== -1) {
					$('.product-price .price-graphic-five').addClass('active');
				} else {
					defaultFinValue = $('#product-variation-size option:eq(1)').val();
					if (defaultFinValue.indexOf("3 Fin") !== -1) {
						$('.product-price .price-graphic').addClass('active');
					} else {
						$('.product-price .price-graphic-five').addClass('active');
					}
				}
			}
			// remove active class from availability alerts
			$('.product-stock-alert p').removeClass('active');
			// update logo/graphic disclaimer
			if (selectedGraphic == "Logo") {
				$('.product-stock-alert .surf-logo').addClass('active');
			} else if (selectedGraphic != -1) {
				$('.product-stock-alert .surf-graphic').addClass('active');
			}
			// check avail if product is selected
			if (selectedGraphic != -1 && selectedSize != -1) {
				// with both selections set, check availablity and update messaging display
				$('.product-alert').removeClass('no low');
				$.each(productArray, function (key, value) {
					if (selectedSize === (value.length + ' - ' + value.fins) && selectedGraphic === value.name) {
						var skuAvail = "No";
						// check available options
						switch(self.config.currency) {
							case 'USD':
								skuAvail = value.available.us ? value.available.us.amount : 0;
								break;
							case 'CAD':
								skuAvail = value.available.ca ? value.available.ca.amount : 0;
								break;
							case 'EUR':
								skuAvail = value.available.eu ? value.available.eu.amount : 0;
								break;
							default:
								// international
								skuAvail = value.available.us ? value.available.us.amount : 0;
						}
						if(value.type === "Logo" && skuAvail === 0) {
							// show limited logo option messaging
							$('.product-stock-alert .surf-logo-limited').addClass('active');
						} else if (value.type === "Graphic" && skuAvail === 0) {
							// show limited graphic option messaging
							$('.product-stock-alert .surf-graphic-limited').addClass('active');
						} else if (skuAvail < 10 && skuAvail > 0) {
							$('.product-alert').addClass('low');
						}
						return;
					}
				});
			}
		};
		// check thumbnails on right
		$('#image-list-thumbs li a').on('click', function (e) {
			e.preventDefault();
			// select this image visually
			$('#image-list-thumbs li a').removeClass('active');
			$(this).addClass('active');
			// use name to determine input selection
			var selector = "#product-variation-graphic option[value='" + $(this).find('img').attr('data-sub-alt') + "']";
			$(selector).prop('selected', true);
			$('#product-variation-graphic').change();
		});
		// listen for graphic selection change
		$('#product-variation-graphic').on('change', function () {
			// select the correct image
			var graphicName, topImage, topImageFull;
			graphicName = $(this).val();
			// check to make sure something was selected
			if (graphicName != -1) {
				topImage = $(this).find("option:selected").attr("data-img");
				topImageFull = $(this).find("option:selected").attr("data-img-full");
				// kill alert color
				$(this).removeClass('alert');
				// change top graphic
				$('.product-images .surfboard-top img').attr('src', topImage).attr('data-img', topImage).attr('data-img-full', topImageFull);
				// update image thumbnail selection
				$('#image-list-thumbs li a').removeClass('active');
				var selector = "#image-list-thumbs li a img[data-sub-alt='" + graphicName + "']";
				$(selector).parent().addClass('active');
				// build size options based on graphic selection
				var sizeOptions = '<option value="-1">Select Size &amp; Fin Box</option>';
				var sizeArray = [];
				var selectedSize = $('#product-variation-size').val();
				$.each(productArray, function (key, value) {
					var seriesName, fullName, inArrayCheck, skuAvail, fins;
					seriesName = $('.product-details h1').html();
					fullName = value.length + ' - ' + value.fins;
					// check if size already exists
					inArrayCheck = $.inArray(fullName, sizeArray);
					if (value.name == graphicName && inArrayCheck === -1 || graphicName == -1 && inArrayCheck === -1) {
						skuAvail = "No";
						fins = value.fins;
						// check available options
						switch(self.config.currency) {
							case 'USD':
								skuAvail = value.available.us ? value.available.us.amount : 0;
								break;
							case 'CAD':
								skuAvail = value.available.ca ? value.available.ca.amount : 0;
								break;
							case 'EUR':
								skuAvail = value.available.eu ? value.available.eu.amount : 0;
								break;
							default:
								// international
								skuAvail = value.available.us ? value.available.us.amount : 0;
						}
						if( skuAvail === "Yes" ||
							skuAvail > 0 ||
							(self.config.currency == "USD" && skuAvail === 0 && fins.indexOf("5 Fin") !== -1) ||
							(self.config.currency == "USD" && skuAvail === 0 && seriesName.indexOf("Vert") !== -1) ||
							(self.config.currency == "CAD" && skuAvail === 0 && fins.indexOf("5 Fin") !== -1) ||
							(self.config.currency == "CAD" && skuAvail === 0 && seriesName.indexOf("Vert") !== -1) ||
							(self.config.currency == "EUR" && skuAvail > 0)) {
							// check to see if we matched an size that was already selected
							if (selectedSize == fullName) {
								sizeOptions += '<option value="' + fullName + '" selected="selected" data-img="' + value.bottomImage + '" data-img-full="' + value.bottomImageFull + '">' + fullName + '</option>';
							} else {
								sizeOptions += '<option value="' + fullName + '" data-img="' + value.bottomImage + '" data-img-full="' + value.bottomImageFull + '">' + fullName + '</option>';
							}
							sizeArray.push(fullName);
						}
					}
				});
				// render out html for size options
				$('#product-variation-size').html(sizeOptions);
				// kill alert color, if it's added
				$('#product-variation-size').removeClass('alert');
			}
			// update price display
			updatePrice();
		});
		// check for size / fin selection change
		$('#product-variation-size').on('change', function () {
			// select the correct image
			var sizeName, bottomImage, bottomImageFull;
			sizeName = $(this).val();
			// check to make sure something was selectedSize
			if (sizeName != -1) {
				bottomImage = $(this).find("option:selected").attr("data-img");
				bottomImageFull = $(this).find("option:selected").attr("data-img-full");
				// kill alert color, if it's added
				$(this).removeClass('alert');
				// change bottom graphic
				$('.product-images .surfboard-bottom img').attr('src', bottomImage).attr('data-img', bottomImage).attr('data-img-full', bottomImageFull);
			}
			// update price display
			updatePrice();
		});
		// trigger default change
		$('#product-variation-graphic').trigger('change');
		$('#product-variation-size').trigger('change');
		// add to cart api btn
		$('a.add-to-cart').click(function (e) {
			e.preventDefault();
			var productGraphic, productSize, productSKU;
			// check graphic selection
			productGraphic = $('#product-variation-graphic').val();
			if (productGraphic === "-1") {
				$('#product-variation-graphic').addClass('alert');
			}
			// check size selection
			productSize = $('#product-variation-size').val();
			if (productSize === "-1") {
				// add alert to class
				$('#product-variation-size').addClass('alert');
			}
			// check if either are -1, and return if they are
			if (productGraphic === "-1" || productSize === "-1") {
				return;
			}
			// find the SKU in the product array
			productSKU = "";
			$.each(productArray, function (key, value) {
				if (productSize === (value.length + ' - ' + value.fins) && productGraphic === value.name) {
					productSKU = value.sku;
				}
			});
			if (productSKU === "") {
				$('.product-buy .cart-failure').addClass('visible').removeClass('hidden');
				return;
			}
			// hide add to cart, show loading while request is made
			$('.product-buy ul li.loading').addClass('visible').removeClass('hidden');
			$('.product-buy ul li.cart-button').addClass('hidden').removeClass('visible');
			// call shopatron's api
			Shopatron.addToCart({
				quantity: '1', // Optional: Defaults to 1 if not set
				partNumber: productSKU // Required: This is the product that will be added to the cart.
			}, {
				// All event handlers are optional
				success: function (data, textStatus) {
					self.addToCartSuccess();
				},
				error: function (textStatus, errorThrown) {
					self.addToCartError();
				},
				complete: function (textStatus) {
					self.addToCartComplete();
				}
			});
		});
	}
};
