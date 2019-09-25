<?php
get_header();

if ( have_posts() )
{
    the_post(); ?>
    
    <div class="hello richtext u-margin-md-h">
        <?php the_content() ?>
    </div>

    <?php get_template_part('shop') ?>
<?php
}

get_footer();