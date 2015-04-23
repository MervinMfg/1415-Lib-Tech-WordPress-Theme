/**
 * 1415 Lib Tech WordPress Theme - Featured Slider - http://www.lib-tech.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var LIBTECH = LIBTECH || {};

LIBTECH.FeaturedSlider = function(autoRotate) {
  this.config = {
    autoRotate: typeof autoRotate !== 'undefined' ? autoRotate : true
  };
  this.init();
};

LIBTECH.FeaturedSlider.prototype = {
  init: function() {
    var self, slider;
    self = this;
    slider = $('.featured-slider .bxslider').bxSlider({
      video: true,
      useCSS: false,
      auto: self.config.autoRotate,
      speed: 500,
      randomStart: false,
      controls: false,
      mode: 'horizontal',
      onSlideBefore: function (slideElement, oldIndex, newIndex) {
        var prevSlide, videoPlayer;
        prevSlide = $('.featured-slider .bxslider li').eq(oldIndex + 1);
        prevSlide.removeClass('active');
        videoPlayer = prevSlide.find(".video-container");
        if (videoPlayer.length > 0) {
          videoPlayer.remove();
          slider.startAuto();
        }
      },
      onSlideAfter: function (slideElement, oldIndex, newIndex) {
        slideElement.addClass('active');
      }
    });
    $('.featured-slider .bxslider li a.video-link').click(function (e) {
      e.preventDefault();
      slider.stopAuto();
      var link, vimeoID, vimeoEmbed;
      link = $(this).attr("href");
      vimeoID = link.substr(link.lastIndexOf("/") + 1);
      vimeoEmbed = '<div class="video-container"><iframe src="http://player.vimeo.com/video/' + vimeoID + '?title=0&amp;byline=0&amp;portrait=0&amp;color=fff100&amp;autoplay=1" width="940" height="529" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
      // make sure video is not already embedded
      if ($(this).find(".video-container").length === 0)
        $(this).prepend(vimeoEmbed).fitVids();
    });
  }
};
