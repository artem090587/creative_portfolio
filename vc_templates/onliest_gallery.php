<?php

// Atts
if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

// Element Class
$class = "gallery-slider";
$class .= " onliest-galery";
$class .= $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

$carousel_id = 'gallery-' . rand(100,999);

$images = explode(',', $images);


if ( 'links' === $on_click ) {
    $custom_links = vc_value_from_safe( $custom_links );
    $custom_links = explode( ',', $custom_links );
}

$items = array();
$items['desktop'] = ($slides_per_view > 0) ? $slides_per_view : 1;
$items['desktop_small'] = ($items['desktop'] > 1) ? $items['desktop'] - 1 : 1;
$items['tablet'] = ($items['desktop_small'] > 1) ? $items['desktop_small'] : 1;
$items['mobile'] = ($items['tablet'] > 2) ? $items['tablet'] - 2 : 1;

if($items['mobile'] > 2) {
	$items['mobile'] = 2;
}

?>
<div id="<?php echo esc_attr( $carousel_id ); ?>" class="<?php echo esc_attr( $css_class ); ?>">

    <div class="gallery-images owl-carousel">

        <?php if ( count($images) > 0 ): ?>
            <?php $i=0; foreach ($images as $img_id):
                $i++;
                $attachment = get_post( $img_id );
                $title = trim( strip_tags( $attachment->post_title ) );
                $img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => $img_size, 'class' => 'gallery-item-image image-' . $i ) );
                $link = $img['p_img_large']['0'];
                if( 'links' === $on_click ) {
                    $link = (isset( $custom_links[$i-1] ) ? $custom_links[$i-1] : '' );
                }
                ?>
                <div class="gallery-item">
                    <?php if ( $on_click != 'none' ): ?>
                    <a href="<?php echo esc_url( $link ); ?>" data-index="<?php echo esc_attr($i); ?>" data-width="<?php echo esc_attr( $img['p_img_large']['1'] ); ?>" data-height="<?php echo esc_attr( $img['p_img_large']['2'] ); ?>" <?php if( $target_blank ): ?>target="_blank"<?php endif; ?>>
                        <?php endif ?>
                        <?php echo codebean_kses_img($img['thumbnail']); ?>
                        <?php if ( $on_click != 'none' ): ?>
                    </a>
                <?php endif ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>
</div>

<?php
$gallery_carousel_script = '
    jQuery(document).ready(function($) {
        "use strict";
        
        var owl = $("#'. esc_js( $carousel_id ) .' .gallery-images" );
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

wp_add_inline_script( 'onliest-main', $gallery_carousel_script );