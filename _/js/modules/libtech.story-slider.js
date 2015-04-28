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
    self.buildCarousel();
  },
  buildCarousel: function() {
    var self = this;
    // build new
    self.carousel.owlCarousel({
      autoplay: true,
      autoplayTimeout: 8000,
      dots: true,
      items: 1,
      loop: true,
      nav: true,
      navText: ['<span class="offscreen">prev</span>', '<span class="offscreen">next</span>']
    });
  }
};
