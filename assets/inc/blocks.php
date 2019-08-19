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
    // Richtext.
    acf_register_block_type(array(
        'name'              => 'richtext',
        'title'             => __('Richtext', 'seb'),
        'description'       => __('Richtext', 'seb'),
        'render_template'   => 'template-parts/blocks/richtext.php',
        'category'          => 'custom-blocks',
        'icon'              => 'align-left',
        'mode'              => 'edit'
    ));
}


function blocks_enqueue_scripts_for_editor()
{
    wp_enqueue_style( 'theme', get_stylesheet_directory_uri() . '/assets/dist/css/style.min.css', array(), CSS_VERSION, 'all');
}


// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') )
{
    add_action('acf/init', 'register_acf_block_types');
    add_action('enqueue_block_editor_assets', 'blocks_enqueue_scripts_for_editor');
}