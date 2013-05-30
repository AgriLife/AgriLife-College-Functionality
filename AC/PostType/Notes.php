<?php

class AC_PostType_Notes {

	private static $instance;

	public function __construct() {

		self::$instance = $this;

		// Backend labels
		$labels = array(
			'name' => __( 'Notes', 'agrilife' ),
			'singular_name' => __( 'Note', 'agrilife' ),
			'add_new' => __( 'Add New', 'agrilife' ),
			'add_new_item' => __( 'Add New Note', 'agrilife' ),
			'edit_item' => __( 'Edit Note', 'agrilife' ),
			'new_item' => __( 'New Note', 'agrilife' ),
			'view_item' => __( 'View Notes', 'agrilife' ),
			'search_items' => __( 'Search Notes', 'agrilife' ),
			'not_found' => __( 'No Notes Found', 'agrilife' ),
			'not_found_in_trash' => __( 'No Notes found in trash', 'agrilife' ),
			'parent_item_colon' => '',
			'menu_name' => __( 'Notes', 'agrilife' ),
		);

		// Post type arguments
		$args = array(
			'labels' => $labels,
			'public' => true,
			'show_ui' => true,
			'rewrite' => array( 'slug' => 'note' ),
			'supports' => array( 'thumbnail' ),
		);

		// Register the Staff post type
		register_post_type( 'note', $args );

	}

	public static function get_instance() {

		return self::$instance;

	}

}