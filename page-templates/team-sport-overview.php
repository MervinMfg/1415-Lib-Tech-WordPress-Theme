<?php
/*
Template Name: Team Sport Overview
*/
get_header();

if (have_posts()) :
    while (have_posts()) :
        the_post();
        $videoID = get_field('libtech_team_overview_video');
?>
        <section class="video-header <?php if ($videoID) { echo " video"; }; ?> container-fluid bg-texture-gradient">
            <div class="section-content row">
                <h1 class="<?php echo $GLOBALS['sport']; ?> col-xs-12"><?php the_title(); ?></h1>

                <?php
                    // display video if we have an id
                    if( $videoID ):
                ?>
                <div class="video-player col-xs-12">
                    <div class="video-wrapper">
                        <iframe src="http://player.vimeo.com/video/<?php echo $videoID; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=fff100" width="640" height="360" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                    </div>
                </div>
                <?php
                    endif;
                ?>
                <div class="video-text col-xs-12 col-md-8 col-md-offset-2">
                    <?php the_content(); ?>
                </div>
                <div class="clearfix"></div>
            </div><!-- END .section-content -->
        </section><!-- END .team-header -->

        <section class="team-members container-fluid">
            <div class="section-content row">
              <ul>

                <?php
                // check for parent
                if($post->post_parent) {
                  $post_data = get_post($post->post_parent);
                  $pageSlug = $post_data->post_name;
                } else {
                  $pageSlug = $post->post_name;
                }
                // select correct post type based on slug
                switch ($pageSlug) {
                  case 'snowboarding':
                    $postType = "libtech_team_snow";
                    $postTax = "libtech_team_snow_cat";
                    $postCat = "snow";
                    $teamUrl = "/snowboarding/team/";
                    break;
                  case 'skateboarding':
                    $postType = "libtech_team_skate";
                    $postTax = "libtech_team_skate_cat";
                    $postCat = "skate";
                    $teamUrl = "/skateboarding/team/";
                    break;
                  case 'surfing':
                    $postType = "libtech_team_surf";
                    $postTax = "libtech_team_surf_cat";
                    $postCat = "surf";
                    $teamUrl = "/surfing/team/";
                    break;
                  case 'skiing':
                    $postType = "libtech_team_nas";
                    $postTax = "libtech_team_nas_cat";
                    $postCat = "ski";
                    $teamUrl = "/skiing/team/";
                    break;
                }
                $args = array(
                  'post_type' => $postType,
                  'posts_per_page' => -1,
                  'orderby' => 'menu_order',
                  'order' => 'ASC'
                );
                    $loop = new WP_Query( $args );
                    while ( $loop->have_posts() ) : $loop->the_post();
                        $profilePhoto = get_field('libtech_team_profile_photo');
                        $profilePhoto = wp_get_attachment_image_src($profilePhoto, 'square-medium', false);
                        $categories = get_the_terms($post->ID , $postTax);
                ?>

                <li class="col-xs-6 col-ms-3 col-sm-3 col-md-3">
                    <a href="<?php the_permalink(); ?>" class="team-item-link">
                      <div class="team-member-image">
                        <div class="team-item-info">
          								<div class="vertical-center">
          									<h4 class="team-item-name"><?php the_title(); ?></h4>
                            <?php if($categories) : ?>
          									<p class="team-item-category">
          										<?php
          											$j = 0;
          											foreach($categories as $category) :
          												if($j != 0) echo ', ';
          												echo $category->name;
          												$j++;
          											endforeach;
          										?>
          									</p>
          									<?php endif; ?>
          								</div>
          							</div>
                        <img src="<?php echo $profilePhoto[0]; ?>" alt="<?php the_title(); ?> Profile" />
                      </div>
                    </a>
                </li>

                <?php
                    endwhile;
                    wp_reset_query();
                ?>
              </ul>
              <div class="clearfix"></div>
            </div><!-- END .section-content -->
        </section><!-- END .team-header -->
<?php
    endwhile;
endif;
get_footer();
?>
