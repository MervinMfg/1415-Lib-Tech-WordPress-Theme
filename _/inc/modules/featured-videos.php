<?php if ( basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) ) header('Location: /'); // do not allow stanalone viewing ?>
<?php if(get_field('libtech_featured_videos')): // CHECK FOR VIDEOS ?>

		<section class="featured-videos bg1 <?php echo $slug; ?> container-fluid">
			<div class="section-content">
				<?php
					// build array of videos if they exist
					$videoArray = Array();
					while(the_repeater_field('libtech_featured_videos')):
						$videoType = get_sub_field('libtech_featured_videos_type');
						$videoID = get_sub_field('libtech_featured_videos_id');
						$videoName = get_sub_field('libtech_featured_videos_name');
						$videoDetails = get_sub_field('libtech_featured_videos_details');
						array_push($videoArray, Array($videoType, $videoID, $videoName, $videoDetails));
					endwhile;
					// render out video area
				?>

				<div class="video-player">
					<div class="video-frame col-xs-12 col-md-10 col-md-offset-1">
						<div class="frame-wrapper"></div>
					</div>
					<?php
						for ($i = 0; $i < count($videoArray); $i++) {
							echo '<div class="video-info col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2" id="' . $videoArray[$i][1] . '"><h3>' . $videoArray[$i][2] . '</h3>' . $videoArray[$i][3] . '</div>'; // video title
						} // end for loop
					?>
				</div><!-- .video-player -->
				<ul class="video-thumbnails">

					<?php
						for ($i = 0; $i < count($videoArray); $i++) {
							if($videoArray[$i][0] == "YouTube"){ // check video type
								// youtube
								$thumbUrl = 'http://img.youtube.com/vi/' . $videoArray[$i][1] . '/hqdefault.jpg';
								$videoUrl = "http://www.youtube.com/watch?v=" . $videoArray[$i][1];
							} else if ($videoArray[$i][0] == "Vimeo") {
								// vimeo
								$apiUrl = "http://vimeo.com/api/v2/video/" . $videoArray[$i][1] . ".php";
								$hash = unserialize(file_get_contents($apiUrl));
								$thumbUrl = $hash[0]['thumbnail_medium'];
								$videoUrl = "http://vimeo.com/" . $videoArray[$i][1];
							} // end video type check
							$videoTitle = $videoArray[$i][2]; // video title
							if(($i + 1) % 3 == 0){
												$thumbClass = "third";
										}else{
												$thumbClass = "";
										}
					?>

					<li class="<?php echo $thumbClass; ?> col-xs-6 col-sm-4 col-md-3">
						<a href="<?php echo $videoUrl; ?>" data-video-id="<?php echo $videoArray[$i][1]; ?>" data-video-type="<?php echo $videoArray[$i][0]; ?>" style="background-image:url('<?php echo $thumbUrl; ?>');">
							<img src="<?php bloginfo('template_directory'); ?>/_/img/square.gif" alt="<?php echo $videoTitle; ?>" width="1" height="1" />
							<p><?php echo $videoTitle; ?></p>
						</a>
					</li>

					<?php
						} // end for loop
					?>

				</ul><!-- .video-thumbnails -->
				<div class="clearfix"></div>
			</div><!-- .section-content -->
		</section><!-- .featured-videos -->

<?php endif; // END VIDEO CHECK ?>
