<?php
/*
Template Name: Partners
*/
get_header();
?>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="bg2-top"></div>
		<section class="bg2 partners">
			<div class="section-content">
				<article <?php post_class() ?> id="page-<?php the_ID(); ?>">
					<div class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
						<?php the_content(); ?>
					</div><!-- END .entry-header -->
					<div class="entry-content">

						<?php
							$partners = Array();
							// set up repeatable function
							function findPartners($catSlug, $catName) {
								// GET ACADEMIES AND CLUBS
								$args = array(
									'post_type' => 'libtech_partners',
									'posts_per_page' => -1,
									'orderby' => 'menu_order',
									'order' => 'ASC',
									'tax_query' => array(
										array(
											'taxonomy' => 'libtech_partner_categories',
											'field' => 'slug',
											'terms' => $catSlug,
											'include_children' => false
										)
									)
								);
								$partnerList = Array();
								$loop = new WP_Query( $args );
								while ( $loop->have_posts() ) : $loop->the_post();
									$title = get_the_title();
									$content = get_the_content();
									$link = get_field('libtech_partners_link');
									$logo = get_field('libtech_partners_logo');
									$logo = wp_get_attachment_image_src($logo, 'full', false);
									$photos = array();
									while(the_repeater_field('libtech_partners_photos')):
										$partnerPhoto = get_sub_field('libtech_partners_photos_img');
										$partnerPhotoSquare = wp_get_attachment_image_src($partnerPhoto, 'square-medium', false);
										$partnerPhotoFull = wp_get_attachment_image_src($partnerPhoto, 'full', false);
										$photo = array(
											'square' => $partnerPhotoSquare,
											'full' => $partnerPhotoFull
										);
										array_push($photos, $photo);
									endwhile;
									// create new partner
									$partner = array(
										'title' => $title,
										'content' => $content,
										'link' => $link,
										'logo' => $logo,
										'photos' => $photos
									);
									array_push($partnerList, $partner);
								endwhile;
								wp_reset_query();

								if (count($partnerList) > 0) {
									// create category
									$partnerCategory = array(
										'title' => $catName,
										'partners' => $partnerList
									);
									return $partnerCategory;
								} else {
									return null;
								}
							}
							array_push($partners, findPartners('vehicles', 'Vehicles'));
							array_push($partners, findPartners('cat-heli', 'Cat Boarding/Heli'));
							array_push($partners, findPartners('parks', 'Parks'));
							array_push($partners, findPartners('camps', 'Camps'));
							array_push($partners, findPartners('non-profits', 'Non-profits'));
							array_push($partners, findPartners('academies-clubs', 'Academies/Clubs'));
							array_push($partners, findPartners('resorts', 'Resorts'));
							// display resorts
							foreach ($partners as $partnerGroup) {
								if($partnerGroup) {

									echo '<h3>' . $partnerGroup['title'] . '</h3>';
									echo '<ul>';
									foreach ($partnerGroup['partners'] as $partner) {
										// begin rendering partner list item
										echo "<li><div class=\"partner-entry\"><h4>" . $partner['title'] . "</h4><div class=\"partner-images\"><img src=\"" . $partner['logo'][0] . "\" alt=\"" . $partner['title'] . " Logo\" />";
										// render out repeated images
										foreach ($partner['photos'] as $photo) {
											echo "<a href=\"" . $photo['full'][0] . "\"><img src=\"" . $photo['square'][0] . "\" alt=\"" . $partner['title'] . " Photo\" /></a>";
										}
										// render remaining partner
										echo "</div><p>" . $partner['content'] . "</p><p><a href=\"" . $partner['link'] . "\" target=\"_blank\">view website</a></p></div></li>\n";
									}
									echo '</ul><div class="clearfix"></div>';
								}
							}
						?>
						<div class="clearfix"></div>
					</div>
					<?php libtech_comments_template(); ?>
				</article>
			</div><!-- END .section-content -->
		</section><!-- END .product-zoom -->

		<?php endwhile; endif; ?>

<?php get_footer(); ?>
