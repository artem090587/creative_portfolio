<?php

if( ! function_exists( 'wpb_getImageBySize' ) ) return;

$output = $class = '';
extract(shortcode_atts( array(
    'image' => '',
    'img_size' => '100x100',
    'name' => '',
    'title' => '',
    'el_class' => ''
), $atts ));

$img_id = preg_replace( '/[^\d]/', '', $image );

$img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => $img_size, 'class' => 'testimonial-avatar-image' ) );

$class .= ' ' . $el_class;

?>
<div class="testimonial<?php echo esc_attr( $class ); ?>">
    <div class="testimonial-wrap">
        <?php if ( $img['thumbnail'] != ''): ?>
        <div class="testimonial-image">
            <?php echo codebean_kses_img($img['thumbnail']); ?>
        </div>
        <?php endif; ?>
        <div class="testimonial-content">
            <?php echo do_shortcode( $content ); ?>
            <div class="testimonial-info">
                <?php echo esc_html( $name ); ?>
                <span><?php echo esc_html( $title ); ?></span>
            </div>
        </div>
    </div>
</div>
