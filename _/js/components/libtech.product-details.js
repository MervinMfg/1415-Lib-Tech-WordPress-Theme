/**
 * 1415 Lib Tech WordPress Theme - Product Details - http://www.lib-tech.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var LIBTECH = LIBTECH || {};

LIBTECH.ProductDetails = function () {
	this.config = {
		slider: null,
		zoomThumbSlider: null,
		thumbSliderWidth: 100
	};
	this.init();
};
LIBTECH.ProductDetails.prototype = {
	init: function () {
		var self, thumbSlider, techConstructionSlider;
		self = this;
		self.initProductNav();
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
		$(window).load(function () {
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
			if (LIBTECH.main.utilities.getMediaWidth() >= 600) { // if not mobile, trigger zoom on click
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
			type: 'ajax',
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
	},
	initProductNav: function () {
		var navState, $navLink, $prodNav, prodNavHeight;
		navState = "opened";
		$navLink = $('.product-nav-btn');
		$prodNav = $('.product-nav');
		// init bx slider
		$('.product-slider .bxslider').bxSlider({
			slideWidth: 220,
			minSlides: 2,
			maxSlides: 8,
			slideMargin: 10,
			auto: false,
			speed: 500,
			controls: true,
			pager: false,
			mode: 'horizontal',
			moveSlides: 2,
			infiniteLoop: false,
			hideControlOnEnd: true
		});
		prodNavHeight = $prodNav.outerHeight();
		// toggle navigation
		$navLink.click(function() {
			if (navState == "opened") {
				TweenMax.to($prodNav, 0.5, {marginTop: (prodNavHeight - 90) * -1});
				navState = "closed";
			} else {
				TweenMax.to($prodNav, 0.5, {marginTop: 0});
				navState = "opened";
			}
			
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
		self.config.slider.reloadSlider();
		// select active color
		activeThumbnail.click();
	},
	initBuyWithOneVariation: function () {
		var self = this;
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
		$('#product-variation').change(function () {
			// display the correct image matching selected option
			var productSKU, productSKUs, productThumbs;
			productSKU = $(this).val();
			productSKUs = [];
			if (productSKU != "-1") {
				$('#product-variation').removeClass('alert');
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
		// FOR PRODCUTS WITH MORE THAN 1 VARTIATION SELECTION
		// select field for color
		$('#product-variation-color').change(function () {
			// select the correct image
			var colorValue, colorThumbs;
			colorValue = $(this).val();
			colorThumbs = $('.image-list-thumbs li a[data-color="' + colorValue + '"]');
			if (colorThumbs.length > 0) {
				$(colorThumbs[0]).click();
			}
			// kill alert color, if it's added
			$('#product-variation-color').removeClass('alert');
		});
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
		$('#product-variation-size').change(function () {
			var sizeValue, colorValue, colorOptions, colorArray;
			sizeValue = $(this).val();
			// build color list based on size
			colorValue = $('#product-variation-color').val();
			colorOptions = '<option value="-1">Select Color</option>';
			colorArray = [];
			$.each(productArray, function (key, value) {
				// check if size already exists
				var inArrayCheck = $.inArray(value.color, colorArray);
				// add available options
				if ((sizeValue === "-1" && value.available === "Yes" && inArrayCheck === -1) || (sizeValue === value.size && value.available === "Yes" && inArrayCheck === -1)) {
					if (colorValue === value.color) {
						colorOptions += '<option value="' + value.color + '" selected="selected">' + value.color + '</option>';
					} else {
						colorOptions += '<option value="' + value.color + '">' + value.color + '</option>';
					}
					colorArray.push(value.color);
				}
			});
			// render out html
			$('#product-variation-color').html(colorOptions);
			// kill alert color, if it's added
			$('#product-variation-size').removeClass('alert');
		});
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
					var fullName = value.length + ' - ' + value.fins;
					// check if size already exists
					var inArrayCheck = $.inArray(fullName, sizeArray);
					if (value.name == graphicName && inArrayCheck === -1 || graphicName == -1 && inArrayCheck === -1) {
						if(value.avail === "Yes" || value.avail === "Limited") {
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
		var updatePrice = function () {
			var self, selectedGraphic, selectedSize, defaultFinValue;
			self = this;
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
				$.each(productArray, function (key, value) {
					if (selectedSize === (value.length + ' - ' + value.fins) && selectedGraphic === value.name) {
						if(value.type == "Logo" && value.avail == "Limited") {
							// show limited logo option messaging
							$('.product-stock-alert .surf-logo-limited').addClass('active');
						} else if (value.type == "Graphic" && value.avail == "Limited") {
							// show limited graphic option messaging
							$('.product-stock-alert .surf-graphic-limited').addClass('active');
						}
					}
				});
			}
		};
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
