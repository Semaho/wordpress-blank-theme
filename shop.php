<?php 
$products   = seb_get_posts_by_posttype('mc_product');
$categories = get_terms([
    'taxonomy'  => 'category',
    'post_type' => 'mc_product'
]);
$seasons    = get_terms([
    'taxonomy'  => 'mc_season',
    'post_type' => 'mc_product'
]);

$categories_opts = [];
$seasons_opts    = [];

// Get query parameters.
$param_category = seb_GET('category');
$param_season   = seb_GET('season');

// Get proper arrays for <select> tag.
foreach ( $categories as $c ) {
    $categories_opt[] = ['key' => $c->slug, 'value' => $c->name];
}
foreach ( $seasons as $c ) {
    $seasons_opts[] = ['key' => $c->slug, 'value' => $c->name];
}
?>

<section class="shop u-margin-md-h">
    <div class="shop__filters form">
        <fieldset class="form__set">
            <legend class="form__set__legend"><?php _e('Category', 'seb') ?></legend>
            <?php seb_build_checkbox_tag($categories_opt, null, $param_category, 'category', 'category') ?>
        </fieldset>
        <fieldset class="form__set">
            <legend class="form__set__legend"><?php _e('Season', 'seb') ?></legend>
            <?php seb_build_checkbox_tag($seasons_opts, null, $param_season, 'season', 'season') ?>
        </fieldset>
    </div>
    <div class="shop__products">
        <div class="flexgrid-3">

            <?php while ($products->have_posts()) : $products->the_post() ?>

                <?php get_template_part('product', 'grid') ?>

            <?php endwhile ?>
            <?php wp_reset_postdata() ?>

        </div>
    </div>
</section>