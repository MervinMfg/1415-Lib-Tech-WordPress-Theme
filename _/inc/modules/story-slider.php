<?php if ( basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) ) header('Location: /'); // do not allow stanalone viewing ?>

		<section class="story-slider">
			<div class="section-content">
				<div class="slider-wrapper">
					<ul class="bxslider">
						<?php
							// if(get_field('libtech_featured_silder')):
							// 	$featuresArray = array();
							// 	$promosArray = array();
							// 	$snowArray = array();
							// 	$skiArray = array();
							// 	$surfArray = array();
							// 	$skateArray = array();
							// 	$generalArray = array();
							//
							// 	function renderBanner($banner) {
							// 		if (strpos($banner['link'],'vimeo.com') !== false) : // display vimeo image/video
							// 			echo '<li><a href="' . $banner['link'] . '" class="video-link"><div class="video-image"><img src="' . $banner['image']['url'] . '" alt="' . $banner['altText'] . '" width="' . $banner['image']['width'] . '" height="' . $banner['image']['height'] . '" /></div></a></li>';
							// 		else: // display standard image
							// 			echo '<li><a href="' . $banner['link'] . '"><img src="' . $banner['image']['url'] . '" alt="' . $banner['altText'] . '" width="' . $banner['image']['width'] . '" height="' . $banner['image']['height'] . '" /></a></li>';
							// 		endif;
							// 	}
							//
							// 	while(the_repeater_field('libtech_featured_silder')):
							// 		$bannerImage = get_sub_field('libtech_featured_silder_image');
		       	// 					//$bannerImage = wp_get_attachment_image_src($bannerImage, 'full', false);
		       	// 					$bannerlink = get_sub_field('libtech_featured_silder_link_url');
		       	// 					$bannerAltText = get_sub_field('libtech_featured_silder_alt_text');
		       	// 					$bannerCategory = get_sub_field('libtech_featured_silder_cat');
							//
		       	// 					$banner = array(
							// 			"image" => $bannerImage,
							// 			"link" => $bannerlink,
							// 			"altText" => $bannerAltText,
							// 			"category" => $bannerCategory
							// 		);
							//
							// 		switch ($banner['category']) {
							// 			case 'features':
							// 				array_push($featuresArray, $banner);
							// 				break;
							// 			case 'promos':
							// 				array_push($promosArray, $banner);
							// 				break;
							// 			case 'snow':
							// 				array_push($snowArray, $banner);
							// 				array_push($generalArray, $banner);
							// 				break;
							// 			case 'ski':
							// 				array_push($skiArray, $banner);
							// 				array_push($generalArray, $banner);
							// 				break;
							// 			case 'surf':
							// 				array_push($surfArray, $banner);
							// 				array_push($generalArray, $banner);
							// 				break;
							// 			case 'skate':
							// 				array_push($skateArray, $banner);
							// 				array_push($generalArray, $banner);
							// 				break;
							// 		}
							// 	endwhile;
							// 	// display featured banners
							// 	if(!empty($featuresArray)):
							// 		foreach( $featuresArray as $banner):
			       // 						renderBanner($banner);
							// 		endforeach;
							// 	endif;
							// 	// display promos
							// 	if(!empty($promosArray)):
							// 		shuffle($promosArray);
							// 		renderBanner($promosArray[0]);
							// 	endif;
							// 	// CHECK FOR HOMEPAGE OR SPORT HOMEPAGE
							// 	if (is_page_template('page-templates/home-sport.php')) {
							// 		// we're on a sport homepage
							// 		// render general general display of all categories
							// 		if(!empty($generalArray)):
							// 			shuffle($generalArray);
							// 			renderBanner($generalArray[0]);
							// 			// if more than 1 render a second
							// 			if(count($generalArray) > 1):
							// 				renderBanner($generalArray[1]);
							// 			endif;
							// 		endif;
							// 	} else {
							// 		// we're on the main homepage, render each sport
							// 		// display snow
							// 		if(!empty($snowArray)):
							// 			shuffle($snowArray);
							// 			renderBanner($snowArray[0]);
							// 		endif;
							// 		// display ski
							// 		if(!empty($skiArray)):
							// 			shuffle($skiArray);
							// 			renderBanner($skiArray[0]);
							// 		endif;
							// 		// display surf
							// 		if(!empty($surfArray)):
							// 			shuffle($surfArray);
							// 			renderBanner($surfArray[0]);
							// 		endif;
							// 		// display skate
							// 		if(!empty($skateArray)):
							// 			shuffle($skateArray);
							// 			renderBanner($skateArray[0]);
							// 		endif;
							// 	}
							// else:
						?>

						<li>
							<a href="#"><img src="<?php bloginfo('template_directory'); ?>/_/img/placeholder-slider.jpg" alt="Have Kiker make a banner!" /></a>
							<div class="story-slider-copy col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
								<h3>Lib Tech Kraftsmen</h3>
								<p>The best hands in the business. Our kraftsmen love their jobs and are constantly at work developing and riding boards. This year we worked on projects that took us forward, and back into the depths of creativity and snowboard design.</p>
							</div>
							<div class="clearfix"></div>
							<div class="call-to-action">
								<a href="#" class="button">Learn More</a>
							</div>
						</li>

						<?php
							// endif;
						?>
					</ul>
				</div>
			</div><!-- END .full-width -->
		</section><!-- END .featured-slider -->
