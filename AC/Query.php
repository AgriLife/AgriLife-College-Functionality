<?php

class AC_Query {

	public static function get_locations( $meta_only = false, $type = false ) {

		$args = array(
			'post_type' => 'location',
			'post_status' => 'publish',
			'nopaging' => true,
		);

		$locations = new WP_Query( $args );

		wp_reset_query();

		if ( ! $meta_only )
			return $locations;

		$locations_meta = array();

		while ( $locations->have_posts() ) : $locations->the_post();

			global $post;

			$title = rwmb_meta( AC_META_PREFIX . 'program-title' );

			$types = array();
			$program_cateogries = get_the_terms( $post->ID, 'program-category' );
			foreach( $program_cateogries as $cat ) {
				array_push( $types, $cat->name );
			}

			$departments = array();
			$program_departments = get_the_terms( $post->ID, 'program-department' );
			foreach( $program_departments as $dep ) {
				array_push( $departments, $dep->name );
			}

			$regions = array();
			$program_regions = get_the_terms( $post->ID, 'program-region' );
			foreach ( $program_regions as $reg ) {
				array_push( $regions, $reg->name );
			}

			$city = rwmb_meta( AC_META_PREFIX . 'program-city' );
			$country = rwmb_meta( AC_META_PREFIX . 'program-country' );
			$address = "$city, $country";

			$formatted_address = rwmb_meta( AC_META_PREFIX . 'program-formatted-address' );

			$coordinates = rwmb_meta( AC_META_PREFIX . 'program-coordinates' );

			$image_id = get_post_thumbnail_id();
			$image_url = wp_get_attachment_image_src( $image_id, 'thumbnail', false );

			$permalink = get_permalink( $post->ID );

			$location = array(
				'title'            => $title,
				'type'             => $types[0],
				'department'       => $departments[0],
				'address'          => $address,
				'formattedAddress' => $formatted_address,
				'coordinates'      => $coordinates,
				'region'           => $regions[0],
				'image_url'        => $image_url[0],
				'permalink'        => $permalink,
			);

			array_push( $locations_meta, $location );

		endwhile;

		return $locations_meta;

	}

}