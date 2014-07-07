<?php
/*
Template Name: Specifications
*/
global $post; 
$prod_specs_table = get_field('libtech_specs_table');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/_/css/spec-table.css">
    
    <?php wp_head(); ?>

    <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if necessary -->
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/_/js/lib/jquery-1.10.2.min.js"><\/script>')</script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/_/js/lib/jquery.dataTables.min.js"></script> 
	<script type="text/javascript">
		$(document).ready(function(){
			$('#specs').dataTable( {
				<?php if ($prod_specs_table =="Snowboards") { ?>"sScrollY": "340px",<?php } ?>
				<?php if ($prod_specs_table =="NAS") { ?>"sScrollY": "340px",<?php } ?>
				<?php if ($prod_specs_table =="Skateboards") { ?>"sScrollY": "340px",<?php } ?>

				"bPaginate": false 
			} );
		});
	</script>
</head>
<body class="body-specifications">
	<div id="prod_specifications">
		<h2 id="spec_title"><?php the_title(); ?></h2>

		<?php if ($prod_specs_table =="Snowboards") { ?>

		<table id="specs" class="display boards">
			<thead>
				<tr>
					<th>Model Name</th>
					<th>Contact<br />Length</th>
					<th>Side<br />Cut</th>
					<th>Nose<br />Width</th>
					<th>Waist<br />Width</th>
					<th>Tail<br />Width</th>
					<th>Stance<br />Min-Max / Set Back</th>
					<th>Flex<br />10 = Firm</th>
					<th>Board<br />Shape</th>
					<th>Board<br />Contour</th>
					<th>Weight<br />Range (lbs)</th>
				</tr>
			</thead>
			<tbody>

				<?php
					// get the snowboards
					$args = array(
						'post_type' => 'libtech_snowboards',
						'posts_per_page' => -1,
						'orderby' => 'menu_order',
						'order' => 'ASC'
					);
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post();
						if(get_field('libtech_snowboard_specs')):
							while(the_repeater_field('libtech_snowboard_specs')):
								$snowboardLength = get_sub_field('libtech_snowboard_specs_length');
								$snowboardWidth = get_sub_field('libtech_snowboard_specs_width');
								if($snowboardWidth == "Narrow"){
									$snowboardLength = $snowboardLength . "N";
								}else if($snowboardWidth == "Wide"){
									$snowboardLength = $snowboardLength . "W";
								}
				?>

				<tr>
					<td><?php echo get_the_title() . ' - ' . $snowboardLength; ?></td>
					<td><?php the_sub_field('libtech_snowboard_specs_contact_length'); ?></td>
					<td><?php the_sub_field('libtech_snowboard_specs_sidecut'); ?></td>
					<td><?php the_sub_field('libtech_snowboard_specs_nose_width'); ?></td>
					<td><?php the_sub_field('libtech_snowboard_specs_waist_width'); ?></td>
					<td><?php the_sub_field('libtech_snowboard_specs_tail_width'); ?></td>
					<td><?php the_sub_field('libtech_snowboard_specs_stance_range'); ?></td>
					<td><?php the_sub_field('libtech_snowboard_specs_flex_rating'); ?></td>
					<td><?php the_field('libtech_snowboard_shape'); ?></td>
					<td><?php the_field('libtech_snowboard_contour'); ?></td>
					<td><?php the_sub_field('libtech_snowboard_specs_weight_range'); ?> +</td>
				</tr>

				<?php
							endwhile;
						endif;
					endwhile;
					wp_reset_query();
				?>

			</tbody>
			<tfoot>
				<tr>
					<th>Model Name</th>
					<th>Contact<br />Length</th>
					<th>Sidecut</th>
					<th>Nose<br />Width</th>
					<th>Waist<br />Width</th>
					<th>Tail<br />Width</th>
					<th>Stance<br />Range/BOC</th>
					<th>Flex Rating<br />1=soft 10=firm</th>
					<th>Board<br />Category</th>
					<th>Board<br />Profile</th>
					<th>Weight<br />Range (lbs)</th>
				</tr>
			</tfoot>
		</table>

		<?php } ?>

		<?php if ($prod_specs_table =="NAS") { ?>

		<table id="specs" class="display nas">
			<thead>
				<tr>
					<th>Model Name</th>
					<th>Contact<br />Length</th>
					<th>Side<br />Cut</th>
					<th>Nose<br />Width</th>
					<th>Waist<br />Width</th>
					<th>Tail<br />Width</th>
					<th>Flex<br />10 = Firm</th>
					<th>Shape</th>
					<th>Contour</th>
					<th>Weight<br />(lbs)</th>
				</tr>
			</thead>
			<tbody>

				<?php
					// get the nas
					$args = array(
						'post_type' => 'libtech_nas',
						'posts_per_page' => -1,
						'orderby' => 'menu_order',
						'order' => 'ASC'
					);
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post();
						if(get_field('libtech_nas_specs')):
							while(the_repeater_field('libtech_nas_specs')):
				?>

				<tr>
					<td><?php echo get_the_title() . ' - ' . get_sub_field('libtech_nas_specs_length'); ?></td>
					<td><?php the_sub_field('libtech_nas_specs_contact_length'); ?></td>
					<td><?php the_sub_field('libtech_nas_specs_side_cut'); ?></td>
					<td><?php the_sub_field('libtech_nas_specs_nose_width'); ?></td>
					<td><?php the_sub_field('libtech_nas_specs_waist_width'); ?></td>
					<td><?php the_sub_field('libtech_nas_specs_tail_width'); ?></td>
					<td><?php the_sub_field('libtech_nas_specs_flex_rating'); ?></td>
					<td><?php the_field('libtech_nas_shape'); ?></td>
					<td><?php the_field('libtech_nas_contour'); ?></td>
					<td><?php the_sub_field('libtech_nas_specs_weight'); ?></td>
				</tr>

				<?php
							endwhile;
						endif;
					endwhile;
					wp_reset_query();
				?>

			</tbody>
			<tfoot>
				<tr>
					<th>Model Name</th>
					<th>Contact<br />Length</th>
					<th>Side<br />Cut</th>
					<th>Nose<br />Width</th>
					<th>Waist<br />Width</th>
					<th>Tail<br />Width</th>
					<th>Flex<br />10 = Firm</th>
					<th>Shape</th>
					<th>Contour</th>
					<th>Weight<br />(lbs)</th>
				</tr>
			</tfoot>
		</table>

		<?php } ?>

		<?php if ($prod_specs_table =="Skateboards") { ?>

		<table id="specs" class="display boards">
			<thead>
				<tr>
					<th>Name</th>
					<th>Width</th>
					<th>Length</th>
					<th>Wheelbase</th>
					<th>Nose<br />Length</th>
					<th>Tail<br />Length</th>
					<th>Concave</th>
				</tr>
			</thead>
			<tbody>

				<?php
					// get the nas
					$args = array(
						'post_type' => 'libtech_skateboards',
						'posts_per_page' => -1,
						'orderby' => 'menu_order',
						'order' => 'ASC'
					);
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post();
						if(get_field('libtech_skateboard_variations')):
							while(the_repeater_field('libtech_skateboard_variations')):
				?>

				<tr>
					<td><?php the_title(); ?></td>
					<td><?php the_sub_field('libtech_skateboard_variations_width'); ?>"</td>
					<td><?php the_sub_field('libtech_skateboard_variations_length'); ?>"</td>
					<td><?php the_sub_field('libtech_skateboard_variations_wheelbase'); ?>"</td>
					<td><?php the_sub_field('libtech_skateboard_variations_nose_length'); ?>"</td>
					<td><?php the_sub_field('libtech_skateboard_variations_tail_length'); ?>"</td>
					<td><?php the_sub_field('libtech_skateboard_variations_concave'); ?></td>
				</tr>

				<?php
							endwhile;
						endif;
					endwhile;
					wp_reset_query();
				?>

			</tbody>
			<tfoot>
				<tr>
					<th>Name</th>
					<th>Width</th>
					<th>Length</th>
					<th>Wheelbase</th>
					<th>Nose<br />Length</th>
					<th>Tail<br />Length</th>
					<th>Concave</th>
				</tr>
			</tfoot>
		</table>

		<?php } ?>

		<?php if ($prod_specs_table =="T-Shirts") { ?>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php the_content(); ?>
		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>

		<?php } ?>
	        
	</div>
	<?php wp_footer(); ?>
	<!-- Google Analytics -->
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-10240523-1']);
        _gaq.push(['_setDomainName', '.lib-tech.com']);
        _gaq.push(['_setAllowHash', false]);
        _gaq.push(['_setAllowLinker', true]);
        _gaq.push(['_trackPageview']);
        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    </script>
</body>
</html>