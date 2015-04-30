<?php
/*
Template Name: Luggage Detail
*/
	get_header();
	if (have_posts()) : while (have_posts()) : the_post();
		$thePostID = $post->ID;
		$slug = $post->post_name;
?>

		<?php include get_template_directory() . '/_/inc/modules/product-slider.php'; ?>

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
							if(get_field('libtech_luggage_images')):
								$imageNum = 0;
								while(the_repeater_field('libtech_luggage_images')):
									$optionImage = get_sub_field('libtech_luggage_images_image');
									$optionImageThumb = wp_get_attachment_image_src($optionImage, 'thumbnail', false);
									$optionImageMedium = wp_get_attachment_image_src($optionImage, 'square-xlarge', false);
									$optionImageFull = wp_get_attachment_image_src($optionImage, 'full', false);
									$optionImageColor = get_sub_field('libtech_luggage_images_color');
									$optionSKU = 0;
									if(get_field('libtech_luggage_variations')):
										while(the_repeater_field('libtech_luggage_variations')):
											$optionColor = get_sub_field('libtech_luggage_variations_color');
											if($optionImageColor == $optionColor) {
												$optionSKU = get_sub_field('libtech_luggage_variations_sku');
												break;
											}
										endwhile;
									endif;
									array_push($thumbnailImages, Array($optionImageThumb, $optionImageFull, $optionImageColor, $optionSKU));
							?>

							<li><a href="<?php echo $optionImageFull[0]; ?>" title="<?php the_title(); ?> - <?php echo $optionImageColor; ?>"><img src="<?php echo $optionImageMedium[0]; ?>" alt="<?php the_title(); ?> - <?php echo $optionImageColor; ?>" width="<?php echo $optionImageMedium[1]; ?>" height="<?php echo $optionImageMedium[2]; ?>"<?php if($imageNum == 0) echo "itemprop='image'"; ?> /></a></li>

							<?php
									$imageNum++;
								endwhile;
							endif;
							?>
						</ul>
					</div><!-- .product-images -->
					<div class="product-details-right">
						<h3><?php the_field('libtech_product_slogan'); ?></h3>
						<div class="image-list-thumbs <?php if(count($thumbnailImages) < 2){ echo 'hidden'; }?>">
							<ul id="image-list-thumbs">
								<?php if($thumbnailImages): $i = 0; foreach ($thumbnailImages as $thumbnail) { ?>

								<li><a href="<?php echo $thumbnail[1][0]; ?>" title="<?php the_title(); ?> - <?php echo $thumbnail[2]; ?>" data-sku="<?php echo $thumbnail[3]; ?>" data-slide-index="<?php echo $i; ?>"><img src="<?php echo $thumbnail[0][0]; ?>" alt="<?php the_title(); ?> - <?php echo $thumbnail[2]; ?>" width="<?php echo $thumbnail[0][1]; ?>" height="<?php echo $thumbnail[0][2]; ?>" /></a></li>

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
							<p class="price-alert usd cad">Free shipping over $75</p>
							<p class="price-alert eur">Free shipping over €75</p>
						</div><!-- .product-price -->

						<?php
							$productArray = Array();
							// grab availability
							$productAvailUS = "No";
							$productAvailCA = "No";
							$productAvailEU = "No";
							// loop through variations
							if(get_field('libtech_luggage_variations')):
								while(the_repeater_field('libtech_luggage_variations')):
									$optionColor = get_sub_field('libtech_luggage_variations_color');
									$optionSKU = get_sub_field('libtech_luggage_variations_sku');
									// grab availability overwrite
									$productAvailableUS = get_sub_field('libtech_luggage_variations_availability_us');
									$productAvailableCA = get_sub_field('libtech_luggage_variations_availability_ca');
									$productAvailableEU = get_sub_field('libtech_luggage_variations_availability_eur');
									// get values for availability
									$productAvailability = getAvailability($optionSKU, $productAvailableUS, $productAvailableCA, $productAvailableEU);
									// eval if we should show product or not for each location
									if($productAvailability['us']['amount'] > 0 || $productAvailability['us']['amount'] == "Yes") $productAvailUS = "Yes";
									if($productAvailability['ca']['amount'] > 0 || $productAvailability['ca']['amount'] == "Yes") $productAvailCA = "Yes";
									if($productAvailability['eu']['amount'] > 0 || $productAvailability['eu']['amount'] == "Yes") $productAvailEU = "Yes";
									array_push($productArray, Array('color' => $optionColor, 'sku' => $optionSKU, 'available' => $productAvailability));
								endwhile;
							endif;
						?>
						<div class="product-variations">
							<select id="product-variation" class="select<?php if(count($productArray) == 1){echo ' hidden';} ?>">
								<option value="-1">Select a Color</option>
								<?php foreach ($productArray as $product) : // render out variation dropdown ?>
								<option value="<?php echo $product['sku']; ?>" title="<?php echo $product['color']; ?>" data-avail-us="<?php echo $product['available']['us']['amount']; ?>" data-avail-ca="<?php echo $product['available']['ca']['amount']; ?>" data-avail-eur="<?php echo $product['available']['eu']['amount']; ?>" <?php if(count($productArray) == 1) echo ' selected="selected"'; ?>><?php echo $product['color']; ?></option>
								<?php endforeach; ?>
							</select>
						</div><!-- .product-variations -->
						<div class="product-alert">
							<p class="low-inventory"><span>Product Alert:</span> Currently less than 10 available.</p>
							<p class="no-inventory"><span>Product Alert:</span> We are currently out of stock on this item. Our dealer network may be able to fulfill this order.</p>
						</div><!-- .product-alert -->
						<div class="product-buy" data-avail-us="<?php echo $productAvailUS; ?>" data-avail-ca="<?php echo $productAvailCA; ?>" data-avail-eur="<?php echo $productAvailEU; ?>">
							<ul>
								<li class="loading hidden"></li>
								<li class="cart-button"><a href="#add-to-cart" class="add-to-cart h3">Add to Cart</a> <img src="<?php bloginfo('template_directory'); ?>/_/img/shopatron-secure-logo.png" alt="Shopatron Secure" /></li>
								<li class="unavailable">Item is currently not available online.</li>
								<li class="find-dealer h4"><a href="/dealer-locator/">Find a Dealer</a></li>
							</ul>
							<div class="cart-success hidden"><p>The item has been added to your cart.</p><p><a href="/shopping-cart/" class="cart-link">View your shopping cart</a></p></div>
							<div class="cart-failure hidden"><p>There has been an error adding the item to your cart.</p><p>Try again later or <a href="/contact/">contact us</a> if the problem persists.</p></div>
						</div><!-- .product-buy -->
						<?php if(get_field('libtech_luggage_volume') != ""): ?>
						<ul class="product-quick-specs">
							<li><span>Volume</span> <?php the_field('libtech_luggage_volume'); ?> L</li>
						</ul>
						<?php endif; ?>
						<div class="product-description" itemprop="description">
							<?php the_content(); ?>
						</div>
						<ul class="product-share">
							<li><div class="fb-like" data-href="<? the_permalink(); ?>" data-layout="button_count" data-width="120" data-show-faces="false" data-colorscheme="dark" data-font="trebuchet ms"></div></li>
							<li><a href="https://twitter.com/share" class="twitter-share-button" data-via="libtechnologies">Tweet</a></li>
							<li><div class="g-plusone" data-size="medium" data-href="<? the_permalink(); ?>"></div></li>
							<li><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $GLOBALS['pageImage']; ?>&description=<?php echo $GLOBALS['pageTitle']; ?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></li>
						</ul>
					</div><!-- .product-details-right -->
					<div class="clearfix"></div>
				</div><!-- .section-content -->
			</section><!-- .product-details -->
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
      	</div><!-- .section-content -->
      </section><!-- .product-zoom -->
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
			</div><!-- END .section-content -->
		</section><!-- END .product-video -->

		<?php
			endif;
			// display disqus comments
			libtech_comments_template();
			// display the related products
			getRelatedProducts();
		?>

<?php
		endwhile;
	endif;
	get_footer();
?>
