<?php

include locate_template( 'tpls/portfolio-single-item-details.php' );

do_action( 'onliest_portfolio_item_before', 'type-4' );
?>

<div id="main-wrap" class="site-content section">

    <div class="portfolio-single style4 vc-container container">
        <?php the_content(); ?>
    </div>

</div>


