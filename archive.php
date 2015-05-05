<?php
/**
 * @package WordPress
 * @subpackage Lib-Tech-WordPress-Theme
 */
get_header(); ?>

		<section class="blog-posts container-fluid">
			<div class="section-content row">

			<?php if (have_posts()) : ?>

	 			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

				<?php /* If this is a category archive */ if (is_category()) { ?>
					<h2 class="col-xs-12">Articles for <?php single_cat_title(); ?></h2>

				<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
					<h2 class="col-xs-12">Posts Tagged <?php single_tag_title(); ?></h2>

				<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
					<h2 class="col-xs-12">Articles for <?php the_time('F jS, Y'); ?></h2>

				<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
					<h2 class="col-xs-12">Articles for <?php the_time('F, Y'); ?></h2>

				<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
					<h2 class="pagetitle col-xs-12">Articles for <?php the_time('Y'); ?></h2>

				<?php /* If this is an author archive */ } elseif (is_author()) { ?>
					<h2 class="pagetitle col-xs-12">Author Articles</h2>

				<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
					<h2 class="pagetitle col-xs-12">Blog Articles</h2>

				<?php } ?>

				<ul>

				<?php
					$i = 1;
					while (have_posts()) : the_post();
						$postImage = get_post_image('rect-medium');
				?>

					<div <?php post_class('blog-post col-xs-12 col-ms-12 col-sm-4'); ?> id="post-<?php the_ID(); ?>">
						<div class="post-wrapper clearfix">
							<a href="<?php the_permalink() ?>">
								<div class="post-image-wrapper col-ms-4 col-sm-12">
									<img src="<?php echo $postImage[0]; ?>" alt="Image From <?php echo get_the_title(); ?>" />
								</div>
								<div class="post-text-wrapper col-ms-8 col-sm-12">
									<p class="post-meta">
										<time datetime="<?php the_time('c') ?>"><?php the_time('F jS, Y') ?></time>
									</p>
									<h3 class="post-title"><?php the_title(); ?></h3>
								</div>
							</a>
						</div>
					</div>

					<?php
						if($i %3 == 0) echo '<div class="clearfix visible-sm visible-md visible-lg"></div>';
						$i++;
					endwhile; ?>

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
