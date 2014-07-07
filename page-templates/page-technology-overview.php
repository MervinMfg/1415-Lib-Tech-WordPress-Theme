<?php
/*
Template Name: Technology Overview
*/
get_header();
?>
        <div class="bg2-top"></div>
        <section class="tech-overview bg2">
            <div class="section-content">
                <div class="tech-header">
                    <h1><?php the_title(); ?></h1>
                    <?php the_content(); ?>
                </div>
                
                <?php
                $techPage = new WP_Query();
                $techPage->query('page_id=18914'); // snowboarding
                while ($techPage->have_posts()) : $techPage->the_post();
                ?>

                <div class="tech-sport">
                    <h3><?php the_title(); ?></h3>
                    <img src="<?php bloginfo('template_directory'); ?>/_/img/tech-snow.jpg" alt="Lib Tech Snowboard Technology" />
                    <div class="tech-copy">
                        <?php the_content(); ?>
                        <p class="tech-link"><a href="<?php the_permalink(); ?>">View More</a></p>
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

                <div class="tech-sport">
                    <h3><?php the_title(); ?></h3>
                    <img src="<?php bloginfo('template_directory'); ?>/_/img/tech-ski.jpg" alt="Lib Tech Ski Technology" />
                    <div class="tech-copy">
                        <?php the_content(); ?>
                        <p class="tech-link"><a href="<?php the_permalink(); ?>">View More</a></p>
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

                <div class="tech-sport">
                    <h3><?php the_title(); ?></h3>
                    <img src="<?php bloginfo('template_directory'); ?>/_/img/tech-surf.jpg" alt="Lib Tech Surf Technology" />
                    <div class="tech-copy">
                        <?php the_content(); ?>
                        <p class="tech-link"><a href="http://www.libtechwaterboarding.com/technology/" target="_blank">View More</a></p>
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

                <div class="tech-sport">
                    <h3><?php the_title(); ?></h3>
                    <img src="<?php bloginfo('template_directory'); ?>/_/img/tech-skate.jpg" alt="Lib Tech Skateboard Technology" />
                    <div class="tech-copy">
                        <?php the_content(); ?>
                        <p class="tech-link"><a href="<?php the_permalink(); ?>">View More</a></p>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <?php 
                endwhile;
                wp_reset_query();
                ?>

            </div><!-- END .section-content -->
        </section><!-- END .tech-major -->

<?php get_footer(); ?>