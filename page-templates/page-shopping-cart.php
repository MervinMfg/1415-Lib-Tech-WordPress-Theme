<?php
/*
Template Name: Shopping Cart Template
*/
get_header();
?>
        <div class="bg2-top"></div>
        <section class="shopping-cart bg2">
            <div class="section-content">

            	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<h1><?php the_title(); ?></h1>
				<div id="shopping-cart"><span></span></div>

				<?php the_content(); ?>

				<?php endwhile; endif; ?>

				<div class="clear"></div>
            </div>
        </section><!-- end .shopping-cart -->

<?php get_footer(); ?>