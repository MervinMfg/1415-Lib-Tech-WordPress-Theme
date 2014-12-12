<?php
/*
Template Name: Skateboard Detail
*/
	get_header();
	if (have_posts()) : while (have_posts()) : the_post();
		$thePostID = $post->ID;
		$slug = $post->post_name;
		// build array of specs
		$specsArray = Array();
		if(get_field('libtech_skateboard_variations')):
			while(the_repeater_field('libtech_skateboard_variations')):
				$variationSpec = array(
					'width' => get_sub_field('libtech_skateboard_variations_width'),
					'length' => get_sub_field('libtech_skateboard_variations_length'),
					'wheelbase' => get_sub_field('libtech_skateboard_variations_wheelbase'),
					'nose' => get_sub_field('libtech_skateboard_variations_nose_length'),
					'tail' => get_sub_field('libtech_skateboard_variations_tail_length'),
					'concave' => get_sub_field('libtech_skateboard_variations_concave')
				);
				array_push($specsArray, $variationSpec);
			endwhile;
		endif;
?>
        <div class="bg-product-details-top"></div>
        <section class="product-details bg-product-details <?php echo $slug; ?>">
        	<div class="section-content">
				<h1><?php the_title(); ?></h1>
				<div class="product-images">
					<ul id="image-list">
			       		<?php
			       			$thumbnailImages = Array();
							if(get_field('libtech_skateboard_options')):
								while(the_repeater_field('libtech_skateboard_options')):
									$optionName = get_sub_field('libtech_skateboard_options_name');
									// get variations
									$optionVariations = get_sub_field('libtech_skateboard_options_variations');
									$optionVariationSizes = "";
									$optionVariationSKUs = "";
									// loop through variations
									for ($i = 0; $i < count($optionVariations); $i++) {
										$variationWidth = $optionVariations[$i]['libtech_skateboard_options_variations_width'];
										$variationSKU = $optionVariations[$i]['libtech_skateboard_options_variations_sku'];
										// get additional specs
										if(!empty($specsArray)){
											foreach ($specsArray as $specs) {
												if($variationWidth == $specs['width']) {
													$variationWidth = $variationWidth . "&quot; x " . $specs['length'] . "&quot;";
													break;
												}
											}
										}
										$optionVariationSizes .= $variationWidth;
										$optionVariationSKUs .= $variationSKU;
										// add comas except last item
										if($i < count($optionVariations)-1){
											$optionVariationSizes .= ", ";
											$optionVariationSKUs .= ", ";
										}
									}
									if(get_sub_field('libtech_skateboard_options_images')):
										while(the_repeater_field('libtech_skateboard_options_images')):
											$optionImage = get_sub_field('libtech_skateboard_options_images_img');
											$optionImageThumb = wp_get_attachment_image_src($optionImage, 'thumbnail', false);
				       						$optionImageMedium = wp_get_attachment_image_src($optionImage, 'square-xlarge', false);
				       						$optionImageFull = wp_get_attachment_image_src($optionImage, 'full', false);
				       						array_push($thumbnailImages, Array($optionImageThumb, $optionImageFull, $optionName, $optionVariationSizes, $optionVariationSKUs));
						?>
						<li><a href="<?php echo $optionImageFull[0]; ?>" title="<?php the_title(); ?> - <?php echo $optionVariationSizes; ?>"><img src="<?php echo $optionImageMedium[0]; ?>" alt="<?php the_title(); ?> - <?php echo $optionVariationSizes; ?>" width="<?php echo $optionImageMedium[1]; ?>" height="<?php echo $optionImageMedium[2]; ?>" /></a></li>
						<?php
										endwhile;
				       				endif;
								endwhile;
							endif;
						?>
					</ul>
				</div><!-- END .product-images -->
				<div class="product-details-right">
					<h3><?php the_field('libtech_product_slogan'); ?></h3>

					<div class="image-list-thumbs <?php if(count($thumbnailImages) < 2){ echo 'hidden'; }?>">
						<ul id="image-list-thumbs">
							<?php
							if($thumbnailImages):
								$i = 0;
								foreach ($thumbnailImages as $thumbnail) {
									$imageAlt = "";
									if(get_the_title() == $thumbnail[2]) {
										$imageAlt = get_the_title();
									} else {
										$imageAlt = get_the_title() . " - " . $thumbnail[2];
									}
							?>

							<li><a href="<?php echo $thumbnail[1][0]; ?>" title="<?php echo $thumbnail[2]; ?> - <?php echo $thumbnail[3]; ?>" data-sku="<?php echo $thumbnail[4]; ?>" data-slide-index="<?php echo $i; ?>"><img src="<?php echo $thumbnail[0][0]; ?>" alt="<?php echo $imageAlt; ?>" data-sub-alt="Sizes: <?php echo $thumbnail[3]; ?>" width="<?php echo $thumbnail[0][1]; ?>" height="<?php echo $thumbnail[0][2]; ?>" /></a></li>
							
							<?php
									$i ++;
								};
							endif;
							?>
						</ul>
					</div>
					<div class="product-price">
						<?php echo getPrice( get_field('libtech_product_price_us'), get_field('libtech_product_price_ca'), get_field('libtech_product_price_eur'), get_field('libtech_product_on_sale'), get_field('libtech_product_sale_percentage') ); ?>
					</div>
					<?php
						$variations = Array();
						$isProductAvailable = "No";
						if(get_field('libtech_skateboard_options')):
							while(the_repeater_field('libtech_skateboard_options')):
								$optionName = get_sub_field('libtech_skateboard_options_name');
								// get variations
								$optionVariations = get_sub_field('libtech_skateboard_options_variations');
								// loop through variations
								for ($i = 0; $i < count($optionVariations); $i++) {
									$variationWidth = $optionVariations[$i]['libtech_skateboard_options_variations_width'];
									// get additional specs
									if(!empty($specsArray)){
										foreach ($specsArray as $specs) {
											if($variationWidth == $specs['width']) {
												$variationWidth = $variationWidth . "&quot; x " . $specs['length'] . "&quot;";
												break;
											}
										}
									}
									$variationSKU = $optionVariations[$i]['libtech_skateboard_options_variations_sku'];
									if ($GLOBALS['currency'] == "CAD") {
										$variationAvailable = $optionVariations[$i]['libtech_skateboard_options_variations_availability_ca'];
									} else if ($GLOBALS['currency'] == "EUR") {
										$variationAvailable = $optionVariations[$i]['libtech_skateboard_options_variations_availability_eur'];
									} else {
										$variationAvailable = $optionVariations[$i]['libtech_skateboard_options_variations_availability_us'];
									}
									// set overall availability
									if($variationAvailable == "Yes"){
										$isProductAvailable = "Yes";
									}
									// setup variation name
									if($optionName != ""){
										$variationName = $variationWidth . " - " . $optionName;
									}else{
										$variationName = $variationWidth;
									}
									array_push($variations, Array($variationName, $variationSKU, $variationAvailable));
								}
							endwhile;
						endif;
					?>
					<div class="product-variations <?php if($isProductAvailable == "No"){echo 'hidden';} ?>">
						<select id="product-variation" class="select">
							<option value="-1">Select a Size</option>
							<?php
								// sort by variation name
								asort($variations);
								// render out variation dropdown
								foreach ($variations as $variation) {
							?>
							<option value="<?php echo $variation[1]; ?>" title="<?php echo $variation[0]; ?>"<?php if($variation[2] == "No") echo ' disabled="disabled"'; ?>><?php echo $variation[0]; ?></option>
							<?php
								}
							?>
						</select>
					</div>
					<p class="holiday-delivery">Orders must be placed by noon PST 12/18 for 12/24 <strong>Holiday Delivery</strong></p>
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
					<ul class="product-quick-specs">
						<?php
							// build array of sizes
							$variationSizes = Array();
							if(!empty($specsArray)){
								foreach ($specsArray as $specs) {
									$variationName = $specs['width'] . "&quot; x " . $specs['length'] . "&quot;";
									array_push($variationSizes, $variationName);
								}
							}
							// sort sizes
							array_multisort($variationSizes, SORT_ASC);
							// setup sizes text display
							$sizes = "";
							for ($i = 0; $i < count($variationSizes); $i++) {
								$sizes .= $variationSizes[$i];
								if($i < count($variationSizes)-1){
									$sizes .= "<br />";
								}
							}
						?>
						<li><span>Sizes:</span><br /><?php echo $sizes; ?></li>
					</ul>
					<ul class="product-share">
						<li><div class="fb-like" data-href="<? the_permalink(); ?>" data-layout="button_count" data-width="120" data-show-faces="false" data-colorscheme="dark" data-font="trebuchet ms"></div></li>
						<li><a href="https://twitter.com/share" class="twitter-share-button" data-via="libtechskate">Tweet</a></li>
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
		<div class="bg2-top"></div>
        <section class="product-extras bg2 info">
        	<div class="section-content clearfix">
        		<div class="product-mobile-nav clearfix">
        			<ul>
        				<li class="margin"><a href="#info" class="h3 selected" id="info">Info</a></li>
        				<li class="margin"><a href="#specs" class="h3" id="specs">Specs</a></li>
        				<li><a href="#tech" class="h3" id="tech">Tech</a></li>
        			</ul>
        		</div>
        		<div class="product-desc-awards-specs">
        			<div class="product-desc-awards">
		        		<div class="product-description">
		        			<?php the_content(); ?>
		        		</div>
		        		<?php // display awards if there are any
						$awards = get_field('libtech_product_awards');
						if( $awards ):
						?>
			        	<div class="product-awards">
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
					<div class="product-specs">
						<h2>Specifications</h2>
						<table>
							<thead>
								<tr>
									<th>Width</th>
									<th>Length</th>
									<th>Wheelbase</th>
									<th>Nose Length</th>
									<th>Tail Length</th>
									<th>Concave</th>
								</tr>
							</thead>
							<tbody>
								<?php
								// build array of sizes
								if(!empty($specsArray)) :
									foreach ($specsArray as $specs) :
								?>

								<tr>
									<td><?php echo $specs['width']; ?>"</td>
									<td><?php echo $specs['length']; ?>"</td>
									<td><?php echo $specs['wheelbase']; ?>"</td>
									<td><?php echo $specs['nose']; ?>"</td>
									<td><?php echo $specs['tail']; ?>"</td>
									<td><?php echo $specs['concave']; ?></td>
								</tr>

								<?php
									endforeach;
								endif;
								?>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="6"><a href="/skateboarding/specifications/" class="view-all-specs">View all specs</a></td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div><!-- END .product-desc-awards-specs -->

				<?php
				// check to see if catergory is hesho, if it is don't show construction
				$hesho = false;
				$terms = get_the_terms( $post->ID, 'libtech_skateboard_categories' );
				if( $terms && !is_wp_error( $terms ) ) {
					foreach( $terms as $term ) {
						if ($term->slug == "hesho-disposable-standards") {
							$hesho = true;
						}
					}
				}
				if ($hesho == false):
				?>
				<div class="product-tech-construction">
					<h2>Construction</h2>
					<div class="construction-slideshow">
						<ul>
							<li>
								<iframe src="http://player.vimeo.com/video/25848035?title=0&amp;byline=0&amp;portrait=0&amp;color=fff100" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
							</li>
							<li>
								<div class="construction-image">
									<img src="<?php bloginfo('template_directory'); ?>/_/img/skate-construction-1.jpg" alt="Plastihide top sheet" />
								</div>
								<p class="construction-caption">Skate Kraftsmen Cass prepping plastihide top sheet.</p>
							</li>
							<li>
								<div class="construction-image">
									<img src="<?php bloginfo('template_directory'); ?>/_/img/skate-construction-2.jpg" alt="Biaxial fiberglass layer" />
								</div>
								<p class="construction-caption">Biaxial fiberglass layer for extra pop!</p>
							</li>
							<li>
								<div class="construction-image">
									<img src="<?php bloginfo('template_directory'); ?>/_/img/skate-construction-3.jpg" alt="Light weight aspen wood core" />
								</div>
								<p class="construction-caption">Light weight aspen wood core with golfball tough tip &amp; tail material.</p>
							</li>
							<li>
								<div class="construction-image">
									<img src="<?php bloginfo('template_directory'); ?>/_/img/skate-construction-4.jpg" alt="84 vertical wood laminates" />
								</div>
								<p class="construction-caption">84 vertical wood laminates alternating 0&deg; to 90&deg; on the tip &amp; tail, pushing the limits of energy boost &amp; longer skate life!</p>
							</li>
							<li>
								<div class="construction-image">
									<img src="<?php bloginfo('template_directory'); ?>/_/img/skate-construction-5.jpg" alt="Carbon" />
								</div>
								<p class="construction-caption">Carbon! For record setting pop!</p>
							</li>
							<li>
								<div class="construction-image">
									<img src="<?php bloginfo('template_directory'); ?>/_/img/skate-construction-6.jpg" alt="Tough UHMW tip and tails" />
								</div>
								<p class="construction-caption">Tough abrasion-resistant UHMW tip &amp; tails and impact resistant birch wood sidewalls. Oval power pocket for optimum strenght over truck.</p>
							</li>
							<li>
								<div class="construction-image">
									<img src="<?php bloginfo('template_directory'); ?>/_/img/skate-construction-7.jpg" alt="Semi-Slick or Pickled Maple" />
								</div>
								<p class="construction-caption">Sublimated semi-slick plastihide bottom for slide control or pickled maple epoxy wood bottom.</p>
							</li>
							<li>
								<div class="construction-image">
									<img src="<?php bloginfo('template_directory'); ?>/_/img/skate-construction-8.jpg" alt="Lay-up" />
								</div>
								<p class="construction-caption">Lay-up.</p>
							</li>
							<li>
								<div class="construction-image">
									<img src="<?php bloginfo('template_directory'); ?>/_/img/skate-construction-9.jpg" alt="Finishing" />
								</div>
								<p class="construction-caption">Finish me up!</p>
							</li>
							<li>
								<div class="construction-image">
									<img src="<?php bloginfo('template_directory'); ?>/_/img/skate-construction-10.jpg" alt="Milling" />
								</div>
								<p class="construction-caption">Milling to shape.</p>
							</li>
							<li>
								<div class="construction-image">
									<img src="<?php bloginfo('template_directory'); ?>/_/img/skate-construction-11.jpg" alt="Tuning the shape" />
								</div>
								<p class="construction-caption">Skate kraftsmen Huntz fine tuning the shape.</p>
							</li>
							<li>
								<div class="construction-image">
									<img src="<?php bloginfo('template_directory'); ?>/_/img/skate-construction-12.jpg" alt="Sanding" />
								</div>
								<p class="construction-caption">Sanding.</p>
							</li>
							<li>
								<div class="construction-image">
									<img src="<?php bloginfo('template_directory'); ?>/_/img/skate-construction-13.jpg" alt="Buffing" />
								</div>
								<p class="construction-caption">Buffing and waxing.</p>
							</li>
							<li>
								<div class="construction-image">
									<img src="<?php bloginfo('template_directory'); ?>/_/img/skate-construction-2.jpg" alt="Polishing" />
								</div>
								<p class="construction-caption">Polishing and quality control.</p>
							</li>
						</ul>
					</div>
				</div><!-- END .product-tech-construction -->
				<?php endif; ?>

				<?php // display minor technology if there is any
				$technology = get_field('libtech_product_technology');
				if( $technology ):
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
					// CHECK IF WE SHOULD DISPLAY MINOR TECHNOLOGY
					if (count($technologyMinor) > 0) :
				?>
	        	<div class="product-tech-minor tech-minor<?php if ($hesho == true) { echo " hesho"; } ?>">
					<h2>Ingredients</h2>
					<ul>
						<?php foreach( $technologyMinor as $techItem): ?>

						<li>
							<div class="tech-pad">
								<h4><img src="<?php echo $techItem[2][0]; ?>" /><span><?php echo $techItem[0]; ?></span></h4>
								<div class="tech-copy">
									<?php echo $techItem[1]; ?>
								</div>
							</div>
						</li>

						<?php endforeach; ?>
					</ul>
				</div><!-- END .product-tech-minor -->
				
				<?
					endif; // end tech minor check
				endif;// end technology check
				?>
			</div>
		</section>

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
					<iframe src="http://player.vimeo.com/video/<?php echo $videoID; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=66CC00&amp;loop=1" width="940" height="528" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
				</div>
				<div class="video-copy">
					<p class="quote h3"><?php the_field('libtech_product_video_quote'); ?></p>
					<p class="quote-attribution h4">- <?php the_field('libtech_product_video_quote_attribution'); ?></p>
				</div>
				<div class="clearfix"></div>
			</div>
		</section>
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