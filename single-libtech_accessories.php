<?php
/*
Template Name: Accessories Detail
*/
	get_header();
	if (have_posts()) : while (have_posts()) : the_post();
		$thePostID = $post->ID;
		$slug = $post->post_name;
?>
		<div class="bg-product-<?php echo $GLOBALS['sport']; ?>-top"></div>
		<section class="product-slider product-details-nav bg-product-<?php echo $GLOBALS['sport']; ?>">
			<div class="section-content">
				<ul class="product-listing bxslider">
					<?php
						$postType = "libtech_accessories";
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
							$imageID = get_field('libtech_product_image');
							$imageFile = wp_get_attachment_image_src($imageID, 'square-medium');
					?>

					<li>
						<a href="<? the_permalink(); ?>">
							<img src="<?php bloginfo('template_directory'); ?>/_/img/square.gif" data-src="<?php echo $imageFile[0]; ?>" width="<?php echo $imageFile[1]; ?>" height="<?php echo $imageFile[2]; ?>" alt="<?php the_title(); ?> Image" class="lazy" />
							<div class="product-peek">
								<p class="product-title"><?php the_title(); ?></p>
							</div>
						</a>
					</li>

					<?
						endwhile;
						wp_reset_query();
					?>
				</ul>
			</div>
		</section><!-- END .product-slider -->
		<div class="product-details-nav-btn">
			<div class="toggle-btn"></div>
		</div>
        <div class="bg-product-details-top product-details-nav-bottom"></div>
        <div class="schema-wrapper" itemscope itemtype="http://schema.org/Product">
	        <section class="product-details bg-product-details <?php echo $slug; ?>">
	        	<div class="section-content">
					<h1 itemprop="name"><?php the_title(); ?></h1>
					<div class="product-images">
						<ul id="image-list">
							<?php
							$thumbnailImages = Array();
							if(get_field('libtech_accessories_images')):
								while(the_repeater_field('libtech_accessories_images')):
				       				$optionImage = get_sub_field('libtech_accessories_images_image');
									$optionImageThumb = wp_get_attachment_image_src($optionImage, 'thumbnail', false);
		       						$optionImageMedium = wp_get_attachment_image_src($optionImage, 'square-xlarge', false);
		       						$optionImageFull = wp_get_attachment_image_src($optionImage, 'full', false);
		       						$optionImageColor = get_sub_field('libtech_accessories_images_color');
		       						array_push($thumbnailImages, Array($optionImageThumb, $optionImageFull, $optionImageColor));
							?>
							<li><a href="<?php echo $optionImageFull[0]; ?>" title="<?php the_title(); ?> - <?php echo $optionImageColor; ?>"><img src="<?php echo $optionImageMedium[0]; ?>" alt="<?php the_title(); ?> - <?php echo $optionImageColor; ?>" width="<?php echo $optionImageMedium[1]; ?>" height="<?php echo $optionImageMedium[2]; ?>" itemprop="image" /></a></li>

							<?php
								endwhile;
							endif;
							?>
						</ul>
					</div><!-- END .product-images -->

					<div class="product-details-right">
						<!-- product array -->
						<script type='text/javascript'>
							<?php
								// create new product array
								$productArray = array();
								// grab availability
								$productAvailUS = "No";
								$productAvailCA = "No";
								$productAvailEU = "No";
								// loop through repeater
								if(get_field('libtech_accessories_variations')):
									while(the_repeater_field('libtech_accessories_variations')):
										$productSize = get_sub_field('libtech_accessories_variations_size');
										$productColor = get_sub_field('libtech_accessories_variations_color');
										$productSKU = get_sub_field('libtech_accessories_variations_sku');
										// grab availability overwrite
										$productAvailableUS = get_sub_field('libtech_accessories_variations_availability_us');
										$productAvailableCA = get_sub_field('libtech_accessories_variations_availability_ca');
										$productAvailableEU = get_sub_field('libtech_accessories_variations_availability_eur');
										// get values for availability
										$productAvailability = getAvailability($productSKU, $productAvailableUS, $productAvailableCA, $productAvailableEU);
										// eval if we should show product or not for each location
										if($productAvailability['us']['amount'] > 0 || $productAvailability['us']['amount'] == "Yes") $productAvailUS = "Yes";
										if($productAvailability['ca']['amount'] > 0 || $productAvailability['ca']['amount'] == "Yes") $productAvailCA = "Yes";
										if($productAvailability['eu']['amount'] > 0 || $productAvailability['eu']['amount'] == "Yes") $productAvailEU = "Yes";
										// setup product and add to array
										$product = array("size" => $productSize, "color" => $productColor, "sku" => $productSKU, "available" => $productAvailability);
										array_push($productArray, $product);
									endwhile;
								endif;
								// write array to dom
								$jsArray = json_encode($productArray);
								echo "var productArray = ". $jsArray . ";\n";
							?>
						</script>
						<h3><?php the_field('libtech_product_slogan'); ?></h3>
						<div class="image-list-thumbs <?php if(count($thumbnailImages) < 2){ echo 'hidden'; }?>">
							<ul id="image-list-thumbs">
								<?php
								if($thumbnailImages):
									$i = 0;
									foreach ($thumbnailImages as $thumbnail) {
										$imageAlt = "";
										if(get_the_title() == $thumbnail[2] || $thumbnail[2] == "N/A") {
											$imageAlt = get_the_title();
										} else {
											$imageAlt = get_the_title() . " - " . $thumbnail[2];
										}
								?>

								<li><a href="<?php echo $thumbnail[1][0]; ?>" title="<?php the_title(); ?> - <?php echo $thumbnail[2]; ?>" data-color="<?php echo $thumbnail[2]; ?>" data-slide-index="<?php echo $i; ?>"><img src="<?php echo $thumbnail[0][0]; ?>" alt="<?php echo $imageAlt; ?>" width="<?php echo $thumbnail[0][1]; ?>" height="<?php echo $thumbnail[0][2]; ?>" /></a></li>

								<?php $i ++; }; endif; ?>
							</ul>
						</div>
						<div class="product-price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
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
							<link itemprop="itemCondition" href="http://schema.org/NewCondition" />
							<p class="price-alert">Free shipping!</p>
						</div>
						<div class="product-variations">
							<select id="product-variation-size" class="select<?php if(count($productArray) == 1){echo ' hidden';} ?>">
								<option value="-1">Select Size</option>
								<?php
								$sizeArray = array();
								foreach ($productArray as $product) :
									$productSize = $product['size'];
									if(!in_array($productSize, $sizeArray)):
								?>
								<option value="<?php echo $productSize; ?>" title="<?php echo $productSize; ?>" <?php if(count($productArray) == 1){echo 'selected="selected"';} ?>><?php echo $productSize; ?></option>
								<?php
									endif;
									// add product to size array
									array_push($sizeArray, $productSize);
								endforeach;
								?>
							</select>
							<select id="product-variation-color" class="select<?php if(count($productArray) == 1){echo ' hidden';} ?>">
								<option value="-1">Select Color</option>
								<?php
								$colorArray = array();
								foreach ($productArray as $product) :
									$productColor = $product['color'];
									if(!in_array($productColor, $colorArray)):
								?>
								<option value="<?php echo $productColor; ?>" title="<?php echo $productColor; ?>" <?php if(count($productArray) == 1){echo 'selected="selected"';} ?>><?php echo $productColor; ?></option>
								<?php
									endif;
									// add product to color array
									array_push($colorArray, $productColor);
								endforeach;
								?>
							</select>
						</div>
						<div class="product-alert">
							<p class="low-inventory"><span>Product Alert:</span> Currently less than 10 available.</p>
							<p class="no-inventory"><span>Product Alert:</span> We are currently out of stock on this item. Our dealer network may be able to fulfill this order.</p>
						</div><!-- .available-alert -->
						<div class="product-buy" data-avail-us="<?php echo $productAvailUS; ?>" data-avail-ca="<?php echo $productAvailCA; ?>" data-avail-eur="<?php echo $productAvailEU; ?>">
							<ul>
								<li class="loading hidden"></li>
								<li class="cart-button"><a href="#add-to-cart" class="add-to-cart h3">Add to Cart</a> <img src="<?php bloginfo('template_directory'); ?>/_/img/shopatron-secure-logo.png" alt="Shopatron Secure" /></li>
								<li class="unavailable">Item is currently not available online.</li>
								<li class="find-dealer h4"><a href="/dealer-locator/">Find a Dealer</a></li>
							</ul>
							<div class="cart-success hidden"><p>The item has been added to your cart.</p><p><a href="/shopping-cart/" class="cart-link">View your shopping cart</a></p></div>
							<div class="cart-failure hidden"><p>There has been an error adding the item to your cart.</p><p>Try again later or <a href="/contact/">contact us</a> if the problem persists.</p></div>
						</div>
						<ul class="product-quick-specs">
							<?php
							$sizeArray = array();
							$sizeDisplayArray = array();
							foreach ($productArray as $product) :
								$productSize = $product['size'];
								if(!in_array($productSize, $sizeArray)):
									array_push($sizeDisplayArray, $productSize);
								endif;
								// add product to size array
								array_push($sizeArray, $productSize);
							endforeach;
							// setup sizes text display
							$sizes = "";
							for ($i = 0; $i < count($sizeDisplayArray); $i++) {
								$sizes .= $sizeDisplayArray[$i];
								if($i < count($sizeDisplayArray)-1){
									$sizes .= ", ";
								}
							}
							?>
							<li><span>Sizes</span> <?php echo $sizes; ?></li>
						</ul>
						<div class="product-description" itemprop="description">
							<?php the_content(); ?>
						</div>
						<ul class="product-share">
							<li><div class="fb-like" data-href="<? the_permalink(); ?>" data-layout="button_count" data-width="120" data-show-faces="false" data-colorscheme="dark" data-font="trebuchet ms"></div></li>
							<li><a href="https://twitter.com/share" class="twitter-share-button" data-via="libtechnologies">Tweet</a></li>
							<li><div class="g-plusone" data-size="medium" data-href="<? the_permalink(); ?>"></div></li>
							<li><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $GLOBALS['pageImage']; ?>&description=<?php echo $GLOBALS['pageTitle']; ?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></li>
						</ul>
					</div><!-- END .product-details-right -->
					<div class="clearfix"></div>
				</div><!-- END .section-content -->
			</section>
			<section class="product-zoom bg-product-details">
	        	<div class="section-content">
	        		<div class="zoom-title"></div>
	        		<div class="zoom-image">
	        			<img src="" />
	        		</div>
	        		<div class="zoom-controls">
	        			<a href="#close-zoom" class="zoom-close h3">Close</a>
	        			<ul id="zoom-thumbnails"></ul>
	        		</div>
	        	</div><!-- END .section-content -->
	        </section><!-- END .product-zoom -->
	    </div><!-- .schema-wrapper -->

		<?php
			// display video if we have an id
			$videoID = get_field('libtech_product_video');
			if( $videoID ):
		?>
		<div class="bg3-top product-video-top"></div>
        <section class="bg3 product-video">
        	<div class="section-content">
				<div class="video-player">
					<iframe src="http://player.vimeo.com/video/<?php echo $videoID; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=fff100&amp;loop=1" width="940" height="528" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
				</div>
			</div>
		</section>
		<?php
			endif;
		?>

		<div class="discussion-top bg1-top"></div>
		<section class="discussion bg1">
			<div class="section-content">
				<div class="discussion-thread">
					<?php comments_template(); ?>
				</div>
			</div>
		</section>

		<?php
			// display the related products
			getRelatedProducts();
		?>
<?php
		endwhile;
	endif;
	get_footer();
?>
