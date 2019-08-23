<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php body_class(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0">
        <meta name="theme-color" content="#">

        <title><?php wp_title('|', true, 'right'); ?></title>

        <!-- TYPEKIT CACHING : <script src="<?php bloginfo('template_url'); ?>/assets/js/typekit-cache.min.js"></script>-->
        <!--<script type="text/javascript">var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';</script>-->

        <!-- ICONS - Use Wordpress icon feature. -->

        <!-- SOCIAL SHARING - Use plugin. -->

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>

    <header class="header">
        <div class="container">
            <a class="header__home" href="<?php echo site_url() ?>">
                <img class="header__logo" alt="<?php bloginfo('name') ?> logo" src="<?php seb_img('logo.svg'); ?>" />
            </a>
            <div class="header__spacer"></div>
            <?php
            /*
            $defaults = array(
                'theme_location' => 'pages-menu',
                'container'      => 'nav',
                'menu_class'     => 'header__nav',
                'fallback_cb'    => false
            );
            wp_nav_menu( $defaults );
            */
            ?>
            <?php /* ?>
            <div class="langbar"><?php seb_the_languages(); ?></div>
            <?php */ ?>
        </div>
    </header>