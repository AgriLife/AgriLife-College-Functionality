<?php

class AC_Taxonomy_ProgramDepartment {

	/**
	 * Builds and registers the custom taxonomy
	 */
	public function __construct() {

		// Taxonomy labels
		$labels = array(
			'name' => __( 'Program Departments', 'agrilife' ),
			'singular_name' => __( 'Program Department', 'agrilife' ),
			'search_items' => __( 'Search Program Departments', 'agrilife' ),
			'all_items' => __( 'All Program Departments', 'agrilife' ),
			'parent_item' => __( 'Parent Program Department', 'agrilife' ),
			'parent_item_colon' => __( 'Parent Program Department:', 'agrilife' ),
			'edit_item' => __( 'Edit Program Department', 'agrilife' ),
			'update_item' => __( 'Update Program Department', 'agrilife' ), 
			'add_new_item' => __( 'Add New Program Department', 'agrilife' ),
			'new_item_name' => __( 'New Program Department Name', 'agrilife' ),
			'menu_name' => __( 'Program Departments', 'agrilife' ),
		);

		// Taxonomy arguments
		$args = array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'rewrite' => array( 'slug' ),
		);

		// Register the ProgramDepartment taxonomy
		register_taxonomy( 'program-department', 'location', $args );

	}

}