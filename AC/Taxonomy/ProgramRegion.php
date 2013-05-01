		<?php

class AC_Taxonomy_ProgramRegion {

	/**
	 * Builds and registers the custom taxonomy
	 */
	public function __construct() {

		// Taxonomy labels
		$labels = array(
			'name' => __( 'Program Regions', 'agrilife' ),
			'singular_name' => __( 'Program Region', 'agrilife' ),
			'search_items' => __( 'Search Program Regions', 'agrilife' ),
			'all_items' => __( 'All Program Regions', 'agrilife' ),
			'parent_item' => __( 'Parent Program Region', 'agrilife' ),
			'parent_item_colon' => __( 'Parent Program Region:', 'agrilife' ),
			'edit_item' => __( 'Edit Program Region', 'agrilife' ),
			'update_item' => __( 'Update Program Region', 'agrilife' ), 
			'add_new_item' => __( 'Add New Program Region', 'agrilife' ),
			'new_item_name' => __( 'New Program Region Name', 'agrilife' ),
			'menu_name' => __( 'Program Regions', 'agrilife' ),
		);

		// Taxonomy arguments
		$args = array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'rewrite' => array( 'slug' ),
		);

		// Register the ProgramRegion taxonomy
		register_taxonomy( 'program-region', 'location', $args );

	}

}