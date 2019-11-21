<?php
// Redirect all 404 to the home page.
// header("HTTP/1.1 301 Moved Permanently");
// header("Location: ".get_bloginfo('url'));
// exit();
?>
<?php get_header(); ?>

<div class="container">

    <section class="error-404 not-found">
        <header class="page-header">
            <h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'seb' ); ?></h1>
        </header>

        <div class="page-content form">
            <p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'seb' ); ?></p>

            <?php get_search_form(); ?>
        </div>
    </section>

</div>

<?php get_footer(); ?>