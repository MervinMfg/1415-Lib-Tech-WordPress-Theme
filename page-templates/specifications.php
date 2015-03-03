<?php
/*
Template Name: Specifications
*/
global $post; 
$prod_specs_table = get_field('libtech_specs_table');
switch ($prod_specs_table) {
    case "Snowboards":
        $sport = "snow";
        break;
    case "NAS":
        $sport = "ski";
        break;
    case "Skateboards":
        $sport = "skate";
        break;
    default:
         $sport = "snow";
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<!--
                           *
                          **
                         ***
                        *****
                       *** **
                       **  ***
                      **    **
                     ***    ***
                    ***     ***
                   ***      ****
                   ***       ***
                  ***         **
                **********    ***
               ************** ***
             ****        *********
           ****  ***        ******
          ***    ****          ****
         **      ******* ***    **
        ***      ** *** ****    ***
        **       **         ***  ***
        **      ***         ***   **
        ***     ***         **    **
         **      **        ***   ***
         ***     ***       **    **
          ***     ****    ***   **
           ****    *********  ****
            ***       ****   ****
              ******      *****
                ************
                **    *
***            **     *
  ***          **     *
     **        *      *     **
       ***    **     ***********
        ****  **
           ****
            ****
-->
<head id="www-lib-tech-com" data-template-set="lib-tech-wordpress-theme">
	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
	<?php include get_template_directory() . '/_/inc/header-includes.php'; ?>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/_/css/spec-table.css">
    
    <?php wp_head(); ?>

    <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if necessary -->
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/_/js/lib/jquery-1.11.1.min.js"><\/script>')</script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/_/js/lib/jquery.dataTables.min.js"></script> 
	<script type="text/javascript">
		$(document).on('ready', function(){
			$('#specs').dataTable( {
				"sScrollY": "340px",
				"bPaginate": false 
			} );
		});
	</script>
</head>
<body class="body-specifications <?php echo $sport; ?>">
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
								switch ($snowboardWidth) {
									case "Narrow":
										$snowboardLength = $snowboardLength . "N";
										break;
									case "Mid Wide":
										$snowboardLength = $snowboardLength . "MW";
										break;
									case "Wide":
										$snowboardLength = $snowboardLength . "W";
										break;
									case "Ultra Wide":
										$snowboardLength = $snowboardLength . "UW";
										break;
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
					<th>Flex<br />10 = Firm</th>
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
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-10240523-1', 'auto');
		ga('send', 'pageview');
	</script>
</body>
</html>