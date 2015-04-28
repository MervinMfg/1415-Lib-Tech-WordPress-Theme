<?php if ( basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) ) header('Location: /'); // do not allow stanalone viewing ?>
<?php if(get_field('libtech_featured_silder')): ?>

		<section class="featured-slider">
			<div class="section-content">
				<div class="slider-wrapper">
					<div class="owl-carousel owl-theme-libtech">

						<?php
								$featuresArray = array();
								$promosArray = array();
								$snowArray = array();
								$skiArray = array();
								$surfArray = array();
								$skateArray = array();
								$generalArray = array();
								// check for vimeo or youtube
								function checkLinkForVideo($url) {
									$flag = false;
									if(strpos($url, 'vimeo.com') || strpos($url, 'youtube.com')) {
										$flag = true;
									}
									return $flag;
								}
								// method for rendering each banner
								function renderBanner($banner) {
						?>

						<div class="slide cta-theme-<?php echo $banner['ctaTheme']; ?>">
							<div class="content-small">
								<a href="<?php echo $banner['link']; ?>"<?php if(checkLinkForVideo($banner['link'])) { echo ' class="video-link"'; } ?>>
									<img src="<?php bloginfo('template_directory'); ?>/_/img/featured-slider-small.gif" data-src="<?php echo $banner['imageSmall']['url']; ?>" width="<?php echo $banner['imageSmall']['width']; ?>" height="<?php echo $banner['imageSmall']['height']; ?>" alt="<?php echo $banner['altText']; ?>" class="lazy" />
								</a>
							</div>
							<div class="content-large">
								<a href="<?php echo $banner['link']; ?>"<?php if(checkLinkForVideo($banner['link'])) { echo ' class="video-link"'; } ?>>
									<img src="<?php bloginfo('template_directory'); ?>/_/img/featured-slider-large.gif" data-src="<?php echo $banner['imageLarge']['url']; ?>" width="<?php echo $banner['imageLarge']['width']; ?>" height="<?php echo $banner['imageLarge']['height']; ?>" alt="<?php echo $banner['altText']; ?>" class="lazy" />
								</a>
							</div>
							<ul class="content-ctas">
								<?php foreach( $banner['ctas'] as $cta): ?>
								<li class="cta"><a href="<?php echo $cta['url']; ?>" class="button<?php if(checkLinkForVideo($cta['url'])) { echo ' video-link'; } ?>"><?php echo $cta['text']; ?><?php if(checkLinkForVideo($cta['url'])) { echo ' <span class="icon-play"></span>'; } ?></a></li>
								<?php endforeach; ?>
							</ul>
						</div>

						<?php
								} // end renderBanner

								while(the_repeater_field('libtech_featured_silder')):
									$bannerImageSmall = get_sub_field('libtech_featured_slider_image_small');
									$bannerImageLarge = get_sub_field('libtech_featured_silder_image');
       						$bannerlink = get_sub_field('libtech_featured_silder_link_url');
       						$bannerAltText = get_sub_field('libtech_featured_silder_alt_text');
       						$bannerCategory = get_sub_field('libtech_featured_silder_cat');
									$bannerCtaTheme = get_sub_field('libtech_featured_slider_cta_theme');
									$bannerCtas = [];
									if(get_sub_field('libtech_featured_slider_cta')) {
										while(the_repeater_field('libtech_featured_slider_cta')):
											$ctaText = get_sub_field('libtech_featured_slider_cta_text');
											$ctaLink = get_sub_field('libtech_featured_slider_cta_url');
											array_push($bannerCtas, array('text' => $ctaText, 'url' => $ctaLink) );
										endwhile;
									}
       						$banner = array(
										"imageSmall" => $bannerImageSmall,
										"imageLarge" => $bannerImageLarge,
										"link" => $bannerlink,
										"altText" => $bannerAltText,
										"category" => $bannerCategory,
										"ctaTheme" => $bannerCtaTheme,
										"ctas" => $bannerCtas
									);

									switch ($banner['category']) {
										case 'features':
											array_push($featuresArray, $banner);
											break;
										case 'promos':
											array_push($promosArray, $banner);
											break;
										case 'snow':
											array_push($snowArray, $banner);
											array_push($generalArray, $banner);
											break;
										case 'ski':
											array_push($skiArray, $banner);
											array_push($generalArray, $banner);
											break;
										case 'surf':
											array_push($surfArray, $banner);
											array_push($generalArray, $banner);
											break;
										case 'skate':
											array_push($skateArray, $banner);
											array_push($generalArray, $banner);
											break;
									}
								endwhile;
								// display featured banners
								if(!empty($featuresArray)):
									foreach( $featuresArray as $banner):
			       						renderBanner($banner);
									endforeach;
								endif;
								// display promos
								if(!empty($promosArray)):
									shuffle($promosArray);
									renderBanner($promosArray[0]);
								endif;
								// CHECK FOR HOMEPAGE OR SPORT HOMEPAGE
								if (is_page_template('page-templates/home-sport.php')) {
									// we're on a sport homepage
									// render general general display of all categories
									if(!empty($generalArray)):
										shuffle($generalArray);
										renderBanner($generalArray[0]);
										// if more than 1 render a second
										if(count($generalArray) > 1):
											renderBanner($generalArray[1]);
										endif;
									endif;
								} else {
									// we're on the main homepage, render each sport
									// display snow
									if(!empty($snowArray)):
										shuffle($snowArray);
										renderBanner($snowArray[0]);
									endif;
									// display ski
									if(!empty($skiArray)):
										shuffle($skiArray);
										renderBanner($skiArray[0]);
									endif;
									// display surf
									if(!empty($surfArray)):
										shuffle($surfArray);
										renderBanner($surfArray[0]);
									endif;
									// display skate
									if(!empty($skateArray)):
										shuffle($skateArray);
										renderBanner($skateArray[0]);
									endif;
								}
						?>
					</div>
				</div>
			</div><!-- END .section-content -->
			<div class="clearfix"></div>
		</section><!-- END .featured-slider -->

<?php endif; ?>
