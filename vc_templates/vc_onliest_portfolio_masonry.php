<?php

wp_enqueue_script( 'isotope' );
wp_enqueue_script( 'modulo-columns' );

$animation_style = 'cdbFadeUp';

$atts = vc_map_get_attributes( 'vc_onliest_portfolio_masonry', $atts );
extract( $atts );

$portfolio_source = $portfolio_source ? $portfolio_source : 'by_id';

if ($portfolio_source === 'by_id') {
    $portfolio_id_array = explode(',', $portfolio_ids);

    $args = array(
        'posts_per_page' => -1,
        'post_type' =>'portfolio',
        'post__in' => $portfolio_id_array,
        'orderby' => 'post__in'
    );
    $posts = new WP_Query( $args );
} else {
    $source_data = VcLoopSettings::parseData( $source );
    $query_builder = new ThbLoopQueryBuilder( $source_data );
    $posts = $query_builder->build();
    $posts = $posts[1];

    if ( $posts->have_posts() ) {
        while ( $posts->have_posts() ) : $posts->the_post();
            $portfolio_id_array[] = get_the_ID();
        endwhile;
    }
}

$rand = rand(0,1000);
$i = 0;

// get selected categorie id's
$cats = (empty($category)) ? array() : explode(',', $category);
$all_categories = array();
foreach ( $cats as $cat ) {
    $term  = get_term_by('slug', $cat, 'portfolio-category');
    $all_categories[] = $term->term_id;
}

$classes[] = 'row portfolio-wrapper masonry-wrapper';
$classes[] = $style;

if ( $style == 'style1') {
    $classes[] = $masonry_layout;
}

$btn_classes[] = 'masonry-btn btn';

if ( $posts->have_posts() ) { ?>

    <?php if ( $add_filters == 'true' ) : ?>
        <div class="portfolio-categories" id="cdb-filter-<?php echo esc_attr($rand); ?>">
            <ul class="portfolio-filters">
                <li><a href="#" data-filter="*" class="active"><?php esc_html_e( 'All', 'onliestwp' ); ?></a></li>
                <?php $all_categories = get_terms( 'portfolio-category', array(
                    'hide_empty' => false,
                    'include'    => $all_categories
                ) );

                foreach ($all_categories as $category) : ?>
                    <li><a href="#" data-filter=".cdb-cat-<?php echo esc_attr( $category->slug ); ?>"><?php echo esc_html( $category->name ); ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div id="portfolio-wrap-<?php echo esc_attr($rand); ?>" class="<?php echo implode(' ', $classes); ?>">
        <?php while ( $posts->have_posts() ) : $posts->the_post(); // start of the loop
            set_query_var( 'codebean_hover_style', $hover_style);
            if ($style == 'style1') {
                $column_size = codebean_get_portfolio_size($masonry_layout, $i);
                set_query_var( 'codebean_size', $column_size );
            } else {
                set_query_var( 'codebean_size', $columns );
                set_query_var( 'codebean_masonry', true );
            }
            get_template_part( 'tpls/portfolio-'.$style );
        $i++; endwhile; // end the loop ?>
    </div>

<?php
} else {

    get_template_part( 'tpls/not-found' );
}
?>
<?php
    wp_reset_query();
    wp_reset_postdata();
?>


