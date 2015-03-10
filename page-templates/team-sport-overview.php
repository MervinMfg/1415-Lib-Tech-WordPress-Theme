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
        <div class="bg-product-<?php echo $GLOBALS['sport']; ?>-top"></div>
        <section class="video-header bg-product-<?php echo $GLOBALS['sport']; if ($videoID) { echo " video"; }; ?>">
            <div class="section-content">
                <h1><?php the_title(); ?></h1>

                <?php
                    // display video if we have an id
                    if( $videoID ):
                ?>
                <div class="video-player">
                    <div class="video-wrapper">
                        <iframe src="http://player.vimeo.com/video/<?php echo $videoID; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=fff100" width="640" height="360" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                    </div>
                </div>
                <?php
                    endif;
                ?>
                <div class="video-text">
                    <?php the_content(); ?>
                </div>
                <div class="clearfix"></div>
            </div><!-- END .section-content -->
        </section><!-- END .team-header -->
        <div class="bg3-top"></div>
        <section class="team-members bg3">
            <div class="section-content">
                <?php if (is_tree('6886')) : // check if this is within snowboarding ?>
                <ul>
                    <?php
                        $args = array(
                            'post_type' => 'libtech_team_snow',
                            'posts_per_page' => -1,
                            'orderby' => 'menu_order',
                            'order' => 'ASC',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'libtech_team_snow_cat',
                                    'field' => 'slug',
                                    'terms' => 'rippers',
                                    'include_children' => false
                                )
                            )
                        );
                        $loop = new WP_Query( $args );
                        while ( $loop->have_posts() ) : $loop->the_post();
                            $profilePhoto = get_field('libtech_team_profile_photo');
                            $profilePhoto = wp_get_attachment_image_src($profilePhoto, 'square-medium', false);
                    ?>

                    <li>
                        <a href="<?php the_permalink(); ?>">
                            <div class="team-member-image">
                                <img src="<?php echo $profilePhoto[0]; ?>" alt="<?php the_title(); ?> Profile" />
                            </div>
                            <h3><?php the_title(); ?></h3>
                        </a>
                    </li>

                    <?php
                        endwhile;
                        wp_reset_query();
                    ?>
                </ul>
                <div class="clearfix"></div>
                <h2>Legendary Rippers</h2>
                <ul>
                    <?php
                        $args = array(
                            'post_type' => 'libtech_team_snow',
                            'posts_per_page' => -1,
                            'orderby' => 'menu_order',
                            'order' => 'ASC',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'libtech_team_snow_cat',
                                    'field' => 'slug',
                                    'terms' => 'legendary-rippers',
                                    'include_children' => false
                                )
                            )
                        );
                        $loop = new WP_Query( $args );
                        while ( $loop->have_posts() ) : $loop->the_post();
                            $profilePhoto = get_field('libtech_team_profile_photo');
                            $profilePhoto = wp_get_attachment_image_src($profilePhoto, 'square-medium', false);
                    ?>

                    <li>
                        <a href="<?php the_permalink(); ?>">
                            <div class="team-member-image">
                                <img src="<?php echo $profilePhoto[0]; ?>" alt="<?php the_title(); ?> Profile" />
                            </div>
                            <h3><?php the_title(); ?></h3>
                        </a>
                    </li>

                    <?php
                        endwhile;
                        wp_reset_query();
                    ?>

                </ul>
                <div class="clearfix"></div>
                <h2>Euro Rippers</h2>
                <ul>
                    <?php
                        $args = array(
                            'post_type' => 'libtech_team_snow',
                            'posts_per_page' => -1,
                            'orderby' => 'menu_order',
                            'order' => 'ASC',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'libtech_team_snow_cat',
                                    'field' => 'slug',
                                    'terms' => 'euro-rippers',
                                    'include_children' => false
                                )
                            )
                        );
                        $loop = new WP_Query( $args );
                        while ( $loop->have_posts() ) : $loop->the_post();
                            $profilePhoto = get_field('libtech_team_profile_photo');
                            $profilePhoto = wp_get_attachment_image_src($profilePhoto, 'square-medium', false);
                    ?>

                    <li>
                        <a href="<?php the_permalink(); ?>">
                            <div class="team-member-image">
                                <img src="<?php echo $profilePhoto[0]; ?>" alt="<?php the_title(); ?> Profile" />
                            </div>
                            <h3><?php the_title(); ?></h3>
                        </a>
                    </li>

                    <?php
                        endwhile;
                        wp_reset_query();
                    ?>
                </ul>
                <div class="clearfix"></div>
                <h2>AM Rippers</h2>
                <ul>
                    <?php
                        $args = array(
                            'post_type' => 'libtech_team_snow',
                            'posts_per_page' => -1,
                            'orderby' => 'menu_order',
                            'order' => 'ASC',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'libtech_team_snow_cat',
                                    'field' => 'slug',
                                    'terms' => 'ams-rippers',
                                    'include_children' => false
                                )
                            )
                        );
                        $loop = new WP_Query( $args );
                        while ( $loop->have_posts() ) : $loop->the_post();
                            $profilePhoto = get_field('libtech_team_profile_photo');
                            $profilePhoto = wp_get_attachment_image_src($profilePhoto, 'square-medium', false);
                    ?>

                    <li>
                        <a href="<?php the_permalink(); ?>">
                            <div class="team-member-image">
                                <img src="<?php echo $profilePhoto[0]; ?>" alt="<?php the_title(); ?> Profile" />
                            </div>
                            <h3><?php the_title(); ?></h3>
                        </a>
                    </li>

                    <?php
                        endwhile;
                        wp_reset_query();
                    ?>

                </ul>
                <div class="clearfix"></div>
                <h2>experiMENTAL Rippers</h2>
                <ul>
                    <?php
                        $args = array(
                            'post_type' => 'libtech_team_snow',
                            'posts_per_page' => -1,
                            'orderby' => 'menu_order',
                            'order' => 'ASC',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'libtech_team_snow_cat',
                                    'field' => 'slug',
                                    'terms' => 'experimental-rippers',
                                    'include_children' => false
                                )
                            )
                        );
                        $loop = new WP_Query( $args );
                        while ( $loop->have_posts() ) : $loop->the_post();
                            $profilePhoto = get_field('libtech_team_profile_photo');
                            $profilePhoto = wp_get_attachment_image_src($profilePhoto, 'square-medium', false);
                    ?>

                    <li>
                        <a href="<?php the_permalink(); ?>">
                            <div class="team-member-image">
                                <img src="<?php echo $profilePhoto[0]; ?>" alt="<?php the_title(); ?> Profile" />
                            </div>
                            <h3><?php the_title(); ?></h3>
                        </a>
                    </li>

                    <?php
                        endwhile;
                        wp_reset_query();
                    ?>

                </ul>
                <div class="clearfix"></div>
                <?php else: ?>
                <ul>
                    <?php
                        if (is_tree('18925')) {
                            // check if this is within skateboarding
                            $postType = "libtech_team_skate";
                        } else if (is_tree('11418')) {
                            // check if this is within surfing
                            $postType = "libtech_team_surf";
                        } else {
                            $postType = "libtech_team_nas";
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
                    ?>

                    <li>
                        <a href="<?php the_permalink(); ?>">
                            <div class="team-member-image">
                                <img src="<?php echo $profilePhoto[0]; ?>" alt="<?php the_title(); ?> Profile" />
                            </div>
                            <h3><?php the_title(); ?></h3>
                        </a>
                    </li>

                    <?php
                        endwhile;
                        wp_reset_query();
                    ?>
                </ul>
                <div class="clearfix"></div>
                <?php endif; ?>
            </div><!-- END .section-content -->
        </section><!-- END .team-header -->
<?php
    endwhile;
endif;
get_footer();
?>
