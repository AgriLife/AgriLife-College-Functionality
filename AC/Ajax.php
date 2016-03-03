<?php

class AC_Ajax {

	private static $ajax_url = ''; 

	public function __construct() {

		self::$ajax_url = admin_url( 'admin-ajax.php' );

		add_action( 'wp_ajax_get_locations', 'AC_Ajax::get_locations' );
		add_action( 'wp_ajax_nopriv_get_locations', 'AC_Ajax::get_locations' );

		add_action( 'wp_ajax_get_people', 'AC_Ajax::get_people' );
		add_action( 'wp_ajax_nopriv_get_people', 'AC_Ajax::get_people' );

	}

	public static function set_ajax_url( $handle = 'location-map' ) {

		$url = array(
			'ajax' => self::$ajax_url,
		);

		wp_localize_script( $handle, 'url', $url );

	}

	public static function get_locations() {

		$locations = json_encode( AC_Query::get_locations( true ) );

		$data = array(
			'locations' => $locations,
		);

		wp_localize_script( 'location-map', 'data', $data );

	}

	public static function get_people() {

    $method = 'people';
    $applicationID = 3;
    $limitedunits = array( 294, 286, 291, 379, 290, 297, 292, 300, 366, 298, 295, 396, 314, 302, 304, 329, 353, 354, 355, 356, 357, 358, 359, 361, 362, 363, 364, 365 );

		$cached = true;
    
		$agrilife_people = get_transient( 'agrilife_people_list' );

		if ( false === $agrilife_people ) {
			// Get from PeopleAPI
			include plugin_dir_path( dirname( dirname(__FILE__) ) ) . '/agrilife-core/src/PeopleAPI.php';
      $api = new \AgriLife\Core\PeopleAPI();
			$cached = false;
      $agrilife_people = $api->get_people( base64_encode( md5( $applicationID . AGRILIFE_GET_PERSONNEL_HASH, true ) ), $limitedunits );
      
      set_transient( 'agrilife_people_list', $agrilife_people, WEEK_IN_SECONDS );
		}

		$return = array(
			'cached' => $cached,
			'people' => $agrilife_people,
		);

		die( json_encode( $return ) );

	}

}