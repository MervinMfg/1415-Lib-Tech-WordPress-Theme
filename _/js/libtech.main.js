/*
 * Lib Tech - http://lib-tech.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var LIBTECH = LIBTECH || {};

LIBTECH.main = {
	config: {
		menuState: 'closed',
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
		} else if ($body.hasClass('page-template-page-templatesenvironmental-php')) {
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
		} else if ($body.hasClass('page-template-page-templatessnowboard-builder-php')) {
			LIBTECH.snowboardbuilder.init();
		} else if ($body.hasClass('page-template-page-templatessnowboard-builder-share-php')) {
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
		} else if ($body.hasClass('page-template-page-templatesdttd-php')) {
			self.dttdInit();
		} else if ($body.hasClass('page-template-page-templatesjamie-lynn-collection-php')) {
			self.jamieLynnCollectionInit();
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
		// render social content grid
		new LIBTECH.ContentGrid();
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
			new LIBTECH.Gallery();
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
		// render social content grid
		new LIBTECH.ContentGrid();
		// init gallery
		if ($('.gallery')) {
			new LIBTECH.Gallery();
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
	dttdInit: function () {
		var self = this;
		$('.dttd-video .video-player').fitVids();
		// set up large featured images/videos
		self.utilities.featuredSliderInit(false);
	},
	jamieLynnCollectionInit: function () {
		var self = this;
		// set up large featured images/videos
		self.utilities.featuredSliderInit(false);
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
		}
	}
};