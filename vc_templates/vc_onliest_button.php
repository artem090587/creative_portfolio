<?php

extract( shortcode_atts( array(
    'text'          => '',
    'link'          => '#',
    'icon'          => '',
    'style'         => 'btn-black',
    'size'          => '',
    'el_class'      => '',
    'css_animation' => '',
), $atts ) );

// Link 
$link = vc_build_link($link);

$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, "wpb_onliest_button btn $style $size $el_class" . ( ! empty( $icon ) ? 'btn-icon' : '' ) . $this->getCSSAnimation( $css_animation ), $this->settings['base'] );
?>

<a href="<?php echo esc_url( $link['url'] ); ?>" title="<?php echo esc_attr( $link['title'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>" class="<?php echo esc_attr($css_class); ?>">
    <?php echo esc_html($text); ?>
    <?php if ( ! empty( $icon) ) : ?>
    <i class="<?php echo esc_attr($icon); ?>"></i>
    <?php endif; ?>
</a>