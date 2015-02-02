		<div id="region-selector">
			<div class="choose-region">
				<h5 class="h1">Choose your region</h5>
				<div class="location-group north-america">
					<h6 class="location-title h4">North America</h6>
					<ul class="location-list">
						<li class="location-item">
							<p><a href="#region-selector" data-currency="USD"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/usa.gif" alt="USA Flag" />United States <span>(USD)</span></a> Shop in US currency</p>
						</li>
						<li class="location-item">
							<p><a href="#region-selector" data-currency="CAD"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/canada.gif" alt="Canada Flag" />Canada <span>(CAD)</span></a> Shop in CANADA currency</p>
						</li>
					</ul>
				</div>
				<div class="location-group europe">
					<h6 class="location-title h4">Europe</h6>
					<p class="location-note">Shop in EURO currency</p>
					<ul class="location-list">
						<li class="location-item">
							<p><a href="#region-selector" data-currency="EUR"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/austria.gif" alt="Austria Flag" />Austria <span>(EUR)</span></a></p>
						</li>
						<li class="location-item">
							<p><a href="#region-selector" data-currency="EUR"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/belgium.gif" alt="Belgium Flag" />Belgium <span>(EUR)</span></a></p>
						</li>
						<li class="location-item">
							<p><a href="#region-selector" data-currency="EUR"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/czech.gif" alt="Czech Republic Flag" />Czech Republic <span>(EUR)</span></a></p>
						</li>
						<li class="location-item">
							<p><a href="#region-selector" data-currency="EUR"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/denmark.gif" alt="Denmark Flag" />Denmark <span>(EUR)</span></a></p>
						</li>
						<li class="location-item">
							<p><a href="#region-selector" data-currency="EUR"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/finland.gif" alt="Finland Flag" />Finland <span>(EUR)</span></a></p>
						</li>
						<li class="location-item">
							<p><a href="#region-selector" data-currency="EUR"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/france.gif" alt="France Flag" />France <span>(EUR)</span></a></p>
						</li>
						<li class="location-item">
							<p><a href="#region-selector" data-currency="EUR"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/germany.gif" alt="Germany Flag" />Germany <span>(EUR)</span></a></p>
						</li>
						<li class="location-item">
							<p><a href="#region-selector" data-currency="EUR"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/luxembourg.gif" alt="Luxembourg Flag" />Luxembourg <span>(EUR)</span></a></p>
						</li>
						<li class="location-item">
							<p><a href="#region-selector" data-currency="EUR"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/netherlands.gif" alt="Netherlands Flag" />Netherlands <span>(EUR)</span></a></p>
						</li>
						<li class="location-item">
							<p><a href="#region-selector" data-currency="EUR"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/poland.gif" alt="Poland Flag" />Poland <span>(EUR)</span></a></p>
						</li>
						<li class="location-item">
							<p><a href="#region-selector" data-currency="EUR"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/portugal.gif" alt="Portugal Flag" />Portugal <span>(EUR)</span></a></p>
						</li>
						<li class="location-item">
							<p><a href="#region-selector" data-currency="EUR"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/slovakia.gif" alt="Slovakia Flag" />Slovakia <span>(EUR)</span></a></p>
						</li>
						<li class="location-item">
							<p><a href="#region-selector" data-currency="EUR"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/switzerland.gif" alt="Switzerland Flag" />Switzerland <span>(EUR)</span></a></p>
						</li>
					</ul>
				</div>
				<div class="location-group international">
					<h6 class="location-title h4">World</h6>
					<p class="location-note">View site in English</p>
					<ul class="location-list">
						<li class="location-item">
							<p><a href="#region-selector" data-currency="INT"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/international.gif" alt="International Flag" />International</a></p>
						</li>
					</ul>
				</div>
			</div>
		</div><!-- END #region-selector -->
		<footer>
			<div class="footer-top"></div>
			<div class="footer-wrapper">
				<div class="region-and-social">
					<div class="region-selector">
						<p class="h2">Region Selector</p>
						<a href="#region-selector"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/usa.gif" alt="USA Flag" />United States <span>(USD)</span></a>
					</div>

					<?php
					// determine the correct social links for the sidebar
					switch ($GLOBALS['sport']) {
						case "ski":
							$facebookUsername = "libtechNAS";
							$instagramUsername = "libtechnas";
							$vimeoUsername = "libtech";
							$twitterUsername = "libtechnas";
							break;
						case "surf":
							$facebookUsername = "libtechsurf";
							$instagramUsername = "libtechsurf";
							$vimeoUsername = "libtech";
							$twitterUsername = "libtechsurf";
							break;
						case "skate":
							$facebookUsername = "libtechskate";
							$instagramUsername = "libtechskate";
							$vimeoUsername = "libtech";
							$twitterUsername = "LibTechSkate";
							break;
						default:
							$facebookUsername = "libtech";
							$instagramUsername = "libtechnologies";
							$vimeoUsername = "libtech";
							$twitterUsername = "libtechnologies";
					}
					?>

					<div class="social-links">
						<p class="h2">Hit us up!</p>
						<ul>
							<li><a href="http://www.facebook.com/<?php echo $facebookUsername; ?>" class="facebook" target="_blank">Facebook</a></li>
							<li><a href="http://www.instagram.com/<?php echo $instagramUsername; ?>" class="instagram" target="_blank">Instagram</a></li>
							<li><a href="http://www.vimeo.com/<?php echo $vimeoUsername; ?>" class="vimeo" target="_blank">Vimeo</a></li>
							<li><a href="http://www.twitter.com/<?php echo $twitterUsername; ?>" class="twitter" target="_blank">Twitter</a></li>
							<li><a href="/feed/" class="rss">RSS</a></li>
						</ul>
					</div>
				</div>
				<nav class="nav-footer">
					<div class="sports">
						<p class="h2">Sports</p>
						<ul>
							<li><a href="/snowboarding/">Snow</a></li>
							<li><a href="/skiing/">Ski</a></li>
							<li><a href="/surfing/">Surf</a></li>
							<li><a href="/skateboarding/">Skate</a></li>
						</ul>
					</div>
					<div class="shop">
						<p class="h2">Shop</p>
						<ul>
							<li><a href="/snowboards/">Snowboards</a></li>
							<li><a href="/skis/">Skis</a></li>
							<li><a href="/surfboards/">Surfboards</a></li>
							<li><a href="/skateboards/">Skateboards</a></li>
							<li><a href="/outerwear/">Outerwear</a></li>
							<li><a href="/apparel/">Apparel</a></li>
							<li><a href="/accessories/">Accessories</a></li>
							<li><a href="/luggage/">Luggage</a></li>
						</ul>
					</div>
					<div class="about">
						<p class="h2">About</p>
						<ul>
							<li><a href="/team/">Rippers</a></li>
							<li><a href="/category/kraftsmen/">Kraftsmen</a></li>
							<li><a href="/category/artists/">Artists</a></li>
							<li><a href="/technology/">Technology</a></li>
							<li><a href="/environmental/">Environmental</a></li>
							<li><a href="/faq/">Faq</a></li>
							<!--<li><a href="/testimonials/">Testimonials</a></li>-->
							<li><a href="/dealer-locator/">Find a Dealer</a></li>
							<li><a href="/partners/">Partners</a></li>
						</ul>
					</div>
					<div class="support">
						<p class="h2">Support</p>
						<ul>
							<li><a href="/contact/">Contact</a></li>
							<li><a href="/register/">Register</a></li>
							<li><a href="/warranty/">Warranty</a></li>
							<li><a href="http://lib-tech.shptron.com/home/privacy/4374.4.1.1" target="_blank" id="link-privacy">Privacy</a></li>
							<li><a href="http://lib-tech.shptron.com/home/policies/4374.4.1.1" target="_blank" id="link-policies">Policies</a></li>
							<li><a href="http://lib-tech.shptron.com/account/?mfg_id=4374.4&language_id=1" target="_blank" id="link-login">My Account</a></li>
							<li><a href="http://lib-tech.shptron.com/home/security/4374.4.1.1" target="_blank" id="link-safety">Safety &amp; Security</a></li>
							<li><a href="http://lib-tech.shptron.com/home/policies/4374.4.1.1#Returns" target="_blank" id="link-returns">30-Day Returns</a></li>
							<li><a href="http://lib-tech.shptron.com/home/ordering/4374.4.1.1" target="_blank" id="link-ordering">Ordering Info</a></li>
						</ul>
					</div>
				</nav>
				<div class="logo">
					<img src="<?php bloginfo('template_directory'); ?>/_/img/footer-handcrafted.png" alt="Lib Tech - Handcrafted in the USA near Canada" />
				</div>
				<div class="search">
					<p class="h2">Search</p>
					<form name="footer-search" id="footer-search" method="get" action="/">
						<input type="text" id="searchinput-footer" class="text-input" name="s" value="" />
						<input type="submit" id="searchsubmit-footer" class="submit" value="Search" />
					</form>
				</div>
				<div class="subscribe">
						<p class="h2">Subscribe</p>
						<form target="_blank" class="validate clearfix" name="mc-embedded-subscribe-form" id="mc-embedded-subscribe-form" method="post" action="http://mervin.us1.list-manage1.com/subscribe/post?u=86253f560bfb6feb1f80233bb&amp;id=c0ed21a3a8">
							<fieldset>
								<input type="text" id="mce-EMAIL" class="text-input email" name="EMAIL" value="enter your email..." onfocus="if (this.value == 'enter your email...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'enter your email...';}" />
								<?php if ( is_tree('6886') ) { ?><input type="hidden" value="2" name="group[22][2]" /><?php  // check the snowboarding box ?>
								<?php } elseif ( is_tree('6884') || is_tree('7030') ) { ?><input type="hidden" value="4" name="group[22][4]" /><?php   // NAS or NASSERS - check the NAS box ?>
								<?php } elseif ( is_tree('7159') || is_tree('7042') ) { ?><input type="hidden" value="16" name="group[22][16]" /><?php   // SKATE or SKATERS check the Skateboarding box ?>
								<?php } elseif ( is_tree('11418') ) { ?><input type="hidden" value="8" name="group[22][8]" /><?php   // WATERBOARD check the Waterboarding box ?>
								<?php  } else { // check just snowboarding ?>
								<input type="hidden" value="2" name="group[22][2]" />
								<?php } ?>
								<input type="submit" class="submit" id="mc-embedded-subscribe" name="subscribe" value="Go" />
							</fieldset>
						</form>
					</div>
				<div class="footer-copy">
					<p>701 N. 34th St, Ste #100 – Seattle, WA 98103<br />&copy; 2013 Lib Technologies – All rights reserved</p>
				</div>
				<div class="clearfix"></div>
			</div><!-- END .footer-wrapper -->
		</footer>
	</div><!-- END .wrapper -->

	<?php wp_footer(); ?>
	
	<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you support IE 6.
		 chromium.org/developers/how-tos/chrome-frame-getting-started -->
	<!--[if lt IE 8]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
	
	<!-- JavaScript includes -->
