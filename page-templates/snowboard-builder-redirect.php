<?php 
/*
Template Name: Snowboard Builder Redirect
*/
$redirect_url = get_site_url() ."/snowboarding/snowboard-builder/";
$page_title = "Lib Tech's DIY Snowboard Builder - Build your own damn snowboard!";
if( isset($_GET['shape']) && isset($_GET['size']) && isset($_GET['top']) && isset($_GET['sidewall']) && isset($_GET['badge']) ) {
	if( isset($_GET['base']) || isset($_GET['kt']) && isset($_GET['kbc']) && isset($_GET['ktc']) ) {
		// change to share title
		$page_title = "I built my own Lib Tech Snowboard with the DIY Board Builder! - Build your dream snowboard!";
		$redirect_url = get_site_url() . str_replace("/diy/", "/snowboarding/snowboard-builder/share/", $_SERVER['REQUEST_URI']);
	}
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head id="www-lib-tech-com" data-template-set="lib-tech-wordpress-theme">
	<meta charset="<?php bloginfo('charset'); ?>">
    <title><?php echo $page_title; ?></title>
	<meta name="description" content="Lib Tech's DIY Snowboard Builder offers you the opportunity to order a custom, one of a kind, dream snowboard handmade in the USA. Customize your snowboard's shape, size, graphics and more in this online, custom snowboard building tool." />
	<meta name="keywords" content="custom snowboard, custom built snowboard, custom made snowboard, handmade snowboard, made in the USA, build your own, customize" />
	<meta name="author" content="Lib Tech" />
    <meta name="copyright" content="Copyright Lib Tech <?php echo date('Y'); ?>. All Rights Reserved." />
	<!-- FB Meta Data -->
	<meta property="og:title" content="<?php echo $page_title; ?>" />
	<meta property="og:description" content="This dream snowboard project is probably going to cause us some headaches, but you are going to be stoked! Lib Tech's DIY Board Builder offers you the opportunity to order a custom, one of a kind, dream snowboard that will be guided through our experiMENTAL Division’s prototyping process and handcrafted to your specifications in the USA." />
	<meta property="og:url" content="<?php echo $redirect_url; ?>" />
	<meta property="og:image" content="<?php bloginfo('template_directory'); ?>/_/img/diy/social-share.png" />
	<meta property="og:type" content="website" />
	<meta property="og:site_name" content="Lib Technologies" />
	<meta property="fb:app_id" content="352899581451617"/>
	<!-- Google+ Meta Data -->
	<meta itemprop="name" content="<?php echo $page_title; ?>" />
	<meta itemprop="description" content="This dream snowboard project is probably going to cause us some headaches, but you are going to be stoked! Lib Tech's DIY Board Builder offers you the opportunity to order a custom, one of a kind, dream snowboard that will be guided through our experiMENTAL Division’s prototyping process and handcrafted to your specifications in the USA." />
	<meta itemprop="image" content="<?php bloginfo('template_directory'); ?>/_/img/diy/social-share.png" />
	<!-- Twitter -->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="@libtechnologies">
    <!-- Fav Icon -->
    <link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/_/img/favicon.ico" />
    <!-- Misc. -->
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <meta http-equiv="refresh" content="0;URL=<?php echo stripslashes($redirect_url); ?>" />
    <!-- Google Site Verification -->
    <meta name="google-site-verification" content="wE_gDgt0-MYrOnCO0K7VH2HP7af_DuxpDK1EJFdohFc" />
    <!-- JavaScript Includes -->
	<script src="<?php bloginfo('template_directory'); ?>/_/js/lib/modernizr-2.6.2.min.js"></script>
    <!-- WordPress Head -->
	<?php wp_head(); ?>
</head>
<body <?php body_class('diy-redirect'); ?>>

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