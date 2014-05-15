<?php

class AC_Shortcode_GrandChallengesPeople {

	public function __construct() {

		add_shortcode( 'grand_challenges_people', array( $this, 'create_shortcode' ) );
		add_shortcode( 'grand_challenges_people_search', array( $this, 'create_search' ) );
		add_action( 'wp_enqueue_scripts', 'AC_Assets::register_people_assets' );

	}

	/**
	 * The shortcode logic
	 */
	public function create_shortcode() {

		AC_Ajax::set_ajax_url('people');
		wp_enqueue_script( 'people' );
		wp_enqueue_style( 'people-style' );

		ob_start(); ?>
		<div class="gc-list">
			<div class="people-search-form">
				<label>
					<h4>Search faculty by specialty</h4>
				</label>
				<ul class="button-group radius">
					<li class="challenge" data-challenge="Food"><a href="#Food" class="button secondary">Feeding Our World</a></li>
					<li class="challenge" data-challenge="Environment"><a href="#Environment" class="button secondary">Protecting Our Environment</a></li>
					<li class="challenge" data-challenge="Health"><a href="#Health" class="button secondary">Improving Our Health</a></li>
					<li class="challenge" data-challenge="Youth"><a href="#Youth" class="button secondary">Enriching Our Youth</a></li>
					<li class="challenge" data-challenge="Economy"><a href="#Economy" class="button secondary">Growing Our Economy</a></li>
				</ul>
				<?php global $post; echo $this->create_search(array('page'=>$post->post_name)); ?>
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

	public function create_search( $atts ) {

		$a = shortcode_atts( array(
			'page' => '',
			),
			$atts
		);
		wp_enqueue_script( 'people' );
		wp_enqueue_style( 'people-style' );
		ob_start(); ?>
			<label>
				<h4>Enter a Grand Challenge keyword to locate associated faculty</h4>
			</label>
			<form role="search" class="people-searchform" method="get" id="searchform" action="<?php echo home_url(); ?>/<?php echo $a['page']; ?>">
				<input type="text" class="s" name="p" id="s" placeholder="Ecosystem" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"/><br />
			</form>
		<?php
		$return = ob_get_clean();

		return $return;
	}

}