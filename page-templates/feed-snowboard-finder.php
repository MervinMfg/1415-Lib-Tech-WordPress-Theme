<?php
/*
Template Name: Snowboard Finder Data
*/
header('Content-Type: application/json');
$imageSize = "square-large";
$args = array(
	'post_type' => 'libtech_snowboards',
	'posts_per_page' => -1,
	'orderby' => 'menu_order',
	'order' => 'ASC'
);
$productsArray = Array();
// Get Products
$loop = new WP_Query( $args );
if (have_posts()) :
	while ( $loop->have_posts() ) :
		$loop->the_post();
		// get variations
		$productVariations = Array();
		if(get_field('libtech_snowboard_options')):
			while(the_repeater_field('libtech_snowboard_options')):
				$optionVariations = get_sub_field('libtech_snowboard_options_variations');
				// get colorways
				$colorwayArray = Array();
				$optionColor = get_the_title();
				if (get_sub_field('libtech_snowboard_options_name')) {
					$optionColor .= " " . get_sub_field('libtech_snowboard_options_name');
				}
				$optionSlug = str_replace(' ', '-', strtolower($optionColor));
				$optionSlug = str_replace('&#8243;', '', strtolower($optionSlug));
				$optionSlug = str_replace('ñ', 'n', strtolower($optionSlug));
				$optionSlug = str_replace('.', '_', strtolower($optionSlug));
				$optionSlug = 'snowboards/' . str_replace('/', '', strtolower($optionSlug));
				// grab image
				if(get_sub_field('libtech_snowboard_options_images')):
					while(the_repeater_field('libtech_snowboard_options_images')):
						$optionImage = get_sub_field('libtech_snowboard_options_images_img');
						$optionImage = wp_get_attachment_image_src($optionImage, $imageSize);
						$colorwayArray = Array(
							'color' => $optionColor,
							'slug' => $optionSlug,
							'img' => $optionImage
						);
						break;
					endwhile;
				endif;
				$productVariation = Array();
				// loop through variations
				for ($i = 0; $i < count($optionVariations); $i++) {
					$productVariation['width'] = $optionVariations[$i]['libtech_snowboard_options_variations_width'];
					$productVariation['length'] = $optionVariations[$i]['libtech_snowboard_options_variations_length'];
					$productVariation['sku'] = $optionVariations[$i]['libtech_snowboard_options_variations_sku'];
					$variationAvailableUS = $optionVariations[$i]['libtech_snowboard_options_variations_availability_us'];
					$variationAvailableCA = $optionVariations[$i]['libtech_snowboard_options_variations_availability_ca'];
					$variationAvailableEU = $optionVariations[$i]['libtech_snowboard_options_variations_availability_eur'];
					$productVariation['available'] = getAvailability($productVariation['sku'], $variationAvailableUS, $variationAvailableCA, $variationAvailableEU);
					$productVariation['colorway'] = $colorwayArray['color'];
					$productVariation['colorwaySlug'] = $colorwayArray['slug'];
					$productVariation['colorwayImg'] = $colorwayArray['img'];
					array_push($productVariations, $productVariation);
				}
			endwhile;
		endif;
		if(get_field('libtech_snowboard_specs')):
			while(the_repeater_field('libtech_snowboard_specs')):
				$productArray = Array();
				$productArray['title'] = get_the_title();
				$productArray['length'] = get_sub_field('libtech_snowboard_specs_length');
				$productArray['width'] = get_sub_field('libtech_snowboard_specs_width');
				$productArray['waistWidth'] = get_sub_field('libtech_snowboard_specs_waist_width');
				$productArray['slug'] = $post->post_name;
				$productArray['link'] = get_permalink($post->ID);
				// $productArray['slogan'] = htmlspecialchars(get_field('libtech_product_slogan'), ENT_QUOTES); // issues with quotes
				$productArray['price'] = Array('us' => get_field('libtech_product_price_us'), 'ca' => get_field('libtech_product_price_ca'), 'eu' => get_field('libtech_product_price_eur'));
				$productArray['flex'] = get_sub_field('libtech_snowboard_specs_flex_rating');
				$productArray['minWeight'] = get_sub_field('libtech_snowboard_specs_weight_range');
				$productArray['contour'] = get_field('libtech_snowboard_contour');
				$productArray['terrain'] = Array(
					'jib' => get_field('libtech_terrain_snow_jib'),
					'park' => get_field('libtech_terrain_snow_park'),
					'allMountain' => get_field('libtech_terrain_snow_all_mountain'),
					'powder' => get_field('libtech_terrain_snow_powder')
				);
				$productArray['ability'] = Array(
					'beginner' => get_field('libtech_ability_beginner'),
					'intermediate' => get_field('libtech_ability_intermediate'),
					'advanced' => get_field('libtech_ability_advanced'),
					'expert' => get_field('libtech_ability_expert')
				);
				$imageID = get_field('libtech_product_image');
				//$productArray['imageFile'] = wp_get_attachment_image_src($imageID, $imageSize);
				$productArray['variations'] = Array();
				for ($i = 0; $i < count($productVariations); $i++) {
					if ($productArray['width'] == $productVariations[$i]['width'] && $productArray['length'] == $productVariations[$i]['length']) {
						array_push($productArray['variations'], $productVariations[$i]);
					}
				}
				array_push($productsArray, $productArray);
			endwhile;
		endif;
	endwhile;
endif;
wp_reset_query();
echo json_encode($productsArray);
?>
