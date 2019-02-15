<!-- Start SearchForm -->
<form method="get" class="search-form" role="search" action="<?php echo esc_url(home_url('/')); ?>">
    <input type="text" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php esc_attr_e( 'Search site ...', 'onliestwp' ); ?>" class="form-control">
    <span class="fa fa-search"></span>
    <button class="btn hidden" type="submit"><?php esc_html_e( 'Search', 'onliestwp' ); ?></button>
</form>
<!-- End SearchForm -->