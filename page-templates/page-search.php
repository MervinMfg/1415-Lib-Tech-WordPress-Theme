<?php
/*
Template Name: Search
*/
get_header(); 
?>

		<section class="search bg2">
			<div class="section-content">
				<h1>Search Results</h1>
				<div id="cse" style="width: 100%;">Loading</div>
				<script src="http://www.google.com/jsapi" type="text/javascript"></script>
				<script type="text/javascript">
					function parseQueryFromUrl () {
						var queryParamName = "q";
						var search = window.location.search.substr(1);
						var parts = search.split('&');
						for (var i = 0; i < parts.length; i++) {
							var keyvaluepair = parts[i].split('=');
							if (decodeURIComponent(keyvaluepair[0]) == queryParamName) {
								return decodeURIComponent(keyvaluepair[1].replace(/\+/g, ' '));
							}
						}
						return '';
					}
					google.load('search', '1', {language : 'en'});
					google.setOnLoadCallback(function() {
						var customSearchControl = new google.search.CustomSearchControl('015302828112823652423:ouh7uozrtok');
						customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
						var options = new google.search.DrawOptions();
						options.enableSearchResultsOnly();
						customSearchControl.draw('cse', options);
						var queryFromUrl = parseQueryFromUrl();
						if (queryFromUrl) {
							customSearchControl.execute(queryFromUrl);
						}
					}, true);
				</script>
			</div><!-- END .section-content -->
			<div class="clearfix"></div>
		</section><!-- END .featured-slider -->

<?php get_footer(); ?>