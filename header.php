<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php body_class(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="theme-color" content="#">

        <title><?php wp_title('|', true, 'right'); ?></title>

        <!-- TYPEKIT CACHING : <script src="<?php bloginfo('template_url'); ?>/assets/js/typekit-cache.min.js"></script>-->
        <!--<script type="text/javascript">var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';</script>-->

        <!-- ICONS - Use Wordpress icon feature. -->

        <!-- SOCIAL SHARING - Use plugin. -->

        <?php wp_head(); ?>
    </head>

    <body>

        <header class="site-header">

            <?php // Chose <table> as flexboxes have retrocompatibilty issues. ?>
            <table>
                <tbody>
                    <tr>
                        <td>
                            <a class="homelink" href="<?php echo site_url() ?>">
                                <img class="logo" alt="Logo" src="<?php seb_img('logo.png'); ?>" />
                            </a>
                        </td>
                        <td>
                            <?php
                            /*
                            $defaults = array(
                                'theme_location'  => 'pages-menu',
                                'container'       => 'nav',
                                'menu_class'      => 'navigation',
                                'fallback_cb'     => false
                            );
                            wp_nav_menu( $defaults );
                            */
                            ?>
                        </td>
                        <td>
                            <?php /* ?>
                           <div class="langbar"><?php seb_the_languages(); ?></div>
                           <?php */ ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </header>