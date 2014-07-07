<?php
/*
Template Name: Surfboard Fins
*/
get_header();
?>
        <div class="bg2-top"></div>
        <section class="fins-adjusting bg2">
            <div class="section-content">
                <h1><?php the_title(); ?></h1>
                <h3>F.O.C. "Freedom of Choice" multi-fin system</h3>
                <p>Compatible with 5/8" performance tuning adjustability</p>
                <ul class="fins-positioning">
                    <li>
                        <div class="fin-image">
                            <img src="<?php bloginfo('template_directory'); ?>/_/img/surf-5-fin-1.png" width="800" height="450" alt="5 Fin Box Configuration - Centered" />
                        </div>
                        <div class="fin-description">
                            <p class="h4">Fins centered</p>
                            <p>Start by positioning fins in the center of each micro-option slot.</p>
                            <p>You can fine-tune for wave conditions or your surfing style.</p>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    <li>
                        <div class="fin-image">
                            <img src="<?php bloginfo('template_directory'); ?>/_/img/surf-5-fin-2.png" width="800" height="450" alt="5 Fin Box Configuration - Together" />
                        </div>
                         <div class="fin-description">
                            <p class="h4">Fins closer together</p>
                            <p>Bring fins closer together for looser surfing.</p>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    <li>
                        <div class="fin-image">
                            <img src="<?php bloginfo('template_directory'); ?>/_/img/surf-5-fin-3.png" width="800" height="450" alt="5 Fin Box Configuration - Apart" />
                        </div>
                         <div class="fin-description">
                            <p class="h4">Fins further apart</p>
                            <p>Spread fins apart for longer arcs.</p>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    <li>
                        <div class="fin-image">
                            <img src="<?php bloginfo('template_directory'); ?>/_/img/surf-5-fin-4.png" width="800" height="450" alt="5 Fin Box Configuration - Asymmetric" />
                        </div>
                        <div class="fin-description">
                            <p class="h4">Fins positioned asymmetric</p>
                            <p>Play with asymmetric fin positioning just because you can.</p>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div><!-- END .section-content -->
        </section><!-- END .fins-includes -->
        <div class="bg3-top"></div>
        <section class="fins-includes bg3">
            <div class="section-content">
                <h2>Each Waterboard Includes</h2>
                <ul class="fins-breakdown">
                    <li>
                        <div>
                            <p>2 M.I.L.F. Technology side fins</p>
                            <img src="<?php bloginfo('template_directory'); ?>/_/img/surf-fins-milf.png" width="320" height="320" alt="M.I.L.F. Side Fin" />
                        </div>
                    </li>
                    <li>
                        <div>
                            <p>1 Lib Standard Trailing fin</p>
                            <img src="<?php bloginfo('template_directory'); ?>/_/img/surf-fin-trailing.png" width="320" height="320" alt="Lib Trailing Fin" />
                        </div>
                    </li>
                    <li>
                        <div>
                            <p>1 special bonus Spinfly Trailing fin</p>
                            <p>(1 extra Spinfly with 5 fin option)</p>
                            <img src="<?php bloginfo('template_directory'); ?>/_/img/surf-fin-spinfly.png" width="320" height="320" alt="Lib Tech Spinfly Trailing Fin" />
                        </div>
                    </li>
                    <li class="last">
                        <div>
                            <p>1 Lib Tech fin key</p>
                            <img src="<?php bloginfo('template_directory'); ?>/_/img/surf-fin-keys.png" width="320" height="320" alt="Lib Tech Fin Keys" />
                        </div>
                    </li>
                </ul>
                <div class="clearfix"></div>
                <div class="fins-more-info">
                    <p>Bonus Spinfly Trailing fins are good for extra glide speed in small waves, spinning and flying.</p>
                    <p>*Always claim any spinning activity whether intentional or not*</p>
                </div>
                <div class="clearfix"></div>
            </div><!-- END .section-content -->
        </section><!-- END .fins-includes -->
        <div class="bg1-top"></div>
        <section class="fins-candy bg1">
            <div class="section-content">
                <h2>Fin Candy</h2>
                <ul>
                    <li>
                        <p>Each 3 Fin Box Board includes 4 adjustable fins featuring 2 M.I.L.F. Technology side fins, 1 Lib Standard Trailing fin, and 1 special bonus Spinfly Trailing fin.</p>
                        <img src="<?php bloginfo('template_directory'); ?>/_/img/surf-fins-board-3-fin.png" width="640" height="445" alt="Waterboard with 3 Fins" />
                    </li>
                    <li>
                        <p>Each 5 Fin Box Board includes 5 adjustable fins featuring 2 M.I.L.F. Technology side fins, 1 Lib Standard Trailing fin, and 2 special bonus Spinfly Trailing fins.</p>
                        <img src="<?php bloginfo('template_directory'); ?>/_/img/surf-fins-board-5-fin.png" width="640" height="445" alt="Waterboard with 5 Fins" />
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div><!-- END .section-content -->
        </section><!-- END .fins-candy -->
        <?php
            // get each post under taxonimy type
            $args = array(
                'tax_query' => array(
                    array(
                        'taxonomy' => 'libtech_faqs_categories',
                        'field' => 'slug',
                        'terms' => 'surf-fins'
                    )
                )
            );
            $loop = new WP_Query( $args );
            // check to see if we have any FAQ to display
            if ($loop->have_posts()) :
                $columnOnePostNum = ceil($loop->post_count / 2);
        ?>
        <div class="bg2-top"></div>
        <section class="tech-faq bg2">
            <div class="section-content">
                <div class="faq-list">
                    <h2>FAQ</h2>
                    <ul>
                        <?php
                            $i = 0;
                            // get first set of posts
                            while ( $loop->have_posts() ) : $loop->the_post();
                                if ($i < $columnOnePostNum) {
                                    $custom = get_post_custom($post->ID);
                                    $content = apply_filters('the_content', get_the_content());
                                    $content = str_replace(']]>', ']]&gt;', $content);
                                    echo "\n\t\t\t\t\t<li class=\"faq-question\">\n\t\t\t\t\t\t<a href=\"#\" class=\"question\"><span></span>". get_the_title() ."</a>\n\t\t\t\t\t\t<div class=\"answer\">".$content."</div>\n\t\t\t\t\t</li>\n";
                                } else {
                                    break;
                                }
                                $i++; // incriment loop
                            endwhile;
                        ?>
                    </ul>
                    <ul>
                        <?php
                            // redo loop again
                            $loop = new WP_Query( $args );
                            $i = 0;
                            // get the remaining posts
                            while ( $loop->have_posts() ) : $loop->the_post();
                                if ($i >= $columnOnePostNum) {
                                    $custom = get_post_custom($post->ID);
                                    $content = apply_filters('the_content', get_the_content());
                                    $content = str_replace(']]>', ']]&gt;', $content);
                                    echo "\n\t\t\t\t\t<li class=\"faq-question\">\n\t\t\t\t\t\t<a href=\"#\" class=\"question\"><span></span>". get_the_title() ."</a>\n\t\t\t\t\t\t<div class=\"answer\">".$content."</div>\n\t\t\t\t\t</li>\n";
                                }
                                $i++; // incriment loop
                            endwhile;
                        ?>
                    </ul>
                </div><!-- END .faq-list -->
                <div class="clearfix"></div>
            </div><!-- END .section-content -->
        </section><!-- END .tech-faq -->
        <?php
            endif;
            wp_reset_query();
        ?>
<?php get_footer(); ?>