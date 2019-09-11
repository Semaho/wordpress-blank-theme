<?php
/**
 * Template Name: &lt;name&gt;
 */

get_header(); ?>

		<?php
		if ( have_posts() ) : the_post();

			get_template_part( 'content', 'page' );

		endif;
		?>

<?php get_footer(); ?>
