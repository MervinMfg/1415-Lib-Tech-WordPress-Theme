<?php
/*
Template Name: Team Overview
*/
get_header();
?>
        <div class="bg2-top"></div>
        <section class="overview-wrapper bg2">
            <div class="section-content">
                <div class="overview-header">
                    <h1><?php the_title(); ?></h1>
                    <?php the_content(); ?>
                </div>
                <div class="overview-section-wrapper">
                    <?php
                    $teamPage = new WP_Query();
                    $teamPage->query('page_id=17841'); // snowboarding
                    while ($teamPage->have_posts()) : $teamPage->the_post();
                    ?>

                    <div class="overview-sport">
                        <h3><?php the_title(); ?></h3>
                        <img src="<?php bloginfo('template_directory'); ?>/_/img/team-overview-snow.jpg" alt="Lib Tech Snowboard Team" />
                        <div class="overview-copy">
                            <?php the_content(); ?>
                            <p class="overview-link"><a href="<?php the_permalink(); ?>">View <?php the_title(); ?></a></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <?php
                    endwhile;
                    wp_reset_query();
                    ?>

                    <?php
                    $teamPage = new WP_Query();
                    $teamPage->query('page_id=18925'); // skateboarding
                    while ($teamPage->have_posts()) : $teamPage->the_post();
                    ?>

                    <div class="overview-sport">
                        <h3><?php the_title(); ?></h3>
                        <img src="<?php bloginfo('template_directory'); ?>/_/img/team-overview-skate.jpg" alt="Lib Tech Skateboard Team" />
                        <div class="overview-copy">
                            <?php the_content(); ?>
                            <p class="overview-link"><a href="<?php the_permalink(); ?>">View <?php the_title(); ?></a></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <?php
                    endwhile;
                    wp_reset_query();
                    ?>

                    <?php
                    $teamPage = new WP_Query();
                    $teamPage->query('page_id=18927'); // surfing
                    while ($teamPage->have_posts()) : $teamPage->the_post();
                    ?>

                    <div class="overview-sport">
                        <h3><?php the_title(); ?></h3>
                        <img src="<?php bloginfo('template_directory'); ?>/_/img/team-overview-surf.jpg" alt="Lib Tech Surf Team" />
                        <div class="overview-copy">
                            <?php the_content(); ?>
                            <p class="overview-link"><a href="<?php the_permalink(); ?>">View <?php the_title(); ?></a></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <?php
                    endwhile;
                    wp_reset_query();
                    ?>

                    <?php
                    $teamPage = new WP_Query();
                    $teamPage->query('page_id=18923'); // skiing
                    while ($teamPage->have_posts()) : $teamPage->the_post();
                    ?>

                    <div class="overview-sport">
                        <h3><?php the_title(); ?></h3>
                        <img src="<?php bloginfo('template_directory'); ?>/_/img/team-overview-ski.jpg" alt="Lib Tech Ski Team" />
                        <div class="overview-copy">
                            <?php the_content(); ?>
                            <p class="overview-link"><a href="<?php the_permalink(); ?>">View <?php the_title(); ?></a></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <?php
                    endwhile;
                    wp_reset_query();
                    ?>

                </div><!-- .overview-section-wrapper -->
                <div class="clearfix"></div>
            </div><!-- END .section-content -->
        </section><!-- END .team-overview -->

<?php get_footer(); ?>
