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


/**
 * User's firstname.
 */

function sc_user_firstname()
{
    $user = wp_get_current_user();

    return is_a($user, 'WP_User') ? get_user_meta($user->ID, 'first_name', true) : '';
}
add_shortcode( 'user_firstname', 'sc_user_firstname' );