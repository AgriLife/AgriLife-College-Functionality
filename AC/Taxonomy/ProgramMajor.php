		<?php

class AC_Taxonomy_ProgramMajor {

	/**
	 * Builds and registers the custom taxonomy
	 */
	public function __construct() {

		// Taxonomy labels
		$labels = array(
			'name' => __( 'Program Majors', 'agrilife' ),
			'singular_name' => __( 'Program Major', 'agrilife' ),
			'search_items' => __( 'Search Program Majors', 'agrilife' ),
			'all_items' => __( 'All Program Majors', 'agrilife' ),
			'parent_item' => __( 'Parent Program Major', 'agrilife' ),
			'parent_item_colon' => __( 'Parent Program Major:', 'agrilife' ),
			'edit_item' => __( 'Edit Program Major', 'agrilife' ),
			'update_item' => __( 'Update Program Major', 'agrilife' ), 
			'add_new_item' => __( 'Add New Program Major', 'agrilife' ),
			'new_item_name' => __( 'New Program Major Name', 'agrilife' ),
			'menu_name' => __( 'Program Majors', 'agrilife' ),
		);

		// Taxonomy arguments
		$args = array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'rewrite' => array( 'slug' ),
		);

		// Register the ProgramMajor taxonomy
		register_taxonomy( 'program-major', array( 'location', 'staff' ), $args );

	}

}