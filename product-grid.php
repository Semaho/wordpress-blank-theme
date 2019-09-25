<?php $photo = current(get_field('photos'))['photo']['sizes']['medium'] ?>

<a class="product" href="<?php the_permalink() ?>">
    <div class="product__photo" <?php seb_the_dyn_cov($photo)?>></div>
    <h3 class="product__name"><?php the_title() ?></h3>
</a>