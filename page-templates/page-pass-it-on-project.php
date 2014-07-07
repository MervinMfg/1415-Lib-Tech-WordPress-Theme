<?php
/*
Template Name: Pass It On Project
*/
get_header();
?>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="bg-product-snow-top"></div>
		<section class="video-header video bg-product-snow">
			<div class="section-content">
				<h1><?php the_title(); ?></h1>
				<div class="video-player">
					<div class="video-wrapper">
						<iframe src="http://player.vimeo.com/video/88123987?title=0&amp;byline=0&amp;portrait=0&amp;color=fff100" width="640" height="360" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
					</div>
				</div>
				<div class="video-text">
					<?php the_content(); ?>
				</div>
				<div class="clearfix"></div>
			</div><!-- END .section-content -->
		</section><!-- END .video-header -->
		<div class="bg3-top"></div>
		<section class="bg3 pass-it-on-contest">
			<div class="section-content">
				<h2>#passitonproject Sweepstakes</h2>
				<div class="woobox-wrapper">
					<!-- START Woobox Offer -->
					<div class='woobox-offer' data-offer='mqorfw'></div>
					<div id='woobox-root'></div>
					<script>
						(function(d, s, id) {
							var js, fjs = d.getElementsByTagName(s)[0];
							if (d.getElementById(id)) return;
							js = d.createElement(s); js.id = id;
							js.src = "//woobox.com/js/plugins/woo.js";
							fjs.parentNode.insertBefore(js, fjs);
						}(document, 'script', 'woobox-sdk'));
					</script>
					<!-- END Woobox Offer -->
					<div class="clearfix"></div>
				</div>
				<div class="product-wrapper">
					<ul>
						<li class="product">
							<h4>Travis Rice Speedodeeps BTX</h4>
							<p>2013 #passitonproject<br /><a href="/snowboards/travis-rice-speedodeeps/">Available Now</a></p>
							<div class="product-image">
								<a href="/snowboards/travis-rice-speedodeeps/"><img src="<?php bloginfo('template_directory'); ?>/_/img/pass-it-on-project-speedodeeps.png" alt="2013/14 Speedodeeps" /></a>
							</div>
						</li>
						<li class="product lightbox">
							<h4>Travis Rice Gold Member XC2 BTX</h4>
							<p>2014 #passitonproject<br /><a href="<?php bloginfo('template_directory'); ?>/_/img/pass-it-on-project-gold-member-info.jpg" class="lightbox">Available 9/1</a></p>
							<div class="product-image">
								<a href="<?php bloginfo('template_directory'); ?>/_/img/pass-it-on-project-gold-member-info.jpg"><img src="<?php bloginfo('template_directory'); ?>/_/img/pass-it-on-project-gold-member.png" alt="2014/15 Gold Member" /></a>
							</div>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
			</div><!-- END .section-content -->
		</section><!-- END .pass-it-on-contest -->
		<div class="bg2-top"></div>
		<section class="bg2 pass-it-on-tagboard">
			<div class="section-content">
				<h2>#passitonproject Tagboard</h2>
				<div class="social-links">
					<p class="h4">Hit us up!</p>
					<ul>
						<li><a href="http://www.facebook.com/libtech" class="facebook" target="_blank">Facebook</a></li>
						<li><a href="http://www.instagram.com/libtechnologies" class="instagram" target="_blank">Instagram</a></li>
						<li><a href="http://www.vimeo.com/libtech" class="vimeo" target="_blank">Vimeo</a></li>
						<li><a href="http://www.twitter.com/libtechnologies" class="twitter" target="_blank">Twitter</a></li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<!-- START TagBoard -->
				<div id="tagboard-embed"></div>
				<script>
					var tagboardOptions = {tagboard:"passitonproject/153199", darkMode: true};
				</script>
				<script src="https://tagboard.com/public/js/embed.js"></script>
				<!-- END TagBoard -->
				<?php comments_template(); ?>
			</div><!-- END .section-content -->
		</section><!-- END .tagboard -->

		<?php endwhile; endif; ?>

<?php get_footer(); ?>