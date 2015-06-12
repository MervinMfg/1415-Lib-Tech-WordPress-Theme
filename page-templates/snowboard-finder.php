<?php
/*
Template Name: Snowboard Finder
*/
get_header();
?>
			<section class="board-finder bg-texture-gradient" ng-app="boardFinder">
				<div class="loading"></div>
				<div class="section-content" ng-controller="BoardFinderController">
					<div ng-view class="view-animation"></div>
				</div><!-- .section-content -->
			</section><!-- .board-finder -->

<?php get_footer(); ?>
