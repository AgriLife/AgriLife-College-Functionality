<?php

class AC_Assets {

	public function __construct() {

		global $pagenow;

		if ( ( isset($_GET['post_type']) && $_GET['post_type'] == 'location' && ( 'post.php' === $pagenow || 'post-new.php' === $pagenow ) ) || ( isset($post_type) && $post_type == 'location' ) || ( isset($_GET['post']) && get_post_type($_GET['post']) == 'location' ) ) {
	    add_action('admin_enqueue_scripts', array( $this, 'location_fields_assets') );
		}

	}

	public function location_fields_assets() {

		wp_enqueue_script(
			'location-fields',
			AC_PLUGIN_DIR_URL . '/js/location-fields.js',
			false,
			false,
			true
		);

	}

	public static function enqueue_map_assets() {

		wp_enqueue_script(
			'google-map',
			'https://maps.googleapis.com/maps/api/js?key=AIzaSyAwvTAlWZ9tj8b4-1QWHwFl3ILodM7u0jA&sensor=false',
			false,
			false,
			false
		);

		wp_enqueue_script(
			'google-map-infobox',
			'http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox.js',
			array( 'google-map' ),
			false,
			true
		);

		wp_enqueue_script( 'underscore' );
		wp_enqueue_script( 'backbone' );

		wp_enqueue_script(
			'location-map',
			AC_PLUGIN_DIR_URL . '/js/location-map.js',
			array( 'google-map' ),
			false,
			true
		);	

		wp_enqueue_style(
			'location-map-style',
			AC_PLUGIN_DIR_URL . '/css/location-map.css',
			false,
			false,
			'all'
		);

	}

}