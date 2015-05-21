<?php
/*
Template Name: Surfboard Detail
*/
	get_header();
	if (have_posts()) : while (have_posts()) : the_post();
		$thePostID = $post->ID;
		$slug = $post->post_name;
		// $productAvailable = false;
		// grab availability
		$productAvailUS = "No";
		$productAvailCA = "No";
		$productAvailEU = "No";
		// get 5 fin bottom image
		$defaultTopImage = "";
		$defaultTopImageFull = "";
		// get side profile image
		$sideImage = get_field('libtech_surfboard_side_img');
		$sideImageFull = wp_get_attachment_image_src($sideImage, 'full', false);
		$sideImage = wp_get_attachment_image_src($sideImage, 'soft-xlarge', false);
		// get 3 fin bottom image
		$bottomImage = get_field('libtech_surfboard_3_fin_bottom_img');
		$bottomImageFull = wp_get_attachment_image_src($bottomImage, 'full', false);
		$bottomImage = wp_get_attachment_image_src($bottomImage, 'soft-xlarge', false);
		// get 5 fin bottom image
		$bottomImage5Fin = get_field('libtech_surfboard_5_fin_bottom_img');
		$bottomImage5FinFull = wp_get_attachment_image_src($bottomImage5Fin, 'full', false);
		$bottomImage5Fin = wp_get_attachment_image_src($bottomImage5Fin, 'soft-xlarge', false);
		// create arrays for storing board data
		$surfboards = Array();
		$surfboardGraphics = Array();
		$surfboardOptions = Array();
		if(get_field('libtech_surfboard_variations')):
			while(the_repeater_field('libtech_surfboard_variations')):
				// set variables
				$name = get_sub_field('libtech_surfboard_variations_name');
				$type = get_sub_field('libtech_surfboard_variations_type');
				$artist = get_sub_field('libtech_surfboard_variations_artist');
				$topImage = get_sub_field('libtech_surfboard_variations_top_img');
				$topImageFull = wp_get_attachment_image_src($topImage, 'full', false);
				$topImageThumb = wp_get_attachment_image_src($topImage, 'soft-thumbnail', false);
				$topImage = wp_get_attachment_image_src($topImage, 'soft-xlarge', false);
				// check to see if this is the default top
				if ($type == "Logo") {
					$defaultTopImage = $topImage[0];
					$defaultTopImageFull = $topImageFull[0];
				}
				// get variation options
				$variationOptions = get_sub_field('libtech_surfboard_variations_options');
				// loop through options
				for ($i = 0; $i < count($variationOptions); $i++) {
					$length = $variationOptions[$i]['libtech_surfboard_variations_options_length'];
					$length = floor($length/12) . "’" . ($length - (floor($length/12)*12)) . "”"; // convert from inches to feet + inches
					$fins = $variationOptions[$i]['libtech_surfboard_variations_options_fins'];
					$sku = $variationOptions[$i]['libtech_surfboard_variations_options_sku'];
					// grab availability overwrite
					$availableUS = $variationOptions[$i]['libtech_surfboard_variations_options_avail_us'];
					$availableCA = $variationOptions[$i]['libtech_surfboard_variations_options_avail_ca'];
					$availableEU = $variationOptions[$i]['libtech_surfboard_variations_options_avail_eur'];
					// get values for availability
					$availability = getAvailability($sku, $availableUS, $availableCA, $availableEU);
					// eval if we should show product or not for each location
					// in US and CA we allow sales of boards when we don't have in stock, made to order, but not 3 fins
					if($availability['us']['amount'] > 0 || ($availability['us']['amount'] == "" && $fins != "3 Fin Box") || ($availability['us']['amount'] == 0 && $fins != "3 Fin Box") || $availability['us']['amount'] == "Yes") $productAvailUS = "Yes";
					if($availability['ca']['amount'] > 0 || ($availability['ca']['amount'] == "" && $fins != "3 Fin Box") || ($availability['ca']['amount'] == 0 && $fins != "3 Fin Box") || $availability['ca']['amount'] == "Yes") $productAvailCA = "Yes";
					// waterboards are treated direct in Europe
					if($availability['eu']['amount'] > 0 || $availability['eu']['amount'] == "Yes") $productAvailEU = "Yes";
					//
					if ($fins == "3 Fin Box") {
						$bImg = $bottomImage[0];
						$bImgFull = $bottomImageFull[0];
					} else {
						$bImg = $bottomImage5Fin[0];
						$bImgFull = $bottomImage5FinFull[0];
					}
					// set up surfboard array
					$surfboard = array(
						"name" => $name,
						"type" => $type,
						"artist" => $artist,
						"bottomImage" => $bImg,
						"bottomImageFull" => $bImgFull,
						"length" => $length,
						"fins" => $fins,
						"sku" => $sku,
						"available" => $availability
					);
					// add to master product array
					array_push($surfboards, $surfboard);
					// determine bottom image based on fins
					if ($fins == "3 Fin Box") {
						$bImg = $bottomImage;
						$bImgFull = $bottomImageFull;
					} else {
						$bImg = $bottomImage5Fin;
						$bImgFull = $bottomImage5FinFull;
					}
					// add surfboard options
					$surfboardOption = array(
						"length" => $length,
						"fins" => $fins,
						"bottomImage" => $bImg,
						"bottomImageFull" => $bImgFull
					);
					// do not add duplicate options
					if (!in_array($surfboardOption, $surfboardOptions)) {
						array_push($surfboardOptions, $surfboardOption);
					}
				}
				// add graphic option
				$surfboardGraphic = array(
					"name" => $name,
					"topImage" => $topImage,
					"topImageFull" => $topImageFull,
					"topImageThumb" => $topImageThumb
				);
				array_push($surfboardGraphics, $surfboardGraphic);
			endwhile;
		endif;
