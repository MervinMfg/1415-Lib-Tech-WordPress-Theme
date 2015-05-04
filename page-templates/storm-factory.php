<?php
/*
Template Name: Storm Factory
*/
get_header();
?>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php include get_template_directory() . '/_/inc/modules/featured-slider.php'; ?>

		<?php include get_template_directory() . '/_/inc/modules/product-slider.php'; ?>

		<section class="storm-factory-overview container-fluid">
			<div class="section-content row">
				<div class="overview-content-wrapper">
					<div class="storm-image col-xs-12 col-md-10 col-md-offset-1">
						<img src="<?php bloginfo('template_directory'); ?>/_/img/storm-factory-blizzard.jpg" alt="Storm Factory Blizzard" />
					</div>
					<div class="storm-copy col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
						<?php the_content(); ?>
					</div>
				</div><!-- .overview-content-wrapper -->
			</div><!-- END .section-content -->
			<div class="clearfix"></div>
		</section><!-- END .storm-factory-overview -->
		<div class="bg1-top"></div>
		<section class="product-extras bg1">
			<div class="section-content">
				<div class="product-tech-minor tech-minor">
					<h2>Features</h2>
					<ul>

					<?php
						$args = array(
							'post_type' => 'libtech_technology',
							'posts_per_page' => -1,
							'orderby' => 'menu_order',
							'order' => 'ASC',
							'tax_query' => array(
								array(
									'taxonomy' => 'libtech_technology_categories',
									'field' => 'slug',
									'terms' => 'outerwear'
								)
							)
						);
						$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post();
							$imageID = get_field("libtech_technology_icon");
							$imageFile = wp_get_attachment_image_src($imageID, 'full');
							// don't render waterproofing
							if(strpos(get_the_title(), 'Waterproofing') == false ):
					?>

					<li>
						<img src="<?php echo $imageFile[0]; ?>" alt="<?php the_title(); ?> Image" />
						<h4><?php the_title(); ?></h4>
					</li>

					<?php
							endif;
						endwhile;
						wp_reset_query();
					?>

					</ul>
					<div class="clearfix"></div>
				</div><!-- END .product-tech-minor -->
			</div><!-- END .section-content -->
		</section><!-- END .product-extras -->
		<div class="bg2-top"></div>
		<section class="product-extras bg2 jackets">
			<div class="section-content">
				<div class="product-specs">
					<h2>Sizing</h2>
					<h3 class="sizing-header">Jacket Sizing</h3>
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
					<h3 class="sizing-header">Pants Sizing</h3>
					<table class="pants-sizing">
						<thead>
							<tr>
								<th>Size</th>
								<th>Waist</th>
								<th>Inseam</th>
								<th>Height</th>
								<th>Chest</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>XS</td>
								<td>28-30"<br />(71-76cm)</td>
								<td>29"<br />(74cm)</td>
								<td>5'1" - 5'4"<br />(155-162.5cm)</td>
								<td>34-36"<br />(86-91cm)</td>
							</tr>
							<tr>
								<td>S</td>
								<td>30-32"<br />(76-81cm)</td>
								<td>30"<br />(76cm)</td>
								<td>5'2"-5'6"<br />(157.5-167.5cm)</td>
								<td>36-38"<br />(91-97cm)</td>
							</tr>
							<tr>
								<td>M</td>
								<td>32-34"<br />(81-86cm)</td>
								<td>31"<br />(79cm)</td>
								<td>5'6"-5'10"<br />(167.5-178cm)</td>
								<td>38-40"<br />(97-102cm)</td>
							</tr>
							<tr>
								<td>L</td>
								<td>34-36"<br />(86-91cm)</td>
								<td>32"<br />(81cm)</td>
								<td>5'10"-6'1"<br />(178-185.5cm)</td>
								<td>40-42"<br />(101-107cm)</td>
							</tr>
							<tr>
								<td>XL</td>
								<td>36-38"<br />(91-97cm)</td>
								<td>33"<br />(84cm)</td>
								<td>5'11"-6'3"<br />(180-190.5cm)</td>
								<td>42-44"<br />(107-112cm)</td>
							</tr>
							<tr>
								<td>XXL</td>
								<td>38-40"<br />(97-102cm)</td>
								<td>34"<br />(86cm)</td>
								<td>6'2"-6'5"<br />(188-195.5)</td>
								<td>44-46"<br />(112-117cm)</td>
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
		</section><!-- END .product-extras -->

		<?php endwhile; endif; ?>

<?php get_footer(); ?>
