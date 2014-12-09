/*
 * Lib Tech - http://lib-tech.com
 * Author: brian.behrens@mervin.com & tony.keller@mervin.com - http://www.mervin.com
 */

var LIBTECH = LIBTECH || {};

LIBTECH.JamieLynn = {
	config: {
		scrollController: null,
		signatureScene: null,
		sectionsScene: null,
		navScene1: null,
		navScene2: null,
		navScene3: null,
		navScene4: null,
		navScene5: null,
		navScene6: null,
		navScene7: null,
		navScene8: null,
		navScene9: null,
		navScene10: null,
		navScene11: null,
		responsiveSize: null
	},
	init: function () {
		var self = this;
		self.config.scrollController = new ScrollMagic({ vertical: true });
		self.loadingInit();
		self.scrollingInit();
		self.captionsInit();
		self.galleryInit();
		self.shareInit();
		$(window).on('load', function () {
			self.navigationInit();
			self.videoInit();
		});
		// call scroll again on resize
		$(window).on('resize', function () {
			self.scrollingInit();
			self.navigationInit();
			// resize video
			self.recalculateFills();
		});
		// resize looped video
		self.recalculateFills();
	},
	loadingInit: function () {
		var self = this;
		// preload images
		if(self.utilities.responsiveCheck() == "medium" || self.utilities.responsiveCheck() == "large") {
			// preload lazy load images in gallery
			$( ".section-gallery .gallery-item .gallery-image img" ).each(function( index ) {
				var galleryImage = new Image();
				galleryImage.src = $(this).attr('data-src');
			});
		}
		// hide preloader when site load complete
		$(window).on('load', function () {
			$(this).scrollTop(0);
			TweenMax.to($('.jamie-lynn .loading'), 1, {opacity: 0, display: 'none'});
		});
	},
	navigationInit: function () {
		var self = this;
		$('.navigation li a').off('click.navigation');
		// nav selection
		$('.navigation li a').on('click.navigation', function (e) {
			var url, currentScrollY, totalHeight, scrollY, scrollPercentage, scrollDuration, windowHeight;
			e.preventDefault();
			$('.navigation li a').removeClass('active');
			$(this).addClass('active').blur();
			url = $(this).attr('href');
			currentScrollY = $(window).scrollTop();
			totalHeight = $(document).height();
			// check browsers size and scroll appropriately
			if(self.utilities.responsiveCheck() == "large") {
				switch (url) {
					case '#legacy':
						scrollY = 0;
						break;
					case '#intro':
						scrollY = totalHeight * 0.075;
						break;
					case '#film':
						scrollY = totalHeight * 0.105;
						break;
					case '#method':
						scrollY = totalHeight * 0.175;
						break;
					case '#style':
						scrollY = totalHeight * 0.270;
						break;
					case '#passion':
						scrollY = totalHeight * 0.360;
						break;
					case '#inspiration':
						scrollY = totalHeight * 0.455;
						break;
					case '#music':
						scrollY = totalHeight * 0.547;
						break;
					case '#steady':
						scrollY = totalHeight * 0.643;
						break;
					case '#creativity':
						scrollY = totalHeight * 0.738;
						break;
					case '#products':
						scrollY = totalHeight * 0.8240;
						break;
				}
				if (currentScrollY < scrollY) {
					scrollPercentage = (scrollY - currentScrollY) / totalHeight;
				} else {
					scrollPercentage = (currentScrollY - scrollY) / totalHeight;
				}
				scrollDuration = scrollPercentage * 10;
				TweenMax.to(window, scrollDuration, {scrollTo:{y: scrollY, x: 0}, onComplete: function () { window.location = url; }});
			} else {
				scrollY = $(url).offset().top;
				if (currentScrollY < scrollY) {
					scrollPercentage = (scrollY - currentScrollY) / totalHeight;
				} else {
					scrollPercentage = (currentScrollY - scrollY) / totalHeight;
				}
				scrollDuration = scrollPercentage * 5;
				TweenMax.to(window, scrollDuration, {scrollTo:{y: scrollY, x: 0}, onComplete: function () { window.location = url; }});
			}
		});
		windowHeight = $(window).height();
		// reset old navigation scenes
		if (typeof self.config.navScene1 !== 'undefined') {
			self.config.scrollController.removeScene(self.config.navScene1);
			self.config.scrollController.removeScene(self.config.navScene2);
			self.config.scrollController.removeScene(self.config.navScene3);
			self.config.scrollController.removeScene(self.config.navScene4);
			self.config.scrollController.removeScene(self.config.navScene5);
			self.config.scrollController.removeScene(self.config.navScene6);
			self.config.scrollController.removeScene(self.config.navScene7);
			self.config.scrollController.removeScene(self.config.navScene8);
			self.config.scrollController.removeScene(self.config.navScene9);
			self.config.scrollController.removeScene(self.config.navScene10);
			self.config.scrollController.removeScene(self.config.navScene11);
		}
		if(self.utilities.responsiveCheck() == "large") {
			self.config.navScene1 = new ScrollScene({duration: windowHeight})
				.setClassToggle($(".navigation .legacy a"), "active")
				.addTo(self.config.scrollController);
			self.config.navScene2 = new ScrollScene({offset: windowHeight, duration: windowHeight})
				.setClassToggle($(".navigation .intro a"), "active")
				.addTo(self.config.scrollController);
			self.config.navScene3 = new ScrollScene({offset: windowHeight*2, duration: windowHeight})
				.setClassToggle($(".navigation .film a"), "active")
				.addTo(self.config.scrollController);
			self.config.navScene4 = new ScrollScene({offset: windowHeight*3, duration: windowHeight*2})
				.setClassToggle($(".navigation .method a"), "active")
				.addTo(self.config.scrollController);
			self.config.navScene5 = new ScrollScene({offset: windowHeight*5, duration: windowHeight*2})
				.setClassToggle($(".navigation .style a"), "active")
				.addTo(self.config.scrollController);
			self.config.navScene6 = new ScrollScene({offset: windowHeight*7, duration: windowHeight*2})
				.setClassToggle($(".navigation .passion a"), "active")
				.addTo(self.config.scrollController);
			self.config.navScene7 = new ScrollScene({offset: windowHeight*9, duration: windowHeight*2})
				.setClassToggle($(".navigation .inspiration a"), "active")
				.addTo(self.config.scrollController);
			self.config.navScene8 = new ScrollScene({offset: windowHeight*11, duration: windowHeight*2})
				.setClassToggle($(".navigation .music a"), "active")
				.addTo(self.config.scrollController);
			self.config.navScene9 = new ScrollScene({offset: windowHeight*13, duration: windowHeight*2})
				.setClassToggle($(".navigation .steady a"), "active")
				.addTo(self.config.scrollController);
			self.config.navScene10 = new ScrollScene({offset: windowHeight*15, duration: windowHeight*2})
				.setClassToggle($(".navigation .creativity a"), "active")
				.addTo(self.config.scrollController);
			self.config.navScene11 = new ScrollScene({offset: windowHeight*17, duration: $('#products').height()})
				.setClassToggle($(".navigation .products a"), "active")
				.addTo(self.config.scrollController);
		}
	},
	scrollingInit: function () {
		var self, $signatureName, $signatureDot, pageHeight, signatureTween, sectionsTween;
		self = this;
		// prepare path for animation
		function pathPrepare ($el) {
			var lineLength = $el[0].getTotalLength();
			$el.css("stroke-dasharray", lineLength);
			$el.css("stroke-dashoffset", lineLength);
		}
		// if we're large or bigger, do the scroll
		if ( self.utilities.responsiveCheck() == "large" ) {
			self.config.responsiveSize = "large";
			// if scene already exists, remove it
			if (typeof self.config.signatureScene !== 'undefined') {
				self.config.scrollController.removeScene(self.config.signatureScene);
			}
			if (typeof self.config.sectionsScene !== 'undefined') {
				self.config.scrollController.removeScene(self.config.sectionsScene);
			}
			// RESET DOM ELEMENTS
			TweenMax.killAll();
			$('path.signature-name').removeAttr('style');
			$('path.signature-dot').removeAttr('style');
			$('.jamie-lynn').removeClass('scroll-animation');
			$('.jamie-lynn').removeAttr('style');
			$('.jamie-lynn .section-photo').removeAttr('style');
			$('.jamie-lynn .section-video').removeAttr('style');
			$('.jamie-lynn .section-gallery').removeAttr('style');
			$('.jamie-lynn .section-share').removeAttr('style');
			$('.jamie-lynn .section-products').removeAttr('style');
			$('.jamie-lynn .section-quote').removeAttr('style');
			$('.jamie-lynn .section-quote .quote-wrapper').removeAttr('style');
			$('.jamie-lynn .section-quote .quote-wrapper .quote-text').removeAttr('style');
			$('.jamie-lynn .section-quote .quote-wrapper .hand-written').removeAttr('style');
			$('.jamie-lynn .section-quote .quote-wrapper blockquote').removeAttr('style');
			$('#share .share-details .share-links').removeAttr('style');
			$('#share .share-details .hashtag').removeAttr('style');
			$('#tradition-photo .tradition-message .part-1').removeAttr('style');
			$('#tradition-photo .tradition-message .part-2').removeAttr('style');
			$('#tradition-photo .tradition-message .part-3').removeAttr('style');
			// if not ie8 or less, run fixed scroll code
			if ($('html').hasClass('ie-lt9') !== true) {}
			// JAMIE SIGNATURE SCROLL ANIMATION
			$signatureName = $("path.signature-name");
			$signatureDot = $("path.signature-dot");
			// prepare SVG
			pathPrepare($signatureName);
			pathPrepare($signatureDot);
			// build tween
			signatureTween = new TimelineMax()
				.add(TweenMax.to($signatureName, 0.9, {strokeDashoffset: 0, ease:Linear.easeNone}))
				.add(TweenMax.to($signatureDot, 0.1, {strokeDashoffset: 0, ease:Linear.easeNone}));
			// build scene
			self.config.signatureScene = new ScrollScene({triggerElement: "#share", offset: $(window).height()/4, duration: $(window).height()/4, tweenChanges: true})
				.setTween(signatureTween)
				.addTo(self.config.scrollController);
			// JAMIE SCROLLING SECTIONS
			$('.jamie-lynn').addClass('scroll-animation');
			// add browser height for 21 sections
			pageHeight = $(window).height() * $('.jamie-lynn section').length;
			$('.jamie-lynn').height(pageHeight);
			sectionsTween = new TimelineMax()
				.add(TweenMax.to($('#legacy-now'), 2, {opacity: 1, display: 'block', delay: 0.2})) // draw word for 0.9
				.add(TweenMax.to($('#intro'), 1, {top: '0%', delay: 4}))
				.add(TweenMax.from($('#intro .quote-wrapper .quote-text'), 1, {opacity: 0, delay: -0.5}))
				.add(TweenMax.from($('#intro .quote-wrapper .hand-written'), 1, {opacity: 0, delay: -0.5}))
				.add(TweenMax.from($('#intro .quote-wrapper .quote-text'), 4, {y: '40px', delay: -2}))
				.add(TweenMax.from($('#intro .quote-wrapper .hand-written'), 4, {y: '80px', delay: -4}))
				.add(TweenMax.to($('#legacy'), 0.01, {display: 'none', delay: -0.2}))
				.add(TweenMax.to($('#legacy-now'), 0.01, {display: 'none', delay: -0.2}))
				.add(TweenMax.to($('#film'), 0.1, {display: 'block', delay: -0.2}))
				.add(TweenMax.to($('#intro'), 1, {top: '-100%', delay: -0.2}))
				.add(TweenMax.to($('#method'), 1, {top: '0%', delay: 4}))
				.add(TweenMax.from($('#method .quote-wrapper'), 1, {opacity: 0, delay: -1}))
				.add(TweenMax.from($('#method .quote-wrapper .quote-text'), 1, {opacity: 0, delay: -0.5}))
				.add(TweenMax.from($('#method .quote-wrapper .hand-written'), 1, {opacity: 0, delay: -0.5}))
				.add(TweenMax.from($('#method .quote-wrapper blockquote'), 4, {backgroundPosition: "0 80px", delay: -1}))
				.add(TweenMax.from($('#method .quote-wrapper .quote-text'), 4, {y: '40px', delay: -4}))
				.add(TweenMax.from($('#method .quote-wrapper .hand-written'), 4, {y: '80px', delay: -4}))
				.add(TweenMax.to($('#film'), 0.01, {display: 'none', delay: -0.2}))
				.add(TweenMax.to($('#method-photo'), 0.01, {display: 'block', delay: -0.2}))
				.add(TweenMax.to($('#method'), 1, {top: '-100%', delay: -0.2}))
				.add(TweenMax.to($('#style'), 1, {top: '0%', delay: 4}))
				.add(TweenMax.from($('#style .quote-wrapper'), 1, {opacity: 0, delay: -1}))
				.add(TweenMax.from($('#style .quote-wrapper .quote-text'), 1, {opacity: 0, delay: -0.5}))
				.add(TweenMax.from($('#style .quote-wrapper .hand-written'), 1, {opacity: 0, delay: -0.5}))
				.add(TweenMax.from($('#style .quote-wrapper blockquote'), 4, {backgroundPosition: "0 80px", delay: -1}))
				.add(TweenMax.from($('#style .quote-wrapper .quote-text'), 4, {y: '40px', delay: -4}))
				.add(TweenMax.from($('#style .quote-wrapper .hand-written'), 4, {y: '80px', delay: -4}))
				.add(TweenMax.to($('#method-photo'), 0.01, {display: 'none', delay: -0.2}))
				.add(TweenMax.to($('#style-photo'), 0.01, {display: 'block', delay: -0.2}))
				.add(TweenMax.to($('#style'), 1, {top: '-100%', delay: -0.2}))
				.add(TweenMax.to($('#passion'), 1, {top: '0%', delay: 4}))
				.add(TweenMax.from($('#passion .quote-wrapper'), 1, {opacity: 0, delay: -1}))
				.add(TweenMax.from($('#passion .quote-wrapper .quote-text'), 1, {opacity: 0, delay: -0.5}))
				.add(TweenMax.from($('#passion .quote-wrapper .hand-written'), 1, {opacity: 0, delay: -0.5}))
				.add(TweenMax.from($('#passion .quote-wrapper blockquote'), 4, {backgroundPosition: "0 80px", delay: -1}))
				.add(TweenMax.from($('#passion .quote-wrapper .quote-text'), 4, {y: '40px', delay: -4}))
				.add(TweenMax.from($('#passion .quote-wrapper .hand-written'), 4, {y: '80px', delay: -4}))
				.add(TweenMax.to($('#style-photo'), 0.01, {display: 'none', delay: -0.2}))
				.add(TweenMax.to($('#passion-photo'), 0.01, {display: 'block', delay: -0.2}))
				.add(TweenMax.to($('#passion'), 1, {top: '-100%', delay: -0.2}))
				.add(TweenMax.to($('#inspiration'), 1, {top: '0%', delay: 4}))
				.add(TweenMax.from($('#inspiration .quote-wrapper'), 1, {opacity: 0, delay: -1}))
				.add(TweenMax.from($('#inspiration .quote-wrapper .quote-text'), 1, {opacity: 0, delay: -0.5}))
				.add(TweenMax.from($('#inspiration .quote-wrapper .hand-written'), 1, {opacity: 0, delay: -0.5}))
				.add(TweenMax.from($('#inspiration .quote-wrapper blockquote'), 4, {backgroundPosition: "0 80px", delay: -1}))
				.add(TweenMax.from($('#inspiration .quote-wrapper .quote-text'), 4, {y: '40px', delay: -4}))
				.add(TweenMax.from($('#inspiration .quote-wrapper .hand-written'), 4, {y: '80px', delay: -4}))
				.add(TweenMax.to($('#passion-photo'), 0.1, {display: 'none', delay: -0.2}))
				.add(TweenMax.to($('#inspiration-photo'), 0.1, {display: 'block', delay: -0.2}))
				.add(TweenMax.to($('#inspiration'), 1, {top: '-100%', delay: -0.2}))
				.add(TweenMax.to($('#music'), 1, {top: '0%', delay: 4}))
				.add(TweenMax.from($('#music .quote-wrapper'), 1, {opacity: 0, delay: -1}))
				.add(TweenMax.from($('#music .quote-wrapper .quote-text'), 1, {opacity: 0, delay: -0.5}))
				.add(TweenMax.from($('#music .quote-wrapper .hand-written'), 1, {opacity: 0, delay: -0.5}))
				.add(TweenMax.from($('#music .quote-wrapper blockquote'), 4, {backgroundPosition: "0 80px", delay: -1}))
				.add(TweenMax.from($('#music .quote-wrapper .quote-text'), 4, {y: '40px', delay: -4}))
				.add(TweenMax.from($('#music .quote-wrapper .hand-written'), 4, {y: '80px', delay: -4}))
				.add(TweenMax.to($('#inspiration-photo'), 0.1, {display: 'none', delay: -0.2}))
				.add(TweenMax.to($('#music-photo'), 0.1, {display: 'block', delay: -0.2}))
				.add(TweenMax.to($('#music'), 1, {top: '-100%', delay: -0.2}))
				.add(TweenMax.to($('#steady'), 1, {top: '0%', delay: 4}))
				.add(TweenMax.from($('#steady .quote-wrapper'), 1, {opacity: 0, delay: -1}))
				.add(TweenMax.from($('#steady .quote-wrapper .quote-text'), 1, {opacity: 0, delay: -0.5}))
				.add(TweenMax.from($('#steady .quote-wrapper .hand-written'), 1, {opacity: 0, delay: -0.5}))
				.add(TweenMax.from($('#steady .quote-wrapper blockquote'), 4, {backgroundPosition: "0 80px", delay: -1}))
				.add(TweenMax.from($('#steady .quote-wrapper .quote-text'), 4, {y: '40px', delay: -4}))
				.add(TweenMax.from($('#steady .quote-wrapper .hand-written'), 4, {y: '80px', delay: -4}))
				.add(TweenMax.to($('#music-photo'), 0.01, {display: 'none', delay: -0.2}))
				.add(TweenMax.to($('#steady-photo'), 0.01, {display: 'block', delay: -0.2}))
				.add(TweenMax.to($('#steady'), 1, {top: '-100%', delay: -0.2}))
				.add(TweenMax.to($('#creativity'), 1, {top: '0%', delay: 4}))
				.add(TweenMax.from($('#creativity .quote-wrapper'), 1, {opacity: 0, delay: -1}))
				.add(TweenMax.from($('#creativity .quote-wrapper .quote-text'), 1, {opacity: 0, delay: -0.5}))
				.add(TweenMax.from($('#creativity .quote-wrapper .hand-written'), 1, {opacity: 0, delay: -0.5}))
				.add(TweenMax.from($('#creativity .quote-wrapper blockquote'), 4, {backgroundPosition: "0 80px", delay: -1}))
				.add(TweenMax.from($('#creativity .quote-wrapper .quote-text'), 4, {y: '40px', delay: -4}))
				.add(TweenMax.from($('#creativity .quote-wrapper .hand-written'), 4, {y: '80px', delay: -4}))
				.add(TweenMax.to($('#steady-photo'), 0.01, {display: 'none', delay: -1}))
				.add(TweenMax.to($('#gallery'), 0.01, {display: 'block', delay: -1}))
				.add(TweenMax.to($('#creativity'), 1, {top: '-100%', delay: -0.2}))
				.add(TweenMax.to($('#gallery'), 4, {top: '-100%', delay: 4}))
				.add(TweenMax.to($('#products'), 4, {bottom: '0%', delay: -4}))
				.add(TweenMax.to($('#share'), 1, {top: '0%', delay: 4}))
				.add(TweenMax.from($('#share .share-details .share-links'), 1, {y: '40px', opacity: 0}))
				.add(TweenMax.from($('#share .share-details .hashtag'), 1, {y: '80px', opacity: 0, delay: -0.5}))
				.add(TweenMax.to($('#products'), 0.1, {display: 'none', delay: -0.2}))
				.add(TweenMax.to($('#tradition-photo'), 0.1, {display: 'block', delay: -0.2}))
				.add(TweenMax.to($('#share'), 1, {top: '-100%', delay: 3}))
				.add(TweenMax.from($('#tradition-photo .tradition-message .part-1'), 1, {y: '40px', opacity: 0, delay: -0.5}))
				.add(TweenMax.from($('#tradition-photo .tradition-message .part-2'), 1, {y: '80px', opacity: 0, delay: -0.5}))
				.add(TweenMax.from($('#tradition-photo .tradition-message .part-3'), 1, {y: '80px', opacity: 0, delay: -0.5}));
			// build scene
			self.config.sectionsScene = new ScrollScene({triggerElement: ".jamie-lynn", offset: $(window).height()/2, duration: $('.scroll-animation').height() - $(window).height()})
				.setTween(sectionsTween)
				.addTo(self.config.scrollController);
		} else if (self.config.responsiveSize != "other" && self.utilities.responsiveCheck() != "large") {
			self.config.responsiveSize = "other";
			// if scene already exists, remove it
			if (typeof self.config.signatureScene !== 'undefined') {
				self.config.scrollController.removeScene(self.config.signatureScene);
			}
			if (typeof self.config.sectionsScene !== 'undefined') {
				self.config.scrollController.removeScene(self.config.sectionsScene);
			}
			// RESET DOM ELEMENTS
			TweenMax.killAll();
			$('path.signature-name').removeAttr('style');
			$('path.signature-dot').removeAttr('style');
			$('.jamie-lynn').removeClass('scroll-animation');
			$('.jamie-lynn').removeAttr('style');
			$('.jamie-lynn .section-photo').removeAttr('style');
			$('.jamie-lynn .section-video').removeAttr('style');
			$('.jamie-lynn .section-gallery').removeAttr('style');
			$('.jamie-lynn .section-share').removeAttr('style');
			$('.jamie-lynn .section-products').removeAttr('style');
			$('.jamie-lynn .section-quote').removeAttr('style');
			$('.jamie-lynn .section-quote .quote-wrapper').removeAttr('style');
			$('.jamie-lynn .section-quote .quote-wrapper .quote-text').removeAttr('style');
			$('.jamie-lynn .section-quote .quote-wrapper .hand-written').removeAttr('style');
			$('.jamie-lynn .section-quote .quote-wrapper blockquote').removeAttr('style');
			$('#share .share-details .share-links').removeAttr('style');
			$('#share .share-details .hashtag').removeAttr('style');
			$('#tradition-photo .tradition-message .part-1').removeAttr('style');
			$('#tradition-photo .tradition-message .part-2').removeAttr('style');
			$('#tradition-photo .tradition-message .part-3').removeAttr('style');
		}
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
	videoInit: function () {
		var self, loopVideo, player;
		self = this;
		loopVideo = $('#video-loop')[0];
		player = $f($('#video-player')[0]);
		// wait until player is ready
		player.addEvent('ready', function() {
			player.addEvent('finish', removeVideo);
		});
		// listen for click to activate player
		$('.section-video .play-image a').on('click', function (e) {
			showVideo();
		});
		function showVideo() {
			TweenMax.to($('.section-video .film'), 0.5, {opacity: 1, display: 'block'});
			loopVideo.pause();
			player.api('play');
			// listen for esc key
			$(document).on('keyup.video', function (e) {
				if (e.keyCode == 27) {
					removeVideo();
				}
			});
			// listen for click to close
			$('.section-video .film .arrow-left').on('click.video', function (e) {
				removeVideo();
			});
		}
		function removeVideo() {
			player.api('pause');
			// kill event listeners
			$(document).off('keyup.video');
			$('.section-video .film .arrow-left').off('click.video');
			// animate video away
			TweenMax.to($('.section-video .film'), 0.5, {opacity: 0, display: 'none'});
			loopVideo.play();
		}
	},
	galleryInit: function () {
		var gallery, arrowLeft, arrowRight;
		arrowLeft = '<img src="http://' + window.location.host + '/wp-content/themes/1415-Lib-Tech-WordPress-Theme/_/img/jamie-lynn/arrow-left.png" alt="Previous" />';
		arrowRight = '<img src="http://' + window.location.host + '/wp-content/themes/1415-Lib-Tech-WordPress-Theme/_/img/jamie-lynn/arrow-right.png" alt="Next" />';
		gallery = $(".section-gallery .gallery-wrapper").owlCarousel({
			items: 1,
			dots: false,
			nav: true,
			navText: [arrowLeft, arrowRight],
			lazyLoad: true,
			autoplay: false,
			mouseDrag: false,
			loop: true,
			animateIn: 'fadeIn',
			animateOut: 'fadeOut',
			smartSpeed: 450,
			navSpeed: 200
		});
	},
	shareInit: function () {
		var shareUrl, twitterMessage;
		shareUrl = 'http://' + window.location.hostname + window.location.pathname;
		twitterMessage = "A tribute to Jamie Lynn's professional snowboarding career with @LibTechnologies Snowboards - ";
		// facebook share
		$('.section-share .share-links .facebook a').on('click', function (e) {
			e.preventDefault();
			FB.ui({
				method: 'share',
				href: shareUrl,
			}, function(response){});
		});
		// twitter share
		$('.section-share .share-links .twitter a').on('click', function (e) {
			e.preventDefault();
			window.open('http://twitter.com/share?url=' + shareUrl + '&text=' + twitterMessage + '&', 'twitterwindow', 'height=450, width=550, top='+($(window).height()/2 - 225) +', left='+$(window).width()/2 +', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');
		});
	},
	recalculateFills: function () {
		var self, browserHeight, browserWidth, fills;
		self = this;
		// get pixel size of browser window.
		browserHeight = Math.round($(window).height());
		browserWidth = Math.round($(window).width());
		// jquery all items on page with fill tag
		fills = $('.fill');
		// for each fill, recalculate size and position and apply using jQuery
		fills.each(function () {
			var videoHeight, videoWidth, new_size;
			// height of element. not neccessarily video
			videoHeight = $(this).height();
			videoWidth = $(this).width();
			// calculate new size
			new_size = self.fullBleed(browserWidth, browserHeight, videoWidth, videoHeight);
			// distance from top and left is half of the difference between the browser width and the size of the element
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
		// Return new size for video
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
		responsiveCheck: function () {
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