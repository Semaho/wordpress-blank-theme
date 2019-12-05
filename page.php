<?php
get_header(); ?>

<section class="container u-margin-lg-h richtext">

    <?php if ( have_posts() ) : the_post(); ?>

        <h1><?php the_title() ?></h1>
        <?php the_content() ?>

    <?php endif; ?>

</section>

<?php get_footer(); ?>