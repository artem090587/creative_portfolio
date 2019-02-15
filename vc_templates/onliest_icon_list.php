<?php 

extract( shortcode_atts( array(
    'columns'       => '',
    'direction'     => 'vertical',
    'color'         => '',
    'icon_size'     => '',
    'icon_style'    => 'border',
), $atts ) );

$GLOBALS['patch-list-item-count'] = 1;
$GLOBALS['patch-list-item-icon-color'] = $color;
$GLOBALS['patch-list-item-icon-style'] = $icon_style;

echo '<div class="icon-list '.strtolower($color).' '.$icon_style.' '.$icon_size.'">'.do_shortcode($content).'</div>';
?>