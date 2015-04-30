/**
 * 1415 Lib Tech WordPress Theme - Blog Single Entry - http://www.lib-tech.com
 * Author: brian.behrens@mervin.com - http://www.mervin.com
 */

var LIBTECH = LIBTECH || {};

LIBTECH.BlogSingle = function () {
	this.init();
};
LIBTECH.BlogSingle.prototype = {
	init: function () {
		var self = this;
		$(".blog-post .entry-content").fitVids();
		// init gallery
		if ($('.gallery')) {
			self.initGallery();
		}
		// blog image lightbox
		$('.entry-content a[href*=".jpg"], .entry-content a[href*=".jpeg"], .entry-content a[href*=".png"], .entry-content a[href*=".gif"]').each(function() {
			var $link = $(this);
			if($link.parents('.gallery').length < 1) {
				$link.magnificPopup({
					type: 'image',
					closeOnBgClick: true,
					closeOnContentClick: true,
					removalDelay: 500,
					midClick: true,
					callbacks: {
						beforeOpen: function() {
							this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
							this.st.mainClass = 'mfp-zoom-in';
						}
					}
				});
			}
		});
		$(window).on('resize load', function () {
			self.adjustStrobbr();
			self.checkPageWidth(); // on resize check what the width of the browser is for fixed scroll elements
		});
		// check for facebook plugin loads, such as facebook embeds
		$(window).on('load', function () {
			FB.Event.subscribe('xfbml.render', function () {
				// facebook content has been rendered
				self.checkPageWidth(); // listen for update and fix break when taller content is loaded
			});
		});
		// add link to copied text
		$('.post-wrapper .entry-content').on('copy', self.addLink);
	},
	initGallery: function () {
		var self = this;
		new LIBTECH.Gallery();
		// listen for update and fix break when taller image is loaded
		$(".gallery").on("galleryUpdate", function (e) {
			self.checkPageWidth();
		});
	},
	checkPageWidth: function () {
		// BEGIN CODE FOR 2 COLUMN LAYOUT THAT FIXES POSITIONS WHEN SCROLLED PAST
		// check browser width and perform appropriate actions on 2 column layout
		var self = this;
		if (LIBTECH.main.utilities.responsiveCheck() != 'large') {
			// if we're less than 980 turn off scroll listener and reset dom
			$(window).off('scroll.blogScroll');
			// reset all css
			$('#sidebar').css({
				position: 'static',
			});
			$('#sidebar .sidebar-wrapper').css({
				position: 'static',
				width: '100%'
			});
			$('article.post').css({
				position: 'static'
			});
			$('article.post .post-wrapper').css({
				position: 'static',
				width: '100%'
			});
		} else {
			// if we're bigger than 980 listen for scroll and run check
			$(window).off('scroll.blogScroll');
			$(window).on('scroll.blogScroll', function () {
				self.checkScroll();
			});
			self.checkScroll();
		}
	},
	checkScroll: function () {
		// on page scroll check the positioning of elements
		// set up variables
		var self, post, postHeight, sidebar, sidebarHeight, windowScrollTop, windowHeight;
		self = this;
		post = $('article.post');
		postHeight = post.height();
		postWrapper = $('article.post .post-wrapper');
		postWrapperHeight = postWrapper.height();
		sidebar = $('#sidebar');
		sidebarHeight = sidebar.height();
		sidebarWrapper = $('#sidebar .sidebar-wrapper');
		sidebarWrapperHeight = sidebarWrapper.height();
		windowScrollTop = $(window).scrollTop();
		windowHeight = $(window).height();
		// check to see which column is longer
		if (sidebarHeight < postHeight) {
			// if sidebar is shorter, do this
			if (windowScrollTop + windowHeight > post.offset().top + sidebarWrapperHeight) {
				// we've reached the bottom of the sidebar, so anchor it
				// find the appropriate position for the sidebar
				// var bottomPosition = post.offset().top + postHeight - windowScrollTop - windowHeight;
				// set the position
				sidebarWrapper.css({
					position: 'fixed',
					bottom: '0px',
					width: sidebar.width()
				});
				// if we can see the footer, fix the sidebar to bottom of section
				if (self.isInView('footer')) {
					sidebar.css({
						position: 'absolute',
						bottom: '-50px',
						right: '0px'
					});
					sidebarWrapper.css({
						position: 'static',
						width: '100%'
					});
				}
			} else {
				// we're at the top
				sidebar.css({
					position: 'static',
				});
				sidebarWrapper.css({
					position: 'static',
					width: '100%'
				});
			}
		} else if (postWrapperHeight > windowHeight) {
			// if post is shorter, do this
			if (windowScrollTop + windowHeight > sidebar.offset().top + postWrapperHeight) {
				// we've reached the bottom of the post, so anchor it
				// find the appropriate position for the post
				// var bottomPosition = sidebar.offset().top + sidebarHeight - windowScrollTop - windowHeight;
				// set the position
				postWrapper.css({
					position: 'fixed',
					bottom: '0px',
					width: post.width()
				});
				// if we can see the footer, fix the post to bottom of section
				if (self.isInView('footer')) {
					post.css({
						position: 'absolute',
						bottom: '-50px',
						left: '0px'
					});
					postWrapper.css({
						position: 'static',
						width: '100%'
					});
				}
			} else {
				// we're at the top
				post.css({
					position: 'static'
				});
				postWrapper.css({
					position: 'static',
					width: '100%'
				});
			}
		}
	},
	isInView: function (elem) {
		// check if element is in view
		var docViewTop = $(window).scrollTop(); //num of pixels hidden above current screen
		var docViewBottom = docViewTop + $(window).height();
		var elemTop = $(elem).offset().top; //num of pixels above the elem
		var elemBottom = elemTop + $(elem).height();
		return ((elemTop >= docViewTop && elemTop <= docViewBottom));
	},
	adjustStrobbr: function () {
		// adjust strobbr height/width
		$('iframe.strobbr').each(function () {
			var
			$this = $(this),
				proportion = $this.data('proportion'),
				w = $this.attr('width'),
				actual_w = $this.width();
			if (!proportion) {
				proportion = $this.attr('height') / w;
				$this.data('proportion', proportion);
			}
			if (actual_w != w) {
				$this.css('height', Math.round(actual_w * proportion) + 'px');
			}
		});
	},
	addLink: function () {
		//get selected text and append source link
		var selection = window.getSelection();
		if (selection.toString().length > 50) {
			var pageLink = '<br /><br /> Read more at: ' + document.location.href;
			var copyText = selection + pageLink;
			var newDiv = document.createElement('div');
			//hide new contatiner
			newDiv.style.position = 'absolute';
			newDiv.style.left = '-99999px';
			//insert contatiner, fill with text and define selection
			document.body.appendChild(newDiv);
			newDiv.innerHTML = copyText;
			selection.selectAllChildren(newDiv);
			window.setTimeout(function () {
				document.body.removeChild(newDiv);
			}, 100);
		}
	}
};
