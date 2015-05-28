<?php
/*
Template Name: Technology Detail
*/
get_header();

$parent = get_page($post->post_parent);
$parentSlug = $parent->post_name;

switch ($parentSlug) {
  case "skiing":
    $categorySlug = "ski";
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
    <section class="video-header video container-fluid bg-texture-gradient">
      <div class="section-content row">
        <h1 class="<?php echo $GLOBALS['sport']; ?> col-xs-12 col-md-10 col-md-offset-1"><?php the_title(); ?></h1>
        <div class="video-player col-xs-12 col-md-10 col-md-offset-1">
          <div class="video-wrapper">
            <?php if (get_field('libtech_tech_video_id')) : $videoID = get_field('libtech_tech_video_id'); ?>
            <iframe src="http://player.vimeo.com/video/<?php echo $videoID; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=66CC00" width="640" height="360" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
            <?php elseif ($categorySlug == "snowboards"): ?>
            <img src="<?php bloginfo('template_directory'); ?>/_/img/tech-snow.jpg" alt="Lib Tech Snowboard Technology" />
            <?php elseif ($categorySlug == "ski"): ?>
            <img src="<?php bloginfo('template_directory'); ?>/_/img/tech-ski.jpg" alt="Lib Tech NAS Technology" />
            <?php elseif ($categorySlug == "surfboards"): ?>
            <img src="<?php bloginfo('template_directory'); ?>/_/img/tech-surf.jpg" alt="Lib Tech Surf Technology" />
            <?php elseif ($categorySlug == "skateboards"): ?>
            <img src="<?php bloginfo('template_directory'); ?>/_/img/tech-skate.jpg" alt="Lib Tech Skate Technology" />
            <?php endif; ?>
          </div>
        </div>
        <div class="video-text col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
          <?php the_content(); ?>
        </div>
        <div class="clearfix"></div>
      </div><!-- .section-content -->
    </section><!-- .video-header -->
    <?php if ($parentSlug != "surfing" && $parentSlug != "skateboarding"): ?>
    <section class="tech-major container-fluid">
      <div class="section-content row">
        <div class="tech-video-list">
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
          $i = 1;
          while ( $loop->have_posts() ) : $loop->the_post();
            // check if item is major
            if(get_field("libtech_technology_type") == "Major"):
              $videoID = get_field("libtech_technology_video");
          ?>
          <div class="tech-video-item <?php if ($i % 2 == 0) { echo 'even col-xs-12 col-ms-10 col-ms-offset-1 col-sm-6 col-sm-offset-0'; } else { echo 'odd col-xs-12 col-ms-10 col-ms-offset-1 col-sm-6 col-sm-offset-0'; } ?>">
            <div class="tech-wrapper">
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
            </div>
          </div>
          <?php
            	if($i %2 == 0) echo '<div class="clearfix visible-sm visible-md visible-lg"></div>';
              $i++;
            endif;
          endwhile;
          wp_reset_query();
          ?>
          <div class="clearfix"></div>
        </div><!-- .tech-video-list -->
      </div><!-- .section-content -->
    </section><!-- .tech-major -->
    <?php endif; // end not surfing check ?>
    <section class="tech-minor container-fluid">
      <div class="section-content row">
        <?php if ($parentSlug != "surfing"): ?>
        <h2>Ingredients</h2>
        <?php else: ?>
        <div class="surf-tech-logo clearfix">
          <div class="tech-logo col-xs-8 col-xs-offset-2 col-ms-6 col-ms-offset-3 col-sm-4 col-sm-offset-4"><img src="<?php bloginfo('template_directory'); ?>/_/img/lib-tech-surf-eco-isotropic.png" /></div>
          <h3 class="tech-slogan col-xs-12">Technologically Tougher - NEW Phase 3 Construction</h3>
        </div>
        <?php endif; ?>
        <div class="wrapper">
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
          $i = 1;
          while ( $loop->have_posts() ) : $loop->the_post();
            // check if item is major
            if(get_field("libtech_technology_type") == "Minor"):
              $imageID = get_field("libtech_technology_icon");
              $imageFile = wp_get_attachment_image_src($imageID, 'thumbnail');
          ?>
          <div class="item">
            <div class="tech-pad col-xs-6 col-ms-6 col-sm-4 col-md-3">
              <h4><img src="<?php echo $imageFile[0]; ?>" /><span><?php the_title(); ?></span></h4>
              <div class="tech-copy">
                <?php the_content(); ?>
              </div>
            </div>
          </div>
          <?php
  						if($i %2 == 0) echo '<div class="clearfix visible-xs visible-ms"></div>';
              if($i %3 == 0) echo '<div class="clearfix visible-sm"></div>';
  						if($i %4 == 0) echo '<div class="clearfix visible-md visible-lg"></div>';
              $i++;
            endif;
          endwhile;
          wp_reset_query();
          ?>
        </div>

        <?php if ($parentSlug == "surfing"): ?>
        <div class="surf-handcrafted col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
          <img src="<?php bloginfo('template_directory'); ?>/_/img/surf-handcrafted-usa.png" alt="Handcrafted in the USA" class="handcrafted-image" />
          <h3 class="handcrafted-title">Handcrafted in the USA</h3>
          <p>Every waterboard is hand made by surfers in the USA near Canada at the world's most environMENTAL board factory!</p>
        </div>
        <?php endif; ?>

      </div><!-- .section-content -->
    </section><!-- .tech-minor -->

    <?php
      // get each post under taxonimy type
      $args = array(
        'post_type' => 'libtech_faqs',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC',
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
