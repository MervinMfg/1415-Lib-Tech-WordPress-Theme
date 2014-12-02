<?php
/*
Template Name: Jamie Lynn Collection
*/
get_header();
?>
        
        

        <div class="bg3-top"></div>
        <section class="product-overview bg3">
            <div class="section-content">
                <h1><?php the_title(); ?></h1>
                <ul class="product-listing snowboards">

                    <?php
                    // GET SNOWBOARDS
                    $imageSize = "square-large";
                    $args = array(
                        'post_type' => "libtech_snowboards",
                        'posts_per_page' => -1,
                        'orderby' => 'menu_order',
                        'order' => 'ASC',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'libtech_snowboard_categories',
                                'field' => 'slug',
                                'terms' => array('jamie-lynn-collection'),
                                'include_children' => false
                            )
                        )
                    );
                    $loop = new WP_Query( $args );
                    while ( $loop->have_posts() ) : $loop->the_post();
                        $imageID = get_field('libtech_product_image');
                        $productImage = wp_get_attachment_image_src($imageID, $imageSize);
                        // grab default price of all other products
                        $productPrice = getPrice( get_field('libtech_product_price_us'), get_field('libtech_product_price_ca'), get_field('libtech_product_price_eur'), get_field('libtech_product_on_sale'), get_field('libtech_product_sale_percentage') );
                    ?>

                    <li class="product-item">
                        <a href="<? echo the_permalink(); ?>">
                            <img src="<?php echo $productImage[0]; ?>" width="<?php echo $productImage[1]; ?>" height="<?php echo $productImage[2]; ?>" alt="<?php echo the_title(); ?> Image" class="product-img" />
                            <div class="colorways">
                                <?php
                                    // get colorway
                                    if(get_field('libtech_snowboard_options')):
                                        while(the_repeater_field('libtech_snowboard_options')):
                                            $optionColor = get_the_title();
                                            if (get_sub_field('libtech_snowboard_options_name')) {
                                                $optionColor .= " " . get_sub_field('libtech_snowboard_options_name');
                                            }
                                            $optionSlug = str_replace(' ', '-', strtolower($optionColor));
                                            $optionSlug = str_replace('&#8243;', '', strtolower($optionSlug));
                                            $optionSlug = str_replace('ñ', 'n', strtolower($optionSlug));
                                            $optionSlug = str_replace('.', '_', strtolower($optionSlug));
                                            $optionSlug = 'snowboards/' . str_replace('/', '', strtolower($optionSlug));
                                            // grab image
                                            if(get_sub_field('libtech_snowboard_options_images')):
                                                while(the_repeater_field('libtech_snowboard_options_images')):
                                                    $optionImage = get_sub_field('libtech_snowboard_options_images_img');
                                                    $optionImage = wp_get_attachment_image_src($optionImage, $imageSize);
                                ?>
                                <div class="swatch" data-src="<?php echo $optionImage[0]; ?>"><img src="<?php bloginfo('template_directory'); ?>/_/img/colorways/<?php echo $optionSlug; ?>.jpg" alt="<?php echo $optionColor; ?>" /></div>
                                <?php
                                                    break;
                                                endwhile;
                                            endif;
                                        endwhile;
                                    endif;
                                ?>
                            </div>
                            <h5><?php the_title(); ?></h5>
                            <div class="price"><?php echo $productPrice; ?></div>
                        </a>
                    </li>

                    <?php
                    endwhile;
                    wp_reset_query();
                    ?>
                </ul>
                <div class="clearfix"></div>
                <h1><?php the_title(); ?></h1>
                <ul class="product-listing apparel">

                    <?php
                    // GET APPAREL
                    $imageSize = "square-medium";
                    $args = array(
                        'post_type' => "libtech_apparel",
                        'posts_per_page' => -1,
                        'orderby' => 'menu_order',
                        'order' => 'ASC',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'libtech_apparel_categories',
                                'field' => 'slug',
                                'terms' => array('jamie-lynn-collection'),
                                'include_children' => false
                            )
                        )
                    );
                    $loop = new WP_Query( $args );
                    while ( $loop->have_posts() ) : $loop->the_post();
                        $imageID = get_field('libtech_product_image');
                        $productImage = wp_get_attachment_image_src($imageID, $imageSize);
                        // grab default price of all other products
                        $productPrice = getPrice( get_field('libtech_product_price_us'), get_field('libtech_product_price_ca'), get_field('libtech_product_price_eur'), get_field('libtech_product_on_sale'), get_field('libtech_product_sale_percentage') );
                    ?>

                    <li class="product-item">
                        <a href="<? echo the_permalink(); ?>">
                            <img src="<?php echo $productImage[0]; ?>" width="<?php echo $productImage[1]; ?>" height="<?php echo $productImage[2]; ?>" alt="<?php echo the_title(); ?> Image" class="product-img" />
                            <div class="colorways">
                                <?php
                                // get colorways
                                if(get_field('libtech_apparel_images')):
                                    $colorways = Array();
                                    while(the_repeater_field('libtech_apparel_images')):
                                        $optionColor = get_sub_field('libtech_apparel_images_color');
                                        $optionSlug = str_replace(' ', '-', strtolower($optionColor));
                                        $optionSlug = 'apparel/' . str_replace('/', '', strtolower($optionSlug));
                                        $optionImage = get_sub_field('libtech_apparel_images_image');
                                        $optionImage = wp_get_attachment_image_src($optionImage, $imageSize);
                                        // don't add duplicate colors
                                        $colorFound = false;
                                        foreach ($colorways as $colorway) {
                                            if ($optionColor == $colorway) {
                                                $colorFound = true;
                                            }
                                        }
                                        if (!$colorFound) {
                                            array_push($colorways, $optionColor);
                                ?>
                                <div class="swatch" data-src="<?php echo $optionImage[0]; ?>"><img src="<?php bloginfo('template_directory'); ?>/_/img/colorways/<?php echo $optionSlug; ?>.jpg" alt="<?php echo $optionColor; ?>" /></div>
                                <?php
                                        }
                                    endwhile;
                                endif;
                                ?>
                            </div>
                            <h5><?php the_title(); ?></h5>
                            <div class="price"><?php echo $productPrice; ?></div>
                        </a>
                    </li>

                    <?php
                    endwhile;
                    wp_reset_query();
                    ?>
                </ul>
            </div>
            <div class="clearfix"></div>
        </section><!-- end product overview -->
<?php get_footer(); ?>