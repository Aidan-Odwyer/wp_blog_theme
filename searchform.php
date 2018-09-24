<div class="search_menu">
	<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	    <input type="search" class="search-field search_field" value="<?php echo get_search_query(); ?>" name="s" />
	    <input type="submit" class="search-submit search_submit_text site_bc_blue" value="<?php esc_html_e('Search', 'wp_blog') ?>" />
	</form>
</div>