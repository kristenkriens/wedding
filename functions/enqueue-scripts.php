<?php
  function site_scripts() {
    global $wp_styles;

    wp_enqueue_script( 'jquery', get_template_directory_uri() . '/vendor/jquery.min.js', false, '2.2.4', true );

    wp_enqueue_script( 'slick', get_template_directory_uri() . '/vendor/slick.min.js', array( 'jquery' ), '1.8.1', true );
    wp_enqueue_script( 'jquery-lazy', get_template_directory_uri() . '/vendor/jquery.lazy.min.js', array( 'jquery' ), '1.15.0', true );
    wp_enqueue_script( 'object-fit', get_template_directory_uri() . '/vendor/objectFitPolyfill.min.js', false, '1.7.10', true );
    wp_enqueue_script( 'intersection-observer', get_template_directory_uri() . '/vendor/intersectionObserver.js', false, '1.0.0', true );

    // Adding main scripts
    wp_enqueue_script( 'site-js', get_template_directory_uri() . '/dist/js/scripts.js', array( 'jquery' ), '', true );

    // Register main stylesheet
    wp_enqueue_style( 'site-css', get_template_directory_uri() . '/dist/css/styles.css', array(), '', 'all' );
  }
  add_action('wp_enqueue_scripts', 'site_scripts', 999);
