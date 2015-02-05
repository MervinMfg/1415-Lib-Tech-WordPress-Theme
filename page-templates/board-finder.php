<?php
/*
Template Name: Board Finder
*/
get_header();
?>
			<div class="bg2-top"></div>
			<section class="board-finder bg2" ng-app="board-finder">
				<div class="section-content" ng-controller="BoardFinderController as boardFinderCtrl">
					<!--
					<pre>$location.path() = {{$location.path()}}</pre>
					<pre>$route.current.templateUrl = {{$route.current.templateUrl}}</pre>
					<pre>$route.current.params = {{$route.current.params}}</pre>
					<pre>$route.current.scope.name = {{$route.current.scope.name}}</pre>
					<pre>$routeParams = {{$routeParams}}</pre>
					-->
					<a href="#/">Gender</a> • <a href="#/size/">Size</a> • <a href="#/style/">Style</a> • <a href="#/results/">Results</a> • <a href="#/why/">Why</a>
					<div ng-view></div>
               </div><!-- END .section-content -->
          </section><!-- END .board-finder -->

<?php get_footer(); ?>