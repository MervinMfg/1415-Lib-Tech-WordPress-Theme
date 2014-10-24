<?php
/*
Template Name: Outerwear Detail
*/
	get_header();
	if (have_posts()) : while (have_posts()) : the_post();
		$thePostID = $post->ID;
		$slug = $post->post_name;
?>
        <div class="bg-product-details-top"></div>
        <section class="product-details bg-product-details <?php echo $slug; ?>">
        	<div class="section-content">
				<h1><?php the_title(); ?></h1>
				<div class="product-images">
					<ul id="image-list">
						<?php
						$thumbnailImages = Array();
						if(get_field('libtech_outerwear_images')):
							while(the_repeater_field('libtech_outerwear_images')):
			       				$optionImage = get_sub_field('libtech_outerwear_images_image');
								$optionImageThumb = wp_get_attachment_image_src($optionImage, 'thumbnail', false);
	       						$optionImageMedium = wp_get_attachment_image_src($optionImage, 'square-xlarge', false);
	       						$optionImageFull = wp_get_attachment_image_src($optionImage, 'full', false);
	       						$optionImageColor = get_sub_field('libtech_outerwear_images_color');
	       						array_push($thumbnailImages, Array($optionImageThumb, $optionImageFull, $optionImageColor));
						?>
						<li><a href="<?php echo $optionImageFull[0]; ?>" title="<?php the_title(); ?> - <?php echo $optionImageColor; ?>"><img src="<?php echo $optionImageMedium[0]; ?>" alt="<?php the_title(); ?> - <?php echo $optionImageColor; ?>" width="<?php echo $optionImageMedium[1]; ?>" height="<?php echo $optionImageMedium[2]; ?>" /></a></li>
						
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
							$isProductAvailable = "No";
							// loop through repeater
							if(get_field('libtech_outerwear_variations')):
								while(the_repeater_field('libtech_outerwear_variations')):
									$productSize = get_sub_field('libtech_outerwear_variations_size');
									$productColor = get_sub_field('libtech_outerwear_variations_color');
									$productSKU = get_sub_field('libtech_outerwear_variations_sku');
									if ($GLOBALS['language'] == "ca") {
										$productAvailable = get_sub_field('libtech_outerwear_variations_availability_ca');
									} else {
										$productAvailable = get_sub_field('libtech_outerwear_variations_availability_us');
									}
									$product = array("size" => $productSize, "color" => $productColor, "sku" => $productSKU, "available" => $productAvailable);
									array_push($productArray, $product);
									if($productAvailable == "Yes"){
										$isProductAvailable = "Yes";
									}
								endwhile;
							endif;

							$jsArray = json_encode($productArray);
							echo "var productArray = ". $jsArray . ";\n";
						?>
					</script>
					<h3><?php the_field('libtech_product_slogan'); ?></h3>
					<div class="image-list-thumbs <?php if(count($thumbnailImages) < 2){ echo 'hidden'; }?>">
						<ul id="image-list-thumbs">
							<?php if($thumbnailImages): $i = 0; foreach ($thumbnailImages as $thumbnail) { ?>

							<li><a href="<?php echo $thumbnail[1][0]; ?>" title="<?php the_title(); ?> - <?php echo $thumbnail[2]; ?>" data-color="<?php echo $thumbnail[2]; ?>" data-slide-index="<?php echo $i; ?>"><img src="<?php echo $thumbnail[0][0]; ?>" alt="<?php the_title(); ?> - <?php echo $thumbnail[2]; ?>" width="<?php echo $thumbnail[0][1]; ?>" height="<?php echo $thumbnail[0][2]; ?>" /></a></li>
							
							<?php $i ++; }; endif; ?>
						</ul>
					</div>
					<div class="product-price">
						<?php echo getPrice( get_field('libtech_product_price_us'), get_field('libtech_product_price_ca'), get_field('libtech_product_on_sale'), get_field('libtech_product_sale_percentage') ); ?>
					</div>
					<div class="product-variations <?php if($isProductAvailable == "No"){echo 'hidden';} ?>">
						<select id="product-variation-size" class="select">
							<option value="-1">Select Size</option>
							<?php
							$sizeArray = array();
							foreach ($productArray as $product) :
								$productSize = $product['size'];
								$productAvailable = $product['available'];
								if(!in_array($productSize, $sizeArray) && $productAvailable != "No"):
							?>
							<option value="<?php echo $productSize; ?>" title="<?php echo $productSize; ?>" <?php if($productSize == "OSFA" || count($productArray) == 1){echo 'selected="selected"';} ?>><?php echo $productSize; ?></option>
							<?php
								endif;
								// add product to size array if it's available
								if($productAvailable != "No"){
									array_push($sizeArray, $productSize);
								}
							endforeach;
							?>
						</select>
						<select id="product-variation-color" class="select">
							<option value="-1">Select Color</option>
							<?php
							$colorArray = array();

							foreach ($productArray as $product) :
								$productColor = $product['color'];
								$productAvailable = $product['available'];
								if(!in_array($productColor, $colorArray) && $productAvailable != "No"):
							?>
							<option value="<?php echo $productColor; ?>" title="<?php echo $productColor; ?>" <?php if(count($productArray) == 1){echo 'selected="selected"';} ?>><?php echo $productColor; ?></option>
							<?php
								endif;
								// add product to color array if it's available
								if($productAvailable != "No"){
									array_push($colorArray, $productColor);
								}
							endforeach;
							?>
						</select>
					</div>
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
						<?php if(get_field('libtech_outerwear_waterproof') != "None"): ?>
						<li><span>Waterproof/Breathability:</span> <?php the_field('libtech_outerwear_waterproof'); ?></li>
						<? endif; ?>
						<?php
						$sizeArray = array();
						$sizeDisplayArray = array();
						foreach ($productArray as $product) :
							$productSize = $product['size'];
							if(!in_array($productSize, $sizeDisplayArray)):
								array_push($sizeDisplayArray, $productSize);
							endif;
							// add product to size array if it's available
							if($productAvailable != "No"){
								array_push($sizeArray, $productSize);
							}
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
						<li><a href="#sizing-chart" class="sizing-chart-link">View Sizing Chart</a></li>
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

		<?php
		// get categories for outerwear styles
		$terms = get_the_terms( $post->ID, 'libtech_outerwear_categories' );
		$catList = "";
		if( $terms && !is_wp_error( $terms ) ) {
			foreach( $terms as $term ) {
				$catList .= " " . $term->slug;
			}
		}
		?>

		<div class="bg2-top"></div>
		<section class="product-extras bg2 info<?php echo $catList; ?>">
			<div class="section-content clearfix">
				<div class="product-mobile-nav">
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

						<?php
							$image_ids = get_field('libtech_outerwear_gallery', false, false);
							if ($image_ids) :
								$shortcode = '[gallery ids="' . implode(',', $image_ids) . '"]';
						?>
						<div class="product-gallery">
							<h2>In The Wild</h2>
							<?php echo do_shortcode( $shortcode ); ?>
						</div><!-- .product-gallery -->
						<?php endif; ?>

					</div><!-- END .product-desc-awards -->
				</div><!-- END .product-desc-awards-specs -->

				<?php $outerwearTech = get_field('libtech_outerwear_technology'); if( $outerwearTech ): ?>
				<div class="product-tech-major tech-major">
					<h2>Technology</h2>
					<?php echo $outerwearTech; ?>
					<div class="clearfix"></div>
				</div><!-- END .product-tech-major -->
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
	        	<div class="product-tech-minor tech-minor">
					<h2>Features</h2>
					<ul>
						<?php foreach( $technologyMinor as $techItem): ?>

						<li>
							<img src="<?php echo $techItem[2][0]; ?>" alt="<?php echo $techItem[0]; ?> Image" />
							<h4><?php echo $techItem[0]; ?></h4>
						</li>

						<?php endforeach; ?>
					</ul>
					<div class="clearfix"></div>
				</div><!-- END .product-tech-minor -->
				
				<?
					endif; // end tech minor check
				endif;// end technology check
				?>

				<div id="sizing-chart" class="product-specs">
					<h2>Sizing</h2>
					<table>
						<thead>
							<tr>
								<th>Size</th>
								<th>Height</th>
								<th>Chest</th>
								<th>Waist</th>
								<th>Inseam</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>XS</td>
								<td>5'1" - 5'4"<br />(155-162.5cm)</td>
								<td>34-36"<br />(86-91cm)</td>
								<td>28-30"<br />(71-76cm)</td>
								<td>29"<br />(74cm)</td>
							</tr>
							<tr>
								<td>S</td>
								<td>5'2"-5'6"<br />(157.5-167.5cm)</td>
								<td>36-38"<br />(91-97cm)</td>
								<td>30-32"<br />(76-81cm)</td>
								<td>30"<br />(76cm)</td>
							</tr>
							<tr>
								<td>M</td>
								<td>5'6"-5'10"<br />(167.5-178cm)</td>
								<td>38-40"<br />(97-102cm)</td>
								<td>32-34"<br />(81-86cm)</td>
								<td>31"<br />(79cm)</td>
							</tr>
							<tr>
								<td>L</td>
								<td>5'10"-6'1"<br />(178-185.5cm)</td>
								<td>40-42"<br />(101-107cm)</td>
								<td>34-36"<br />(86-91cm)</td>
								<td>32"<br />(81cm)</td>
							</tr>
							<tr>
								<td>XL</td>
								<td>5'11"-6'3"<br />(180-190.5cm)</td>
								<td>42-44"<br />(107-112cm)</td>
								<td>36-38"<br />(91-97cm)</td>
								<td>33"<br />(84cm)</td>
							</tr>
							<tr>
								<td>XXL</td>
								<td>6'2"-6'5"<br />(188-195.5)</td>
								<td>44-46"<br />(112-117cm)</td>
								<td>38-40"<br />(97-102cm)</td>
								<td>34"<br />(86cm)</td>
							</tr>
						</tbody>
					</table>
					<ul class="outerwear-fit">
						<li class="ripper-fit">
							<h3>Ripper Fit</h3>
							<p>Relaxed fit allowing room for layering to accommodate comfort and style.</p>
							<a href="/outerwear/#filter=.ripper-fit">View ripper fits</a>
						</li>
						<li class="true-action-fit">
							<h3>True Action Fit</h3>
							<p>Designed with a focus on articulation to move with your body for maximized mobility.</p>
							<a href="/outerwear/#filter=.true-action-fit">View action fits</a>
						</li>
						<li class="street-fit">
							<h3>Street Fit</h3>
							<p>Slimmer style to fit like a street pant or jacket.<br />"More hotdog, less cheeseburger" – Ted Boreland</p>
							<a href="/outerwear/#filter=.street-fit">View street fits</a>
						</li>
					</ul>
				</div><!-- .product-specs -->

			</div><!-- .section-content -->
		</section><!-- .product-extras -->

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
			</div>
		</section><!-- .product-video -->
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