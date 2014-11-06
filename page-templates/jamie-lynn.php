<?php
/*
Template Name: Jamie Lynn 20 Year
*/
// GET THE REGION
getRegionCode();
?>
<!doctype html>
<!--[if lt IE 7 ]> <html class="ie ie6 ie-lt10 ie-lt9 ie-lt8 ie-lt7 no-js diy-share" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 ie-lt10 ie-lt9 ie-lt8 no-js diy-share" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 ie-lt10 ie-lt9 no-js diy-share" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 ie-lt10 no-js diy-share" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js diy-share" <?php language_attributes(); ?>><!--<![endif]-->
<head id="www-lib-tech-com" data-template-set="lib-tech-wordpress-theme">
	<meta charset="<?php bloginfo('charset'); ?>">
	<!--[if IE ]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<![endif]-->
    <title>Jamie Lynn 20 Year Anniversary - Lib Tech</title>
	<meta name="description" content="Lib Tech's tribute to Jamie Lynn's 20 year anniversary." />
	<meta name="author" content="Lib Tech" />
    <meta name="copyright" content="Copyright Lib Tech <?php echo date('Y'); ?>. All Rights Reserved." />
	<!-- FB Meta Data -->
	<meta property="og:title" content="Jamie Lynn 20 Year Anniversary - Lib Tech" />
	<meta property="og:description" content="Lib Tech's tribute to Jamie Lynn's 20 year anniversary." />
	<meta property="og:url" content="<?php echo $page_url; ?>" />
	<meta property="og:image" content="<?php bloginfo('template_directory'); ?>/_/img/jamie-lynn/social-share.jpg" />
	<meta property="og:type" content="website" />
	<meta property="og:site_name" content="Lib Technologies" />
	<meta property="fb:app_id" content="352899581451617"/>
	<!-- Google+ Meta Data -->
	<meta itemprop="name" content="Jamie Lynn 20 Year Anniversary - Lib Tech" />
	<meta itemprop="description" content="Lib Tech's tribute to Jamie Lynn's 20 year anniversary." />
	<meta itemprop="image" content="<?php bloginfo('template_directory'); ?>/_/img/jamie-lynn/social-share.jpg" />
	<!-- Google Site Verification -->
    <meta name="google-site-verification" content="wE_gDgt0-MYrOnCO0K7VH2HP7af_DuxpDK1EJFdohFc" />
	<!-- Twitter -->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="@libtechnologies">
    <!-- Fav Icon -->
    <link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/_/img/jamie-lynn/favicon.ico" />
	<!--  Mobile Meta Info -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Misc. -->
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <?php include get_template_directory() . '/_/inc/header-includes-jamie-lynn.php'; ?>
	<!--[if lt IE 9]>
		<script src="<?php bloginfo('template_directory'); ?>/_/js/lib/respond.min.js"></script>
	<![endif]-->
    <!-- WordPress Head -->
	<?php wp_head(); ?>
</head>
<body <?php body_class('jamie-lynn'); ?>>
	<div class="wrapper">



	</div><!-- END .wrapper -->

	<?php wp_footer(); ?>
	
	<!--[if lte IE 8]>
	<div id="ie-blocker">
		<h2>We do not support your browser.</h2>
		<p><a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p>
	</div>
	<![endif]-->
	
	<!-- JavaScript includes -->
<?php include get_template_directory() . '/_/inc/footer-includes-jamie-lynn.php'; ?>

	<!-- Init the main JS -->
	<script type="text/javascript">
	    $(document).ready(function(){
	        LIBTECH.JamieLynn.init();
	    });
	</script>
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