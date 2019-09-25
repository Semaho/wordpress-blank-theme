<?php

/**
 * Button / Call to Action.
 */
function sc_button( $atts, $content='' )
{
    $a = shortcode_atts([
        'link' => '#'
    ], $atts );

    return '<a class="btn" href="'.$a['link'].'">'.$content.'</a>';
}
add_shortcode( 'button', 'sc_button' );