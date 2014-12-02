/*
 * Lib Tech - http://lib-tech.com
 * Author: brian.behrens@mervin.com & tony.keller@mervin.com - http://www.mervin.com
 */

var LIBTECH = LIBTECH || {};

LIBTECH.JamieLynn = {
	config: {
		scrollController: null
	},
	init: function () {
		var self;
		self = this;
		// resize video, fill div
		$(window).resize(function() {
			self.recalculateFills();
		});
		self.recalculateFills();
		// nav selection
		$('.navigation li a').on('click', function (e) {
			e.preventDefault();

			$('.navigation li a').removeClass('active');
			$(this).addClass('active');

			var url = $(this).attr('href');
			self.utilities.pageScroll(url, 1);
		});
		self.config.scrollController = new ScrollMagic({ vertical: true });
		self.scrollingInit();

		self.captionsInit();

		self.galleryInit();
	},
	scrollingInit: function () {
		var self = this;

		/*if (typeof self.config.scene !== 'undefined') {
			self.config.scrollController.removeScene(self.config.scene);
		}
		// fix intro photos for 2 full windows
		new ScrollScene({triggerElement: ".then-photo", offset: $(window).innerHeight() / 2, duration: $(window).innerHeight() * 2 }).setPin(".then-photo").setClassToggle(".now-photo", 'fixed-photo').addTo(self.config.scrollController);
		// fade then photo in over the course of 1 window
		tween = new TweenMax.from('.now-photo', 0.5, {opacity: 0, ease: Linear.easeNone});
		new ScrollScene({triggerElement: ".then-photo", offset: $(window).innerHeight() / 2, duration: $(window).innerHeight() }).setTween(tween).addTo(self.config.scrollController);
		// fix video below intro quote
		new ScrollScene({triggerElement: "#intro", offset: $(window).height()/2, duration: $(window).innerHeight()*2}).setClassToggle("#jamie-video .video-item", 'fixed-video').addTo(self.config.scrollController);
		// fix method quote at top of window
		new ScrollScene({triggerElement: "#method", offset: $(window).innerHeight() / 2, duration: $(window).innerHeight() * 2}).setPin("#method", {pushFollowers: false}).addTo(self.config.scrollController);
		// fix method photo
		new ScrollScene({triggerElement: ".method-photo", offset: $(window).innerHeight() / 2, duration: $(window).innerHeight()}).setPin(".method-photo", {pushFollowers: false}).addTo(self.config.scrollController);
		// fix style quote at top of window
		new ScrollScene({triggerElement: "#style", offset: $(window).innerHeight() / 2, duration: $(window).innerHeight() * 2}).setPin("#style", {pushFollowers: false}).addTo(self.config.scrollController);
		// fix style photo at top of window
		new ScrollScene({triggerElement: ".style-photo", offset: $(window).innerHeight() / 2, duration: $(window).innerHeight() * 2}).setPin(".style-photo", {pushFollowers: false}).addTo(self.config.scrollController);
		// fix art quote at top of window
		new ScrollScene({triggerElement: "#art", offset: $(window).innerHeight() / 2, duration: $(window).innerHeight() * 2}).setPin("#art", {pushFollowers: false}).addTo(self.config.scrollController);*/
		// new ScrollScene({triggerElement: ".now-photo", offset: $(window).height() /2 }).setPin(".now-photo").addTo(self.config.scrollController);
		/*
		tween = new TweenMax.to('.follow', 1, {backgroundPosition: "50% 30%", ease: Linear.easeNone});
		self.config.scene = new ScrollScene({triggerElement: '.follow', offset: $(window).height()/2*-1, duration: $('.follow').outerHeight() + $('.site-footer').outerHeight()}).setTween(tween).addTo(self.config.scrollController);

		if ($('html').hasClass('ie-lt9') !== true) {
			navOffset = Math.floor($(window).height() / 2) - ($('.site-header').outerHeight() + $('.site-header').position().top) + 1;
			self.config.scene = new ScrollScene({triggerElement: ".product-navigation", offset: navOffset}).setPin(".product-navigation").addTo(self.config.scrollController);
		}*/
	},
	captionsInit: function () {
		// if touch, do on click. if not, do on hover
		if ($('html').hasClass('touch')) {
			$('.section-photo .caption .caption-icon').on('click', function (e) {
				$(this).parent().toggleClass('active');
			});
		} else {
			$('.section-photo .caption .caption-icon').on('mouseenter', function (e) {
				$(this).parent().addClass('active');
			}).on('mouseleave', function () {
				$(this).parent().removeClass('active');
			});
		}
	},
	galleryInit: function () {
		var gallery = $(".section-gallery .gallery-wrapper").owlCarousel({
			items: 1,
			dots: false,
			nav: true,
			navText: ['<','>'],
			lazyLoad: true,
			autoplay: false,
			autoplayTimeout: 8000,
			autoplayHoverPause: true,
			loop: true
		});
	},
	recalculateFills: function () {
		var self, browserHeight, browserWidth, fills;
		self = this;
		//get pixel size of browser window.
		browserHeight = Math.round($(window).height());
		browserWidth = Math.round($(window).width());
		//jquery all items on page with fill tag
		fills = $('.fill');
		//for each fill, recalculate size and position and apply using jQuery
		fills.each(function () {
			var videoHeight, videoWidth, new_size;
			//height of element. not neccessarily video
			videoHeight = $(this).height();
			videoWidth = $(this).width();
			//calculate new size
			new_size = self.fullBleed(browserWidth, browserHeight, videoWidth, videoHeight);
			//distance from top and left is half of the difference between the browser width and the size of the element
			$(this)
			    .width(new_size.width)
			    .height(new_size.height)
				.css("margin-left", ((browserWidth - new_size.width)/2))
				.css("margin-top", ((browserHeight - new_size.height)/2));
				
		});
	},
	fullBleed: function (boxWidth, boxHeight, imgWidth, imgHeight) {
		// Calculate new height and width...
		var initW = imgWidth;
		var initH = imgHeight;
		var ratio = initH / initW;
		imgWidth = boxWidth;
		imgHeight = boxWidth * ratio;
		// If the video is not the right height, then make it so...     	
		if(imgHeight < boxHeight){
			imgHeight = boxHeight;
			imgWidth = imgHeight / ratio;
		}
		//  Return new size for video
		return {
			width: imgWidth + 16,
			height: imgHeight + 9
		};
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
	}
};