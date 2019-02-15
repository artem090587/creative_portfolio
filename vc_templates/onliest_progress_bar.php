<?php

extract( shortcode_atts( array(
	'caption'       => '',
	'value'         => '100',
	'color'         => '',
	'el_class'      => '',
), $atts ) );

$value = min( max( absint( $value ), 0 ), 100 );

$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'patch_progress_bar wpb_content_element ' . $el_class, $this->settings['base'] );
?>

<div class="js-skill-bar <?php echo esc_attr($css_class); ?>" data-percentage="<?php echo esc_attr($value); ?>">
    <div class="skill-bar-text">
        <span class="skill-bar-title"><?php echo esc_attr($caption); ?></span>
        <span class="skill-bar-value"><?php echo esc_attr($value); ?>%</span>
    </div>
    <div class="progress-inner">
        <div class="progress-track" style="width: <?php echo esc_attr($value); ?>%; <?php echo ! empty( $color ) ? ' background-color: ' . $color . ';' : ''; ?>"></div>
    </div>
</div>