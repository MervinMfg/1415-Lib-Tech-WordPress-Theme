/*
 * Lib Tech - http://lib-tech.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var LIBTECH = LIBTECH || {};

LIBTECH.main = {
	config: {
		wpImgPath: 'http://cdn.lib-tech.com/wp-content/themes/1415-Lib-Tech-WordPress-Theme/_/img/',
		shop: null,
		regionSelector: null
	},
	init: function () {
		var self, $body, shop, regionSelector;
		self = this;
		$body = $('body');
		// init global compontents
		self.config.shop = new LIBTECH.Shop(); // init shopatron JS
		self.config.regionSelector = new LIBTECH.RegionSelector(); // init the region selector
		self.sportCookieInit(); // init/check the sport cookie
		new LIBTECH.Search(); // init header search bar
		$(window).load(function () {
			new LIBTECH.MainMenu(); // init main menu
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
		} else if ($body.hasClass('page-template-page-templatesenvironmental-php')) {
			self.environmentalInit();
		} else if ($body.hasClass('page-template-page-templatespage-environmental-detail-php')) {
			self.environmentalDetailInit();
		} else if ($body.hasClass('page-template-team-sport-overview')) {
			self.teamOverviewInit();
		} else if ($body.hasClass('single-libtech_team_snow') || $body.hasClass('single-libtech_team_nas') || $body.hasClass('single-libtech_team_surf') || $body.hasClass('single-libtech_team_skate')) {
			self.teamDetailsInit();
		} else if ($body.hasClass('blog') || $body.hasClass('search') || $body.hasClass('archive') || $body.hasClass('error404')) {
			self.blogInit();
		} else if ($body.hasClass('single-post')) {
			self.blogInit();
			self.blogSingleInit();
		} else if ($body.hasClass('page-template-faqs')) {
			self.faqInit();
		} else if ($body.hasClass('page-template-page-templatessnowboard-builder-php') || $body.hasClass('page-template-page-templatessnowboard-builder-share-php')) {
			self.snowboardBuilderInit();
		} else if ($body.hasClass('page-template-page-templatespage-partners-php')) {
			self.partnersInit();
		} else if ($body.hasClass('page-template-page-templatespage-surfboard-fins-php')) {
			self.finsInit();
		} else if ($body.hasClass('page-template-page-templatespage-lbs-php')) {
			self.lbsInit();
		} else if ($body.hasClass('page-template-page-templatespage-pass-it-on-project-php')) {
			self.passItOnInit();
		} else if ($body.hasClass('page-template-lib-legs')) {
			self.libLegsInit();
		} else if ($body.hasClass('page-template-page-templatesstorm-factory-php')) {
			self.stormFactoryInit();
		} else if ($body.hasClass('page-template-page-templatesdttd-php')) {
			self.dttdInit();
		} else if ($body.hasClass('page-template-page-templatesboard-finder-php')) {
			self.boardFinderInit();
		} else if ($body.hasClass('page-template-page-templatesjamie-lynn-collection-php')) {
			self.jamieLynnCollectionInit();
		}
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
	homeInit: function () {
		new LIBTECH.FeaturedSlider();
		new LIBTECH.StorySlider();
		new LIBTECH.Instagram();
	},
	homeSportInit: function () {
		var $teamCta = $('.home-sport-team .call-to-action .button');
		// set up large featured images/videos
		new LIBTECH.FeaturedSlider();
		// setup product slider
		new LIBTECH.ProductSlider();
		// render instagram
		new LIBTECH.Instagram();
		if($teamCta.length !== 0) {
			$teamCta.on('click.team', function (e) {
				e.preventDefault();
				$('.home-sport-team').toggleClass('expand');
				$(this).off('click.team');
				$(window).trigger('scroll');
			});
		}
		// lazy load sport team photos
		$(".home-sport-team .home-sport-team-item img.lazy").unveil(0, function() {
			$(this).on('load', function () {
				$(this).addClass('loaded');
				$(this).off('load');
			});
		});
	},
	productOverviewInit: function () {
		new LIBTECH.ProductOverview();
	},
	productDetailInit: function () {
		new LIBTECH.ProductDetails();
	},
	technologyDetailInit: function () {
		var self = this;
		// make video fit within target
		$('.video-header.video .video-player').fitVids();
		$('.tech-major .tech-video').fitVids();
		new LIBTECH.FAQ();
	},
	environmentalInit: function () {
		$(".enviro-video").fitVids();
	},
	environmentalDetailInit: function () {
		var self = this;
		// make video fit within target
		$('.video-header.video .video-player').fitVids();
		new LIBTECH.FAQ();
	},
	blogInit: function () {
		var fblikes, postUrl;
		// CATEGORY TREE VIEW ON BLOG PAGES
		$(".widget_mycategoryorder ul").treeview({
			persist: "location",
			collapsed: true,
			unique: false,
			animated: "fast"
		});
		$('.post-title').each(function () {
			if (!$('html').hasClass('ie-lt9')) {
				$clamp(this, {clamp: '3', splitOnChars: ['.', ',', ' ']});
			}
		});
	},
	blogSingleInit: function () {
		new LIBTECH.BlogSingle();
	},
	faqInit: function () {
		new LIBTECH.FAQ();
	},
	snowboardBuilderInit: function () {
		new LIBTECH.SnowboardBuilder();
	},
	teamOverviewInit: function () {
		// make video fit within target
		$('.video-header.video .video-player').fitVids();
	},
	teamDetailsInit: function () {
		// init instagram
		new LIBTECH.Instagram();
		// init gallery
		if ($('.gallery')) {
			new LIBTECH.Gallery();
		}
		// init featured videos
		new LIBTECH.FeaturedVideos();
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
	finsInit: function () {
		// init fin positioning slideshow
		$('.fins-adjusting .fins-positioning').bxSlider({
			mode: 'fade',
			auto: true,
			controls: false,
			pause: 3000,
			autoHover: false
		});
		// init faqs
		new LIBTECH.FAQ();
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
		$('.video-header .video-player').fitVids();
		// set up large featured images/videos
		new LIBTECH.FeaturedSlider(false);
		// setup product slider
		new LIBTECH.ProductSlider();
	},
	stormFactoryInit: function () {
		// set up large featured images/videos
		new LIBTECH.FeaturedSlider();
		// setup product slider
		new LIBTECH.ProductSlider();
	},
	dttdInit: function () {
		$('.dttd-video .video-player').fitVids();
		// set up large featured images/videos
		new LIBTECH.FeaturedSlider(false);
	},
	boardFinderInit: function () {
		new LIBTECH.BoardFinder();
	},
	jamieLynnCollectionInit: function () {
		// set up large featured images/videos
		new LIBTECH.FeaturedSlider(false);
		// init product overview code
		new LIBTECH.ProductOverview();
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
		pageScroll: function (hash, duration, updateLocation) {
			var yPosition;
			// check duration
			if (typeof duration === 'undefined') {
				duration = 1;
			}
			if (typeof updateLocation === 'undefined') {
				updateLocation = true;
			}
			// Smooth Page Scrolling, update hash on complete of animation
			yPosition = $(hash).offset().top;
			TweenMax.to(window, duration, {scrollTo:{y: yPosition, x: 0}, onComplete: function () { if (updateLocation) window.location = hash; }});
		},
		responsiveCheck: function() {
			var size;
			if ( $('.responsive-check .breakpoint-small').css('display') == 'block' ) {
				size = 'small';
			} else if ( $('.responsive-check .breakpoint-medium').css('display') == 'block' ) {
				size = 'medium';
			} else if ( $('.responsive-check .breakpoint-large').css('display') == 'block' ) {
				size = 'large';
			} else {
				size = 'base';
			}
			return size;
		}
	}
};
