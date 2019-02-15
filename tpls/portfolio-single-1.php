<?php

include locate_template( 'tpls/portfolio-single-item-details.php' );


do_action( 'onliest_portfolio_item_before', 'type-1' );
?>

<div id="main-wrap" class="site-content section">
    <div class="container">

        <div class="portfolio-single style1<?php echo esc_attr($sticky_description) ? ' sticky-description' : ''; echo esc_attr($description_alignment) == 'left' ? ' left-description' : ''; ?>">
            <div class="row">

                <div class="portfolio-single-details col-md-5 <?php echo esc_attr($description_alignment) == 'right' ? 'right-aligned' : ''; ?>">

                    <div class="title-holder">
                        <h1 class="entry-title" itemprop="name headline"><?php the_title(); ?></h1>

                        <?php if ( $sub_title ) : ?>
                            <p><?php echo esc_html( $sub_title ); ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="portfolio-description">
                        <?php the_content(); ?>
                    </div>

                    <?php include locate_template( 'tpls/portfolio-checklists.php' ); ?>

                    <?php include locate_template( 'tpls/portfolio-launch-project.php' ); ?>

                </div>

                <div class="col-md-7 portfolio-single-gallery">

                    <?php include locate_template( 'tpls/portfolio-gallery.php' ); ?>

                </div>

            </div>
        </div>

    </div>
</div>