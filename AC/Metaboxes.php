<?php

class AC_Metaboxes {

	public function __construct() {

		add_action( 'admin_init', array( $this, 'register_metabox' ) );

	}

	/**
	 * Registers the metaboxes
	 */
	public function register_metabox() {

		$meta_boxes = $this->make_metaboxes();

		foreach ( $meta_boxes as $meta_box ) {
			new RW_Meta_Box( $meta_box );
		}

	}

	/**
	 * Builds the metabox array
	 * @return array The metaboxes
	 */
	private function make_metaboxes() {

		$prefix = AC_META_PREFIX;
		$meta_boxes = array();

		$meta_boxes[] = array(
			'id' => 'employee_details',
			'title' => 'Employee Information',
			'pages' => array( 'staff'),
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'name' => 'First Name',
					'id' => $prefix . 'first-name',
					'type' => 'text',
				),
			),
		);

		return $meta_boxes;

	}

}