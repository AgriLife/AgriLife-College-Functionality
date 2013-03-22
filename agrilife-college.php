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

	}

	public function init() {

		// Create the Faculty/Alumni Notes Custom Post Type
		$ac_posttype_notes = new AC_PostType_Notes;

		// Create the Locations Custom Post Type
		$ac_posttype_locations = new AC_PostType_Locations;

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