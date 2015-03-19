<?php
/*
Template Name: Snowboard Builder Share
*/
// GET THE REGION
getCurrencyCode();
$page_url = get_site_url() . $_SERVER['REQUEST_URI'];
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
    <title>I built my own Lib Tech Snowboard with the DIY Board Builder! - Build your dream snowboard!</title>
	<meta name="description" content="Lib Tech's DIY Snowboard Builder offers you the opportunity to order a custom, one of a kind, dream snowboard handmade in the USA. Customize your snowboard's shape, size, graphics and more in this online, custom snowboard building tool." />
	<meta name="keywords" content="custom snowboard, custom built snowboard, custom made snowboard, handmade snowboard, made in the USA, build your own, customize" />
	<meta name="author" content="Lib Tech" />
    <meta name="copyright" content="Copyright Lib Tech <?php echo date('Y'); ?>. All Rights Reserved." />
	<!-- FB Meta Data -->
	<meta property="og:title" content="I built my own Lib Tech Snowboard with the DIY Board Builder! - Build your dream snowboard!" />
	<meta property="og:description" content="This dream snowboard project is probably going to cause us some headaches, but you are going to be stoked! Lib Tech's DIY Board Builder offers you the opportunity to order a custom, one of a kind, dream snowboard that will be guided through our experiMENTAL Division’s prototyping process and handcrafted to your specifications in the USA." />
	<meta property="og:url" content="<?php echo $page_url; ?>" />
	<meta property="og:image" content="<?php bloginfo('template_directory'); ?>/_/img/diy/social-share.png" />
	<meta property="og:type" content="website" />
	<meta property="og:site_name" content="Lib Technologies" />
	<meta property="fb:app_id" content="352899581451617"/>
	<!-- Google+ Meta Data -->
	<meta itemprop="name" content="I built my own Lib Tech Snowboard with the DIY Board Builder! - Build your dream snowboard!" />
	<meta itemprop="description" content="This dream snowboard project is probably going to cause us some headaches, but you are going to be stoked! Lib Tech's DIY Board Builder offers you the opportunity to order a custom, one of a kind, dream snowboard that will be guided through our experiMENTAL Division’s prototyping process and handcrafted to your specifications in the USA." />
	<meta itemprop="image" content="<?php bloginfo('template_directory'); ?>/_/img/diy/social-share.png" />
	<!-- Google Site Verification -->
    <meta name="google-site-verification" content="wE_gDgt0-MYrOnCO0K7VH2HP7af_DuxpDK1EJFdohFc" />
	<!-- Twitter -->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="@libtechnologies">
    <!-- Fav Icon -->
    <link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/_/img/favicon.ico" />
	<!--  Mobile Meta Info -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Misc. -->
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <?php include get_template_directory() . '/_/inc/header-includes-diy-builder.php'; ?>
	<!--[if lt IE 9]>
		<script src="<?php bloginfo('template_directory'); ?>/_/js/lib/respond.min.js"></script>
	<![endif]-->
    <!-- WordPress Head -->
	<?php wp_head(); ?>
