<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package menofiron
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<link href='https://fonts.googleapis.com/css?family=Raleway:300,400' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Cabin:400,600,600italic,400italic' rel='stylesheet' type='text/css'>


<?php wp_head(); ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-83187206-1', 'auto');
  ga('send', 'pageview');

</script>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'menofiron' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<div class="secondary-nav-wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xs-12 col-sm-10 col-sm-offset-1">
							<div class="collapse" id="secondaryMenu">
								<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary-menu' ) ); ?>
								<div class="clear"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="clear"></div>
			<div class="site-brand">
				<a href="/">
					<?php include (TEMPLATEPATH . '/images/men-of-iron-logo.svg'); ?>


				</a>
			</div>
			<div class="primary-nav-wrapper">

				<a id="nav-icon" class="btn hamburger" type="button" data-toggle="collapse" data-target="#secondaryMenu" aria-expanded="false" aria-controls="collapseExample">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
				</a>
				
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
			</div><!-- .primary-nav-wrapper -->
			
		</nav><!-- #site-navigation -->
		<div class="clear"></div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
				
