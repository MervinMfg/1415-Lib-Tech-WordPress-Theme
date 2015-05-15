<?php
/*
Template Name: Homepage
*/
get_header();
?>

		<?php include get_template_directory() . '/_/inc/modules/featured-slider.php'; ?>

		<?php include get_template_directory() . '/_/inc/modules/product-grid.php'; ?>

		<section class="home-sport-links container-fluid">
			<div class="section-content row">
				<ul>
					<li class="sport-link-item col-xs-6 col-sm-3 surf">
						<a href="/surfboards/">
							<div class="sli-text">
								<h3 class="sli-title">Lib Tech Surf</h3>
								<p class="sli-subtitle">Shop Surfboards</p>
							</div>
							<div class="sli-image">
								<img src="<?php bloginfo('template_directory'); ?>/_/img/home-sport-link-surf.jpg" alt="" />
							</div>
							<div class="sli-image-hover"></div>
						</a>
					</li>
					<li class="sport-link-item col-xs-6 col-sm-3 skate">
						<a href="/skateboards/">
							<div class="sli-text">
								<h3 class="sli-title">Lib Tech Skate</h3>
								<p class="sli-subtitle">Shop Skateboards</p>
							</div>
							<div class="sli-image">
								<img src="<?php bloginfo('template_directory'); ?>/_/img/home-sport-link-skate.jpg" alt="" />
							</div>
							<div class="sli-image-hover"></div>
						</a>
					</li>
					<li class="sport-link-item col-xs-6 col-sm-3 snow">
						<a href="/snowboards/">
							<div class="sli-text">
								<h3 class="sli-title">Lib Tech Snow</h3>
								<p class="sli-subtitle">Shop Snowboards</p>
							</div>
							<div class="sli-image">
								<img src="<?php bloginfo('template_directory'); ?>/_/img/home-sport-link-snow.jpg" alt="" />
							</div>
							<div class="sli-image-hover"></div>
						</a>
					</li>
					<li class="sport-link-item col-xs-6 col-sm-3 ski">
						<a href="/skis/">
							<div class="sli-text">
								<h3 class="sli-title">Lib Tech NAS</h3>
								<p class="sli-subtitle">Shop Skis</p>
							</div>
							<div class="sli-image">
								<img src="<?php bloginfo('template_directory'); ?>/_/img/home-sport-link-ski.jpg" alt="" />
							</div>
							<div class="sli-image-hover"></div>
						</a>
					</li>
				</ul>
			</div><!-- .section-content -->
		</section><!-- .home-sport-links -->

		<?php include get_template_directory() . '/_/inc/modules/story-slider.php'; ?>

		<?php include get_template_directory() . '/_/inc/modules/latest-posts.php'; ?>

		<?php include get_template_directory() . '/_/inc/modules/instagram.php'; ?>

		<?php
			$post_objects = get_field('libtech_homepage_featured_products');
			if( $post_objects ):
		?>

		<section class="product-grid featured container-fluid bg-texture-gradient">
			<div class="section-content row">
				<ul>

					<?php
						foreach( $post_objects as $post_object):
							$imageID = get_field('libtech_product_image', $post_object->ID);
							$productImage = wp_get_attachment_image_src($imageID, 'square-large');
							$productLink = get_permalink($post_object->ID);
							$productTitle = get_the_title($post_object->ID);
							$postType = $post_object->post_type;
							// set post category
							switch ($postType) {
								case "libtech_skateboards":
									$postCat = "skateboards";
									$postCatLink = "/skateboards/";
									break;
								case "libtech_surfboards":
									$postCat = "surfboards";
									$postCatLink = "/surfboards/";
									break;
								case "libtech_nas":
									$postCat = "skis";
									$postCatLink = "/skis/";
									break;
								case "libtech_snowboards":
									$postCat = "snowboards";
									$postCatLink = "/snowboards/";
									break;
							}
							// get product price
							if ($postType == "libtech_surfboards") {
								// check fin pricing and what to display by default
								if (get_field('libtech_product_price_us_5fin', $post_object->ID) == "") {
										$productPrice = getPrice(
											get_field('libtech_product_price_us', $post_object->ID),
											get_field('libtech_product_price_ca', $post_object->ID),
											get_field('libtech_product_price_eur', $post_object->ID),
											get_field('libtech_product_on_sale', $post_object->ID),
											get_field('libtech_product_sale_percentage', $post_object->ID),
											false
										);
								} else {
										$productPrice = getPrice(
											get_field('libtech_product_price_us_5fin', $post_object->ID),
											get_field('libtech_product_price_ca_5fin', $post_object->ID),
											get_field('libtech_product_price_eur_5fin', $post_object->ID),
											get_field('libtech_product_on_sale', $post_object->ID),
											get_field('libtech_product_sale_percentage', $post_object->ID),
											false
										);
								}
							} else {
								// grab default price of all other products
								$productPrice = getPrice(
									get_field('libtech_product_price_us', $post_object->ID),
									get_field('libtech_product_price_ca', $post_object->ID),
									get_field('libtech_product_price_eur', $post_object->ID),
									get_field('libtech_product_on_sale', $post_object->ID),
									get_field('libtech_product_sale_percentage', $post_object->ID),
									false
								);
							}
					?>

					<li class="col-xs-3 col-ms-3 col-sm-3 col-md-3">
						<div class="grid-item <?php echo $postCat; ?>">
							<div class="grid-item-wrapper">
								<img src="<?php echo $productImage[0]; ?>" width="<?php echo $productImage[1]; ?>" height="<?php echo $productImage[2]; ?>" alt="<?php echo $productTitle; ?> Image" />
								<div class="grid-item-info">
									<a href="<?php echo $productLink; ?>">
										<p class="product-title"><?php echo $productTitle; ?></p>
										<?php echo $productPrice; ?>
									</a>
									<div class="call-to-action">
										<a href="<?php echo $productLink; ?>" class="button">Learn More</a>
										<a href="<?php echo $postCatLink; ?>" class="button">Shop <?php echo $postCat; ?></a>
									</div>
								</div>
								<a href="<?php echo $productLink; ?>" class="grid-link"></a>
							</div>
						</div>
					</li>

					<?php endforeach; ?>

				</ul>
			</div><!-- .section-content -->
		</section><!-- .featured-products -->

		<?php endif; ?>

<?php get_footer(); ?>
