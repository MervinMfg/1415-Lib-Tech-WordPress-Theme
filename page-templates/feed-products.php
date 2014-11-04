<?php
/*
Template Name: Product Feed
*/
header('Content-Type: application/xml');
?>
<rss version="2.0" xmlns:g="http://base.google.com/ns/1.0">
	<channel>
		<title>Lib Tech</title>
		<link>http://www.lib-tech.com</link>
		<description>Handcrafted Snowboards, Skis, Skateboards, Surfboards, Outerwear &amp; Apparel - Made in the USA</description>
		<?php
			$imageSize = "square-large";
			$args = array(
				'post_type' => array( 'libtech_snowboards', 'libtech_nas', 'libtech_surfboards', 'libtech_skateboards', 'libtech_outerwear', 'libtech_apparel', 'libtech_accessories', 'libtech_luggage' ),
				'posts_per_page' => -1,
				'orderby' => 'menu_order',
				'order' => 'ASC'
			);
			// Get Products
			$loop = new WP_Query( $args );
			if (have_posts()) :
				while ( $loop->have_posts() ) : $loop->the_post();
					$title = get_the_title();
					$content = get_the_content();
					$type = $post->post_type;
					switch ($type) {
						case "libtech_snowboards":
							$type = "Snowboard";
							break;
						case "libtech_nas":
							$type = "Skis";
							break;
						case "libtech_surfboards":
							$type = "Surfboard";
							break;
						case "libtech_skateboards":
							$type = "Skateboard";
							break;
						case "libtech_outerwear":
							$type = "Outerwear";
							break;
						case "libtech_apparel":
							$type = "Apparel";
							break;
						case "libtech_accessories":
							$type = "Accessory";
							break;
						case "libtech_luggage":
							$type = "Luggage";
							break;
					}
					$link = get_permalink();
					$imageID = get_field('libtech_product_image');
					$imageFile = wp_get_attachment_image_src($imageID, $imageSize);
					$usPrice = get_field('libtech_product_price_us');
					$caPrice = get_field('libtech_product_price_ca');
					$euPrice = get_field('libtech_product_price_eur');
					$tagline = get_field('libtech_product_slogan');
		?>
<product>
			<title><![CDATA[<?php echo $title; ?>]]></title>
			<product_type><?php echo $type; ?></product_type>
			<description><![CDATA[<?php the_excerpt(); ?>]]></description>
			<link><?php echo $link; ?></link>
			<id></id>
			<image_link><?php echo $imageFile[0]; ?></image_link>
			<price>
				<us><?php echo $usPrice; ?></us>
				<ca><?php echo $caPrice; ?></ca>
				<eu><?php echo $euPrice; ?></eu>
			</price>
			<tagline><![CDATA[<?php echo $tagline; ?>]]></tagline>
		</product>
		<?php
			endwhile; endif;
			wp_reset_query();
		?>

	</channel>
</rss>
