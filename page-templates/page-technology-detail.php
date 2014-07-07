<?php
/*
Template Name: Technology Detail
*/
get_header();

$parent = get_page($post->post_parent);
$parentSlug = $parent->post_name;

switch ($parentSlug) {
    case "skiing":
        $categorySlug = "nas";
        $faqSlug = "ski-technology";
        break;
    case "skateboarding":
        $categorySlug = "skateboards";
        $faqSlug = "skate-technology";
        break;
    case "surfing":
        $categorySlug = "surfboards";
        $faqSlug = "surf-technology";
        break;
    default:
        $categorySlug = "snowboards";
        $faqSlug = "snow-technology";
}
?>
        <div class="bg-product-<?php echo $GLOBALS['sport']; ?>-top"></div>
        <section class="video-header video bg-product-<?php echo $GLOBALS['sport']; ?>">
            <div class="section-content">
                <h1><?php the_title(); ?></h1>
                <div class="video-player">
                    <div class="video-wrapper">
                        <?php if (get_field('libtech_tech_video_id')) : $videoID = get_field('libtech_tech_video_id'); ?>
                        <iframe src="http://player.vimeo.com/video/<?php echo $videoID; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=66CC00" width="640" height="360" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                        <?php elseif ($categorySlug == "snowboards"): ?>
                        <img src="<?php bloginfo('template_directory'); ?>/_/img/tech-snow.jpg" alt="Lib Tech Snowboard Technology" />
                        <?php elseif ($categorySlug == "nas"): ?>
                        <img src="<?php bloginfo('template_directory'); ?>/_/img/tech-ski.jpg" alt="Lib Tech NAS Technology" />
                        <?php elseif ($categorySlug == "surfboards"): ?>
                        <img src="<?php bloginfo('template_directory'); ?>/_/img/tech-surf.jpg" alt="Lib Tech Surf Technology" />
                        <?php elseif ($categorySlug == "skateboards"): ?>
                        <img src="<?php bloginfo('template_directory'); ?>/_/img/tech-skate.jpg" alt="Lib Tech Skate Technology" />
                        <?php endif; ?>
                    </div>
                </div>
                <div class="video-text">
                    <?php the_content(); ?>
                </div>
                <div class="clearfix"></div>
            </div><!-- END .section-content -->
        </section><!-- END .video-header -->
        <?php if ($parentSlug != "surfing" && $parentSlug != "skateboarding"): ?>
        <div class="bg2-top"></div>
        <section class="tech-major bg2">
            <div class="section-content">
                <ul>
                    <?php
                    // get the major tech items
                    $args = array(
                        'post_type' => 'libtech_technology',
                        'posts_per_page' => -1,
                        'orderby' => 'menu_order',
                        'order' => 'ASC',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'libtech_technology_categories',
                                'field' => 'slug',
                                'terms' => $categorySlug
                            )
                        )
                    );
                    $loop = new WP_Query( $args );
                    while ( $loop->have_posts() ) : $loop->the_post();
                        // check if item is major
                        if(get_field("libtech_technology_type") == "Major"):
                            $videoID = get_field("libtech_technology_video");
                    ?>
                    <li>
                        <div class="tech-video">
                            <iframe src="http://player.vimeo.com/video/<?php echo $videoID; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=fff100" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                        </div>
                        <div class="tech-copy">
                            <h4><?php the_title(); ?></h4>
                            <?php the_content(); ?>
                            <div class="tech-found-on">
                                <h5>Found On:</h5>
                                <ul>
                                    <?php
                                        $relatedItems = get_field('libtech_technology_related_products');
                                        if( $relatedItems ):
                                            foreach( $relatedItems as $relatedItem):
                                    ?>
                                    <li><a href="<? echo get_permalink( $relatedItem->ID ); ?>"><? echo $relatedItem->post_title; ?></a></li>
                                    <?php
                                            endforeach;
                                        endif;
                                    ?>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    <?php
                        endif;
                    endwhile;
                    wp_reset_query();
                    ?>
                </ul>
                <div class="clearfix"></div>
            </div><!-- END .section-content -->
        </section><!-- END .tech-major -->
        <?php endif; // end not surfing check ?>
        <?php if ($parentSlug == "surfing"): ?>
        <div class="bg1-top"></div>
        <section class="tech-surf bg1">
            <div class="section-content">
                <h2>Dang Difficult to Ding</h2>
                <div class="ddd-image">
                    <img src="<?php bloginfo('template_directory'); ?>/_/img/surf-dang-difficult-to-ding.gif" width="640" height="360" alt="Man on bike rides over Waterboard" />
                </div>
                <ul>
                    <li>
                        <p>Years of composite panel impact testing went into our unique combination of fibers, Basalt and Resin systems.</p>
                    </li>
                    <li>
                        <p>Voted toughest board of the year by Outside Magazine.</p>
                    </li>
                    <li>
                        <p>Crossing the street or the globe, tougher surfboards - free your mind!</p>
                    </li>
                    <li>
                        <p>If you do ding it, you don't have to get out of the water. Our core doesn't take on water.</p>
                    </li>
                </ul>
            </div><!-- END .section-content -->
        </section><!-- END .surf-tech -->
        <?php endif; // end surfing check ?>
        <div class="bg3-top"></div>
        <section class="tech-minor bg3">
            <div class="section-content">
                <h2>Ingredients</h2>
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
                                'terms' => $categorySlug
                            )
                        )
                    );
                    $loop = new WP_Query( $args );
                    while ( $loop->have_posts() ) : $loop->the_post();
                        // check if item is major
                        if(get_field("libtech_technology_type") == "Minor"):
                            $imageID = get_field("libtech_technology_icon");
                            $imageFile = wp_get_attachment_image_src($imageID, 'thumbnail');
                    ?>
                    <li>
                        <div class="tech-pad">
                            <h4><img src="<?php echo $imageFile[0]; ?>" /><span><?php the_title(); ?></span></h4>
                            <div class="tech-copy">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </li>
                    <?php
                            endif;
                        endwhile;
                        wp_reset_query();
                    ?>
                </ul>
            </div><!-- END .section-content -->
        </section><!-- END .tech-minor -->
        <?php
            // get each post under taxonimy type
            $args = array(
                'tax_query' => array(
                    array(
                        'taxonomy' => 'libtech_faqs_categories',
                        'field' => 'slug',
                        'terms' => $faqSlug
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