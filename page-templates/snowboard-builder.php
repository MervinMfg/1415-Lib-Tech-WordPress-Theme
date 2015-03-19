<?php
/*
Template Name: Snowboard Builder
*/
// GET THE REGION
getCurrencyCode();
$page_url = get_site_url() . "/snowboarding/snowboard-builder/";
?>
<!doctype html>
<!--[if lt IE 7 ]> <html class="ie ie6 ie-lt10 ie-lt9 ie-lt8 ie-lt7 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 ie-lt10 ie-lt9 ie-lt8 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 ie-lt10 ie-lt9 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 ie-lt10 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<head id="www-lib-tech-com" data-template-set="lib-tech-wordpress-theme">
	<meta charset="<?php bloginfo('charset'); ?>">
	<!--[if IE ]>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<![endif]-->
	<title>Lib Tech's DIY Board Builder - Build your dream snowboard!</title>
	<meta name="description" content="Lib Tech's DIY Snowboard Builder offers you the opportunity to order a custom, one of a kind, dream snowboard handmade in the USA. Customize your snowboard's shape, size, graphics and more in this online, custom snowboard building tool." />
	<meta name="keywords" content="custom snowboard, custom built snowboard, custom made snowboard, handmade snowboard, made in the USA, build your own, customize" />
	<meta name="author" content="Lib Tech" />
	<meta name="copyright" content="Copyright Lib Tech <?php echo date('Y'); ?>. All Rights Reserved." />
	<!-- FB Meta Data -->
	<meta property="og:title" content="Lib Tech's DIY Board Builder - Build your dream snowboard!" />
	<meta property="og:description" content="This dream snowboard project is probably going to cause us some headaches, but you are going to be stoked! Lib Tech's DIY Board Builder offers you the opportunity to order a custom, one of a kind, dream snowboard that will be guided through our experiMENTAL Division’s prototyping process and handcrafted to your specifications in the USA." />
	<meta property="og:url" content="<?php echo $page_url; ?>" />
	<meta property="og:image" content="<?php bloginfo('template_directory'); ?>/_/img/diy/social-share.png" />
	<meta property="og:type" content="website" />
	<meta property="og:site_name" content="Lib Technologies" />
	<meta property="fb:app_id" content="352899581451617"/>
	<!-- Google+ Meta Data -->
	<meta itemprop="name" content="Lib Tech's DIY Board Builder - Build your dream snowboard!" />
	<meta itemprop="description" content="This dream snowboard project is probably going to cause us some headaches, but you are going to be stoked! Lib Tech's DIY Board Builder offers you the opportunity to order a custom, one of a kind, dream snowboard that will be guided through our experiMENTAL Division’s prototyping process and handcrafted to your specifications in the USA." />
	<meta itemprop="image" content="<?php bloginfo('template_directory'); ?>/_/img/diy/social-share.png" />
	<!-- Google Site Verification -->
	<meta name="google-site-verification" content="wE_gDgt0-MYrOnCO0K7VH2HP7af_DuxpDK1EJFdohFc" />
	<!-- Twitter -->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="@libtechnologies">
	<!-- Fav Icon -->
	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/_/img/favicon.ico" />
	<!-- Mobile -->
	<meta name="viewport" content="initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="format-detection" content="telephone=no" />
	<link rel="apple-touch-icon" href="<?php bloginfo('template_directory'); ?>/_/img/diy/apple-touch-icon-precomposed.png">
	<!-- Misc. -->
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<?php include get_template_directory() . '/_/inc/header-includes-diy-builder.php'; ?>
	<!--[if lt IE 9]>
		<script src="<?php bloginfo('template_directory'); ?>/_/js/lib/respond.min.js"></script>
	<![endif]-->
	<!-- WordPress Head -->
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div class="wrapper">
		<div id="overview">
			<div class="overview-content">
				<h1><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/logo-diy.png" alt="Lib Tech DIY Board Builder" /></h1>
				<h3><span>Welcome to Lib Tech’s DIY Board Builder!</span> Order a custom one of a kind dream snowboard, and Lib Tech’s Bitchin’ Board Builders will handcraft it to your specifications!</h3>
				<div class="left-column">
					<h4>CHOOSE:</h4>
					<ul>
						<li><strong>Board Shape &amp; Contour:</strong> From a selection of 8 different Lib Tech board model chassis including 5 distinct bottom contours.</li>
						<li><strong>Board Size:</strong> Skunk Ape to Banana Blaster, each board model chassis has a range of available sizes to choose from.</li>
						<li><strong>Top Sheet Art:</strong> A collection of classic graphics from longtime Lib artists, now unique to the DIY program.</li>
						<li><strong>Sidewall Colors:</strong> 6 sidewall color options.</li>
						<li><strong>Base Options:</strong> Pick a classic graphic - or - Create a custom 10 Letter knife-cut base. Keep it classy!</li>
						<li><strong>Personalized Badge:</strong> Customize and claim your board with a 26 character custom laser cut badge.</li>
						<li><strong>Buy:</strong> Lib Tech’s Bitchin’ Board Builders will hand build your dream board and ship it to you! Order through your local dealer and receive $25 off! See dealer for details and applicable codes.</li>
					</ul>
					<p>* The finished board may not appear exactly as it is shown on the screen. <strong>DIY board orders take 3-6 weeks to build and ship for United States/Canada, 6-9 weeks for all other countries</strong>, for a list of countries we ship DIY boards <a href="/snowboarding/snowboard-builder/international-countries/" target="_blank">click here</a>. DIY board orders will be charged upon order confirmation. No returns or refunds on customized boards will be accepted or given.</p>
				</div>
				<div class="right-column">
					<a href="#get-started" class="h3">Get Started</a>
					<div class="overview-video">
						<iframe src="http://player.vimeo.com/video/74484020?title=0&amp;byline=0&amp;portrait=0&amp;color=fff100" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
					</div>
				</div>
			</div>
		</div><!-- END #overview -->
		<div id="header">
			<h1 class="logo"><a href="/snowboarding/" target="_blank">Lib Tech DIY Board Builder</a></h1>
			<div class="flag">
				<a href="#region-selector">Handcrafted in the USA near Canada</a>
			</div>
			<div class="top-section">SELECT BOARD - SHAPE &amp; CONTOUR</div>
			<div class="pagination">
				<div class="label">SHAPE</div>
				<div class="controls"></div>
			</div>
			<div class="mobile-flyout-nav">
				<ul>
					<li><a href="#board-display" class="display-board">View Snowboard</a></li>
					<li><a href="#mobile-receipt" class="display-receipt">View Receipt</a></li>
				</ul>
			</div>
		</div><!-- END #header -->
		<div id="left-menu">
		<h1 class="menu-header">Choose Your</h1>
			<div class="menu-close">
				<img src="<?php bloginfo('template_directory'); ?>/_/img/diy/menu-close-button.png" width="20" height="20" alt="Close Menu" />
			</div>
			<ul class="menu-options">
				<li class="menu1">
					<div class="menu-x">X</div>
					<div class="menu-title">Shape &amp; Contour</div>
					<div class="menu-label">board</div>
				</li>
				<li class="menu2">
					<div class="menu-x">X</div>
					<div class="menu-title">Size</div>
					<div class="menu-label">size</div>
				</li>
				<li class="menu3">
					<div class="menu-x">X</div>
					<div class="menu-title">Top Sheet Art</div>
					<div class="menu-label">top</div>
				</li>
				<li class="menu4">
					<div class="menu-x">X</div>
					<div class="menu-title">Sidewall Color</div>
					<div class="menu-label">sidewall</div>
				</li>
				<li class="menu5">
					<div class="menu-x">X</div>
					<div class="menu-title">Base Options</div>
					<div class="menu-label">base</div>
				</li>
				<li class="menu5b">
					<div class="menu-x">X</div>
					<div class="menu-title">Text</div>
					<div class="menu-label">custom</div>
				</li>
				<li class="menu6">
					<div class="menu-x">X</div>
					<div class="menu-title">Personalized Badge</div>
					<div class="menu-label">badge</div>
				</li>
				<li class="menu7">
					<div class="menu-x"></div>
					<div class="menu-title">Your Custom Board</div>
					<div class="menu-label">buy &nbsp;&nbsp; <img src="<?php bloginfo('template_directory'); ?>/_/img/diy/left-menu-right-arrow.png" alt=">" /></div>
				</li>
			</ul>
		</div><!-- END #leftmenu" -->
		<div id="advance-arrow"></div>
		<div class="miniReciept" id="mobile-receipt">
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
		<div id="info-box">
			<div class="diamond"></div>
			<div class="box">
				<h2>BTX Skate Banana - Board</h2>
				<h3>DESC</h3>
				<div class="contour">
					<img src="<?php bloginfo('template_directory'); ?>/_/img/diy/contour-none.jpg" alt="Snowboard Contour" />
				</div>
				<h4>POWER</h4>
				<div class="sizes">
					<p>SIZES <span></span></p>
				</div>
				<h5></h5>
			</div>
		</div><!-- END #info-box -->
		<div id="board-display">
			<div class="board-name"></div>
			<div class="board-menu-left-button"></div>
			<div class="board-menu-right-button"></div>
			<div class="board-preview">
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
		<ul class="bx-div-slider">
			<!-- STEP 1 - BOARD -->
			<li>
				<div class="step1-board">
					<div class="carousel-container">
						<div class="carousel">
							<ul>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-top/default/SKATE-BANANA.png" alt="Skate Banana" id="defaultShapeImage" data-shapenum="1" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-top/default/ATTACK-BANANA.png" alt="Attack Banana" data-shapenum="2" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-top/default/TRAVIS-RICE-PRO-BLUNT.png" alt="Travis Rice Pro Blunt" data-shapenum="3" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-top/default/TRAVIS-RICE-PRO-POINTY.png" alt="Travis Rice Pro Pointy" data-shapenum="4" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-top/default/TRS.png" alt="TRS" data-shapenum="5" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-top/default/HOT-KNIFE.png" alt="Hot Knife" data-shapenum="6" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-top/default/SKUNK-APE.png" alt="Skunk Ape" data-shapenum="7" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-top/default/BANANA-BLASTER.png" alt="Banana Blaster" data-shapenum="8" /></li>
							</ul>
						</div>
					</div>
				</div>
			</li>
			<!-- STEP 2 - SIZE -->
			<li>
				<div class="step2-size">
					<div class="board-info">
						<div class="board">BTX - Skate Banana</div>
						<div class="shape-desc"></div>
						<div class="board-tagline"></div>
						<div class="board-desc"></div>
						<div class="contour-title"></div>
						<div class="contour-desc"></div>
					</div>
					<div class="size-info">
						<h3 class="size-cta">SELECT SIZE</h3>
						<div class="size-holder">
							<div class="sizes"></div>
						</div>
						<div class="size-detail-table">
							<div class="table-data"></div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</li>
			<!-- STEP 3 - TOP SHEET -->
			<li>
				<div class="step3-top">
					<div class="carousel-container">
						<div class="carousel">
							<ul>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-top/art/TETONS-RED.png" alt="Tetons Red Top" class="responsive-image board-top-image" data-count="1" data-artist="Tetons" data-desc="Red" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-top/art/TETONS-BLUE.png" alt="Tetons Blue Top" class="responsive-image board-top-image" data-count="1" data-artist="Tetons" data-desc="Blue" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-top/art/TETONS-PINK.png" alt="Tetons Pink Top" class="responsive-image board-top-image" data-count="1" data-artist="Tetons" data-desc="Pink" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-top/art/JAMIE-OCTOPUS.png" alt="Jamie Lynn Octopus Top" class="responsive-image board-top-image" data-count="2" data-artist="Jamie" data-desc="Octopus" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-top/art/JAMIE-WHALE.png" alt="Jamie Lynn Whale Top" class="responsive-image board-top-image" data-count="2" data-artist="Jamie" data-desc="Whale" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-top/art/JAMIE-SUN.png" alt="Jamie Lynn Sun Top" class="responsive-image board-top-image" data-count="2" data-artist="Jamie" data-desc="Sun Wave" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-top/art/JAMIE-GIRL.png" alt="Jamie Lynn Girl Top" class="responsive-image board-top-image" data-count="3" data-artist="Jamie" data-desc="Girl" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-top/art/JAMIE-WAVE.png" alt="Jamie Lynn Wave Top" class="responsive-image board-top-image" data-count="4" data-artist="Jamie" data-desc="Wave" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-top/art/HUMMINGBIRD-RED.png" alt="Hummingbird Red Top" class="responsive-image board-top-image" data-count="5" data-artist="Hummingbird" data-desc="Red" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-top/art/GUITAR-SKULL.png" alt="Guitar Skull Top" class="responsive-image board-top-image" data-count="6" data-artist="Guitar" data-desc="Skull" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-top/art/POLY-GREEN.png" alt="Poly Green Top" class="responsive-image board-top-image" data-count="7" data-artist="Poly" data-desc="Green" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-top/art/POLY-BLUE.png" alt="Poly Blue Top" class="responsive-image board-top-image" data-count="7" data-artist="Poly" data-desc="Blue" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-top/art/SKELETON-YELLOW.png" alt="Skeleton Yellow Top" class="responsive-image board-top-image" data-count="8" data-artist="Skeleton" data-desc="Yellow" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-top/art/SKELETON-BLUE.png" alt="Skeleton Blue Top" class="responsive-image board-top-image" data-count="8" data-artist="Skeleton" data-desc="Blue" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-top/art/SKELETON-PINK.png" alt="Skeleton Pink Top" class="responsive-image board-top-image" data-count="8" data-artist="Skeleton" data-desc="Pink" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-top/art/SKELETON-GREEN.png" alt="Skeleton Green Top" class="responsive-image board-top-image" data-count="8" data-artist="Skeleton" data-desc="Green" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-top/art/LOGO-BLACK.png" alt="Logo Black Top" class="responsive-image board-top-image" data-count="9" data-artist="Logo" data-desc="Black" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-top/art/LOGO-WHITE.png" alt="Logo White Top" class="responsive-image board-top-image" data-count="9" data-artist="Logo" data-desc="White" /></li>
							</ul>
						</div>
					</div>
				</div>
			</li>
			<!-- STEP 4 - SIDEWALL -->
			<li>
				<div class="step4-sidewall">
					<div class="carousel-container">
						<div class="carousel">
							<ul>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-sidewall/colors/BLUE.png" alt="Black/Blue Sidewall" class="responsive-image" data-count="1" data-color="Black/Blue" data-desc="Blue" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-sidewall/colors/GREEN.png" alt="Black/Slime Green Sidewall" class="responsive-image" data-count="2" data-color="Black/Slime Green" data-desc="Slime Green" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-sidewall/colors/ORANGE.png" alt="Black/Orange Sidewall" class="responsive-image" data-count="3" data-color="Black/Orange" data-desc="Orange" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-sidewall/colors/RED.png" alt="Black/Red Sidewall" class="responsive-image" data-count="4" data-color="Black/Red" data-desc="Red" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-sidewall/colors/WHITE.png" alt="Black/White Sidewall" class="responsive-image" data-count="5" data-color="Black/White" data-desc="White" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-sidewall/colors/YELLOW.png" alt="Black/Yellow Sidewall" class="responsive-image" data-count="6" data-color="Black/Yellow" data-desc="Yellow" /></li>
							</ul>
						</div>
					</div>
				</div>
			</li>
			<!-- STEP 5 - BASE -->
			<li>
				<div class="step5-base">
					<div class="carousel-container">
						<div class="carousel">
							<ul>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-base/art/KNIFE-CUT.png" alt="Custom Base" class="responsive-image board-base-image" id="customBase" data-count="0" data-artist="Custom" data-desc="Custom" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-base/art/TETONS-RED.png" alt="Tetons Red Base" class="responsive-image board-base-image" data-count="1" data-artist="Tetons" data-desc="Red" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-base/art/TETONS-BLUE.png" alt="Tetons Blue Base" class="responsive-image board-base-image" data-count="1" data-artist="Tetons" data-desc="Blue" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-base/art/TETONS-PINK.png" alt="Tetons Pink Base" class="responsive-image board-base-image" data-count="1" data-artist="Tetons" data-desc="Pink" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-base/art/JAMIE-OCTOPUS.png" alt="Jamie Lynn Octopus Base" class="responsive-image board-base-image" data-count="2" data-artist="Jamie" data-desc="Octopus" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-base/art/JAMIE-WHALE.png" alt="Jamie Lynn Whale Base" class="responsive-image board-base-image" data-count="2" data-artist="Jamie" data-desc="Whale" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-base/art/JAMIE-SUN.png" alt="Jamie Lynn Sun Base" class="responsive-image board-base-image" data-count="2" data-artist="Jamie" data-desc="Sun Wave" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-base/art/JAMIE-GIRL.png" alt="Jamie Lynn Girl Base" class="responsive-image board-base-image" data-count="3" data-artist="Jamie" data-desc="Girl" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-base/art/JAMIE-WAVE.png" alt="Jamie Lynn Wave Base" class="responsive-image board-base-image" data-count="4" data-artist="Jamie" data-desc="Wave" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-base/art/HUMMINGBIRD-RED.png" alt="Hummingbird Red Base" class="responsive-image board-base-image" data-count="5" data-artist="Hummingbird" data-desc="Red" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-base/art/GUITAR-SKULL.png" alt="Guitar Skull Base" class="responsive-image board-base-image" data-count="6" data-artist="Guitar" data-desc="Skull" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-base/art/POLY-GREEN.png" alt="Poly Green Base" class="responsive-image board-base-image" data-count="7" data-artist="Poly" data-desc="Green" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-base/art/POLY-BLUE.png" alt="Poly Blue Base" class="responsive-image board-base-image" data-count="7" data-artist="Poly" data-desc="Blue" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-base/art/SKELETON-GREY.png" alt="Skeleton Grey Base" class="responsive-image board-base-image" data-count="8" data-artist="Skeleton" data-desc="Grey" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-base/art/LOGO-BLACK.png" alt="Logo Black Base" class="responsive-image board-base-image" data-count="9" data-artist="Logo" data-desc="Black" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-base/art/LOGO-WHITE.png" alt="Logo White Base" class="responsive-image board-base-image" data-count="9" data-artist="Logo" data-desc="White" /></li>
								<li class="item"><img src="<?php bloginfo('template_directory'); ?>/_/img/diy/snowboard-base/art/LOGO-GREY.png" alt="Logo Grey Base" class="responsive-image board-base-image" data-count="9" data-artist="Logo" data-desc="Grey" /></li>
							</ul>
						</div>
					</div>
				</div>
			</li>
			<!-- STEP 5b - BASE TEXT -->
			<li>
				<div class="step5b-base-text">
					<div id="knifecut-base-controls">
						<p><label for="board-text-input">Base Text</label></p>
						<div class="knifecut-input">
							<input type="text" id="board-text-input" value="10 CHARACTER MAX" name="board" maxlength="10" />
						</div>
						<div class="letter-color">
							<p>Letter Color</p>
							<div class="box-grey color"></div>
							<div class="box-orange color"></div>
							<div class="box-yellow color"></div>
							<div class="box-black color"></div>
							<div class="box-white color"></div>
							<div class="box-green color"></div>
							<div class="box-blue color"></div>
							<div class="box-red color"></div>
							<div class="clearfix"></div>
						</div>
						<div class="base-color">
							<p>Base Color</p>
							<div class="box-grey color"></div>
							<div class="box-orange color"></div>
							<div class="box-yellow color"></div>
							<div class="box-black color"></div>
							<div class="box-white color"></div>
							<div class="box-green color"></div>
							<div class="box-blue color"></div>
							<div class="box-red color"></div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</li>
			<!-- STEP 6 - BADGE TEXT -->
			<li>
				<div class="step6-badge">
					<div class="board-badge">
						<div class="badge-text"></div>
						<div class="badge-size"></div>
					</div>
					<div class="board-badge-input-holder">
						<p><label for="board-badge-input">Badge Text</label></p>
						<input type="text" id="board-badge-input" value="26 CHARACTER MAX" name="badge" maxlength="26" />
					</div>
				</div>
			</li>
			<!-- STEP 7 - BUY -->
			<li>
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
						<div class="social-icons">
							<p>Share<span> with your friends</span></p>
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
			</li>
		</ul>
		<div id="region-selector">
			<div class="choose-region">
				<h5 class="h1">Choose your region</h5>
				<div class="location-group north-america">
					<h6 class="location-title h4">North America</h6>
					<ul class="location-list">
						<li class="location-item">
							<p><a href="#region-selector" data-currency="USD"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/usa.gif" alt="USA Flag" />United States <span>(USD)</span></a> Shop in US currency</p>
						</li>
						<li class="location-item">
							<p><a href="#region-selector" data-currency="CAD"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/canada.gif" alt="Canada Flag" />Canada <span>(CAD)</span></a> Shop in CANADA currency</p>
						</li>
					</ul>
				</div>
				<div class="location-group europe">
					<h6 class="location-title h4">Europe</h6>
					<p class="location-note">Shop in EURO currency</p>
					<ul class="location-list">
						<li class="location-item">
							<p><a href="#region-selector" data-currency="EUR"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/austria.gif" alt="Austria Flag" />Austria <span>(EUR)</span></a></p>
						</li>
						<li class="location-item">
							<p><a href="#region-selector" data-currency="EUR"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/belgium.gif" alt="Belgium Flag" />Belgium <span>(EUR)</span></a></p>
						</li>
						<li class="location-item">
							<p><a href="#region-selector" data-currency="EUR"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/czech.gif" alt="Czech Republic Flag" />Czech Republic <span>(EUR)</span></a></p>
						</li>
						<li class="location-item">
							<p><a href="#region-selector" data-currency="EUR"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/france.gif" alt="France Flag" />France <span>(EUR)</span></a></p>
						</li>
						<li class="location-item">
							<p><a href="#region-selector" data-currency="EUR"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/germany.gif" alt="Germany Flag" />Germany <span>(EUR)</span></a></p>
						</li>
						<li class="location-item">
							<p><a href="#region-selector" data-currency="EUR"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/luxembourg.gif" alt="Luxembourg Flag" />Luxembourg <span>(EUR)</span></a></p>
						</li>
						<li class="location-item">
							<p><a href="#region-selector" data-currency="EUR"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/netherlands.gif" alt="Netherlands Flag" />Netherlands <span>(EUR)</span></a></p>
						</li>
						<li class="location-item">
							<p><a href="#region-selector" data-currency="EUR"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/poland.gif" alt="Poland Flag" />Poland <span>(EUR)</span></a></p>
						</li>
						<li class="location-item">
							<p><a href="#region-selector" data-currency="EUR"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/portugal.gif" alt="Portugal Flag" />Portugal <span>(EUR)</span></a></p>
						</li>
						<li class="location-item">
							<p><a href="#region-selector" data-currency="EUR"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/slovakia.gif" alt="Slovakia Flag" />Slovakia <span>(EUR)</span></a></p>
						</li>
					</ul>
				</div>
				<div class="location-group international">
					<h6 class="location-title h4">World</h6>
					<p class="location-note">View site in English</p>
					<ul class="location-list">
						<li class="location-item">
							<p><a href="#region-selector" data-currency="INT"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flags/international.gif" alt="International Flag" />International</a></p>
						</li>
					</ul>
				</div>
			</div>
		</div><!-- END #region-selector -->
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
