<?php

class AC_Taxonomy_ProgramCategory {

	/**
	 * Builds and registers the custom taxonomy
	 */
	public function __construct() {

		// Taxonomy labels
		$labels = array(
			'name' => __( 'Program Categories', 'agrilife' ),
			'singular_name' => __( 'Program Category', 'agrilife' ),
			'search_items' => __( 'Search Program Categories', 'agrilife' ),
			'all_items' => __( 'All Program Categories', 'agrilife' ),
			'parent_item' => __( 'Parent Program Category', 'agrilife' ),
			'parent_item_colon' => __( 'Parent Program Category:', 'agrilife' ),
			'edit_item' => __( 'Edit Program Category', 'agrilife' ),
			'update_item' => __( 'Update Program Category', 'agrilife' ), 
			'add_new_item' => __( 'Add New Program Category', 'agrilife' ),
			'new_item_name' => __( 'New Program Category Name', 'agrilife' ),
			'menu_name' => __( 'Program Categories', 'agrilife' ),
		);

		// Taxonomy arguments
		$args = array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'rewrite' => array( 'slug' ),
		);

		// Register the ProgramCategory taxonomy
		register_taxonomy( 'program-category', 'location', $args );

	}

}