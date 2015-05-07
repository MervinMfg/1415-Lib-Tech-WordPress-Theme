<?php
/*
Template Name: FAQs
*/
get_header();
?>
    <div class="bg2-top"></div>
    <section class="faqs bg2">
      <div class="section-content">

        <?php
          if (have_posts()) :
            while (have_posts()) :
              the_post();
        ?>

        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>

        <?php
            endwhile;
          endif;
          wp_nav_menu( // faq menu
            array(
              'theme_location' => 'faq_menu',
              'container' => 'nav',
              'container_class' => 'faq-nav'
            )
          );
        ?>

        <div class="clearfix"></div>
        <div class="faq-categories">
          <h2>Categories</h2>
          <nav class="desktop-nav">
            <ul>
              <?php
                  // get parent category for this page
                  if (get_field('libtech_faq_type')) {
                      $faqType = get_field('libtech_faq_type');
                  } else {
                      $faqType = 'general';
                  }
                  $parentCategory = get_term_by( 'slug', $faqType, 'libtech_faqs_categories' );
                  // request subcategories
                  $subCategories = get_terms( 'libtech_faqs_categories', array(
                      'orderby' => 'name',
                      'order' => 'ASC',
                      'parent' => $parentCategory->term_id
                  ));

                  if($subCategories){
                      $count = count($subCategories);
                      if ( $count > 0 ){
                          foreach ( $subCategories as $category ) {
                              // get taxonimy slug
                              $catSlug = $category->slug;
                              $catName = $category->name;
                              echo "\n\t\t\t\t<li><a href=\"#". $catSlug ."\">". $catName ."</a></li>";
                          }
                      }
                  }
              ?>
            </ul>
          </nav>
          <select class="mobile-nav select">
            <option value="#">Categories</option>
            <option value="#" disabled>------------</option>
            <?php
              if($subCategories){
                $count = count($subCategories);
                if ( $count > 0 ){
                  foreach ( $subCategories as $category ) {
                    // get taxonimy slug
                    $catSlug = $category->slug;
                    $catName = $category->name;
                    echo "\n\t\t\t\t<option value=\"#". $catSlug ."\">". $catName ."</option>";
                  }
                }
              }
            ?>
          </select>
        </div><!-- .faq-categories -->
        <div class="faq-list">
          <?php
            $count = count($subCategories);
            if ( $count > 0 ){
              foreach ( $subCategories as $category ) {
                // get taxonimy slug
                $catSlug = $category->slug;
                $catName = $category->name;
                echo "\n\t\t\t\t<h3 id=\"". $catSlug ."\">". $catName ."</h3>\n\t\t\t\t<ul>";
                // get each post under taxonimy type
                $args = array(
                  'post_type' => 'libtech_faqs',
                  'tax_query' => array(
                    array(
                      'taxonomy' => 'libtech_faqs_categories',
                      'field' => 'slug',
                      'terms' => $catSlug
                    )
                  )
                );
                $loop = new WP_Query( $args );
                while ( $loop->have_posts() ) : $loop->the_post();
                    $custom = get_post_custom($post->ID);
                    $content = apply_filters('the_content', get_the_content());
                    $content = str_replace(']]>', ']]&gt;', $content);
                    echo "\n\t\t\t\t\t<li class=\"faq-question\">\n\t\t\t\t\t\t<a href=\"#\" class=\"question\"><span></span>". get_the_title() ."</a>\n\t\t\t\t\t\t<div class=\"answer\">".$content."</div>\n\t\t\t\t\t</li>\n";
                endwhile;
                wp_reset_query();
                echo "\n\t\t\t\t</ul>\n";
              }
            }
          ?>
        </div><!-- .faq-list -->
        <div class="clearfix"></div>
      </div><!-- .section-content -->
    </section><!-- .faqs -->
<?php get_footer(); ?>
