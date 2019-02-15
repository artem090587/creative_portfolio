<?php

extract( shortcode_atts( array(
	'count'         => '',
	'columns'       => '',
	'filter'        => 'true',
	'el_class'      => '',
	'css_animation' => '',
	'pagination'    => 'true',
	'category'      => '',
), $atts ) );

if ( ! class_exists( 'VP_Portfolio' ) ) return null;

// generate unique id
$uid = 'portfolio-' . mt_rand(1000, 10000);

wp_enqueue_script( 'isotope' );
wp_enqueue_script( 'modulo-columns' );

global $wp_query, $paged, $page; $temp = $wp_query;

// discover current page number
if ( get_query_var('paged') )
    $paged = get_query_var('paged');
elseif ( get_query_var('page') )
    $paged = get_query_var('page');
else
    $paged = 1;

$wp_query = new WP_Query(array_merge(
    array(
        'post_type'           => 'portfolio',
		'posts_per_page'      => $count,
		'ignore_sticky_posts' => 1,
		'paged'               => max( $paged, $page )
    ),
    (empty($category)) ? array() : array(
        'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'portfolio_category',
				'field'    => 'slug',
				'terms'    => explode(',', $category),
				'operator' => 'IN'
            )
        )
    )
));

// get selected categorie id's
$cats = (empty($category)) ? array() : explode(',', $category);
$all_categories = array();
foreach ( $cats as $cat ) {                     
    $term  = get_term_by('slug', $cat, 'portfolio_category');
    $all_categories[] = $term->term_id;
}

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_patch_portfolio_grid no-space wpb_content_element js-isotope-grid ' . $el_class, $this->settings['base'] );
?>

<?php if ( have_posts() ) : ?>

<?php

// discover next url
$next_link = get_next_posts_link();
$next_url = '';
if (!empty($next_link)) {
    preg_match_all('/href="([^\s"]+)/', $next_link, $match);
    $next_url = $match[1][0];
}

?>

    <div class="<?php echo esc_attr($css_class); ?>" id="<?php echo esc_attr($uid); ?>" data-loading="<?php echo (!empty($next_url) ? $next_url : "false"); ?>">
        <div class="wpb_wrapper">

            <?php if ( $filter == 'true' ) : ?>
                <ul class="portfolio-filters">
                    <li>
                        <a href="#" data-filter="*" class="active"><?php esc_html_e( 'Show All', 'onliestwp' ); ?></a>
                    </li>
                    <?php $all_categories = get_terms( 'portfolio_category', array(
						'hide_empty' => false,
						'include'    => $all_categories
                    ) );

                    foreach ( $all_categories as $category) : ?>
                    <li>
                        <a href="#" data-filter=".f-<?php echo esc_attr( $category->slug ); ?>"><?php echo esc_html( $category->name ); ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <div class="layout-type-masonry row">
                <?php while( have_posts() ) : the_post(); ?>

                    <?php $categories = get_the_terms( get_the_ID(), 'portfolio_category' );

                    $cat_string = array();
                    $filter_string = array();
                    if ( ! empty( $categories ) ) {
                        foreach ( $categories as $category ) {
                            $cat_string[] = $category->name;
							$filter_string[] = 'f-' . $category->slug;
                        }
                    } ?>

                    <div id="portfolio-item-<?php the_ID(); ?>" <?php post_class( 'portfolio-item ' . implode( ' ', $filter_string ) . ' col-md-' . 12 / $columns . ' col-sm-6 ' . $this->getCSSAnimation( $css_animation ) ); ?>>
                        
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="portfolio-item-thumbnail">
                                <a href="<?php the_permalink(); ?>"></a>
                                <?php the_post_thumbnail( 'onliestwp-portfolio-thumb' ); ?>
                                <div class="portfolio-item-hover">
                                    <div class="portfolio-hover-vert">
                                        <h3 class="portfolio-item-title"><?php the_title(); ?></h3>
                                        <?php if ( ! empty( $cat_string ) ) : ?>
                                            <div class="portfolio-item-category">
                                                <span><?php echo implode( ' / ', $cat_string ); ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="portfolio-hover-bg"></div>
                            </div>
                        <?php endif; ?>

                        

                    </div>
                <?php endwhile; ?>
            </div>
            
            <?php if ( $pagination == 'true' ) : ?>
            <div class="portfolio-button text-center">
                <?php if (!empty($next_url)) : ?>
                    <a href="<?php echo esc_url($next_url); ?>" class="btn btn-icon btn-primary"><?php esc_html_e( 'Load More', 'onliestwp' ); ?><i class="glyphicon glyphicon-refresh"></i></a>
                <?php endif; ?>
            </div>
            <?php endif; ?>

        </div>
    </div>


<?php endif; ?>

<?php $wp_query = $temp; wp_reset_postdata(); ?>