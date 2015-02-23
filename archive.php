<?php
/**
 * @package WordPress
 * @subpackage Lib-Tech-WordPress-Theme
 */
get_header(); ?>

		<div class="bg3-top"></div>
		<section class="blog-posts bg3">
			<div class="section-content">

			<?php if (have_posts()) : ?>

	 			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

				<?php /* If this is a category archive */ if (is_category()) { ?>
					<h2>Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h2>

				<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
					<h2>Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h2>

				<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
					<h2>Archive for <?php the_time('F jS, Y'); ?></h2>

				<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
					<h2>Archive for <?php the_time('F, Y'); ?></h2>

				<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
					<h2 class="pagetitle">Archive for <?php the_time('Y'); ?></h2>

				<?php /* If this is an author archive */ } elseif (is_author()) { ?>
					<h2 class="pagetitle">Author Archive</h2>

				<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
					<h2 class="pagetitle">Blog Archives</h2>
				
				<?php } ?>

				<ul>

				<?php while (have_posts()) : the_post(); $postImage = get_post_image('square-medium'); ?>
				
					<li <?php post_class('blog-post'); ?> id="post-<?php the_ID(); ?>">
							<div class="post-wrapper">
								<a href="<?php the_permalink() ?>">
									<img src="<?php echo $postImage[0]; ?>" alt="Image From <?php echo get_the_title(); ?>" />
									<h3 class="post-title"><?php the_title(); ?></h3>
									<p class="post-meta">
										<time datetime="<?php the_time('c') ?>"><?php the_time('F jS, Y') ?></time> | <span class="shares"></span>
									</p>
									<p class="post-excerpt"><?php echo libtech_excerpt('libtech_excerptlength_home'); ?></p>
									<p class="post-more">READ MORE</p>
								</a>
							</div>
						</li>

				<?php endwhile; ?>

				</ul>

				<?php post_navigation(); ?>
				
			<?php else : ?>

				<h2>Nothing Found</h2>

			<?php endif; ?>

			</div><!-- END .section-content -->
			<div class="clearfix"></div>
		</section><!-- END .homepage-posts -->
<!--
<?php get_sidebar(); ?>
-->
<?php get_footer(); ?>
