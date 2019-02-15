<?php 

extract( shortcode_atts( array(
    'icon_type'     => 'numerical',
    'icon'          => '',
    'header'        => '',
    'text'          => '',
    'css_animation' => '',
), $atts ) );

$icon_markup = null;

if(!empty($icon)) {
    if($GLOBALS['patch-list-item-icon-style'] == 'border' || $GLOBALS['patch-list-item-icon-style'] == 'no-border')
        $icon_markup = '<i class="'.$icon.' '.strtolower($GLOBALS['patch-list-item-icon-color']).'"></i>';
    else
        $icon_markup = '<i class="'.$icon.'"</i>';
}

$icon_output = ($icon_type == 'numerical') ? '<span>'. $GLOBALS['patch-list-item-count'] . '</span>' : $icon_markup;

echo '<div class="icon-list-item '. $this->getCSSAnimation( $css_animation ) . '"><div class="list-icon-wrapper '.$icon_type.'">'.$icon_output.'</div><div class="icon-list-item-content"><h3>'.$header.'</h3><p>'.$text.'</p></div></div>';

$GLOBALS['patch-list-item-count']++;
?>