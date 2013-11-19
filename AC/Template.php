<?php

class AC_Template {

	public function __construct() {

		// add_action( 'template_redirect', array( $this, 'location_archive_template' ) );

	}

	public function location_archive_template() {

		global $wp, $post;

		if ( $wp->query_vars['post_type'] == 'location' && is_archive() ) {

			$this->redirect_template( 'location-archive.php' );

		}

	}

	private function redirect_template( $filename ) {

		if ( file_exists( TEMPLATEPATH . '/templates/' . $filename ) ) {
			$template = TEMPLATEPATH . '/templates/' . $filename;
		} else {
			$template = AC_PLUGIN_DIRPATH . '/templates/' . $filename;
		}

		$this->do_theme_redirect( $template );

	}

	private function do_theme_redirect( $template ) {

		global $post, $wp_query;

		if ( have_posts() ) {
			include( $template );
			die();
		} else {
			$wp_query->is_404 = true;
		}

	}

}