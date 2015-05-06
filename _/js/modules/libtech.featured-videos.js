/**
 * 1415 Lib Tech WordPress Theme - Featured Videos - http://www.lib-tech.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var LIBTECH = LIBTECH || {};

LIBTECH.FeaturedVideos = function() {
  this.init();
};

LIBTECH.FeaturedVideos.prototype = {
  init: function() {
    // assign a click event to the video thumbnails
		$('.video-thumbnails li a').on('click', function () {
			var videoID, videoType, videoPlayerHTML;
			videoID = $(this).attr('data-video-id');
			videoType = $(this).attr('data-video-type');
			// select the right thumbnail
			$('.video-thumbnails li a').removeClass('selected');
			$(this).addClass('selected');
			// display the video info
			$('.video-info').removeClass('selected');
			$('.video-player #' + videoID).addClass('selected');
			// add the video content
			if (videoType === "YouTube") {
				videoPlayerHTML = '<iframe width="620" height="348" src="http://www.youtube.com/embed/' + videoID + '" frameborder="0" allowfullscreen></iframe>';
			} else if (videoType === "Vimeo") {
				videoPlayerHTML = '<iframe src="http://player.vimeo.com/video/' + videoID + '" width="620" height="348" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
			}
			$('.video-player .frame-wrapper').html(videoPlayerHTML);
			// make video fit within target
			$('.video-player .frame-wrapper').fitVids();
			// kill the links default behavior
			return false;
		});
		// select the first video
		$('.video-thumbnails li a:first').trigger('click');
		// make video fit within target
		$('.video-player .frame-wrapper').fitVids();
  }
};
