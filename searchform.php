<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span><?php echo _x( 'Search for:', 'label', 'seb' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'seb' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'seb' ); ?>" />
	</label>
	<button type="submit" class="search-submit"><?php echo _x( 'Search', 'submit button', 'seb' ); ?></button>
</form>
