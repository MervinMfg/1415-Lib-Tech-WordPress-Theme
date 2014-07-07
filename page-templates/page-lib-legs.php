<?php
/*
Template Name: Lib Legs
*/
get_header();
?>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="bg-product-skate-top"></div>
		<section class="video-header video bg-product-skate">
			<div class="section-content">
				<h1><?php the_title(); ?></h1>
				<div class="video-player">
					<div class="video-wrapper">
						<?php if (get_field('libtech_liblegs_video_id')) : $videoID = get_field('libtech_liblegs_video_id'); ?>
						<iframe src="http://player.vimeo.com/video/<?php echo $videoID; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=66CC00&amp;autoplay=1" width="640" height="360" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
						<?php endif; ?>
					</div>
				</div>
				<div class="video-text">
					<ul class="entry-share">
						<li><div class="fb-like" data-href="<? the_permalink(); ?>" data-send="true" data-layout="button_count" data-width="150" data-show-faces="false" data-colorscheme="dark" data-font="trebuchet ms"></div></li>
						<li><a href="https://twitter.com/share" class="twitter-share-button" data-via="libtechnologies">Tweet</a></li>
						<li><div class="g-plusone" data-size="medium" data-href="<? the_permalink(); ?>"></div></li>
						<li><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $GLOBALS['pageImage']; ?>&description=<?php echo $GLOBALS['pageTitle']; ?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></li>
					</ul>
					<div class="clearfix"></div>
					<?php the_content(); ?>
				</div>
				<div class="clearfix"></div>
			</div><!-- END .section-content -->
		</section><!-- END .video-header -->
		<div class="bg2-top"></div>
		<section class="featured-slider bg2">
			<div class="section-content">
				<div class="slider-wrapper">
					<ul class="bxslider">

						<?php
							if(get_field('libtech_liblegs_banners')):
								function renderBanner($banner) {
									if (strpos($banner['link'],'vimeo.com') !== false) : // display vimeo image/video
										echo '<li><a href="' . $banner['link'] . '" class="video-link"><div class="video-image"><img src="' . $banner['image'][0] . '" alt="' . $banner['altText'] . '" width="' . $banner['image'][1] . '" height="' . $banner['image'][2] . '" /></div></a></li>';
									else: // display standard image
										echo '<li><a href="' . $banner['link'] . '"><img src="' . $banner['image'][0] . '" alt="' . $banner['altText'] . '" width="' . $banner['image'][1] . '" height="' . $banner['image'][2] . '" /></a></li>';
									endif;
								}
								while(the_repeater_field('libtech_liblegs_banners')):
									$bannerImage = get_sub_field('libtech_liblegs_banners_image');
									$bannerImage = wp_get_attachment_image_src($bannerImage, 'full', false);
									$bannerlink = get_sub_field('libtech_liblegs_banners_link_url');
									$bannerAltText = get_sub_field('libtech_liblegs_banners_alt_text');

									$banner = array(
										"image" => $bannerImage,
										"link" => $bannerlink,
										"altText" => $bannerAltText
									);
									renderBanner($banner);
								endwhile;
							else:
						?>

						<li><a href="#"><img src="<?php bloginfo('template_directory'); ?>/_/img/placeholder-slider.jpg" alt="Have Kiker make a banner!" /></a></li>

						<?php
							endif;
						?>

					</ul>
				</div>
			</div><!-- END .section-content -->
			<div class="clearfix"></div>
		</section><!-- END .featured-sliders -->
		<div class="bg-product-<?php echo $GLOBALS['sport']; ?>-top"></div>
		<section class="product-slider bg-product-<?php echo $GLOBALS['sport']; ?>">
			<div class="section-content">
				<ul class="product-listing bxslider">
					<?php
						$post_objects = get_field('libtech_liblegs_featured_product');
					    if( $post_objects ):
					        // get each related product
					        foreach( $post_objects as $post_object):
					            $postType = $post_object->post_type;
					            // get variable values
					            $imageID = get_field('libtech_product_image', $post_object->ID);
					            // check which image size to use based on post type
					            $imageFile = wp_get_attachment_image_src($imageID, 'square-medium');
					            $productLink = get_permalink($post_object->ID);
					            $productTitle = get_the_title($post_object->ID);
					            // get price
					            $relatedPrice = getPrice(get_field('libtech_product_price_us', $post_object->ID), get_field('libtech_product_price_ca', $post_object->ID), get_field('libtech_product_on_sale', $post_object->ID), get_field('libtech_product_sale_percentage', $post_object->ID));
					?>

					<li>
						<a href="<? echo $productLink; ?>">
							<img src="<?php echo $imageFile[0]; ?>" width="<?php echo $imageFile[1]; ?>" height="<?php echo $imageFile[2]; ?>" alt="<?php echo $productTitle; ?> Image" />
							<div class="product-peek">
								<p class="product-title"><?php echo $productTitle; ?></p>
								<!-- <p class="product-type"></p> -->
							</div>
						</a>
					</li>

					<?
							endforeach;
						endif;
					?>
				</ul>
			</div>
		</section><!-- END .product-slider -->
		<div class="bg3-top"></div>
		<section class="homepage-posts bg3">
			<div class="section-content">
				<h2>Lib Leg Stories</h2>
				<ul>

					<?php
						$post_cat_id = get_category_by_slug(get_field('libtech_liblegs_category_slug'));
						$post_cat_id = $post_cat_id->term_id;
						$args = array(
							'category' => $post_cat_id,
							'posts_per_page' => 6
						);
						$posts_query = get_posts($args);
						$i = 0;

						foreach($posts_query as $post) :
							setup_postdata($post);
							$postImage = get_post_image('square-medium');
					?>

					<li class="homepage-post">
						<div class="post-wrapper">
							<a href="<?php the_permalink() ?>">
								<img src="<?php echo $postImage[0]; ?>" alt="Image From <?php echo get_the_title(); ?>" />
								<h3 class="post-title"><?php the_title(); ?></h3>
								<p class="post-meta">
									<time datetime="<?php the_time('c') ?>"><?php the_time('F jS, Y') ?></time> | <span><fb:comments-count href=<?php the_permalink() ?>></fb:comments-count> Comments</span>
								</p>
								<p class="post-excerpt"><?php libtech_excerpt('libtech_excerptlength_home'); ?></p>
								<p class="post-more">READ MORE</p>
							</a>
						</div>
					</li>

					<?php
							$i++;
						endforeach;
						wp_reset_postdata(); // Reset Post Data
					?>

				</ul>
			</div><!-- END .section-content -->
			<div class="clearfix"></div>
		</section><!-- END .homepage-posts -->
		<div class="bg2-top"></div>
		<section class="bg2 pass-it-on-tagboard">
			<div class="section-content">
				<h2>#liblegs Tagboard</h2>
				<div class="social-links">
					<p class="h4">Hit us up!</p>
					<ul>
						<li><a href="http://www.facebook.com/libtechskate" class="facebook" target="_blank">Facebook</a></li>
						<li><a href="http://www.instagram.com/libtechskate" class="instagram" target="_blank">Instagram</a></li>
						<li><a href="http://www.vimeo.com/libtech" class="vimeo" target="_blank">Vimeo</a></li>
						<li><a href="http://www.twitter.com/libtechskate" class="twitter" target="_blank">Twitter</a></li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<!-- START TagBoard -->
				<div id="tagboard-embed"></div>
				<script>
					var tagboardOptions = {tagboard:"liblegs/173006", darkMode: true};
				</script>
				<script src="https://tagboard.com/public/js/embed.js"></script>
				<!-- END TagBoard -->
				<?php comments_template(); ?>
			</div><!-- END .section-content -->
		</section><!-- END .tagboard -->

		<?php endwhile; endif; ?>

<?php get_footer(); ?>