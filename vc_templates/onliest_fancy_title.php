<?php

extract( shortcode_atts( array(
	'title'         => '',
    'el_class'      => '',
    'css_animation' => '',
), $atts ) );

$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'onliest-fancy-title wpb_content_element text-center ' . $el_class, $this->settings['base'] );
$css_class .= $this->getCSSAnimation( $css_animation );
?>

<h1 class="<?php echo esc_attr($css_class); ?>">
    <div class="wpb_wrapper">
        <span><?php echo esc_html($title); ?></span>
    </div>
</h1>