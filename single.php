<?php
/**
 * @package WordPress
 * @subpackage Lib-Tech-WordPress-Theme
 */
 get_header(); ?>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="bg2-top"></div>
		<section class="bg2 blog-post">
        	<div class="section-content">
        		<div class="section-content-wrapper">
					<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
						<div class="post-wrapper">
							<div class="entry-header">
								<h1 class="entry-title"><?php the_title(); ?></h1>
								<p class="entry-meta">
									<time datetime="<?php echo date(DATE_W3C); ?>" pubdate class="updated"><?php the_time('F jS, Y') ?></time> – <fb:comments-count href=<?php the_permalink() ?>></fb:comments-count> Comments 
								</p>
								<ul class="entry-share">
									<li><div class="fb-like" data-href="<? the_permalink(); ?>" data-send="true" data-layout="button_count" data-width="150" data-show-faces="false" data-colorscheme="dark" data-font="trebuchet ms"></div></li>
									<li><a href="https://twitter.com/share" class="twitter-share-button" data-via="libtechnologies">Tweet</a></li>
									<li><div class="g-plusone" data-size="medium" data-href="<? the_permalink(); ?>"></div></li>
									<li><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $GLOBALS['pageImage']; ?>&description=<?php echo $GLOBALS['pageTitle']; ?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></li>
								</ul>
							</div><!-- END .entry-header -->
							<div class="entry-content">
								
								<?php the_content(); ?>

								<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>

							</div>
							<div class="entry-categories-tags">
								<p class="entry-categories">
									Categories: <?php the_category(', ') ?>
								</p>
								<p class="entry-tags">
									<?php the_tags('Tags: ', ', ', ''); ?>
								</p>
							</div>

							<?php comments_template(); ?>
						</div><!-- END .post-wrapper -->
					</article>

					<?php get_sidebar(); ?>

					<div class="clearfix"></div>
				</div><!-- END .section-content-wrapper -->
			</div><!-- END .section-content -->
        </section><!-- END .blog-post -->

		<?php endwhile; endif; ?>

<?php post_navigation(); ?>

<!--
<?php get_sidebar(); ?>
-->

<?php get_footer(); ?>