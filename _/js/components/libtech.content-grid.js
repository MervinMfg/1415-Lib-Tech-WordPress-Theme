/**
 * 1415 Lib Tech WordPress Theme - Content Grid - http://www.lib-tech.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var LIBTECH = LIBTECH || {};

LIBTECH.ContentGrid = function () {
	this.init();
};
LIBTECH.ContentGrid.prototype = {
	init: function () {
		var instagramUsername, facebookUsername;
		// add randomize function
		$.fn.randomize = function (selector) {
			var $elems = selector ? $(this).find(selector) : $(this).children(),
				$parents = $elems.parent();
			$parents.each(function () {
				$(this).children(selector).sort(function () {
					return Math.round(Math.random()) - 0.5;
				}).remove().appendTo(this);
			});
			return this;
		};
		// feeds/instagram/?username=libtechnologies&limit=5
		// get instagram username
		instagramUsername = $('.content-grid').attr('data-instagram');
		// grab instagram photos
		$.ajax({
			dataType: "json",
			url: '/feeds/instagram/?username=' + instagramUsername + '&limit=3',
			success: function (photosJSON) {
				var photosData = photosJSON.data;
				for (var i = 0; i < photosData.length; i++) {
					var photoData, listItem;
					photoData = photosData[i];
					// set up instagram list item
					listItem = '<li class="grid-item instagram item-' + i + '"><div class="grid-item-wrapper"><a href="' + photoData.link + '" target="_blank" class="item-link"><div class="item-copy"><p>' + photoData.caption.text + '</p></div><div class="item-image"><img src="' + photoData.images.low_resolution.url + '" /></div><div class="clearfix"></div></a></div></li>';
					// add list item to content grid
					$('.content-grid ul').append(listItem);
				}
				// randomize content grid
				$('.content-grid ul').randomize('li');
			}
		});
		// feeds/facebook/?username=libtech&limit=8
		// get facebook username
		facebookUsername = $('.content-grid').attr('data-facebook');
		// grab facebook posts
		$.ajax({
			dataType: "json",
			url: '/feeds/facebook/?username=' + facebookUsername + '&limit=6',
			success: function (postsJSON) {
				var postsData, totalItems;
				postsData = postsJSON.data;
				totalItems = 0;
				for (var i = 0; i < postsData.length; i++) {
					var postData, listItem;
					postData = postsData[i];
					if (postData.type != "status") {
						var postDate, monthArray, postImage, postMessage;
						// process date stamp
						postDate = postData.created_time;
						monthArray = {
							Jan: "January",
							Feb: "February",
							Mar: "March",
							Apr: "April",
							May: "May",
							Jun: "June",
							Jul: "July",
							Aug: "August",
							Sep: "September",
							Oct: "October",
							Nov: "November",
							Dec: "December"
						};
						postDate = String(new Date(postDate)).replace(
							/\w{3} (\w{3}) (\d{2}) (\d{4}) (\d{2}):(\d{2}):[^(]+\(([A-Z]{3})\)/,
							function ($0, $1, $2, $3, $4, $5, $6) {
								return monthArray[$1] + " " + $2 + ", " + $3; //+ " - " + $4%12 + ":" + $5 + ( + $4 > 12 ? "PM" : "AM") + " " + $6 hide time and date
							}
						);
						// get larger picture
						postImage = postData.picture;
						if (typeof postImage !== 'undefined') postImage = postImage.replace("_s", "_n");
						// get message
						postMessage = postData.message;
						if(typeof postMessage === 'undefined') postMessage = "";
						// set up facebook list item
						// only show posts with images
						if (typeof postImage !== 'undefined') {
							listItem = '<li class="grid-item facebook item-' + totalItems + '"><div class="grid-item-wrapper"><a href="' + postData.link + '" target="_blank" class="item-link"><div class="facebook-wrapper"><div class="facebook-header"><div class="facebook-profile"><img src="https://graph.facebook.com/' + facebookUsername + '/picture" /></div><p class="facebook-name">' + postData.from.name + '</p><p class="facebook-time">' + postDate + '</p><div class="clearfix"></div></div><div class="facebook-photo"><img src="' + postImage + '" /></div><p class="facebook-excerpt">' + postMessage + '</p></div><div class="facebook-aspect-ratio"><img src="' + LIBTECH.main.config.wpImgPath + 'square.gif" /></div><div class="clearfix"></div></a></div></li>';
							// add list item to content grid
							$('.content-grid ul').append(listItem);
							totalItems++;
						}
					}
					if (totalItems == "3")
						break;
				}
				// randomize content grid
				$('.content-grid ul').randomize('li');
				// clamp facebook text to 3 lines
				$('.content-grid .facebook .facebook-excerpt').each(function () {
					if (!$('html').hasClass('ie-lt9')) {
						$clamp(this, {clamp: '3'});
					}
				});
			}
		});
	}
};
