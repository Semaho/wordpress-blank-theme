<?php
/**
 * Template Name: &lt;name&gt;
 *
 * @package Paf!
 * @subpackage Paf!_2015
 */

get_header(); ?>

		<?php
		if ( have_posts() ) : the_post();

			get_template_part( 'content', 'page' );

		endif;
		?>

<?php get_footer(); ?>
