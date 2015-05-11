<?php if ( basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) ) header('Location: /'); // do not allow stanalone viewing ?>

		<?php
			// get instagram data from ACF
			$type = get_field('libtech_instagram_type');
			if($type == 'username') {
				$value = get_field('libtech_instagram_username');
			} else {
				$value = get_field('libtech_instagram_tag');
			}
			$limit = get_field('libtech_instagram_limit');
			if($value) :
		?>

		<section class="instagram-feed container-fluid" data-<?php echo $type; ?>="<?php echo $value; ?>" data-limit="<?php echo $limit; ?>">
			<div class="section-content row"><?php // Add Instagram Photos Via JS ?></div>
		</section>

		<?php endif; ?>