?>

		<?php include get_template_directory() . '/_/inc/modules/product-slider.php'; ?>

		<div class="product-details-nav-btn">
			<div class="toggle-btn"></div>
		</div>
    <div class="schema-wrapper" itemscope itemtype="http://schema.org/Product">
	    <section class="product-details <?php echo $slug; ?> container-fluid">
	    	<div class="section-content row">
					<div class="product-images col-xs-12 col-ms-10 col-ms-offset-1 col-sm-7 col-sm-offset-0">
						<div class="surf-images">
							<div class="surfboard-top">
								<img src="<?php echo $defaultTopImage; ?>" alt="Surfboard Top" data-img="<?php echo $defaultTopImage; ?>" data-img-full="<?php echo $defaultTopImageFull; ?>" itemprop="image" />
							</div>
							<div class="surfboard-side">
								<img src="<?php echo $sideImage[0]; ?>" alt="Surfboard Side Profile" data-img="<?php echo $sideImage[0]; ?>" data-img-full="<?php echo $sideImageFull[0]; ?>" />
							</div>
							<div class="surfboard-bottom">
								<?php if ($bottomImage5Fin == null) : // show 3 fin image if 5 does not exist ?>
								<img src="<?php echo $bottomImage[0]; ?>" alt="Surfboard Bottom" data-img="<?php echo $bottomImage[0]; ?>" data-img-full="<?php echo $bottomImageFull[0]; ?>" />
								<?php else: ?>
								<img src="<?php echo $bottomImage5Fin[0]; ?>" alt="Surfboard Bottom" data-img="<?php echo $bottomImage5Fin[0]; ?>" data-img-full="<?php echo $bottomImage5FinFull[0]; ?>" />
								<?php endif; ?>
							</div>
							<div class="clearfix"></div>
						</div>
					</div><!-- .product-images -->
					<div class="product-details-right col-xs-12 col-ms-10 col-ms-offset-1 col-sm-5 col-sm-offset-0">
						<script type='text/javascript'>
							<?php
								$jsArray = json_encode($surfboards);
								echo "var productArray = ". $jsArray . ";\n";
							?>
						</script>
						<h1 itemprop="name"><?php the_title(); ?></h1>
						<h3><?php the_field('libtech_product_slogan'); ?></h3>
						<div class="image-list-thumbs">
							<ul id="image-list-thumbs">
								<?php foreach ($surfboardGraphics as $surfboardGraphic) : ?>
								<li><a href="<?php echo $surfboardGraphic['topImageFull'][0]; ?>"<?php if($surfboardGraphic['name'] == "Logo"){ echo ' class="active"'; } ?>><img src="<?php echo $surfboardGraphic['topImageThumb'][0]; ?>" alt="<?php the_title(); ?>" data-sub-alt="<?php echo $surfboardGraphic['name']; ?>" /></a></li>
								<?php endforeach; ?>
							</ul>
						</div>

						<?php
							// check fin pricing and what to display by default
							if (get_field('libtech_product_price_us_5fin') == "") {
								$threeFinClass = " active";
								$fiveFinClass = "";
							} else {
								$threeFinClass = "";
								$fiveFinClass = " active";
							}
						?>

						<div class="product-price" itemprop="offers" itemscope itemtype="http://schema.org/Offer" >
							<div class="price-logo<?php echo $threeFinClass; ?>">
								<?php
									$showSchema = (get_the_title() == "Vert Series");
									echo getPrice(
										get_field('libtech_product_price_us'),
										get_field('libtech_product_price_ca'),
										get_field('libtech_product_price_eur'),
										get_field('libtech_product_on_sale'),
										get_field('libtech_product_sale_percentage'),
										$showSchema
									);
								?>
							</div>
							<div class="price-graphic">
								<?php
									echo getPrice(
										get_field('libtech_product_price_us_graphic'),
										get_field('libtech_product_price_ca_graphic'),
										get_field('libtech_product_price_eur_graphic'),
										get_field('libtech_product_on_sale'),
										get_field('libtech_product_sale_percentage')
									);
								?>
							</div>
							<div class="price-logo-five<?php echo $fiveFinClass; ?>">
								<?php
									$showSchema = (get_the_title() != "Vert Series");
									echo getPrice(
										get_field('libtech_product_price_us_5fin'),
										get_field('libtech_product_price_ca_5fin'),
										get_field('libtech_product_price_eur_5fin'),
										get_field('libtech_product_on_sale'),
										get_field('libtech_product_sale_percentage'),
										$showSchema
									);
								?>
							</div>
							<div class="price-graphic-five">
								<?php
									echo getPrice(
										get_field('libtech_product_price_us_5fin_graphic'),
										get_field('libtech_product_price_ca_5fin_graphic'),
										get_field('libtech_product_price_eur_5fin_graphic'),
										get_field('libtech_product_on_sale'),
										get_field('libtech_product_sale_percentage')
									);
								?>
							</div>
							<link itemprop="itemCondition" href="http://schema.org/NewCondition" />
							<p class="price-alert usd cad">Free shipping over $75</p>
							<p class="price-alert eur">Free shipping over €75</p>
							<div class="clearfix"></div>
						</div><!-- .product-price -->
						<div class="product-stock-alert">
							<p class="surf-logo">The top and bottom logos come in random assorted colorways. They may not be exactly the same as the images you see on our website.</p>
							<p class="surf-logo-limited">We are currently out of stock on this Waterboard, but we can build one for you! It can take up to 4-6 weeks to build and ship.</p>
							<p class="surf-graphic">The bottom logos may not be exactly the same as the images you see on our website. We match them as close as we can to the top graphic you choose.</p>
							<p class="surf-graphic-limited">Our graphic options are built to order. They can take up to 4-6 weeks to build and ship.</p>
						</div><!-- .product-stock-alert -->
						<div class="product-variations">
							<select id="product-variation-graphic" class="select<?php if(count($surfboardGraphics) == 1){echo ' hidden';} ?>">
								<option value="-1">Select Graphic</option>
								<?php foreach ($surfboardGraphics as $surfboardGraphic) : ?>
								<option value="<?php echo $surfboardGraphic['name']; ?>" title="<?php echo $surfboardGraphic['name']; ?>" data-img="<?php echo $surfboardGraphic['topImage'][0]; ?>" data-img-full="<?php echo $surfboardGraphic['topImageFull'][0]; ?>" <?php if(count($surfboardGraphics) == 1){echo 'selected="selected"';} ?>><?php echo $surfboardGraphic['name']; ?></option>
								<?php endforeach; ?>
							</select>
							<select id="product-variation-size" class="select<?php if(count($surfboardOptions) == 1){echo ' hidden';} ?>">
								<option value="-1">Select Size &amp; Fin Box</option>
								<?php
								foreach ($surfboardOptions as $surfboardOption) :
									$title = $surfboardOption['length'] . ' - ' . $surfboardOption['fins'];
									$value = $surfboardOption['length'] . ' - ' . $surfboardOption['fins'];
								?>
								<option value="<?php echo $value; ?>" title="<?php echo $title; ?>" data-img="<?php echo $surfboardOption['bottomImage'][0]; ?>" data-img-full="<?php echo $surfboardOption['bottomImageFull'][0]; ?>" <?php if(count($surfboardOptions) == 1){echo 'selected="selected"';} ?>><?php echo $title; ?></option>
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
								<li class="cart-button"><a href="#add-to-cart" class="button">Add to Cart</a><img src="<?php bloginfo('template_directory'); ?>/_/img/shopatron-secure-logo.png" alt="Shopatron Secure" /></li>
								<li class="clearfix"></li>
								<li class="unavailable">Item is currently not available online.</li>
								<li class="find-dealer h4"><a href="/dealer-locator/?product=surfboards">Find a Dealer</a></li>
							</ul>
							<div class="cart-success hidden"><p>The item has been added to your cart.</p><p><a href="/shopping-cart/" class="cart-link">View your shopping cart</a></p></div>
							<div class="cart-failure hidden"><p>There has been an error adding the item to your cart.</p><p>Try again later or <a href="/contact/">contact us</a> if the problem persists.</p></div>
						</div><!-- .product-buy -->
						<ul class="product-quick-specs">
							<?php
								// build array of sizes
								$surfboardSizes = Array();
								if(get_field('libtech_surfboard_specs')):
									while(the_repeater_field('libtech_surfboard_specs')):
										$surfboardLength = get_sub_field('libtech_surfboard_specs_length');
										$surfboardLength = floor($surfboardLength/12) . "’" . ($surfboardLength - (floor($surfboardLength/12)*12)) . "”";
										// add size to array
										array_push($surfboardSizes, $surfboardLength);
									endwhile;
								endif;
								// sort sizes
								// array_multisort($surfboardSizes, SORT_ASC);
								// setup sizes text display
								$sizes = "";
								for ($i = 0; $i < count($surfboardSizes); $i++) {
									$sizes .= $surfboardSizes[$i];
									if($i < count($surfboardSizes)-1){
										$sizes .= ", ";
									}
								}
							?>
							<li><span>Sizes</span> <?php echo $sizes; ?></li>
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
					</div><!-- .product-details-right -->
					<div class="clearfix"></div>
				</div><!-- .section-content -->
			</section><!-- .product-details -->
			<section class="product-zoom container-fluid">
				<div class="section-content">
					<div class="zoom-title"></div>
					<div class="zoom-controls">
						<a href="#close-zoom" class="zoom-close button">Close</a>
						<ul id="zoom-thumbnails"></ul>
					</div>
					<div class="zoom-image">
						<img src="" class="surfboard-top" />
						<img src="" class="surfboard-side" />
						<img src="" class="surfboard-bottom" />
						<div class="clearfix"></div>
					</div>
				</div><!-- END .section-content -->
			</section><!-- END .product-zoom -->
			<section class="product-extras info container-fluid">
				<div class="section-content clearfix row">
					<div class="product-desc-awards-specs col-xs-12 col-ms-10 col-ms-offset-1 col-sm-5">
						<div class="product-desc-awards">
							<div class="product-description" itemprop="description" >
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
								<div class="clearfix"></div>
							</div>
							<? endif; // end awards ?>
						</div><!-- END .product-desc-awards -->
						<div class="product-specs">
							<h2>Specifications</h2>
							<table>
								<?php
								$i = 1;
								if(have_rows('libtech_surfboard_specs')):
									while(have_rows('libtech_surfboard_specs')):
										the_row();
										$surfboardLength = get_sub_field('libtech_surfboard_specs_length');
										$surfboardLength = floor($surfboardLength/12) . "’" . ($surfboardLength - (floor($surfboardLength/12)*12)) . "”";
										$columns = 3; // length, width, volume by default
										$noseWidth = get_sub_field('libtech_surfboard_specs_nose');
										if($noseWidth) $columns++;
										$tailWidth = get_sub_field('libtech_surfboard_specs_tail');
										if($tailWidth) $columns++;
										$thickness = get_sub_field('libtech_surfboard_specs_thickness');
										if($thickness) $columns++;
								?>

								<?php if($i == 1) : ?>
								<thead>
									<tr>
										<th>Length</th>
										<?php if($noseWidth): ?><th>Nose</th><?php endif; ?>
										<th>Width</th>
										<?php if($tailWidth): ?><th>Tail</th><?php endif; ?>
										<?php if($thickness): ?><th>Thickness</th><?php endif; ?>
										<th>Volume</th>
									</tr>
								</thead>
								<tbody>
								<?php endif; ?>


									<tr>
										<td><?php echo $surfboardLength; ?></td>
										<?php if($noseWidth): ?><td><?php the_sub_field('libtech_surfboard_specs_nose'); ?>"</td><?php endif; ?>
										<td><?php the_sub_field('libtech_surfboard_specs_width'); ?>"</td>
										<?php if($tailWidth): ?><td><?php the_sub_field('libtech_surfboard_specs_tail'); ?>"</td><?php endif; ?>
										<?php if($thickness): ?><td><?php the_sub_field('libtech_surfboard_specs_thickness'); ?>"</td><?php endif; ?>
										<td><?php the_sub_field('libtech_surfboard_specs_volume'); ?> cl</td>
									</tr>

									<?php
											$i++;
											if($i > count(get_field('libtech_surfboard_specs'))) :
									?>

									</tbody>
									<tfoot>
										<tr>
											<td colspan="<?php echo $columns; ?>"></td>
										</tr>
									</tfoot>

									<?php
											endif;
										endwhile;
									endif;
									?>
							</table>
						</div>
					</div><!-- END .product-desc-awards-specs -->
					<div class="product-tech-major tech-major tech-surf col-xs-12 col-ms-10 col-ms-offset-1 col-sm-7">
						<h2>Technology</h2>
						<ul class="surf-tech-list">
							<li class="surf-technology surf-tech-item row">
								<div class="tech-image col-sm-5 col-lg-4">
									<img src="<?php bloginfo('template_directory'); ?>/_/img/surf-detail-technology.jpg" alt="Radically Different Surfboard Technology" />
								</div>
								<div class="tech-copy col-sm-7 col-lg-8">
									<h4>Radically Different</h4>
									<p>30 years of experience crafting and riding high performance environMENTALLY friendly composite surf, skate and snowboards went into designing our unique waterboard process, materials and shapes. Each of the 31 pieces used to construct our surfboards are new materials to the surf industry.</p>
								</div>
							</li>
							<li class="surf-environmental surf-tech-item row">
								<div class="tech-image col-sm-5 col-lg-4">
									<img src="<?php bloginfo('template_directory'); ?>/_/img/surf-detail-environmental.jpg" alt="Environmental Surfboards" />
								</div>
								<div class="tech-copy col-sm-7 col-lg-8">
									<h4>Environmentally Nicer</h4>
									<p>100% closed cell foam won’t absorb water... won't rot &bullet; More durable: Lasts longer, less dings, less boards in landfills &bullet; Recycled foam core: up to 50% recycled content in blank &bullet; Blank scraps all recycled &bullet; Elimination of hazardous resin systems &bullet; Non ozone depleting blowing agent &bullet; Basalt fiber: no additives, no boron &bullet; No solvents except water &bullet; No paint brushes &bullet; No sandpaper, no tape</p>
								</div>
							</li>
							<li class="surf-ding surf-tech-item row">
								<div class="tech-image col-sm-5 col-lg-4">
									<img src="<?php bloginfo('template_directory'); ?>/_/img/surf-detail-ding.gif" alt="Durable Lib Tech Surfboard being rode over by a man on a bike" />
								</div>
								<div class="tech-copy col-sm-7 col-lg-8">
									<h4>Dang Difficult to Ding</h4>
									<ul>
										<li>Years of composite panel impact testing went into our unique combination of fibers, Basalt and Resin systems.</li>
										<li>Voted toughest board of the year by Outside Magazine.</li>
										<li>Crossing the street or the globe, tougher surfboards - free your mind!</li>
										<li>If you do ding it, you don't have to get out of the water. Our core doesn't take on water.</li>
									</ul>
								</div>
							</li>
							<li class="surf-fins surf-tech-item row">
								<div class="tech-image col-sm-5 col-lg-4">
									<img src="<?php bloginfo('template_directory'); ?>/_/img/surf-detail-fins.jpg" alt="Freedom of Choice multi-fin system" />
								</div>
								<div class="tech-copy col-sm-7 col-lg-8">
									<h4>FOC Adjustable Fin System</h4>
									<p>F.O.C. "Freedom of Choice" multi-fin system compatible with 5/8" performance tuning adjustability</p>
								</div>
							</li>
							<li class="surf-performance surf-tech-item row">
								<div class="tech-image col-sm-5 col-lg-4">
									<img src="<?php bloginfo('template_directory'); ?>/_/img/surf-detail-performance.jpg" alt="Performance - Ryan Carlson" />
								</div>
								<div class="tech-copy col-sm-7 col-lg-8">
									<h4>Performance</h4>
									<p>SMOOTH &bullet; FAST &bullet; POPPY</p>
								</div>
							</li>
							<li class="surf-handcrafted surf-tech-item row">
								<div class="tech-image col-sm-5 col-lg-4">
									<img src="<?php bloginfo('template_directory'); ?>/_/img/surf-detail-handcrafted.jpg" alt="Handcrafted in the USA" />
								</div>
								<div class="tech-copy col-sm-7 col-lg-8">
									<h4>Handcrafted in the USA</h4>
									<p>Every waterboard is hand made by surfers in the USA near Canada at the world's most environMENTAL board factory!</p>
								</div>
							</li>
						</ul>
						<div class="clearfix"></div>
					</div><!-- END .product-tech-major -->

					<?php // display minor technology if there is any
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
						// CHECK IF WE SHOULD DISPLAY MINOR TECHNOLOGY
						if (count($technologyMinor) > 0) :
					?>
        	<div class="product-tech-minor tech-minor surf col-xs-12">
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
						<div class="clearfix"></div>
					</div><!-- END .product-tech-minor -->

					<?
						endif; // end tech minor check
					endif;// end technology check
					?>

				</div><!-- END .section-content -->
			</section><!-- END .product-extras -->
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
			</div><!-- END .section-content -->
		</section><!-- END .product-video -->

		<?php
			endif;
		?>

		<section class="product-gallery container-fluid">
			<div class="section-content row">
				<h2 class="col-xs-12 col-md-10 col-md-offset-1">Gallery</h2>
				<div class="gallery-wrapper col-xs-12 col-md-10 col-md-offset-1">
					<?php
						$image_ids = get_field('libtech_surfboard_gallery', false, false);
						$shortcode = '[gallery ids="' . implode(',', $image_ids) . '"]';
						echo do_shortcode( $shortcode );
					?>
				</div>
				<div class="clearfix"></div>
			</div><!-- END .section-content -->
		</section><!-- END .product-gallery -->

		<?php
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
