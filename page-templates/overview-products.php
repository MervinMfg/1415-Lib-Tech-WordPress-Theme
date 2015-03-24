<?php
/*
Template Name: Products Overview
*/
get_header();
?>
        <?php
        // GET FEATURED PRODUCTS
        $post_objects = get_field('libtech_featured_products');
        if( $post_objects ):
        ?>
        <div class="<?php if (get_the_title() == "Outerwear") echo 'bg-product-outerwear-top '; ?>bg-product-<?php echo $GLOBALS['sport']; ?>-top"></div>
        <section class="featured-product-slider <?php if (get_the_title() == "Outerwear") echo 'bg-product-outerwear '; ?>bg-product-<?php echo $GLOBALS['sport']; ?> <?php echo strtolower(get_the_title()); ?>">
            <div class="section-content">
                <ul class="product-listing bxslider">

                    <?php if($post_objects[0]->post_type == 'libtech_snowboards') : ?>
                    <li>
                        <div class="product-image">
                            <a href="/snowboarding/snowboard-builder/"><img src="<?php bloginfo('template_directory'); ?>/_/img/square.gif" data-src="<?php bloginfo('template_directory'); ?>/_/img/diy-board-builder-640x640.png" width="640" height="640" alt="DIY Snowboard Builder" class="lazy" /></a>
                        </div>
                        <div class="product-copy">
                            <div class="title h2">DIY Board Builder</div>
                            <p class="slogan h4">Build your dream snowboard!</p>
                            <div class="description">
                                <p>This dream snowboard project is probably going to cause us some headaches, but you are going to be stoked! Lib Tech's DIY Board Builder offers you the opportunity to order a custom, one of a kind, dream snowboard that will be guided through our experiMENTAL Division’s prototyping process and handcrafted to your specifications in the USA.</p>
                            </div>
                            <div class="price"></div>
                            <a href="/snowboarding/snowboard-builder/" class="buy build h4">Build Your Own!</a>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    <?php endif; ?>

                    <?php if($post_objects[0]->post_type == 'libtech_outerwear') : ?>
                    <li class="storm-factory-slide">
                        <div class="product-image">
                            <a href="/storm-factory/"><img src="<?php bloginfo('template_directory'); ?>/_/img/square.gif" data-src="<?php bloginfo('template_directory'); ?>/_/img/storm-factory-jesse-burtner-640x640.png" width="640" height="640" alt="DIY Snowboard Builder" class="lazy" /></a>
                        </div>
                        <div class="product-copy">
                            <div class="title h2">Storm Factory</div>
                            <p class="slogan h4">Storms don't suck... They blow!</p>
                            <div class="description">
                                <p>Huge winter storms generated in the North Pacific's Aleutian Low "Storm Factory" relentlessly pound the entire western half of North America delivering snow from the coastal ranges all the way to the rockies. Storm Factory outerwear is inspired by a lifetime building and riding boards directly in the Cyclones's path. Storms dont suck, they blow!</p>
                            </div>
                            <div class="price"></div>
                            <a href="/storm-factory/" class="buy h4">Storm Factory</a>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    <?php endif; ?>

                    <?php
                    // get each related product
                    foreach( $post_objects as $post_object):
                        $postType = $post_object->post_type;
                        // get variable values
                        $imageID = get_field('libtech_product_image', $post_object->ID);
                        // check which image size to use based on post type
                        if($postType == "libtech_snowboards" || $postType == "libtech_nas" || $postType == "libtech_skateboards" || $postType == "libtech_outerwear") {
                            $productImage = wp_get_attachment_image_src($imageID, 'square-large');
                        } else {
                            $productImage = wp_get_attachment_image_src($imageID, 'square-medium');
                        }
                        $productLink = get_permalink($post_object->ID);
                        $productTitle = get_the_title($post_object->ID);
                        $productContent = apply_filters('the_content', $post_object->post_content);
                        $productTag = get_field('libtech_product_slogan', $post_object->ID);
                        // check if we're surf because of varrying fin costs
                        if ($postType == "libtech_surfboards") {
                            // check fin pricing and what to display by default
                            if (get_field('libtech_product_price_us_5fin', $post_object->ID) == "") {
                                $productPrice = getPrice(
                                  get_field('libtech_product_price_us', $post_object->ID),
                                  get_field('libtech_product_price_ca', $post_object->ID),
                                  get_field('libtech_product_price_eur', $post_object->ID),
                                  get_field('libtech_product_on_sale', $post_object->ID),
                                  get_field('libtech_product_sale_percentage', $post_object->ID),
                                  false
                                );
                            } else {
                                $productPrice = getPrice(
                                  get_field('libtech_product_price_us_5fin', $post_object->ID),
                                  get_field('libtech_product_price_ca_5fin', $post_object->ID),
                                  get_field('libtech_product_price_eur_5fin', $post_object->ID),
                                  get_field('libtech_product_on_sale', $post_object->ID),
                                  get_field('libtech_product_sale_percentage', $post_object->ID),
                                  false
                                );
                            }
                        } else {
                            // grab default price of all other products
                            $productPrice = getPrice(
                              get_field('libtech_product_price_us', $post_object->ID),
                              get_field('libtech_product_price_ca', $post_object->ID),
                              get_field('libtech_product_price_eur', $post_object->ID),
                              get_field('libtech_product_on_sale', $post_object->ID),
                              get_field('libtech_product_sale_percentage', $post_object->ID),
                              false
                            );
                        }
                    ?>
                    <li>
                        <div class="product-image">
                            <a href="<?php echo $productLink; ?>"><img src="<?php bloginfo('template_directory'); ?>/_/img/square.gif" data-src="<?php echo $productImage[0]; ?>" width="<?php echo $productImage[1]; ?>" height="<?php echo $productImage[2]; ?>" alt="<?php echo $productTitle; ?> Image" class="lazy" /></a>
                        </div>
                        <div class="product-copy">
                            <div class="title h2"><?php echo $productTitle; ?></div>
                            <?php if($postType == "libtech_snowboards"): ?><div class="contour h3"><?php the_field('libtech_snowboard_contour', $post_object->ID); ?></div><?php endif; ?>
                            <p class="slogan h4"><?php echo $productTag; ?></p>
                            <div class="description">
                                <?php echo $productContent; ?>
                            </div>
                            <?php echo $productPrice; ?>
                            <a href="<?php echo $productLink; ?>" class="buy h4">Learn More!</a>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="clearfix"></div>
        </section><!-- END .product-slider -->
        <?php endif; ?>

        <?php
        $productsArray = Array();
        // find product post type to query
        switch (get_the_title()) {
            case "Snowboards":
                $imageSize = "square-large";
                $args = array(
                    'post_type' => "libtech_snowboards",
                    'posts_per_page' => -1,
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                );
                break;
            case "Skis":
                $imageSize = "square-large";
                $args = array(
                    'post_type' => "libtech_nas",
                    'posts_per_page' => -1,
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                );
                break;
            case "Surfboards":
                $imageSize = "square-medium";
                $args = array(
                    'post_type' => "libtech_surfboards",
                    'posts_per_page' => -1,
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                );
                break;
            case "Skateboards":
                $imageSize = "square-large";
                $args = array(
                    'post_type' => "libtech_skateboards",
                    'posts_per_page' => -1,
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                );
                break;
            case "Outerwear":
                $imageSize = "square-large";
                $args = array(
                    'post_type' => array( 'libtech_outerwear', 'libtech_apparel' ),
                    'posts_per_page' => -1,
                    'orderby' => 'menu_order',
                    'order' => 'ASC',
                    'tax_query' => array(
                        'relation' => 'OR',
                        array(
                            'taxonomy' => 'libtech_outerwear_categories',
                            'field' => 'slug',
                            'terms' => array('jackets', 'pants'),
                            'include_children' => false
                        ),
                        array(
                            'taxonomy' => 'libtech_apparel_categories',
                            'field' => 'slug',
                            'terms' => 'layers',
                            'include_children' => false
                        )
                    )
                );
                break;
            case "Apparel":
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
                            'terms' => array('sale'),
                            'include_children' => false,
                            'operator' => 'NOT IN'
                        )
                    )
                );
                break;
            case "Clearance":
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
                            'terms' => array('sale'),
                            'include_children' => false,
                            'operator' => 'IN'
                        )
                    )
                );
                break;
            case "Accessories":
                $imageSize = "square-medium";
                $args = array(
                    'post_type' => "libtech_accessories",
                    'posts_per_page' => -1,
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                );
                break;
            case "Luggage":
                $imageSize = "square-medium";
                $args = array(
                    'post_type' => "libtech_luggage",
                    'posts_per_page' => -1,
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                );
                break;
            default:
                $imageSize = "square-large";
                $args = array(
                    'post_type' => "libtech_snowboards",
                    'posts_per_page' => -1,
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                );
        }
        // Get Products
        $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post();
            $productArray = Array();
            $filterList = ""; // start list of items to filter by
            $productArray['postType'] = $post->post_type;
            $productArray['slug'] = $post->post_name;
            $productArray['title'] = get_the_title();
            $productArray['link'] = get_permalink($post->ID);
            $imageID = get_field('libtech_product_image');
            $productArray['imageFile'] = wp_get_attachment_image_src($imageID, $imageSize);
            $productArray['available'] = Array('us' => 'No', 'ca' => 'No', 'eu' => 'No');
            $productArray['colorways'] = Array();
            // check if we're surf because of varrying fin costs
            if ($productArray['postType'] == "libtech_surfboards") {
                // check fin pricing and what to display by default
                if (get_field('libtech_product_price_us_5fin') == "") {
                    $productArray['price'] = getPrice(
                      get_field('libtech_product_price_us'),
                      get_field('libtech_product_price_ca'),
                      get_field('libtech_product_price_eur'),
                      get_field('libtech_product_on_sale'),
                      get_field('libtech_product_sale_percentage'),
                      false
                    );
                } else {
                    $productArray['price'] = getPrice(
                      get_field('libtech_product_price_us_5fin'),
                      get_field('libtech_product_price_ca_5fin'),
                      get_field('libtech_product_price_eur_5fin'),
                      get_field('libtech_product_on_sale'),
                      get_field('libtech_product_sale_percentage'),
                      false
                    );
                }
            } else {
                // grab default price of all other products
                $productArray['price'] = getPrice(
                  get_field('libtech_product_price_us'),
                  get_field('libtech_product_price_ca'),
                  get_field('libtech_product_price_eur'),
                  get_field('libtech_product_on_sale'),
                  get_field('libtech_product_sale_percentage'),
                  false
                );
            }
            switch ($productArray['postType']) {
                case "libtech_snowboards":
                    // BEGIN SETTING UP SNOWBOARD FILTER CLASSES
                    // check snowboard product availability
                    if(get_field('libtech_snowboard_options')):
                        while(the_repeater_field('libtech_snowboard_options')):
                            $optionVariations = get_sub_field('libtech_snowboard_options_variations');
                            // loop through variations
                            for ($i = 0; $i < count($optionVariations); $i++) {
                                $variationSKU = $optionVariations[$i]['libtech_snowboard_options_variations_sku'];
                                $variationAvailableUS = $optionVariations[$i]['libtech_snowboard_options_variations_availability_us'];
                                $variationAvailableCA = $optionVariations[$i]['libtech_snowboard_options_variations_availability_ca'];
                                $variationAvailableEU = $optionVariations[$i]['libtech_snowboard_options_variations_availability_eur'];
                                $variationAvailability = getAvailability($variationSKU, $variationAvailableUS, $variationAvailableCA, $variationAvailableEU);
                                // eval if we should show product or not for each location
                                // snowboards are available always, even when we have 0 in stock, unless we specifically say NO
                                if($variationAvailability['us']['amount'] != "No") $productArray['available']['us'] = "Yes";
                                if($variationAvailability['ca']['amount'] != "No") $productArray['available']['ca'] = "Yes";
                                // Europe is handled like other products, direct
                                if($variationAvailability['eu']['amount'] > 0 || $variationAvailability['eu']['amount'] == "Yes") $productArray['available']['eu'] = "Yes";
                            }
                            // get colorways
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
                                    array_push($productArray['colorways'], Array('color' => $optionColor, 'slug' => $optionSlug, 'img' => $optionImage));
                                    break;
                                endwhile;
                            endif;
                        endwhile;
                    endif;
                    // build array of snowboard sizes
                    $productSize = Array();
                    $productWidth = Array();
                    if(get_field('libtech_snowboard_specs')):
                        while(the_repeater_field('libtech_snowboard_specs')):
                            $snowboardLength = str_replace('&quot;', '_', get_sub_field('libtech_snowboard_specs_length'));
                            $snowboardWidth = get_sub_field('libtech_snowboard_specs_width');
                            // add size & width to arrays
                            array_push($productSize, $snowboardLength);
                            array_push($productWidth, $snowboardWidth);
                            // add length and width to filter list
                            $filterList .= " " . $snowboardLength;
                            $filterList .= " " . str_replace(' ', '_', $snowboardWidth);
                        endwhile;
                    endif;
                    // sort sizes
                    array_multisort($productSize, SORT_ASC);
                    $productArray['size'] = $productSize;
                    $productArray['width'] = $productWidth;
                    // build filter list of snowboard categories
                    $productCategories = Array();
                    $categories = get_the_terms( $post->ID , 'libtech_snowboard_categories' );
                    foreach ( $categories as $category ) {
                        array_push($productCategories, $category->slug);
                        $filterList .= " " . $category->slug;
                    }
                    $productArray['categories'] = $productCategories;
                    // add contour to filter
                    $filterList .= " " . str_replace(array(' ', '!'), '_', get_field('libtech_snowboard_contour'));
                    $productArray['contour'] = get_field('libtech_snowboard_contour');
                    break;
                case "libtech_nas":
                    // get nas availability
                    if(get_field('libtech_nas_variations')):
                        while(the_repeater_field('libtech_nas_variations')):
                            $variationSKU = get_sub_field('libtech_nas_variations_sku');
                            $variationAvailableUS = get_sub_field('libtech_nas_variations_availability_us');
                            $variationAvailableCA = get_sub_field('libtech_nas_variations_availability_ca');
                            $variationAvailableEU = get_sub_field('libtech_nas_variations_availability_eur');
                            $variationAvailability = getAvailability($variationSKU, $variationAvailableUS, $variationAvailableCA, $variationAvailableEU);
                            // eval if we should show product or not for each location
                            if($variationAvailability['us']['amount'] > 0 || $variationAvailability['us']['amount'] == "Yes") $productArray['available']['us'] = "Yes";
                            if($variationAvailability['ca']['amount'] > 0 || $variationAvailability['ca']['amount'] == "Yes") $productArray['available']['ca'] = "Yes";
                            if($variationAvailability['eu']['amount'] > 0 || $variationAvailability['eu']['amount'] == "Yes") $productArray['available']['eu'] = "Yes";
                        endwhile;
                    endif;
                    // build array of nas sizes & widths
                    $productSize = Array();
                    $productWidth = Array();
                    if(get_field('libtech_nas_specs')):
                        while(the_repeater_field('libtech_nas_specs')):
                            $length = get_sub_field('libtech_nas_specs_length');
                            $width = get_sub_field('libtech_nas_specs_waist_width');
                            // Narrow (84mm - 97mm)
                            // Normal (98mm - 112mm)
                            // Wide (113mm - 118mm)
                            if($width < 98) {
                                $width = "Narrow";
                            } else if ($width < 113) {
                                $width = "Standard";
                            } else {
                                $width = "Wide";
                            }
                            // add size & width to arrays
                            array_push($productSize, $length);
                            array_push($productWidth, $width);
                            // add length and width to filter list
                            $filterList .= " " . $length;
                            $filterList .= " " . $width;
                        endwhile;
                    endif;
                    // sort sizes
                    array_multisort($productSize, SORT_ASC);
                    $productArray['size'] = $productSize;
                    break;
                case "libtech_surfboards":
                    // build array of surfboard lengths
                    $productSize = Array();
                    if(get_field('libtech_surfboard_specs')):
                        while(the_repeater_field('libtech_surfboard_specs')):
                            $surfboardLength = get_sub_field('libtech_surfboard_specs_length');
                            //$surfboardLength = floor($surfboardLength/12) . "’" . ($surfboardLength - (floor($surfboardLength/12)*12)) . "”";
                            // add wodth to array
                            array_push($productSize, $surfboardLength);
                            // add width to filter list
                            $filterList .= " " . $surfboardLength;
                        endwhile;
                    endif;
                    // sort sizes
                    array_multisort($productSize, SORT_ASC);
                    $productArray['size'] = $productSize;
                    break;
                case "libtech_skateboards":
                    // build array of skateboard widths
                    $productWidth = Array();
                    if(get_field('libtech_skateboard_options')):
                        while(the_repeater_field('libtech_skateboard_options')):
                            // get variations
                            $optionVariations = get_sub_field('libtech_skateboard_options_variations');
                            // loop through variations
                            for ($i = 0; $i < count($optionVariations); $i++) {
                                $variationWidth = str_replace('.', '_', $optionVariations[$i]['libtech_skateboard_options_variations_width']);
                                $variationSKU = $optionVariations[$i]['libtech_skateboard_options_variations_sku'];
                                $variationAvailableUS = $optionVariations[$i]['libtech_skateboard_options_variations_availability_us'];
                                $variationAvailableCA = $optionVariations[$i]['libtech_skateboard_options_variations_availability_ca'];
                                $variationAvailableEU = $optionVariations[$i]['libtech_skateboard_options_variations_availability_eur'];
                                $variationAvailability = getAvailability($variationSKU, $variationAvailableUS, $variationAvailableCA, $variationAvailableEU);
                                // eval if we should show product or not for each location
                                if($variationAvailability['us']['amount'] > 0 || $variationAvailability['us']['amount'] == "Yes") $productArray['available']['us'] = "Yes";
                                if($variationAvailability['ca']['amount'] > 0 || $variationAvailability['ca']['amount'] == "Yes") $productArray['available']['ca'] = "Yes";
                                if($variationAvailability['eu']['amount'] > 0 || $variationAvailability['eu']['amount'] == "Yes") $productArray['available']['eu'] = "Yes";
                                // add wodth to array
                                array_push($productWidth, $variationWidth);
                                // add width to filter list
                                $filterList .= " " . $variationWidth;
                            }
                        endwhile;
                    endif;
                    // sort sizes
                    array_multisort($productWidth, SORT_ASC);
                    $productArray['width'] = $productWidth;
                    // get categories for skateboards
                    $terms = get_the_terms( $post->ID, 'libtech_skateboard_categories' );
                    if( $terms && !is_wp_error( $terms ) ) {
                        foreach( $terms as $term ) {
                            $filterList .= " " . $term->slug;
                        }
                    }
                    break;
                case "libtech_outerwear":
                    // set waterproofing
                    $productArray['waterproof'] = str_replace('/', '_', get_field('libtech_outerwear_waterproof'));
                    $filterList .= " " . $productArray['waterproof'];
                    if(get_field('libtech_outerwear_variations')):
                        while(the_repeater_field('libtech_outerwear_variations')):
                            $variationSize = get_sub_field('libtech_outerwear_variations_size');
                            // get outerwear availability
                            $variationSKU = get_sub_field('libtech_outerwear_variations_sku');
                            $variationAvailableUS = get_sub_field('libtech_outerwear_variations_availability_us');
                            $variationAvailableCA = get_sub_field('libtech_outerwear_variations_availability_ca');
                            $variationAvailableEU = get_sub_field('libtech_outerwear_variations_availability_eur');
                            $variationAvailability = getAvailability($variationSKU, $variationAvailableUS, $variationAvailableCA, $variationAvailableEU);
                            // eval if we should show product or not for each location
                            if($variationAvailability['us']['amount'] > 0 || $variationAvailability['us']['amount'] == "Yes") $productArray['available']['us'] = "Yes";
                            if($variationAvailability['ca']['amount'] > 0 || $variationAvailability['ca']['amount'] == "Yes") $productArray['available']['ca'] = "Yes";
                            if($variationAvailability['eu']['amount'] > 0 || $variationAvailability['eu']['amount'] == "Yes") $productArray['available']['eu'] = "Yes";
                            // add size to filter list
                            $filterList .= " " . $variationSize;
                        endwhile;
                    endif;
                    // get colorways
                    if(get_field('libtech_outerwear_images')):
                        while(the_repeater_field('libtech_outerwear_images')):
                            $optionColor = get_sub_field('libtech_outerwear_images_color');
                            $optionSlug = str_replace(' ', '-', strtolower($optionColor));
                            $optionSlug = 'outerwear/' . str_replace('/', '', strtolower($optionSlug));
                            $optionImage = get_sub_field('libtech_outerwear_images_image');
                            $optionImage = wp_get_attachment_image_src($optionImage, $imageSize);
                            // don't add duplicate colors
                            $colorFound = false;
                            foreach ($productArray['colorways'] as $colorway) {
                                if ($optionColor == $colorway['color']) {
                                    $colorFound = true;
                                }
                            }
                            if (!$colorFound) {
                                array_push($productArray['colorways'], Array('color' => $optionColor, 'slug' => $optionSlug, 'img' => $optionImage));
                            }
                        endwhile;
                    endif;
                    // get categories for outerwear
                    $terms = get_the_terms( $post->ID, 'libtech_outerwear_categories' );
                    if( $terms && !is_wp_error( $terms ) ) {
                        foreach( $terms as $term ) {
                            $filterList .= " " . $term->slug;
                        }
                    }
                    break;
                case "libtech_apparel":
                    if(get_field('libtech_apparel_variations')):
                        while(the_repeater_field('libtech_apparel_variations')):
                            $variationSize = get_sub_field('libtech_apparel_variations_size');
                            // get apparel availability
                            $variationSKU = get_sub_field('libtech_apparel_variations_sku');
                            $variationAvailableUS = get_sub_field('libtech_apparel_variations_availability_us');
                            $variationAvailableCA = get_sub_field('libtech_apparel_variations_availability_ca');
                            $variationAvailableEU = get_sub_field('libtech_apparel_variations_availability_eur');
                            $variationAvailability = getAvailability($variationSKU, $variationAvailableUS, $variationAvailableCA, $variationAvailableEU);
                            // eval if we should show product or not for each location
                            if($variationAvailability['us']['amount'] > 0 || $variationAvailability['us']['amount'] == "Yes") $productArray['available']['us'] = "Yes";
                            if($variationAvailability['ca']['amount'] > 0 || $variationAvailability['ca']['amount'] == "Yes") $productArray['available']['ca'] = "Yes";
                            if($variationAvailability['eu']['amount'] > 0 || $variationAvailability['eu']['amount'] == "Yes") $productArray['available']['eu'] = "Yes";
                            // add size to filter list
                            $filterList .= " " . $variationSize;
                        endwhile;
                    endif;
                    // get colorways
                    if(get_field('libtech_apparel_images')):
                        while(the_repeater_field('libtech_apparel_images')):
                            $optionColor = get_sub_field('libtech_apparel_images_color');
                            $optionSlug = str_replace(' ', '-', strtolower($optionColor));
                            $optionSlug = 'apparel/' . str_replace('/', '', strtolower($optionSlug));
                            $optionImage = get_sub_field('libtech_apparel_images_image');
                            $optionImage = wp_get_attachment_image_src($optionImage, $imageSize);
                            // don't add duplicate colors
                            $colorFound = false;
                            foreach ($productArray['colorways'] as $colorway) {
                                if ($optionColor == $colorway['color']) {
                                    $colorFound = true;
                                }
                            }
                            if (!$colorFound) {
                                array_push($productArray['colorways'], Array('color' => $optionColor, 'slug' => $optionSlug, 'img' => $optionImage));
                            }
                        endwhile;
                    endif;
                    // get categories for apparel
                    $terms = get_the_terms( $post->ID, 'libtech_apparel_categories' );
                    if( $terms && !is_wp_error( $terms ) ) {
                        foreach( $terms as $term ) {
                            $filterList .= " " . $term->slug;
                        }
                    }
                    break;
                case "libtech_accessories":
                    if(get_field('libtech_accessories_variations')):
                        while(the_repeater_field('libtech_accessories_variations')):
                            // get accessories availability
                            $variationSKU = get_sub_field('libtech_accessories_variations_sku');
                            $variationAvailableUS = get_sub_field('libtech_accessories_variations_availability_us');
                            $variationAvailableCA = get_sub_field('libtech_accessories_variations_availability_ca');
                            $variationAvailableEU = get_sub_field('libtech_accessories_variations_availability_eur');
                            $variationAvailability = getAvailability($variationSKU, $variationAvailableUS, $variationAvailableCA, $variationAvailableEU);
                            // eval if we should show product or not for each location
                            if($variationAvailability['us']['amount'] > 0 || $variationAvailability['us']['amount'] == "Yes") $productArray['available']['us'] = "Yes";
                            if($variationAvailability['ca']['amount'] > 0 || $variationAvailability['ca']['amount'] == "Yes") $productArray['available']['ca'] = "Yes";
                            if($variationAvailability['eu']['amount'] > 0 || $variationAvailability['eu']['amount'] == "Yes") $productArray['available']['eu'] = "Yes";
                        endwhile;
                    endif;
                    // get categories for outerwear
                    $terms = get_the_terms( $post->ID, 'libtech_accessories_categories' );
                    if( $terms && !is_wp_error( $terms ) ) {
                        foreach( $terms as $term ) {
                            $filterList .= " " . $term->slug;
                        }
                    }
                    break;
                case "libtech_luggage":
                    if(get_field('libtech_luggage_variations')):
                        while(the_repeater_field('libtech_luggage_variations')):
                            // get luggage availability
                            $variationSKU = get_sub_field('libtech_luggage_variations_sku');
                            $variationAvailableUS = get_sub_field('libtech_luggage_variations_availability_us');
                            $variationAvailableCA = get_sub_field('libtech_luggage_variations_availability_ca');
                            $variationAvailableEU = get_sub_field('libtech_luggage_variations_availability_eur');
                            $variationAvailability = getAvailability($variationSKU, $variationAvailableUS, $variationAvailableCA, $variationAvailableEU);
                            // eval if we should show product or not for each location
                            if($variationAvailability['us']['amount'] > 0 || $variationAvailability['us']['amount'] == "Yes") $productArray['available']['us'] = "Yes";
                            if($variationAvailability['ca']['amount'] > 0 || $variationAvailability['ca']['amount'] == "Yes") $productArray['available']['ca'] = "Yes";
                            if($variationAvailability['eu']['amount'] > 0 || $variationAvailability['eu']['amount'] == "Yes") $productArray['available']['eu'] = "Yes";
                        endwhile;
                    endif;
                    // get colorways
                    if(get_field('libtech_luggage_images')):
                        while(the_repeater_field('libtech_luggage_images')):
                            $optionColor = get_sub_field('libtech_luggage_images_color');
                            $optionSlug = str_replace(' ', '-', strtolower($optionColor));
                            $optionSlug = 'luggage/' . str_replace('/', '', strtolower($optionSlug));
                            $optionImage = get_sub_field('libtech_luggage_images_image');
                            $optionImage = wp_get_attachment_image_src($optionImage, $imageSize);
                            // don't add duplicate colors
                            $colorFound = false;
                            foreach ($productArray['colorways'] as $colorway) {
                                if ($optionColor == $colorway['color']) {
                                    $colorFound = true;
                                }
                            }
                            if (!$colorFound) {
                                array_push($productArray['colorways'], Array('color' => $optionColor, 'slug' => $optionSlug, 'img' => $optionImage));
                            }
                        endwhile;
                    endif;
                    // get categories for outerwear
                    $terms = get_the_terms( $post->ID, 'libtech_luggage_categories' );
                    if( $terms && !is_wp_error( $terms ) ) {
                        foreach( $terms as $term ) {
                            $filterList .= " " . $term->slug;
                        }
                    }
                    break;
            }
            // if product is available set filter list class
            if ($productArray['available']['us'] == "Yes") {
                $filterList .= " available-us";
            }
            if ($productArray['available']['ca'] == "Yes") {
                $filterList .= " available-ca";
            }
            if ($productArray['available']['eu'] == "Yes") {
                $filterList .= " available-eu";
            }
            $productArray['filterList'] = $filterList;
            // add single product to products array
            array_push($productsArray, $productArray);
        endwhile;
        wp_reset_query();
        ?>

        <div class="bg3-top"></div>
        <section class="product-overview bg3">
            <div class="section-content">
                <h1><?php the_title(); ?></h1>
                <ul class="product-filtering <?php echo strtolower(get_the_title()); ?>">
                    <li class="details">
                        <p>Product Filter</p>
                        <p>Show Products By</p>
                    </li>
                    <?php if (get_the_title() == "Snowboards"): ?>
                    <li class="filters ripper">
                        <p class="select-title">Ripper</p>
                        <p class="selected-items">Select</p>
                        <ul>
                            <li data-filter=".mens">Mens</li>
                            <li data-filter=".womens">Womens</li>
                            <li data-filter=".youth">Youth</li>
                        </ul>
                    </li>
                    <li class="filters categories">
                        <p class="select-title">Categories</p>
                        <p class="selected-items">Select</p>
                        <ul>
                            <li data-filter=".snowboards">Snowboards</li>
                            <li data-filter=".splitboards">Splitboards</li>
                            <li data-filter=".snowskates">Snowskates</li>
                            <li data-filter=".fundamentals">fundaMENTALS</li>
                            <li data-filter=".libited">Libited</li>
                            <li data-filter=".experimental-division">experiMENTAL</li>
                            <li data-filter=".early-release">Early Release</li>
                            <li data-filter=".travis-rice-collection">T. Rice Collection</li>
                            <li data-filter=".jamie-lynn-collection">Jamie's Collection</li>
                        </ul>
                    </li>
                    <li class="filters contours">
                        <p class="select-title">Contours</p>
                        <p class="selected-items">Select</p>
                        <ul>
                            <li data-filter=".BTX">BTX</li>
                            <li data-filter=".EC2_BTX">EC2 BTX</li>
                            <li data-filter=".C2_BTX">C2 BTX</li>
                            <li data-filter=".XC2_BTX">XC2 BTX</li>
                            <li data-filter=".C3_BTX">C3 BTX</li>
                            <li data-filter=".C1_BTX">C1 BTX</li>
                            <li data-filter="._BTX_">!BTX!</li>
                        </ul>
                    </li>
                    <li class="filters size">
                        <p class="select-title">Size</p>
                        <p class="selected-items">Select</p>
                        <ul>
                            <?php
                            $sizeArray = Array();
                            foreach ($productsArray as $product):
                                foreach ($product['size'] as $size):
                                    if (in_array($size, $sizeArray) == false) {
                                        array_push($sizeArray, $size);
                                    }
                                endforeach;
                            endforeach;
                            array_multisort($sizeArray, SORT_ASC);
                            foreach ($sizeArray as $size):
                            ?>
                            <li data-filter=".<?php echo $size; ?>"><?php echo str_replace('_', '&quot;', $size); ?></li>
                            <?php
                            endforeach;
                            ?>
                        </ul>
                    </li>
                    <li class="filters width">
                        <p class="select-title">Width</p>
                        <p class="selected-items">Select</p>
                        <ul>
                            <li data-filter=".Narrow">Narrow</li>
                            <li data-filter=".Standard">Standard</li>
                            <li data-filter=".Mid_Wide">Mid Wide</li>
                            <li data-filter=".Wide">Wide</li>
                            <li data-filter=".Ultra_Wide">Ultra Wide</li>
                        </ul>
                    </li>
                    <li class="filters pricing">
                        <p class="select-title">Pricing</p>
                        <p class="selected-items">Select</p>
                        <ul>
                            <li data-sort="price" data-sort-asc="true">Low - High</li>
                            <li data-sort="price" data-sort-asc="false">High - Low</li>
                            <li data-filter=".available">Availabile</li>
                        </ul>
                    </li>
                    <?php elseif (get_the_title() == "Skis"): ?>
                    <li class="filters nas-size">
                        <p class="select-title">Size</p>
                        <p class="selected-items">Select</p>
                        <ul>
                            <?php
                            $sizeArray = Array();
                            foreach ($productsArray as $product):
                                foreach ($product['size'] as $size):
                                    if (in_array($size, $sizeArray) == false) {
                                        array_push($sizeArray, $size);
                                    }
                                endforeach;
                            endforeach;
                            array_multisort($sizeArray, SORT_ASC);
                            foreach ($sizeArray as $size):
                            ?>
                            <li data-filter=".<?php echo $size; ?>"><?php echo str_replace('_', '&quot;', $size); ?></li>
                            <?php
                            endforeach;
                            ?>
                        </ul>
                    </li>
                    <li class="filters nas-width">
                        <p class="select-title">Waist Width</p>
                        <p class="selected-items">Select</p>
                        <ul>
                            <li data-filter=".Narrow">Narrow</li>
                            <li data-filter=".Standard">Standard</li>
                            <li data-filter=".Wide">Wide</li>
                        </ul>
                    </li>
                    <li class="filters pricing">
                        <p class="select-title">Pricing</p>
                        <p class="selected-items">Select</p>
                        <ul>
                            <li data-sort="price" data-sort-asc="true">Low - High</li>
                            <li data-sort="price" data-sort-asc="false">High - Low</li>
                            <li data-filter=".available">Availabile</li>
                        </ul>
                    </li>
                    <?php elseif (get_the_title() == "Surfboards"): ?>
                    <li class="filters surf-size">
                        <p class="select-title">Size</p>
                        <p class="selected-items">Select</p>
                        <ul>
                            <?php
                            $sizeArray = Array();
                            foreach ($productsArray as $product):
                                foreach ($product['size'] as $size):
                                    if (in_array($size, $sizeArray) == false) {
                                        array_push($sizeArray, $size);
                                    }
                                endforeach;
                            endforeach;
                            array_multisort($sizeArray, SORT_ASC);
                            foreach ($sizeArray as $size):
                                $length = floor($size/12) . "’" . ($size - (floor($size/12)*12)) . "”";
                            ?>
                            <li data-filter=".<?php echo $size; ?>"><?php echo $length; ?></li>
                            <?php
                            endforeach;
                            ?>
                        </ul>
                    </li>
                    <?php elseif (get_the_title() == "Skateboards"): ?>
                    <li class="filters skate-width">
                        <p class="select-title">Width</p>
                        <p class="selected-items">Select</p>
                        <ul>
                            <?php
                            $widthArray = Array();
                            foreach ($productsArray as $product):
                                foreach ($product['width'] as $width):
                                    if (in_array($width, $widthArray) == false) {
                                        array_push($widthArray, $width);
                                    }
                                endforeach;
                            endforeach;
                            array_multisort($widthArray, SORT_ASC);
                            foreach ($widthArray as $width):
                            ?>
                            <li data-filter=".<?php echo $width; ?>"><?php echo str_replace('_', '.', $width); ?></li>
                            <?php
                            endforeach;
                            ?>
                        </ul>
                    </li>
                    <li class="filters skate-categories">
                        <p class="select-title">Categories</p>
                        <p class="selected-items">Select</p>
                        <ul>
                            <li data-filter=".exo-skeletech">Exo Skeletech</li>
                            <li data-filter=".hesho-disposable-standards">Hesho</li>
                            <li data-filter=".bowls">Bowls</li>
                            <li data-filter=".leg-tour">Leg Tour</li>
                            <li data-filter=".completes">Completes</li>
                        </ul>
                    </li>
                    <li class="filters pricing">
                        <p class="select-title">Pricing</p>
                        <p class="selected-items">Select</p>
                        <ul>
                            <li data-sort="price" data-sort-asc="true">Low - High</li>
                            <li data-sort="price" data-sort-asc="false">High - Low</li>
                            <li data-filter=".available">Availabile</li>
                        </ul>
                    </li>
                    <?php elseif (get_the_title() == "Outerwear"): ?>
                    <li class="filters outerwear-size">
                        <p class="select-title">Size</p>
                        <p class="selected-items">Select</p>
                        <ul>
                            <li data-filter=".S">Small</li>
                            <li data-filter=".M">Medium</li>
                            <li data-filter=".L">Large</li>
                            <li data-filter=".XL">X Large</li>
                            <li data-filter=".XXL">XX Large</li>
                        </ul>
                    </li>
                    <li class="filters outerwear-categories">
                        <p class="select-title">Categories</p>
                        <p class="selected-items">Select</p>
                        <ul>
                            <li data-filter=".jackets">Jackets</li>
                            <li data-filter=".pants">Pants</li>
                            <li data-filter=".layers">Layers</li>
                        </ul>
                    </li>
                    <li class="filters outerwear-waterproof">
                        <p class="select-title">Waterproof</p>
                        <p class="selected-items">Select</p>
                        <ul>
                            <?php
                            $waterproofArray = Array();
                            foreach ($productsArray as $product):
                                // make sure we're not in 'layers' within apparel
                                if (array_key_exists('waterproof', $product)) {
                                    if (in_array($product['waterproof'], $waterproofArray) == false) {
                                        array_push($waterproofArray, $product['waterproof']);
                                    }
                                }
                            endforeach;
                            array_multisort($waterproofArray, SORT_ASC);
                            foreach ($waterproofArray as $waterproof):
                            ?>
                            <li data-filter=".<?php echo $waterproof; ?>"><?php echo str_replace('_', '/', $waterproof); ?></li>
                            <?php
                            endforeach;
                            ?>
                        </ul>
                    </li>
                    <li class="filters outerwear-fit">
                        <p class="select-title">Fit</p>
                        <p class="selected-items">Select</p>
                        <ul>
                            <li data-filter=".ripper-fit">Ripper</li>
                            <li data-filter=".true-action-fit">True Action</li>
                            <li data-filter=".street-fit">Street</li>
                        </ul>
                    </li>
                    <li class="filters pricing">
                        <p class="select-title">Pricing</p>
                        <p class="selected-items">Select</p>
                        <ul>
                            <li data-sort="price" data-sort-asc="true">Low - High</li>
                            <li data-sort="price" data-sort-asc="false">High - Low</li>
                            <li data-filter=".available">Availabile</li>
                        </ul>
                    </li>
                    <?php elseif (get_the_title() == "Apparel" || get_the_title() == "Clearance"): ?>
                    <li class="filters apparel-size">
                        <p class="select-title">Size</p>
                        <p class="selected-items">Select</p>
                        <ul>
                            <li data-filter=".S">Small</li>
                            <li data-filter=".M">Medium</li>
                            <li data-filter=".L">Large</li>
                            <li data-filter=".XL">X Large</li>
                            <li data-filter=".XXL">XX Large</li>
                        </ul>
                    </li>
                    <li class="filters apparel-sports">
                        <p class="select-title">Board Sports</p>
                        <p class="selected-items">Select</p>
                        <ul>
                            <li data-filter=".apparel-snow">Snow</li>
                            <li data-filter=".apparel-ski">Ski</li>
                            <li data-filter=".apparel-surf">Surf</li>
                            <li data-filter=".apparel-skate">Skate</li>
                        </ul>
                    </li>
                    <li class="filters apparel-categories">
                        <p class="select-title">Categories</p>
                        <p class="selected-items">Select</p>
                        <ul>
                            <li data-filter=".sweatshirts">Sweatshirts</li>
                            <li data-filter=".t-shirts">T-Shirts</li>
                            <li data-filter=".hats">Hats</li>
                            <li data-filter=".beanies">Beanies</li>
                            <li data-filter=".socks">Socks</li>
                        </ul>
                    </li>
                    <li class="filters pricing">
                        <p class="select-title">Pricing</p>
                        <p class="selected-items">Select</p>
                        <ul>
                            <li data-sort="price" data-sort-asc="true">Low - High</li>
                            <li data-sort="price" data-sort-asc="false">High - Low</li>
                            <li data-filter=".available">Availabile</li>
                        </ul>
                    </li>
                    <?php elseif (get_the_title() == "Accessories"): ?>
                    <li class="filters accessory-categories">
                        <p class="select-title">Categories</p>
                        <p class="selected-items">Select</p>
                        <ul>
                            <li data-filter=".goggles">Goggles</li>
                            <li data-filter=".helmets">Helmets</li>
                            <li data-filter=".wax-tuning-tools">Wax, Tuning and Tools</li>
                            <li data-filter=".stickers">Stickers</li>
                        </ul>
                    </li>
                    <li class="filters accessories-pricing">
                        <p class="select-title">Pricing</p>
                        <p class="selected-items">Select</p>
                        <ul>
                            <li data-sort="price" data-sort-asc="true">Low - High</li>
                            <li data-sort="price" data-sort-asc="false">High - Low</li>
                            <li data-filter=".available">Availabile</li>
                        </ul>
                    </li>
                    <?php elseif (get_the_title() == "Luggage"): ?>
                    <li class="filters luggage-categories">
                        <p class="select-title">Board Sports</p>
                        <p class="selected-items">Select</p>
                        <ul>
                            <li data-filter=".luggage-snow">Snow</li>
                            <li data-filter=".luggage-ski">Ski</li>
                            <li data-filter=".luggage-surf">Surf</li>
                            <li data-filter=".luggage-skate">Skate</li>
                        </ul>
                    </li>
                    <li class="filters luggage-pricing">
                        <p class="select-title">Pricing</p>
                        <p class="selected-items">Select</p>
                        <ul>
                            <li data-sort="price" data-sort-asc="true">Low - High</li>
                            <li data-sort="price" data-sort-asc="false">High - Low</li>
                            <li data-filter=".available">Availabile</li>
                        </ul>
                    </li>
                    <?php endif; ?>
                </ul>
                <div class="clearfix"></div>
                <ul class="product-listing <?php echo strtolower(get_the_title()); ?>">
                    <?php foreach ($productsArray as $product): ?>
                    <li class="product-item <?php echo $product['slug'] . $product['filterList']; ?>">
                        <a href="<? echo $product['link']; ?>">
                            <img src="<?php bloginfo('template_directory'); ?>/_/img/square.gif" data-src="<?php echo $product['imageFile'][0]; ?>" width="<?php echo $product['imageFile'][1]; ?>" height="<?php echo $product['imageFile'][2]; ?>" alt="<?php echo $product['title']; ?> Image" class="product-img lazy" />
                            <div class="colorways">
                                <?php if (count($product['colorways']) > 0) : foreach ($product['colorways'] as $colorway) : ?>
                                <div class="swatch" data-src="<?php echo $colorway['img'][0]; ?>"><img src="<?php bloginfo('template_directory'); ?>/_/img/colorways/<?php echo $colorway['slug']; ?>.jpg" alt="<?php echo $colorway['color']; ?>" /></div>
                                <?php endforeach; endif; ?>
                            </div>
                            <h5><?php echo $product['title']; ?></h5>
                            <div class="price"><?php echo $product['price']; ?></div>
                        </a>
                    </li>
                    <?php endforeach; ?>

                    <?php if (get_the_title() == "Snowboards") : ?>
                    <li class="product-item Narrow Standard Wide mens womens youth snowboards BTX EC2_BTX C2_BTX XC2_BTX C3_BTX available 130 140 145 148 151 153 154 155 156 157 159 161 161_5 164_5 165 169">
                        <a href="/snowboarding/snowboard-builder/">
                            <img src="<?php bloginfo('template_directory'); ?>/_/img/square.gif" data-src="<?php bloginfo('template_directory'); ?>/_/img/diy-board-builder-640x640.png" width="300" height="300" alt="DIY Snowboard Builder" class="product-img lazy" />
                            <h5>DIY Board Builder</h5>
                            <div class="price"><?php echo getPrice(639.95, 664.95, 664.95, 'no', 0, false); ?></div>
                        </a>
                    </li>
                    <?php endif; ?>

                </ul>
            </div>
            <div class="clearfix"></div>
        </section><!-- end product overview -->
<?php get_footer(); ?>
