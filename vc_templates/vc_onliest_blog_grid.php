<?php

// Atts
if ( function_exists( 'vc_map_get_attributes' ) ) {
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

list( $query_args, $blog_query ) = vc_build_loop_query( $blog_query );

$unique_id = 'blog-grid-' . mt_rand(1, 100);

$columns_class  = '';
$columns_count  = intval( $blog_columns );

$more_link = vc_build_link($more_link);

switch( $blog_columns ) {

    case '1':
        $columns_class = 'col-sm-12';
        break;

    case '2':
        $columns_class = 'col-sm-6';
        break;

    case '4':
        $columns_class = 'col-md-3 col-sm-6';
        break;

    default:
        $columns_class = 'col-md-4 col-sm-6';
        $columns_count = 3;
}

// Custom Class
$css_classes = array(
    $this->getExtraClass( $el_class ),
    'row',
    'blog-posts',
    'masonry-wrapper',
    vc_shortcode_custom_css_class( $css ),
);

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
?>

<div id="<?php echo esc_attr($unique_id); ?>" class="<?php echo esc_attr($css_class); ?>">

    <?php
    if ( $blog_query->have_posts() ) :

        $i = 0;

        while( $blog_query->have_posts() ) : $blog_query->the_post();

            echo '<article class="post-item post-masonry masonry-item ' . $columns_class . '">';

            ?>
            <div <?php post_class( 'post-masonry-inner' ); ?>>
                <?php if ( has_post_thumbnail() ) :?>
                    <div class="post-thumbnail">
                        <a href="<?php the_permalink(); ?>">
                            <span class="post-image-inner">
                                <?php the_post_thumbnail( 'onliestwp-masonry-blog-thumb' ); ?>
                            </span>
                        </a>
                    </div>
                <?php endif; ?>
                <div class="post-masonry-content">
                    <h3 class="post-masonry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p><?php echo codebean_string_limit_words(get_the_excerpt(), 15); ?>&hellip;</p>
                    <span class="post-meta-item"><?php the_author_posts_link(); ?> <?php echo esc_html('on ', 'onliestwp') , get_the_date(); ?></span>
                </div>
            </div>
            <?php

            echo '</article>';

            $i++;

        endwhile;

        wp_reset_postdata();

    endif;
    ?>
</div>
