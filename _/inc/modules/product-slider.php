<?php if ( basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) ) header('Location: /'); // do not allow stanalone viewing ?>

<?php
	function getProductPostType() {
		$postType = get_post_type();
		if($postType == "libtech_snowboards"
			|| $postType == "libtech_nas"
			|| $postType == "libtech_surfboards"
			|| $postType == "libtech_skateboards"
			|| $postType == "libtech_outerwear"
			|| $postType == "libtech_apparel"
			|| $postType == "libtech_accessories") {
				return $postType;
		} else {
			return false;
		}
	}
	$featuredProducts = get_field('libtech_product_slider_featured_products');
?>

		<section class="product-slider<?php if(getProductPostType()) echo ' product-details-nav'; if($featuredProducts) echo ' product-slider-featured'; ?>">
			<div class="section-content">
				<div class="product-list owl-carousel owl-theme-libtech bg-texture-gradient">

					<?php
				    if($featuredProducts) :
				        // get each related product
				        foreach( $featuredProducts as $featuredProduct):
			            $postType = $featuredProduct->post_type;
									$postSlug = $featuredProduct->post_name;
			            // get variable values
			            $imageID = get_field('libtech_product_image', $featuredProduct->ID);
			            // check which image size to use based on post type
			            $imageFile = wp_get_attachment_image_src($imageID, 'square-medium');
			            $productLink = get_permalink($featuredProduct->ID);
			            $productTitle = get_the_title($featuredProduct->ID);
					?>

					<div class="product-item <?php echo $postSlug; ?>">
						<a href="<? echo $productLink; ?>">
							<div class="image-wrapper">
								<img src="<?php bloginfo('template_directory'); ?>/_/img/square.gif" data-src="<?php echo $imageFile[0]; ?>" width="<?php echo $imageFile[1]; ?>" height="<?php echo $imageFile[2]; ?>" alt="<?php echo $productTitle; ?> Image" class="lazy" />
							</div>
							<div class="product-info">
								<p class="product-title"><?php echo $productTitle; ?></p>

								<?php
									if ($postType == "libtech_surfboards" && get_field('libtech_product_price_us_5fin', $featuredProduct->ID) != "") {
										// display 5 fin pricing
										echo getPrice(
											get_field('libtech_product_price_us_5fin', $featuredProduct->ID),
											get_field('libtech_product_price_ca_5fin', $featuredProduct->ID),
											get_field('libtech_product_price_eur_5fin', $featuredProduct->ID),
											get_field('libtech_product_on_sale', $featuredProduct->ID),
											get_field('libtech_product_sale_percentage', $featuredProduct->ID),
											false
										);
									} else {
										// grab default price of all other products
										echo getPrice(
											get_field('libtech_product_price_us', $featuredProduct->ID),
											get_field('libtech_product_price_ca', $featuredProduct->ID),
											get_field('libtech_product_price_eur', $featuredProduct->ID),
											get_field('libtech_product_on_sale', $featuredProduct->ID),
											get_field('libtech_product_sale_percentage', $featuredProduct->ID),
											false
										);
									}
								?>
							</div>
						</a>
					</div>

					<?
							endforeach;
						else:
							// we don't have featured products, so lets figure out what to request
							$postType = getProductPostType();
							if(!$postType) :
								if($post->post_name == "storm-factory") {
									$postType = "libtech_outerwear";
								} else if($GLOBALS['sport'] == "ski") {
									$postType = "libtech_nas";
								} else if($GLOBALS['sport'] == "surf") {
									$postType = "libtech_surfboards";
								} else if($GLOBALS['sport'] == "skate") {
									$postType = "libtech_skateboards";
								} else {
									$postType = "libtech_snowboards";
								}
							endif;
							// add DIY slide if we're looking at snowboards
							if($postType == "libtech_snowboards") :
					?>

					<div class="product-item diy">
						<a href="<? echo $productLink; ?>">
							<div class="image-wrapper">
								<img src="<?php bloginfo('template_directory'); ?>/_/img/square.gif" data-src="<?php bloginfo('template_directory'); ?>/_/img/diy-board-builder-300x300.png" width="300" height="300" alt="DIY Snowboard Builder" class="lazy" />
							</div>
							<div class="product-info">
								<p class="product-title">Lib Tech DIY</p>
							</div>
						</a>
					</div>

					<?php
							endif;
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
								$productLink = get_permalink();
								// check for technology type to display
								$productType = "";
								if ($postType == "libtech_snowboards") {
									$productType = get_field('libtech_snowboard_contour');
								} else if ($postType == "libtech_nas") {
									$productType = "Magne-Traction";
								} else if ($postType == "libtech_skateboards") {
									// grab first skateboard category for display
									$categories = get_the_terms( $post->ID , 'libtech_skateboard_categories' );
									if($categories) {
										foreach ( $categories as $category ) {
											$productType = $category->name;
											break;
										}
									}
								}
					?>

					<div class="product-item <?php echo $postSlug; ?>">
						<a href="<? echo $productLink; ?>">
							<div class="image-wrapper">
								<img src="<?php bloginfo('template_directory'); ?>/_/img/square.gif" data-src="<?php echo $imageFile[0]; ?>" width="<?php echo $imageFile[1]; ?>" height="<?php echo $imageFile[2]; ?>" alt="<?php the_title(); ?> Image" class="lazy" />
							</div>
							<div class="product-info">
								<p class="product-title"><?php the_title(); ?></p>

								<?php
									if ($postType == "libtech_surfboards" && get_field('libtech_product_price_us', $post->ID) == "") {
										// display 5 fin pricing
										echo getPrice(
											get_field('libtech_product_price_us_5fin', $post->ID),
											get_field('libtech_product_price_ca_5fin', $post->ID),
											get_field('libtech_product_price_eur_5fin', $post->ID),
											get_field('libtech_product_on_sale', $post->ID),
											get_field('libtech_product_sale_percentage', $post->ID),
											false
										);
									} else {
										// grab default price of all other products
										echo getPrice(
											get_field('libtech_product_price_us', $post->ID),
											get_field('libtech_product_price_ca', $post->ID),
											get_field('libtech_product_price_eur', $post->ID),
											get_field('libtech_product_on_sale', $post->ID),
											get_field('libtech_product_sale_percentage', $post->ID),
											false
										);
									}
								?>

							</div>
						</a>
					</div>

					<?
							endwhile;
						endif;
						wp_reset_query();
					?>

				</div><!-- .product-list -->

				<?php if($featuredProducts == false && getProductPostType() == false): ?>

				<div class="call-to-action">
					<?php
						if($post->post_name == 'storm-factory') {
							echo '<a href="/outerwear/" class="view-all-link button">View all outerwear</a>';
						} else if($GLOBALS['sport'] == 'snow') {
							echo '<a href="/snowboards/" class="view-all-link button">View all boards</a>';
						} else if($GLOBALS['sport'] == 'surf') {
							echo '<a href="/surfboards/" class="view-all-link button">View all boards</a>';
						} else if($GLOBALS['sport'] == 'skate') {
							echo '<a href="/skateboards/#filter=.available" class="view-all-link button">View all boards</a>';
						} else if($GLOBALS['sport'] == 'ski') {
							echo '<a href="/skis/" class="view-all-link button">View all skis</a>';
						}
					?>
				</div><!-- .call-to-action -->

				<?php endif; ?>

			</div><!-- .section-content -->
		</section><!-- .product-slider -->
