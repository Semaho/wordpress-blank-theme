<?php 
/**
 * To display archive name/title outside the Loop,
 * use post_type_archive_title() 
 */
?>


<?php

get_header(); ?>

    <main id="main" class="site-main" role="main">

    <?php if ( have_posts() ) : ?>

        <?php
        while ( have_posts() ) : the_post();

            get_template_part( 'template-parts/list', get_post_type() );

        endwhile; ?>

        <div class="pagination">
        <?php echo paginate_links(array(
            'prev_text' => '<',
            'next_text' => '>'
        )); ?>
        </div>
        
    <?php
    else :
        get_template_part( 'template-parts/content', 'none' );

    endif;
    ?>

    </main>

<?php get_footer(); ?>
