<?php

include locate_template( 'tpls/portfolio-single-item-details.php' );

$has_services_section   = $launch_link_href || count( $checklists );

do_action( 'onliest_portfolio_item_before', 'type-2' );
?>
<div id="main-wrap" class="site-content section">
    <div class="container">

        <div class="portfolio-single style2">


            <?php
            if ( $show_featured_image && $has_thumbnail && $post_thumbnail_id ) :

                $featured_image = get_post( $post_thumbnail_id );
                $caption        = $featured_image->post_excerpt;

                $fi_href		= $featured_image->guid;
                $fi_alt			= $featured_image->_wp_attachment_image_alt;

                $is_video 		= $fi_alt && preg_match( '/(youtube\.com|vimeo\.com)/i', $fi_alt );

                $fi_classes     = array( 'portfolio-main-image single-gallery-holder' );
            ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="<?php echo implode( ' ', $fi_classes ); ?>">

                        <div class="gallery-image-item">
                            <a class="lightbox-gallery" href="<?php echo esc_attr($is_video) ? esc_url( $fi_alt ) : esc_url( $fi_href ); ?>">
                                <img src="<?php echo esc_url( $fi_href ); ?>" alt="<?php echo esc_attr( $fi_alt );?>">
                            </a>

                            <?php if($caption): ?>
                                <div class="gallery-item-caption"><span><?php echo codebean_esc_script( $caption ); ?></span></div>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>
            <?php
            endif;
            ?>

            <div class="row">
                <div class="portfolio-single-details <?php echo esc_attr($has_services_section) ? 'col-sm-8' : 'col-sm-12'; ?>">
                    <div class="title-holder">
                        <h1 class="entry-title" itemprop="name headline"><?php the_title(); ?></h1>
                        <?php if ( $sub_title ) : ?>
                            <p><?php echo esc_html( $sub_title ); ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="portfolio-description">
                        <?php the_content(); ?>
                    </div>
                </div>

                <?php if ( $has_services_section ) : ?>
                <div class="col-sm-4">
                    <?php include locate_template( 'tpls/portfolio-checklists.php' ); ?>

                    <?php include locate_template( 'tpls/portfolio-launch-project.php' ); ?>
                </div>
                <?php endif; ?>

            </div>

            <div class="row">
                <div class="col-sm-12">
                    <?php include locate_template( 'tpls/portfolio-gallery.php' ); ?>
                </div>
            </div>

        </div>

    </div>
</div>
