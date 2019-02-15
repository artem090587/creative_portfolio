<?php

// Atts
if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

$el_class .= ' testimonials-' . $layout;
$el_class .= ' testimonials-align-' . $align;
$el_class .= ' testimonials-col-' . $columns;

if( $layout == 'slider' ) {
	$el_class .= ' owl-carousel';
}

$carousel_id = 'testimonials-' . rand( 1000, 10000);

$items = array();
$items['desktop'] = ($slides_per_view > 0) ? $slides_per_view : 1;
$items['desktop_small'] = ($items['desktop'] > 1) ? $items['desktop'] - 1 : 1;
$items['tablet'] = ($items['desktop_small'] > 1) ? $items['desktop_small'] : 1;
$items['mobile'] = ($items['tablet'] > 2) ? $items['tablet'] - 2 : 1;

if($items['mobile'] > 2) {
	$items['mobile'] = 2;
}

?>

<div id="<?php echo esc_attr($carousel_id); ?>" class="testimonials-wrapper">
    <div class="testimonials<?php echo esc_attr($el_class); ?>">
        <?php echo do_shortcode( $content ); ?>
    </div>
</div>
<?php
$testimonials_carousel_script = '
    jQuery(document).ready(function($) {
        "use strict";
        
        var owl = $("#'. esc_js( $carousel_id ) .' .testimonials-slider" );
        owl.owlCarousel({
            autoplay: true,
            autoplayTimeout: 5000,
            items: ' . esc_js( $items['desktop'] ) . ',
            responsive: {
                979: {
                    items: ' . esc_js( $items['desktop'] ) . ',
                },
                768: {
                    items: ' . esc_js( $items['desktop_small'] ) . ',
                },
                479: {
                    items: ' . esc_js( $items['tablet'] ) . ',
                },
                0: {
                    items: ' . esc_js( $items['mobile'] ) . ',
                }
            },
            dots:' . esc_js( $show_pagination_control == 'yes' ? 'true' : 'false' ) . ', 
            nav: ' . esc_js( $show_prev_next_buttons == 'yes' ? 'true' : 'false' ) . ', 
            navText: false,
            loop: ' . esc_js( $wrap == 'yes' ? 'true' : 'false' ) . ',
        });
        
    })';

wp_add_inline_script( 'onliest-main', $testimonials_carousel_script );