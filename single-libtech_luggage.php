<?php
/*
Template Name: Luggage Detail
*/
	get_header();
	if (have_posts()) : while (have_posts()) : the_post();
		$thePostID = $post->ID;
		$slug = $post->post_name;
?>
		<div class="bg-product-<?php echo $GLOBALS['sport']; ?>-top"></div>
		<section class="product-slider product-nav bg-product-<?php echo $GLOBALS['sport']; ?>">
			<div class="section-content">
				<ul class="product-listing bxslider">
					<?php
						$postType = "libtech_luggage";
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
							<img src="<?php echo $imageFile[0]; ?>" width="<?php echo $imageFile[1]; ?>" height="<?php echo $imageFile[2]; ?>" alt="<?php the_title(); ?> Image" />
							<div class="product-peek">
								<p class="product-title"><?php the_title(); ?></p>
								<p class="product-type"><?php echo $productType; ?></p>
							</div>
						</a>
					</li>

					<?
						endwhile;
						wp_reset_query();
					?>
				</ul>
			</div>
		<div class="product-nav-btn"></div>
		</section><!-- END .product-slider -->
        <div class="bg-product-details-top product-nav-bottom"></div>
        <section class="product-details bg-product-details <?php echo $slug; ?>">
        	<div class="section-content">
				<h1><?php the_title(); ?></h1>
				<div class="product-images">
					<ul id="image-list">
						<?php
						$thumbnailImages = Array();
						if(get_field('libtech_luggage_images')):
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
						<li><a href="<?php echo $optionImageFull[0]; ?>" title="<?php the_title(); ?> - <?php echo $optionImageColor; ?>"><img src="<?php echo $optionImageMedium[0]; ?>" alt="<?php the_title(); ?> - <?php echo $optionImageColor; ?>" width="<?php echo $optionImageMedium[1]; ?>" height="<?php echo $optionImageMedium[2]; ?>" /></a></li>
						
						<?php
							endwhile;
						endif;
						?>
					</ul>
				</div><!-- END .product-images -->

				<div class="product-details-right">
					<h3><?php the_field('libtech_product_slogan'); ?></h3>
					<div class="image-list-thumbs <?php if(count($thumbnailImages) < 2){ echo 'hidden'; }?>">
						<ul id="image-list-thumbs">
							<?php if($thumbnailImages): $i = 0; foreach ($thumbnailImages as $thumbnail) { ?>

							<li><a href="<?php echo $thumbnail[1][0]; ?>" title="<?php the_title(); ?> - <?php echo $thumbnail[2]; ?>" data-sku="<?php echo $thumbnail[3]; ?>" data-slide-index="<?php echo $i; ?>"><img src="<?php echo $thumbnail[0][0]; ?>" alt="<?php the_title(); ?> - <?php echo $thumbnail[2]; ?>" width="<?php echo $thumbnail[0][1]; ?>" height="<?php echo $thumbnail[0][2]; ?>" /></a></li>
							
							<?php $i ++; }; endif; ?>
						</ul>
					</div>
					<div class="product-price">
						<?php echo getPrice( get_field('libtech_product_price_us'), get_field('libtech_product_price_ca'), get_field('libtech_product_price_eur'), get_field('libtech_product_on_sale'), get_field('libtech_product_sale_percentage') ); ?>
					</div>

					<?php
						$productArray = Array();
						$isProductAvailable = "No";
						if(get_field('libtech_luggage_variations')):
							while(the_repeater_field('libtech_luggage_variations')):
								$optionColor = get_sub_field('libtech_luggage_variations_color');
								$optionSKU = get_sub_field('libtech_luggage_variations_sku');
								if($GLOBALS['currency'] == "CAD"){
									$optionAvailable = get_sub_field('libtech_luggage_variations_availability_ca');
								} else if($GLOBALS['currency'] == "EUR"){
									$optionAvailable = get_sub_field('libtech_luggage_variations_availability_eur');
								} else {
									$optionAvailable = get_sub_field('libtech_luggage_variations_availability_us');
								}
								// set overall availability
								if($optionAvailable == "Yes"){
									$isProductAvailable = "Yes";
								}
								array_push($productArray, Array($optionColor, $optionSKU, $optionAvailable));
							endwhile;
						endif;
					?>
					<div class="product-variations <?php if($isProductAvailable == "No" || count($productArray) < 2){echo 'hidden';} ?>">
						<select id="product-variation" class="select">
							<option value="-1">Select a Color</option>
							<?php
								// sort by variation length
								//asort($productArray);
								// render out variation dropdown
								foreach ($productArray as $product) {
							?>
							<option value="<?php echo $product[1]; ?>" title="<?php echo $product[0]; ?>"<?php if($product[2] == "No") echo ' disabled="disabled"'; if(count($productArray) < 2) echo ' selected="selected"'; ?>><?php echo $product[0]; ?></option>
							<?php
								}
							?>
						</select>
					</div>
					<p class="holiday-delivery">Free shipping!</p>
					<div class="product-buy">
						<ul>
							<?php if($isProductAvailable == "Yes"): ?>
							<li class="loading hidden"></li>
							<li class="cart-button"><a href="#add-to-cart" class="add-to-cart h3">Add to Cart</a> <img src="<?php bloginfo('template_directory'); ?>/_/img/shopatron-secure-logo.png" alt="Shopatron Secure" /></li>
							<?php else: ?>
							<li>Item is currently not available online.</li>
							<?php endif; ?>
							<li class="find-dealer h4"><a href="/store-locator/">Find a Dealer</a></li>
						</ul>
						<div class="cart-success hidden"><p>The item has been added to your cart.</p><p><a href="/shopping-cart/" class="cart-link">View your shopping cart</a></p></div>
						<div class="cart-failure hidden"><p>There has been an error adding the item to your cart.</p><p>Try again later or <a href="/contact/">contact us</a> if the problem persists.</p></div>
					</div>
					<?php if(get_field('libtech_luggage_volume') != ""): ?>
					<ul class="product-quick-specs">
						<li><span>Volume</span> <?php the_field('libtech_luggage_volume'); ?> L</li>
					</ul>
					<?php endif; ?>
					<div class="product-description">
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
		</section><!-- END .product-details -->
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

		<?php
			// display video if we have an id
			$videoID = get_field('libtech_product_video');
			if( $videoID ):
		?>
		<div class="bg3-top product-video-top"></div>
        <section class="bg3 product-video">
        	<div class="section-content">
				<h2><span>Video</span></h2>
				<div class="video-player">
					<iframe src="http://player.vimeo.com/video/<?php echo $videoID; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=fff100&amp;loop=1" width="940" height="528" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
				</div>
				<div class="video-copy">
					<p class="quote h3"><?php the_field('libtech_product_video_quote'); ?></p>
					<p class="quote-attribution h4">- <?php the_field('libtech_product_video_quote_attribution'); ?></p>
				</div>
				<div class="clearfix"></div>
			</div><!-- END .section-content -->
		</section><!-- END .product-video -->
		<?php
			endif;
		?>

		<?php
			comments_template();
			// display the related products
			getRelatedProducts();
		?>
<?php
		endwhile;
	endif;
	get_footer();
?>