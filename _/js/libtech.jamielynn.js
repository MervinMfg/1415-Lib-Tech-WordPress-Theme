/*
 * Lib Tech - http://lib-tech.com
 * Author: brian.behrens@mervin.com & tony.keller@mervin.com - http://www.mervin.com
 */

var LIBTECH = LIBTECH || {};

LIBTECH.JamieLynn = {
	config: {},
	init: function () {
		var self;
		self = this;
		// resize video, fill div
		$(window).resize(function() {
			self.recalculateFills();
		});
		self.recalculateFills();
		// nav selection
		$('.navigation li a').on('click', function() {
			$('.navigation li a').removeClass('active');
			$(this).addClass('active');
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