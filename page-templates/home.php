<?php
/*
Template Name: Homepage
*/
get_header();
?>

		<?php include get_template_directory() . '/_/inc/modules/featured-slider.php'; ?>

		<section class="product-grid container-fluid">
			<div class="section-content row">
				<div class="grid-wrapper col-xs-12 col-sm-6 col-md-5 col-md-offset-1 col-lg-4 col-lg-offset-2">
					<div class="grid-left col-xs-6 col-ms-5 col-ms-offset-1 col-sm-6 col-md-6">
						<div class="grid-item">
							<div class="grid-item-wrapper skate">
								<img src="http://cdn.lib-tech.com/wp-content/uploads/2015/04/Lib-Tech-Exo-Bowl-Troll-800x800.png" />
								<div class="grid-item-info">
									<p class="product-title">Bowl Troll</p>
									<p class="product-price">$79.95 <span class="currency-note">usd</span></p>
									<a href="#" class="button">Buy Now</a>
									<a href="#" class="button">Shop Skateboards</a>
								</div>
								<a href="#" class="mobile-grid-link"></a>
							</div>
						</div>
					</div>
					<div class="grid-right col-xs-6 col-ms-5 col-sm-6 col-md-6">
						<div class="grid-item">
							<div class="grid-item-wrapper apparel">
								<img src="http://cdn.lib-tech.com/wp-content/uploads/2014/07/DanvilleSnapback_CHR_ANGLE-800x800.png" />
							</div>
						</div>
						<div class="grid-item">
							<div class="grid-item-wrapper apparel">
								<img src="http://cdn.lib-tech.com/wp-content/uploads/2014/07/RedGirlTee_BLK.png" />
							</div>
						</div>
					</div>
				</div><!-- .grid-wrapper -->
				<div class="grid-wrapper col-xs-12 col-sm-6 col-md-5 col-lg-4">
					<div class="grid-left col-xs-6 col-ms-5 col-ms-offset-1 col-sm-6 col-md-6">
						<div class="grid-item">
							<div class="grid-item-wrapper surf">
								<img src="http://cdn.lib-tech.com/wp-content/uploads/2014/04/Lib-Tech-Waterboards-Overviews-Ramp-800x800.png" />
							</div>
						</div>
					</div>
					<div class="grid-right col-xs-6 col-ms-5 col-sm-6 col-md-6">
						<div class="grid-item">
							<div class="grid-item-wrapper apparel">
								<img src="http://cdn.lib-tech.com/wp-content/uploads/2014/04/CLASSIC-PULLOVER-RED-800x800.png" />
								<div class="grid-item-info">
									<p class="product-title">Classic Pullover</p>
									<p class="product-price">$59.95 <span class="currency-note">usd</span></p>
									<a href="#" class="button">Buy Now</a>
									<a href="#" class="button">Shop Apparel</a>
								</div>
								<a href="#" class="mobile-grid-link"></a>
							</div>
						</div>
						<div class="grid-item">
							<div class="grid-item-wrapper apparel">
								<img src="http://cdn.lib-tech.com/wp-content/uploads/2014/07/ShreducatorPack_CAM_ANGLE-800x800.png" />
							</div>
						</div>
					</div>
				</div><!-- .grid-wrapper -->

				<!-- Test grid with all sports -->

				<!-- <div class="grid-wrapper col-xs-12 col-sm-6 col-md-5 col-md-offset-1 col-lg-4 col-lg-offset-2">
					<div class="grid-left col-xs-6 col-ms-5 col-ms-offset-1 col-sm-6 col-md-6">
						<div class="grid-item">
							<a href="#" class="snow">
								<img src="http://cdn.lib-tech.com/wp-content/uploads/2014/07/2014-2015-Lib-Tech-Travis-Rice-Speedodeeps-Black-XC2-800x800.png" />
							</a>
						</div>
					</div>
					<div class="grid-right col-xs-6 col-ms-5 col-sm-6 col-md-6">
						<div class="grid-item">
							<a href="#" class="outerwear">
								<img src="http://cdn.lib-tech.com/wp-content/uploads/2014/07/1415_LIB_Totally-Down_Jacket_green_FRONT-800x800.png" />
							</a>
						</div>
						<div class="grid-item">
							<a href="#" class="outerwear">
								<img src="http://cdn.lib-tech.com/wp-content/uploads/2014/07/1415_LIB_Kraftsmen_Pant_desert-brown_FRONT-800x800.png" />
							</a>
						</div>
					</div>
				</div>
				<div class="grid-wrapper col-xs-12 col-sm-6 col-md-5 col-lg-4">
					<div class="grid-left col-xs-6 col-ms-5 col-ms-offset-1 col-sm-6 col-md-6">
						<div class="grid-item">
							<a href="#" class="ski">
								<img src="http://cdn.lib-tech.com/wp-content/uploads/2012/07/1314-Lib-Tech-Skis-Wreckcreate-NAS-640x640.png" />
							</a>
						</div>
					</div>
					<div class="grid-right col-xs-6 col-ms-5 col-sm-6 col-md-6">
						<div class="grid-item">
							<a href="#" class="apparel">
								<img src="http://cdn.lib-tech.com/wp-content/uploads/2014/07/DanvilleSnapback_CHR_ANGLE-800x800.png" />
							</a>
						</div>
						<div class="grid-item">
							<a href="#" class="apparel">
								<img src="http://cdn.lib-tech.com/wp-content/uploads/2014/07/RedGirlTee_BLK.png" />
							</a>
						</div>
					</div>
				</div> -->

			</div><!-- .section-content -->
		</section><!-- END .product-slider -->

		<section class="home-sport-links container-fluid">
			<div class="section-content row">
				<ul>
					<li class="sport-link-item col-xs-6 col-sm-3 col-lg-2 col-lg-offset-2">
						<a href="#">
							<img src="<?php bloginfo('template_directory'); ?>/_/img/temp-imgs/skate-link.png" alt="" />
						</a>
					</li>
					<li class="sport-link-item col-xs-6 col-sm-3 col-lg-2">
						<a href="#">
							<img src="<?php bloginfo('template_directory'); ?>/_/img/temp-imgs/surf-link.png" alt="" />
						</a>
					</li>
					<li class="sport-link-item col-xs-6 col-sm-3 col-lg-2">
						<a href="#">
							<img src="<?php bloginfo('template_directory'); ?>/_/img/temp-imgs/nas-link.png" alt="" />
						</a>
					</li>
					<li class="sport-link-item col-xs-6 col-sm-3 col-lg-2">
						<a href="#">
							<img src="<?php bloginfo('template_directory'); ?>/_/img/temp-imgs/snow-link.png" alt="" />
						</a>
					</li>
				</ul>
			</div><!-- .section-content -->
		</section><!-- .home-sport-links -->

		<?php include get_template_directory() . '/_/inc/modules/story-slider.php'; ?>


					<?php
						// $post_objects = get_field('libtech_homepage_featured_products');
						// if( $post_objects ):
						// 	$featuredProducts = Array();
						// 	foreach( $post_objects as $post_object):
						// 		$imageID = get_field('libtech_product_image', $post_object->ID);
						// 		$productImage = wp_get_attachment_image_src($imageID, 'square-medium');
						// 		$productLink = get_permalink($post_object->ID);
						// 		$productTitle = get_the_title($post_object->ID);
						// 		// add to featured product array
						// 		array_push($featuredProducts, Array($productTitle, $productLink, $productImage));
						// 	endforeach;
						// 	// loop through featured products
						// 	for($i = 0; $i < count($featuredProducts); ++$i) {
						// 		echo '<li><a href="'. $featuredProducts[$i][1] .'"><img src="'.$featuredProducts[$i][2][0].'" width="'.$featuredProducts[$i][2][1].'" height="'.$featuredProducts[$i][2][2].'" alt="' . $featuredProducts[$i][0] . ' Image" /><div class="product-peek"><p class="product-title">' . $featuredProducts[$i][0] . '</p></div></a></li>';
						// 	}
						// endif;
					?>


		<section class="homepage-posts container-fluid">
			<div class="section-content row">
				<ul class="col-xs-10 col-xs-offset-1 col-lg-8 col-lg-offset-2">

					<?php
						$args = array(
							'posts_per_page' => 3,
							'post__in'  => get_option( 'sticky_posts' ),
							'ignore_sticky_posts' => 1
						);
						$postsQuery = new WP_Query($args);

						$i=1;
						if (have_posts()) :
							while ($postsQuery->have_posts()) :
								$postsQuery->the_post();
								$postImage = get_post_image('square-medium');
					?>

					<li class="homepage-post">
						<div class="post-wrapper col-xs-12 col-sm-4">
							<a href="<?php the_permalink() ?>">
								<h4 class="post-category">Lib Tech Snowboard</h4>
								<img src="<?php echo $postImage[0]; ?>" alt="Image From <?php echo get_the_title(); ?>" />
								<p class="post-meta">
									<time datetime="<?php the_time('c') ?>"><?php the_time('F jS, Y') ?></time> | <span class="shares"></span>
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
				<a href="#" class="button">More Articles</a>
			</div><!-- END .section-content -->
		</section><!-- END .homepage-posts -->

		<section class="instagram-feed container-fluid">
			<div class="section-content row">
				<div class="instagram-wrapper col-xs-6 col-ms-3 col-sm-3 col-md-2">

					<!-- TEMPORARY INSTAGRAM PHOTOS -->
					<a href="#">
						<img src="<?php bloginfo('template_directory'); ?>/_/img/temp-imgs/instagram-1.png" alt="" />
					</a>
				</div>
				<div class="instagram-wrapper col-xs-6 col-ms-3 col-sm-3 col-md-2">
					<a href="#">
						<img src="<?php bloginfo('template_directory'); ?>/_/img/temp-imgs/instagram-2.png" alt="" />
					</a>
				</div>
				<div class="instagram-wrapper col-xs-6 col-ms-3 col-sm-3 col-md-2">
					<a href="#">
						<img src="<?php bloginfo('template_directory'); ?>/_/img/temp-imgs/instagram-3.png" alt="" />
					</a>
				</div>
				<div class="instagram-wrapper col-xs-6 col-ms-3 col-sm-3 col-md-2">
					<a href="#">
						<img src="<?php bloginfo('template_directory'); ?>/_/img/temp-imgs/instagram-4.png" alt="" />
					</a>
				</div>
				<div class="instagram-wrapper gram-image-5 col-xs-6 col-ms-3 col-sm-3 col-md-2">
					<a href="#">
						<img src="<?php bloginfo('template_directory'); ?>/_/img/temp-imgs/instagram-2.png" alt="" />
					</a>
				</div>
				<div class="instagram-wrapper gram-image-6 col-xs-6 col-ms-3 col-sm-3 col-md-2">
					<a href="#">
						<img src="<?php bloginfo('template_directory'); ?>/_/img/temp-imgs/instagram-3.png" alt="" />
					</a>
				</div>
			</div>
		</section>
		<section class="featured-products container-fluid">
			<div class="section-content row">
				<ul>
					<li class="featured-product-item col-xs-3 col-md-2 col-md-offset-2 col-">
						<a href="#" class="snow">
							<img src="http://cdn.lib-tech.com/wp-content/uploads/2014/07/2014-2015-Lib-Tech-Jamie-Lynn-Phoenix-Wave-C3-800x800.png" alt="" />
						</a>
					</li>
					<li class="featured-product-item col-xs-3 col-md-2">
						<a href="#" class="ski">
							<img src="http://cdn.lib-tech.com/wp-content/uploads/2012/07/1314-Lib-Tech-Skis-Fully-Functional-Five-NAS-640x640.png" alt="" />
						</a>
					</li>
					<li class="featured-product-item col-xs-3 col-md-2">
						<a href="#" class="surf">
							<img src="http://cdn.lib-tech.com/wp-content/uploads/2014/04/Lib-Tech-Waterboards-Overviews-Ramp-800x800.png" alt="" />
						</a>
					</li>
					<li class="featured-product-item col-xs-3 col-md-2">
						<a href="#" class="skate">
							<img src="http://cdn.lib-tech.com/wp-content/uploads/2015/04/Lib-Tech-Exo-Bowl-Troll-800x800.png" alt="" />
						</a>
					</li>
				</ul>
			</div><!-- .section-content -->
		</section><!-- .featured-products -->

<?php get_footer(); ?>
