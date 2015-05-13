/**
 * 1415 Lib Tech WordPress Theme - Story Slider - http://www.lib-tech.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var LIBTECH = LIBTECH || {};

LIBTECH.StorySlider = function(autoRotate) {
  this.config = {
    autoRotate: typeof autoRotate !== 'undefined' ? autoRotate : true
  };
  this.carousel = {};
  this.init();
};

LIBTECH.StorySlider.prototype = {
  init: function() {
    var self = this;
    self.carousel = $('.story-slider .owl-carousel');
    self.carousel.on('resized.owl.carousel', function(event) {
      self.positionDots();
    });
    self.buildCarousel();
    // lazy load of images
		$(".story-slider img.lazy").unveil(0, function() {
			$(this).on('load', function () {
				$(this).addClass('loaded');
				$(this).off('load');
        self.positionDots();
			});
		});
  },
  buildCarousel: function() {
    var self = this;
    // build new
    self.carousel.owlCarousel({
      autoplay: self.config.autoRotate,
      autoplayTimeout: 8000,
      dots: true,
      items: 1,
      loop: true,
      nav: true,
      navText: ['<span class="offscreen">prev</span>', '<span class="offscreen">next</span>']
    });
  },
  positionDots: function() {
    var self, dotsTop;
    self = this;
    dotsTop = self.carousel.find('.story-link').outerHeight() + 10;
    self.carousel.find('.owl-dots').css('top', dotsTop);
  }
};
