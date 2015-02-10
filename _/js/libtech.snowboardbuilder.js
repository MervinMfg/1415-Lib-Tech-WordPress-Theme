/*
 * Lib Tech DIY Snowboard Builder - http://lib-tech.com/diy
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var LIBTECH = LIBTECH || {};

LIBTECH.SnowboardBuilder = function () {
	this.config = {
		boardData: null,
		contourData: null,
		boardDescriptionData: null,
		baseImgPath: 'http://cdn.lib-tech.com/wp-content/themes/1415-Lib-Tech-WordPress-Theme/_/img/diy/',
		topGraphicImg: 0, // top
		sidewallTopImg: 0,
		sidewallBottomImg: 0,
		nCurSlide: 0,
		iJSON: 0,
		bBoardShape: "",
		bBoardPrice: "",
		bSize: false,
		bTop: "",
		bDesc: "",
		bArtist: "",
		bSidewall: "",
		bSidewallDesc: "",
		bBase: "",
		bBaseArtist: "",
		bBaseDesc: "",
		bCustomBaseColor: "black",
		bCustomTextColor: "white",
		bBadge: "",
		nPreviewNum: 0,
		bFirstPlay: true,
		confirmedShapeSelection: false,
		globalNum: 0,
		bbRegion: "",
		bbRegionCurrency: "",
		bbKnifeCutDiff: "",
		isKnifecut: "",
		isMobile: false,
		isIpad: false,
		isSharePage: false,
		$mainSlider: "",
		defaultBadgeInput: "",
		defaultBaseInput: "",
		currentCarousel: "",
		showLeftMenu: true,
		carouselItemWidth: 0
	};
	this.init();
};
LIBTECH.SnowboardBuilder.prototype = {
	init: function () {
		var self, dataRequest;
		self = this;
		// Grab Board Builder Data
		dataRequest = $.ajax({
			url: "/wp-content/themes/1415-Lib-Tech-WordPress-Theme/_/json/snowboard-builder.json",
			type: 'get',
			dataType: 'json'
		});
		// on complete process data and assign variables
		dataRequest.done(function( json ) {
			self.config.boardData = json.snowboards;
			self.config.contourData = json.contours;
			self.config.boardDescriptionData = json.boardDescriptions;
			self.config.boardBaseDescriptionData = json.boardBaseDescriptions;
			// completed load, decide what to init
			if ($('body').hasClass('page-template-page-templatessnowboard-builder-share-php')) {
				self.initShare();
			} else {
				self.initBuilder();
			}
		});
		self.initOrientation();
	},
	initBuilder: function () {
		var self = this;
		// set base default colors
		self.setCustomTextColor('White');
		self.setCustomBaseColor('Black');
		// get default input values
		self.defaultBadgeInput = $('.board-badge-input-holder #board-badge-input').val();
		self.defaultBaseInput = $('#knifecut-base-controls .knifecut-input #board-text-input').val();
		// check if device is an iPad
		//var iPad = /(iPad|iPhone|iPod)/g.test(navigator.userAgent);
		self.config.isIpad = /(iPad)/g.test(navigator.userAgent);
		// setup main BX Slider instance
		self.config.$mainSlider = $('.bx-div-slider').bxSlider({
			slideMargin: 0,
			speed: 231,
			touchEnabled: false,
			pager: true,
			pagerSelector: '#header .pagination .controls',
			controls: false,
			preventDefaultSwipeX: true,
			auto: false,
			mode: 'horizontal',
			useCSS: false,
			onSlideLoad: function () {},
			onSlideBefore: function () {
				self.advanceArrowHide();
				// hide info box
				$('#info-box').removeClass('show');
			},
			onSlideAfter: function () {
				// don't run first time, wait for delayed load
				if(self.config.bFirstPlay === false) {
					self.setCurrentSection();
				}
			}
		});
		$(window).on('resize', function () {
			waitForFinalEvent(function () {
				self.config.aspectRatio = $(window).height() / $(window).width();
				self.resizeLayout();
			}, 500, "mervinsbb");
		});
		$(window).trigger('resize');
		// listen for flag selection
		$("#header .flag a").on('click', function (e) {
			e.preventDefault();
			e.stopPropagation(); // kill even from firing further
			if (navigator.cookieEnabled === false) {
				alert('Enable cookies in your browser in order to select your region.');
			} else {
				LIBTECH.main.config.regionSelector.overlayInit();
			}
		});
		// init the overview
		$('#overview .overview-content .right-column a').on('click', function (e) {
			e.preventDefault();
			e.stopPropagation(); // kill even from firing further
			// hide/kill overview
			$(this).off('click');
			TweenMax.to($('#overview'), 1, {autoAlpha:0, onComplete:function(){$('#overview').css('display', 'none');}});
			// set the first section
			self.setCurrentSection();
			// set region
			if (LIBTECH.main.utilities.cookie.getCookie('libtech_currency') !== "" && LIBTECH.main.utilities.cookie.getCookie('libtech_currency') !== undefined) {
				self.bbSetRegion(LIBTECH.main.utilities.cookie.getCookie('libtech_currency'));
			}
		});
		// make sure overview video fits
		$('#overview .overview-content .right-column .overview-video').fitVids();
		self.boardPreviewInit();
		// hide the div blocker
		TweenMax.to($('#div-blocker'), 1, {autoAlpha:0, delay:0.2});
	},
	initShare: function () {
		var self = this;
		self.config.isSharePage = true;
		if (LIBTECH.main.utilities.cookie.getCookie('libtech_currency') !== "" && LIBTECH.main.utilities.cookie.getCookie('libtech_currency') !== undefined) {
			self.bbSetRegion(LIBTECH.main.utilities.cookie.getCookie('libtech_currency'));
		}
		self.buildShare();
		$(window).on('load', function () {
			self.resizeLayout();
			TweenMax.to($('#div-blocker'), 1, {autoAlpha:0, delay:0.2});
		});
		$(window).on('resize', function () {
			waitForFinalEvent(function () {
				self.config.aspectRatio = $(window).height() / $(window).width();
				self.resizeLayout();
			}, 500, "mervinsbb");
		});
	},
	initOrientation: function () {
		// if on iPad using Chrome check orientation change and set appropriate viewport to fix input field bugs related to viewport size
		// viewport size changes in Chrome when inputs are selected
		function checkOrientation() {
			switch (window.orientation) {
				case -90:
				case 90:
					$('meta[name=viewport]').attr('content', 'initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, width=device-height, height=device-width, user-scalable=no');
					break;
				default:
					$('meta[name=viewport]').attr('content', 'initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, width=device-width, height=device-height, user-scalable=no');
					break;
			}
		}
		if(navigator.userAgent.match('iPad') && navigator.userAgent.match('CriOS')) { // CriOS is used to identify the chrome app on iOS
			$(window).on('orientationchange', function () {
				checkOrientation();
			});
			checkOrientation();
		}
	},
	bbSetRegion: function (currencyCode) {
		var self = this;
		// set region currency
		if (currencyCode == "INT") {
			self.config.bbRegionCurrency = "USD";
		} else if (currencyCode == "USD" || currencyCode == "CAD" || currencyCode == "EUR") {
			self.config.bbRegionCurrency = currencyCode;
		} else {
			self.config.bbRegionCurrency = "USD";
		}
		// set regioin
		if (currencyCode == "USD" || currencyCode == "CAD" || currencyCode == "EUR" || currencyCode == "INT") {
			self.config.bbRegion = currencyCode;
		} else {
			self.config.bbRegion = "USD";
		}
	},
	setKnifeCutPrice: function (nKC) {
		var self = this;
		self.config.bbKnifeCutDiff = (nKC === '' || nKC === undefined) ? "0.00" : nKC;
		self.config.bbKnifeCutDiff = nKC;
	},
	getKnifeCutPrice: function () {
		var self = this;
		if (self.config.bbKnifeCutDiff === '' || self.config.bbKnifeCutDiff === undefined) {
			self.config.bbKnifeCutDiff = "0.00";
		}
		return self.config.bbKnifeCutDiff;
	},
	getDisplayPrice: function(price) {
		var self = this;
		if (self.config.bbRegion == "EUR") {
			price = parseFloat(price).toFixed(2).replace('.', ',');
			return "€" + price + " " + self.config.bbRegionCurrency;
		} else {
			price = parseFloat(price).toFixed(2);
			return "$" + price + " " + self.config.bbRegionCurrency;
		}
	},
	setBoardShape: function (oImg) {
		var self, spanVal, boardNum, theContour, sShape;
		self = this;
		if (oImg === "" || oImg === undefined) {
			spanVal = 1;
			boardNum = self.config.globalNum;
			self.setBoardSize('');
			$(".step1-board .carousel ul li img").each(function () {
				$(this).removeClass('selectedShape');
				$(this).removeClass('confirmedShape');
			});
		} else {
			spanVal = self.config.globalNum;
			boardNum = spanVal;
		}
		self.config.iJSON = spanVal;
		sNoDash = self.config.boardData[boardNum].model;
		// updated board display
		$('#board-display .board-name').text(sNoDash);
		// Board Details
		$('.step2-size .board-info .board').html(sNoDash);
		$('.step2-size .board-info .shape-desc').html("<span>SHAPE</span> " + self.config.boardData[boardNum].shapeDescription);
		$('.step2-size .board-info .board-tagline').text(self.config.boardData[boardNum].boardTagline);
		$('.step2-size .board-info .board-desc').text(self.config.boardData[boardNum].boardDescription);
		// Contour Details
		theContour = self.getBoardContour(boardNum);
		$('.step2-size .board-info .contour-title').html(theContour.title);
		$('.step2-size .board-info .contour-desc').html(theContour.description);
		// Size Details
		$('.step2-size .size-info .size-holder .sizes').html(self.calculateSizes(self.config.boardData[boardNum].sizes));
		$('.step2-size .size-info .size-detail-table .table-data').html(self.printSizeInfo(self.config.boardData[boardNum].contactLength, self.config.boardData[boardNum].sidecut, self.config.boardData[boardNum].waistWidth, self.config.boardData[boardNum].flex) + "");
		$('.step2-size .size-info .size-detail-table .table-data').clone().wrap('<p>').parent().html();
		// set price
		if (self.config.bbRegion == "CAD") {
			self.setBoardPrice(self.config.boardData[boardNum].basePriceCA);
		} else if (self.config.bbRegion == "EUR") {
			self.setBoardPrice(self.config.boardData[boardNum].basePriceEU);
		} else {
			self.setBoardPrice(self.config.boardData[boardNum].basePriceUS);
		}
		// var that is carried over
		sShape = self.config.boardData[boardNum].model;
		// clear board size
		self.setBoardSize('');
		if (sShape === "" || sShape === undefined) {
			self.advanceArrowHide();
			// unselect board shape image
			$(".step1-board .carousel ul li img").each(function () {
				$(this).removeClass('selectedShape');
				$(this).removeClass('confirmedShape');
			});
			sShape = "";
			self.setBoardSize('');
		}
		// show arrow if shape a selected
		if (oImg !== "" && oImg !== undefined) {
			self.advanceArrowShow();
		}
		self.config.bBoardShape = sShape;
		self.updateBoardDisplay();
	},
	getBoardShape: function () {
		var self = this;
		if (self.config.bBoardShape === '' || self.config.bBoardShape === undefined) {
			self.config.bBoardShape = "";
		}
		return self.config.bBoardShape;
	},
	setBoardPrice: function (nPrice) {
		var self = this;
		self.config.bBoardPrice = nPrice;
	},
	getBoardPrice: function () {
		var self = this;
		return parseFloat(self.config.bBoardPrice);
	},
	setBoardTech: function (sTech) {
		var self = this;
		self.config.bTech = sTech;
	},
	getBoardTech: function () {
		var self = this;
		return self.config.bTech;
	},
	setBoardSize: function (sSize) {
		var self = this;
		if (sSize === '' || sSize === undefined) {
			$('#left-menu .menu2 .menu-title').html("Size");
			$('#left-menu .menu2').removeClass('complete');
			$(".step2-size .size-info .size-detail-table .table-data li").each(function (index) {
				$(this).removeClass("selected");
			});
			$(".step2-size .size-info .size-holder .sizes .size-item").each(function (index) {
				$(this).removeClass('selected');
			});
			self.advanceArrowHide();
		}
		self.config.bSize = sSize;
		self.buildReciepts();
	},
	getBoardSize: function () {
		var self = this;
		if (self.config.bSize !== null && self.config.bSize !== undefined && self.config.bSize) {
			return self.config.bSize;
		} else {
			return "";
		}
	},
	getBoardContour: function (boardId) {
		var self, contour;
		self = this;
		contour = null;
		 _.find(self.config.contourData, function(item) {
		 	if (item.name == self.config.boardData[boardId].contour) {
		 		contour = item; 
		 	}
		});
		return contour;
	},
	/* TOP */
	setBoardTop: function (selectedTopImg) {
		var self, imgName, imgDesc;
		self = this;
		imgName = $(selectedTopImg).attr("data-artist");
		imgDesc = $(selectedTopImg).attr("data-desc");
		if (imgDesc === "" || imgDesc === undefined) {
			self.advanceArrowHide();
			self.setBoardArtist('');
			self.setBoardDescription('');
			self.config.bTop = "";
			$(".step3-top ul li img").each(function () {
				$(this).removeClass('selectedShape');
				$(this).removeClass('confirmedShape');
			});
		} else {
			self.setBoardArtist(imgName);
			self.setBoardDescription(imgDesc);
			self.config.bTop = imgDesc;
			$('.step3-top .topInfo h2').html(imgName);
			$('.step3-top .topInfo h3').html(imgDesc);
			$('#left-menu .menu3').addClass('complete');
			$('#left-menu .menu3 .menu-title').html("" + "" + imgName + " " + imgDesc + "<b><br>+ " + self.getDisplayPrice(0) + "</b>");
			self.boardPreviewSet(2);
		}
		self.updateBoardDisplay();
		// show arrow if shape a selected
		if (selectedTopImg !== "" && selectedTopImg !== undefined) {
			self.advanceArrowShow();
		}
	},
	getBoardTop: function () {
		var self = this;
		return self.config.bTop;
	},
	setBoardDescription: function (sDesc) {
		var self = this;
		self.config.bDesc = sDesc;
	},
	getBoardDescription: function () {
		var self = this;
		if (self.config.bDesc === '' || self.config.bDesc === undefined) {
			self.config.bDesc = "";
		}
		return self.config.bDesc;
	},
	setBoardArtist: function (sArtist) {
		var self = this;
		self.config.bArtist = sArtist;
	},
	getBoardArtist: function () {
		var self = this;
		if (self.config.bArtist === '' || self.config.bArtist === undefined) {
			self.config.bArtist = "";
		}
		return self.config.bArtist;
	},
	/* SIDEWALL */
	setBoardSidewall: function (selectedSidewallImg) {
		var self, sColor, sDesc;
		self = this;
		sColor = $(selectedSidewallImg).attr("data-color");
		sDesc = $(selectedSidewallImg).attr("data-desc");
		if (sColor === "" || sColor === undefined) {
			self.advanceArrowHide();
			self.config.bSidewall = "";
			self.config.bSidewallDesc = "";
			self.advanceArrowHide();
			$(".step4-sidewall ul li img").each(function () {
				$(this).removeClass('selectedShape');
				$(this).removeClass('confirmedShape');
			});
		} else {
			self.config.bSidewall = sColor;
			self.config.bSidewallDesc = sDesc;
			$('#left-menu .menu4 .menu-title').html("" + " " + self.getBoardSidewall() + " " + "" + "<br><b>+ " + self.getDisplayPrice(0) + "</b>");
			$('#left-menu .menu4').addClass('complete');
		}
		self.updateBoardDisplay();
		// show arrow if shape a selected
		if (selectedSidewallImg !== "" && selectedSidewallImg !== undefined) {
			self.advanceArrowShow();
		}
	},
	getBoardSidewall: function () {
		var self = this;
		return self.config.bSidewall;
	},
	getBoardSidewallDesc: function () {
		var self = this;
		return self.config.bSidewallDesc;
	},
	/* BASE */
	setBoardBase: function (selectedBaseImg) {
		var self, imgName, imgDesc;
		self = this;
		imgName = $(selectedBaseImg).attr("data-artist");
		imgDesc = $(selectedBaseImg).attr("data-desc");
		if (imgDesc === "" || imgDesc === undefined) {
			self.advanceArrowHide();
			self.setBoardBaseArtist('');
			self.setBoardBaseDesc('');
			self.config.bBase = "";
			self.config.isKnifecut = false;
			$(".step5-base ul li img").each(function () {
				$(this).removeClass('selectedShape');
				$(this).removeClass('confirmedShape');
			});
		} else {
			self.setBoardBaseArtist(imgName);
			self.config.bBase = imgName;
			if (imgName == 'Custom') {
				var kcPrice, nonKCPrice, kcPriceDifference;
				// KNIFE CUT BASE
				self.config.isKnifecut = true;
				self.setBoardBaseDesc($('.board-text-custom').val());
				if (self.config.bbRegion == "CAD") {
					kcPrice = self.config.boardData[self.config.globalNum].knifecutPriceCA;
					nonKCPrice = self.config.boardData[self.config.globalNum].basePriceCA;
				} else if (self.config.bbRegion == "EUR") {
					kcPrice = self.config.boardData[self.config.globalNum].knifecutPriceEU;
					nonKCPrice = self.config.boardData[self.config.globalNum].basePriceEU;
				} else {
					kcPrice = self.config.boardData[self.config.globalNum].knifecutPriceUS;
					nonKCPrice = self.config.boardData[self.config.globalNum].basePriceUS;
				}
				kcPriceDifference = parseFloat((kcPrice - nonKCPrice).toFixed(2));
				self.setKnifeCutPrice(kcPriceDifference);
				$('#left-menu .menu5 .menu-title').html("" + "  " + "CUSTOMIZED TEXT" + "<br /><b>+ " + self.getDisplayPrice(kcPriceDifference) + "</b>");
				// show menu 5b
				$('#left-menu .menu5b').addClass('show');
				$('#header .pagination .controls .bx-pager-item:eq(5)').addClass('show');
			} else {
				// GRAPHIC BASE
				self.setBoardBaseDesc(imgDesc);
				self.config.isKnifecut = false;
				$('#left-menu .menu5 .menu-title').html("" + "  " + imgName + " " + imgDesc + "<br><b>+ " + self.getDisplayPrice(0) + "</b>");
				// remove menu 5b
				$('#left-menu .menu5b').removeClass('show');
				$('#header .pagination .controls .bx-pager-item:eq(5)').removeClass('show');
			}
			$('#left-menu .menu5').addClass('complete');
		}
		self.updateBoardDisplay();
		// show arrow if shape a selected
		if (selectedBaseImg !== "" && selectedBaseImg !== undefined) {
			self.advanceArrowShow();
		}
	},
	getBoardBase: function () {
		var self = this;
		if (self.config.bBase === '' || self.config.bBase === undefined) {
			self.config.bBase = "";
		}
		return self.config.bBase;
	},
	setBoardBaseArtist: function (sBase) {
		var self = this;
		self.config.bBaseArtist = sBase;
	},
	getBoardBaseArtist: function () {
		var self = this;
		if (self.config.bBaseArtist === '' || self.config.bBaseArtist === undefined) {
			self.config.bBaseArtist = "";
		}
		return self.config.bBaseArtist;
	},
	setBoardBaseDesc: function (sBase) {
		var self = this;
		self.config.bBaseDesc = sBase;
		if(self.getBoardBaseArtist() === "Custom" && sBase !== "") {
			$('#left-menu .menu5b .menu-title').html(sBase);
			$('#left-menu .menu5b').addClass('complete');
		}
	},
	getBoardBaseDesc: function () {
		var self = this;
		if (self.config.bBaseDesc === '' || self.config.bBaseDesc === undefined) {
			self.config.bBaseDesc = "";
		}
		return self.config.bBaseDesc;
	},
	setCustomBaseColor: function (sBaseColor) {
		var self = this;
		self.config.bCustomBaseColor = sBaseColor;
	},
	getCustomBaseColor: function () {
		var self = this;
		return self.config.bCustomBaseColor;
	},
	setCustomTextColor: function (sBaseTextColor) {
		var self = this;
		self.config.bCustomTextColor = sBaseTextColor;
	},
	getCustomTextColor: function () {
		var self = this;
		return self.config.bCustomTextColor;
	},
	setBoardBadge: function (sBadge) {
		var self = this;
		if (sBadge === "" || sBadge === undefined) {
			$('#left-menu .menu6 .menu-title').html("Personalized Badge");
			$('#left-menu .menu6').removeClass('complete');
			$('.step6-badge .board-badge .badge-text').html('');
		}
		self.config.bBadge = sBadge;
		self.buildReciepts();
	},
	getBoardBadge: function () {
		var self = this;
		return self.config.bBadge;
	},
	updateBoardDisplay: function () {
		var self, boardShape, topArist, topDesc, customTextColor, customBaseColor, baseArist, baseDesc, sidewallColor;
		self = this;
		boardShape = self.getBoardShape().toUpperCase().split(' ').join('-');
		if (boardShape === "" || boardShape === undefined) {
			boardShape = "SKATE-BANANA";
		}
		topArist = self.getBoardArtist().toUpperCase().split(' ').join('-');
		topDesc = self.getBoardDescription().toUpperCase().split(' ').join('-');
		customTextColor = self.getCustomTextColor().toUpperCase().split(' ').join('-');
		customBaseColor = self.getCustomBaseColor().toUpperCase().split(' ').join('-');
		baseArist = self.getBoardBaseArtist().toUpperCase().split(' ').join('-');
		baseDesc = self.getBoardBaseDesc().toUpperCase().split(' ').join('-');
		sidewallColor = self.getBoardSidewallDesc().toUpperCase().split(' ').join('-');
		// SET TOP GRAPHIC
		if (topArist === "" || topArist === undefined || topDesc === undefined || topDesc === "") {
			self.config.topGraphicImg = self.config.baseImgPath + "snowboard-top/default/" + boardShape + ".png";
		} else {
			self.config.topGraphicImg = self.config.baseImgPath + "snowboard-top/top/" + boardShape + "-" + topArist + "-" + topDesc + ".png";
		}
		$('#board-display .board-preview .board-views .preview-top .board .board-image img').attr('src', self.config.topGraphicImg);
		// SET SIDEWALL GRAPHIC
		if(sidewallColor === "" || sidewallColor === undefined) {
			// set default to yellow, so we don't error when building sidewall
			self.config.sidewallTopImg = self.config.baseImgPath + "snowboard-sidewall/sidewall/" + boardShape + "-YELLOW.png";
			// but hide the default yellow sidewall
			$('#board-display .board-preview .board-views .preview-side .board .board-image img.sidewall-top').css('display', 'none');
		} else {
			self.config.sidewallTopImg = self.config.baseImgPath + "snowboard-sidewall/sidewall/" + boardShape + "-" + sidewallColor + ".png";
			// show the new, selected sidewall
			$('#board-display .board-preview .board-views .preview-side .board .board-image img.sidewall-top').css('display', 'block');
		}
		// sidewall bottom image
		if (topArist === "" || topArist === undefined || topDesc === undefined || topDesc === "") {
			self.config.sidewallBottomImg = self.config.baseImgPath + "snowboard-sidewall/default/" + boardShape + ".png";
		} else {
			self.config.sidewallBottomImg = self.config.baseImgPath + "snowboard-sidewall/sidewall-top/" + boardShape + "-" + topArist + "-" + topDesc + ".png";
		}
		// END UPDATE SIDEWALL
		// load new sidewall images
		$('#board-display .board-preview .board-views .preview-side .board .board-image img.sidewall-top').attr('src', self.config.sidewallTopImg);
		$('#board-display .board-preview .board-views .preview-side .board .board-image img.sidewall-bottom').attr('src', self.config.sidewallBottomImg);
		// $('#board-display .board-preview .board-views .preview-side .board .board-image img.sidewall-hidden').attr('src', self.config.topGraphicImg); // just a placeholder
		// SET BASE GRAPHIC
		if(self.config.isKnifecut) {
			// KNIFE CUT BASE
			// if banana blaster, asign different logo image... it's smaller
			if(boardShape == "BANANA-BLASTER") {
				iNewBaseText = self.config.baseImgPath + "snowboard-base/custom-colors-logo/LIB-LOGO-BANANA-BLASTER-" + customTextColor + ".png";
			} else {
				iNewBaseText = self.config.baseImgPath + "snowboard-base/custom-colors-logo/LIB-LOGO-ALL-" + customTextColor + ".png";
			}
			iNewBaseImg = self.config.baseImgPath + "snowboard-base/custom-colors-board/" + boardShape + "-" + customBaseColor + ".png";
			$('#board-display .board-preview .board-views .preview-base .board .board-image .base').attr('src', iNewBaseImg);
			$('#board-display .board-preview .board-views .preview-base .board .board-image .custom-base-logo').attr('src', iNewBaseText);
			$('#board-display .board-preview .board-views .preview-base .board .board-image .custom-base-logo').css('display', 'block');
			$('#board-display .board-preview .board-views .preview-base .board .board-image .board-text .board-text-custom').css('display', 'inline');
			// set knifecut text to be sure it's right
			if(self.getBoardBaseDesc() === "" || self.getBoardBaseDesc() === undefined) {
				var knifecutInputVal = $('#knifecut-base-controls .knifecut-input #board-text-input').val();
				if(self.defaultBaseInput === knifecutInputVal || knifecutInputVal === "") {
					$('#board-display .preview-base .board .board-text .rotate-one .board-text-custom').html('DIY BASE!');
				} else {
					$('#board-display .preview-base .board .board-text .rotate-one .board-text-custom').html(knifecutInputVal);
				}
			} else {
				$('#board-display .preview-base .board .board-text .rotate-one .board-text-custom').html(self.getBoardBaseDesc());
			}
			// set board font size			
			var knifecutText = $('#board-display .board-preview .board-views .preview-base .board .board-image .board-text .rotate-one .board-text-custom');
			var knifecutTextHolder = $("#board-display .board-preview .board-views .preview-base .board .board-image .board-text");
			// check which page we're viewing
			if (!self.config.isSharePage) {
				if (self.config.$mainSlider.getCurrentSlide() != 7) {
					// any slide that's not the buy section
					var boardWidth = $("#board-display .board-preview").width();
				} else {
					// if we're on step 7, we need to change how we evaluate the width because multiple boards are show at the same time
					if (self.config.isMobile) {
						var boardWidth = $("#board-display .board-preview").width()/2;
					} else {
						var boardWidth = $("#board-display .board-preview").width()/3;
					}
				}
			} else {
				// share page
				var boardWidth = $("#board-display .board-preview").width()/3;
			}
			knifecutText.css('font-size', Math.floor(boardWidth/2) + 'px');
			// scale font down till it fits
			while(knifecutText.width() >= knifecutTextHolder.width()) {
				var currentSize = knifecutText.css('font-size');
				var newSize = currentSize.replace("px","");
				newSize = Math.floor(newSize - 1);
				knifecutText.css('font-size', newSize + 'px');
			}
			var textHeight = knifecutText.height();
			knifecutTextHolder.css('left', Math.floor((boardWidth - textHeight)/2));
			// determine hex value
			var customTextColorHex;
			switch (customTextColor) {
				case 'GREY':
					customTextColorHex = "#999999";
					break;
				case 'ORANGE':
					customTextColorHex = "#FF6600";
					break;
				case 'YELLOW':
					customTextColorHex = "#FFCC00";
					break;
				case 'BLACK':
					customTextColorHex = "#000000";
					break;
				case 'WHITE':
					customTextColorHex = "#FFFFFF";
					break;
				case 'GREEN':
					customTextColorHex = "#99CC00";
					break;
				case 'BLUE':
					customTextColorHex = "#0099FF";
					break;
				case 'RED':
					customTextColorHex = "#CC3333";
					break;
			}
			$('#board-display .board-preview .board-views .preview-base .board .board-image .board-text .rotate-one .board-text-custom').css('color', customTextColorHex);
		} else {
			// GRAPHIC BASE
			if (baseArist === "" || baseArist === undefined) {
				iNewImgBase = self.config.baseImgPath + "snowboard-base/default/" + boardShape + ".png";
			} else {
				iNewImgBase = self.config.baseImgPath + "snowboard-base/base/" + boardShape + "-" + baseArist + "-" + baseDesc + ".png";
			}
			$('#board-display .board-preview .board-views .preview-base .board .board-image .base').attr('src', iNewImgBase);
			$('#board-display .board-preview .board-views .preview-base .board .board-image .custom-base-logo').css('display', 'none');
			$('#board-display .board-preview .board-views .preview-base .board .board-image .board-text .board-text-custom').css('display', 'none');
		}
		self.buildReciepts();
	},
	resetAll: function () {
		var self = this;
		// reset menu titles
		$('#left-menu .menu1 .menu-title').html("SHAPE & CONTOUR");
		$('#left-menu .menu2 .menu-title').html("Size");
		$('#left-menu .menu3 .menu-title').html("Top Sheet Art");
		$('#left-menu .menu4 .menu-title').html("Sidewall Color");
		$('#left-menu .menu5 .menu-title').html("Base Options");
		$('#left-menu .menu5b .menu-title').html("Text");
		$('#left-menu .menu6 .menu-title').html("Personalized Badge");
		// remove complete bolding
		$('#left-menu li').removeClass('complete');
		// make sure knifecut menu option is hidden
		$('#left-menu .menu5b').removeClass('show');
		// reset saved input values
		self.setBoardShape('');
		self.setBoardSize('');
		self.setBoardTop('');
		self.setBoardArtist('');
		self.setBoardDescription('');
		self.setBoardSidewall('');
		self.setBoardBase('');
		self.setBoardBaseArtist('');
		self.setBoardBaseDesc('');
		self.setBoardBadge('');
	},
	getParameterByName: function (name) {
		name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
		var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
			results = regex.exec(location.search);
		return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	},
	buildShare: function () {
		var self = this;
		if(self.getParameterByName('shape') !== "" && self.getParameterByName('size') !== "" && self.getParameterByName('top') !== "" && self.getParameterByName('sidewall') !== "" && self.getParameterByName('badge') !== "") {
			// set shape
			var shape = self.getParameterByName('shape');
			// set global number based on matching shape
			for (var i = 0; i < self.config.boardData.length; i++) {
				if(self.config.boardData[i].model == shape) {
					self.config.globalNum = i;
				}
			}
			self.setBoardShape(shape);
			// set size
			self.setBoardSize(self.getParameterByName('size'));
			// set top
			var top = self.getParameterByName('top');
			var topArtist = top.split(" ")[0];
			var topDesc = top.substr(top.indexOf(' ')+1); // grab everthing after first space
			self.setBoardArtist(topArtist);
			self.setBoardDescription(topDesc);
			// set sidewall
			var sidewall = self.getParameterByName('sidewall');
			var sidewallDesc = sidewall.split("/")[1];
			self.config.bSidewall = sidewall;
			self.config.bSidewallDesc = sidewallDesc;
			// set badge
			var badge = self.getParameterByName('badge');
			self.setBoardBadge(badge);
			if(self.getParameterByName('base') !== "") {
				// set graphic base
				var base, baseArtist, baseDesc;
				base = self.getParameterByName('base');
				baseArtist = base.split(" ")[0];
				baseDesc = base.substr(base.indexOf(' ')+1); // grab everthing after first space
				self.setBoardBaseArtist(baseArtist);
				self.setBoardBaseDesc(baseDesc);
				self.config.bBase = baseArtist;
				self.config.isKnifecut = false;
			} else if (self.getParameterByName('kt') !== "" && self.getParameterByName('kbc') !== "" && self.getParameterByName('ktc') !== "") {
				// set knifecut base
				var knifecutText, knifecutBaseColor, knifecutTextColor, kcPriceDifference, kcPrice, nonKCPrice;
				knifecutText = self.getParameterByName('kt');
				knifecutBaseColor = self.getParameterByName('kbc');
				knifecutTextColor = self.getParameterByName('ktc');
				self.setBoardBaseArtist('Custom');
				self.setBoardBaseDesc(knifecutText);
				self.setCustomBaseColor(knifecutBaseColor);
				self.setCustomTextColor(knifecutTextColor);
				self.config.isKnifecut = true;
				// set knifecut price
				if (self.config.bbRegion == "CAD") {
					kcPrice = self.config.boardData[self.config.globalNum].knifecutPriceCA;
					nonKCPrice = self.config.boardData[self.config.globalNum].basePriceCA;
				} else if (self.config.bbRegion == "EUR") {
					kcPrice = self.config.boardData[self.config.globalNum].knifecutPriceEU;
					nonKCPrice = self.config.boardData[self.config.globalNum].basePriceEU;
				} else {
					kcPrice = self.config.boardData[self.config.globalNum].knifecutPriceUS;
					nonKCPrice = self.config.boardData[self.config.globalNum].basePriceUS;
				}
				kcPriceDifference = parseFloat((kcPrice - nonKCPrice).toFixed(2));
				self.setKnifeCutPrice(kcPriceDifference);
			} else {
				// no base found
				window.location.href = "/snowboarding/snowboard-builder/";
				return;
			}
		} else {
			// not all parameters found
			window.location.href = "/snowboarding/snowboard-builder/";
			return;
		}
		self.updateBoardDisplay();
		self.step7Init();
	},
	flyOutMenuInit: function () {
		var self = this;
		$('#left-menu, #left-menu .menu-header').on("mouseenter.left-menu, touch.left-menu", function () {
			$('#left-menu').addClass('open');
		});
		$('#left-menu').on("mouseleave.left-menu", function () {
			$('#left-menu').removeClass('open');
		});
		// check if iPad
		if (self.config.isIpad) {
			$('#left-menu .menu-close').on("click.left-menu touch.left-menu", function () {
				$('#left-menu').removeClass('open');
			});
		}
		// MENU - REMOVE OPTIONS
		$('#left-menu .menu1 .menu-x').on("click.left-menu touch.left-menu", function () {
			$('#left-menu .menu1 .menu-title').html("Shape & Contour");
			$('#left-menu .menu1').removeClass('complete');
			self.advanceArrowHide();
			self.setBoardShape('');
			self.confirmedShapeSelection = false;
			self.config.$mainSlider.goToSlide(0);
			// hide info box
			$('#info-box').removeClass('show');
		});
		$('#left-menu .menu2 .menu-x').on("click.left-menu touch.left-menu", function () {
			$('#left-menu .menu2 .menu-title').html("Size");
			$('#left-menu .menu2').removeClass('complete');
			self.setBoardSize("");
			self.config.$mainSlider.goToSlide(1);
		});
		$('#left-menu .menu3 .menu-x').on("click.left-menu touch.left-menu", function () {
			$('#left-menu .menu3 .menu-title').html("Topsheet Art");
			$('#left-menu .menu3').removeClass('complete');
			self.setBoardTop("");
			self.config.$mainSlider.goToSlide(2);
		});
		$('#left-menu .menu4 .menu-x').on("click.left-menu touch.left-menu", function () {
			$('#left-menu .menu4 .menu-title').html("Sidewall Color");
			$('#left-menu .menu4').removeClass('complete');
			self.setBoardSidewall("");
			self.config.$mainSlider.goToSlide(3);
		});
		$('#left-menu .menu5 .menu-x').on("click.left-menu touch.left-menu", function () {
			$('#left-menu .menu5 .menu-title').html("Base Options");
			$('#left-menu .menu5').removeClass('complete');
			$('#left-menu .menu5b').removeClass('show');
			self.setBoardBase("");
			// reset menu5b
			// reset input field
			self.setBoardBaseDesc('DIY Base!');
			// reset knifecut text
			self.setCustomTextColor('White');
			self.setCustomBaseColor('Black');
			// update
			self.updateBoardDisplay();
			self.boardPreviewSet(4);
			$('#board-text-input').val('');
			// reset left menu
			$('#left-menu .menu5b .menu-title').html("Text");
			$('#left-menu .menu5b').removeClass('complete');
			// display correct slide
			self.config.$mainSlider.goToSlide(4);
		});
		$('#left-menu .menu5b .menu-x').on("click.left-menu touch.left-menu", function () {
			// reset input field
			self.setBoardBaseDesc('DIY Base!');
			// reset knifecut text
			self.setCustomTextColor('White');
			self.setCustomBaseColor('Black');
			// update
			self.updateBoardDisplay();
			self.boardPreviewSet(5);
			$('#board-text-input').val('').focus();
			// reset left menu
			$('#left-menu .menu5b .menu-title').html("Text");
			$('#left-menu .menu5b').removeClass('complete');
			self.setBoardBase($('#customBase'));
			self.config.$mainSlider.goToSlide(5);
		});
		$('#left-menu .menu6 .menu-x').on("click.left-menu touch.left-menu", function () {
			$('#left-menu .menu6 .menu-title').html("Personalized Badge");
			$('#left-menu .menu6').removeClass('complete');
			$('.step6-badge .board-badge .badge-text').html('');
			self.setBoardBadge('');
			$('input[name=badge]').val(self.defaultBadgeInput);
			self.config.$mainSlider.goToSlide(6);
		});
		$('#left-menu .menu1, #left-menu .menu1 .menu-title').on("click.left-menu touch.left-menu", function () {
			self.config.$mainSlider.goToSlide(0);
			$('#left-menu').addClass('open');
		});
		$('#left-menu .menu2, #left-menu .menu2 .menu-title').on("click.left-menu touch.left-menu", function () {
			self.config.$mainSlider.goToSlide(1);
			$('#left-menu').addClass('open');
		});
		$('#left-menu .menu3, #left-menu .menu3 .menu-title').on("click.left-menu touch.left-menu", function () {
			self.config.$mainSlider.goToSlide(2);
			$('#left-menu').addClass('open');
		});
		$('#left-menu .menu4, #left-menu .menu4 .menu-title').on("click.left-menu touch.left-menu", function () {
			self.config.$mainSlider.goToSlide(3);
			$('#left-menu').addClass('open');
		});
		$('#left-menu .menu5, #left-menu .menu5 .menu-title').on("click.left-menu touch.left-menu", function () {
			self.config.$mainSlider.goToSlide(4);
			$('#left-menu').addClass('open');
		});
		$('#left-menu .menu5b, #left-menu .menu5b .menu-title').on("click.left-menu touch.left-menu", function () {
			self.config.$mainSlider.goToSlide(5);
			$('#left-menu').addClass('open');
		});
		$('#left-menu .menu6, #left-menu .menu6 .menu-title').on("click.left-menu touch.left-menu", function () {
			self.config.$mainSlider.goToSlide(6);
			$('#left-menu').addClass('open');
		});
		$('#left-menu .menu7, #left-menu .menu7 .menu-title').on("click.left-menu touch.left-menu", function () {
			self.config.$mainSlider.goToSlide(7);
			$('#left-menu').addClass('open');
		});
	},
	flyOutMenuUnInit: function () {
		var self = this;
		$('#left-menu, #left-menu .menu-header').off("mouseenter.left-menu, touch.left-menu");
		$('#left-menu').off("mouseleave.left-menu");
		// check if iPad
		if (self.config.isIpad) {
			$('#left-menu .menu-close').off("click.left-menu touch.left-menu");
		}
		$('#left-menu .menu1 .menu-x').off("click.left-menu touch.left-menu");
		$('#left-menu .menu2 .menu-x').off("click.left-menu touch.left-menu");
		$('#left-menu .menu3 .menu-x').off("click.left-menu touch.left-menu");
		$('#left-menu .menu4 .menu-x').off("click.left-menu touch.left-menu");
		$('#left-menu .menu5 .menu-x').off("click.left-menu touch.left-menu");
		$('#left-menu .menu5b .menu-x').off("click.left-menu touch.left-menu");
		$('#left-menu .menu6 .menu-x').off("click.left-menu touch.left-menu");
		$('#left-menu .menu1, #left-menu .menu1 .menu-title').off("click.left-menu touch.left-menu");
		$('#left-menu .menu2, #left-menu .menu2 .menu-title').off("click.left-menu touch.left-menu");
		$('#left-menu .menu3, #left-menu .menu3 .menu-title').off("click.left-menu touch.left-menu");
		$('#left-menu .menu4, #left-menu .menu4 .menu-title').off("click.left-menu touch.left-menu");
		$('#left-menu .menu5, #left-menu .menu5 .menu-title').off("click.left-menu touch.left-menu");
		$('#left-menu .menu5b, #left-menu .menu5b .menu-title').off("click.left-menu touch.left-menu");
		$('#left-menu .menu6, #left-menu .menu6 .menu-title').off("click.left-menu touch.left-menu");
		$('#left-menu .menu7, #left-menu .menu7 .menu-title').off("click.left-menu touch.left-menu");
	},
	mobileMenuInit: function () {
		$("#header .mobile-flyout-nav .display-board").on('click.mobile-menu touch.mobile-menu', function (e) {
			e.preventDefault();
			e.stopPropagation(); // kill even from firing further
			$(this).toggleClass('selected');
			$('#board-display').toggleClass('show');
			$("#header .mobile-flyout-nav .display-receipt").removeClass('selected');
			$('#mobile-receipt').removeClass('show');
		});
		$("#header .mobile-flyout-nav .display-receipt").on('click.mobile-menu touch.mobile-menu', function (e) {
			e.preventDefault();
			e.stopPropagation(); // kill even from firing further
			$(this).toggleClass('selected');
			$('#mobile-receipt').toggleClass('show');
			$("#header .mobile-flyout-nav .display-board").removeClass('selected');
			$('#board-display').removeClass('show');
		});
	},
	mobileMenuUnInit: function () {
		$("#header .mobile-flyout-nav .display-board").off('click.mobile-menu touch.mobile-menu');
		$("#header .mobile-flyout-nav .display-receipt").off('click.mobile-menu touch.mobile-menu');
	},
	boardPreviewInit: function () {
		var self = this;
		$('#board-display .board-menu-left-button').on('click touch', function () {
			self.boardPreviewCycle('left');
		});
		$('#board-display .board-menu-right-button').on('click touch', function () {
			self.boardPreviewCycle('right');
		});
	},
	boardPreviewCycle: function (sDirection) {
		var self = this;
		$('#board-display .board-preview').removeClass('top side base all');
		// check direction
		if (sDirection == 'left') {
			self.config.nPreviewNum--;
		} else {
			self.config.nPreviewNum++;
		}
		// check preview numbers
		if (self.config.nPreviewNum > 2) {
			self.config.nPreviewNum = 0;
		}
		if (self.config.nPreviewNum < 0) {
			self.config.nPreviewNum = 2;
		}
		// set classes
		if (self.config.nPreviewNum === 0) {
			$('#board-display .board-preview').addClass('top');
		}
		if (self.config.nPreviewNum === 1) {
			$('#board-display .board-preview').addClass('side');
		}
		if (self.config.nPreviewNum === 2) {
			$('#board-display .board-preview').addClass('base');
		}
		// make sure knifecut displays correctly
		self.updateBoardDisplay();
	},
	boardPreviewSet: function (nSlideNum) {
		var self = this;
		$('#board-display .board-preview').removeClass('top side base all');
		// hide and show for desktop based on step
		if (nSlideNum === 0) {
			$('#board-display').addClass('hide');
		} else {
			$('#board-display').removeClass('hide');
		}
		if (nSlideNum === 0 || nSlideNum === 1 || nSlideNum === 2 || nSlideNum === 6) {
			$('#board-display .board-preview').addClass('top');
			self.config.nPreviewNum = 0;
		} else if (nSlideNum == 3) {
			$('#board-display .board-preview').addClass('side');
			self.config.nPreviewNum = 1;
		} else if (nSlideNum == 4 || nSlideNum == 5) {
			$('#board-display .board-preview').addClass('base');
			self.config.nPreviewNum = 2;
		} else if (nSlideNum == 7) {
			$('#board-display .board-preview').addClass('all');
		}
	},
	advanceArrowShow: function () {
		var self = this;
		// add click/touch listener
		$('#advance-arrow').on("click touch", function () {
			if (!self.config.isKnifecut && self.config.$mainSlider.getCurrentSlide() == 4) {
				self.config.$mainSlider.goToSlide(6);
			} else {
				self.config.$mainSlider.goToNextSlide();
			}
			self.advanceArrowHide();
			$('#left-menu').removeClass('open');
		});
		$('#advance-arrow').addClass('show');
	},
	advanceArrowHide: function () {
		var self = this;
		// hide arrow
		$('#advance-arrow').removeClass('show');
		// remove click/touch listener
		$('#advance-arrow').off("click touch");
	},
	calculateSizes: function (sPipedSizes) {
		var sHTMLSizes = "";
		var sizeArray = sPipedSizes.split('|');
		sizeArray.forEach(function (entry) {
			entry = entry.trim();
			sHTMLSizes += "<div class=\"size-item\" val=\"" + entry + "\">" + entry + "</div>";
		});
		return sHTMLSizes;
	},
	printSizeInfo: function (sPipedLengths, sSideCut, sWaistWidth, sFlex) {
		var sHTMLLength, sizeArray, cutArray;
		sHTMLLength = "";
		sizeArray = sPipedLengths.split('|');
		//size col!
		sizeArrayOnly = sizeArray;
		sHTMLLength += "<div class=\"info-list\"><ul class=\"length-list\"><li>Size</li>";
		sizeArrayOnly.forEach(function (entry) {
			var sz = entry.split(' - ')[0];
			sHTMLLength += "<li class=\"sizeOnly " + $.trim(sz).replace(".", "_") + "\"> " + $.trim(sz) + "</li>";
		});
		sHTMLLength += "</ul></div>";

		cutArray = sSideCut.split('|');
		sHTMLLength += "<div class=\"info-list\"><ul class=\"side-list\"><li>Sidecut</li>";
		cutArray.forEach(function (cut) {
			var nSize = $.trim(cut.split(' - ')[0]).replace(".", "_");
			var nCut = $.trim(cut.split(' - ')[1]);
			sHTMLLength += "<li class=\"" + nSize + "\">" + nCut + "</li>";
		});
		sHTMLLength += "</ul></div>";

		sizeArray = sWaistWidth.split('|');
		sHTMLLength += "<div class=\"info-list\"><ul class=\"waist-list\"><li>Waist Width</li>";
		sizeArray.forEach(function (entry) {
			var nSize = $.trim(entry.split(' - ')[0]).replace(".", "_");
			var nWidth = $.trim(entry.split(' - ')[1]);
			sHTMLLength += "<li class=\"" + nSize + "\">" + nWidth + "</li>";
		});
		sHTMLLength += "</ul></div>";

		sizeArray = sFlex.split('|');
		sHTMLLength += "<div class=\"info-list\"><ul class=\"flex-list\"><li>Flex</li>";
		sizeArray.forEach(function (entry) {
			var nSize = $.trim(entry.split(' - ')[0]).replace(".", "_");
			var nFlex = $.trim(entry.split(' - ')[1]);
			sHTMLLength += "<li class=\"" + nSize + "\"> " + nFlex + "</li>";
		});
		sHTMLLength += "</ul></div>";
		return sHTMLLength;
	},
	updateHeaderLabel: function (nSection) {
		switch (nSection) {
			case 0:
				$('#header .top-section').html("SELECT BOARD - SHAPE &amp; CONTOUR");
				$('#header .pagination .label').html("SHAPE");
				break;
			case 1:
				$('#header .top-section').html("SELECT SIZE - BOARD LENGTH");
				$('#header .pagination .label').html("SIZE");
				break;
			case 2:
				$('#header .top-section').html("SELECT TOP - TOP SHEET ART");
				$('#header .pagination .label').html("TOP");
				break;
			case 3:
				$('#header .top-section').html("SELECT SIDE - SIDEWALL COLOR");
				$('#header .pagination .label').html("SIDE");
				break;
			case 4:
				$('#header .top-section').html("SELECT BASE - BASE ART");
				$('#header .pagination .label').html("BASE");
				break;
			case 5:
				$('#header .top-section').html("SELECT BASE - CUSTOMIZED TEXT");
				$('#header .pagination .label').html("BASE");
				break;
			case 6:
				$('#header .top-section').html("SELECT BADGE - PERSONALIZE YOUR BADGE");
				$('#header .pagination .label').html("BADGE");
				break;
			case 7:
				$('#header .top-section').html("BUY YOUR SNOWBOARD");
				$('#header .pagination .label').html("BUY");
				break;
		}
	},
	buildReciepts: function() {
		var self = this;
		// set shape
		$('#mobile-receipt .shape span, .step7-buy .board-reciept .shape span').html(self.getBoardShape());
		$('#mobile-receipt .shape-cost, .step7-buy .board-reciept .shape-cost').html("+ " + self.getDisplayPrice(self.getBoardPrice()));
		// set size
		$('#mobile-receipt .size span, .step7-buy .board-reciept .size span').html(self.getBoardSize());
		$('#mobile-receipt .size-cost, .step7-buy .board-reciept .size-cost').html("+ " + self.getDisplayPrice(0));
		// set top
		$('#mobile-receipt .top span, .step7-buy .board-reciept .top span').html(self.getBoardArtist() + " " + self.getBoardDescription());
		$('#mobile-receipt .top-cost, .step7-buy .board-reciept .top-cost').html("+ " + self.getDisplayPrice(0));
		// set sidewall
		$('#mobile-receipt .sidewall span, .step7-buy .board-reciept .sidewall span').html(self.getBoardSidewall());
		$('#mobile-receipt .sidewall-cost, .step7-buy .board-reciept .sidewall-cost').html("+ " + self.getDisplayPrice(0));
		// set badge
		$('#mobile-receipt .badge span, .step7-buy .board-reciept .badge span').html(self.getBoardBadge());
		$('#mobile-receipt .badge-cost, .step7-buy .board-reciept .badge-cost').html("+ " + self.getDisplayPrice(0));
		// check if knifecut
		if (self.config.isKnifecut) {
			// set base
			$('#mobile-receipt .base, .step7-buy .board-reciept .base').html("CUSTOM BASE - <span>" + self.getBoardBaseDesc() + "</span><div class=\"text-color\">TEXT COLOR - <span>" + self.getCustomTextColor() + "</span></div><div class=\"base-color\">BASE COLOR - <span>" + self.getCustomBaseColor() + "</span></div>");
			$('#mobile-receipt .base-cost, .step7-buy .board-reciept .base-cost').html("+ " + self.getDisplayPrice(self.getKnifeCutPrice().toFixed(2)));
			// set subtotal - need to add "incl. VAT" to EURO
			$('#mobile-receipt .subtotal-cost, .step7-buy .board-reciept .subtotal-cost').html(self.getDisplayPrice(parseFloat(self.getBoardPrice() + self.getKnifeCutPrice()).toFixed(2)));
		} else {
			// set base
			$('#mobile-receipt .base, .step7-buy .board-reciept .base').html("BASE - <span>" + self.getBoardBase() + " " + self.getBoardBaseDesc() + "</span>");
			$('#mobile-receipt .base-cost, .step7-buy .board-reciept .base-cost').html("+ " + self.getDisplayPrice(0));
			// set subtotal
			$('#mobile-receipt .subtotal-cost, .step7-buy .board-reciept .subtotal-cost').html(self.getDisplayPrice(self.getBoardPrice()));
		}		
		if (self.config.bbRegion == "EUR") $('#mobile-receipt .subtotal-cost, .step7-buy .board-reciept .subtotal-cost').append(' incl. VAT');
	},
	createCarousel: function (container) {
		var self, carouselWidth, containerWidth, containerCenter, dragMaxX, dragMinX, gridWidth, offset, selectedItemIndex;
		self = this;
		// resize carousel
		carouselWidth = 0;
		$(container).first().find(".carousel ul li").each(function (index) {
			carouselWidth += self.config.carouselItemWidth + 40; // add padding
			// store selected item
			if($(this).find('img').hasClass('selectedShape')) {
				selectedItemIndex = index;
			}
		});
		$(container + ' .carousel ul').css('width', carouselWidth);
		// set the height of the carousel
		// resize of .carousel height happens in resize event
		// create dragable list of board shape images
		containerWidth = $(container).width();
		containerCenter = containerWidth / 2;
		gridWidth = $(container + ' .carousel ul li').outerWidth();
		dragMaxX = containerCenter - gridWidth / 2;
		dragMinX = (carouselWidth - (containerCenter + gridWidth / 2)) * -1;
		offset = (containerCenter - Math.floor(containerCenter / gridWidth) * gridWidth);
		// set up draggable features of carousel
		self.config.currentCarousel = new Draggable.create(container + " .carousel ul", {
			type:"left",
			edgeResistance:0.65,
			bounds:{minX:dragMinX, maxX:dragMaxX},
			throwProps:true,
			maxDuration: 0.5,
			snap: {
				x: function(endValue) {
					var snapX = ((Math.round(endValue / gridWidth) * gridWidth) + offset) - gridWidth / 2;
					return snapX;
				}
			},
			onDragStart: function () {
				$('#info-box').removeClass('show');
				$(container + " ul").addClass('dragging');
			},
			onDragEnd: function () {
				$(container + " ul").removeClass('dragging');
			},
			onClick: function () {
				var clickTarget = this;
				$(container + " .carousel ul li").each(function( index ) {
					var carouselItem = $(this);
					if(clickTarget.pointerX >= carouselItem.offset().left && clickTarget.pointerX <= carouselItem.offset().left + gridWidth) {
						selectItem(index);
						return false;
					}
				});
			},
			onThrowComplete: function () {
				// check to find item in center selection
				$(container + " .carousel ul li").each(function( index ) {
					var carouselItem, containerOffset;
					carouselItem = $(this);
					containerOffset = $(container + ' .carousel-container').offset().left;
					if(containerCenter + containerOffset >= carouselItem.offset().left && containerCenter + containerOffset <= carouselItem.offset().left + gridWidth) {
						processSelection($(this));
						return false;
					}
				});
			}
		});
		$(document).on('keyup.carousel', function (e) {
			var code, maxIndex, prevIndex, nextIndex;
			maxIndex = $(container).first().find(".carousel ul li").size() - 1;
			$(container + " .carousel ul li").each(function( index ) {
				var carouselItem, containerOffset;
				carouselItem = $(this);
				containerOffset = $(container + ' .carousel-container').offset().left;
				if(containerCenter + containerOffset >= carouselItem.offset().left && containerCenter + containerOffset <= carouselItem.offset().left + gridWidth) {
					// set prev index
					prevIndex = index - 1;
					if(prevIndex < 0) prevIndex = maxIndex;
					// set next index
					nextIndex = index + 1;
					if(nextIndex > maxIndex) nextIndex = 0;
					return false;
				}
			});
			// get the code
			code = (e.keyCode ? e.keyCode : e.which);
			// check which arrow key
			if (code == 39) {
				// right arrow
				selectItem(nextIndex);
			} else if (code == 37) {
				// left arrow
				selectItem(prevIndex);
			}
		});
		function selectItem(index) {
			// find x position of arrowed to carousel item
			var carouselItemX = (index * gridWidth - (containerCenter - gridWidth/2)) * -1;
			TweenMax.to(container + " .carousel ul", 0.5, {left:carouselItemX + 'px'});
			processSelection($(container + " .carousel ul li")[index]);
		}
		// method for setting the carousel selection
		function processSelection(listItem) {
			var selectedImage, nNum, price, $infoBox;
			selectedImage = $(listItem).find('img');
			self.confirmedShapeSelection = true;
			$infoBox = $('#info-box');
			$infoBox.removeClass('step1 step3 step4 step5');
			// Check which step we're viewing
			if (self.config.nCurSlide === 0) {
				// STEP 1 - BOARD
				var theContour, splitArray;
				// get the shape number
				nNum = selectedImage.attr("data-shapenum") - 1;
				self.config.globalNum = nNum;
				// set the correct info box display items
				$infoBox.addClass('step1');
				// board attributes
				theContour = self.getBoardContour(nNum);
				splitArray = self.config.boardData[nNum].sizes;
				splitArray = splitArray.split('|').join(' ') + "";
				// set the appropriate display copy
				$('.topInfo h2').text(self.config.boardData[nNum].model);
				$('.topInfo h3').text(self.config.boardData[nNum].boardTagline);
				$('#info-box h2').text(self.config.boardData[nNum].model + " - " + theContour.name);
				$('#info-box h3').text(self.config.boardData[nNum].boardTagline);
				$('#info-box .sizes p span').text(self.config.boardData[nNum].sizes);
				$('#info-box h4').text(theContour.title);
				$('#info-box .sizes p span').text(splitArray);
				// set contour image
				$('#info-box .contour img').attr('src', self.config.baseImgPath + self.config.boardData[nNum].contourImage);
				// get the price for the board
				if (self.config.bbRegion == "CAD") {
					price = self.config.boardData[nNum].basePriceCA;
				} else if (self.config.bbRegion == "EUR") {
					price = self.config.boardData[nNum].basePriceEU;
				} else {
					price = self.config.boardData[nNum].basePriceUS;
				}
				// Update left menu
				// on slide 1 - board selection
				// update the left menu
				$('#left-menu .menu1 .menu-title').html("" + "" + self.config.boardData[nNum].model + "<br><b>+ " + self.getDisplayPrice(price) + "</b>");
				$('#left-menu .menu1').addClass('complete');
				// show left menu if it's the first time using
				if(self.config.showLeftMenu === true) {
					$('#left-menu').addClass('open');
					self.config.showLeftMenu = false;
				}
				// update board shape
				self.setBoardShape(selectedImage);
			} else if (self.config.nCurSlide === 2) {
				// STEP 3 - TOP
				var imgName, imgDesc, imgIndex;
				// set the correct info box display items
				$infoBox.addClass('step3');
				// top sheet attributes
				imgName = selectedImage.attr("data-artist");
				imgDesc = selectedImage.attr("data-desc");
				imgIndex = selectedImage.attr("data-count") - 1;
				// set the appropriate display copy
				$('#info-box h2').html(self.config.boardDescriptionData[imgIndex].artist);
				$('#info-box h3').html(self.config.boardDescriptionData[imgIndex].type + " " + imgDesc + " " + self.config.boardDescriptionData[imgIndex].color);
				$('#info-box h5').html(self.config.boardDescriptionData[imgIndex].description);
				// update board topsheet
				self.setBoardTop(selectedImage);
			} else if (self.config.nCurSlide === 3) {
				// STEP 4 - SIDEWALL
				// set the correct info box display items
				$infoBox.addClass('step4');
				$('#info-box h2').html(selectedImage.attr("data-color").toUpperCase());
				self.setBoardSidewall(selectedImage);
				self.boardPreviewSet(3);
			} else if (self.config.nCurSlide === 4) {
				// STEP 5a - BASE
				var imgName, imgDesc, imgIndex;
				// set the correct info box display items
				$infoBox.addClass('step5');
				imgName = selectedImage.attr("data-artist");
				imgDesc = selectedImage.attr("data-desc");
				imgIndex = selectedImage.attr("data-count");
				if (imgIndex >= 1) {
					$('#info-box h2').html(self.config.boardDescriptionData[imgIndex - 1].artist);
					$('#info-box h3').html(self.config.boardDescriptionData[imgIndex - 1].type + " " + imgDesc + " " + self.config.boardDescriptionData[imgIndex - 1].color);
					$('#info-box h5').html(self.config.boardDescriptionData[imgIndex - 1].description);
				} else {
					$('#info-box h2').text('DIY Base!');
					$('#info-box h3').text('Personalize your base for an additional ' + self.getDisplayPrice(30));
					$('#info-box h5').text('');
				}
				self.setBoardBase(selectedImage);
				self.boardPreviewSet(4);
			}
			// show the info box
			$infoBox.addClass('show');
			// remove old selections
			$(container + " .carousel ul li img").each(function () {
				$(this).removeClass('selectedShape');
			});
			// set image scale
			selectedImage.ScaleX = 1;
			selectedImage.ScaleY = 1;
			selectedImage.addClass('selectedShape');
		}
		if(selectedItemIndex !== "" && selectedItemIndex !== undefined) {
			selectItem(selectedItemIndex);
		}
	},
	destroyCarousel: function (container) {
		var self = this;
		for (var i = 0; i < self.config.currentCarousel.length; i++) {
			self.config.currentCarousel[i].disable();
		}
		self.config.currentCarousel = "";
		$(document).off('keyup.carousel');
	},
	// STEPS CODE BEGINS
	// STEP 1 - SHAPE
	step1Init: function () {
		var self = this;
		// set up carousel for step 1
		self.createCarousel('.step1-board');
		// check to see if advance arrow should be shown
		if (self.getBoardShape() === undefined || self.getBoardShape() === "" || !self.confirmedShapeSelection) {
			self.advanceArrowHide();
		} else {
			self.advanceArrowShow();
		}
		// remove offset for info box
		$('#info-box').removeClass('offset');
	},
	step1Uninit: function () {
		var self = this;
		self.destroyCarousel('.step1-board');
	},
	// STEP 2 - SIZE
	step2Init: function () {
		var self = this;
		if (self.getBoardSize() === undefined || self.getBoardSize() === "") {
			self.advanceArrowHide();
		} else {
			self.advanceArrowShow();
		}
		$('.step2-size .size-info .size-holder .sizes .size-item').on("click.step2 touch.step2", function () {
			// get the selected size and create the appropriate class
			var selectedSize = $(this).attr('val').replace(".", "_");
			// find and select the correct size data
			$(".step2-size .size-info .size-detail-table .table-data .info-list li").each(function (index) {
				if ($(this).hasClass(selectedSize)) {
					$(this).addClass("selected");
				} else {
					$(this).removeClass("selected");
				}
			});
			self.advanceArrowShow();
			$(".step2-size .size-info .size-holder .sizes .size-item").each(function (index) {
				$(this).removeClass('selected');
			});
			$(this).addClass('selected');
			self.setBoardSize($(this).text());
			$('#left-menu .menu2 .menu-title').html("" + "Size " + self.getBoardSize() + "<b><br>+ " + self.getDisplayPrice(0) + "</b>");
			$('#left-menu .menu2').addClass('complete');
		});
	},
	step2Uninit: function () {
		$('.step2-size .size-info .size-holder .sizes .size-item').off("click.step2 touch.step2");
	},
	// STEP 3 - TOP
	step3Init: function () {
		var self = this;
		// set up carousel for step 3
		self.createCarousel('.step3-top');
		// check to see if advance arrow should be shown
		if (self.getBoardTop() === undefined || self.getBoardTop() === "") {
			self.advanceArrowHide();
		} else {
			self.advanceArrowShow();
		}
		// add offset for info box
		$('#info-box').addClass('offset');
	},
	step3Uninit: function () {
		var self = this;
		self.destroyCarousel('.step3-top');
	},
	// STEP 4 - SIDEWALL
	step4Init: function () {
		var self = this;
		// set up carousel for step 4
		self.createCarousel('.step4-sidewall');
		// check to see if advance arrow should be shown
		if (self.getBoardSidewall() === undefined || self.getBoardSidewall() === "") {
			self.advanceArrowHide();
		} else {
			self.advanceArrowShow();
		}
		// add offset for info box
		$('#info-box').addClass('offset');
	},
	step4Uninit: function () {
		var self = this;
		self.destroyCarousel('.step4-sidewall');
	},
	// STEP 5a - BASE
	step5aInit: function () {
		var self = this;
		// set up carousel for step 5
		self.createCarousel('.step5-base');
		// check to see if advance arrow should be shown
		if (self.getBoardBase() === undefined || self.getBoardBase() === "") {
			self.advanceArrowHide();
		} else {
			self.advanceArrowShow();
		}
		// add offset for info box
		$('#info-box').addClass('offset');
	},
	step5aUninit: function () {
		var self = this;
		self.destroyCarousel('.step5-base');
	},
	// STEP 5b - KNIFE CUT BASE
	step5bInit: function () {
		var self = this;
		self.config.isKnifecut = true;
		function setTextColor(sColor) {
			if (sColor == self.getCustomBaseColor()) return;
			self.boardPreviewSet(5);
			self.setCustomTextColor(sColor);
			self.updateBoardDisplay();
		}
		function setBaseColor(sBaseColor) {
			if (sBaseColor == self.getCustomTextColor()) return;
			self.boardPreviewSet(5);
			self.setCustomBaseColor(sBaseColor);
			self.updateBoardDisplay();
		}
		// letter color listeners
		$('#knifecut-base-controls .letter-color .box-grey').on("click touch", function () {
			setTextColor('Grey');
		});
		$('#knifecut-base-controls .letter-color .box-orange').on("click touch", function () {
			setTextColor('Orange');
		});
		$('#knifecut-base-controls .letter-color .box-yellow').on("click touch", function () {
			setTextColor('Yellow');
		});
		$('#knifecut-base-controls .letter-color .box-black').on("click touch", function () {
			setTextColor('Black');
		});
		$('#knifecut-base-controls .letter-color .box-white').on("click touch", function () {
			setTextColor('White');
		});
		$('#knifecut-base-controls .letter-color .box-green').on("click touch", function () {
			setTextColor('Green');
		});
		$('#knifecut-base-controls .letter-color .box-blue').on("click touch", function () {
			setTextColor('Blue');
		});
		$('#knifecut-base-controls .letter-color .box-red').on("click touch", function () {
			setTextColor('Red');
		});
		// base color listeners
		$('#knifecut-base-controls .base-color .box-grey').on("click touch", function () {
			setBaseColor('Grey');
		});
		$('#knifecut-base-controls .base-color .box-orange').on("click touch", function () {
			setBaseColor('Orange');
		});
		$('#knifecut-base-controls .base-color .box-yellow').on("click touch", function () {
			setBaseColor('Yellow');
		});
		$('#knifecut-base-controls .base-color .box-black').on("click touch", function () {
			setBaseColor('Black');
		});
		$('#knifecut-base-controls .base-color .box-white').on("click touch", function () {
			setBaseColor('White');
		});
		$('#knifecut-base-controls .base-color .box-green').on("click touch", function () {
			setBaseColor('Green');
		});
		$('#knifecut-base-controls .base-color .box-blue').on("click touch", function () {
			setBaseColor('Blue');
		});
		$('#knifecut-base-controls .base-color .box-red').on("click touch", function () {
			setBaseColor('Red');
		});
		// imput text listeners
		$('#knifecut-base-controls .knifecut-input #board-text-input').css('visibility', 'visible').on('input.step5b', function () {
			var inputValue = this.value.toUpperCase();
			if(inputValue === "") {
				self.advanceArrowHide(); // on removal of text, hide arrow
			} else {
				self.advanceArrowShow(); // on update of text, show arrow
			}
			self.setBoardBaseDesc(inputValue);
			self.updateBoardDisplay();
			self.boardPreviewSet(5);
		}).on( "keyup.step5b", function (e) {
			var code = (e.keyCode ? e.keyCode : e.which);
			if (code == 13) { // Enter keycode
				self.config.$mainSlider.goToSlide(6);
			}
		}).on('focus.step5b', function () {
			// clear text when default is selected
			if ($(this).val() == self.defaultBaseInput) {
				$(this).val("");
			}
		}).on('blur.step5b', function () {
			// reset default if nothing is inputed
			if ($(this).val().length === 0) {
				$(this).val(self.defaultBaseInput);
			}
		});
		self.advanceArrowHide();
	},
	step5bUninit: function () {
		$('#knifecut-base-controls .knifecut-input #board-text-input').css('visibility', 'hidden').off('input.step5b keyup.step5b focus.step5b blur.step5b');
		$('#knifecut-base-controls .letter-color .box-grey').off("click touch");
		$('#knifecut-base-controls .letter-color .box-orange').off("click touch");
		$('#knifecut-base-controls .letter-color .box-yellow').off("click touch");
		$('#knifecut-base-controls .letter-color .box-black').off("click touch");
		$('#knifecut-base-controls .letter-color .box-white').off("click touch");
		$('#knifecut-base-controls .letter-color .box-green').off("click touch");
		$('#knifecut-base-controls .letter-color .box-blue').off("click touch");
		$('#knifecut-base-controls .letter-color .box-red').off("click touch");
		$('#knifecut-base-controls .base-color .box-grey').off("click touch");
		$('#knifecut-base-controls .base-color .box-orange').off("click touch");
		$('#knifecut-base-controls .base-color .box-yellow').off("click touch");
		$('#knifecut-base-controls .base-color .box-black').off("click touch");
		$('#knifecut-base-controls .base-color .box-white').off("click touch");
		$('#knifecut-base-controls .base-color .box-green').off("click touch");
		$('#knifecut-base-controls .base-color .box-blue').off("click touch");
		$('#knifecut-base-controls .base-color .box-red').off("click touch");
	},
	// STEP 6 - BADGE
	step6Init: function () {
		var self = this;
		// input text listeners
		$('.board-badge-input-holder #board-badge-input').css('visibility', 'visible').on('input.step6', function () {
			var maxFS, inputValue;
			inputValue = this.value.toUpperCase();
			if (inputValue.length <= 13) {
				maxFS = "200%";
				$('.step6-badge .board-badge .badge-text').css('font-size', maxFS);
				var the1Line = inputValue.slice(0, 13);
				$('.step6-badge .board-badge .badge-text').html(the1Line);
			} else if (inputValue.length > 13) {
				maxFS = "175%";
				$('.step6-badge .board-badge .badge-text').css('font-size', maxFS);
				$('.step6-badge .board-badge .badge-text').html(inputValue);
			}
			// set menu and display arrow if user begins to enter text
			if (inputValue.length == 1) {
				self.advanceArrowShow();
				$('#left-menu .menu6 .menu-title').html("Personalized Badge<br><b>+ " + self.getDisplayPrice(0) + "</b>");
				$('#left-menu .menu6').addClass('complete');
			} else if (inputValue.length === 0) {
				self.advanceArrowHide();
			}
			self.setBoardBadge(inputValue);
		}).on('keyup.step6', function (e) {
			// on enter press, advance to next step
			var code = (e.keyCode ? e.keyCode : e.which);
			if (code == 13 && $(this).val().length !== 0) { // Enter keycode & input is not empty
				self.config.$mainSlider.goToSlide(7);
			}
		}).on('blur.step6', function () {
			if ($(this).val().length !== 0 && $(this).val() != self.defaultBadgeInput) {
				self.advanceArrowShow();
				$('#left-menu .menu6 .menu-title').html("Personalized Badge<br><b>+ " + self.getDisplayPrice(0) + "</b>");
				$('#left-menu .menu6').addClass('complete');
			} else {
				self.advanceArrowHide();
				self.setBoardBadge('');
				$(this).val(self.defaultBadgeInput);
			}
		}).on('focus.step6', function () {
			if ($(this).val() == self.defaultBadgeInput) {
				$(this).val("");
			}
		});
		// get the board size
		$(".step6-badge .board-badge .badge-size").html(self.getBoardSize());
		// decide if advance arrow should be shown
		if (self.getBoardBadge() === undefined || self.getBoardBadge() === "") {
			self.advanceArrowHide();
		} else {
			self.advanceArrowShow();
		}
	},
	step6Uninit: function () {
		$('.board-badge-input-holder #board-badge-input').css('visibility', 'hidden').off('input.step6 blur.step6 keyup.step6 mouseleave.step6 focus.step6');
	},
	// STEP 7 - BUY
	step7Init: function () {
		var self = this;
		// reset view
		$('body').addClass('step7');
		// hide
		$(".step7-buy .terms").css('display', 'none');
		$(".step7-buy .terms-international").css('display', 'none');
		$(".step7-buy .cart-error").css('display', 'none');
		$(".step7-buy .buttonholder .agree-button").css('display', 'none');
		// show
		$(".step7-buy .board-reciept").css('display', 'block');
		$(".step7-buy .buttonholder .buy-button").css('display', 'block');
		// functions
		function showTerms() {
			$('body').addClass('accept-buy');
			// hide
			$(".step7-buy .buttonholder .buy-button").css('display', 'none');
			$(".step7-buy .board-reciept").css('display', 'none');
			$(".step7-buy .cart-error").css('display', 'none');
			// show
			$(".step7-buy .buttonholder .agree-button").css('display', 'block');
			if(self.config.bbRegion == 'USD' || self.config.bbRegion == 'CAD') {
				$(".step7-buy .terms").css('display', 'block');
				$(".step7-buy .terms-international").css('display', 'none');
			} else {
				$(".step7-buy .terms-international").css('display', 'block');
				$(".step7-buy .terms").css('display', 'none');
			}
		}
		function showError(sError) {
			// hide
			$(".step7-buy .board-reciept").css('display', 'none');
			$(".step7-buy .terms").css('display', 'none');
			$(".step7-buy .terms-international").css('display', 'none');
			$(".step7-buy .buttonholder .agree-button").css('display', 'none');
			// show
			$(".step7-buy .cart-error").css('display', 'block');
			$(".step7-buy .buttonholder .buy-button").css('display', 'block');
		}
		function isComplete() {
			if (self.getBoardShape() !== "" && self.getBoardShape() !== undefined &&
				self.getBoardSize() !== "" && self.getBoardSize() !== undefined &&
				self.getBoardTop() !== "" && self.getBoardTop() !== undefined &&
				self.getBoardSidewall() !== "" && self.getBoardSidewall() !== undefined &&
				self.getBoardBase() !== "" && self.getBoardBase() !== undefined && self.getBoardBaseDesc() !== "" && self.getBoardBaseDesc() !== undefined &&
				self.getBoardBadge() !== "" && self.getBoardBadge() !== undefined) {
				return true;
			} else {
				return false;
			}
		}
		function isNotComplete() {
			if (self.getBoardShape() === "" || self.getBoardShape() === undefined) {
				alertDesktop(1);
				alertMobile(0);
			}
			if (self.getBoardSize() === "" || self.getBoardSize() === undefined) {
				alertDesktop(2);
				alertMobile(1);
			}
			if (self.getBoardTop() === "" || self.getBoardTop() === undefined) {
				alertDesktop(3);
				alertMobile(2);
			}
			if (self.getBoardSidewall() === "" || self.getBoardSidewall() === undefined) {
				alertDesktop(4);
				alertMobile(3);
			}
			if (self.getBoardBase() === "" || self.getBoardBase() === undefined || self.getBoardBaseDesc() === "" || self.getBoardBaseDesc() === undefined) {
				if(self.getBoardBase() !== "Custom") {
					alertDesktop(5);
					alertMobile(4);
				} else {
					alertDesktop('5b');
					alertMobile(5);
				}
			}
			if (self.getBoardBadge() === "" || self.getBoardBadge() === undefined) {
				alertDesktop(6);
				alertMobile(6);
			}
			$('#left-menu').addClass('open');
		}
		function alertDesktop(nNum) {
			$('#left-menu').find('.menu' + (nNum)).addClass('alert');
		}
		function alertMobile(nNum) {
			$('#header .pagination .controls .bx-pager-item').eq(nNum).addClass('alert');
		}
		function boardUrl() {
			var boardBuilderURL = "http://www.lib-tech.com/diy/";
			if (isComplete() || $('body').hasClass('page-template-page-templatessnowboard-builder-share-php')) {
				boardBuilderURL += "?shape=" + encodeURIComponent(self.getBoardShape());
				boardBuilderURL += "&size=" + encodeURIComponent(self.getBoardSize());
				boardBuilderURL += "&top=" + encodeURIComponent(self.getBoardArtist() + ' ' + self.getBoardDescription());
				boardBuilderURL += "&sidewall=" + encodeURIComponent(self.getBoardSidewall());
				// set up correct base variables
				if (self.config.isKnifecut) {
					boardBuilderURL += "&kt=" + encodeURIComponent(self.getBoardBaseDesc());
					boardBuilderURL += "&kbc=" + encodeURIComponent(self.getCustomBaseColor());
					boardBuilderURL += "&ktc=" + encodeURIComponent(self.getCustomTextColor());
				} else {
					boardBuilderURL += "&base=" + encodeURIComponent(self.getBoardBase() + ' ' + self.getBoardBaseDesc());
				}
				boardBuilderURL += "&badge=" + encodeURIComponent(self.getBoardBadge());
			}
			//boardBuilderURL = encodeURIComponent(boardBuilderURL);
			return boardBuilderURL;
		}
		// Listen for user to click buy
		$('.step7-buy .buttonholder .buy-button').on('click.step7', function () {
			if ($('body').hasClass('page-template-page-templatessnowboard-builder-share-php')) {
				// share page
				showTerms();
			} else {
				// builder page
				if (isComplete()) {
					showTerms();
				} else {
					isNotComplete();
				}
			}
		});
		// Listen for user to click agree
		$('.step7-buy .buttonholder .agree-button').on('click.step7', function () {
			var top = self.getBoardArtist() + ' ' + self.getBoardDescription();
			var partNum = self.config.boardData[self.config.globalNum].baseSku;
			if (self.config.isKnifecut) {
				partNum = self.config.boardData[self.config.globalNum].knifecutSku;

				Shopatron.addToCart({
					quantity: '1',
					partNumber: partNum,
					itemOptions: {
						895305: self.getBoardSize(), // Size
						895306: top, // Top Graphic
						895307: self.getBoardSidewall(), // Sidewall Color
						895308: self.getBoardBase(), // Base Graphic
						918748: self.getBoardBaseDesc(), // Knife Cut Text
						918746: self.getCustomBaseColor(), // Knife Cut Base Color
						918747: self.getCustomTextColor(), // Knife Cut Text Color
						895314: self.getBoardBadge(), // Badfge Text
						895321: boardUrl(),
					}
				}, {
					// All event handlers are optional
					success: function (data, textStatus) {
						window.location.href = "/shopping-cart/";
					},
					error: function (textStatus, errorThrown) {
						showError(textStatus.responseText);
					},
					complete: function (textStatus) {}
				});
			} else {
				var base = self.getBoardBase() + ' ' + self.getBoardBaseDesc();
				Shopatron.addToCart({
					quantity: '1',
					partNumber: partNum,
					itemOptions: {
						895305: self.getBoardSize(), // Size
						895306: top, // Top Graphic
						895307: self.getBoardSidewall(), // Sidewall Color
						895308: base, // Base Graphic
						895314: self.getBoardBadge(), // Badge Text
						895321: boardUrl() // URL
					}
				}, {
					// All event handlers are optional
					success: function (data, textStatus) {
						window.location.href = "/shopping-cart/";
					},
					error: function (textStatus, errorThrown) {
						showError(textStatus.responseText);
					},
					complete: function (textStatus) {}
				});
			}
		});
		// Social Links
		$('.step7-buy .buttonholder .social-icons .socialfb').on('click.step7', function () {
			window.open(
				'https://www.facebook.com/sharer/sharer.php?u='+ encodeURIComponent(boardUrl()),
				'facebook-share-dialog',
				'width=626,height=436'
			);
			return false;
		});
		$('.step7-buy .buttonholder .social-icons .socialtw').on('click.step7', function () {
			window.open(
				'http://twitter.com/share?url=' + encodeURIComponent(boardUrl()) + '&text=' + encodeURIComponent("I built my own @libtechnologies #snowboard with the DIY Board Builder! #LibTechDIY -"),
				'twitter-share-dialog',
				'height=450, width=550, top='+($(window).height()/2 - 225) +', left='+$(window).width()/2 +', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0'
			);
			return false;
		});
		$('.step7-buy .buttonholder .social-icons .socialg').on('click.step7', function () {
			window.open(
				"https://plus.google.com/share?url=" + encodeURIComponent(boardUrl()),
				'gplus-share-dialog',
				'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'
			);
			return false;
		});
		$('.step7-buy .buttonholder .social-icons .sociale').on('click.step7', function () {
			email = "mailto:?subject=" + encodeURIComponent("I built my own Lib Tech Snowboard with the DIY Board Builder!") + "&body=" + encodeURIComponent(" Check out my personalized DIY Lib Tech Snowboard:") +  "%20%0D%0A%20" + encodeURIComponent(boardUrl()) + "%20%0D%0A%20" + encodeURIComponent("Build your dream snowboard!");
			window.open(email);
		});
		// check if iPad... if so remove read only feature of input
		if (self.config.isIpad) {
			$('.step7-buy .buttonholder .share-url #share-url-input').removeAttr('readonly');
		}
		// select the field when clicked or touched
		$('.step7-buy .buttonholder .share-url #share-url-input').css('visibility', 'visible').on('click.step7 touch.step7', function () {
			$(this).selectRange(0,9999); // call added method to jquery, standard select() doesn't work on mobile devices
			$(this).selectRange(0,9999); // call added method to jquery, standard select() doesn't work on mobile devices
		});
		$('.step7-buy .buttonholder .share-url #share-url-input').val(boardUrl());
		self.advanceArrowHide();
		self.buildReciepts();
	},
	step7Uninit: function () {
		$('.step7-buy .buttonholder .buy-button').off('click.step7');
		$('.step7-buy .buttonholder .agree-button').off('click.step7');
		$('.step7-buy .buttonholder .social-icons .socialfb').off('click.step7');
		$('.step7-buy .buttonholder .social-icons .socialtw').off('click.step7');
		$('.step7-buy .buttonholder .social-icons .socialg').off('click.step7');
		$('.step7-buy .buttonholder .social-icons .sociale').off('click.step7');
		$('.step7-buy .buttonholder .share-url #share-url-input').css('visibility', 'hidden').off('click.step7 touch.step7');
		$('body').removeClass('step7 accept-buy');
	},
	setCurrentSection: function () {
		var self = this;
		self.config.nCurSlide = self.config.$mainSlider.getCurrentSlide();
		self.updateHeaderLabel(self.config.nCurSlide);
		self.config.bFirstPlay = false;
		self.boardPreviewSet(self.config.nCurSlide);
		// menu stuff
		$("#header .pagination .controls .bx-pager-item").removeClass('selected');
		$("#header .pagination .controls .bx-pager-item .active").parent().addClass('selected');
		// set default snowboard shape
		if (self.getBoardShape() === "" || self.getBoardShape() === undefined && !self.confirmedShapeSelection) {
			self.setBoardShape($("#defaultShapeImage"));
		}
		// UNINIT ALL SECTIONS
		self.step1Uninit();
		self.step2Uninit();
		self.step3Uninit();
		self.step4Uninit();
		self.step5aUninit();
		self.step5bUninit();
		self.step6Uninit();
		self.step7Uninit();
		// INIT CURRENT SECTION
		if (self.config.nCurSlide === 0) {
			self.step1Init();
		} else if (self.config.nCurSlide == 1) {
			self.step2Init();
		} else if (self.config.nCurSlide == 2) {
			self.step3Init();
		} else if (self.config.nCurSlide == 3) {
			self.step4Init();
		} else if (self.config.nCurSlide == 4) {
			self.step5aInit();
		} else if (self.config.nCurSlide == 5) {
			self.step5bInit();
		} else if (self.config.nCurSlide == 6) {
			self.step6Init();
		} else if (self.config.nCurSlide == 7) {
			self.step7Init();
		}
		// reset left menu
		$('#left-menu ul li').removeClass('selected');
		// set the left menu correctly
		if (self.config.nCurSlide == 5) {
			$('#left-menu .menu5b').addClass('selected');
			$('#left-menu .menu5b').removeClass('alert');
		} else if (self.config.nCurSlide == 6) {
			$('#left-menu .menu6').addClass('selected');
			$('#left-menu .menu6').removeClass('alert');
		} else {
			$("#left-menu").find('.menu' + (self.config.nCurSlide + 1)).addClass('selected');
			$("#left-menu").find('.menu' + (self.config.nCurSlide + 1)).removeClass('alert');
		}
		$('#header .pagination .controls .bx-pager-item').eq(self.config.nCurSlide).removeClass('alert');
		// check resize
		self.resizeLayout();
	}, // END setCurrentSection
	resizeLayout: function () {
		var self, windowHeight, windowWidth, headerHeight, shapeWidth, shapeHeight, aspectRatio, newHeight, newWidth, carouselWidth, carouselHeight, boardDisplayWidth, boardDisplayHeight, aspectRatio, newHeight, newWidth, maxWidth, arrowY;
		self = this;
		windowHeight = $(window).height();
		windowWidth = $(window).width();
		boardDisplayWidth = $('#board-display .board-preview .board-views .preview-top .board .board-image img').width();
		boardDisplayHeight = $('#board-display .board-preview .board-views .preview-top .board .board-image img').height();
		aspectRatio = boardDisplayWidth / boardDisplayHeight;
		// check size settings
		if ($('#header .top-section').css('display') == 'none') {
			self.config.isMobile = true;
		} else {
			self.config.isMobile = false;
		}
		// kill menus
		self.flyOutMenuUnInit();
		self.mobileMenuUnInit();
		// reset pagination selection, removes on resize
		$("#header .pagination .controls .bx-pager-item .active").parent().addClass('selected');
		// make sure knifecut pager item is shown if resize fires
		if(self.getBoardBase() == "Custom") {
			$('#header .pagination .controls .bx-pager-item:eq(5)').addClass('show');
		}
		// set specific variables based on size
		if (self.config.isMobile) {
			headerHeight = $('#header').height();
		} else {
			headerHeight = $('#header .logo').height();
		}
		if ($('body').hasClass('page-template-page-templatessnowboard-builder-php')) {
			// VIEWING BUILDER
			if (self.config.isMobile) {
				// ON MOBILE
				newHeight = windowHeight - headerHeight - $('#board-display .board-name').outerHeight() - 20;
				newWidth = Math.floor(newHeight * aspectRatio);
				// reinit mobile
				self.mobileMenuInit();
				// make sure list display is the correct size for the section and parent list item
				$('.step1-board, .step2-size, .step3-top, .step4-sidewall, .step5-base, .step5b-base-text, .step6-badge, .step7-buy').css('height', windowHeight - headerHeight).parent().css('height', windowHeight - headerHeight);
				// RESIZE MOBILE BOARD DISPLAY
				if (self.config.$mainSlider.getCurrentSlide() != 7) {
					maxWidth = $('#board-display').width(); // displayed within flyout
				} else {
					maxWidth = windowWidth / 4; // find 50% of display, divide that by 2... only showing top and bottom
				}
				// make sure board display doesn't exceed max width
				if(newWidth > maxWidth) {
					newWidth = maxWidth;
				}
				arrowY = newHeight / 2 + $('#board-display .board-name').outerHeight();
				// set arrow position
				$('#board-display .board-menu-left-button, #board-display .board-menu-right-button').css('top', arrowY);
				// set container width
				if (self.config.$mainSlider.getCurrentSlide() != 7) {
					$('#board-display .board-preview').width(newWidth);
				} else {
					// step 7
					$('#board-display .board-preview').width(newWidth*2);
				}
				$('#board-display').removeAttr('style');
				boardDisplayHeight = windowHeight - headerHeight;
				$('#board-display, #mobile-receipt').css('height', boardDisplayHeight);
			} else {
				// ON DESKTOP
				newHeight = windowHeight - headerHeight;
				newWidth = Math.floor(newHeight * aspectRatio);
				// reinit desktop
				self.flyOutMenuInit();
				// make sure list display is the correct size for the section and parent list item
				$('.step1-board, .step2-size, .step3-top, .step4-sidewall, .step5-base, .step5b-base-text, .step6-badge, .step7-buy').css('height', windowHeight).parent().css('height', windowHeight);
				// RESIZE DESKTOP BOARD DISPLAY
				maxWidth = Math.floor(windowWidth * 0.2);
				// make sure board display doesn't exceed max width
				if(newWidth > maxWidth) {
					newHeight = newHeight * (maxWidth/newWidth); // make sure arrows align right vertically if width/height is changed
					newWidth = maxWidth;
				}
				$('#board-display, #board-display .board-preview').width(newWidth);
				// arrow posiiton
				arrowY = Math.floor($('#board-display .board-preview .board-views .preview-top .board .board-image img').height() / 2 - 25);
				arrowY = newHeight / 2;
				$('#board-display .board-menu-left-button, #board-display .board-menu-right-button').css('top', arrowY);
				// check slides and do your worst!
				if (self.config.$mainSlider.getCurrentSlide() != 7) {
					// center board within left 30% minus 90px for left menu
					var leftPosition = Math.floor(((windowWidth * 0.3 - 90) - newWidth) / 2) + 90;
					$('#board-display').css('left', leftPosition);
				} else {
					// step 7
					$('#board-display').removeAttr('style');
					$('#board-display .board-preview').width(newWidth*3);
				}
			}
			// RESIZE CAROUSEL IMAGES - Both mobile and dekstop
			shapeWidth = $('.carousel ul li.item img').width();
			shapeHeight = $('.carousel ul li.item img').height();
			aspectRatio = shapeWidth / shapeHeight;
			// set carousel height
			$('.carousel').height(windowHeight - headerHeight + 20); // add 20 because of scaleup
			// set new height based on device
			if (self.config.isMobile) {
				newHeight = windowHeight - headerHeight - 115; // remove 115 more to account for scale up on click
			} else {
				newHeight = windowHeight - headerHeight - 20; // remove 20 more to account for scale up on click
			}
			newWidth = Math.floor(newHeight * aspectRatio);
			self.config.carouselItemWidth = newWidth;
			// set width on carousel images
			$('.carousel ul li.item img').each(function () {
				$(this).css('width', newWidth);
			});
			// check what step we're on and reset appropriate carousel
			if (self.config.$mainSlider.getCurrentSlide() === 0) {
				// reset carousel
				self.destroyCarousel('.step1-board');
				self.createCarousel('.step1-board');
			} else if (self.config.$mainSlider.getCurrentSlide() == 2) {
				// reset carousel
				self.destroyCarousel('.step3-top');
				self.createCarousel('.step3-top');
			} else if (self.config.$mainSlider.getCurrentSlide() == 3) {
				// reset carousel
				self.destroyCarousel('.step4-sidewall');
				self.createCarousel('.step4-sidewall');
			} else if (self.config.$mainSlider.getCurrentSlide() == 4) {
				// reset carousel
				self.destroyCarousel('.step5-base');
				self.createCarousel('.step5-base');
			}
		} else {
			var boardDisplay = $('#board-display');
			// VIEWING SHARE
			if(boardDisplay.css('position') == 'fixed') {
				// check to see if boards are rendering taller than the window is
				var maxWidth;
				newHeight = windowHeight;
				newWidth = Math.floor(newHeight * aspectRatio);
				maxWidth = Math.floor(windowWidth * 0.5 / 3);
				// make sure board display doesn't exceed max width
				if(newWidth > maxWidth) {
					newWidth = maxWidth;
				}
				boardDisplay.width(newWidth*3);
			} else {
				boardDisplay.removeAttr('style');
				$('.board-views div.preview-side').removeAttr('style');
				$('.board-views div.preview-base').removeAttr('style');
			}
		}
		// update display of rendered board
		self.updateBoardDisplay();
	} // END resizeLayout
};
// wait for final event to fire
var waitForFinalEvent = (function () {
	var timers = {};
	return function (callback, ms, uniqueId) {
		if (!uniqueId) {
			uniqueId = "Don't call this twice without a uniqueId";
		}
		if (timers[uniqueId]) {
			clearTimeout(timers[uniqueId]);
		}
		timers[uniqueId] = setTimeout(callback, ms);
	};
})();
// kill tab actions
$(document).keydown(function (objEvent) {
	if (objEvent.keyCode == 9) { //tab pressed
		objEvent.preventDefault(); // stops its action
	}
});
// add select range for input fields to jQuery
$.fn.selectRange = function(start, end) {
	if(!end) end = start; 
	return this.each(function() {
		if (this.setSelectionRange) {
			this.focus();
			this.setSelectionRange(start, end);
		} else if (this.createTextRange) {
			var range = this.createTextRange();
			range.collapse(true);
			range.moveEnd('character', end);
			range.moveStart('character', start);
			range.select();
		}
	});
};