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
		$(window).on('load.jamielynn', function () {
			self.scrollingInit();
			self.navigationInit();
			self.captionsInit();
			self.videoInit();
			self.galleryInit();
			self.shareInit();
			$(this).off('load.jamielynn');
		});
		// call scroll again on resize
		$(window).on('resize.jamielynn', function () {
			self.scrollingInit();
			self.navigationInit();
			// resize loop video
			self.recalculateFills();
		});
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
		$(window).on('load.preloader', function () {
			// make sure we're at the top, user may have been scrolling while loading
			$(this).scrollTop(0);
			$(this).off('load.preloader');
			TweenMax.to($('.jamie-lynn .loading'), 1, {opacity: 0, display: 'none', delay: 0.1});
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
			if(self.utilities.responsiveCheck() == "large" && $('html').hasClass('ie-lt9') !== true) {
				switch (url) {
					case '#legacy':
						scrollY = 0;
						break;
					case '#intro':
						scrollY = totalHeight * 0.075;
						break;
					case '#film':
						scrollY = totalHeight * 0.120;
						break;
					case '#method':
						scrollY = totalHeight * 0.167;
						break;
					case '#style':
						scrollY = totalHeight * 0.270;
						break;
					case '#passion':
						scrollY = totalHeight * 0.367;
						break;
					case '#inspiration':
						scrollY = totalHeight * 0.466;
						break;
					case '#music':
						scrollY = totalHeight * 0.562;
						break;
					case '#steady':
						scrollY = totalHeight * 0.665;
						break;
					case '#creativity':
						scrollY = totalHeight * 0.765;
						break;
					case '#products':
						scrollY = totalHeight * 0.846;
						break;
				}
				if (currentScrollY < scrollY) {
					scrollPercentage = (scrollY - currentScrollY) / totalHeight;
				} else {
					scrollPercentage = (currentScrollY - scrollY) / totalHeight;
				}
				scrollDuration = scrollPercentage * 25;
			} else {
				scrollY = $(url).offset().top;
				if (currentScrollY < scrollY) {
					scrollPercentage = (scrollY - currentScrollY) / totalHeight;
				} else {
					scrollPercentage = (currentScrollY - scrollY) / totalHeight;
				}
				scrollDuration = scrollPercentage * 10;
			}
			console.log(scrollDuration);
			// max scroll duration of 3 seconds
			if (scrollDuration > 3) {
				scrollDuration = 3;
			}
			// round values
			scrollDuration = scrollDuration.toFixed(2);
			scrollY = Math.round(scrollY);
			// Scroll Browser
			// need to set autoKill false because of an issue with Safari regarding changing the document height on the fly
			// tiggers a scroll override event - http://greensock.com/forums/topic/7205-scrollto-bug-in-182-in-safari-602-mountain-lion/ 
			TweenMax.to(window, scrollDuration, {scrollTo:{y: scrollY, x: 0, autoKill: false}});
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
		if (self.utilities.responsiveCheck() == "large") {
			// increased scroll size by 1.5 percent on large
			windowHeight = windowHeight * 1.55;
		}
		if(self.utilities.responsiveCheck() == "large" || self.utilities.responsiveCheck() == "medium") {
			self.config.navScene1 = new ScrollScene({offset: -1, duration: windowHeight + 1})
				.setClassToggle($(".navigation .legacy a"), "active")
				.addTo(self.config.scrollController);
			self.config.navScene2 = new ScrollScene({offset: windowHeight - 1, duration: windowHeight + 1})
				.setClassToggle($(".navigation .intro a"), "active")
				.addTo(self.config.scrollController);
			self.config.navScene3 = new ScrollScene({offset: windowHeight*2 - 1, duration: windowHeight + 1})
				.setClassToggle($(".navigation .film a"), "active")
				.addTo(self.config.scrollController);
			self.config.navScene4 = new ScrollScene({offset: windowHeight*3 - 1, duration: windowHeight*2 + 1})
				.setClassToggle($(".navigation .method a"), "active")
				.addTo(self.config.scrollController);
			self.config.navScene5 = new ScrollScene({offset: windowHeight*5 - 1, duration: windowHeight*2 + 1})
				.setClassToggle($(".navigation .style a"), "active")
				.addTo(self.config.scrollController);
			self.config.navScene6 = new ScrollScene({offset: windowHeight*7 - 1, duration: windowHeight*2 + 1})
				.setClassToggle($(".navigation .passion a"), "active")
				.addTo(self.config.scrollController);
			self.config.navScene7 = new ScrollScene({offset: windowHeight*9 - 1, duration: windowHeight*2 + 1})
				.setClassToggle($(".navigation .inspiration a"), "active")
				.addTo(self.config.scrollController);
			self.config.navScene8 = new ScrollScene({offset: windowHeight*11 - 1, duration: windowHeight*2 + 1})
				.setClassToggle($(".navigation .music a"), "active")
				.addTo(self.config.scrollController);
			self.config.navScene9 = new ScrollScene({offset: windowHeight*13 - 1, duration: windowHeight*2 + 1})
				.setClassToggle($(".navigation .steady a"), "active")
				.addTo(self.config.scrollController);
			self.config.navScene10 = new ScrollScene({offset: windowHeight*15 - 1, duration: windowHeight*2 + 1})
				.setClassToggle($(".navigation .creativity a"), "active")
				.addTo(self.config.scrollController);
			self.config.navScene11 = new ScrollScene({offset: windowHeight*17 - 1, duration: $('#products').height() + 1})
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
		// if not ie8 or less, don't scroll
		if ( self.utilities.responsiveCheck() == "large" && $('html').hasClass('ie-lt9') !== true ) {
			self.config.responsiveSize = "large";
			// if scene already exists, remove it
			if (typeof self.config.signatureScene !== 'undefined') {
				self.config.scrollController.removeScene(self.config.signatureScene);
			}
			if (typeof self.config.sectionsScene !== 'undefined') {
				self.config.scrollController.removeScene(self.config.sectionsScene);
			}
			// RESET DOM ELEMENTS
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
			TweenMax.to($('.jamie-lynn .section-quote .quote-wrapper'), 0, {y: '0%', opacity: 0});
			TweenMax.to($('.jamie-lynn .section-quote .quote-wrapper .quote-text'), 0, {y: '40px', opacity: 0});
			TweenMax.to($('.jamie-lynn .section-quote .quote-wrapper .hand-written'), 0, {y: '60px', opacity: 0});
			$('.jamie-lynn .section-quote .quote-wrapper blockquote').removeAttr('style');
			$('#share .share-details .share-links').removeAttr('style');
			$('#share .share-details .hashtag').removeAttr('style');
			TweenMax.to($('#tradition-photo .tradition-message .part-1'), 0, {y: '0px'});
			TweenMax.to($('#tradition-photo .tradition-message .part-2'), 0, {y: '0px'});
			TweenMax.to($('#tradition-photo .tradition-message .part-3'), 0, {y: '0px'});
			TweenMax.to($('#tradition-photo .tradition-message .email-signup'), 0, {y: '0px'});
			$('#tradition-photo .tradition-message .part-1').removeAttr('style');
			$('#tradition-photo .tradition-message .part-2').removeAttr('style');
			$('#tradition-photo .tradition-message .part-3').removeAttr('style');
			$('#tradition-photo .tradition-message .email-signup').removeAttr('style');
			// check if SVG is available, run signature stuff if it is
			if ($('html').hasClass('no-smil') !== true) {
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
			}
			// JAMIE SCROLLING SECTIONS
			// Turn off default overwrite to hide error messaging
			// https://github.com/janpaepke/ScrollMagic/wiki/WARNING:-tween-was-overwritten-by-another
			TweenLite.defaultOverwrite = false;
			// begin animation
			$('.jamie-lynn').addClass('scroll-animation');
			// add browser height for 21 sections
			pageHeight = $(window).height() * $('.jamie-lynn section').length * 1.5;
			$('.jamie-lynn').height(pageHeight);
			sectionsTween = new TimelineMax()
				.add(TweenMax.to($('#legacy-now'), 2, {opacity: 1, display: 'block', delay: 0.2})) // draw word for 0.9
				.add(TweenMax.to($('#intro'), 1, {top: '0%', delay: 4}))
				.add(TweenMax.to($('#intro .quote-wrapper'), 1, {opacity: 1, delay: -0.5}))
				.add(TweenMax.to($('#intro .quote-wrapper .quote-text'), 1, {opacity: 1, delay: -0.75}))
				.add(TweenMax.to($('#intro .quote-wrapper .hand-written'), 1, {opacity: 1, delay: -0.5}))
				.add(TweenMax.to($('#intro .quote-wrapper .quote-text'), 5, {y: '0px', delay: -2.5}))
				.add(TweenMax.to($('#intro .quote-wrapper .hand-written'), 5, {y: '0px', delay: -5}))
				.add(TweenMax.to($('#intro .quote-wrapper'), 1, {y: '15%', delay: -0.2}))
				.add(TweenMax.to($('#legacy'), 0.01, {display: 'none', delay: -1.2}))
				.add(TweenMax.to($('#legacy-now'), 0.01, {display: 'none', delay: -1.2}))
				.add(TweenMax.to($('#film'), 0.1, {display: 'block', delay: -1.2}))
				.add(TweenMax.to($('#intro'), 2, {top: '-100%', delay: -1.2}))
				.add(TweenMax.to($('#method'), 1, {top: '0%', delay: 4}))
				.add(TweenMax.to($('#method .quote-wrapper'), 1, {opacity: 1, delay: -0.5}))
				.add(TweenMax.to($('#method .quote-wrapper .quote-text'), 1, {opacity: 1, delay: -0.75}))
				.add(TweenMax.to($('#method .quote-wrapper .hand-written'), 1, {opacity: 1, delay: -0.5}))
				.add(TweenMax.from($('#method .quote-wrapper blockquote'), 5, {backgroundPosition: "0 80px", delay: -1}))
				.add(TweenMax.to($('#method .quote-wrapper .quote-text'), 5, {y: '0px', delay: -5}))
				.add(TweenMax.to($('#method .quote-wrapper .hand-written'), 5, {y: '0px', delay: -5}))
				.add(TweenMax.to($('#method .quote-wrapper'), 1, {y: '15%', delay: -0.2}))
				.add(TweenMax.to($('#film'), 0.01, {display: 'none', delay: -1.2}))
				.add(TweenMax.to($('#method-photo'), 0.01, {display: 'block', delay: -1.2}))
				.add(TweenMax.to($('#method'), 2, {top: '-100%', delay: -1.2}))
				.add(TweenMax.to($('#style'), 1, {top: '0%', delay: 4}))
				.add(TweenMax.to($('#style .quote-wrapper'), 1, {opacity: 1, delay: -0.5}))
				.add(TweenMax.to($('#style .quote-wrapper .quote-text'), 1, {opacity: 1, delay: -0.75}))
				.add(TweenMax.to($('#style .quote-wrapper .hand-written'), 1, {opacity: 1, delay: -0.5}))
				.add(TweenMax.from($('#style .quote-wrapper blockquote'), 5, {backgroundPosition: "0 80px", delay: -1}))
				.add(TweenMax.to($('#style .quote-wrapper .quote-text'), 5, {y: '0px', delay: -5}))
				.add(TweenMax.to($('#style .quote-wrapper .hand-written'), 5, {y: '0px', delay: -5}))
				.add(TweenMax.to($('#style .quote-wrapper'), 1, {y: '15%', delay: -0.2}))
				.add(TweenMax.to($('#method-photo'), 0.01, {display: 'none', delay: -1.2}))
				.add(TweenMax.to($('#style-photo'), 0.01, {display: 'block', delay: -1.2}))
				.add(TweenMax.to($('#style'), 2, {top: '-100%', delay: -1.2}))
				.add(TweenMax.to($('#passion'), 1, {top: '0%', delay: 4}))
				.add(TweenMax.to($('#passion .quote-wrapper'), 1, {opacity: 1, delay: -0.5}))
				.add(TweenMax.to($('#passion .quote-wrapper .quote-text'), 1, {opacity: 1, delay: -0.75}))
				.add(TweenMax.to($('#passion .quote-wrapper .hand-written'), 1, {opacity: 1, delay: -0.5}))
				.add(TweenMax.from($('#passion .quote-wrapper blockquote'), 5, {backgroundPosition: "0 80px", delay: -1}))
				.add(TweenMax.to($('#passion .quote-wrapper .quote-text'), 5, {y: '0px', delay: -5}))
				.add(TweenMax.to($('#passion .quote-wrapper .hand-written'), 5, {y: '0px', delay: -5}))
				.add(TweenMax.to($('#passion .quote-wrapper'), 1, {y: '15%', delay: -0.2}))
				.add(TweenMax.to($('#style-photo'), 0.01, {display: 'none', delay: -1.2}))
				.add(TweenMax.to($('#passion-photo'), 0.01, {display: 'block', delay: -1.2}))
				.add(TweenMax.to($('#passion'), 2, {top: '-100%', delay: -1.2}))
				.add(TweenMax.to($('#inspiration'), 1, {top: '0%', delay: 4}))
				.add(TweenMax.to($('#inspiration .quote-wrapper'), 1, {opacity: 1, delay: -0.5}))
				.add(TweenMax.to($('#inspiration .quote-wrapper .quote-text'), 1, {opacity: 1, delay: -0.75}))
				.add(TweenMax.to($('#inspiration .quote-wrapper .hand-written'), 1, {opacity: 1, delay: -0.5}))
				.add(TweenMax.from($('#inspiration .quote-wrapper blockquote'), 5, {backgroundPosition: "0 80px", delay: -1}))
				.add(TweenMax.to($('#inspiration .quote-wrapper .quote-text'), 5, {y: '0px', delay: -5}))
				.add(TweenMax.to($('#inspiration .quote-wrapper .hand-written'), 5, {y: '0px', delay: -5}))
				.add(TweenMax.to($('#inspiration .quote-wrapper'), 1, {y: '15%', delay: -0.2}))
				.add(TweenMax.to($('#passion-photo'), 0.1, {display: 'none', delay: -1.2}))
				.add(TweenMax.to($('#inspiration-photo'), 0.1, {display: 'block', delay: -1.2}))
				.add(TweenMax.to($('#inspiration'), 2, {top: '-100%', delay: -1.2}))
				.add(TweenMax.to($('#music'), 1, {top: '0%', delay: 4}))
				.add(TweenMax.to($('#music .quote-wrapper'), 1, {opacity: 1, delay: -0.5}))
				.add(TweenMax.to($('#music .quote-wrapper .quote-text'), 1, {opacity: 1, delay: -0.75}))
				.add(TweenMax.to($('#music .quote-wrapper .hand-written'), 1, {opacity: 1, delay: -0.5}))
				.add(TweenMax.from($('#music .quote-wrapper blockquote'), 5, {backgroundPosition: "0 80px", delay: -1}))
				.add(TweenMax.to($('#music .quote-wrapper .quote-text'), 5, {y: '0px', delay: -5}))
				.add(TweenMax.to($('#music .quote-wrapper .hand-written'), 5, {y: '0px', delay: -5}))
				.add(TweenMax.to($('#music .quote-wrapper'), 1, {y: '15%', delay: -0.2}))
				.add(TweenMax.to($('#inspiration-photo'), 0.1, {display: 'none', delay: -1.2}))
				.add(TweenMax.to($('#music-photo'), 0.1, {display: 'block', delay: -1.2}))
				.add(TweenMax.to($('#music'), 2, {top: '-100%', delay: -1.2}))
				.add(TweenMax.to($('#steady'), 1, {top: '0%', delay: 4}))
				.add(TweenMax.to($('#steady .quote-wrapper'), 1, {opacity: 1, delay: -0.5}))
				.add(TweenMax.to($('#steady .quote-wrapper .quote-text'), 1, {opacity: 1, delay: -0.75}))
				.add(TweenMax.to($('#steady .quote-wrapper .hand-written'), 1, {opacity: 1, delay: -0.5}))
				.add(TweenMax.from($('#steady .quote-wrapper blockquote'), 5, {backgroundPosition: "0 80px", delay: -1}))
				.add(TweenMax.to($('#steady .quote-wrapper .quote-text'), 5, {y: '0px', delay: -5}))
				.add(TweenMax.to($('#steady .quote-wrapper .hand-written'), 5, {y: '0px', delay: -5}))
				.add(TweenMax.to($('#steady .quote-wrapper'), 1, {y: '15%', delay: -0.2}))
				.add(TweenMax.to($('#music-photo'), 0.01, {display: 'none', delay: -1.2}))
				.add(TweenMax.to($('#steady-photo'), 0.01, {display: 'block', delay: -1.2}))
				.add(TweenMax.to($('#steady'), 2, {top: '-100%', delay: -1.2}))
				.add(TweenMax.to($('#creativity'), 1, {top: '0%', delay: 4}))
				.add(TweenMax.to($('#creativity .quote-wrapper'), 1, {opacity: 1, delay: -0.5}))
				.add(TweenMax.to($('#creativity .quote-wrapper .quote-text'), 1, {opacity: 1, delay: -0.75}))
				.add(TweenMax.to($('#creativity .quote-wrapper .hand-written'), 1, {opacity: 1, delay: -0.5}))
				.add(TweenMax.from($('#creativity .quote-wrapper blockquote'), 5, {backgroundPosition: "0 80px", delay: -1}))
				.add(TweenMax.to($('#creativity .quote-wrapper .quote-text'), 5, {y: '0px', delay: -5}))
				.add(TweenMax.to($('#creativity .quote-wrapper .hand-written'), 5, {y: '0px', delay: -5}))
				.add(TweenMax.to($('#creativity .quote-wrapper'), 1, {y: '15%', delay: -0.2}))
				.add(TweenMax.to($('#steady-photo'), 0.01, {display: 'none', delay: -1.2}))
				.add(TweenMax.to($('#gallery'), 0.01, {display: 'block', delay: -5}))
				.add(TweenMax.to($('#creativity'), 1, {top: '-100%', delay: -1.2}))
				.add(TweenMax.to($('#gallery'), 4, {top: '-100%', delay: 4}))
				.add(TweenMax.to($('#products'), 4, {bottom: '0%', delay: -4}))
				.add(TweenMax.to($('#share'), 1, {top: '0%', delay: 4}))
				.add(TweenMax.from($('#share .share-details .share-links'), 1, {y: '40px', opacity: 0}))
				.add(TweenMax.from($('#share .share-details .hashtag'), 1, {y: '80px', opacity: 0, delay: -0.5}))
				.add(TweenMax.to($('#products'), 0.1, {display: 'none', delay: -0.2}))
				.add(TweenMax.to($('#tradition-photo'), 0.1, {display: 'block', delay: -0.2}))
				.add(TweenMax.to($('#share'), 2, {top: '-100%', delay: 3}))
				.add(TweenMax.from($('#tradition-photo .tradition-message .part-1'), 1, {y: '40px', opacity: 0, delay: -0.5}))
				.add(TweenMax.from($('#tradition-photo .tradition-message .part-2'), 1, {y: '80px', opacity: 0, delay: -0.5}))
				.add(TweenMax.from($('#tradition-photo .tradition-message .part-3'), 1, {y: '80px', opacity: 0, delay: -0.5}))
				.add(TweenMax.from($('#tradition-photo .tradition-message .email-signup'), 1, {y: '80px', opacity: 0, delay: -0.5}));
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
			TweenMax.to($('.jamie-lynn .section-quote .quote-wrapper'), 0, {y: '0px'});
			TweenMax.to($('.jamie-lynn .section-quote .quote-wrapper .quote-text'), 0, {y: '0px'});
			TweenMax.to($('.jamie-lynn .section-quote .quote-wrapper .hand-written'), 0, {y: '0px'});
			$('.jamie-lynn .section-quote .quote-wrapper').removeAttr('style');
			$('.jamie-lynn .section-quote .quote-wrapper .quote-text').removeAttr('style');
			$('.jamie-lynn .section-quote .quote-wrapper .hand-written').removeAttr('style');
			$('.jamie-lynn .section-quote .quote-wrapper blockquote').removeAttr('style');
			$('#share .share-details .share-links').removeAttr('style');
			$('#share .share-details .hashtag').removeAttr('style');
			TweenMax.to($('#tradition-photo .tradition-message .part-1'), 0, {y: '0px'});
			TweenMax.to($('#tradition-photo .tradition-message .part-2'), 0, {y: '0px'});
			TweenMax.to($('#tradition-photo .tradition-message .part-3'), 0, {y: '0px'});
			TweenMax.to($('#tradition-photo .tradition-message .email-signup'), 0, {y: '0px'});
			$('#tradition-photo .tradition-message .part-1').removeAttr('style');
			$('#tradition-photo .tradition-message .part-2').removeAttr('style');
			$('#tradition-photo .tradition-message .part-3').removeAttr('style');
			$('#tradition-photo .tradition-message .email-signup').removeAttr('style');
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
		// resize loop video
		self.recalculateFills();
		// wait until player is ready
		player.addEvent('ready', function() {
			player.addEvent('finish', removeVideo);
		});
		// listen for click to activate player
		$('.section-video .play-image a').on('click', function (e) {
			e.preventDefault();
			showVideo();
		});
		function showVideo() {
			TweenMax.to($('.film-container'), 0.5, {opacity: 1, display: 'block'});
			// pause loop video if we're at large size
			if (self.utilities.responsiveCheck() == "large" && $('html').hasClass('ie-lt9') !== true) {
				loopVideo.pause();
			}
			player.api('play');
			// listen for esc key
			$(document).on('keyup.video', function (e) {
				if (e.keyCode == 27) {
					removeVideo();
				}
			});
			// listen for click to close
			$('.film-container .arrow-left').on('click.video', function (e) {
				e.preventDefault();
				removeVideo();
			});
		}
		function removeVideo() {
			// make sure we're at the video position
			if (self.utilities.responsiveCheck() == "large" && $('html').hasClass('ie-lt9') !== true) {
				var totalHeight = $(document).height();
				var scrollY = totalHeight * 0.105;
				$(window).scrollTop(scrollY);
			} else {
				$(window).scrollTop($('#film').position().top);
			}
			player.api('pause');
			// kill event listeners
			$(document).off('keyup.video');
			$('.film-container .arrow-left').off('click.video');
			// animate video away
			TweenMax.to($('.film-container'), 0.5, {opacity: 0, display: 'none'});
			// play loop video if we're at large size
			if (self.utilities.responsiveCheck() == "large" && $('html').hasClass('ie-lt9') !== true) {
				loopVideo.play();
			}
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
			smartSpeed: 800,
			navSpeed: 800
		});
	},
	shareInit: function () {
		var shareUrl, twitterMessage;
		shareUrl = 'http://lib-tech.com/jamielynn20';
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
		// Return new size
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