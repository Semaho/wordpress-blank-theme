<?php
/**
 * Sebastien Vignol
 * 2016
 */


/**************************************
 * INCLUSIONS
 **************************************/

// Reminder : when file not found, 'include' throws a warning where 'require' throws a fatal error.
include get_stylesheet_directory() . '/assets/inc/disable_emoji.php';
include get_stylesheet_directory() . '/assets/inc/shortcodes.php';



/**************************************
 * CONSTANTS
 **************************************/

define('CSS_VERSION', wp_get_theme()->get('Version'));
define('IMG', get_stylesheet_directory_uri().'/assets/img/'); // Template image folder.
define('JS' , get_stylesheet_directory_uri().'/assets/js/');  // Template js folder.
define('CSS', get_stylesheet_directory_uri().'/assets/css/'); // Template css folder.



/**************************************
 * THEME SETUP
 **************************************/

/**
 * Enqueue scrip
 * ts.
 */
function seb_add_theme_scripts()
{
    wp_enqueue_style( 'theme', get_stylesheet_directory_uri() . '/assets/dist/css/style.min.css', array(), CSS_VERSION, 'all');

    wp_enqueue_script( 'scripts', get_stylesheet_directory_uri() . '/assets/dist/js/scripts.min.js', array ( 'jquery' ), CSS_VERSION, true);
}
add_action( 'wp_enqueue_scripts', 'seb_add_theme_scripts' );

/**
 * Theme Support.
 */

add_theme_support('post-thumbnails');
add_theme_support( 'html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
) );


/**
 * Add admin CSS (accent color on blocks title).
 */

