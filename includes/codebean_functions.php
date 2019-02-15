<?php

/**
 * ------------------------------------------------------------------------------------------------
 * Codebean: Generate from To
 * ------------------------------------------------------------------------------------------------
 */
function codebean_generate_from_to($from, $to, $current_page, $max_num_pages, $numbers_to_show = 5) {
    if($numbers_to_show > $max_num_pages)
        $numbers_to_show = $max_num_pages;


    $add_sub_1 = round($numbers_to_show/2);
    $add_sub_2 = round($numbers_to_show - $add_sub_1);

    $from = $current_page - $add_sub_1;
    $to = $current_page + $add_sub_2;

    $limits_exceeded_l = FALSE;
    $limits_exceeded_r = FALSE;

    if($from < 1)
    {
        $from = 1;
        $limits_exceeded_l = TRUE;
    }

    if($to > $max_num_pages)
    {
        $to = $max_num_pages;
        $limits_exceeded_r = TRUE;
    }


    if($limits_exceeded_l)
    {
        $from = 1;
        $to = $numbers_to_show;
    }
    else
        if($limits_exceeded_r)
        {
            $from = $max_num_pages - $numbers_to_show + 1;
            $to = $max_num_pages;
        }
        else
        {
            $from += 1;
        }

    if($from < 1)
        $from = 1;

    if($to > $max_num_pages)
    {
        $to = $max_num_pages;
    }

    return array($from, $to);
}

/**
 * ------------------------------------------------------------------------------------------------
 * Codebean: Onliest Pagination
 * ------------------------------------------------------------------------------------------------
 */
function codebean_show_pagination( $current_page, $max_num_pages, $from, $to, $pagination_position = 'full', $numbers_to_show = 5 ) {

    $current_page = $current_page ? $current_page : 1;

    ?>

    <ul class="pagination text-center">

        <?php if($current_page > 1): ?>
            <li class="first_page"><a href="<?php echo get_pagenum_link(1); ?>"><?php esc_html_e('&larr; First', 'onliestwp'); ?></a></li>
        <?php endif; ?>

        <?php if($current_page > 2): ?>
            <li class="first_page"><a href="<?php echo get_pagenum_link($current_page - 1); ?>"><?php esc_html_e('Previous', 'onliestwp'); ?></a></li>
        <?php endif; ?>

        <?php
        if($from > floor($numbers_to_show / 2)) {
            ?>
            <li><a href="<?php echo get_pagenum_link(1); ?>"><?php echo 1; ?></a></li>
            <li class="dots"><span>...</span></li>
            <?php
        }

        for($i=$from; $i<=$to; $i++):

            $link_to_page = get_pagenum_link($i);
            $is_active = $current_page == $i;

            ?>
            <li<?php echo esc_attr($is_active) ? ' class="active"' : ''; ?>><a href="<?php echo esc_url($link_to_page); ?>"><?php echo esc_html($i); ?></a></li>
        <?php
        endfor;
        if($max_num_pages > $to) {
            if($max_num_pages != $i):
                ?>
                <li class="dots"><span>...</span></li>
            <?php
            endif;

            ?>
            <li><a href="<?php echo get_pagenum_link($max_num_pages); ?>"><?php echo wp_kses_post($max_num_pages); ?></a></li>
            <?php
        }
        ?>

        <?php if($current_page + 1 <= $max_num_pages): ?>
            <li class="last_page"><a href="<?php echo get_pagenum_link($current_page + 1); ?>"><?php esc_html_e('Next', 'onliestwp'); ?></a></li>
        <?php endif; ?>

        <?php if($current_page < $max_num_pages): ?>
            <li class="last_page"><a href="<?php echo get_pagenum_link($max_num_pages); ?>"><?php esc_html_e('Last &rarr;', 'onliestwp'); ?></a></li>
        <?php endif; ?>

    </ul>
    <?php

    # Deprecated (the above function displays pagination)
    if(false):

        posts_nav_link();

    endif;
}



/**
 * ------------------------------------------------------------------------------------------------
 * Codebean: Loop Query Builder
 * ------------------------------------------------------------------------------------------------
 */
add_action('init', 'codebean_TheShortcodesForVC');
function codebean_TheShortcodesForVC() {
    if ( function_exists('visual_composer') ) {
        class ThbLoopQueryBuilder extends VcLoopQueryBuilder {
            function parse_paged( $value ) {
                $this->args['paged'] = $value;
            }
        }
    }
}

/**
 * ------------------------------------------------------------------------------------------------
 * Codebean: Show Page Pagination
 * ------------------------------------------------------------------------------------------------
 */
function codebean_page_show_pagination() {

    $args_pages = array(
        'before'   => '<div class="page-pagination">',
        'after'    => '</div>',
        'pagelink' => '<span>%</span>',
        'next_or_number' => 'next',
        'nextpagelink' => '<span class="next">' . esc_html__( 'Next Page &raquo;', 'onliestwp' ) . '</span>',
        'previouspagelink' => '<span class="prev">' . esc_html__( '&laquo; Previous Page', 'onliestwp' ) . '</span>',
    );
    wp_link_pages($args_pages);

}

add_action('codebean_page_after_content', 'codebean_page_show_pagination');

/**
 * ------------------------------------------------------------------------------------------------
 * Codebean: Portfolio Sizes
 * ------------------------------------------------------------------------------------------------
 */
