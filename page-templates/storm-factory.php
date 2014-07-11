<?php
/*
Template Name: Storm Factory
*/
get_header();
?>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php include get_template_directory() . '/_/inc/modules/featured-slider.php'; ?>

		<div class="bg-product-<?php echo $GLOBALS['sport']; ?>-top"></div>
		<section class="product-slider bg-product-<?php echo $GLOBALS['sport']; ?>">
			<div class="section-content">
				<ul class="product-listing bxslider">
					<?php
						// Get Outerwear
						$args = array(
							'post_type' => "libtech_outerwear",
							'posts_per_page' => -1,
							'orderby' => 'menu_order',
							'order' => 'ASC',
						);
						$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post();
							$postType = $post->post_type;
							$imageID = get_field('libtech_product_image');
							$imageFile = wp_get_attachment_image_src($imageID, 'square-medium');
					?>

					<li>
						<a href="<? the_permalink(); ?>">
							<img src="<?php echo $imageFile[0]; ?>" width="<?php echo $imageFile[1]; ?>" height="<?php echo $imageFile[2]; ?>" alt="<?php the_title(); ?> Image" />
							<div class="product-peek">
								<p class="product-title"><?php the_title(); ?></p>
								<p class="product-type"><?php the_field('libtech_snowboard_contour'); ?></p>
							</div>
						</a>
					</li>

					<?
						endwhile;
						wp_reset_query();
					?>
				</ul>
			</div>
		</section><!-- END .product-slider -->

		
		
		<div class="bg3-top"></div>
		<section class="storm-factory-overview bg3">
			<div class="section-content">
				<img src="<?php bloginfo('template_directory'); ?>/_/img/storm-factory-blizzard.jpg" alt="Storm Factory Blizzard" />
				<?php the_content(); ?>
			</div><!-- END .section-content -->
			<div class="clearfix"></div>
		</section><!-- END .homepage-posts -->


		<div class="bg1-top"></div>
		<section class="homepage-posts bg1">
			<div class="section-content">
				<h2>Features</h2>
			</div><!-- END .section-content -->
		</section><!-- END .xxxx -->

		<div class="bg2-top"></div>
		<section class="homepage-posts bg2">
			<div class="section-content">
				<div class="product-specs">
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
			</div><!-- END .section-content -->
		</section><!-- END .xxxx -->



		<div class="bg3-top"></div>
		<section class="bg3 pass-it-on-tagboard">
			<div class="section-content">
				<h2>#stormfactory Tagboard</h2>
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