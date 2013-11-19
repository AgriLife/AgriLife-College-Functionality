<?php

class AC_Shortcode_StudyAbroadMap {

	public function __construct() {

		add_shortcode( 'study_abroad_map', array( $this, 'create_shortcode' ) );

	}

	/**
	 * The shortcode logic
	 */
	public function create_shortcode() {


		return $return;

	}

}