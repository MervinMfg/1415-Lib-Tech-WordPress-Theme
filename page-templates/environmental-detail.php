<?php
/*
Template Name: Environmental Detail
*/
get_header();

if (have_posts()) :
  while (have_posts()) :
    the_post();
    $parent = get_page($post->post_parent);
    $parentSlug = $parent->post_name;
    switch ($parentSlug) {
      case "skiing":
        $faqSlug = "ski-environmental";
        break;
      case "skateboarding":
        $faqSlug = "skate-environmental";
        break;
      case "surfing":
        $faqSlug = "surf-environmental";
        break;
      default:
        $faqSlug = "snow-environmental";
    }
?>
    <section class="video-header <?php if ($videoID) { echo " video"; }; ?> container-fluid">
      <div class="section-content row">
        <div class="video-player col-xs-12 col-md-10 col-md-offset-1">
          <div class="video-wrapper">
            <?php if(get_field('libtech_enviro_video_id')) : $videoID = get_field('libtech_enviro_video_id'); ?>
            <iframe src="http://player.vimeo.com/video/<?php echo $videoID; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=fff100" width="640" height="360" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>            <?php elseif($parentSlug == "skiing") : ?>
            <img src="<?php bloginfo('template_directory'); ?>/_/img/environmental-ski.jpg" alt="Lib Tech NAS Environmental" />
            <?php elseif($parentSlug == "surfing") : ?>
            <img src="<?php bloginfo('template_directory'); ?>/_/img/environmental-surf.jpg" alt="Lib Tech Surf Environmental" />
            <?php elseif($parentSlug == "skateboarding") : ?>
            <img src="<?php bloginfo('template_directory'); ?>/_/img/environmental-skate.jpg" alt="Lib Tech Skate Environmental" />
            <?php else : ?>
            <img src="<?php bloginfo('template_directory'); ?>/_/img/environmental-snow.jpg" alt="Lib Tech Snowboard Environmental" />
            <?php endif; ?>
          </div>
        </div>
        <div class="video-text col-xs-12 col-md-8 col-md-offset-2">
          <?php the_content(); ?>
        </div>
        <div class="clearfix"></div>
      </div><!-- .section-content -->
    </section><!-- .video-header -->

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
        </div><!-- .faq-list -->
        <div class="clearfix"></div>
      </div><!-- .section-content -->
    </section><!-- .tech-faq -->

    <?php
        endif;
        wp_reset_query();
    ?>

<?php
  endwhile;
endif;
get_footer();
?>
