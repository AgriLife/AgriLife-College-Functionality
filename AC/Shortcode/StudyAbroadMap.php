<?php

class AC_Shortcode_StudyAbroadMap {

	public function __construct() {

		add_shortcode( 'study_abroad_map', array( $this, 'create_shortcode' ) );

	}

	/**
	 * The shortcode logic
	 */
	public function create_shortcode() {

		AC_Assets::enqueue_map_assets();
		AC_Ajax::set_ajax_url();
		AC_Ajax::get_locations();

		$return = '<div id="study-abroad-map"></div>';

		return $return;

	}

}