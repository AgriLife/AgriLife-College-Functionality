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

			}

			public static function get_instance() {

				return self::$instance;

			}

		}