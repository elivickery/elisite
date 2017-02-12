<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<title><?php wp_title(''); ?></title>

		<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/favicon.ico" type="image/x-icon" />
		<link rel="apple-touch-icon-precomposed" sizes="16x16" href="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/favicon-16x16.png">
		<link rel="apple-touch-icon-precomposed" sizes="32x32" href="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/favicon-32x32.png">
		<link rel="apple-touch-icon-precomposed" href="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/apple-touch-icon.png">

		<script src="https://use.typekit.net/lbp8xuu.js"></script>
		<script>try{Typekit.load({ async: true });}catch(e){}</script>
		<script>
 			 (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
 			 (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
 			 m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
 			 })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

 			 ga('create', 'UA-90617055-1', 'auto');
 			 ga('send', 'pageview');
		</script>

		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
		<div id="page">

				
				<?php global $post; ?>

				<?php

				$header_bg	= '';
				$header_class = '';

				$logo = get_field('logo','option');
				$logo_reverse = get_field('logo_reverse','option');

				if(is_home()) {

				$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_option('page_for_posts') ), 'full' );

				} else {

				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' )	;
						
				}


				if( $image ) {

					$header_bg	= CC\resize( $image[0], array('width' => 1700, 'height' => 700) );

					$header_class	= 'backstretchable ';

				}


				if(!get_the_content()) {

					if($image) {

						$header_class = 'backstretchable nocontent';

					} else {
						$header_class = 'nocontent';
					}

				}

				?>

			<header id="header" class="<?php echo $header_class; ?>" data-bg="<?php echo $header_bg ?>" role="banner">


				<div class="upper block">
					<div class="container">
						<div class="row">
							<nav role="navigation" class="col-xs-12">
								<a id="logolink" href="<?php bloginfo('url'); ?>">
									<img id="logo" class="logo" alt="Eli Vickery" src="<?php echo $logo; ?>" />
									<img id="logo_reverse" class="logo" alt="Eli Vickery" src="<?php echo $logo_reverse; ?>" />
								</a>
								<div class="hamburger hidden-md-up clearfix">
									<div class="top bar"></div>
									<div class="middle bar"></div>
									<div class="bottom bar"></div>
								</div>
								<?php wp_nav_menu( array('theme_location' => 'main-menu', 'container_id' => 'main-menu') ); ?>
							</nav>
						</div><!-- .row -->
					</div><!-- .container -->
				</div><!-- .upper -->




						<div class="container headercontent">

						<?php if(is_front_page()) {

							echo '<img class="headerlogo" src="' . $logo . '" alt="Eli Vickery" />';
							echo '<p>' . get_bloginfo('description') . '</p>';

							echo '<a data-scroll href="#portfolio"><i class="fa fa-angle-down" aria-hidden="true"></i></a>';

						} else if(is_404()) {

							echo '<h1>Oops! Nothing to see here.</h1>';
						} else {
							echo '<h1>' . CC\get_page_title(); '</h1>';
						}

						?>
<!-- 
						<?php if(is_front_page()) {

						$buttonlink = get_field('button_link');
						$buttontext = get_field('button_text');
						
						if($buttontext) { ?>
							<a href="<?php echo $buttonlink; ?>" class="button"><?php echo $buttontext; ?></a>
						<?php } ?>

						<?php } ?> -->

						</div>



			</header>
			<main id="main" role="main">
