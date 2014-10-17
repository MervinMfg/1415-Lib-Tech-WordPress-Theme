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

                        <div class="related-posts">
                            <h2>RELATED POSTS</h2>
                                <ul>
                                    <?php
                                        // RELATED POSTS BY CATEGORY
                                        // Only grab posts with shared categories and within the same year
                                        $relatedPosts = Array();
                                        if ($post) {
                                            $categories = get_the_category($post->ID);
                                            if ($categories) {
                                                $category_ids = array();
                                                foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
                                                $args = array(
                                                    'category__in' => $category_ids,
                                                    'post__not_in' => array($post->ID),
                                                    'posts_per_page' => 10,
                                                    'ignore_sticky_posts' => 1,
                                                    'date_query' => array(
                                                        array(
                                                            'year' => get_the_time('Y')
                                                        )
                                                    )
                                                );
                                            } else {
                                                $args = array(
                                                    'posts_per_page' => 10,
                                                    'ignore_sticky_posts' => 1
                                                );
                                            }
                                        } else {
                                            $args = array(
                                                'posts_per_page' => 10,
                                                'ignore_sticky_posts' => 1
                                            );
                                        }
                                        $my_query = new WP_Query( $args );
                                        if( $my_query->have_posts() ) {
                                            while( $my_query->have_posts() ) {
                                                $my_query->the_post();
                                                $postImage = get_post_image('square-medium');
                                                // get the main parent category
                                                $category = get_the_category();
                                                $catTree = get_category_parents($category[0]->term_id, true, '!', true);
                                                $topCat = preg_split('/!/', $catTree);
                                                $mainCategory = $topCat[0];
                                                array_push($relatedPosts, Array('id' => get_the_ID(), 'title' => get_the_title(), 'url' => get_permalink(), 'image' => $postImage, 'dateTime' => get_the_time('c'), 'displayTime' => get_the_time('F jS, Y'), 'excerpt' => libtech_excerpt('libtech_excerptlength_home'), 'postClass' => get_post_class('blog-post')));
                                            }
                                        }
                                        wp_reset_query();
                                        // randomize posts
                                        shuffle($relatedPosts);
                                        $i = 1;
                                        // loop through posts and break after 2
                                        foreach ($relatedPosts as $relatedPost) :
                                    ?>

                                    <li class="post blog-post" id="post-<?php echo $relatedPost['id']; ?>">
                                        <div class="post-wrapper">
                                            <a href="<?php echo $relatedPost['url']; ?>">
                                                <img src="<?php echo $relatedPost['image'][0]; ?>" alt="Image From <?php echo $relatedPost['title']; ?>" />
                                                <h3 class="post-title"><?php echo $relatedPost['title']; ?></h3>
                                                <p class="post-meta">
                                                    <time datetime="<?php echo $relatedPost['dateTime']; ?>"><?php echo $relatedPost['displayTime']; ?></time> | <span><fb:comments-count href=<?php echo $relatedPost['url']; ?>></fb:comments-count> Comments</span>
                                                </p>
                                                <p class="post-excerpt"><?php echo $relatedPost['excerpt']; ?></p>
                                                <p class="post-more">READ MORE</p>
                                            </a>
                                        </div>
                                    </li>
                                    
                                    <?
                                            $i++;
                                            if ($i == 3) {
                                                break; // onto the 3rd post, so break
                                            }
                                        endforeach;
                                    ?>
                                </ul>
                            </div>
                        <div class="clearfix" id="sidebar-end"></div>
                    </div>
                </div>