        <footer class="footer" role="contentinfo">
            <?php if ( has_nav_menu( 'pages-menu' ) ) : ?>
                <nav class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Primary Menu', 'seb' ); ?>">
                    <?php /*
                        wp_nav_menu( array(
                            'theme_location' => 'pages-menu',
                            'menu_class'     => 'primary-menu',
                         ) );
                    */ ?>
                </nav>
            <?php endif; ?>
        </footer>

    <?php wp_footer(); ?>

    </body>

</html>
