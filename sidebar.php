<?php
/**
 * @package WordPress
 * @subpackage Lib-Tech-WordPress-Theme
 */

// determine the correct social links for the sidebar
switch ($GLOBALS['sport']) {
    case "ski":
        $facebookUsername = "libtechNAS";
        $instagramUsername = "libtechnas";
        $vimeoUsername = "libtech";
        $twitterUsername = "libtechnas";
        break;
    case "surf":
        $facebookUsername = "waterboards";
        $instagramUsername = "waterboards";
        $vimeoUsername = "libtech";
        $twitterUsername = "waterboards";
        break;
    case "skate":
        $facebookUsername = "libtechskate";
        $instagramUsername = "libtechskate";
        $vimeoUsername = "libtech";
        $twitterUsername = "LibTechSkate";
        break;
    default:
        $facebookUsername = "libtech";
        $instagramUsername = "libtechnologies";
        $vimeoUsername = "libtech";
        $twitterUsername = "libtechnologies";
}
?>

                <div id="sidebar">
                    <div class="sidebar-wrapper">
                        <div class="social-links widget">
                            <p class="h4">Hit us up!</p>
                            <ul>
                                <li><a href="http://www.facebook.com/<?php echo $facebookUsername; ?>" class="facebook" target="_blank">Facebook</a></li>
                                <li><a href="http://www.instagram.com/<?php echo $instagramUsername; ?>" class="instagram" target="_blank">Instagram</a></li>
                                <li><a href="http://www.vimeo.com/<?php echo $vimeoUsername; ?>" class="vimeo" target="_blank">Vimeo</a></li>
                                <li><a href="http://www.twitter.com/<?php echo $twitterUsername; ?>" class="twitter" target="_blank">Twitter</a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar Widgets')) : else : ?>
                        <!-- All this stuff in here only shows up if you DON'T have any widgets active in this zone -->
                        <?php get_search_form(); ?>
                        <?php wp_list_pages('title_li=<h2>Pages</h2>' ); ?>
                        <h2>Archives</h2>
                        <ul>
                            <?php wp_get_archives('type=monthly'); ?>
                        </ul>
                        <h2>Categories</h2>
                        <ul>
                            <?php wp_list_categories('show_count=1&title_li='); ?>
                        </ul>
                        <?php wp_list_bookmarks(); ?>
                        <h2>Meta</h2>
                        <ul>
                            <?php wp_register(); ?>
                            <li><?php wp_loginout(); ?></li>
                            <li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
                            <?php wp_meta(); ?>
                        </ul>    	
                        <h2>Subscribe</h2>
                        <ul>
                            <li><a href="<?php bloginfo('rss2_url'); ?>">Entries (RSS)</a></li>
                            <li><a href="<?php bloginfo('comments_rss2_url'); ?>">Comments (RSS)</a></li>
                        </ul>
                        <?php endif; ?>


                        <?php
                        // GET THOSE RELATED POSTS BY CATEGORY
                        $orig_post = $post;
                        global $post;
                        $categories = get_the_category($post->ID);
                        if ($categories) {
                            $category_ids = array();
                            foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
                            $args=array(
                                'category__in' => $category_ids,
                                'post__not_in' => array($post->ID),
                                'posts_per_page' => 2, // Number of related posts that will be shown.
                                'ignore_sticky_posts' => 1,
                                'orderby' => 'rand'
                            );
                            $my_query = new WP_Query( $args );
                            if( $my_query->have_posts() ) {
                                echo '<div class="related-posts"><h2>RELATED POSTS</h2><ul>';
                                while( $my_query->have_posts() ) {
                                    $my_query->the_post();
                                    $postImage = get_post_image('square-medium');
                        ?>

                                    <li <?php post_class('blog-post'); ?> id="post-<?php the_ID(); ?>">
                                        <div class="post-wrapper">
                                            <a href="<?php the_permalink() ?>">
                                                <img src="<?php echo $postImage[0]; ?>" alt="Image From <?php echo get_the_title(); ?>" />
                                                <h3 class="post-title"><?php the_title(); ?></h3>
                                                <p class="post-meta">
                                                    <time datetime="<?php the_time('c') ?>"><?php the_time('F jS, Y') ?></time> | <span><fb:comments-count href=<?php the_permalink() ?>></fb:comments-count> Comments</span>
                                                </p>
                                                <p class="post-excerpt"><?php libtech_excerpt('libtech_excerptlength_home'); ?></p>
                                                <p class="post-more">READ MORE</p>
                                            </a>
                                        </div>
                                    </li>

                        <?
                                }
                                echo '</ul></div>';
                            }
                        }
                        $post = $orig_post;
                        wp_reset_query();
                        // END RELATED Posts
                        ?>
                        <div class="clearfix" id="sidebar-end"></div>
                    </div>
                </div>