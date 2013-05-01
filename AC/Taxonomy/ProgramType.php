		<?php

class AC_Taxonomy_ProgramType {

	/**
	 * Builds and registers the custom taxonomy
	 */
	public function __construct() {

		// Taxonomy labels
		$labels = array(
			'name' => __( 'Program Types', 'agrilife' ),
			'singular_name' => __( 'Program Type', 'agrilife' ),
			'search_items' => __( 'Search Program Types', 'agrilife' ),
			'all_items' => __( 'All Program Types', 'agrilife' ),
			'parent_item' => __( 'Parent Program Type', 'agrilife' ),
			'parent_item_colon' => __( 'Parent Program Type:', 'agrilife' ),
			'edit_item' => __( 'Edit Program Type', 'agrilife' ),
			'update_item' => __( 'Update Program Type', 'agrilife' ), 
			'add_new_item' => __( 'Add New Program Type', 'agrilife' ),
			'new_item_name' => __( 'New Program Type Name', 'agrilife' ),
			'menu_name' => __( 'Program Types', 'agrilife' ),
		);

		// Taxonomy arguments
		$args = array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'rewrite' => array( 'slug' ),
		);

		// Register the ProgramType taxonomy
		register_taxonomy( 'program-type', 'location', $args );

	}

}