<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0">
        <title><?php wp_title('|', true, 'right'); ?></title>
        <?php /* <meta name="theme-color" content="#"> */ ?>

        <script type="text/javascript">var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';</script>
        <?php /* FAVICON        - Use Wordpress icon feature. Appearance > Customize > Site identity */ ?>
        <?php /* SOCIAL SHARING - Use plugin. */ ?>

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>

    <header class="header u-margin-md-h">
        <div class="container">
            <a class="header__home" href="<?php echo site_url() ?>">
                <img class="header__logo" alt="<?php bloginfo('name') ?> logo" src="<?php seb_img('logo.svg'); ?>" />
            </a>
            <div class="header__cross">&times;</div>
            <img class="header__company" src="<?php the_field('company_logo', 'option'); ?>" alt="<?php the_field('company_name', 'option'); ?>">
            <div class="header__spacer"></div>
            <?php /*
            // Main menu.
            $defaults = array(
                'theme_location' => 'pages-menu',
                'container'      => 'nav',
                'menu_class'     => 'header__nav',
                'fallback_cb'    => false
            );
            wp_nav_menu( $defaults );
            */ ?>
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

    <section class="container">