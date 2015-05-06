<?php
	get_header();
	if (have_posts()) : while (have_posts()) : the_post();
		$thePostID = $post->ID;
		$slug = $post->post_name;
		$postType = $post->post_type;
		$profilePhoto = get_field('libtech_team_profile_photo'); // libtech_team_related_products
		$profilePhoto = wp_get_attachment_image_src($profilePhoto, 'full', false);
?>
    <section class="team-details container-fluid bg1 <?php echo $slug; ?>" itemscope itemtype="http://schema.org/Person">
	  	<div class="section-content">
	  		<h1 class="col-xs-12 col-md-10 col-md-offset-1" itemprop="name"><?php the_title(); ?></h1>
    		<div class="team-gallery col-xs-12 col-md-10 col-md-offset-1">
    			<?php
      			// Photo Gallery
      			if(get_field('libtech_team_gallery')) :
      				the_field('libtech_team_gallery');
							echo "<meta itemprop=\"image\" content=\"$profilePhoto[0]\" />";
      			else:
      		?>
      		<img src="<?php echo $profilePhoto[0]; ?>" itemprop="image" alt="<?php the_title(); ?> Team Photo" width="<?php echo $profilePhoto[1]; ?>" height="<?php echo $profilePhoto[1]; ?>" class="profile-photo" />
      		<?php
      			endif;
      		?>
				</div><!-- .team-gallery -->
				<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
					<div class="team-meta">
						<?php if(get_field('libtech_team_home')) : ?><p class="ripper-home"><span><?php if($postType == 'libtech_team_skate'): echo 'Local Skatepark'; elseif($postType == 'libtech_team_surf'): echo 'Local Break'; else: echo 'Home Mountain'; endif; ?>: </span><?php the_field('libtech_team_home'); ?></p><?php endif; ?>
						<?php if(get_field('libtech_team_sponsors')) : ?><p class="ripper-sponsors"><span>Sponsors: </span><?php the_field('libtech_team_sponsors'); ?></p><?php endif; ?>
					</div>
					<h4><?php the_field('libtech_team_profile_tagline'); ?></h4>
					<div class="team-bio" itemprop="description">
						<?php the_content(); ?>
					</div>
					<ul class="social-links">
						<?php if(get_field('libtech_team_facebook_username')) : ?><li><a href="http://www.facebook.com/<?php the_field('libtech_team_facebook_username'); ?>" class="facebook" target="_blank">Facebook</a></li><?php endif; ?>
						<?php if(get_field('libtech_team_twitter_username')) : ?><li><a href="http://twitter.com/<?php the_field('libtech_team_twitter_username'); ?>" class="twitter" target="_blank">Twitter</a></li><?php endif; ?>
						<?php if(get_field('libtech_team_vimeo_username')) : ?><li><a href="http://vimeo.com/<?php the_field('libtech_team_vimeo_username'); ?>" class="vimeo" target="_blank">Vimeo</a></li><?php endif; ?>
						<?php if(get_field('libtech_team_instagram_username')) : ?><li><a href="http://instagram.com/<?php the_field('libtech_team_instagram_username'); ?>" class="instagram" target="_blank">Instagram</a></li><?php endif; ?>
	        </ul>
	        <?php if(get_field('libtech_team_personal_website')) : ?><p class="personal-site"><a href="<?php the_field('libtech_team_personal_website'); ?>" target="_blank">Personal Website</a></p><?php endif; ?>
		    </div>
		    <div class="clearfix"></div>
    	</div><!-- .section-content -->
    </section><!-- .team-details -->

		<?php include get_template_directory() . '/_/inc/modules/product-grid.php'; ?>

		<?php include get_template_directory() . '/_/inc/modules/latest-posts.php'; ?>

		<?php include get_template_directory() . '/_/inc/modules/instagram.php'; ?>

		<?php include get_template_directory() . '/_/inc/modules/featured-videos.php'; ?>

<?php
		endwhile;
	endif;
	get_footer();
?>
