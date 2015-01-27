/**
 * 1415 Lib Tech WordPress Theme - Product Overview - http://www.lib-tech.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var LIBTECH = LIBTECH || {};

LIBTECH.ProductOverview = function () {
	this.init();
};
LIBTECH.ProductOverview.prototype = {
	init: function () {
		var self, slider, currencyCookie;
		self = this;
		self.initColorways();
		slider = $('.featured-product-slider .bxslider').bxSlider({
			auto: true,
			autoHover: true,
			speed: 800,
			randomStart: false,
			slideMargin: 20,
			controls: true,
			pager: false,
			mode: 'horizontal',
			adaptiveHeight: false,
			infiniteLoop: false,
			hideControlOnEnd: true,
			onSliderLoad: function (currentIndex) {
				$('.featured-product-slider .bxslider > li').eq(currentIndex).addClass('active');
			},
			onSlideBefore: function (slideElement, oldIndex, newIndex) {
				$('.featured-product-slider .bxslider > li').removeClass('active');
				slideElement.addClass('active');
				if (newIndex === 0) { // run fix for duplicate slides at begining and end
					$('.featured-product-slider .bxslider > li').eq($('.featured-product-slider .bxslider > li').length - 1).addClass('active');
				}
			}
		});
		// hide superbanana if currency other than USD
		currencyCookie = LIBTECH.main.utilities.cookie.getCookie('libtech_currency');
		if (currencyCookie !== 'USD') {
			$('.product-overview .product-listing .product-item.superbanana').remove();
		}
		// set availability filters based on location
		$('.product-listing .product-item').each(function () {
			var $this = $(this);
			if (currencyCookie == 'CAD') {
				if ($this.hasClass('available-ca')) $this.addClass('available');
			} else if (currencyCookie == 'EUR') {
				if ($this.hasClass('available-eu')) $this.addClass('available');
			} else {
				if ($this.hasClass('available-us')) $this.addClass('available');
			}
		});
		// BEGIN SETTING UP ISOTOPE
		productListing = $('.product-overview .product-listing');
		// adjust initial item widths
		setWidths();
		// on window load run layout again to fix image heights
		$(window).on('load', function () {
			// set up initial settings
			productListing.isotope({
				itemSelector: '.product-item',
				resizable: false, // turn off because it's responsive
				layoutMode: 'fitRows',
				fitRows: {
					columnWidth: getUnitWidth()
				},
				getSortData: {
					price: function ($elem) {
						return parseFloat($elem.find('.price .us-price').text().replace("$", ""));
					}
				}
			});
			// adjust width to be correct
			$('.product-filtering > li.filters').each(function () {
				var widthTotal = 0;
				$(this).find('ul > li').each(function () {
					widthTotal += $(this).outerWidth();
				});
				// max width for filter dropdowns
				if (widthTotal > 646) {
					widthTotal = 646;
				}
				// max width for 4 filter sets
				if ($('.product-filtering').hasClass('apparel') || $('.product-filtering').hasClass('clearance')) {
					if (widthTotal > 430) {
						widthTotal = 430;
					}
				}
				// max width for 3 filter sets
				if ($('.product-filtering').hasClass('skis') || $('.product-filtering').hasClass('skateboards') || $('.product-filtering').hasClass('outerwear')) {
					if (widthTotal > 316) {
						widthTotal = 316;
					}
				}
				// max width for 2 filter sets
				if ($('.product-filtering').hasClass('accessories') || $('.product-filtering').hasClass('luggage')) {
					if (widthTotal > 206) {
						widthTotal = 206;
					}
				}
				// max width for 1 filter set
				if ($('.product-filtering').hasClass('surfboards') || $('.product-filtering').hasClass('bindings')) {
					if (widthTotal > 96) {
						widthTotal = 96;
					}
				}
				$(this).find('ul').width(widthTotal);
			});
			// trigger change if there is a value
			if (window.location.hash !== '') {
				$(window).trigger("hashchange");
			}
		});
		// update columnWidth on window resize
		$(window).smartresize(function () {
			// set the widths of items
			setWidths();
			// reinit isotop with new column width
			productListing.isotope({
				fitRows: {
					columnWidth: getUnitWidth()
				}
			});
		});
		// get new width of each item based on browser width
		function getUnitWidth() {
			var width, windowWidth;
			windowWidth = LIBTECH.main.utilities.getMediaWidth();
			if (windowWidth < 600) {
				width = productListing.width() / 2;
			} else if (windowWidth < 768) {
				width = productListing.width() / 3;
			} else if (windowWidth < 980) {
				width = productListing.width() / 4;
			} else {
				width = productListing.width() / 5;
			}
			width = Math.floor(width);
			return width;
		}
		// set the widths of each item
		function setWidths() {
			var unitWidth = getUnitWidth();
			productListing.children(".product-item").css({
				width: unitWidth
			});
		}
		// filter items when filter link is clicked
		$('.product-filtering > li.filters > ul > li').on('click', function () {
			var target, selector, selectorASC, filterItems, filterList;
			target = $(this);
			target.toggleClass('selected'); // add or remove selected class
			if (target.attr('data-filter')) { // if target clicked is a filter option vs sort
				self.filterList(productListing);
			} else { // we are sorting data now, not filtering
				if (target.hasClass('selected')) {
					// grab all sort specific items and deselect them
					$('.product-filtering > li.filters > ul > li[data-sort]').each(function () {
						var sortItem = $(this);
						sortItem.removeClass('selected');
					});
					// select the one that was clicked again
					target.addClass('selected');
					// figure out what to sort by
					selector = target.attr('data-sort');
					// determine sort order
					if (target.attr('data-sort-asc') == "true") {
						selectorASC = true;
					} else {
						selectorASC = false;
					}
					// apply sorting
					productListing.isotope({
						sortBy: selector,
						sortAscending: selectorASC
					});
				} else {
					// reset sorting if none selected
					productListing.isotope({
						sortBy: "original-order",
						sortAscending: true
					});
				}
			}
			return false;
		});
		// filter products on hashchange
		$(window).on('hashchange', function() {
			var hashFilterList, filtersBeginIndex;
			hashFilterList = window.location.hash;
			// make sure hash has value
			if (hashFilterList.indexOf('filter=') != -1) {
				hashFilterList = decodeURIComponent(hashFilterList);
				filtersBeginIndex = hashFilterList.indexOf('filter=');
				filtersBeginIndex = filtersBeginIndex + 7; // add amount of characters filter= takes up
				hashFilterList = hashFilterList.substr(filtersBeginIndex);
				// check for &, remove everything after incase there is more added to hash
				if(hashFilterList.indexOf('&') != -1) {
					hashFilterList = hashFilterList.substr(0, hashFilterList.indexOf('&'));
				}
				// set selected filter on front-end dropdowns
				$('.product-filtering > li.filters > ul > li[data-filter]').each(function () {
					var target = $(this);
					if(hashFilterList.indexOf(target.attr('data-filter')) != -1) {
						target.addClass('selected');
					}
				});
				// submit filter to isotope
				productListing.isotope({
					filter: hashFilterList
				});
			} else {
				$('.product-filtering > li.filters > ul > li[data-filter]').each(function () {
					var target = $(this);
					target.removeClass('selected');
				});
				// submit filter to isotope
				productListing.isotope({
					filter: ''
				});
			}
			// UPDATE FILTERS REMOVE FEATURES
			$('.product-filtering > li.filters').each(function () {
				// Check to see which filter groups have filters set
				var filterGroup, isFilterSet;
				filterGroup = $(this);
				isFilterSet = false;
				filterGroup.find('ul > li').each(function () {
					if ($(this).hasClass('selected')) {
						isFilterSet = true;
					}
				});
				if (isFilterSet === true) { // if filter set has items selected add remove features
					filterGroup.find('.selected-items').each(function () {
						$(this).html('Remove');
						$(this).click(function () {
							$(this).html('Select');
							filterGroup.find('ul > li').each(function () {
								$(this).removeClass('selected');
							});
							self.filterList(productListing);
							// check if sort needs to be reset
							if (filterGroup.find('ul > li[data-sort]').length > 0) {
								productListing.isotope({
									sortBy: "original-order",
									sortAscending: true
								});
							}
						});
					});
				} else { // if filter does not have selected reset
					filterGroup.find('.selected-items').each(function () {
						$(this).html('Select');
						$(this).unbind('click');
					});
				}
			});
		});
	},
	initColorways: function () {
		$('.product-listing .product-item a .colorways .swatch').off('click.colorway'); // remove old listeners
		$('.product-listing .product-item a .colorways .swatch').on('click.colorway', function (e) {
			e.preventDefault();
			// set image src of product image
			$(this).parent().parent().find('.product-img').attr('src', $(this).attr('data-src'));
			$(this).parent().parent().find('.swatch').removeClass('active');
			$(this).addClass('active');
		});
	},
	filterList: function (productListing) {
		var filterArray = []; // set up array for recording filter options
		$('.product-filtering > li.filters').each(function () { // loop through each filter group
			if (filterArray.length < 1) { // first ul of filters have not been added yet, so lets do it
				$(this).find('ul > li[data-filter]').each(function () {
					var filterItem = $(this);
					if (filterItem.hasClass('selected')) {
						filterArray.push(filterItem.attr('data-filter')); // add filters to array to track
					}
				});
			} else { // first list of filters have been added, now build upon them
				var filterArrayTemp, filterSet;
				filterArrayTemp = []; // new array to update filterArray after it's built based on filterArray and new filters to concatinate
				$(this).find('ul > li[data-filter]').each(function () {
					var filterItem = $(this);
					if (filterItem.hasClass('selected')) {
						filterSet = true; // mark that we found another filter so we need to update the filterArray
						for (var i = 0; i < filterArray.length; i++) {
							filterArrayTemp.push(filterArray[i] + filterItem.attr('data-filter')); // concatinate current filters with new
						}
					}
				});
				if (filterSet === true) {
					filterArray = filterArrayTemp.slice(0); // update main array
				}
			}
		});
		// build filterList string
		filterList = ""; // default to no filter
		for (var i = 0; i < filterArray.length; i++) {
			if (i === 0) { // first item has no commas
				filterList = filterArray[i];
			} else {
				filterList += ", " + filterArray[i];
			}
		}
		// should look something like this - { filter: ".womens.Narrow, .youth.BTX" }
		// update hash history, this triggers the hash change event which will submit the filters
		if (filterArray.length > 0) {
			window.location.hash = 'filter=' + encodeURIComponent(filterList);
		} else {
			window.location.hash = 'all';
		}
	}
};
