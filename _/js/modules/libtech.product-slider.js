/**
 * 1415 Lib Tech WordPress Theme - Product Slider - http://www.lib-tech.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var LIBTECH = LIBTECH || {};

LIBTECH.ProductSlider = function(autoRotate, displayDots) {
  this.config = {
    autoRotate: typeof autoRotate !== 'undefined' ? autoRotate : true,
    displayDots: typeof displayDots !== 'undefined' ? displayDots : true,
    slideMargin: 10,
    loop: true
  };
  this.carousel = {};
  this.init();
};

LIBTECH.ProductSlider.prototype = {
  init: function() {
    var self, currencyCookie;
    self = this;
    self.carousel = $('.product-slider .owl-carousel');
    // if less than 10 products, do not loop
    if(self.carousel.find('.product-item').length <= 10) self.config.loop = false;
    // change slide size for surfboards
		// check for surf specific content
		if ($('body').hasClass('surf')) {
      self.config.slideMargin = 40;
		}
    currencyCookie = LIBTECH.main.utilities.cookie.getCookie('libtech_currency');
    // remove super banana if we're not in US
		if (currencyCookie !== 'USD') {
			$('.product-slider .product-list .superbanana').remove();
		}
    // build slider
    self.buildCarousel();
    // lazy load of images
		$(".product-slider img.lazy").unveil(0, function() {
			$(this).on('load', function () {
				$(this).addClass('loaded');
				$(this).off('load');
			});
		});
  },
  buildCarousel: function() {
    var self = this;
    // build new
    self.carousel.owlCarousel({
      margin: self.config.slideMargin,
      autoplay: self.config.autoRotate,
      autoplayTimeout: 8000,
      dots: self.config.displayDots,
      loop: self.config.loop,
      nav: true,
      navText: ['<span class="offscreen">prev</span>', '<span class="offscreen">next</span>'],
      slideBy: 2,
      responsive: {
        0: { items: 2 },
        320: { items: 3 },
        480: { items: 4 },
        768: { items: 5 },
        992: { items: 6 },
        1200: { items: 7 },
        1400: { items: 8 },
        1600: { items: 9 },
        1800: { items: 10 }
      }
    });
  },
  uninit: function() {
    var self = this;
    self.carousel.trigger('destroy.owl.carousel');
  }
};
