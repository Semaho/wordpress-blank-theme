<?php
get_header();

if ( have_posts() )
{
    the_post();
    the_content(); 
}

// If using ACF Layout Engine.
// get_template_part( 'layout-engine/layout', 'engine' );

get_footer();