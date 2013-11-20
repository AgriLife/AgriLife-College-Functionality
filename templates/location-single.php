<?php
/**
 * Custom single template for locations cpt
 */
?>

<?php get_header(); ?>

<div id="wrap">
	<div id="content" role="main">
    <?php if ( function_exists('yoast_breadcrumb') ) {
      yoast_breadcrumb('<div id="breadcrumbs">','</div>');
    } ?>

    <!-- Action hook to insert content before the loop starts -->
    <?php agriflex_before_loop(); ?>

    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    	<?php $prefix = AC_META_PREFIX; ?>
      <h1 class="entry-title"><?php echo rwmb_meta( $prefix . 'program-title' ); ?></h1>

      <div class="entry-content">


        <?php agriflex_edit_link(); ?>
      </div><!-- .entry-content -->

    </div><!-- #post-<?php the_ID(); ?> -->

    <!-- Action hook to insert content after the loop ends -->
    <?php agriflex_after_loop(); ?>

    <?php comments_template( '', true ); ?>

    <?php endwhile; ?>

	</div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>