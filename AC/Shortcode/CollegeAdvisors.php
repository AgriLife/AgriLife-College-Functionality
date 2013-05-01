<?php

class AC_Shortcode_CollegeAdvisors {

	public function __construct() {

		add_shortcode( 'advisor_listing', array( $this, 'create_shortcode' ) );

	}

	/**
	 * The shortcode logic
	 */
	public function create_shortcode() {

		$majors = $this->get_major_list();

		foreach ($majors as $slug => $name ) {
			$this->create_advisor_list( $slug, $name );
		}

	}

	/**
	 * Retrieves the majors and returns a clean array
	 * @return array Array of majors terms in $slug => $name format
	 */
	private function get_major_list() {

		$majors = get_terms( 'program-major' );

		$terms = array();

		foreach ( $majors as $m ) {
			$terms[$m->slug] = $m->name; 
		}

		return $terms;

	}

	/**
	 * Runs a query for each major
	 * @param  string $slug the term slug
	 * @param  string $name The term name
	 */
	private function create_advisor_list( $slug, $name ) {

			$args = array(
				'post_type' => 'staff',
				'post_status' => 'publish',
				'posts_per_page' => -1,
				'tax_query' => array(
					array(
						'taxonomy' => 'program-major',
						'field' => 'slug',
						'terms' => $slug,
					)
				),
			);

			$advisors = get_posts( $args );

			echo '<h3 class="advisor-heading">' . $name . '</h3>';

			echo '<ul class="staff-listing-ul">';
			foreach ( $advisors as $advisor ) {
				$this->display_advisor( $advisor );
			}
			echo '</ul>';

	}

	/**
	 * Displays the html for each advisor
	 * @param  object $advisor The advisor post object
	 */
	private function display_advisor( $advisor ) { ?>

		<li class="staff-listing-item">
			<div class="role staff-container">
				<div class="staff-image">
					<a href="<?php the_permalink( $advisor->ID ); ?>" rel="bookmark">
					<?php if ( has_post_thumbnail( $advisor->ID ) ) {
						echo get_the_post_thumbnail( $advisor->ID, 'staff_archive' );
					} else  {
						echo '<img src="' . STAFF_PLUGIN_DIR_URL . 'img/agrilife-default-staff-image-single.png" alt="AgriLife Logo" title="AgriLife" width="70" height="70" />';
					}
					?></a>
				</div>
				<div class="staff-head">
					<h2 class="staff-title" title="<?php echo get_the_title( $advisor->ID ); ?>"><a href="<?php echo get_permalink( $advisor->ID ); ?>"><?php echo rwmb_meta( 'als_first-name', '', $advisor->ID ).' '.rwmb_meta( 'als_last-name', '', $advisor->ID ); ?></a></h2>
					<h3 class="staff-position"><?php echo rwmb_meta( 'als_position', '', $advisor->ID ); ?></h3>
				</div>                                  
				<div class="staff-contact-details">
					<p class="staff-phone tel"><?php echo rwmb_meta( 'als_phone', '', $advisor->ID ); ?></p>
					<p class="staff-email email"><a href="mailto:<?php echo rwmb_meta( 'als_email', '', $advisor->ID ); ?>"><?php echo rwmb_meta( 'als_email', '', $advisor->ID ); ?></a></p>
				</div>
			</div>
			</a>
		</li>
		<?php
	}

}