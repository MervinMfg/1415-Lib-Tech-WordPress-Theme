<?php
/*
Template Name: Pass It On Project
*/
get_header();
?>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<section class="pass-it-on-contest container-fluid">
			<div class="section-content row">
				<h1 class="col-xs-12"><?php the_title(); ?></h1>
				<div class="contest-wrapper col-xs-12">
					<iframe src="//offerpop.com/Contest.psp?c=731677&u=1311501&a=150794994973742&p=107464664918&rest=1" width="760" height="1500" frameborder="0" onLoad="scroll(0,0);"></iframe>
				</div>
			</div><!-- END .section-content -->
		</section><!-- END .pass-it-on-contest -->
		<div class="bg1-top"></div>
		<section class="video-header video container-fluid bg-texture-gradient">
			<div class="section-content row">
				<div class="video-player col-xs-12 col-md-10 col-md-offset-1">
					<div class="video-wrapper">
						<iframe src="http://player.vimeo.com/video/116304321?title=0&amp;byline=0&amp;portrait=0&amp;color=fff100" width="640" height="360" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
					</div>
				</div>
				<div class="video-text col-xs-12 col-md-8 col-md-offset-2">
					<?php the_content(); ?>
				</div>
				</div>
			</div><!-- END .section-content -->
		</section><!-- END .video-header -->
		<section class="pass-it-on-tagboard">
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
				<?php libtech_comments_template(); ?>
			</div><!-- END .section-content -->
		</section><!-- END .tagboard -->

		<?php endwhile; endif; ?>

<?php get_footer(); ?>
