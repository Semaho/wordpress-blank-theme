<?php 
$brands = seb_get_posts_by_posttype('mc_brand');
?>
<section class="request" data-component="requestpane">
    <div class="request__fader"></div>
    <div class="request__pane">
        <form class="form" id="request-form">
            <div class="form__group">
                <label class="form__label"><?php _e('Product', 'seb') ?></label>
                <p><?php the_title() ?></p>
            </div>
            <div class="form__group">
                <label class="form__label" for="brand"><?php _e('Brand', 'seb') ?></label>

                <?php if ( $brands->have_posts() ) : ?>
                    <select name="brand" id="brand">
                
                    <?php while( $brands->have_posts() ) : $brands->the_post(); ?>
                        <option value="<?php the_ID() ?>"><?php the_title(); ?></option>
                    <?php endwhile; ?>
                
                    </select>
                    <?php wp_reset_postdata() ?>
                <?php endif; ?>
            </div>
            <div class="form__group">
                <label class="form__label" for="quantity"><?php _e('Quantity', 'seb') ?></label>
                <input type="number" min="1" name="quantity" id="quantity">
            </div>
            <div class="form__group">
                <label class="form__label" for="date"><?php _e('Expected delivery date', 'seb') ?></label>
                <input type="date" id="date" name="date" min="<?= date('Y-m-d') ?>">
            </div>
            <div class="form__group">
                <label class="form__label" for="message"><?php _e('Message', 'seb') ?></label>
                <textarea name="message" id="message" rows="4"></textarea>
            </div>
            <div class="form__group">
                <input type="hidden" name="action" value="create_quotation_request">
                <input type="hidden" name="product" value="<?php the_ID() ?>">
                <?php wp_nonce_field('new_quotation_request') ?>
                <button class="btn btn--fluid" type="submit"><?php _e('Send request', 'seb') ?></button>
            </div>
        </form>
    </div>
</section>