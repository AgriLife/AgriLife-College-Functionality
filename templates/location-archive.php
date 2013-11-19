<?php
/**
 * Custom map display for study abroad locations
 */

add_action( 'wp_enqueue_scripts', 'AC_Assets::enqueue_map_assets' );
add_action( 'agriflex_after_loop', 'AC_Ajax::set_ajax_url' );
add_action( 'agriflex_after_loop', 'AC_Ajax::set_locations' );

?>
<?php get_header(); ?>

<div id="wrap">
	<div id="content" role="main">
		<div id="study-abroad-map"></div>
		<?php agriflex_after_loop(); ?>
	</div>
</div>

<?php get_footer(); ?>