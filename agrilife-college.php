<?php
/**
* Plugin Name: AgriLife College Functionality
* Plugin URI: http://aglifesciences.tamu.edu
* Description: Contains the required functionality for the main college website
* Version: 0.2.1
* Author: J. Aaron Eaton
* Author URI: http://channeleaton.com
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

	}

	public function init() {

		// Load required assets
		$ac_assets = new AC_Assets;

		// Create the Faculty/Alumni Notes Custom Post Type
		$ac_posttype_notes = new AC_PostType_Notes;

		// Create the Locations Custom Post Type
		$ac_posttype_locations = new AC_PostType_Locations;

		// Add the 'major' taxonomy to the staff CPT
		add_filter( 'add_major_taxonomy', array( $this, 'add_major_to_staff' ) );

		// Create all of the custom taxonomies
		$ac_taxonomy_programcategory = new AC_Taxonomy_ProgramCategory;
		$ac_taxonomy_programdepartment = new AC_Taxonomy_ProgramDepartment;
		$ac_taxonomy_programmajor = new AC_Taxonomy_ProgramMajor;
		$ac_taxonomy_programregion = new AC_Taxonomy_ProgramRegion;
		$ac_taxonomy_programtype = new AC_Taxonomy_ProgramType;
		$ac_taxonomy_timeoffered = new AC_Taxonomy_TimeOffered;

		// Create the metaboxes
		$ac_metaboxes = new AC_Metaboxes;

		// Add shortcodes
		$ac_shortcode_collegeadvisors = new AC_Shortcode_CollegeAdvisors;
		$ac_shortcode_studyabroadmap = new AC_Shortcode_StudyAbroadMap;
		$ac_shortcode_grandchallengespeople = new AC_Shortcode_GrandChallengesPeople;

		// Use proper templates
		$ac_template = new AC_Template;

		// AJAX all-the-things
		$ac_ajax = new AC_Ajax;

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