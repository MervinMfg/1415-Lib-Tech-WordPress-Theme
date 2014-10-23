/**
 * 1415 Lib Tech WordPress Theme - Gallery - http://www.lib-tech.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var LIBTECH = LIBTECH || {};

LIBTECH.Gallery = function () {
	this.config = {
		totalItems: 0,
		gallerySlider: null
	};
	this.init();
};
LIBTECH.Gallery.prototype = {
	init: function () {
		var self = this;
		// check for gallery
		if ($('.gallery')) {
			// determine total items in gallery
			self.config.totalItems = $('.gallery .gallery-thumbnails li').length;
			// set up gallery slider for thumbnails
			self.config.gallerySlider = $('.gallery .gallery-thumbnails').bxSlider({
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
					self.loadGalleryImage(currentSlide.find('.gallery-icon a'));
				}
			});
			// assign click events to gallery thumbnails
			$('.gallery .gallery-thumbnails li .gallery-icon a').on('click.gallery', function (e) {
				e.preventDefault();
				e.stopPropagation(); // kill even from firing further
				self.loadGalleryImage($(this));
			});
			// assign click event to gallery viewer image, advance slideshow
			$('.gallery .gallery-viewer .gallery-viewer-image').on('click.galleryViewer', function (e) {
				e.preventDefault();
				e.stopPropagation();
				self.showNext();
			});
			$('.gallery .gallery-viewer .gallery-viewer-prev').on('click.galleryViewer', function (e) {
				self.showPrevious();
			});
			$('.gallery .gallery-viewer .gallery-viewer-next').on('click.galleryViewer', function (e) {
				self.showNext();
			});

			// assign keyboard events to gallery
			$(document).on('keyup.gallery', function (e) {
				var code, currentIndex, newIndex, slideIndex;
				// get the code
				code = (e.keyCode ? e.keyCode : e.which);
				// check which arrow key
				if (code == 39) {
					// right arrow
					self.showNext();
				} else if (code == 37) {
					// left arrow
					self.showPrevious();
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
	},
	showNext: function () {
		var self, currentIndex, newIndex, maxSlideIndex;
		self = this;
		// find current item
		currentIndex = $('.gallery .gallery-thumbnails li .gallery-icon a.selected').parent().parent().index();
		// determine next index
		newIndex = currentIndex + 1;
		if (self.config.totalItems == newIndex) {
			newIndex = 0;
		}
		// select new image
		$('.gallery .gallery-thumbnails li').eq(newIndex).find('.gallery-icon a').click();
		// determine slider index
		slideIndex = Math.ceil((newIndex + 1) / 2) - 1;
		// determine max slide index you can advance to based on visible width of gallery
		maxSlideIndex = Math.floor(((110 * self.config.totalItems - 10) - $('.gallery').width()) / 220);
		// don't let slide index exceed max index based on browser width, we move 2 at a time
		if (slideIndex > maxSlideIndex) {
			slideIndex = maxSlideIndex;
		}
		// advance thumbnails to new slide index
		self.config.gallerySlider.goToSlide(slideIndex);
	},
	showPrevious: function () {
		var self, currentIndex, newIndex, maxSlideIndex;
		self = this;
		// find current item
		currentIndex = $('.gallery .gallery-thumbnails li .gallery-icon a.selected').parent().parent().index();
		// determine next index
		newIndex = currentIndex - 1;
		if (newIndex < 0) {
			newIndex = self.config.totalItems - 1;
		}
		// select new image
		$('.gallery .gallery-thumbnails li').eq(newIndex).find('.gallery-icon a').click();
		// determine slider index
		slideIndex = Math.ceil((newIndex + 1) / 2) - 1;
		// determine max slide index you can advance to based on visible width of gallery
		maxSlideIndex = Math.floor(((110 * self.config.totalItems - 10) - $('.gallery').width()) / 220);
		// don't let slide index exceed max index based on browser width, we move 2 at a time
		if (slideIndex > maxSlideIndex) {
			slideIndex = maxSlideIndex;
		}
		// advance thumbnails to new slide index
		self.config.gallerySlider.goToSlide(slideIndex);
	},
	loadGalleryImage: function (imageLink) {
		// gallery functionality to load new images
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
};