<?php include get_template_directory() . '/_/inc/footer-includes.php'; ?>

	<!-- Init the main JS -->
	<script type="text/javascript">
		$(document).ready(function(){
			LIBTECH.main.init();
		});
	</script>
	<!-- Social Media Includes -->
	<div id="fb-root"></div>
	<script type="text/javascript">
		// Facebook
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=352899581451617";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		// Twitter
		!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
		// Google+
		(function() {
			var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			po.src = 'https://apis.google.com/js/plusone.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		})();
		// Pinterest
		(function(d){
			var f = d.getElementsByTagName('SCRIPT')[0], p = d.createElement('SCRIPT');
			p.type = 'text/javascript';
			p.async = true;
			p.src = '//assets.pinterest.com/js/pinit.js';
			f.parentNode.insertBefore(p, f);
		}(document));
	</script>
	<!-- AdRoll -->
	<script type="text/javascript">
		adroll_adv_id = "AZVGSIQN7RBH7KAKYFHHX7";
		adroll_pix_id = "YG2PKQFGEJHQ7BEZBWPUT7";
		(function () {
			var oldonload = window.onload;
			window.onload = function(){
				__adroll_loaded=true;
				var scr = document.createElement("script");
				var host = (("https:" == document.location.protocol) ? "https://s.adroll.com" : "http://a.adroll.com");
				scr.setAttribute('async', 'true');
				scr.type = "text/javascript";
				scr.src = host + "/j/roundtrip.js";
				((document.getElementsByTagName('head') || [null])[0] ||
				document.getElementsByTagName('script')[0].parentNode).appendChild(scr);
				if(oldonload){oldonload();}
			};
		}());
	</script>
	<!-- Google Analytics -->
	<script type="text/javascript">
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-10240523-1', 'auto');
		ga('send', 'pageview');
	</script>
</body>
</html>