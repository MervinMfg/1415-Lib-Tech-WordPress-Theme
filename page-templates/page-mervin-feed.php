<?php
/*
Template Name: Mervin Feed
*/
header('Content-Type: application/json');
// allow mervin.com to make requests to this file
header('Access-Control-Allow-Origin: *');

$json = array();
$json['posts'] = array();
$args = array(
	'posts_per_page' => 5,
	'post__in'  => get_option( 'sticky_posts' ),
	'ignore_sticky_posts' => 1
);
$home_query = new WP_Query($args);
if (have_posts()) :
	while ($home_query->have_posts()) :
		$home_query->the_post();
		$post_thumbnail = get_post_image('square-medium');
		$post = array(
			'title' => get_the_title(),
			'time' => get_the_time('c'),
			'date' => get_the_time('F jS, Y'),
			'permalink' => get_permalink(),
			'image' => $post_thumbnail[0]
		);
		array_push($json['posts'], $post);
	endwhile;
endif;
// Reset Post Data
wp_reset_query();
// encode and display JSON
echo json_encode($json);
?>