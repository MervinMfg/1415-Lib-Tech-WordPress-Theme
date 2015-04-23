<?php if ( basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) ) header('Location: /'); // do not allow stanalone viewing ?>

	<section class="latest-posts container-fluid">
		<div class="section-content row">
			<ul>

				<?php
					$moreUrl = "/blog/";
					$latestPostsCategory = get_field('libtech_latest_posts_category');
					if($latestPostsCategory) {
						// get 3 most recent posts within defined category
						$args = array(
							'cat' => $latestPostsCategory,
							'posts_per_page' => 3,
							'post__in'  => get_option( 'sticky_posts' ),
							'ignore_sticky_posts' => 1
						);
						$moreUrl = get_category_link($latestPostsCategory);
					} else {
						// get 3 most recent posts within all categories
						$args = array(
							'posts_per_page' => 3,
							'post__in'  => get_option( 'sticky_posts' ),
							'ignore_sticky_posts' => 1
						);
					}
					// do post query
					$postsQuery = new WP_Query($args);
					// loop through posts
					$i=1;
					if (have_posts()) :
						while ($postsQuery->have_posts()) :
							$postsQuery->the_post();
							$postImage = get_post_image('square-medium');
							// get post category and find top parent category (sport)
							$postCategory = get_the_category();
							$catTree = get_category_parents($postCategory[0]->term_id, FALSE, ':', TRUE);
							$topCat = explode(':', $catTree);
							$postSport = $topCat[0];
				?>

				<li class="latest-post <?php echo $postSport; ?>">
					<div class="post-wrapper col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-0">
						<a href="<?php the_permalink() ?>">
							<?php if(!$latestPostsCategory) : ?><h4 class="post-category">Lib Tech <?php echo $postSport; ?></h4><?php endif; ?>
							<img src="<?php echo $postImage[0]; ?>" alt="Image From <?php echo get_the_title(); ?>" />
							<p class="post-meta">
								<time datetime="<?php the_time('c') ?>"><?php the_time('F jS, Y') ?></time>
							</p>
							<h3 class="post-title"><?php the_title(); ?></h3>
						</a>
					</div>
				</li>

				<?php
							$post_thumbnail = ""; $i++; // resetting image value, incrementing $i
						endwhile;
					endif;
					// Reset Post Data
					wp_reset_query();
				?>

			</ul>
			<div class="clearfix"></div>
			<div class="call-to-action">
				<a href="<?php echo $moreUrl; ?>" class="button">More Articles</a>
			</div>
		</div><!-- END .section-content -->
	</section><!-- END .homepage-posts -->
