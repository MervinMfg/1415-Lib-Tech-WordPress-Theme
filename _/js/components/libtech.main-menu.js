/**
 * 1415 Lib Tech WordPress Theme - Main Menu - http://www.lib-tech.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var LIBTECH = LIBTECH || {};

LIBTECH.MainMenu = function () {
	this.config = {
		menuState: 'closed'
	};
	this.init();
};
LIBTECH.MainMenu.prototype = {
	init: function () {
		var self, marginClosed, marginOpen;
		self = this;
		marginClosed = $(".nav-sub-wrapper").height() * -1 + 10;
		marginOpen = -20;
		// remove old handlers
		$(".nav-sub-wrapper .mobile-btn").off('click.mainMenu');
		$(window).off('resize.mainMenu');
		// close menu by default
		if (LIBTECH.main.utilities.responsiveCheck() == 'base') {
			$('.nav-sub-wrapper').stop().animate({
				marginTop: marginClosed
			}, {
				duration: 500,
				easing: 'swing'
			});
			self.config.menuState = 'closed';
		}
		// mobile menu
		$(".nav-sub-wrapper .mobile-btn").on('click.mainMenu', function (e) {
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
			if (LIBTECH.main.utilities.responsiveCheck() == 'base') {
				self.init();
			} else {
				$('.nav-sub-wrapper').stop();
				$('.nav-sub-wrapper').css('margin-top', '-20px');
			}
		});
	}
};
