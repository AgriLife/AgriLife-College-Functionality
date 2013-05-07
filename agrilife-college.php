<?php
/*
Plugin Name: AgriLife College Functionality
Plugin URI: http://aglifesciences.tamu.edu
Description: Contains the required functionality for the main college website
Version: 1.0
Author: J. Aaron Eaton
Author URI: http://channeleaton.com
*/

define( 'AC_PLUGIN_DIRNAME', 'agrilife-college' );
define( 'AC_PLUGIN_DIRPATH', plugin_dir_path( __FILE__ ) );
define( 'AC_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'AC_META_PREFIX', '_ac_' );

// Autoload all classes
spl_autoload_register( 'AgriLife_College::autoload' );

class AgriLife_College {

	private static $instance;

	public $version = '1.0';

	private static $file = __FILE__;

	public function __construct() {

		self::$instance = $this;

		// Load up the plugin
		add_action( 'init', array( $this, 'init' ) );

		add_action( 'init', array( $this, 'ac_posttype_notes' ) );
		add_action( 'init', array( $this, 'ac_posttype_locations' ) );

		add_filter( 'add_major_taxonomy', array( $this, 'add_major_to_staff' ) );

		add_action( 'init', array( $this, 'ac_taxonomy_programcategory' ) );
		add_action( 'init', array( $this, 'ac_taxonomy_programdepartment' ) );
		add_action( 'init', array( $this, 'ac_taxonomy_programmajor' ) );
		add_action( 'init', array( $this, 'ac_taxonomy_programregion' ) );
		add_action( 'init', array( $this, 'ac_taxonomy_programtype' ) );
		add_action( 'init', array( $this, 'ac_taxonomy_timeoffered' ) );

		add_filter( 'title_save_pre', array( $this, 'save_title' ) );

	}

	public function init() {


		// Create the metaboxes
		$ac_metaboxes = new AC_Metaboxes;

		// Add shortcodes
		$ac_shortcode_collegeadvisors = new AC_Shortcode_CollegeAdvisors;


	}

	public function ac_posttype_notes() {

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

	public function ac_posttype_locations() {

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

	public function ac_taxonomy_programcategory() {

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

	public function ac_taxonomy_programdepartment() {

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

	public function ac_taxonomy_programmajor() {

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

		// Allow other plugins to include this taxonomy in their respective CPTs
		$cpt = array( 'location' );
		$cpt = apply_filters( 'add_major_taxonomy', $cpt );

		// Register the ProgramMajor taxonomy
		register_taxonomy( 'program-major', $cpt, $args );

	}

	public function ac_taxonomy_programregion() {

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

	public function ac_taxonomy_programtype() {

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

	public function ac_taxonomy_timeoffered() {

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

	/**
   * Saves the staff title as lastname, firstname
   * @param  string $staff_title The empty staff title
   * @return string              The correct staff title
   */
  public function save_title( $title ) {

    if ( $_POST['post_type'] == 'location' ){
      $title = $_POST[AC_META_PREFIX . 'program-title'];
    }

    return $title;
    
  }

  /**
   * Adds the 'major' taxonomy to the Staff CPT
   * @param array $cpt The current CPT array
   * @return array $cpt The new CPT array
   */
  public function add_major_to_staff( $cpt ) {

  	$cpt[] = 'staff';
  	return $cpt;

  }

	public static function autoload( $classname ) {

		$filename = dirname( __FILE__ ) .
      DIRECTORY_SEPARATOR .
      str_replace( '_', DIRECTORY_SEPARATOR, $classname ) .
      '.php';
    if ( file_exists( $filename ) )
      require $filename;

	}

	public static function get_instance() {

		return self::$instance;

	}

}

new AgriLife_College;