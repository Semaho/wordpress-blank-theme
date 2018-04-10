<?php
if ( have_rows('layout_engine') ) :

    while ( have_rows('layout_engine') ) : the_row();

        // Will fail silently if template doesn't exist.
        get_template_part('layout-engine/le', get_row_layout());

    endwhile;

else :

    // no layouts found

endif;