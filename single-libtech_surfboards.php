<?php
/*
Template Name: Surfboard Detail
*/
	get_header();
	if (have_posts()) : while (have_posts()) : the_post();
		$thePostID = $post->ID;
		$slug = $post->post_name;
		$productAvailable = false;
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
					if ($GLOBALS['language'] == "ca") {
						$avail = $variationOptions[$i]['libtech_surfboard_variations_options_avail_ca'];
					} else {
						$avail = $variationOptions[$i]['libtech_surfboard_variations_options_avail_us'];
					}
					if ($avail == "Yes" || $avail == "Limited") {
						$productAvailable = true;
					}
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
						"avail" => $avail
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
        <div class="bg-product-details-top"></div>
        <section class="product-details bg-product-details <?php echo $slug; ?>">
        	<div class="section-content">
				<h1><?php the_title(); ?></h1>
				<div class="product-images">
					<div class="surf-images">
						<div class="surfboard-top">
							<img src="<?php echo $defaultTopImage; ?>" alt="Surfboard Top" data-img="<?php echo $defaultTopImage; ?>" data-img-full="<?php echo $defaultTopImageFull; ?>" />
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
				</div><!-- END .product-images -->
				<div class="product-details-right">
					<script type='text/javascript'>
						<?php
							$jsArray = json_encode($surfboards);
							echo "var productArray = ". $jsArray . ";\n";
						?>
					</script>
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

					<div class="product-price">
						<div class="price-logo<?php echo $threeFinClass; ?>">
							<?php echo getPrice( get_field('libtech_product_price_us'), get_field('libtech_product_price_ca'), get_field('libtech_product_on_sale'), get_field('libtech_product_sale_percentage') ); ?>
						</div>
						<div class="price-graphic">
							<?php echo getPrice( get_field('libtech_product_price_us_graphic'), get_field('libtech_product_price_ca_graphic'), get_field('libtech_product_on_sale'), get_field('libtech_product_sale_percentage') ); ?>
						</div>
						<div class="price-logo-five<?php echo $fiveFinClass; ?>">
							<?php echo getPrice( get_field('libtech_product_price_us_5fin'), get_field('libtech_product_price_ca_5fin'), get_field('libtech_product_on_sale'), get_field('libtech_product_sale_percentage') ); ?>
						</div>
						<div class="price-graphic-five">
							<?php echo getPrice( get_field('libtech_product_price_us_5fin_graphic'), get_field('libtech_product_price_ca_5fin_graphic'), get_field('libtech_product_on_sale'), get_field('libtech_product_sale_percentage') ); ?>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="product-stock-alert">
						<p class="surf-logo">The top and bottom logos come in random assorted colorways. They may not be exactly the same as the images you see on our website. Each board is handmade in the USA by surfers.</p>
						<p class="surf-logo-limited">We are currently out of stock on this Waterboard, but we can build one for you! It can take up to 4-6 weeks to build and ship.</p>
						<p class="surf-graphic">The bottom logos may not be exactly the same as the images you see on our website. We match them as close as we can to the top graphic you choose. Each board is handmade in the USA by surfers.</p>
						<p class="surf-graphic-limited">Most of our Waterboard graphic options are built to order, they can take up to 4-6 weeks to build and ship.</p> 
					</div>
					<div class="product-variations <?php if(!$productAvailable){echo 'hidden';} ?>">
						<select id="product-variation-graphic" class="select">
							<option value="-1">Select Graphic</option>
							<?php foreach ($surfboardGraphics as $surfboardGraphic) : ?>
							<option value="<?php echo $surfboardGraphic['name']; ?>" title="<?php echo $surfboardGraphic['name']; ?>" data-img="<?php echo $surfboardGraphic['topImage'][0]; ?>" data-img-full="<?php echo $surfboardGraphic['topImageFull'][0]; ?>"><?php echo $surfboardGraphic['name']; ?></option>
							<?php endforeach; ?>
						</select>
						<select id="product-variation-size" class="select">
							<option value="-1">Select Size &amp; Fin Box</option>
							<?php
							foreach ($surfboardOptions as $surfboardOption) :
								$title = $surfboardOption['length'] . ' - ' . $surfboardOption['fins'];
								$value = $surfboardOption['length'] . ' - ' . $surfboardOption['fins'];
							?>
							<option value="<?php echo $value; ?>" title="<?php echo $title; ?>" data-img="<?php echo $surfboardOption['bottomImage'][0]; ?>" data-img-full="<?php echo $surfboardOption['bottomImageFull'][0]; ?>"><?php echo $title; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="product-buy">
						<ul>
							<?php if($productAvailable): ?>
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
					</ul>
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
				<div class="zoom-controls">
					<a href="#close-zoom" class="zoom-close h3">Close</a>
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
							<div class="clearfix"></div>
						</div>
						<? endif; // end awards ?>
					</div><!-- END .product-desc-awards -->
					<div class="product-specs">
						<h2>Specifications</h2>
						<table>
							<thead>
								<tr>
									<th>Length</th>
									<th>Nose</th>
									<th>Width</th>
									<th>Tail</th>
									<th>Volume</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if(get_field('libtech_surfboard_specs')): while(the_repeater_field('libtech_surfboard_specs')):
									$surfboardLength = get_sub_field('libtech_surfboard_specs_length');
									$surfboardLength = floor($surfboardLength/12) . "’" . ($surfboardLength - (floor($surfboardLength/12)*12)) . "”";
								?>

								<tr>
									<td><?php echo $surfboardLength; ?></td>
									<td><?php the_sub_field('libtech_surfboard_specs_nose'); ?>"</td>
									<td><?php the_sub_field('libtech_surfboard_specs_width'); ?>"</td>
									<td><?php the_sub_field('libtech_surfboard_specs_tail'); ?>"</td>
									<td><?php the_sub_field('libtech_surfboard_specs_volume'); ?> cl</td>
								</tr>

								<?php endwhile; endif; ?>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="5"><!-- <a href="/surfing/specifications/" class="view-all-specs">View all specs</a> --></td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div><!-- END .product-desc-awards-specs -->
				<div class="product-tech-major tech-major">
					<h2>Technology</h2>
					<ul>
						<li class="surf-technology">
							<div class="tech-image">
								<img src="<?php bloginfo('template_directory'); ?>/_/img/surf-detail-technology.jpg" alt="Radically Different Surfboard Technology" />
							</div>
							<div class="tech-copy">
								<h4>Radically Different</h4>
								<p>30 years of experience crafting and riding high performance environMENTALLY friendly composite surf, skate and snowboards went into designing our unique waterboard process, materials and shapes. Each of the 31 pieces used to construct our surfboards are new materials to the surf industry.</p>
							</div>
							<div class="clearfix"></div>
						</li>
						<li class="surf-environmental">
							<div class="tech-image">
								<img src="<?php bloginfo('template_directory'); ?>/_/img/surf-detail-environmental.jpg" alt="Environmental Surfboards" />
							</div>
							<div class="tech-copy">
								<h4>Environmentally Nicer</h4>
								<p>100% closed cell foam won’t absorb water... won't rot &bullet; More durable: Lasts longer, less dings, less boards in landfills &bullet; Recycled foam core: up to 50% recycled content in blank &bullet; Blank scraps all recycled &bullet; Elimination of hazardous resin systems &bullet; Non ozone depleting blowing agent &bullet; Basalt fiber: no additives, no boron &bullet; No solvents except water &bullet; No paint brushes &bullet; No sandpaper, no tape</p>
							</div>
							<div class="clearfix"></div>
						</li>
						<li class="surf-ding">
							<div class="tech-image">
								<img src="<?php bloginfo('template_directory'); ?>/_/img/surf-detail-ding.gif" alt="Durable Lib Tech Surfboard being rode over by a man on a bike" />
							</div>
							<div class="tech-copy">
								<h4>Dang Difficult to Ding</h4>
								<ul>
									<li>Years of composite panel impact testing went into our unique combination of fibers, Basalt and Resin systems.</li>
									<li>Voted toughest board of the year by Outside Magazine.</li>
									<li>Crossing the street or the globe, tougher surfboards - free your mind!</li>
									<li>If you do ding it, you don't have to get out of the water. Our core doesn't take on water.</li>
								</ul>
							</div>
							<div class="clearfix"></div>
						</li>
						<li class="surf-fins">
							<div class="tech-image">
								<img src="<?php bloginfo('template_directory'); ?>/_/img/surf-detail-fins.jpg" alt="Freedom of Choice multi-fin system" />
							</div>
							<div class="tech-copy">
								<h4>FOC Adjustable Fin System</h4>
								<p>F.O.C. "Freedom of Choice" multi-fin system compatible with 5/8" performance tuning adjustability</p>
							</div>
							<div class="clearfix"></div>
						</li>
						<li class="surf-performance">
							<div class="tech-image">
								<img src="<?php bloginfo('template_directory'); ?>/_/img/surf-detail-performance.jpg" alt="Performance - Ryan Carlson" />
							</div>
							<div class="tech-copy">
								<h4>Performance</h4>
								<p>SMOOTH &bullet; FAST &bullet; POPPY</p>
							</div>
							<div class="clearfix"></div>
						</li>
						<li class="surf-handcrafted">
							<div class="tech-image">
								<img src="<?php bloginfo('template_directory'); ?>/_/img/surf-detail-handcrafted.jpg" alt="Handcrafted in the USA" />
							</div>
							<div class="tech-copy">
								<h4>Handcrafted in the USA</h4>
								<p>Every waterboard is hand made by surfers in the USA near Canada at the world's most environMENTAL board factory!</p>
							</div>
							<div class="clearfix"></div>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div><!-- END .product-tech-major -->

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
	        	<div class="product-tech-minor tech-minor">
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
					<div class="clearfix"></div>
				</div><!-- END .product-tech-minor -->
				
				<?
					endif; // end tech minor check
				endif;// end technology check
				?>

			</div><!-- END .section-content -->
		</section><!-- END .product-extras -->

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
			// display gallery if we have one
			if( get_field('libtech_surfboard_gallery') ):
				if( $videoID ) {
					$topClass = "bg2-top";
					$sectionClass = "bg2";
				} else {
					$topClass = "bg3-top";
					$sectionClass = "bg3";
				}
		?>
		<div class="<?php echo $topClass; ?> product-gallery-top"></div>
		<section class="<?php echo $sectionClass; ?> product-gallery">
			<div class="section-content">
				<h2>Gallery</h2>
				<?php 
					$image_ids = get_field('libtech_surfboard_gallery', false, false);
					$shortcode = '[gallery ids="' . implode(',', $image_ids) . '"]';
					echo do_shortcode( $shortcode );
				?>
				<div class="clearfix"></div>
			</div><!-- END .section-content -->
		</section><!-- END .product-gallery -->
		<?php
			endif;
			comments_template();
			// display the related products
			getRelatedProducts();
		?>
<?php
		endwhile;
	endif;
	get_footer();
?>