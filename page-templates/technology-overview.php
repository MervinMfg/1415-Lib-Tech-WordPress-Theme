<?php
/*
Template Name: Technology Overview
*/
get_header();
?>
        <div class="bg2-top"></div>
        <section class="overview-wrapper bg2 container-fluid">
            <div class="section-content row">
                <div class="overview-header clearfix">
                    <h1 class="col-xs-12 col-md-10 col-md-offset-1"><?php the_title(); ?></h1>
                    <?php the_content(); ?>
                </div>
                <div class="overview-section-wrapper">

                    <?php
                    $techPage = new WP_Query();
                    $techPage->query('page_id=18914'); // snowboarding
                    while ($techPage->have_posts()) : $techPage->the_post();
                    ?>
                    <div class="overview-item clearfix">
                      <div class="overview-sport col-xs-12 col-md-10 col-md-offset-1">
                        <h3><?php the_title(); ?></h3>
                        <img src="<?php bloginfo('template_directory'); ?>/_/img/tech-snow.jpg" alt="Lib Tech Snowboard Technology" />
                      </div>
                      <div class="overview-copy col-xs-12 col-md-8 col-md-offset-2">
                        <?php the_content(); ?>
                        <div class="call-to-action">
                          <p class="overview-link"><a href="<?php the_permalink(); ?>" class="button">View More</a></p>
                        </div>
                      </div>
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

                    <div class="overview-item clearfix">
                      <div class="overview-sport col-xs-12 col-md-10 col-md-offset-1">
                        <h3><?php the_title(); ?></h3>
                        <img src="<?php bloginfo('template_directory'); ?>/_/img/tech-ski.jpg" alt="Lib Tech Ski Technology" />
                      </div>
                      <div class="overview-copy col-xs-12 col-md-8 col-md-offset-2">
                        <?php the_content(); ?>
                        <div class="call-to-action">
                          <p class="overview-link"><a href="<?php the_permalink(); ?>" class="button">View More</a></p>
                        </div>
                      </div>
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

                    <div class="overview-item clearfix">
                      <div class="overview-sport col-xs-12 col-md-10 col-md-offset-1">
                        <h3><?php the_title(); ?></h3>
                        <img src="<?php bloginfo('template_directory'); ?>/_/img/tech-surf.jpg" alt="Lib Tech Surf Technology" />
                      </div>
                      <div class="overview-copy col-xs-12 col-md-8 col-md-offset-2">
                        <?php the_content(); ?>
                        <div class="call-to-action">
                          <p class="overview-link"><a href="<?php the_permalink(); ?>" class="button">View More</a></p>
                        </div>
                      </div>
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

                    <div class="overview-item clearfix">
                      <div class="overview-sport col-xs-12 col-md-10 col-md-offset-1">
                        <h3><?php the_title(); ?></h3>
                        <img src="<?php bloginfo('template_directory'); ?>/_/img/tech-skate.jpg" alt="Lib Tech Skateboard Technology" />
                      </div>
                      <div class="overview-copy col-xs-12 col-md-8 col-md-offset-2">
                        <?php the_content(); ?>
                        <div class="call-to-action">
                          <p class="overview-link"><a href="<?php the_permalink(); ?>" class="button">View More</a></p>
                        </div>
                      </div>
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
