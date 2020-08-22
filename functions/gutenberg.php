<?php
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'				=> 'image',
      'title'				=> __('Image'),
      'render_callback'	=> 'acf_block_callback',
      'category'				=> 'blocks',
      'icon'				  	=> 'format-image',
      'keywords'		 		=> array( 'image' ),
      'mode'						=> 'edit'
    ));
  }

  function custom_admin_css_for_gutenberg() {
    echo '<style type="text/css">
    /* Main column width */
    .wp-block {
      max-width: 80%;
    }
    /* Width of "wide" blocks */
    .wp-block[data-align="wide"] {
       max-width: 1080px;
    }
    /* Width of "full-wide" blocks */
    .wp-block[data-align="full"] {
      max-width: none;
    }
    </style>';
  }

  add_action('admin_head', 'custom_admin_css_for_gutenberg');
  function acf_block_callback($block) {
    $slug = str_replace('acf/', '', $block['name']);
    if( file_exists( get_theme_file_path('parts/components/blocks/' . $slug . '.php') ) ) {
      include( get_theme_file_path('parts/components/blocks/' . $slug . '.php') );
    }
  }
  function block_category($categories, $post) {
    return array_merge(
      $categories,
      array(
        array(
          'slug' => 'blocks',
          'title' => __( 'Custom', 'blocks' ),
        ),
      )
    );
  }
  add_filter( 'block_categories', 'block_category', 10, 2);
  function remove_unwanted_gutenberg_blocks( $allowed_block_types ) {
    return array(
      'core/paragraph',
      'core/list',
      'core/embed',
      'core/heading',
      'acf/image'
    );
  }
  add_filter( 'allowed_block_types', 'remove_unwanted_gutenberg_blocks' );

  /**
   * Disable Editor
   *
   * @package      ClientName
   * @author       Bill Erickson
   * @since        1.0.0
   * @license      GPL-2.0+
  **/

  /**
   * Page IDs without editor
   *
   */
  function ea_disable_editor( $id = false ) {

  $excluded_templates = array(

  );

  $excluded_ids = array(
    get_option( 'page_on_front' ), // Homepage
    get_option( 'page_for_posts' ) // Blog
  );

  if( empty( $id ) )
  return false;

  $id = intval( $id );
  $template = get_page_template_slug( $id );

  return in_array( $id, $excluded_ids ) || in_array( $template, $excluded_templates );
  }

  /**
   * Disable Gutenberg by page/template
   *
   */
  function ea_disable_gutenberg( $can_edit, $post_type ) {

  if( ! ( is_admin() && !empty( $_GET['post'] ) ) )
  return $can_edit;

  if( ea_disable_editor( $_GET['post'] ) )
  $can_edit = false;

  return $can_edit;

  }
  add_filter( 'gutenberg_can_edit_post_type', 'ea_disable_gutenberg', 10, 2 );
  add_filter( 'use_block_editor_for_post_type', 'ea_disable_gutenberg', 10, 2 );

  /**
   * Disable Classic Editor by page/template
   *
   */
  function ea_disable_classic_editor() {

  $screen = get_current_screen();
  if( 'page' !== $screen->id || ! isset( $_GET['post']) )
  return;

  if( ea_disable_editor( $_GET['post'] ) ) {
  remove_post_type_support( 'page', 'editor' );
  }

  }
  add_action( 'admin_head', 'ea_disable_classic_editor' );
