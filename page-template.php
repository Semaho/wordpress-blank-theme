<?php
/**
 * Template Name: &lt;name&gt;
 * Minimum content. To be customized.
 */

get_header();

if ( have_posts() ) : the_post();

    get_template_part( 'content', 'page' );

endif;

get_footer(); ?>