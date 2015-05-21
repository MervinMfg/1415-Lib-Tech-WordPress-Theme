/**
 * 1415 Lib Tech WordPress Theme - Search - http://www.lib-tech.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var LIBTECH = LIBTECH || {};

LIBTECH.Search = function () {
	this.init();
};
LIBTECH.Search.prototype = {
	init: function () {
		$('header .nav-utility .search a').on('click', function (e) {
			e.preventDefault();
			e.stopPropagation(); // kill even from firing further
			$('#header-search').toggleClass('visible');
			$('#header-search .text-input').focus();
			$('#header-search .text-input').val('');
			// listen for escape key
			$(document).on('keyup', function (e) {
				if (e.keyCode == 27) {
					$('#header-search').toggleClass('visible');
					// kill event listeners
					$(document).off('keyup');
					$(document).off('click');
					$('#header-search').off('click');
				}
			});
			// hide if clicked anywhere outside search area
			$(document).on('click', function () {
				$('#header-search').toggleClass('visible');
				// kill event listeners
				$(document).off('keyup');
				$(document).off('click');
				$('#header-search').off('click');
			});
			// don't hide if clicked within search area
			$('#header-search').on('click', function (e) {
				e.stopPropagation();
			});
		});
	}
};
