<div class="single-gallery-holder">
    <div class="row">
        <?php
        foreach ( $gallery_items as $i => $gallery_item ) :

            $main_thumbnail_size = 1;

            // General Vars
            $column_width = isset( $gallery_item['column_width'] ) ? $gallery_item['column_width'] : '1-2';

                // Column Classes
                $column_classes = array( 'col-xs-12' );

                if ( $column_width == '1-2' ) {
                    $column_classes[] = 'col-sm-6';
                    $main_thumbnail_size = 2;
                } elseif ( $column_width == '1-3' ) {
                    $column_classes[] = 'col-sm-4';
                    $main_thumbnail_size = 3;
                } elseif ( $column_width == '2-3' ) {
                    $column_classes[] = 'col-sm-8';
                    $main_thumbnail_size = 2;
                } elseif ( $column_width == '1-4' ) {
                    $column_classes[] = 'col-sm-3';
                    $main_thumbnail_size = 4;
                }

                $main_thumbnail_size = apply_filters( 'onliest_single_portfolio_gallery_image', 'portfolio-single-img-' . $main_thumbnail_size );

                $item_classes = array( 'gallery-image-item' );

            // Image Type
            if ( 'image' == $gallery_item['acf_fc_layout'] ) :

                $img          = $gallery_item['image'];
                $caption      = nl2br( make_clickable( $img['caption'] ) );
                $alt_text 	  = $img['alt'];
                $href		  = $img['url'];
                if ( ! $img['id'] ) {
                    continue;
                }

                $is_video = $alt_text && preg_match( '/(youtube\.com|vimeo\.com)/i', $alt_text );

                ?>
                <div class="<?php echo implode( ' ', $column_classes ); ?>">
                    <div class="<?php echo implode( ' ', $item_classes ); ?>">
                        <a class="lightbox-gallery" href="<?php echo esc_attr($is_video) ? esc_url( $alt_text ) : esc_url( $href ); ?>">
                            <img src="<?php echo esc_url( $href ); ?>" alt="<?php echo esc_attr( $alt_text );?>">
                        </a>
                        <?php if ( $caption ) : ?>
                            <div class="gallery-item-caption"><span><?php echo codebean_esc_script( $caption ); ?></span></div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
            endif;
            // End: Image Type


            // Vimeo Video
            if ( 'vimeo_video' == $gallery_item['acf_fc_layout'] ) :
                $video_url          = $gallery_item['video_url'];
                $video_resolution   = $gallery_item['video_resolution'];

                // Check Type
                $video_path = explode( "/", trim( parse_url( $video_url, PHP_URL_PATH ), '/' ) );
                $video_id = $video_path[0];

                // Check Type
                parse_str( parse_url( $video_url, PHP_URL_QUERY ), $video_url_args );

                if ( ! is_array( $video_url_args ) || ! isset( $video_url_args['v'] ) ) {
                    if ( ! preg_match( '/vimeo\.com\/(?<v>[^\\\]+)/', $video_url, $video_url_args ) ) {
                        continue;
                    }
                }

                if ( ! is_numeric( $video_id ) ) {
                    continue;
                }
                ?>
                <div class="<?php echo implode( ' ', $column_classes ); ?>">
                    <div class="portfolio-gallery-video">
                        <?php
                        echo '<iframe width="640px" height="350px" src="https://player.vimeo.com/video/' . $video_url_args['v'] . '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>'
                        ?>
                    </div>
                </div>
                <?php
            endif;
            // End: Vimeo Video


            // YouTube Video
            if ( 'youtube_video' == $gallery_item['acf_fc_layout'] ) :

                $video_url          = $gallery_item['video_url'];
                $video_resolution   = $gallery_item['video_resolution'];
                $video_poster       = $gallery_item['video_poster'];

                // Added in v1.8
                $youtube_default	= $gallery_item['default_youtube_player'];
                $auto_play			= $gallery_item['auto_play'];
                $video_loop			= $gallery_item['loop'];

                // Check Type
                parse_str( parse_url( $video_url, PHP_URL_QUERY ), $video_url_args );

                if ( ! is_array( $video_url_args ) || ! isset( $video_url_args['v'] ) ) {
                    if ( ! preg_match( '/youtu\.be\/(?<v>[^\\\]+)/', $video_url, $video_url_args ) ) {
                        continue;
                    }
                }

                // Video Poster
                $fn_poster = '';

                if ( $video_poster && $video_poster['url'] ) {

                    $fn_poster  = '$atts["poster"] = "' . addslashes( $video_poster['url'] ) . '";';
                    $fn_poster .= 'return $atts;';

                    $fn_poster = create_function( '$atts', $fn_poster );

                    add_filter( 'onliest_video_shortcode_container_atts', $fn_poster );
                }

                // Auto Play Video
                $fn_autoplay = '';

                if ( $auto_play ) {
                    $fn_autoplay  = '$atts["autoplay"] = "autoplay";';
                    $fn_autoplay .= 'return $atts;';

                    $fn_autoplay = create_function( '$atts', $fn_autoplay );

                    add_filter( 'onliest_video_shortcode_container_atts', $fn_autoplay );
                }

                // Loop Video
                $fn_loop = '';

                if ( $video_loop ) {
                    $fn_loop  = '$atts["loop"] = "loop";';
                    $fn_loop .= 'return $atts;';

                    $fn_loop = create_function( '$atts', $fn_loop );

                    add_filter( 'onliest_video_shortcode_container_atts', $fn_loop );
                }
                ?>
                <div class="<?php echo implode( ' ', $column_classes ); ?>">
                    <div class="portfolio-gallery-video">
                        <?php
                        if ( $youtube_default ) {
                            echo '<iframe width="100%" height="100%" src="https://www.youtube.com/embed/' . $video_url_args['v'] . '?' . ( isset( $video_url_args['list'] ) ? "list={$video_url_args['list']}&" : '' ) . 'rel=0&amp;controls=1&amp;showinfo=0&amp;autoplay=' . ( $auto_play ? 1 : 0 ) . '" frameborder="0" allowfullscreen></iframe>';
                        }
                        ?>
                    </div>
                </div>
                <?php

            endif;
            // End: YouTube Video



            // Text Quote
            if ( 'text_quote' == $gallery_item['acf_fc_layout'] ) :

                $quote_text = $gallery_item['quote_text'];
                $quote_author = $gallery_item['quote_author'];
                ?>
                <div class="<?php echo implode( ' ', $column_classes ); ?>">
                    <blockquote>
                        <?php echo do_shortcode( $quote_text ); ?>

                        <?php if ( $quote_author ) : ?>
                            <cite>- <?php echo codebean_esc_script( $quote_author ); ?></cite>
                        <?php endif; ?>
                    </blockquote>
                </div>
                <?php

            endif;
            // End: Text Quote


            // HTML
            if ( $gallery_item['acf_fc_layout'] == 'html' ) : ?>
                <div class="<?php echo implode( ' ', $column_classes ); ?>">
                    <?php echo apply_filters( 'the_content', $gallery_item['content'] ); ?>
                </div>
                <?php
            endif;
            // End: HTML

        endforeach;
        ?>
    </div>
</div>