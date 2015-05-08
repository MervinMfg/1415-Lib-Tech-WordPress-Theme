<?php
/**
 * @package WordPress
 * @subpackage Lib-Tech-WordPress-Theme
 */
 get_header(); ?>

		<section class="blog-posts container-fluid">
			<div class="section-content row">
					<?php
            if (have_posts()) :
              $i = 1;
              while(have_posts()) :
                the_post();
  							$postImage = get_post_image('rect-medium');
                // get post category and find top parent category (sport)
  							$postCategory = get_the_category();
  							$catTree = get_category_parents($postCategory[0]->term_id, FALSE, ':', TRUE);
  							$topCat = explode(':', $catTree);
  							$postSport = $topCat[0];
					?>

          <div <?php post_class(array($postSport,  'blog-post col-xs-12 col-ms-12 col-sm-4')); ?> id="post-<?php the_ID(); ?>">
						<div class="post-wrapper clearfix">
							<a href="<?php the_permalink() ?>">
                <h4 class="post-category col-xs-12">Lib Tech <?php echo $postSport; ?></h4>
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
              endwhile;
              post_navigation();
            else :
          ?>
				<h1>Nothing Found</h1>
				<?php endif; ?>
			</div><!-- END .section-content -->
			<div class="clearfix"></div>
		</section><!-- END .homepage-posts -->
<!--
<?php get_sidebar(); ?>
-->
<?php get_footer(); ?>
