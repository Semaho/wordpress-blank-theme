<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0">
        <title><?php wp_title('|', true, 'right'); ?></title>
        <?php /* <meta name="theme-color" content="#"> */ ?>

        <?php /* <script type="text/javascript">var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';</script>*/ ?>
        <?php /* FAVICON        - Use Wordpress icon feature. Appearance > Customize > Site identity */ ?>
        <?php /* SOCIAL SHARING - Use plugin. */ ?>

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>

    <header class="header">
        <div class="container">
            <?php the_custom_logo() ?>
            <div class="header__spacer"></div>
            <!-- <nav itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement" role="navigation"> -->
                <?php /*
                // Main menu.
                $defaults = array(
                    'theme_location' => 'pages-menu',
                    'container'      => 'div',
                    'menu_class'     => 'header__nav',
                    'fallback_cb'    => false
                );
                wp_nav_menu( $defaults );
                */ ?>
            <!-- </nav> -->
            <?php /*
            // Display WPML languages.
            <div class="langbar"><?php seb_the_languages(); ?></div>
            */ ?>
            <?php /*
            // Burger menu.
            <button class="burger burger--squeeze" data-component="burger"><b></b><b></b><b></b></button>
            */ ?>
        </div>
    </header>