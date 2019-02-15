<?php

extract( shortcode_atts( array(
	'large_heading' => '',
	'small_heading' => '',
	'align'         => 'center',
	'el_class'      => '',
), $atts ) );

$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_patch_section_heading wpb_content_element text-' . $align . ' ' . $el_class, $this->settings['base'] );
?>

<div class="<?php echo esc_attr($css_class); ?>">
    <div class="wpb_wrapper">
        

		<?php if ( ! empty( $large_heading ) ) : ?>
			<h2 class="section-title"><?php echo esc_html($large_heading); ?></h2>
		<?php endif; ?>
		<?php if ( ! empty( $small_heading ) ) : ?>
			<p class="section-tagline"><?php echo esc_html($small_heading); ?></p>
		<?php endif; ?>
    </div>
</div>