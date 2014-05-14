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
		wp_enqueue_style( 'people-style' );
		AC_Ajax::set_ajax_url();

		ob_start(); ?>
		<div class="gc-list">
			<div class="people-search-form">
				<label>
					<h4>Search faculty by specialty</h4>
				</label>
				<ul class="button-group radius">
					<li data-challenge="Food"><a href="#" class="button secondary">Feeding Our World</a></li>
					<li data-challenge="Environment"><a href="#" class="button secondary">Protecting Our Environment</a></li>
					<li data-challenge="Health"><a href="#" class="button secondary">Improving Our Health</a></li>
					<li data-challenge="Youth"><a href="#" class="button secondary">Enriching Our Youth</a></li>
					<li data-challege="Economy"><a href="#" class="button secondary">Growing Our Economy</a></li>
				</ul>
				<form role="search" class="people-searchform" method="get" id="searchform" action="http://local.wordpress.dev/college/">
					<input type="text" class="s" name="s" id="s" placeholder="biochemistry" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"/><br />
					<input type="hidden" name="post_type" value="people" />
				</form>
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
						<p class="people-specialty"><a href="#">Specializations</a></p>
					</div>
					<% if (specializations != false) { %>
						<div class="people-specialty-list expanded">
							<ul>
								<% _.each(specializations, function(sp) { %>
									<li><%= sp %></li>
								<% }); %>
							</ul>
						</div>
					<% } %>
				</div>
			</li>
		</script>

		<?php
		$return = ob_get_clean();

		return $return;

	}

}