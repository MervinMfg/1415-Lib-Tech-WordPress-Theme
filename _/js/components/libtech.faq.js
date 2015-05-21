/**
 * 1415 Lib Tech WordPress Theme - FAQ - http://www.lib-tech.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var LIBTECH = LIBTECH || {};

LIBTECH.FAQ = function () {
	this.init();
};
LIBTECH.FAQ.prototype = {
	init: function () {
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
		$(".faq-question a.question").on('click', function (e) {
			if ($(this).next("div").css("display") === "none") {
				$(this).next("div").slideDown(300);
				$(this).parent().removeClass("collapsed");
			} else {
				$(this).next("div").slideUp(300);
				$(this).parent().addClass("collapsed");
			}
			e.preventDefault();
		});
		// update page scroll on category change
		$('.faq-categories .mobile-nav').on('change', function (e) {
			var val = $(this).val();
			if(val !== '' || val !== '#' || val !== undefined) {
				LIBTECH.main.utilities.pageScroll(val);
			}
		});
		$('.faq-categories .desktop-nav a').on('click', function (e) {
			var val = $(this).attr('href');
			e.preventDefault();
			e.stopPropagation();
			if(val !== '' || val !== '#' || val !== undefined) {
				LIBTECH.main.utilities.pageScroll(val);
			}
		});
	}
};
