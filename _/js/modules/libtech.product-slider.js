/**
 * 1415 Lib Tech WordPress Theme - Product Slider - http://www.lib-tech.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var LIBTECH = LIBTECH || {};

LIBTECH.ProductSlider = function(autoRotate, displayDots) {
  this.config = {
    autoRotate: typeof autoRotate !== 'undefined' ? autoRotate : true,
    displayDots: typeof displayDots !== 'undefined' ? displayDots : true,
    loop: true,
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
    currencyCookie = LIBTECH.main.utilities.cookie.getCookie('libtech_currency');
    // remove super banana if we're not in US
		if (currencyCookie !== 'USD') {
			$('.product-slider .product-list .superbanana').remove();
		}
    // check template to see if it should be square images
    if ($('.page-template-home-sport.surf').length > 0 || $('.single-libtech_apparel').length > 0 || $('.single-libtech_luggage').length > 0 || $('.single-libtech_outerwear').length > 0 || $('.single-libtech_accessories').length > 0 || $('.single-libtech_surfboards').length > 0 || $('.product-slider-featured').length > 0) {
      self.config.responsive = {
        0: { items: 2 },
        320: { items: 3 },
        480: { items: 3 },
        768: { items: 4 },
        992: { items: 5 },
        1200: { items: 5 },
        1400: { items: 6 },
        1600: { items: 7 },
        1800: { items: 8 }
      };
    }
    // lazy load of images
		$(".product-slider img.lazy").unveil(0, function() {
			$(this).on('load', function () {
				$(this).addClass('loaded');
				$(this).off('load');
			});
		});
    // build slider
    self.buildCarousel();
  },
  buildCarousel: function() {
    var self = this;
    // build new
    self.carousel.owlCarousel({
      margin: 10,
      autoplay: self.config.autoRotate,
      autoplayTimeout: 8000,
      dots: self.config.displayDots,
      loop: self.config.loop,
      nav: true,
      navText: ['<span class="offscreen">prev</span>', '<span class="offscreen">next</span>'],
      slideBy: 2,
      responsive: self.config.responsive
    });
  },
  uninit: function() {
    var self = this;
    self.carousel.trigger('destroy.owl.carousel');
  }
};
