<?php

class AC_Taxonomy_TimeOffered {

	/**
	 * Builds and registers the custom taxonomy
	 */
	public function __construct() {

		// Taxonomy labels
		$labels = array(
			'name' => __( 'Times Offered', 'agrilife' ),
			'singular_name' => __( 'Time Offered', 'agrilife' ),
			'search_items' => __( 'Search Times Offered', 'agrilife' ),
			'all_items' => __( 'All Times Offered', 'agrilife' ),
			'parent_item' => __( 'Parent Time Offered', 'agrilife' ),
			'parent_item_colon' => __( 'Parent Time Offered:', 'agrilife' ),
			'edit_item' => __( 'Edit Time Offered', 'agrilife' ),
			'update_item' => __( 'Update Time Offered', 'agrilife' ), 
			'add_new_item' => __( 'Add New Time Offered', 'agrilife' ),
			'new_item_name' => __( 'New Time Offered Name', 'agrilife' ),
			'menu_name' => __( 'Times Offered', 'agrilife' ),
		);

		// Taxonomy arguments
		$args = array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'rewrite' => array( 'slug' ),
		);

		// Register the TimeOffered taxonomy
		register_taxonomy( 'time-offered', 'location', $args );

	}

}