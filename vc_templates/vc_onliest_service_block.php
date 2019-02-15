<?php

extract( shortcode_atts( array(
    'heading'       => '',
    'subheading'    => '',
	'style'         => 'style-1',
	'icon'          => '',
	'el_class'      => '',
	'css_animation' => '',
), $atts ) );

$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'icon-box wpb_content_element ' . $style . ' ' . $el_class, $this->settings['base'] );
$css_class .= $this->getCSSAnimation( $css_animation );
?>

<div class="<?php echo esc_attr($css_class); ?>">
    <div class="wpb_wrapper">
        <?php if ( ! empty( $icon ) ) : ?>
            <div class="icon-box-elem">
                <i class="<?php echo esc_attr($icon); ?>"></i>
            </div>
        <?php endif; ?>
        <div class="icon-box-content">
            <?php if ( ! empty( $subheading ) ) : ?>
                <span class="icon-box-subheading"><?php echo esc_html($subheading); ?></span>
            <?php endif; ?>
            <h4 class="icon-box-title"><?php echo esc_html($heading); ?></h4>
            <div class="icon-box-text">
                <p><?php echo wpb_js_remove_wpautop( $content ); ?></p>
            </div>
        </div>
    </div>
</div>