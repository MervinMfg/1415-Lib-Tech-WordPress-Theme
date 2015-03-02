<?php
/*
Template Name: Technology Overview
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
                    $techPage = new WP_Query();
                    $techPage->query('page_id=18914'); // snowboarding
                    while ($techPage->have_posts()) : $techPage->the_post();
                    ?>

                    <div class="overview-sport">
                        <h3><?php the_title(); ?></h3>
                        <img src="<?php bloginfo('template_directory'); ?>/_/img/tech-snow.jpg" alt="Lib Tech Snowboard Technology" />
                        <div class="overview-copy">
                            <?php the_content(); ?>
                            <p class="overview-link"><a href="<?php the_permalink(); ?>">View More</a></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <?php 
                    endwhile;
                    wp_reset_query();
                    ?>

                    <?php
                    $techPage = new WP_Query();
                    $techPage->query('page_id=18916'); // skiing
                    while ($techPage->have_posts()) : $techPage->the_post();
                    ?>

                    <div class="overview-sport">
                        <h3><?php the_title(); ?></h3>
                        <img src="<?php bloginfo('template_directory'); ?>/_/img/tech-ski.jpg" alt="Lib Tech Ski Technology" />
                        <div class="overview-copy">
                            <?php the_content(); ?>
                            <p class="overview-link"><a href="<?php the_permalink(); ?>">View More</a></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <?php 
                    endwhile;
                    wp_reset_query();
                    ?>

                    <?php
                    $techPage = new WP_Query();
                    $techPage->query('page_id=18918'); // surfing
                    while ($techPage->have_posts()) : $techPage->the_post();
                    ?>

                    <div class="overview-sport">
                        <h3><?php the_title(); ?></h3>
                        <img src="<?php bloginfo('template_directory'); ?>/_/img/tech-surf.jpg" alt="Lib Tech Surf Technology" />
                        <div class="overview-copy">
                            <?php the_content(); ?>
                            <p class="overview-link"><a href="http://www.libtechwaterboarding.com/technology/" target="_blank">View More</a></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <?php 
                    endwhile;
                    wp_reset_query();
                    ?>

                    <?php
                    $techPage = new WP_Query();
                    $techPage->query('page_id=18912'); // skateboarding
                    while ($techPage->have_posts()) : $techPage->the_post();
                    ?>

                    <div class="overview-sport">
                        <h3><?php the_title(); ?></h3>
                        <img src="<?php bloginfo('template_directory'); ?>/_/img/tech-skate.jpg" alt="Lib Tech Skateboard Technology" />
                        <div class="overview-copy">
                            <?php the_content(); ?>
                            <p class="overview-link"><a href="<?php the_permalink(); ?>">View More</a></p>
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
        </section><!-- END .overview-wrapper technology -->

<?php get_footer(); ?>