function my_custom_css()
{
    echo '<style>
        .hndle.ui-sortable-handle, .acf-fc-layout-handle {background-color: #23282d !important;}
        .hndle.ui-sortable-handle span, .acf-fc-layout-handle {color: #fff !important;}
        .dashicons-location::before, .dashicons-tickets-alt::before, .dashicons-lightbulb::before {color: #00b9eb !important;}
    </style>';
}
add_action('admin_head', 'my_custom_css');


/**
 * Register menus.
 */

function seb_theme_setup()
{
    register_nav_menu( 'pages-menu', __( 'Main menu', 'seb' ) );
    
    //load_theme_textdomain('seb');   // 1st arg = used domain name in gettext functions. Put fr_FR.po/fr_FR.mo in theme directory.
}
add_action( 'after_setup_theme', 'seb_theme_setup' );


/**
 * JavaScript detection.
 */

function seb_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
//add_action( 'wp_head', 'seb_javascript_detection', 0 );


/**
 * ACF Option page.
 * 
 * Use : the_field('field_name', 'option');
 */

// if( function_exists('acf_add_options_page') )
// {	
// 	acf_add_options_page();	
// }



/**************************************
 * POST TYPE
 **************************************/

/*
function seb_posttypes()
{
	register_post_type( 'post_type',
		array(
			'labels' => array(
				'name' => __( '', 'seb' ),
				'singular_name' => __( '', 'seb' )
			),
			'public' => true,
			'has_archive' => true,
            'menu_icon' => '',
            'supports' => array('title', 'editor', 'thumbnail', 'revisions')
		)
	);
}
add_action( 'init', 'seb_posttypes' );
*/



/**************************************
 * FUNCTIONS
 **************************************/

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */

function theme_name_wp_title( $title, $sep )
{
	if ( is_feed() ) {
		return $title;
	}
	
	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', '_s' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'theme_name_wp_title', 10, 2 );


/**
 * Get posts by Post Type.
 * Use wp_reset_postdata() after.
 */

function seb_get_posts_by_posttype($posttype, $limit=-1)
{
    $args = array(
        'post_type' => $posttype,
        'orderby' => 'date',
        'order' => 'DESC',
        'paged' => true,
        'posts_per_page' => $limit);
    
    $posts = new WP_Query($args);
    
    return $posts;
}


/**
 * Echoes the thumbnail URL of the current post.
 */

function seb_the_thumbnail($id=0)
{
    if (!$id) { $id = get_the_ID(); }
    echo wp_get_attachment_url(get_post_thumbnail_id($id));
}


/**
 * Echoes the thumbnail URL of the current post.
 */

function seb_the_dyn_cov($url='')
{
    if ( !$url ) { echo 'style="background-image:url(\'';seb_the_thumbnail();echo '\');"'; }
    else { echo 'style="background-image:url(\''.$url.'\');"'; }
}


/**
 * Custom languages list.
 */

function seb_the_languages()
{
    if ( function_exists('icl_get_languages') )
    {
        $languages = icl_get_languages('skip_missing=1');
        if(!empty($languages))
        {
            echo '<div class="lang-switch">';
            foreach($languages as $l)
            {
                echo '<a href="'.$l['url'].'"'.(!$l['active'] ? '' : ' class="active"').'>';
                echo icl_disp_language($l['language_code']);
                echo '</a>';
            }
            echo '</div>';
        }
    }
}


/**
 * Echoes the translated permalink.
 * Must be used within the Loop.
 */

function seb_the_translated_permalink($id, $post_type='page')
{
    if(function_exists('icl_object_id')) {
        $id = icl_object_id($id, $post_type, true);
    }
    echo get_permalink($id);
}


/**
 * Echoes the excerpt of a post, and cuts the end if too long.
 * If cut, $end is appended to the excerpt.
 * Must be used within the Loop.
 */

function seb_the_excerpt($size = 150, $end = '...')
{
    $ex = get_the_excerpt();
    $ex = substr($ex, 0, $size);
    if( strlen($ex) >= $size )
        $ex = $ex . $end;
    echo $ex;
}


/**
 * Echoes URL param with defined CSS version.
 */

function css_version($echo=TRUE)
{
    if ( $echo ) {
        echo '?v='.CSS_VERSION;
    }
    else {
        return '?v='.CSS_VERSION;
    }
}


/**
 * Display icons with URL sharing. Use this within the Loop.
 */

function seb_sharing()
{
    ?>
    <div class="socials">
        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_the_permalink()); ?>">
            <img alt="Facebook" src="<?php bloginfo('template_url') ?>/assets/img/ssba_facebook.png">
        </a>
        <a target="_blank" href="https://twitter.com/share?url=<?php echo urlencode(get_the_permalink()) ?>&hashtags=Brasserie,Silly&text=<?php echo urlencode(get_the_title()) ?>">
            <img alt="Twitter" src="<?php bloginfo('template_url') ?>/assets/img/ssba_twitter.png">
        </a>
        <a target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_the_permalink()) ?>&media=<?php echo urlencode(seb_get_the_thumbnail()) ?>&description=<?php echo urlencode(get_the_title()) ?>">
            <img alt="Pinterest" src="<?php bloginfo('template_url') ?>/assets/img/ssba_pinterest.png">
        </a>
        <a href="mailto:?&subject=<?php bloginfo('name'); echo ' : '; the_title() ?>&body=<?php echo urlencode(get_the_permalink()) ?>">
            <img alt="Email" src="<?php bloginfo('template_url') ?>/assets/img/ssba_email.png">
        </a>
    </div>
    <?php
}


/**
 * Uses the post category to get related posts.
 */

function seb_related_posts($nb=4)
{
    global $post;
    
    $cats = array();
    $categories = get_the_category(); // Get all categories for this post.

    foreach($categories as $category) {
        array_push($cats, $category->cat_ID);
    }
    
    $args = array(
        'orderby' => 'date',
        'order' => 'DESC',
        'post_type' => 'post',
        'numberposts' => $nb,
        'post__not_in' => array($post->ID),
        'category__in' => $cats
    );

    return get_posts($args);
}


/**
 * Echoes the full path for an image.
 */

function seb_img($filename)
{
    echo IMG.$filename;
}


/**
 * Echoes a <select> tag with options.
 * @var $options  Array  of arrays with 'key' and 'value' keys.
 * @var $default  Array  Default key and value.
 * @var $selected String Selected key.
 * @var $name     String Name attribute.
 * @var $id       String Id attribute.
 * @var $class    String Class attribute.
 */

function seb_build_select_tag($options, $default, $selected=null, $name=null, $id=null, $class=null)
{
    echo '<select'.($id?' id="'.$id.'"':'').($name?' name="'.$name.'"':'').($class?' class="'.$class.'"':'').'>';
    echo '<option value="'.$default['key'].'"'.(empty($selected)?' selected':'').'>'.$default['value'].'</option>';
    foreach ( $options as $option )
    {
        echo '<option value="'.$option['key'].'"'.($selected==$option['key']?' selected':'').'>'.$option['value'].'</option>';
    }
    echo '</select>';
}

/**
 * Display in normal size a x2 image.
 */

function seb_image_2x($img_array, $class="")
{
    seb_image_xx(2, $img_array, $class);
}


/**
 * Display in normal size a x3 image.
 */

function seb_image_3x($img_array, $class="")
{
    seb_image_xx(3, $img_array, $class);
}


/**
 * Display in normal size a x$multiplier image.
 */

function seb_image_xx($multiplier, $img_array, $class="")
{
    $ext = strtolower(pathinfo($img_array['url'], PATHINFO_EXTENSION));
    $style = $ext === "svg" ? '' : 'style="width:'.($img_array['width']/$multiplier).'px;height:'.($img_array['height']/$multiplier).'px"';
    echo '<img class="'.$class.'" src="'.$img_array['url'].'" '.$style.'>';
}


/**
 * Return a sanitized value from $_GET, if any.
 */

function seb_GET($index)
{
    return (isset($_GET) && isset($_GET[$index])) ? 
        sanitize_text_field($_GET[$index]) : 
        null;
}


/**
 * Return a sanitized value from $_POST, if any.
 */

function seb_POST($index)
{
    return (isset($_POST) && isset($_POST[$index])) ? 
        sanitize_text_field($_POST[$index]) : 
        null;
}


/**
 * Get current URL.
 * Note: don't use this where security is a concern, $_SERVER can be modified by client.
 */

function seb_get_current_url()
{
    return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
}


/**
 * Add or replace query string parameters while preserving the others.
 */

function seb_add_query_string_param($url, $key, $value)
{
    $url = preg_replace('/\?.*/', '', $url);
    $query = $_GET;
    $query[$key] = $value;

    return $url.'?'.http_build_query($query);
}


/**
 * Check email validity.
 * @return   bool   Whether email is valid or not.
 */

function seb_is_email($maybemail)
{
    return filter_var($maybemail, FILTER_VALIDATE_EMAIL);
}


/**
 * Help me mofocker.
 */
function vd($var, $label='')
{
    echo '<pre>'.$label;
    var_dump($var);
    echo '</pre>';
}