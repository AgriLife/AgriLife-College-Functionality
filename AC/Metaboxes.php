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
			'id' => 'submitter-information',
			'title' => 'Submitter Information',
			'pages' => array( 'location' ),
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'name' => 'Submitter Name',
					'id' => $prefix . 'submitter-name',
					'type' => 'text',
				),
				array(
					'name' => 'Submitter Email',
					'id' => $prefix . 'submitter-email',
					'type' => 'text',
				),
			),
		);

		$meta_boxes[] = array(
			'id'       => 'faculty-information',
			'title'    => 'Faculty Information',
			'pages'    => array( 'location' ),
			'context'  => 'normal',
			'priority' => 'high',
			'fields'   => array(
				array(
					'name' => 'Faculty Name',
					'id'   => $prefix . 'program-faculty-name',
					'type' => 'text',
				),
				array(
					'name'             => 'Faculty Photo',
					'id'               => $prefix . 'program-faculty-photo',
					'type'             => 'image_advanced',
					'max_file_uploads' => 1,
				),
			),
		);

		$meta_boxes[] = array(
			'id' => 'program-information',
			'title' => 'Program Information',
			'pages' => array( 'location' ),
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'name' => 'Program Title',
					'id' => $prefix . 'program-title',
					'type' => 'text',
				),
				array(
					'name' => 'Description',
					'id' => $prefix . 'program-description',
					'type' => 'textarea',
				),
				array(
					'name' => 'Program URL',
					'id' => $prefix . 'program-url',
					'type' => 'url',
				),
				array(
					'name' => 'Department',
					'id' => $prefix . 'program-department',
					'type' => 'taxonomy',
					'options' => array(
						'taxonomy' => 'program-department',
						'type' => 'select-tree',
						'args' => array(),
					),
					'default' => 'Select a department',
				),
				array(
					'name' => 'Street address (optional)',
					'id' => $prefix . 'program-address',
					'type' => 'text',
				),
				array(
					'name' => 'City',
					'id' => $prefix . 'program-city',
					'type' => 'text',
				),
				array(
					'name' => 'State (optional)',
					'id' => $prefix . 'program-state',
					'type' => 'text',
				),
				array(
					'name' => 'Country',
					'id' => $prefix . 'program-country',
					'type' => 'text',
				),
				array(
					'name' => 'Region',
					'id' => $prefix . 'program-region',
					'type' => 'taxonomy',
					'options' => array(
						'taxonomy' => 'program-region',
						'type' => 'select-tree',
						'args' => array(),
					),
					'default' => 'Select a region',
				),
				array(
					'name' => 'Category',
					'id' => $prefix . 'program-category',
					'type' => 'taxonomy',
					'options' => array(
						'taxonomy' => 'program-category',
						'type' => 'select_tree',
						'args' => array(),
					),
					'default' => 'Select a category',
				),
			),
		);

		$meta_boxes[] = array(
			'id' => 'study-abroad',
			'title' => 'For Study Abroad/Student Experience Only',
			'pages' => array( 'location' ),
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'name' => 'Time offered',
					'id' => $prefix . 'program-time',
					'type' => 'taxonomy',
					'options' => array(
						'taxonomy' => 'time-offered',
						'type' => 'select-tree',
						'args' => array(),
					),
					'multiple' => true,
				),
				array(
					'name' => 'Type',
					'id' => $prefix . 'program-type',
					'type' => 'taxonomy',
					'options' => array(
						'taxonomy' => 'program-type',
						'type' => 'select-tree',
						'args' => array(),
					),
					'multiple' => true,
				),
				array(
					'name' => 'Major',
					'id' => $prefix . 'program-major',
					'type' => 'taxonomy',
					'options' => array(
						'taxonomy' => 'program-major',
						'type' => 'select-tree',
						'args' => array(),
					),
					'multiple' => true,
				),
			),
		);

		return $meta_boxes;

	}

}