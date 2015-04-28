<?php
/*
Template Name: Downtown Throwdown
*/
get_header();
?>

		<div class="bg3-top"></div>
		<section class="dttd-details bg3">
			<div class="section-content">
				<h1 class="title"><img src="<?php bloginfo('template_directory'); ?>/_/img/dttd-downtown.png" alt="Downtown" class="downtown" /><img src="<?php bloginfo('template_directory'); ?>/_/img/dttd-throwdown.png" alt="Throwdown" class="throwdown" /></h1>
				<div class="dttd-times">
					<p>STREAM STARTS at</p>
					<ul>
						<li>2 pm <span>EST</span></li>
						<li>1 pm <span>CST</span></li>
						<li>12 pm <span>MST</span></li>
						<li>11 am <span>PST</span></li>
					</ul>
				</div>
				<ul class="entry-share">
					<li><div class="fb-like" data-href="<? the_permalink(); ?>" data-send="true" data-layout="button_count" data-width="150" data-action="like" data-show-faces="false" data-share="true" data-colorscheme="dark"></div></li>
					<li><a href="https://twitter.com/share" class="twitter-share-button" data-via="libtechnologies">Tweet</a></li>
					<li><div class="g-plusone" data-size="medium" data-href="<? the_permalink(); ?>"></div></li>
					<li><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $GLOBALS['pageImage']; ?>&description=<?php echo $GLOBALS['pageTitle']; ?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></li>
				</ul>
			</div><!-- END .section-content -->
			<div class="clearfix"></div>
		</section><!-- END .dttd-details -->

		<div class="bg1-top"></div>

		<?php if (date("m.d.y") > "10.17.14") : ?>

		<section class="dttd-video bg1">
			<div class="section-content">
				<div class="video-player">
					<iframe width="640" height="360" src="//www.youtube.com/embed/QZhciwhiqgE?autoplay=1&start=3363" frameborder="0" allowfullscreen></iframe>
				</div>
			</div>
		</section>

		<?php
			else:
				include get_template_directory() . '/_/inc/modules/featured-slider.php';
			endif;
		?>

		<div class="bg3-top"></div>
		<section class="bg3 dttd-contest">
			<div class="section-content">
				<h2>Enter to win</h2>
				<p class="h3">Win yourself what Burtner and the Boxscratchers run all year <a href="http://woobox.com/u973wz" target="_blank">Click to enter</a></p>
				<div class="dttd-iou">
					<a href="http://woobox.com/u973wz" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/_/img/dttd-iou.png" alt="I.O.U. this stuff" /></a>
				</div>
				<ul class="product-listing">
					<?php
						$post_objects = get_field('libtech_dttd_products');
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
					            $relatedPrice = getPrice(get_field('libtech_product_price_us', $post_object->ID), get_field('libtech_product_price_ca', $post_object->ID), get_field('libtech_product_price_eur', $post_object->ID), get_field('libtech_product_on_sale', $post_object->ID), get_field('libtech_product_sale_percentage', $post_object->ID));
					?>

					<li class="product-item">
                        <a href="<? echo $productLink; ?>">
                            <img src="<?php echo $imageFile[0]; ?>" width="<?php echo $imageFile[1]; ?>" height="<?php echo $imageFile[2]; ?>" alt="<?php echo $productTitle; ?> Image" />
                            <h5><?php echo $productTitle; ?></h5>
                            <div class="price"><?php echo $relatedPrice; ?></div>
                        </a>
                    </li>

					<?
							endforeach;
						endif;
					?>
				</ul>
				<div class="clearfix"></div>
			</div>
		</section>
		<div class="bg1-top"></div>
		<section class="bg1 lbs-contest">
			<div class="section-content">
				<h2 id="hashtag">#DTTD</h2>
				<div class="social-links">
					<p class="h4">Hit us up!</p>
					<ul>
						<li><a href="http://www.facebook.com/libtech" class="facebook" target="_blank">Facebook</a></li>
						<li><a href="http://www.instagram.com/libtechnologies" class="instagram" target="_blank">Instagram</a></li>
						<li><a href="http://www.vimeo.com/libtech" class="vimeo" target="_blank">Vimeo</a></li>
						<li><a href="http://www.twitter.com/libtechnologies" class="twitter" target="_blank">Twitter</a></li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<!-- START TagBoard -->
				<div id="tagboard-embed"></div>
				<script>
					var tagboardOptions = {tagboard:"DTTD/193610", darkMode: true};
				</script>
				<script src="https://tagboard.com/public/js/embed.js"></script>
				<!-- END TagBoard -->
			</div><!-- END .section-content -->
			<div class="clearfix"></div>
		</section><!-- END .homepage-sports -->

<?php get_footer(); ?>
