<?php
/*
Template Name: Homepage Sport
*/
get_header();
?>
		<?php include get_template_directory() . '/_/inc/modules/featured-slider.php'; ?>

		<section class="product-slider container-fluid">
			<div class="section-content row">
				<ul class="product-listing bxslider">
					<?php if($GLOBALS['sport'] == "snow") : ?>
					<li class="diy grid-item-wrapper col-xs-6 col-ms-4 col-md-2">
						<img src="<?php bloginfo('template_directory'); ?>/_/img/diy-board-builder-300x300.png" width="300" height="300" alt="DIY Snowboard Builder" />
						<div class="grid-item-info">
							<p class="product-title">Lib Tech DIY</p>
							<a href="/snowboarding/snowboard-builder/" class="button">DIY Now</a>
						</div>
						<a href="/snowboarding/snowboard-builder/" class="mobile-grid-link"></a>
					</li>
					<?php
						endif;
						if ($GLOBALS['sport'] == "ski") {
							$postType = "libtech_nas";
							$postSport = "ski";
						} else if ($GLOBALS['sport'] == "surf") {
							$postType = "libtech_surfboards";
							$postSport = "surf";
						} else if ($GLOBALS['sport'] == "skate") {
							$postType = "libtech_skateboards";
							$postSport = "skate";
						} else {
							$postType = "libtech_snowboards";
							$postSport = "snow";
						}
						// Get Products
						$args = array(
							'post_type' => $postType,
							'posts_per_page' => -1,
							'orderby' => 'menu_order',
							'order' => 'ASC',
						);
						$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post();
							$postType = $post->post_type;
							$postSlug = $post->post_name;
							$imageID = get_field('libtech_product_image');
							$imageFile = wp_get_attachment_image_src($imageID, 'square-medium');
							// check for technology type to display
							$productType = "";
							if ($postType == "libtech_snowboards") {
								$productType = get_field('libtech_snowboard_contour');
							} else if ($postType == "libtech_nas") {
								$productType = "Magne-Traction";
							} else if ($postType == "libtech_skateboards") {
								// grab first skateboard category for display
			                    $categories = get_the_terms( $post->ID , 'libtech_skateboard_categories' );
			                    foreach ( $categories as $category ) {
									$productType = $category->name;
			                        break;
			                    }
							}
					?>

					<li class="<?php echo $postSlug; ?> grid-item-wrapper col-xs-6 col-ms-4 col-md-2">
						<img src="<?php echo $imageFile[0]; ?>" width="<?php echo $imageFile[1]; ?>" height="<?php echo $imageFile[2]; ?>" alt="<?php the_title(); ?> Image" />
						<div class="grid-item-info">
							<p class="product-title"><?php the_title(); ?></p>
							<?php
								echo getPrice(
									get_field('libtech_product_price_us'),
									get_field('libtech_product_price_ca'),
									get_field('libtech_product_price_eur'),
									get_field('libtech_product_on_sale'),
									get_field('libtech_product_sale_percentage'),
									true
								);
							?>
							<a href="<?php the_permalink(); ?>" class="button">Buy Now</a>
						</div>
						<a href="<?php the_permalink(); ?>" class="mobile-grid-link"></a>
					</li>

					<?
						endwhile;
						wp_reset_query();
					?>
				</ul>
				<div class="call-to-action">
					<?php
						switch ($GLOBALS['sport']) {
							case 'snow':
								echo '<a href="/snowboards/" class="view-all-link button">View all boards</a>';
								break;
							case 'surf':
								echo '<a href="/surfboards/" class="view-all-link button">View all boards</a>';
								break;
							case 'skate':
							    echo '<a href="/skateboards/#filter=.available" class="view-all-link button">View all boards</a>';
								break;
							case 'ski':
							    echo '<a href="/skis/" class="view-all-link button">View all skis</a>';
							    break;
						}
					?>
				</div><!-- .button-wrapper -->

			</div>
		</section><!-- END .product-slider -->

		<?php include get_template_directory() . '/_/inc/modules/latest-posts.php'; ?>

		<?php include get_template_directory() . '/_/inc/modules/instagram.php'; ?>

		<?php
			$facebookUsername = get_field('libtech_homepage_fb_username');
			if ($facebookUsername == "") { $facebookUsername = "libtech"; }
			$instagramUsername = get_field('libtech_homepage_instagram_username');
			if ($instagramUsername == "") { $instagramUsername = "libtechnologies"; }
			$vimeoUsername = get_field('libtech_homepage_vimeo_username');
			if ($vimeoUsername == "") { $vimeoUsername = "libtech"; }
			$twitterUsername = get_field('libtech_homepage_twitter_username');
			if ($twitterUsername == "") { $twitterUsername = "libtechnologies"; }
		?>

		<section class="social-links container-fluid">
			<div class="section-content row">
					<p class="social-link-sport skate h4 col-xs-6 col-xs-offset">Follow Lib Skate</p>
					<ul class="col-xs-6">
						<li><a href="http://www.facebook.com/<?php echo $facebookUsername; ?>" class="facebook" target="_blank">Facebook</a></li>
						<li><a href="http://www.instagram.com/<?php echo $instagramUsername; ?>" class="instagram" target="_blank">Instagram</a></li>
						<li><a href="http://www.vimeo.com/<?php echo $vimeoUsername; ?>" class="vimeo" target="_blank">Vimeo</a></li>
						<li><a href="http://www.twitter.com/<?php echo $twitterUsername; ?>" class="twitter" target="_blank">Twitter</a></li>
					</ul>
					<div class="clearfix"></div>
				</div>
			</div>
		</section>

		<?php include get_template_directory() . '/_/inc/modules/product-grid.php'; ?>

		<section class="home-sport-team container-fluid">
			<div class="section-content row">
				<?php
					$pageSlug = $post->post_name;
					// select correct post type based on slug
					switch ($pageSlug) {
						case 'snowboarding':
							$postType = "libtech_team_snow";
							$postCat = "snow";
							$teamUrl = "/snowboarding/team/";
							break;
						case 'skateboarding':
							$postType = "libtech_team_skate";
							$postCat = "skate";
							$teamUrl = "/skateboarding/team/";
							break;
						case 'surfing':
							$postType = "libtech_team_surf";
							$postCat = "surf";
							$teamUrl = "/surfing/team/";
							break;
						case 'skiing':
							$postType = "libtech_team_nas";
							$postCat = "ski";
							$teamUrl = "/skiing/team/";
							break;
					}
				?>

				<h2 class="<?php echo $postCat; ?> col-xs-12"><?php echo $postCat; ?> Rippers</h2>
				<ul>
					<?php
						$args = array(
	            'post_type' => $postType,
	            'posts_per_page' => 4,
	            'orderby' => 'menu_order',
	            'order' => 'ASC'
	          );
            $loop = new WP_Query( $args );
            while ( $loop->have_posts() ) : $loop->the_post();
              $profilePhoto = get_field('libtech_team_profile_photo');
              $profilePhoto = wp_get_attachment_image_src($profilePhoto, 'square-medium', false);
          ?>

					<li class="home-sport-team-item col-xs-6 col-ms-3 col-sm-3 col-md-3">
						<a href="<?php the_permalink(); ?>">
							<img src="<?php echo $profilePhoto[0]; ?>" alt="<?php the_title(); ?> Profile" />
						</a>
					</li>

					<?php
						endwhile;
						wp_reset_query();
					?>

				</ul>
			</div>
			<div class="call-to-action">
				<a href="<?php echo $teamUrl; ?>" class="button">View Team</a>
			</div>
		</section><!-- .home-sport-team -->

<?php get_footer(); ?>
