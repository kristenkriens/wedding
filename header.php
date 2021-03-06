<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
	<head>
		<meta charset="utf-8">
		<!-- Force IE to use the latest rendering engine available -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php $accentColour = get_field('accent_colour', 'options'); ?>
		<?php $accentColourAlt = get_field('accent_colour_alternate', 'options'); ?>
		<!-- If Site Icon isn't set in customizer -->
		<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) : ?>
			<!-- Icons & Favicons -->
			<link rel="icon" href="<?php echo IMGPATH; ?>/favicon.png">
			<link href="<?php echo IMGPATH; ?>/favicon.png" rel="apple-touch-icon" />
			<!--[if IE]>
				<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico">
			<![endif]-->
			<meta name="msapplication-TileColor" content="<?php echo $accentColour; ?>">
			<meta name="msapplication-TileImage" content="<?php echo IMGPATH; ?>/favicon.png">
	  <?php endif; ?>
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		<?php wp_head(); ?>
	  <meta name="theme-color" content="<?php echo $accentColour; ?>">
		<style>
			:root {
				--accent-rgb: <?php echo hex_to_rgb($accentColour); ?>;

				--accent: rgba(var(--accent-rgb), 1);
				--accent-2: rgba(var(--accent-rgb), 0.85);
				--accent-3: rgba(var(--accent-rgb), 0.7);
				--accent-4: rgba(var(--accent-rgb), 0.55);
				--accent-5: rgba(var(--accent-rgb), 0.4);
				--accent-6: rgba(var(--accent-rgb), 0.25);
				--accent-7: rgba(var(--accent-rgb), 0.25);
			}
		</style>
	</head>
	<body class="<?php echo $bodyClasses; ?>">
		<?php include_once('dist/assets/images/svg/sprite/svg.svg'); ?>
		<a href="#main" class="skipnav accessible">Skip to Main Content</a>
		<header class="header" role="banner">
			<button class="header__toggle">
				<span class="h2">
					<span class="accessible closed">Open</span>
					<span class="accessible opened">Close</span>
					Menu
				</span>
				<div class="hamburger">
					<div></div>
					<div></div>
					<div></div>
				</div>
			</button>
			<nav>
				<?php $form = get_field('form', 'options'); ?>
				<ul>
					<li data-animation="fade-in-up"><a href="#home" class="is-active">Home</a></li>
					<li data-animation="fade-in-up" data-animation-delay="100"><a href="#program">Program</a></li>
					<li data-animation="fade-in-up" data-animation-delay="200"><a href="#venue">Venue</a></li>
					<li data-animation="fade-in-up" data-animation-delay="300"><a href="#faqs">FAQs</a></li>
					<li data-animation="fade-in-up" data-animation-delay="400"><a href="#registry">Registry</a></li>
					<li data-animation="fade-in-up" data-animation-delay="500"><a href="#form"><?php echo $form['title']; ?></a></li>
				</ul>
			</nav>
			<div class="header__overlay"></div>
		</header>
	  <main id="main">
			<div id="particles-js" class="particles"></div>
