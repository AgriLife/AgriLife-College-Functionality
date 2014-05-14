<?php

class AC_Shortcode_GrandChallengesPeople {

	public function __construct() {

		add_shortcode( 'grand_challenges_people', array( $this, 'create_shortcode' ) );
		add_action( 'wp_enqueue_scripts', 'AC_Assets::register_people_assets' );

	}

	/**
	 * The shortcode logic
	 */
	public function create_shortcode() {

		wp_enqueue_script( 'people' );
		AC_Ajax::set_ajax_url();

		ob_start(); ?>
		<div id="gc-list">
			<div class="gc-selection">
				<ul>
					<li data-challenge="Food">Feeding Our World</li>
					<li data-challenge="Environment">Protecting Our Environment</li>
					<li data-challenge="Health">Improving Our Health</li>
					<li data-challenge="Youth">Enriching Our Youth</li>
					<li data-challenge="Economy">Growing Our Economy</li>
				</ul>
			</div>
			<ul id="people-listing-ul"></ul>
		</div>
		<script type="text/template" id="people-template">
			<li class="people-listing-item">
				<div class="role people-container">
					<% if ( ! _.isEmpty(picture)) { %>
					<div class="people-image">
						<a href="<%= profile %>"><img src="<%= picture %>" alt="<%= firstname %> <%= lastname %>" /></a>
					</div>
					<% } %>
					<div class="people-head">
						<h2 class="people-name"><a href="<%= profile %>"><%= firstname %> <%= lastname %></a></h2>
						<h3 class="people-dept"><%= department %></h3>
					</div>
					<div class="people-contact-details">
						<p class="people-email email"><a href="mailto:<%= emailaddress %>"><%= _.escape(emailaddress) %></a></p>
						<% if (specializations != false) { %>
							<h4>Specialties</h4>
							<div class="people-specialty-list expanded">
								<ul>
									<% _.each(specializations, function(sp) { %>
										<li><%= sp %></li>
									<% }); %>
								</ul>
							</div>
						<% } %>
					</div>
				</div>
			</li>
		</script>

		<?php
		$return = ob_get_clean();

		return $return;

	}

}