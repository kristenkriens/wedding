<?php
	function custom_post_example() {
		register_post_type( 'custom_type',
			array('labels' => array(
				'name' => __('Custom Types'), /* This is the Title of the Group */
				'singular_name' => __('Custom Type'), /* This is the individual type */
				'all_items' => __('All Custom Types'), /* the all items menu item */
				'add_new' => __('Add New'), /* The add new menu item */
				'add_new_item' => __('Add New Custom Type'), /* Add New Display Title */
				'edit' => __( 'Edit' ), /* Edit Dialog */
				'edit_item' => __('Edit Custom Types'), /* Edit Display Title */
				'new_item' => __('New Custom Type'), /* New Display Title */
				'view_item' => __('View Custom Type'), /* View Display Title */
				'search_items' => __('Search Custom Type'), /* Search Custom Type Title */
				'not_found' =>  __('Nothing found in the Database.'), /* This displays if there are no entries yet */
				'not_found_in_trash' => __('Nothing found in Trash'), /* This displays if there is nothing in the trash */
				'parent_item_colon' => ''
				), /* end of arrays */
				'description' => __( 'This is the example custom post type' ), /* Custom Type Description */
				'public' => true,
				'publicly_queryable' => true,
				'exclude_from_search' => false,
				'show_ui' => true,
				'query_var' => true,
				'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
				'menu_icon' => 'dashicons-book', /* the icon for the custom post type menu. uses built-in dashicons (CSS class name) */
				'rewrite'	=> array( 'slug' => 'custom_type', 'with_front' => false ), /* you can specify its url slug */
				'has_archive' => 'custom_type', /* you can rename the slug here */
				'capability_type' => 'post',
				'hierarchical' => false,
				/* the next one is important, it tells what's enabled in the post editor */
				'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
		 	) /* end of options */
		); /* end of register post type */
	}

	// adding the function to the Wordpress init
	add_action( 'init', 'custom_post_example');
