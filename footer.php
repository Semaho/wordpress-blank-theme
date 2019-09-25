    </section>
    <footer class="footer u-padding-sm-h" role="contentinfo">
        <div class="container">
            <p>Hello!</p>
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
        </div>
    </footer>

    <?php wp_footer(); ?>

    </body>

</html>
