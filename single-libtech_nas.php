<?php
/*
Template Name: NAS Detail
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
		<div class="schema-wrapper" itemscope itemtype="http://schema.org/Product">
			<section class="product-details <?php echo $slug; ?> container-fluid">
				<div class="section-content row">
					<div class="product-images col-xs-12">
						<ul id="image-list">
							<?php
								$productArray = Array();
								// grab availability
								$productAvailUS = "No";
								$productAvailCA = "No";
								$productAvailEU = "No";
								// loop through variations
								if(get_field('libtech_nas_variations')):
									$imageNum = 0;
									while(the_repeater_field('libtech_nas_variations')):
										$variationLength = get_sub_field('libtech_nas_variations_length');
										$variationSKU = get_sub_field('libtech_nas_variations_sku');
										// grab availability overwrite
										$productAvailableUS = get_sub_field('libtech_nas_variations_availability_us');
										$productAvailableCA = get_sub_field('libtech_nas_variations_availability_ca');
										$productAvailableEU = get_sub_field('libtech_nas_variations_availability_eur');
										// get values for availability
										$productAvailability = getAvailability($variationSKU, $productAvailableUS, $productAvailableCA, $productAvailableEU);
										// eval if we should show product or not for each location
										if($productAvailability['us']['amount'] > 0 || $productAvailability['us']['amount'] == "Yes") $productAvailUS = "Yes";
										if($productAvailability['ca']['amount'] > 0 || $productAvailability['ca']['amount'] == "Yes") $productAvailCA = "Yes";
										if($productAvailability['eu']['amount'] > 0 || $productAvailability['eu']['amount'] == "Yes") $productAvailEU = "Yes";
										array_push($productArray, Array('length' => $variationLength, 'sku' => $variationSKU, 'available' => $productAvailability));
									endwhile;
								endif;
								// set up sku list
								$productSkus = "";
								for ($i = 0; $i < count($productArray); $i++) {
									$productSkus .= $productArray[$i]['sku'];
									if($i < count($productArray)-1){
										$productSkus .= ", ";
									}
								}
								// build array of sizes
								$variationSizes = Array();
								if(get_field('libtech_nas_variations')):
									while(the_repeater_field('libtech_nas_variations')):
										$variationLength = get_sub_field('libtech_nas_variations_length');
										// add size to array
										array_push($variationSizes, $variationLength);
									endwhile;
								endif;
								// sort sizes
								array_multisort($variationSizes, SORT_ASC);
								// setup sizes text display
								$sizes = "";
								for ($i = 0; $i < count($variationSizes); $i++) {
									$sizes .= $variationSizes[$i];
									if($i < count($variationSizes)-1){
										$sizes .= ", ";
									}
								}
								// get product images
								$productImages = Array();
								if(get_field('libtech_nas_images')):
									while(the_repeater_field('libtech_nas_images')):
										$productImage = get_sub_field('libtech_nas_images_img');
										array_push($productImages, $productImage);
							?>

							<li class="nas-image"><a href="<?php echo $productImage['url']; ?>" title="<?php the_title(); ?>"><img src="<?php echo $productImage['url']; ?>" alt="<?php the_title(); ?>" width="<?php echo $productImage['width']; ?>" height="<?php echo $productImage['height']; ?>"<?php if($imageNum == 0) echo 'itemprop="image"'; ?> /></a></li>

							<?php
										$imageNum++;
									endwhile;
								endif;
				      ?>
						</ul>
					</div><!-- .product-images -->
					<div class="details-left col-xs-12 col-ms-10 col-ms-offset-1 col-sm-7 col-sm-offset-0">
						<h1 itemprop="name"><?php the_title(); ?></h1>
						<h3 class="nas-tech">With Magne-traction</h3>
						<h3><?php the_field('libtech_product_slogan'); ?></h3>
						<div class="image-list-thumbs hidden">
							<ul id="image-list-thumbs">
								<li><a href="<?php echo $productImageFull[0]; ?>" title="<?php the_title(); ?>" data-sku="<?php echo $productSkus; ?>" data-slide-index="<?php echo $i; ?>"><img src="<?php echo $productImageThumb[0]; ?>" alt="<?php the_title(); ?>" data-sub-alt="Sizes: <?php echo $sizes; ?>" width="<?php echo $productImageThumb[1]; ?>" height="<?php echo $productImageThumb[2]; ?>" /></a></li>
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
						<div class="product-variations">
							<select id="product-variation" class="select<?php if(count($productArray) == 1){echo ' hidden';} ?>">
								<option value="-1">Select a Size</option>
								<?php asort($productArray); foreach ($productArray as $product) : // sort by variation name and render out product dropdown ?>
								<option value="<?php echo $product['sku']; ?>" title="<?php echo $product['length']; ?>" data-avail-us="<?php echo $product['available']['us']['amount']; ?>" data-avail-ca="<?php echo $product['available']['ca']['amount']; ?>" data-avail-eur="<?php echo $product['available']['eu']['amount']; ?>" <?php if(count($productArray) == 1) echo ' selected="selected"'; ?>><?php echo $product['length']; ?></option>
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
								<li class="cart-button"><a href="#add-to-cart" class="add-to-cart button">Add to Cart</a> <img src="<?php bloginfo('template_directory'); ?>/_/img/shopatron-secure-logo.png" alt="Shopatron Secure" /></li>
								<li class="unavailable">Item is currently not available online.</li>
								<li class="find-dealer h4"><a href="/dealer-locator/?product=skis">Find a Dealer</a></li>
							</ul>
							<div class="cart-success hidden"><p>The item has been added to your cart.</p><p><a href="/shopping-cart/" class="cart-link">View your shopping cart</a></p></div>
							<div class="cart-failure hidden"><p>There has been an error adding the item to your cart.</p><p>Try again later or <a href="/contact/">contact us</a> if the problem persists.</p></div>
						</div>
					</div><!-- .details-left -->
					<div class="details-right col-xs-12 col-ms-10 col-ms-offset-1 col-sm-5 col-sm-offset-0">
						<ul class="product-quick-specs">
							<li><span>Shape</span> <?php the_field('libtech_nas_shape'); ?></li>
							<li><span>Contour</span> <?php the_field('libtech_nas_contour'); ?></li>
							<li><span>Sizes:</span> <?php echo $sizes; ?></li>
							<li><a href="#" class="view-tech-link">View our technology <span class="view-arrow"></span></a></li>
						</ul>
						<div class="share-wrapper row">
							<ul class="product-share col-sm-12 col-md-6">
								<li class="col-sm-6 col-md-3"><div class="fb-like" data-href="<? the_permalink(); ?>" data-layout="button_count" data-width="120" data-show-faces="false" data-colorscheme="dark" data-font="trebuchet ms"></div></li>
								<li class="col-sm-6 col-md-3"><a href="https://twitter.com/share" class="twitter-share-button" data-via="libtechnologies">Tweet</a></li>
							</ul>
							<ul class="product-share col-sm-12 col-md-6">
								<li class="col-sm-6 col-md-3"><div class="g-plusone" data-size="medium" data-href="<? the_permalink(); ?>"></div></li>
								<li class="col-sm-6 col-md-3"><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $GLOBALS['pageImage']; ?>&description=<?php echo $GLOBALS['pageTitle']; ?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></li>
							</ul>
							<div class="clearfix"></div>
						</div>
					</div><!-- .nas-details-right -->
					<div class="clearfix"></div>
				</div><!-- .section-content -->
			</section>
			<section class="product-zoom">
				<div class="section-content">
					<div class="zoom-title"></div>
					<div class="zoom-image">
						<img src="" />
					</div>
					<div class="zoom-controls">
						<a href="#close-zoom" class="zoom-close button">Close</a>
						<ul id="zoom-thumbnails"></ul>
					</div>
				</div><!-- .section-content -->
			</section><!-- .product-zoom -->
      <section class="product-extras info container-fluid">
      	<div class="section-content clearfix row">
      		<div class="product-desc-awards-specs col-xs-12 col-ms-10 col-ms-offset-1 col-sm-5">
	    			<div class="product-desc-awards">
	        		<div class="product-description" itemprop="description">
	        			<?php the_content(); ?>
	        		</div>

	        		<?php // display awards if there are any
							$awards = get_field('libtech_product_awards');
							if( $awards ):
							?>

		        	<div class="product-awards col-xs-12">
								<h2>Awards</h2>
								<ul>

								<?php
									foreach( $awards as $award):
										$imageID = get_field('libtech_award_image', $award->ID);
										$imageFile = wp_get_attachment_image_src($imageID, 'full');
										echo '<li><img src="'.$imageFile[0].'" width="'.$imageFile[1].'" height="'.$imageFile[2].'" alt="' . get_the_title($award->ID) . '" /><div class="tool-tip">' . get_the_title($award->ID) . '</div></li>';
									endforeach;
								?>

								</ul>
							</div>

							<? endif; // end awards ?>

						</div><!-- END .product-desc-awards -->
						<div class="product-specs col-xs-12">
							<h2>Specifications</h2>
							<table>
								<thead>
									<tr>
										<th>Model<br />Name</th>
										<th>Contact<br />Length</th>
										<th>Side<br />Cut</th>
										<th>Nose<br />Width</th>
										<th>Waist<br />Width</th>
										<th>Tail<br />Width</th>
										<th>Flex<br /><span>10 = Firm</span></th>
										<th>Weight<br /><span>(lbs)</span></th>
									</tr>
								</thead>
								<tbody>
									<?php
										if(get_field('libtech_nas_specs')):
											while(the_repeater_field('libtech_nas_specs')):
									?>

									<tr>
										<td><?php the_sub_field('libtech_nas_specs_length'); ?></td>
										<td><?php the_sub_field('libtech_nas_specs_contact_length'); ?></td>
										<td><?php the_sub_field('libtech_nas_specs_side_cut'); ?></td>
										<td><?php the_sub_field('libtech_nas_specs_nose_width'); ?></td>
										<td><?php the_sub_field('libtech_nas_specs_waist_width'); ?></td>
										<td><?php the_sub_field('libtech_nas_specs_tail_width'); ?></td>
										<td><?php the_sub_field('libtech_nas_specs_flex_rating'); ?></td>
										<td><?php the_sub_field('libtech_nas_specs_weight'); ?></td>
									</tr>

									<?php
											endwhile;
										endif;
									?>
								</tbody>
								<tfoot>
									<tr>
										<td colspan="2"><a href="/skiing/specifications/" class="view-all-specs">View all specs</a></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
								</tfoot>
							</table>
						</div>
					</div><!-- .product-desc-awards-specs -->

					<?php // grab technology if there is any
					$technology = get_field('libtech_product_technology');
					if( $technology ):
						$i = 1;
						$technologyMajor = Array();
						$technologyMinor = Array();
						foreach( $technology as $techItem):
							$title = get_the_title($techItem->ID);
							$content = apply_filters('the_content', $techItem->post_content);
							$techType = get_field("libtech_technology_type", $techItem->ID);
							$videoID = get_field("libtech_technology_video", $techItem->ID);
							$imageID = get_field("libtech_technology_icon", $techItem->ID);
							$imageFile = wp_get_attachment_image_src($imageID, 'full');
							if ($techType == "Major") {
								array_push($technologyMajor, Array($title, $content, $videoID));
							} else {
								array_push($technologyMinor, Array($title, $content, $imageFile));
							}
						endforeach;
						// CHECK IF WE SHOULD DISPLAY MAJOR TECHNOLOGY
						if (count($technologyMajor) > 0) :
					?>

        	<div class="product-tech-major tech-major col-xs-12 col-ms-10 col-ms-offset-1 col-sm-7">
						<h2>Technology</h2>
						<ul class="tech-video-list">
							<?php foreach( $technologyMajor as $techItem): ?>

							<li class="tech-video-item row">
								<div class="tech-video col-xs-12">
									<iframe src="http://player.vimeo.com/video/<?php echo $techItem[2]; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=fff100" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
								</div>
								<div class="tech-copy col-xs-12">
									<h4><?php echo $techItem[0]; ?></h4>
									<?php echo $techItem[1]; ?>
								</div>
								<div class="clearfix"></div>
							</li>

							<?php endforeach; ?>
						</ul>
					</div><!-- END .product-tech-major -->

					<?
						endif; // end tech major check
						// CHECK IF WE SHOULD DISPLAY MINOR TECHNOLOGY
						if (count($technologyMinor) > 0) :
					?>

					<div class="product-tech-minor tech-minor col-xs-12">
						<h2>Ingredients</h2>
						<div class="wrapper row">
							<?php foreach( $technologyMinor as $techItem): ?>

							<div class="item">
								<div class="tech-pad col-xs-6 col-ms-6 col-sm-4 col-md-3">
									<h4><img src="<?php echo $techItem[2][0]; ?>" /><span><?php echo $techItem[0]; ?></span></h4>
									<div class="tech-copy">
										<?php echo $techItem[1]; ?>
									</div>
								</div>
							</div>

							<?php
								if($i %2 == 0) echo '<div class="clearfix visible-xs visible-ms"></div>';
								if($i %3 == 0) echo '<div class="clearfix visible-sm"></div>';
								if($i %4 == 0) echo '<div class="clearfix visible-md visible-lg"></div>';
								$i++;
									endforeach;
							?>

						</div>
					</div><!-- END .product-tech-minor -->

					<?
						endif; // end tech minor check
					endif;// end technology check
					?>

				</div>
			</section>
		</div><!-- .schema-wrapper -->

		<?php
			// display video if we have an id
			$videoID = get_field('libtech_product_video');
			if( $videoID ):
		?>

    <section class="product-video container-fluid">
    	<div class="section-content row">
				<div class="video-player col-xs-12 col-md-10 col-md-offset-1">
					<iframe src="http://player.vimeo.com/video/<?php echo $videoID; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=fff100&amp;loop=1" width="940" height="528" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
				</div>
			</div>
		</section>

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
