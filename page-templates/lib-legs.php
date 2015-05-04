<?php
/*
Template Name: Lib Legs
*/
get_header();
?>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<section class="video-header video container-fluid bg-texture-gradient">
			<div class="section-content row">
				<h1 class="<?php echo $GLOBALS['sport']; ?> col-xs-12 col-md-10 col-md-offset-1"><?php the_title(); ?></h1>
				<div class="video-player col-xs-12 col-md-10 col-md-offset-1">
					<div class="video-wrapper">
						<?php if (get_field('libtech_liblegs_video_id')) : $videoID = get_field('libtech_liblegs_video_id'); ?>
						<iframe src="http://player.vimeo.com/video/<?php echo $videoID; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=66CC00&amp;autoplay=0" width="640" height="360" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
						<?php endif; ?>
					</div>
				</div>
				<div class="video-text col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
					<ul class="entry-share">
						<li><div class="fb-like" data-href="<? the_permalink(); ?>" data-send="true" data-layout="button_count" data-width="150" data-show-faces="false" data-colorscheme="dark" data-font="trebuchet ms"></div></li>
						<li><a href="https://twitter.com/share" class="twitter-share-button" data-via="libtechnologies">Tweet</a></li>
						<li><div class="g-plusone" data-size="medium" data-href="<? the_permalink(); ?>"></div></li>
						<li><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $GLOBALS['pageImage']; ?>&description=<?php echo $GLOBALS['pageTitle']; ?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></li>
					</ul>
					<div class="clearfix"></div>
					<?php the_content(); ?>
				</div>
				<div class="clearfix"></div>
			</div><!-- END .section-content -->
		</section><!-- END .video-header -->

		<?php include get_template_directory() . '/_/inc/modules/featured-slider.php'; ?>

		<?php include get_template_directory() . '/_/inc/modules/product-slider.php'; ?>

		<?php include get_template_directory() . '/_/inc/modules/latest-posts.php'; ?>

		<div class="bg2-top"></div>
		<section class="bg2 pass-it-on-tagboard">
			<div class="section-content">
				<h2>#liblegs Tagboard</h2>
				<div class="social-links">
					<p class="h4">Hit us up!</p>
					<ul>
						<li><a href="http://www.facebook.com/libtechskate" class="facebook" target="_blank">Facebook</a></li>
						<li><a href="http://www.instagram.com/libtechskate" class="instagram" target="_blank">Instagram</a></li>
						<li><a href="http://www.vimeo.com/libtech" class="vimeo" target="_blank">Vimeo</a></li>
						<li><a href="http://www.twitter.com/libtechskate" class="twitter" target="_blank">Twitter</a></li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<!-- START TagBoard -->
				<div class="tagboard-embed" tgb-slug="liblegs/173006" tgb-dark-mode="true"></div>
				<script src="https://static.tagboard.com/public/js/embed.js"></script>
				<!-- END TagBoard -->
				<?php libtech_comments_template(); ?>
			</div><!-- END .section-content -->
		</section><!-- END .tagboard -->

		<?php endwhile; endif; ?>

<?php get_footer(); ?>
