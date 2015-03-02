<?php
/*
Template Name: Support
*/
get_header(); ?>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<div class="bg2-top"></div>
		<section class="bg2 support">
        	<div class="section-content">
        		<article <?php post_class() ?> id="page-<?php the_ID(); ?>">
					<div class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</div><!-- END .entry-header -->
					<div class="entry-content">
						
						<?php the_content(); ?>

					</div>
					<div class="clearfix"></div>
					<?php comments_template(); ?>
				</article>
			</div><!-- END .section-content -->
        </section><!-- END .product-zoom -->

		<?php endwhile; endif; ?>

<?php get_footer(); ?>