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
						<iframe src="http:////player.vimeo.com/video/116304321?title=0&amp;byline=0&amp;portrait=0&amp;color=fff100" width="640" height="360" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
					</div>
				</div>
				<div class="video-text">
					<?php the_content(); ?>
				</div>
				<div class="clearfix"></div>
			</div><!-- END .section-content -->
		</section><!-- END .video-header -->
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