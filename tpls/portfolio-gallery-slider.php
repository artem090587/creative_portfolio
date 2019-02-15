<?php


$gallery_container = array();
$gallery_container[] = 'portfolio-images-carousel';
$gallery_container[] = 'single-gallery-holder';
$gallery_container[] = 'owl-carousel';

?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="<?php echo implode( ' ', $gallery_container ); ?>">
                <?php
                foreach ( $gallery_items as $i => $gallery_item ) :

                    $main_thumbnail_size = apply_filters( 'onliest_single_portfolio_gallery_image', 'portfolio-single-img-1' );

                    // Image Type
                    if ( $gallery_item['acf_fc_layout'] == 'image' ) :

                        $img             = $gallery_item['image'];
                        $caption         = nl2br( make_clickable( $img['caption'] ) );

                        $alt_text 	  = $img['alt'];
                        $img_link	  = $img['url'];

                        $link_url        = $gallery_item['link_url'];
                        $link_target     = $gallery_item['link_target'];

                        ?>
                        <div class="portfolio-carousel-image-holder">
                            <?php if ( $link_url ) : ?>
                                <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr($link_target) ? '_blank' : '_self'; ?>">
                                    <?php endif; ?>
                                    <img src="<?php echo esc_url( $img_link ); ?>" alt="<?php echo esc_attr( $alt_text ); ?>">
                                    <?php if ( $link_url ) : ?>
                                </a>
                            <?php endif; ?>

                            <?php if ( $caption ) : ?>
                                <div class="gallery-item-caption"><span><?php echo codebean_esc_script( $caption ); ?></span></div>
                            <?php endif; ?>
                        </div>
                    <?php
                    endif;
                    // End: Image Type

                endforeach;
                ?>
            </div>
        </div>
    </div>
</div>
