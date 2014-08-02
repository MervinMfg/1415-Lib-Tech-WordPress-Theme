/*
 * Lib Tech - http://lib-tech.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var LIBTECH = LIBTECH || {};

LIBTECH.main = {
	config: {
		menuState: 'closed',
		wpImgPath: '/wp-content/themes/1415-Lib-Tech-WordPress-Theme/_/img/'
	},
	init: function () {
		var self, $body, shop;
		self = this;
		$body = $('body');
		// init global compontents
		shop = new LIBTECH.Shop(); // init shopatron JS
		self.regionSelectorInit(); // init the region selector
		self.sportCookieInit(); // init/check the sport cookie
		self.searchInit(); // init header search bar
		$(window).load(function () {
			self.menuInit(); // init main menu
		});
		// check body class and init proper class
		if ($body.hasClass('home')) {
			self.homeInit();
		} else if ($body.hasClass('page-template-page-templateshome-sport-php')) {
			self.homeSportInit();
		} else if ($body.hasClass('page-template-page-templatesoverview-products-php')) {
			self.productOverviewInit();
		} else if ($body.hasClass('single-libtech_snowboards') || $body.hasClass('single-libtech_nas') || $body.hasClass('single-libtech_surfboards') || $body.hasClass('single-libtech_skateboards') || $body.hasClass('single-libtech_apparel') || $body.hasClass('single-libtech_accessories') || $body.hasClass('single-libtech_luggage') || $body.hasClass('single-libtech_outerwear') || $body.hasClass('single-libtech_bindings')) {
			self.productDetailInit();
		} else if ($body.hasClass('page-template-page-templatespage-technology-detail-php')) {
			self.technologyDetailInit();
		} else if ($body.hasClass('page-template-page-templatespage-environmental-php')) {
			self.environmentalInit();
		} else if ($body.hasClass('page-template-page-templatespage-environmental-detail-php')) {
			self.environmentalDetailInit();
		} else if ($body.hasClass('page-template-page-templatespage-overview-team-php')) {
			self.teamOverviewInit();
		} else if ($body.hasClass('single-libtech_team_snow') || $body.hasClass('single-libtech_team_nas') || $body.hasClass('single-libtech_team_surf') || $body.hasClass('single-libtech_team_skate')) {
			self.teamDetailsInit();
		} else if ($body.hasClass('blog') || $body.hasClass('search') || $body.hasClass('archive') || $body.hasClass('error404')) {
			self.blogInit();
		} else if ($body.hasClass('single-post')) {
			self.blogInit();
			self.blogSingleInit();
		} else if ($body.hasClass('page-template-page-templatespage-faqs-php')) {
			self.faqsInit();
		} else if ($body.hasClass('page-template-page-templatespage-snowboard-builder-php')) {
			LIBTECH.snowboardbuilder.init();
		} else if ($body.hasClass('page-template-page-templatespage-snowboard-builder-share-php')) {
			LIBTECH.snowboardbuilder.shareInit();
		} else if ($body.hasClass('page-template-page-templatespage-partners-php')) {
			self.partnersInit();
		} else if ($body.hasClass('page-template-page-templatespage-surfboard-fins-php')) {
			self.finsInit();
		} else if ($body.hasClass('page-template-page-templatespage-lbs-php')) {
			self.lbsInit();
		} else if ($body.hasClass('page-template-page-templatespage-pass-it-on-project-php')) {
			self.passItOnInit();
		} else if ($body.hasClass('page-template-page-templatespage-lib-legs-php')) {
			self.libLegsInit();
		} else if ($body.hasClass('page-template-page-templatesstorm-factory-php')) {
			self.stormFactoryInit();
		}
		/* Chrome Webfont Fix Styles
			- https://code.google.com/p/chromium/issues/detail?id=336476
			- https://productforums.google.com/forum/#!topic/chrome/elw8busIfJA
		*/
		var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
		if(is_chrome === true) {
			$('body').hide().show();
		}
		// FACEBOOK COMMENT FIX
		if($('.discussion-thread')) {
			// cache some selectors so we're not looking up divs over and
			// over and over on resize
			var facebook_comment_resize,
			comment_resize_timeout,
			$window = $(window),
			$comments_container = $('.discussion-thread'),
			$comments = $('.fb-comments');
			facebook_comment_resize = function() {
				// define a function to get the width of the comment container
				// then set the data-width attribute on the facebook comment div
				$comments.attr("data-width", $comments_container.width());
				// Reinitialize the comments so it can grab the new width from
				// the data element on the comment div
				if (typeof FB === 'undefined') return;
				FB.XFBML.parse($comments_container.get(0));
			};
			// Set a timeout that can clear itself, keeps the comments
			// from refreshing themselves dozens of times during resize
			$window.on('resize', function() {
				clearTimeout( comment_resize_timeout );
				comment_resize_timeout = setTimeout(facebook_comment_resize, 200);
			});
			// Set the initial width on load
			facebook_comment_resize();
		}
	},
	menuInit: function () {
		var self, marginClosed, marginOpen;
		self = this;
		marginClosed = $(".nav-sub-wrapper").height() * -1 + 10;
		marginOpen = -20;
		// remove old handlers
		$(".nav-sub-wrapper .mobile-btn").unbind('click');
		$(window).off('resize.mainMenu');
		// close menu by default
		if (self.utilities.getMediaWidth() < 600) {
			$('.nav-sub-wrapper').stop().animate({
				marginTop: marginClosed
			}, {
				duration: 500,
				easing: 'swing'
			});
			self.config.menuState = 'closed';
		}
		// mobile menu
		$(".nav-sub-wrapper .mobile-btn").click(function (e) {
			e.preventDefault();
			if (self.config.menuState == 'closed') {
				$('.nav-sub-wrapper').stop().animate({
					marginTop: marginOpen
				}, {
					duration: 500,
					easing: 'swing'
				});
				self.config.menuState = 'open';
			} else {
				$('.nav-sub-wrapper').stop().animate({
					marginTop: marginClosed
				}, {
					duration: 500,
					easing: 'swing'
				});
				self.config.menuState = 'closed';
			}
		});
		// reinit menu on resize
		$(window).on('resize.mainMenu', function () {
			if (self.utilities.getMediaWidth() < 600) {
				self.menuInit();
			} else {
				$('.nav-sub-wrapper').stop();
				$('.nav-sub-wrapper').css('margin-top', '-20px');
			}
		});
	},
	searchInit: function () {
		$('header .nav-utility .search a').click(function (e) {
			e.preventDefault();
			e.stopPropagation(); // kill even from firing further
			$('#header-search').toggleClass('visible');
			$('#header-search .text-input').focus();
			$('#header-search .text-input').val('');
			// listen for escape key
			$(document).keyup(function (e) {
				if (e.keyCode == 27) {
					$('#header-search').toggleClass('visible');
					// kill event listeners
					$(document).unbind('keyup');
					$(document).unbind('click');
					$('#header-search').unbind('click');
				}
			});
			// don't hide if clicked within search area
			$('#header-search').click(function (e) {
				e.stopPropagation();
			});
			// hide if clicked anywhere outside search area
			$(document).click(function () {
				$('#header-search').toggleClass('visible');
				// kill event listeners
				$(document).unbind('keyup');
				$(document).unbind('click');
				$('#header-search').unbind('click');
			});
		});
	},
	regionSelectorInit: function () {
		// check language cookie on load
		var self, lang, regionCookie;
		self = this;
		regionCookie = self.utilities.cookie.getCookie('libtech_region');
		if (regionCookie !== null || regionCookie !== "") {
			lang = regionCookie;
		}
		if (lang) {
			if (lang === 'ca') {
				$(".country-ca").addClass("selected");
				$("body").removeClass("international");
				self.takeoverInit();
			} else if (lang === 'int') {
				$("body").addClass("international");
				$(".country-int").addClass("selected");
				self.takeoverInit();
			} else {
				$(".country-us").addClass("selected");
				$("body").removeClass("international");
				self.takeoverInit();
			}
		} else {
			if (navigator.cookieEnabled === true) {
				// if no region cookie has been set, open selector if on product page
				if ($('body').hasClass('page-template-page-templatespage-snowboard-builder-php') || $('body').hasClass('page-template-page-templatespage-snowboard-builder-share-php') || $('body').hasClass('page-template-page-templatespage-shopping-cart-php') || $('body').hasClass('page-template-page-templatespage-overview-products-php') || $('body').hasClass('single-libtech_snowboards') || $('body').hasClass('single-libtech_nas') || $('body').hasClass('single-libtech_surfboards') || $('body').hasClass('single-libtech_skateboards') || $('body').hasClass('single-libtech_apparel') || $('body').hasClass('single-libtech_accessories') || $('body').hasClass('single-libtech_luggage') || $('body').hasClass('single-libtech_outerwear')) {
					self.regionSelectorOverlayInit();
					self.takeoverInit(false);
				} else {
					self.takeoverInit();
				}
				// pick us by default, but don't set cookie
				$(".country-us").addClass("selected");
			} else {
				// cookies are disabled
				$(".country-us").addClass("selected");
				self.takeoverInit();
			}
		}
		// add click events
		$(".region-selector").click(function (e) {
			e.preventDefault();
			e.stopPropagation(); // kill even from firing further
			if (navigator.cookieEnabled === false) {
				alert('Enable cookies in your browser in order to select your region.');
			} else {
				self.regionSelectorOverlayInit();
			}
		});
	},
	regionSelectorOverlayInit: function () {
		var self = this;
		$('#region-selector').toggleClass('visible');
		// add click events
		$("#region-selector .us").click(function (e) {
			e.preventDefault();
			self.utilities.cookie.setCookie('libtech_region', 'us', 60);
			window.location.reload();
		});
		$("#region-selector .ca").click(function (e) {
			e.preventDefault();
			self.utilities.cookie.setCookie('libtech_region', 'ca', 60);
			window.location.reload();
		});
		$("#region-selector .int").click(function (e) {
			e.preventDefault();
			self.utilities.cookie.setCookie('libtech_region', 'int', 60);
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
	sportCookieInit: function () {
		var self, sport;
		self = this;
		sport = "";
		if (navigator.cookieEnabled === true) {
			/* if cookies are enabled, make sure the right cookie gets set
               this is needed for pages that get cached
               to notify non cached pages where we came from */
			if ($('body').hasClass('ski')) {
				sport = "ski";
			} else if ($('body').hasClass('surf')) {
				sport = "surf";
			} else if ($('body').hasClass('skate')) {
				sport = "skate";
			} else {
				sport = "snow";
			}
			self.utilities.cookie.setCookie('libtech_sport', sport, 30);
		}
	},
	takeoverInit: function (showTakeover) {
		var self = this;
		if (typeof (showTakeover) === 'undefined') showTakeover = true;
		// make sure we're not on an international page, we don't show it there
		//if ($('body').hasClass('international') === false) {
			// on click of takeover, check expansion / contraction
			$('.takeover').on('click.takeover', function (e) {
				var contracted, expanded;
				contracted = $('.takeover .takeover-content .contracted');
				expanded = $('.takeover .takeover-content .expanded');

				if (contracted.hasClass('hide')) {
					$('.takeover').height(expanded.height());
					$('.takeover').animate({
						height: contracted.height()
					}, 500, function () {
						$('.takeover').height('auto');
					});
				} else {
					$('.takeover').height(contracted.height());
					$('.takeover').animate({
						height: expanded.height()
					}, 500, function () {
						$('.takeover').height('auto');
					});
				}
				contracted.toggleClass('hide');
				expanded.toggleClass('show');
			});
			// check if we should diplay the takeover or not based on cookies
			if (navigator.cookieEnabled !== false && showTakeover === true) {
				var takeoverCookie = self.utilities.cookie.getCookie('libtech_takeover');
				if (takeoverCookie !== 'ExtensionRamp') {
					self.utilities.cookie.setCookie('libtech_takeover', 'ExtensionRamp', 7);
					setTimeout(function () {
						$('.takeover').click();
					}, 2000);
				}
			}
		//}
	},
	homeInit: function () {
		var self = this;
		self.utilities.featuredSliderInit();
		// set up product slider
		var slider = $('.product-slider .bxslider').bxSlider({
			slideWidth: 220,
			minSlides: 2,
			maxSlides: 8,
			slideMargin: 10,
			auto: true,
			autoHover: true,
			speed: 500,
			controls: true,
			pager: false,
			mode: 'horizontal',
			moveSlides: 2,
			infiniteLoop: false,
			hideControlOnEnd: true
		});
	},
	homeSportInit: function () {
		var self, slideWidth, slideMargin;
		self = this;
		// set up large featured images/videos
		self.utilities.featuredSliderInit();
		// change slide size for surfboards
		// check for surf specific content
		if ($('body').hasClass('surf')) {
			slideWidth = 260;
			slideMargin = 40;
			// responsive video
			$(".faq").fitVids();
		} else {
			slideWidth = 220;
			slideMargin = 10;
		}
		// set up product slider
		var slider = $('.product-slider .bxslider').bxSlider({
			slideWidth: slideWidth,
			minSlides: 2,
			maxSlides: 8,
			slideMargin: slideMargin,
			auto: true,
			autoHover: true,
			speed: 500,
			controls: true,
			pager: false,
			mode: 'horizontal',
			moveSlides: 2,
			infiniteLoop: false,
			hideControlOnEnd: true
		});
		// render social content grid items
		self.utilities.socialContentGridItemsInit();
	},
	productOverviewInit: function () {
		var self, slider;
		self = this;
		slider = $('.featured-product-slider .bxslider').bxSlider({
			auto: true,
			autoHover: true,
			speed: 800,
			randomStart: false,
			slideMargin: 20,
			controls: true,
			pager: false,
			mode: 'horizontal',
			adaptiveHeight: false,
			infiniteLoop: false,
			hideControlOnEnd: true,
			onSliderLoad: function (currentIndex) {
				$('.featured-product-slider .bxslider > li').eq(currentIndex).addClass('active');
			},
			onSlideBefore: function (slideElement, oldIndex, newIndex) {
				$('.featured-product-slider .bxslider > li').removeClass('active');
				slideElement.addClass('active');
				if (newIndex === 0) { // run fix for duplicate slides at begining and end
					$('.featured-product-slider .bxslider > li').eq($('.featured-product-slider .bxslider > li').length - 1).addClass('active');
				}
			}
		});
		// BEGIN SETTING UP ISOTOPE
		productListing = $('.product-overview .product-listing');
		// adjust initial item widths
		setWidths();
		// on window load run layout again to fix image heights
		$(window).load(function () {
			// set up initial settings
			productListing.isotope({
				itemSelector: '.product-item',
				resizable: false, // turn off because it's responsive
				layoutMode: 'fitRows',
				fitRows: {
					columnWidth: getUnitWidth()
				},
				getSortData: {
					price: function ($elem) {
						return parseFloat($elem.find('.price p span').text().replace("$", ""));
					}
				}
			});
			// adjust width to be correct
			$('.product-filtering > li.filters').each(function () {
				var widthTotal = 0;
				$(this).find('ul > li').each(function () {
					widthTotal += $(this).outerWidth();
				});
				// max width for filter dropdowns
				if (widthTotal > 646) {
					widthTotal = 646;
				}
				// max width for 4 filter sets
				if ($('.product-filtering').hasClass('apparel')) {
					if (widthTotal > 430) {
						widthTotal = 430;
					}
				}
				// max width for 3 filter sets
				if ($('.product-filtering').hasClass('skis') || $('.product-filtering').hasClass('skateboards') || $('.product-filtering').hasClass('outerwear')) {
					if (widthTotal > 316) {
						widthTotal = 316;
					}
				}
				// max width for 2 filter sets
				if ($('.product-filtering').hasClass('accessories') || $('.product-filtering').hasClass('luggage')) {
					if (widthTotal > 206) {
						widthTotal = 206;
					}
				}
				// max width for 1 filter set
				if ($('.product-filtering').hasClass('surfboards') || $('.product-filtering').hasClass('bindings')) {
					if (widthTotal > 96) {
						widthTotal = 96;
					}
				}
				$(this).find('ul').width(widthTotal);
			});
		});
		// update columnWidth on window resize
		$(window).smartresize(function () {
			// set the widths of items
			setWidths();
			// reinit isotop with new column width
			productListing.isotope({
				fitRows: {
					columnWidth: getUnitWidth()
				}
			});
		});
		// get new width of each item based on browser width
		function getUnitWidth() {
			var width, windowWidth;
			windowWidth = self.utilities.getMediaWidth();
			if (windowWidth < 600) {
				width = productListing.width() / 2;
			} else if (windowWidth < 768) {
				width = productListing.width() / 3;
			} else if (windowWidth < 980) {
				width = productListing.width() / 4;
			} else {
				width = productListing.width() / 5;
			}
			width = Math.floor(width);
			return width;
		}
		// set the widths of each item
		function setWidths() {
			var unitWidth = getUnitWidth();
			productListing.children(".product-item").css({
				width: unitWidth
			});
		}
		// filter items when filter link is clicked
		$('.product-filtering > li.filters > ul > li').click(function () {
			var target, selector, selectorASC, filterItems, filterList;
			target = $(this);
			target.toggleClass('selected'); // add or remove selected class
			if (target.attr('data-filter')) { // if target clicked is a filter option vs sort
				self.utilities.filterList(productListing);
			} else { // we are sorting data now, not filtering
				if (target.hasClass('selected')) {
					// grab all sort specific items and deselect them
					$('.product-filtering > li.filters > ul > li[data-sort]').each(function () {
						var sortItem = $(this);
						sortItem.removeClass('selected');
					});
					// select the one that was clicked again
					target.addClass('selected');
					// figure out what to sort by
					selector = target.attr('data-sort');
					// determine sort order
					if (target.attr('data-sort-asc') == "true") {
						selectorASC = true;
					} else {
						selectorASC = false;
					}
					// apply sorting
					productListing.isotope({
						sortBy: selector,
						sortAscending: selectorASC
					});
				} else {
					// reset sorting if none selected
					productListing.isotope({
						sortBy: "original-order",
						sortAscending: true
					});
				}
			}
			
			return false;
		});
		// filter products on hashchange
		$(window).on('hashchange', function() {
			var hashFilterList, filtersBeginIndex;
			hashFilterList = window.location.hash;
			// make sure hash has value
			if (hashFilterList.indexOf('filter=') != -1) {
				hashFilterList = decodeURIComponent(hashFilterList);
				filtersBeginIndex = hashFilterList.indexOf('filter=');
				filtersBeginIndex = filtersBeginIndex + 7; // add amount of characters filter= takes up
				hashFilterList = hashFilterList.substr(filtersBeginIndex);
				// check for &, remove everything after incase there is more added to hash
				if(hashFilterList.indexOf('&') != -1) {
					hashFilterList = hashFilterList.substr(0, hashFilterList.indexOf('&'));
				}
				// set selected filter on front-end dropdowns
				$('.product-filtering > li.filters > ul > li[data-filter]').each(function () {
					var target = $(this);
					if(hashFilterList.indexOf(target.attr('data-filter')) != -1) {
						target.addClass('selected');
					}
				});
				// submit filter to isotope
				productListing.isotope({
					filter: hashFilterList
				});
			} else {
				$('.product-filtering > li.filters > ul > li[data-filter]').each(function () {
					var target = $(this);
					target.removeClass('selected');
				});
				// submit filter to isotope
				productListing.isotope({
					filter: ''
				});
			}
			// UPDATE FILTERS REMOVE FEATURES
			$('.product-filtering > li.filters').each(function () {
				// Check to see which filter groups have filters set
				var filterGroup, isFilterSet;
				filterGroup = $(this);
				isFilterSet = false;
				filterGroup.find('ul > li').each(function () {
					if ($(this).hasClass('selected')) {
						isFilterSet = true;
					}
				});
				if (isFilterSet === true) { // if filter set has items selected add remove features
					filterGroup.find('.selected-items').each(function () {
						$(this).html('Remove');
						$(this).click(function () {
							$(this).html('Select');
							filterGroup.find('ul > li').each(function () {
								$(this).removeClass('selected');
							});
							self.utilities.filterList(productListing);
							// check if sort needs to be reset
							if (filterGroup.find('ul > li[data-sort]').length > 0) {
								productListing.isotope({
									sortBy: "original-order",
									sortAscending: true
								});
							}
						});
					});
				} else { // if filter does not have selected reset
					filterGroup.find('.selected-items').each(function () {
						$(this).html('Select');
						$(this).unbind('click');
					});
				}
			});
		});
		// trigger change if there is a value
		if (window.location.hash !== '') {
			$(window).trigger("hashchange");
		}
	},
	productDetailInit: function () {
		var self, slider, thumbSlider, thumbSliderWidth, techConstructionSlider, zoomThumbSlider;
		self = this;
		// ADD TO CART COMPLETION METHODS
		function addToCartSuccess() {
			$('.product-buy .cart-success').removeClass('hidden');
			$('.product-buy .cart-failure').addClass('hidden');
			// update quickcart
			self.quickCartInit();
		}
		function addToCartError() {
			$('.product-buy .cart-failure').removeClass('hidden');
			$('.product-buy .cart-success').addClass('hidden');
		}
		function addToCartComplete() {
			$('.product-buy ul li.loading').addClass('hidden');
			$('.product-buy ul li.cart-button').removeClass('hidden');
		}
		// PRODUCT ZOOM METHODS
		// add product image zoom features
		function initZoom(clickIndex) {
			$('.product-zoom').addClass('show');
			$('.product-details').addClass('hide');
			// add close event
			$('.product-zoom .zoom-close').on('click.productZoom', function (e) {
				e.preventDefault();
				uninitZoom();
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
				zoomThumbSlider = $('#zoom-thumbnails').bxSlider({
					slideWidth: thumbSliderWidth,
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
		}
		// remove product image zoom features
		function uninitZoom() {
			// kill listeners
			$('.product-zoom .zoom-close').off('click.productZoom');
			$('#zoom-thumbnails li a').off('click.productZoom');
			// swap display
			$('.product-zoom').removeClass('show');
			$('.product-details').removeClass('hide');
			// destroy thumbnail slider if it exists
			if (zoomThumbSlider) {
				zoomThumbSlider.destroySlider();
				zoomThumbSlider = null;
			}
			slider.reloadSlider();
		}
		// BEGIN EXECUTING DETAIL CODE
		$(".product-tech-major").fitVids();
		$(".product-video").fitVids();
		// setup main product image slider
		slider = $('#image-list').bxSlider({
			controls: false,
			mode: 'fade',
			pagerCustom: '#image-list-thumbs'
		});
		// set up thumbnail slider
		thumbSliderWidth = 100;
		if ($('body').hasClass('single-libtech_surfboards')) { thumbSliderWidth = 45; }
		thumbSlider = $('#image-list-thumbs').bxSlider({
			slideWidth: thumbSliderWidth,
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
			if (typeof slider !== 'undefined') {
				if (slider.length > 0) slider.reloadSlider();
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
		// init gallery
		if ($('.gallery')) {
			self.utilities.galleryInit();
		}
		// check for browser resize and see if desktop zoom should occur
		$(window).on('resize.productZoom', function () {
			if (self.utilities.getMediaWidth() >= 600) { // if not mobile, trigger zoom on click
				// zoom listener
				$('.product-images #image-list li a').on('click.productZoom', function (e) {
					e.preventDefault();
					initZoom($(this).parent().index());
				});
				// surf zoom listener
				$('.product-images .surfboard-top, .product-images .surfboard-side, .product-images .surfboard-bottom').on('click.productZoom', function (e) {
					e.preventDefault();
					// determine active graphic option
					var zoomIndex = $('#image-list-thumbs li a.active').parent().index();
					if(zoomIndex < 0) {zoomIndex = 0;} // if it's still default
					initZoom(zoomIndex);
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
		// CHECK WHICH PRODUCT WE'RE ON AND RUN THE CORRECT CODE
		if ($('body').hasClass('single-libtech_surfboards')) {
			// init gallery
			if ($('.gallery')) {
				self.utilities.galleryInit();
			}
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
				var selectedGraphic, selectedSize;
				$('.product-price div').removeClass('active');
				selectedGraphic = $('#product-variation-graphic').val();
				selectedSize = $('#product-variation-size').val();

				if (selectedGraphic == "Logo" || selectedGraphic == -1) {
					if (selectedSize.indexOf("3 Fin") !== -1) {
						$('.product-price .price-logo').addClass('active');
					} else if (selectedSize.indexOf("5 Fin") !== -1) {
						$('.product-price .price-logo-five').addClass('active');
					} else {
						var defaultFinValue = $('#product-variation-size option:eq(1)').val();
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
						var defaultFinValue = $('#product-variation-size option:eq(1)').val();
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
						addToCartSuccess();
					},
					error: function (textStatus, errorThrown) {
						addToCartError();
					},
					complete: function (textStatus) {
						addToCartComplete();
					}
				});
			});
		} else if ($('body').hasClass('single-libtech_outerwear') || $('body').hasClass('single-libtech_accessories') || $('body').hasClass('single-libtech_apparel')) {
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
						addToCartSuccess();
					},
					error: function (textStatus, errorThrown) {
						addToCartError();
					},
					complete: function (textStatus) {
						addToCartComplete();
					}
				});
			});
		} else {
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
						slider.goToSlide(i);
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
						addToCartSuccess();
					},
					error: function (textStatus, errorThrown) {
						addToCartError();
					},
					complete: function (textStatus) {
						addToCartComplete();
					}
				});
			});
		}
	},
	technologyDetailInit: function () {
		var self = this;
		// make video fit within target
		$('.video-header.video .video-player').fitVids();
		$('.tech-major .tech-video').fitVids();
		self.faqsInit();
	},
	environmentalInit: function () {
		$(".enviro-video").fitVids();
	},
	environmentalDetailInit: function () {
		var self = this;
		// make video fit within target
		$('.video-header.video .video-player').fitVids();
		self.faqsInit();
	},
	blogInit: function () {
		// CATEGORY TREE VIEW ON BLOG PAGES
		$(".widget_mycategoryorder ul").treeview({
			persist: "location",
			collapsed: true,
			unique: false,
			animated: "fast"
		});
	},
	blogSingleInit: function () {
		var self = this;
		// BEGIN CODE FOR 2 COLUMN LAYOUT THAT FIXES POSITIONS WHEN SCROLLED PAST
		// check browser width and perform appropriate actions on 2 column layout
		function checkPageWidth() {
			if (self.utilities.getMediaWidth() < 980) {
				// if we're less than 980 turn off scroll listener and reset dom
				$(window).off('scroll.blogScroll');
				// reset all css
				$('#sidebar').css({
					position: 'static',
				});
				$('#sidebar .sidebar-wrapper').css({
					position: 'static',
					width: '100%'
				});
				$('article.post').css({
					position: 'static'
				});
				$('article.post .post-wrapper').css({
					position: 'static',
					width: '100%'
				});
			} else {
				// if we're bigger than 980 listen for scroll and run check
				$(window).off('scroll.blogScroll');
				$(window).on('scroll.blogScroll', function () {
					checkScroll();
				});
				checkScroll();
			}
		}
		// on page scroll check the positioning of elements
		function checkScroll() {
			// set up variables
			var post, postHeight, sidebar, sidebarHeight, windowScrollTop, windowHeight;
			post = $('article.post');
			postHeight = post.height();
			postWrapper = $('article.post .post-wrapper');
			postWrapperHeight = postWrapper.height();
			sidebar = $('#sidebar');
			sidebarHeight = sidebar.height();
			sidebarWrapper = $('#sidebar .sidebar-wrapper');
			sidebarWrapperHeight = sidebarWrapper.height();
			windowScrollTop = $(window).scrollTop();
			windowHeight = $(window).height();
			// check to see which column is longer
			if (sidebarHeight < postHeight) {
				// if sidebar is shorter, do this
				if (windowScrollTop + windowHeight > post.offset().top + sidebarWrapperHeight) {
					// we've reached the bottom of the sidebar, so anchor it
					// find the appropriate position for the sidebar
					// var bottomPosition = post.offset().top + postHeight - windowScrollTop - windowHeight;
					// set the position
					sidebarWrapper.css({
						position: 'fixed',
						bottom: '0px',
						width: sidebar.width()
					});
					// if we can see the footer, fix the sidebar to bottom of section
					if (isInView('footer')) {
						sidebar.css({
							position: 'absolute',
							bottom: '-50px',
							right: '0px'
						});
						sidebarWrapper.css({
							position: 'static',
							width: '100%'
						});
					}
				} else {
					// we're at the top
					sidebar.css({
						position: 'static',
					});
					sidebarWrapper.css({
						position: 'static',
						width: '100%'
					});
				}
			} else {
				// if post is shorter, do this
				if (windowScrollTop + windowHeight > sidebar.offset().top + postWrapperHeight) {
					// we've reached the bottom of the post, so anchor it
					// find the appropriate position for the post
					// var bottomPosition = sidebar.offset().top + sidebarHeight - windowScrollTop - windowHeight;
					// set the position
					postWrapper.css({
						position: 'fixed',
						bottom: '0px',
						width: post.width()
					});
					// if we can see the footer, fix the post to bottom of section
					if (isInView('footer')) {
						post.css({
							position: 'absolute',
							bottom: '-50px',
							left: '0px'
						});
						postWrapper.css({
							position: 'static',
							width: '100%'
						});
					}
				} else {
					// we're at the top
					post.css({
						position: 'static'
					});
					postWrapper.css({
						position: 'static',
						width: '100%'
					});
				}
			}
		}
		// check if element is in view
		function isInView(elem) {
			var docViewTop = $(window).scrollTop(); //num of pixels hidden above current screen
			var docViewBottom = docViewTop + $(window).height();
			var elemTop = $(elem).offset().top; //num of pixels above the elem
			var elemBottom = elemTop + $(elem).height();
			return ((elemTop >= docViewTop && elemTop <= docViewBottom));
		}
		// adjust strobbr height/width
		function adjustStrobbr() {
			$('iframe.strobbr').each(function () {
				var
				$this = $(this),
					proportion = $this.data('proportion'),
					w = $this.attr('width'),
					actual_w = $this.width();
				if (!proportion) {
					proportion = $this.attr('height') / w;
					$this.data('proportion', proportion);
				}
				if (actual_w != w) {
					$this.css('height', Math.round(actual_w * proportion) + 'px');
				}
			});
		}
		$(window).on('resize load', function () {
			adjustStrobbr();
			checkPageWidth(); // on resize check what the width of the browser is for fixed scroll elements
		});
		$(".blog-post .entry-content").fitVids();
		// init gallery
		if ($('.gallery')) {
			self.utilities.galleryInit();
			// listen for update and fix break when taller image is loaded
			$(".gallery").on("galleryUpdate", function (e) {
				checkPageWidth();
			});
		}
		// check for facebook plugin loads, such as facebook embeds
		$(window).on('load', function () {
			FB.Event.subscribe('xfbml.render', function () {
				// facebook content has been rendered
				checkPageWidth(); // listen for update and fix break when taller content is loaded
			});
		});
	},
	teamOverviewInit: function () {
		var self = this;
		// make video fit within target
		$('.video-header.video .video-player').fitVids();
	},
	teamDetailsInit: function () {
		var self = this;
		// render social content grid items
		self.utilities.socialContentGridItemsInit();
		// init gallery
		if ($('.gallery')) {
			self.utilities.galleryInit();
		}
		// assign a click event to the video thumbnails
		$('.video-thumbnails li a').click(function () {
			var videoID, videoType, videoPlayerHTML;
			videoID = $(this).attr('data-video-id');
			videoType = $(this).attr('data-video-type');
			// select the right thumbnail
			$('.video-thumbnails li a').removeClass('selected');
			$(this).addClass('selected');
			// display the video info
			$('.video-info').removeClass('selected');
			$('.video-player #' + videoID).addClass('selected');
			// add the video content
			if (videoType === "YouTube") {
				videoPlayerHTML = '<iframe width="620" height="348" src="http://www.youtube.com/embed/' + videoID + '" frameborder="0" allowfullscreen></iframe>';
			} else if (videoType === "Vimeo") {
				videoPlayerHTML = '<iframe src="http://player.vimeo.com/video/' + videoID + '" width="620" height="348" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
			}
			$('.video-player .frame-wrapper').html(videoPlayerHTML);
			// make video fit within target
			$('.video-player .frame-wrapper').fitVids();
			// kill the links default behavior
			return false;
		});
		// select the first video
		$('.video-thumbnails li a:first').click();
		// make video fit within target
		$('.video-player .frame-wrapper').fitVids();
	},
	partnersInit: function () {
		$('.partners .entry-content .partner-entry .partner-images').magnificPopup({
			delegate: 'a',
			type: 'image',
			//disableOn: '768',
			closeOnBgClick: false,
			gallery: {
				enabled: true,
				navigateByImgClick: true,
				preload: [0,1] // Will preload 0 - before current, and 1 after the current image
			}
		});
	},
	faqsInit: function () {
		var self = this;
		// fit videos
		$('.faq-list .faq-question .answer').fitVids();
		// hide answer
		$(".faq-question").each(function (index, element) {
			$(this).addClass("collapsed");
		});
		$(".faq-question a.question").next().each(function (index, element) {
			$(this).css("display", "none");
		});
		// activate click listeners
		$(".faq-question a.question").on({
			click: function (e) {
				if ($(this).next("div").css("display") === "none") {
					$(this).next("div").slideDown(300);
					$(this).parent().removeClass("collapsed");
				} else {
					$(this).next("div").slideUp(300);
					$(this).parent().addClass("collapsed");
				}
				e.preventDefault();
			}
		});
		// update page scroll on category change
		$('.faq-categories .mobile-nav').on('change', function (e) {
			var val = $(this).val();
			if(val !== '' || val !== '#' || val !== undefined) {
				self.utilities.pageScroll(val);
			}
		});
		$('.faq-categories .desktop-nav a').on('click', function (e) {
			var val = $(this).attr('href');
			e.preventDefault();
			e.stopPropagation();
			if(val !== '' || val !== '#' || val !== undefined) {
				self.utilities.pageScroll(val);
			}
		});
	},
	finsInit: function () {
		var self = this;
		// init fin positioning slideshow
		$('.fins-adjusting .fins-positioning').bxSlider({
			mode: 'fade',
			auto: true,
			controls: false,
			pause: 3000,
			autoHover: false
		});
		// init faqs
		self.faqsInit();
	},
	lbsInit: function () {
		$('.lbs-updates .featured-video .video-player').fitVids();
	},
	passItOnInit: function () {
		$('.video-header .video-player').fitVids();
		// lightbox for gold member
		$('.pass-it-on-contest .product-wrapper .product.lightbox').magnificPopup({
			delegate: 'a',
			type: 'image',
			disableOn: '768',
			closeOnBgClick: true
		});
	},
	libLegsInit: function () {
		var self = this;
		$('.video-header .video-player').fitVids();
		// set up large featured images/videos
		self.utilities.featuredSliderInit(false);
		// set up product slider
		var slider = $('.product-slider .bxslider').bxSlider({
			slideWidth: 220,
			minSlides: 2,
			maxSlides: 8,
			slideMargin: 10,
			auto: true,
			autoHover: true,
			speed: 500,
			controls: true,
			pager: false,
			mode: 'horizontal',
			moveSlides: 2,
			infiniteLoop: false,
			hideControlOnEnd: true
		});
	},
	stormFactoryInit: function () {
		var self = this;
		//$('.video-header .video-player').fitVids();
		// set up large featured images/videos
		self.utilities.featuredSliderInit();
		// set up product slider
		var slider = $('.product-slider .bxslider').bxSlider({
			slideWidth: 220,
			minSlides: 2,
			maxSlides: 8,
			slideMargin: 10,
			auto: true,
			autoHover: true,
			speed: 500,
			controls: true,
			pager: false,
			mode: 'horizontal',
			moveSlides: 2,
			infiniteLoop: false,
			hideControlOnEnd: true
		});
	},
	shoppingCartInit: function () {
		
	},
	utilities: {
		cookie: {
			getCookie: function (name) {
				var nameEQ = name + "=";
				var ca = document.cookie.split(';');
				for (var i = 0; i < ca.length; i++) {
					var c = ca[i];
					while (c.charAt(0) == ' ') c = c.substring(1, c.length);
					if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
				}
				return null;
			},
			setCookie: function (name, value, days) {
				var date, expires;
				if (days) {
					date = new Date();
					date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
					expires = "; expires=" + date.toGMTString();
				} else {
					expires = "";
				}
				document.cookie = name + "=" + value + expires + "; path=/";
			}
		},
		pageScroll: function (hash) {
			// Smooth Page Scrolling, update hash on complete of animation
			$('html,body').animate({
				scrollTop: $(hash).offset().top
			}, 'slow', function () {
				window.location = hash;
			});
		},
		getMediaWidth: function () {
			var self = this,
				width;
			// Check on this with gavin
			/*
            if (typeof matchMedia !== 'undefined') {
                width = self.bruteForceMediaWidth();
            } else {
            */
			width = window.innerWidth || document.documentElement.clientWidth;
			//}
			return width;
		},
		bruteForceMediaWidth: function () {
			var i = 0,
				found = false;
			while (!found) {
				if (matchMedia('(width: ' + i + 'px)').matches) {
					found = true;
				} else {
					i++;
				}
				// Prevent infinite loop if something goes horribly wrong
				if (i === 9999) {
					break;
				}
			}
			return i;
		},
		featuredSliderInit: function (autoRotate) {
			autoRotate = typeof autoRotate !== 'undefined' ? autoRotate : true;
			var slider = $('.featured-slider .bxslider').bxSlider({
				video: true,
				useCSS: false,
				auto: autoRotate,
				autoHover: true,
				speed: 500,
				randomStart: false,
				controls: false,
				mode: 'horizontal',
				onSlideBefore: function (slideElement, oldIndex, newIndex) {
					var prevSlide, videoPlayer;
					prevSlide = $('.featured-slider .bxslider li').eq(oldIndex + 1);
					prevSlide.removeClass('active');
					videoPlayer = prevSlide.find(".video-container");
					if (videoPlayer.length > 0) {
						videoPlayer.remove();
						slider.startAuto();
					}
				},
				onSlideAfter: function (slideElement, oldIndex, newIndex) {
					slideElement.addClass('active');
				}
			});
			$('.featured-slider .bxslider li a.video-link').click(function (e) {
				e.preventDefault();
				slider.stopAuto();
				var link, vimeoID, vimeoEmbed;
				link = $(this).attr("href");
				vimeoID = link.substr(link.lastIndexOf("/") + 1);
				vimeoEmbed = '<div class="video-container"><iframe src="http://player.vimeo.com/video/' + vimeoID + '?title=0&amp;byline=0&amp;portrait=0&amp;color=fff100&amp;autoplay=1" width="940" height="529" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
				// make sure video is not already embedded
				if ($(this).find(".video-container").length === 0)
					$(this).prepend(vimeoEmbed).fitVids();
			});
		},
		socialContentGridItemsInit: function () {
			var instagramUsername, facebookUsername;
			// add randomize function
			$.fn.randomize = function (selector) {
				var $elems = selector ? $(this).find(selector) : $(this).children(),
					$parents = $elems.parent();
				$parents.each(function () {
					$(this).children(selector).sort(function () {
						return Math.round(Math.random()) - 0.5;
					}).remove().appendTo(this);
				});
				return this;
			};
			// feeds/instagram/?username=libtechnologies&limit=5
			// get instagram username
			instagramUsername = $('.content-grid').attr('data-instagram');
			// grab instagram photos
			$.ajax({
				dataType: "json",
				url: '/feeds/instagram/?username=' + instagramUsername + '&limit=3',
				success: function (photosJSON) {
					var photosData = photosJSON.data;
					for (var i = 0; i < photosData.length; i++) {
						var photoData, listItem;
						photoData = photosData[i];
						// set up instagram list item
						listItem = '<li class="grid-item instagram item-' + i + '"><div class="grid-item-wrapper"><a href="' + photoData.link + '" target="_blank" class="item-link"><div class="item-copy"><p>' + photoData.caption.text + '</p></div><div class="item-image"><img src="' + photoData.images.low_resolution.url + '" /></div><div class="clearfix"></div></a></div></li>';
						// add list item to content grid
						$('.content-grid ul').append(listItem);
					}
					// randomize content grid
					$('.content-grid ul').randomize('li');
				}
			});
			// feeds/facebook/?username=libtech&limit=8
			// get facebook username
			facebookUsername = $('.content-grid').attr('data-facebook');
			// grab facebook posts
			$.ajax({
				dataType: "json",
				url: '/feeds/facebook/?username=' + facebookUsername + '&limit=6',
				success: function (postsJSON) {
					var postsData, totalItems;
					postsData = postsJSON.data;
					totalItems = 0;
					for (var i = 0; i < postsData.length; i++) {
						var postData, listItem;
						postData = postsData[i];
						if (postData.type != "status") {
							var postDate, monthArray, postImage, postMessage;
							// process date stamp
							postDate = postData.created_time;
							monthArray = {
								Jan: "January",
								Feb: "February",
								Mar: "March",
								Apr: "April",
								May: "May",
								Jun: "June",
								Jul: "July",
								Aug: "August",
								Sep: "September",
								Oct: "October",
								Nov: "November",
								Dec: "December"
							};
							postDate = String(new Date(postDate)).replace(
								/\w{3} (\w{3}) (\d{2}) (\d{4}) (\d{2}):(\d{2}):[^(]+\(([A-Z]{3})\)/,
								function ($0, $1, $2, $3, $4, $5, $6) {
									return monthArray[$1] + " " + $2 + ", " + $3; //+ " - " + $4%12 + ":" + $5 + ( + $4 > 12 ? "PM" : "AM") + " " + $6 hide time and date
								}
							);
							// get larger picture
							postImage = postData.picture;
							if (typeof postImage !== 'undefined') postImage = postImage.replace("_s", "_n");
							// get message
							postMessage = postData.message;
							if(typeof postMessage === 'undefined') postMessage = "";
							// set up facebook list item
							// only show posts with images
							if (typeof postImage !== 'undefined') {
								listItem = '<li class="grid-item facebook item-' + totalItems + '"><div class="grid-item-wrapper"><a href="' + postData.link + '" target="_blank" class="item-link"><div class="facebook-wrapper"><div class="facebook-header"><div class="facebook-profile"><img src="https://graph.facebook.com/' + facebookUsername + '/picture" /></div><p class="facebook-name">' + postData.from.name + '</p><p class="facebook-time">' + postDate + '</p><div class="clearfix"></div></div><div class="facebook-photo"><img src="' + postImage + '" /></div><p class="facebook-excerpt">' + postMessage + '</p></div><div class="facebook-aspect-ratio"><img src="' + LIBTECH.main.config.wpImgPath + 'square.gif" /></div><div class="clearfix"></div></a></div></li>';
								// add list item to content grid
								$('.content-grid ul').append(listItem);
								totalItems++;
							}
						}
						if (totalItems == "3")
							break;
					}
					// randomize content grid
					$('.content-grid ul').randomize('li');
				}
			});
		},
		filterList: function (productListing) {
			var filterArray = []; // set up array for recording filter options
			$('.product-filtering > li.filters').each(function () { // loop through each filter group
				if (filterArray.length < 1) { // first ul of filters have not been added yet, so lets do it
					$(this).find('ul > li[data-filter]').each(function () {
						var filterItem = $(this);
						if (filterItem.hasClass('selected')) {
							filterArray.push(filterItem.attr('data-filter')); // add filters to array to track
						}
					});
				} else { // first list of filters have been added, now build upon them
					var filterArrayTemp, filterSet;
					filterArrayTemp = []; // new array to update filterArray after it's built based on filterArray and new filters to concatinate
					$(this).find('ul > li[data-filter]').each(function () {
						var filterItem = $(this);
						if (filterItem.hasClass('selected')) {
							filterSet = true; // mark that we found another filter so we need to update the filterArray
							for (var i = 0; i < filterArray.length; i++) {
								filterArrayTemp.push(filterArray[i] + filterItem.attr('data-filter')); // concatinate current filters with new
							}
						}
					});
					if (filterSet === true) {
						filterArray = filterArrayTemp.slice(0); // update main array
					}
				}
			});
			// build filterList string
			filterList = ""; // default to no filter
			for (var i = 0; i < filterArray.length; i++) {
				if (i === 0) { // first item has no commas
					filterList = filterArray[i];
				} else {
					filterList += ", " + filterArray[i];
				}
			}
			// should look something like this - { filter: ".womens.Narrow, .youth.BTX" }
			// update hash history, this triggers the hash change event which will submit the filters
			if (filterArray.length > 0) {
				window.location.hash = 'filter=' + encodeURIComponent(filterList);
			} else {
				window.location.hash = 'all';
			}
		},
		galleryInit: function () {
			var gallerySlider, totalItems;
			// check for gallery
			if ($('.gallery')) {
				// determine total items in gallery
				totalItems = $('.gallery .gallery-thumbnails li').length;
				// set up gallery slider for thumbnails
				gallerySlider = $('.gallery .gallery-thumbnails').bxSlider({
					slideWidth: 100,
					minSlides: 2,
					maxSlides: 20,
					slideMargin: 10,
					controls: true,
					pager: false,
					mode: 'horizontal',
					moveSlides: 2,
					infiniteLoop: false,
					hideControlOnEnd: true,
					onSliderLoad: function (currentIndex) {
						var currentSlide = $('.gallery .gallery-thumbnails li').eq(currentIndex);
						loadGalleryImage(currentSlide.find('.gallery-icon a'));
					}
				});
				// assign click events to gallery thumbnails
				$('.gallery .gallery-thumbnails li .gallery-icon a').on('click.gallery', function (e) {
					e.preventDefault();
					e.stopPropagation(); // kill even from firing further
					loadGalleryImage($(this));
				});
				// assign click event to gallery viewer image, advance slideshow
				$('.gallery .gallery-viewer .gallery-viewer-image').on('click.galleryViewer', function (e) {
					e.preventDefault();
					e.stopPropagation();
					showNext();
				});
				$('.gallery .gallery-viewer .gallery-viewer-prev').on('click.galleryViewer', function (e) {
					showPrevious();
				});
				$('.gallery .gallery-viewer .gallery-viewer-next').on('click.galleryViewer', function (e) {
					showNext();
				});

				// assign keyboard events to gallery
				$(document).on('keyup.gallery', function (e) {
					var code, currentIndex, newIndex, slideIndex;
					// get the code
					code = (e.keyCode ? e.keyCode : e.which);
					// check which arrow key
					if (code == 39) {
						// right arrow
						showNext();
					} else if (code == 37) {
						// left arrow
						showPrevious();
					}
				});
				// resize gallery based on new image height, it's responsive
				$(window).on('resize.gallery', function () {
					var imgHeight = $('.gallery .gallery-viewer .gallery-viewer-image img').height();
					$('.gallery .gallery-viewer .gallery-viewer-image').clearQueue();
					$('.gallery .gallery-viewer .gallery-viewer-image').animate({
						height: imgHeight
					}, 500);
				});
			}
			function showNext() {
				var currentIndex, newIndex, maxSlideIndex;
				// find current item
				currentIndex = $('.gallery .gallery-thumbnails li .gallery-icon a.selected').parent().parent().index();
				// determine next index
				newIndex = currentIndex + 1;
				if (totalItems == newIndex) {
					newIndex = 0;
				}
				// select new image
				$('.gallery .gallery-thumbnails li').eq(newIndex).find('.gallery-icon a').click();
				// determine slider index
				slideIndex = Math.ceil((newIndex + 1) / 2) - 1;
				// determine max slide index you can advance to based on visible width of gallery
				maxSlideIndex = Math.floor(((110 * totalItems - 10) - $('.gallery').width()) / 220);
				// don't let slide index exceed max index based on browser width, we move 2 at a time
				if (slideIndex > maxSlideIndex) {
					slideIndex = maxSlideIndex;
				}
				// advance thumbnails to new slide index
				gallerySlider.goToSlide(slideIndex);
			}
			function showPrevious() {
				var currentIndex, newIndex, maxSlideIndex;
				// find current item
				currentIndex = $('.gallery .gallery-thumbnails li .gallery-icon a.selected').parent().parent().index();
				// determine next index
				newIndex = currentIndex - 1;
				if (newIndex < 0) {
					newIndex = totalItems - 1;
				}
				// select new image
				$('.gallery .gallery-thumbnails li').eq(newIndex).find('.gallery-icon a').click();
				// determine slider index
				slideIndex = Math.ceil((newIndex + 1) / 2) - 1;
				// determine max slide index you can advance to based on visible width of gallery
				maxSlideIndex = Math.floor(((110 * totalItems - 10) - $('.gallery').width()) / 220);
				// don't let slide index exceed max index based on browser width, we move 2 at a time
				if (slideIndex > maxSlideIndex) {
					slideIndex = maxSlideIndex;
				}
				// advance thumbnails to new slide index
				gallerySlider.goToSlide(slideIndex);
			}
			// gallery functionality to load new images
			function loadGalleryImage(imageLink) {
				var largeImage, largeImageCaption;
				// trigger loading image
				$(".gallery .gallery-viewer .gallery-viewer-image").addClass('loading');
				// set classes for selected image
				$('.gallery .gallery-thumbnails li .gallery-icon a').each(function () {
					$(this).removeClass('selected');
				});
				$(imageLink).addClass('selected');
				// get the image src
				largeImage = '<a href="' + $(imageLink).attr('href') + '" target="_blank"><img src="' + $(imageLink).attr('href') + '" /></a>';
				$('.gallery .gallery-viewer .gallery-viewer-image').html(largeImage);
				// get the image caption
				largeImageCaption = $(imageLink).parent().parent().find('.gallery-caption').html();
				if (largeImageCaption === undefined) {
					largeImageCaption = $(imageLink).find('img').attr('alt');
				}
				largeImageCaption = '<p>' + largeImageCaption + '</p>';
				$('.gallery .gallery-viewer .gallery-viewer-caption').html(largeImageCaption);
				// wait for load and set the correct height
				$(".gallery .gallery-viewer .gallery-viewer-image img").one('load', function () {
					var imgHeight = $('.gallery .gallery-viewer .gallery-viewer-image img').height();
					$('.gallery .gallery-viewer .gallery-viewer-image').stop().animate({
						height: imgHeight
					}, 500, function () {
						$(".gallery").trigger("galleryUpdate"); // let anything listening know the gallery has been updated
					});
					$(".gallery").trigger("galleryUpdate"); // let anything listening know the gallery has been updated
					// gallery load complete
					$(".gallery .gallery-viewer .gallery-viewer-image").removeClass('loading');
				}).each(function () {
					if (this.complete) $(this).load();
				});
			}
		}
	}
};