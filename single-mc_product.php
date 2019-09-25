<?php get_header() ?>

<?php if ( have_posts() ) : the_post(); ?>

    <section class="flexgrid-2 u-margin-md-h">
        <div>
            <?php if ( have_rows('photos') ) : ?>

                <div class="product__gallery">
            
                <?php while( have_rows('photos') ) : the_row(); ?>
            
                    <?php $p = get_sub_field('photo') ?>

                    <img src="<?= $p['sizes']['medium_large'] ?>" alt="<?= $p['alt'] ?>">
            
                <?php endwhile; ?>

                </div>
            
            <?php endif; ?>
            
        </div>
        <div class="product__info">
            <a href="<?php echo site_url() ?>" class="backlink"><i class="icon-chevron-left"></i> <?php _e('Back', 'seb') ?></a>
            <h1 class="product__info__title"><?php the_title() ?></h1>
            <div class="product__desc richtext">
                <?php the_content() ?>
                <p>
                <?php if ( get_field('origin') ) : ?>
                    <strong><?php _e('Origin', 'seb') ?>:</strong> <?php the_field('origin'); ?><br>
                <?php endif; ?>

                <?php if ( get_field('hs_code') ) : ?>
                    <strong><?php _e('HS Code', 'seb') ?>:</strong> <?php the_field('hs_code'); ?><br>
                <?php endif; ?>

                <?php if ( get_field('weight') ) : ?>
                    <strong><?php _e('Weight', 'seb') ?>:</strong> <?php the_field('weight'); ?><br>
                <?php endif; ?>

                <?php if ( get_field('dimensions') ) : ?>
                    <strong><?php _e('Dimensions', 'seb') ?>:</strong> <?php the_field('dimensions'); ?><br>
                <?php endif; ?>

                <strong><?php _e('In stock', 'seb') ?>:</strong> <?php echo get_field('in_stock') ? __('yes', 'seb') : __('no', 'seb'); ?><br>

                <?php if ( get_field('avg_production_rate') ) : ?>
                    <strong><?php _e('Avg. production rate', 'seb') ?>:</strong> <?php the_field('avg_production_rate'); ?><br>
                <?php endif; ?>

                <?php if ( get_field('material') ) : ?>
                    <strong><?php _e('Material', 'seb') ?>:</strong> <?php the_field('material'); ?><br>
                <?php endif; ?>

                <?php if ( get_field('min_quantity') ) : ?>
                    <strong><?php _e('Min. quantity', 'seb') ?>:</strong> <?php the_field('min_quantity'); ?><br>
                <?php endif; ?>

                <?php if ( have_rows('batch_price') ) : ?>
                    <strong><?php _e('Batch price', 'seb') ?>:</strong><br>
                    <?php while( have_rows('batch_price') ) : the_row(); ?>
                
                        <?php the_sub_field('batch_min_quantity'); ?> — <?php the_sub_field('batch_price_per_item'); ?><br>
                
                    <?php endwhile; ?>
                
                <?php endif; ?>
                
                </p>
                
            </div>
            <div class="u-margin-sm-top">
                <button class="btn" data-open="requestpane"><?php _e('Quotation request', 'seb') ?></button>
            </div>
        </div>
    </section>

<?php endif ?>

<?php get_template_part('request') ?>

<?php get_footer() ?>