</head>
<body <?php body_class('diy-share'); ?>>
	<div class="wrapper">
	    <div id="header-share">
    		<img src="<?php bloginfo('template_directory'); ?>/_/img/diy/logo-diy-share.png" alt="Lib Tech DIY Board Builder" />
	    </div>
	    <div id="header-share-print">
    		<img src="<?php bloginfo('template_directory'); ?>/_/img/diy/logo-diy-print.png" alt="Lib Tech DIY Board Builder" />
	    </div>
		<div class="step7-buy">
			<div class="board-reciept">
				<h1>EXPENSE</h1>
				<h2 class="shape">BOARD - <span></span></h2>
				<p class="shape-cost"></p>
				<h2 class="size">SIZE - <span></span></h2>
				<p class="size-cost"></p>
				<h2 class="top">TOP - <span></span></h2>
				<p class="top-cost"></p>
				<h2 class="sidewall">SIDEWALL - <span></span></h2>
				<p class="sidewall-cost"></p>
				<h2 class="base"></h2>
				<p class="base-cost"></p>
				<h2 class="badge">BADGE - <span></span></h2>
				<p class="badge-cost"></p>
				<hr />
				<h3 class="subtotal">SUBTOTAL</h3>
				<h3 class="subtotal-cost"></h3>
				<div class="clearfix"></div>
			</div>
			<div class="terms">
				<h1>Lib Tech DIY Program Policy</h1>
				<p>The finished board may not appear exactly as it is shown on the screen. <strong>DIY board orders take 3-6 weeks to build and ship for United States/Canada.</strong> DIY board orders will be charged upon order confirmation. No returns or refunds on customized boards will be accepted or given.</p>
			</div>
			<div class="terms-international">
				<h1>Lib Tech DIY Program Policy</h1>
				<p>The finished board may not appear exactly as it is shown on the screen. <strong>DIY board orders take 6-9 weeks for countries outside of United States/Canada.</strong> For a list of countries we ship DIY boards to <a href='/snowboarding/snowboard-builder/international-countries/' target='_blank'>click here</a>. DIY board orders will be charged upon order confirmation. No returns or refunds on customized boards will be accepted or given.</p>
			</div>
			<div class="cart-error">
				<p>An error has occured. Verify your snowboard is complete and try again. If the problem persists <a href="http://www.mervin.com/contact/" target="_blank">let us know</a>.</p>
			</div>
			<div class="buttonholder">
				<div class="buy-button">Buy<span> this board</span>!</div>
				<div class="agree-button">I agree</div>
				<p class="or">OR</p>
				<a class="build-button" href="../">Build your own</a>
				<div class="social-icons">
					<p>Share with your friends</p>
					<a href="#"><img class="socialfb" src="<?php bloginfo('template_directory'); ?>/_/img/diy/social-fb.png" alt="Facebook" /></a>
					<a href="#"><img class="socialtw" src="<?php bloginfo('template_directory'); ?>/_/img/diy/social-twitter.png" alt="Twitter" /></a>
					<a href="#"><img class="socialg" src="<?php bloginfo('template_directory'); ?>/_/img/diy/social-google.png" alt="Google+" /></a>
					<a href="#"><img class="sociale" src="<?php bloginfo('template_directory'); ?>/_/img/diy/social-email.png" alt="Email" /></a>
				</div>
				<div class="share-url">
					<p>Copy and Paste URL</p>
					<input type="text" id="share-url-input" value="http://www.lib-tech.com" readonly="readonly" />
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div id="board-display">
			<div class="board-name"></div>
			<div class="board-preview all">
				<div class="board-views">
					<div class="preview-top">
						<div class="board">
							<div class="board-image">
								<div class="board-text"></div>
								<img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-top/default/SKATE-BANANA.png" class="responsive-image" alt="Snowboard Top" />
							</div>
						</div>
					</div>
					<div class="preview-side">
						<div class="board">
							<div class="board-image">
								<div class="board-text"></div>
								<img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-sidewall/sidewall/SKATE-BANANA-YELLOW.png" class="responsive-image sidewall-top" alt="Snowboard Sidewall" />
								<img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-sidewall/default/SKATE-BANANA.png" class="responsive-image sidewall-bottom" alt="Snowboard Sidewall Bottom" />
								<img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-sidewall/default/SKATE-BANANA.png" class="responsive-image sidewall-hidden" alt="Snowboard Sidewall Hidden" />
							</div>
						</div>
					</div>
					<div class="preview-base">
						<div class="board">
							<div class="board-image">
								<div class="board-text">
									<p class="rotate-one">
										<span class="board-text-custom">DIY BOARD!</span>
									</p>
								</div>
								<img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-base/custom-colors-logo/LIB-LOGO-ALL-WHITE.png" class="responsive-image custom-base-logo" alt="Snowboard Base Logo" />
								<img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-base/default/SKATE-BANANA.png" class="responsive-image base" alt="Snowboard Base" />
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<p class="print-disclaimer">* The finished board may not appear exactly as it is shown on the screen.</p>
		<div class="clearfix"></div>

<?php include get_template_directory() . '/_/inc/modules/region-selector.php'; ?>

		<div id="div-blocker"></div>
	</div><!-- END .wrapper -->

	<?php wp_footer(); ?>

	<!--[if lte IE 8]>
	<div id="ie-blocker">
		<h2>We do not support your browser.</h2>
		<p><a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p>
	</div>
	<![endif]-->

	<!-- JavaScript includes -->
<?php include get_template_directory() . '/_/inc/footer-includes-diy-builder.php'; ?>

	<!-- Init the main JS -->
	<script type="text/javascript">
	    $(document).ready(function(){
	        LIBTECH.main.init();
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
