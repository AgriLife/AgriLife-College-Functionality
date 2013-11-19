<?php
/**
 * Custom map display for study abroad locations
 */

add_action( 'wp_enqueue_scripts', 'AC_Assets::enqueue_map_assets' );
add_action( 'agriflex_after_loop', 'AC_Ajax::set_ajax_url' );
add_action( 'agriflex_after_loop', 'AC_Ajax::get_locations' );

$times_offered = get_terms( 'time-offered', array( 'orderby' => 'count', 'order' => 'DESC', ) );
$program_types = get_terms( 'program-type', array( 'orderby' => 'count', 'order' => 'DESC', ) );
$program_major = get_terms( 'program-major', array( 'orderby' => 'count', 'order' => 'DESC', ) );

?>
<?php get_header(); ?>

<div id="wrap">
	<div id="content" role="main">
		<div id="map-filters">
			<p>
				Time offered: 
				<select name="time-offered" id="time-offered">
					<option value="">All</option>
					<?php foreach ( $times_offered as $time ) : ?>
						<option value="<?php echo $time->name; ?>"><?php echo $time->name; ?></option>
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				Program Type: 
				<select name="program-type" id="program-type">
					<option value="">All</option>
					<?php foreach ( $program_types as $type ) : ?>
						<option value="<?php echo $type->name; ?>"><?php echo $type->name; ?></option>
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				Program Major: 
				<select name="program-major" id="program-major">
					<option value="">All</option>
					<?php foreach ( $program_major as $major ) : ?>
						<option value="<?php echo $major->name; ?>"><?php echo $major->name; ?></option>
					<?php endforeach; ?>
				</select>
			</p>
		</div>
		<div id="study-abroad-map"></div>
		<?php agriflex_after_loop(); ?>
	</div>
</div>

<?php get_footer(); ?>