<?php
/**
 * Custom single template for locations cpt
 */
add_action( 'wp_enqueue_scripts', 'AC_Assets::enqueue_location_single_assets' );
?>

<?php get_header(); ?>

<div id="wrap">
	<div id="content" role="main">
    <?php if ( function_exists('yoast_breadcrumb') ) {
      yoast_breadcrumb('<div id="breadcrumbs">','</div>');
    } ?>

    <!-- Action hook to insert content before the loop starts -->
    <?php agriflex_before_loop(); ?>

    <?php if ( have_posts() ) while ( have_posts() ) : the_post();

    $classes = implode( ' ', get_post_class() );
    printf( '<div id="post-%s" class="%s">',
    	get_the_id(),
    	$classes
    );

    	$prefix = AC_META_PREFIX;

			$image_id = get_post_thumbnail_id();
			$image_url = wp_get_attachment_image_src( $image_id, 'full', false );

      printf( '<div class="location-header" style="background: url(%s) no-repeat"><h1 class="entry-title">%s</h1></div>',
      	$image_url[0],
      	rwmb_meta( $prefix . 'program-title' )
      );

      echo '<div class="entry-content">';

      printf( '<h4 class="location-description">%s</h4>',
      	rwmb_meta( $prefix . 'program-description' )
      );


      printf( '<p class="location-name"><strong>Location: </strong>%s, %s</p>',
      	rwmb_meta( $prefix . 'program-city' ),
      	rwmb_meta( $prefix . 'program-country' )
      );

			$types = array();
			$program_cateogries = get_the_terms( $post->ID, 'program-category' );
			foreach( $program_cateogries as $cat ) {
				array_push( $types, $cat->slug );
			}

			if ( 'study-abroadstudent-experience' == $types[0] ) {

				printf( '<p class="program-times"><strong>Times offered: </strong>%s</p>',
	      	strip_tags( get_the_term_list( $post->ID, 'time-offered', false, ', ' ) )
				);

				printf( '<p class="program-type"><strong>Program type: </strong>%s</p>',
	      	strip_tags( get_the_term_list( $post->ID, 'program-type', false, ', ' ) )
				);

				printf( '<p class="program-majors"><strong>Related majors: </strong>%s</p>',
	      	strip_tags( get_the_term_list( $post->ID, 'program-major', false, ', ' ) )
				);

			}

			$url = rwmb_meta( $prefix . 'program-url' );
			if ( ! empty( $url ) )
				printf( '<p class="location-learn-more"><a href="%s" target="_blank">Learn more about this program</a></p>',
					$url
				);

      echo '<div class="organizer"><p><strong>Organized by: </strong></p>';
      $args = array(
      	'type' => 'image_advanced',
      	'size' => 'thumbnail',
      );
      $faculty_photo = reset(rwmb_meta( $prefix . 'program-faculty-photo', $args ) );

      if ( ! empty( $faculty_photo ) )
	      printf( '<img class="faculty-image" src="%s" alt="%s" /><br />',
	      	$faculty_photo['url'],
	      	$faculty_photo['alt']
		    );

	    echo '<div class="org-right">';
	    printf( '<p class="faculty-name">%s</p>',
	    	rwmb_meta( $prefix . 'program-faculty-name' ) . '<br />'
	    );

      printf( '<p class="department-name">%s</p>',
      	strip_tags( get_the_term_list( $post->ID, 'program-department' ) )
      );
      echo '</div>';

      echo '</div>';
      agriflex_edit_link();
      echo '</div><!-- .entry-content -->';

    printf( '</div><!-- #post-%s ?> -->',
    	get_the_ID()
  	);

    agriflex_after_loop();


    endwhile;
    ?>

	</div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>