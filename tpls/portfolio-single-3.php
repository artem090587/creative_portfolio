<?php

include locate_template( 'tpls/portfolio-single-item-details.php' );

$has_services_section   = $launch_link_href || count( $checklists );

do_action( 'onliest_portfolio_item_before', 'type-3' );
?>
<div id="main-wrap" class="site-content section">

    <div class="portfolio-single style3">

        <?php include locate_template( 'tpls/portfolio-gallery-slider.php' ); ?>

        <div class="container">
            <div class="row">
                <div class="portfolio-single-details col-sm-12">
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
            </div>
            <div class="row">
                <?php if ( $has_services_section ) : ?>
                    <div class="col-sm-12">
                        <div class="portfolio-attriubtes-alt">
                            <?php include locate_template( 'tpls/portfolio-checklists.php' ); ?>

                            <?php include locate_template( 'tpls/portfolio-launch-project.php' ); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>



    </div>

</div>