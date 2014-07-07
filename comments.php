<?php

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		This post is password protected. Enter the password to view comments.
	<?php
		return;
	}
?>

<?php
	if ( comments_open() ) :
		if( is_singular('post') || is_singular('page') ) :
?>
        	<div class="discussion">
				<h2>Discussion</h2>
				<div class="discussion-thread">
					<div class="fb-comments" data-href="<?php the_permalink(); ?>" data-width="940" data-numposts="5" data-colorscheme="dark" data-mobile="false"></div>
				</div>
				<div class="clearfix"></div>
			</div>
<?php 
		else :
?>
		<div class="discussion-top bg1-top"></div>
        <section class="discussion bg1">
        	<div class="section-content">
				<h2>Discussion</h2>
				<div class="discussion-thread">
					<div class="fb-comments" data-href="<?php the_permalink(); ?>" data-width="940" data-numposts="5" data-colorscheme="dark" data-mobile="false"></div>
				</div>
				<div class="clearfix"></div>
			</div>
		</section>
<?php
		endif;
	endif;
?>
