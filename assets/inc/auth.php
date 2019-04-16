<?php

/**
 * Signup.
 */

function auth_signup()
{
    if ( !wp_verify_nonce($_POST['_signup_nonce'], 'signup') )
    {
        wp_die( 'Failed security check' ); 
    }

    $profile   = seb_POST('profile');
    $firstname = seb_POST('firstname');
    $lastname  = seb_POST('lastname');
    $address   = seb_POST('address');
    $zip       = seb_POST('zip');
    $agreement = seb_POST('agreement');
    $password  = $_POST['password'];
    $confirm   = $_POST['pass_conf'];

    if ( !$profile || !$firstname || !$lastname || !$zip || !$agreement )
    {
        return new WP_Error('required_fields', __('Veuillez remplir tous les champs et accepter les conditions d\'utilisation.', 'seb'));
    }
    
    if ( $password !== $confirm )
    {
        return new WP_Error('diff_password', __('Veuillez confirmer le mot de passe.', 'seb'));
    }
    
    if ( strlen($password) < 6 )
    {
        return new WP_Error('short_password', __('Veuillez choisir un mot de passe d\'au moins 6 caractères.', 'seb'));
    }

    $user_id = wp_insert_user([
        'user_pass'  => $_POST['password'],
        'user_login' => seb_POST('email'),
        'user_email' => seb_POST('email'),
        'first_name' => seb_POST('firstname'),
        'last_name'  => seb_POST('lastname')
    ]);

    if ( !is_wp_error($user_id) )
    {
        // Add locataire/bailleur to user meta.
        update_user_meta($user_id, 'user_profile', sanitize_text_field($profile));
        update_user_meta($user_id, 'address', sanitize_text_field($address));
        update_user_meta($user_id, 'zip', sanitize_text_field($zip));
    }

    return $user_id;
}


/**
 * Signin.
 */

function auth_signin()
{
    if ( !wp_verify_nonce($_POST['_signin_nonce'], 'signin') )
    {
        wp_die( 'Failed security check' ); 
    }

    if ( empty($_POST['email']) || empty($_POST['password']) )
    {
        return new WP_Error('short_password', __('Veuillez remplir tous les champs.', 'seb'));
    }

    return wp_signon([
        'user_login'    => $_POST['email'],
        'user_password' => $_POST['password'],
        'remember'      => true
    ]);
}


/**
 * Redirect to signin page if user is not logged in.
 */

function auth_redirect_if_not_logged_in()
{
    if ( !is_user_logged_in() )
    {
        $signin_page = get_field('signin_page', 'option');
        wp_redirect( get_permalink($signin_page) );
        die;
    }
}