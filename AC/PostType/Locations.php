<?php

class AC_PostType_Locations {

	private static $instance;

	public function __construct() {

		self::$instance = $this;

		// Backend labels
		$labels = array(
			'name' => __( 'Locations', 'agrilife' ),
			'singular_name' => __( 'Location', 'agrilife' ),
			'add_new' => __( 'Add New', 'agrilife' ),
			'add_new_item' => __( 'Add New Location', 'agrilife' ),
			'edit_item' => __( 'Edit Location', 'agrilife' ),
			'new_item' => __( 'New Location', 'agrilife' ),
			'view_item' => __( 'View Locations', 'agrilife' ),
			'search_items' => __( 'Search Locations', 'agrilife' ),
			'not_found' => __( 'No Locations Found', 'agrilife' ),
			'not_found_in_trash' => __( 'No Locations found in trash', 'agrilife' ),
			'parent_item_colon' => '',
			'menu_name' => __( 'Locations', 'agrilife' ),
		);

		// Post type arguments
		$args = array(
			'labels' => $labels,
			'public' => true,
			'show_ui' => true,
			'rewrite' => array( 'slug' => 'location' ),
			'supports' => array( 'thumbnail' ),
		);

		// Register the Staff post type
		register_post_type( 'location', $args );

		add_action( 'save_post', array( $this, 'save_location_title' ) );

	}

	public function save_location_title( $post_id ) {

    $slug = 'location';

    if ( ! isset( $_POST['post_type'] ) || $slug != $_POST['post_type'] )
      return;

    remove_action( 'save_post', array( $this, 'save_location_title' ) );

    $program_title = rwmb_meta( AC_META_PREFIX . 'program-title', false, $post_id );

    $program_slug = sanitize_title( $program_title );

    $args = array(
      'ID' => $post_id,
      'post_title' => $program_title,
      'post_name' => $program_slug,
    );

    wp_update_post( $args );

    add_action( 'save_post', array( $this, 'save_location_title' ) );

	}

	public static function get_instance() {

		return self::$instance;

	}

}