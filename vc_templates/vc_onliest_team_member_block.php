<?php

extract( shortcode_atts( array(
    'name'          => '',
    'photo'         => '',
    'position'      => '',
    'socmed'        => '',
    'el_class'      => '',
    'css_animation' => '',
), $atts ) );

$socmed = preg_split( "/\\r\\n|\\r|\\n/", $socmed );

$links = array();
foreach ( $socmed as $sm ) {
    if ( empty( $sm ) ) continue;
    $sm = preg_replace( "/(^)?(<br\s*\/?>\s*)+$/", "", $sm );
    $arr = explode( ':' , $sm, 2 );
    $arr = array_map( 'trim', $arr );
    $links[ $arr[0] ] = $arr[1];
}

if( ! $photo){
    return;
}
$photo = wpb_getImageBySize( array( 'attach_id' => $photo, 'thumb_size' => 'full' ) );

$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_patch_team_member wpb_content_element ' . $el_class, $this->settings['base'] );
$css_class .= $this->getCSSAnimation( $css_animation );
?>

<div class="<?php echo esc_attr($css_class); ?>">
    <div class="wpb_wrapper">

        <?php if ( ! empty( $photo ) ) : ?>
            <div class="team-member-image">
                <?php echo codebean_kses_img($photo['thumbnail']); ?>

                <?php if ( ! empty( $links ) ) : ?>
                    <div class="team-member-over">
                        <div class="team-member-over-inner">
                            <span><?php esc_html_e( 'Find me on', 'onliestwp' ); ?></span>
                            <ul class="team-social-list">
                                <?php foreach ( $links as $key => $link ) : ?>
                                    <li>
                                        <a href="<?php echo esc_url($link); ?>" target="_blank">
                                            <i class="fa fa-<?php echo esc_attr($key); ?>"></i>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        <?php endif; ?>

        <div class="team-member-content">
            <h3><?php echo esc_html($name); ?></h3>
            <span class="team-member-role"><?php echo esc_attr($position); ?></span>
            <p><?php echo wpb_js_remove_wpautop( $content ); ?></p>
        </div>

    </div>
</div>