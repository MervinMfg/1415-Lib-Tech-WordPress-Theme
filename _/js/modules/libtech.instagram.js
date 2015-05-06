/**
 * 1415 Lib Tech WordPress Theme - Instagram - http://www.lib-tech.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var LIBTECH = LIBTECH || {};

LIBTECH.Instagram = function() {
  this.init();
};

LIBTECH.Instagram.prototype = {
  init: function() {
    var self, value, limit, apiUrl;
		self = this;
    // feeds/instagram/?username=libtechnologies&limit=5
    // get instagram username
		value = $('.instagram-feed').attr('data-username');
		limit = $('.instagram-feed').attr('data-limit');
		if (typeof value !== 'undefined') {
			apiUrl = '/feeds/instagram/?username=' + value + '&limit=' + limit;
		} else {
			// we're going by tag not username
			value = $('.instagram-feed').attr('data-tag');
			apiUrl = '/feeds/instagram/?tag=' + value + '&limit=' + limit;
		}
    // grab instagram photos
    $.ajax({
      dataType: "json",
      url: apiUrl,
      success: function(photosJSON) {
        var photosData = photosJSON.data;
        for (var i = 0; i < photosData.length; i++) {
          var photoData, listItem;
          photoData = photosData[i];
          // set up instagram list item
					listItem = '<div class="instagram-wrapper col-xs-6 col-ms-3 col-sm-3 col-md-2 item-' + (i + 1) + '"><a href="' + photoData.link + '" target="_blank"><div class="instagram-info"><div class="vertical-center"><h4 class="username">@' + photoData.user.username + '</h4><h6 class="instagram-logo"><span class="icon"></span>Instagram</h6></div></div><div class="instagram-img"><img src="' + photoData.images.low_resolution.url + '" alt="' + photoData.caption.text + '" /></div></a></div>';
          // add list item to content grid
          $('.instagram-feed .section-content').append(listItem);
        }
      }
    });
  }
};
