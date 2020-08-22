<?php
	function theme_support() {
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_theme_support( 'title-tag' );
	}

	add_action( 'after_setup_theme', 'theme_support' );
