            <footer id="colophon" class="site-footer" role="contentinfo">
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

        </div> <!-- .site-content -->

    <?php wp_footer(); ?>

    <!-- JS -->
    <script defer src="<?php bloginfo('template_url'); ?>/assets/dist/js/scripts.min.js"></script>

    <script type="text/javascript">
        console.log(
            '            ████ ████ ███ \n'+
            '            █    █    █  █\n'+
            '            ████ ███  ███ \n'+
            '               █ █    █  █\n'+  
            '            ████ ████ ███ \n'+
            'http://sebastien.vignol.be'
        );
    </script>

    </body>

</html>
