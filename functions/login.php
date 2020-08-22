<?php
	function login_css() {
		wp_enqueue_style( 'login_css', get_template_directory_uri() . '/assets/dist/css/login.css', false );
	}

	// changing the logo link from wordpress.org to your site
	function login_url() {  return home_url(); }

	// changing the alt text on the logo to show your site name
	function login_title() { return get_option('blogname'); }

	// calling it only on the login page
	add_action( 'login_enqueue_scripts', 'login_css', 10 );
	add_filter('login_headerurl', 'login_url');
	add_filter('login_headertitle', 'login_title');
