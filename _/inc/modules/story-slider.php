<?php if ( basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) ) header('Location: /'); // do not allow stanalone viewing ?>
<?php if(get_field('libtech_story_silder')): ?>

		<section class="story-slider">
			<div class="section-content">
				<div class="slider-wrapper">
					<div class="owl-carousel owl-theme-libtech">

						<?php
							while(the_repeater_field('libtech_story_silder')):
								$storyImageSmall = get_sub_field('libtech_story_silder_image_small');
								$storyImageLarge = get_sub_field('libtech_story_silder_image');
								$storyUrl = get_sub_field('libtech_story_silder_url');
								$storyAltText = get_sub_field('libtech_story_silder_alt_text');
								$storyHeadline = get_sub_field('libtech_story_silder_headline');
								$storyBody = get_sub_field('libtech_story_silder_body');
						?>

						<div class="story">
							<a href="<?php echo $storyUrl; ?>" class="story-link">
								<img src="<?php bloginfo('template_directory'); ?>/_/img/featured-slider-small.gif" data-src="<?php echo $storyImageSmall['url']; ?>" alt="<?php echo $storyAltText; ?>" class="story-img-small lazy" />
								<img src="<?php bloginfo('template_directory'); ?>/_/img/story-slider-large.gif" data-src="<?php echo $storyImageLarge['url']; ?>" alt="<?php echo $storyAltText; ?>" class="story-img-large lazy" />
							</a>
							<div class="story-copy col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
								<h3><?php echo $storyHeadline; ?></h3>
								<p><?php echo $storyBody; ?></p>
							</div>
							<div class="clearfix"></div>
							<div class="call-to-action">
								<a href="<?php echo $storyUrl; ?>" class="button">Learn More</a>
							</div>
						</div>

						<?php endwhile; ?>

					</div>
				</div>
			</div><!-- END .section-content -->
			<div class="clearfix"></div>
		</section><!-- END .story-slider -->

<?php endif; ?>
