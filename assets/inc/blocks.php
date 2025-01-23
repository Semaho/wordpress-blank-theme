<?php

/**
 * Register custom Gutenberg block category.
 */

function seb_block_categories( $categories, $post )
{
    if ( $post->post_type !== 'page' ) {
        return $categories;
    }
    return array_merge(
        $categories,
        array(
            array(
                'slug' => 'custom-blocks',
                'title' => get_bloginfo('name'),
                'icon'  => 'wordpress'
            ),
        )
    );
}
add_filter( 'block_categories', 'seb_block_categories', 10, 2 );


/**
 * Register custom blocks.
 */

function register_acf_block_types()
{
    register_block_type( __DIR__ . '/../../blocks/office' );
}
add_action('init', 'register_acf_block_types');


/**
 * Enqueue style for preview.
 */

function blocks_enqueue_scripts_for_editor()
{
    wp_enqueue_style( 'theme', get_stylesheet_directory_uri() . '/assets/dist/scss/style.css', array(), CSS_VERSION, 'all');
}
add_action('enqueue_block_editor_assets', 'blocks_enqueue_scripts_for_editor');