function codebean_get_portfolio_size($style = 'masonry-style1', $i = 0) {
    $size = '';

    if ($style == 'masonry-style1') {
        switch($i) {
            default:
                $size =	'col-xs-12 col-sm-6 col-md-3';
                break;
            case 4:
            case 14:
                $size =	'col-xs-12 col-sm-6 col-md-6 half';
                break;
            case 0:
            case 5:
            case 9:
            case 13:
                $size = 'col-xs-12 col-sm-6 col-md-3 tall';
                break;
        }
    } else if ($style == 'masonry-style2') {
        switch($i) {
            default:
                $size =	'col-xs-12 col-sm-6 col-md-3';
                break;
            case 2:
            case 5:
            case 12:
            case 15:
                $size = 'col-xs-12 col-sm-6 col-md-6';
                break;
        }
    } else if ($style == 'masonry-style3') {
        switch($i) {
            default:
                $size =	'col-xs-12 col-sm-6 col-md-6';
                break;
            case 1:
            case 2:
            case 3:
            case 5:
            case 7:
            case 8:
            case 9:
            case 11:
            case 13:
            case 14:
            case 15:
            case 17:
            case 19:
            case 20:
            case 21:
                $size =	'col-xs-12 col-sm-6 col-md-6 half';
                break;
        }
    } else if ($style == 'grid') {
        $size =	'small-12 medium-6 padding-1';
    }

    return $size;
}

/**
 * ------------------------------------------------------------------------------------------------
 * Codebean: String Limit Words
 * ------------------------------------------------------------------------------------------------
 */
function codebean_string_limit_words($string, $word_limit) {
    $words = explode(' ', $string, ($word_limit + 1));

    if(count($words) > $word_limit) {
        array_pop($words);
    }

    return implode(' ', $words);
}

/**
 * ------------------------------------------------------------------------------------------------
 * Codebean: Kses Img Atts
 * ------------------------------------------------------------------------------------------------
 */
function codebean_kses_img($content) {
    $img_atts = apply_filters('codebean_kses_img_atts', array(
        'src'    => true,
        'alt'    => true,
        'height' => true,
        'width'  => true,
        'class'  => true,
        'id'     => true,
        'title'  => true
    ));

    return wp_kses($content, array(
        'img' => $img_atts
    ));
}

/**
 * ------------------------------------------------------------------------------------------------
 * Custom Style Generator
 * ------------------------------------------------------------------------------------------------
 */
$bottom_styles = array();

function codebean_generate_custom_style( $selector, $props = '', $media = '', $footer = false ) {
    global $bottom_styles;

    $css = '';

    // Selector Start
    $css .= $selector . ' {' . PHP_EOL;

    // Selector Properties
    $css .= str_replace( ';', ';' . PHP_EOL, $props );

    $css .= PHP_EOL . '}';
    // Selector End

    // Media Wrap
    if ( trim( $media ) ) {
        if ( strpos( $media, '@' ) == false ) {
            $css = "@media {$media} { {$css} }";
        } else {
            $css = "{$media} { {$css} }";
        }
    }

    if ( ! $footer || defined( 'DOING_AJAX' ) ) {
        echo "<style>{$css}</style>";
        return;
    }

    $bottom_styles[] = $css;
}

/**
 * ------------------------------------------------------------------------------------------------
 * Codebean Post Has Title
 * ------------------------------------------------------------------------------------------------
 */
function codebean_post_has_title() {
	return get_the_title() !== '';
}

/**
 * ------------------------------------------------------------------------------------------------
 * Codebean Escape Script
 * ------------------------------------------------------------------------------------------------
 */
function codebean_esc_script( $str = '' ) {
    $str = str_ireplace( array( '<script', '</script>' ), array( '&lt;script', '&lt;/script&gt;' ), $str );
    return $str;
}

/**
 * ------------------------------------------------------------------------------------------------
 * Abstract Function to build Background Repeat inline style
 * ------------------------------------------------------------------------------------------------
 */
function codebean_build_background_repeat_style( $background_repeat ) {
    $background_repeat_style = '';

    switch ( $background_repeat ) {
        case 'cover':
            $background_repeat_style .= 'background-size: cover; background-repeat: no-repeat;';
            break;
        case 'contain':
            $background_repeat_style .= 'background-size: contain; background-repeat: no-repeat;';
            break;
        case 'no-repeat':
            $background_repeat_style .= 'background-repeat: no-repeat;';
            break;
    }
    return $background_repeat_style;
}

/**
 * ------------------------------------------------------------------------------------------------
 * Abstract Function to Call Aqua Resizer
 * ------------------------------------------------------------------------------------------------
 */
function codebean_aq_resize( $attachment_id, $width = null, $height = null, $crop = true, $single = true ) {

    if ( is_null( $attachment_id ) ) return null;

    $image = wp_get_attachment_image_src( $attachment_id, 'full' );

    $return = aq_resize( $image[0], $width, $height, $crop, $single );

    if ( $return ) {
        return $return;
    }
    else {
        return $image[0];
    }
}

/**
 * ------------------------------------------------------------------------------------------------
 * Get current post / page thumbnail for sharing purpose (pinterest must use image)
 * ------------------------------------------------------------------------------------------------
 */
function codebean_get_share_thumbnail( $post_id = null ) {
    return wp_get_attachment_url( get_post_thumbnail_id( $post_id ) );
}

/**
 * ------------------------------------------------------------------------------------------------
 * Codebean Kses
 * ------------------------------------------------------------------------------------------------
 */
function codebean_kses( $html ) {
    $allow = array_merge( wp_kses_allowed_html( 'post' ), array(
        'link' => array(
            'href'    => true,
            'rel'     => true,
            'type'    => true,
        ),
        'script' => array(
            'src' => true,
            'charset' => true,
            'type'    => true,
        )
    ) );
    return wp_kses( $html, $allow );
}