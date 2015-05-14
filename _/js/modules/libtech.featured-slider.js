/**
 * 1415 Lib Tech WordPress Theme - Featured Slider - http://www.lib-tech.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var LIBTECH = LIBTECH || {};

LIBTECH.FeaturedSlider = function(autoRotate) {
  this.config = {
    autoRotate: typeof autoRotate !== 'undefined' ? autoRotate : true
  };
  this.carousel = {};
  this.init();
};

LIBTECH.FeaturedSlider.prototype = {
  init: function() {
    var self = this;
    self.carousel = $('.featured-slider .owl-carousel');
    self.buildCarousel();
    self.initVideo();
    // enable image lazy load
		$(".featured-slider img.lazy").unveil(0, function() {
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
      autoplay: true,
      autoplayHoverPause: true,
      autoplayTimeout: 8000,
      dots: true,
      items: 1,
      loop: true,
      nav: true,
      navText: ['<span class="offscreen">prev</span>', '<span class="offscreen">next</span>']
    });
    // listen for start of slide transition
    self.carousel.on('translate.owl.carousel', function(e) {
      self.closeVideo();
    });
  },
  initVideo: function() {
    var self = this;
    // build video player on click
    $('.featured-slider .slide a.video-link').on('click.featuredSlider', function(e) {
      e.preventDefault();
      self.carousel.trigger('stop.owl.autoplay');
      var link, videoID, videoEmbed;
      link = $(this).attr("href");
      if(link.indexOf('vimeo') != -1) {
        // VIMEO
        videoID = link.substr(link.lastIndexOf("/") + 1);
        videoEmbed = '<div class="video-container"><span class="close-btn"></span><iframe src="http://player.vimeo.com/video/' + videoID + '?title=0&amp;byline=0&amp;portrait=0&amp;color=fff100&amp;autoplay=1" width="940" height="529" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
      } else {
        // YOUTUBE
        videoID = link.substr(link.lastIndexOf("?v=") + 3);
        videoEmbed = '<div class="video-container"><span class="close-btn"></span><iframe width="560" height="315" src="https://www.youtube.com/embed/' + videoID + '?autoplay=1" frameborder="0" allowfullscreen></iframe></div>';
      }
      // make sure video is not already embedded
      if ($('.featured-slider .active .slide .video-container').length === 0) {
        $('.featured-slider .active .slide').prepend(videoEmbed).fitVids();
        // listen for click to close video
        $('.featured-slider .active .slide .video-container').on('click.featuredSlider', function(e) {
          self.closeVideo();
        });
        // listen for escape key
        $(document).on('keyup.featuredSlider', function (e) {
    			if (e.keyCode == 27) {
    				self.closeVideo();
    			}
    		});
      }
    });
  },
  closeVideo: function() {
    var self, videoPlayer;
    self = this;
    videoPlayer = self.carousel.find('.active .slide .video-container');
    videoPlayer.off('click.featuredSlider');
    $(document).off('keyup.featuredSlider');
    if (videoPlayer.length > 0) {
      videoPlayer.remove();
      self.carousel.trigger('play.owl.autoplay');
    }
  }
};
