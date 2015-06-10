<?php
/*
Template Name: Snowboard Finder
*/
get_header();
?>
			<div class="bg2-top"></div>
			<section class="board-finder bg2" ng-app="boardFinder">
				<div class="section-content" ng-controller="BoardFinderController">
					<div ng-view class="view-animation"></div>
				</div><!-- .section-content -->
			</section><!-- .board-finder -->

<?php get_footer(); ?>
