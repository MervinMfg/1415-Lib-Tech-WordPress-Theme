<?php if ( basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) ) header('Location: /'); // do not allow stanalone viewing ?>

	<section class="product-grid container-fluid  bg-texture-gradient">
		<div class="section-content row">

			<?php
				// set up product grid via method
				function buildProductGrid($name) {
					$gridTall = 'libtech_grid_tall_' . $name;
					$gridShort = 'libtech_grid_short_' . $name;
					// output start of grid
					echo '<div class="grid-wrapper col-xs-12 col-ms-10 col-ms-offset-1 col-sm-6 col-sm-offset-0">';
					// get tall grid item (product)
					$post_objects = get_field($gridTall);
					if( $post_objects ):
							// begin grid left item
							echo '<div class="grid-left col-xs-6 col-sm-6">';
							// get each product
							foreach( $post_objects as $post_object):
								$imageID = get_field( 'libtech_product_image', $post_object->ID );
								$productImage = wp_get_attachment_image_src( $imageID, 'square-large' );
								$productLink = get_permalink( $post_object->ID );
								$productTitle = get_the_title( $post_object->ID );
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
								if ($postType == "libtech_surfboards" && get_field('libtech_product_price_us', $post_object->ID) == "") {
									// display 5 fin pricing
									$productPrice = getPrice(
										get_field('libtech_product_price_us_5fin', $post_object->ID),
										get_field('libtech_product_price_ca_5fin', $post_object->ID),
										get_field('libtech_product_price_eur_5fin', $post_object->ID),
										get_field('libtech_product_on_sale', $post_object->ID),
										get_field('libtech_product_sale_percentage', $post_object->ID),
										false
									);
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
								// render out tall product
								?>

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

								<?php
								break; // make sure we limit to 1 product
							endforeach;
							// close out grid left wrapper
							echo '</div><!-- END .grid-left -->';
					endif;
					// get short grid items (products)
					$post_objects = get_field($gridShort);
					if( $post_objects ):
							// begin grid left item
							echo '<div class="grid-right col-xs-6 col-sm-6">';
							// get each product
							foreach( $post_objects as $post_object):
								$imageID = get_field( 'libtech_product_image', $post_object->ID );
								$productImage = wp_get_attachment_image_src( $imageID, 'square-large' );
								$productLink = get_permalink( $post_object->ID );
								$productTitle = get_the_title( $post_object->ID );
								$postType = $post_object->post_type;
								// set post category
								switch ($postType) {
									case "libtech_apparel":
										$postCat = "apparel";
										$postCatLink = "/apparel/";
										break;
									case "libtech_outerwear":
										$postCat = "outerwear";
										$postCatLink = "/outerwear/";
										break;
									case "libtech_accessories":
										$postCat = "accessories";
										$postCatLink = "/accessories/";
										break;
								}
								// get product price
								$productPrice = getPrice(
									get_field('libtech_product_price_us', $post_object->ID),
									get_field('libtech_product_price_ca', $post_object->ID),
									get_field('libtech_product_price_eur', $post_object->ID),
									get_field('libtech_product_on_sale', $post_object->ID),
									get_field('libtech_product_sale_percentage', $post_object->ID),
									false
								);
								// render out short products
								?>

								<div class="grid-item">
									<div class="grid-item-wrapper <?php echo $postCat; ?>">
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

								<?php
							endforeach;
							// close out grid right wrapper
							echo '</div><!-- END .grid-right -->';
					endif;
					// end product grid output
					echo '</div><!-- END .grid-wrapper -->';
				}
				// build grids
				buildProductGrid('first');
				buildProductGrid('second');
			?>

		</div><!-- .section-content -->
	</section><!-- END .product-grid -->
