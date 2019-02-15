<?php

extract( shortcode_atts( array(
	'subject'       => '',
	'start'         => 0,
	'end'           => 100,
    'suffix'        => '',
    'decimals'      => 0,
	'el_class'      => '',
	'css_animation' => '',
), $atts ) );

$start = floatval( $start );
$end = floatval( $end );

wp_enqueue_script( 'jquery-countup' );

$id = 'milestone-' . mt_rand(1000, 10000);

$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'patch_milestone wpb_content_element text-center ' . $el_class, $this->settings['base'] );
?>

<div class="<?php echo esc_attr($css_class); ?> js-milestone" data-counter="<?php echo esc_attr($id); ?>">
    <div class="milestone-number">
        <div class="milestone-number-inner">
            <span id="<?php echo esc_attr($id); ?>" class="js-milestone-number"><?php echo esc_html($end); ?></span><span class="milestone-suffix"><?php echo esc_html($suffix); ?></span>
        </div>
    </div>
    <div class="milestone-subject"><?php echo esc_html($subject); ?></div>
</div>