<?php get_header(); ?>

<div id="main-wrap" class="site-content section">
    <div class="container">

        <div class="page-not-found">
            <div class="page-not-found-inner">
                <div class="icon-404">
                    <i class="fa fa-blind"></i>
                </div>
                <h1><?php esc_html_e( 'This is 404 Error page', 'onliestwp' ); ?></h1>
                <p><?php esc_html_e( 'We\'re sorry, the page you have looked for does not exist! Try using the search box below.', 'onliestwp' ); ?></p>

                <div class="search-form row">
                    <?php the_widget( 'WP_Widget_Search', array(), array(
                        'before_widget' => '<div class="col-sm-8 col-sm-offset-2 widget_search">',
                        'after_widget' => '</div>',
                        'before_title' => '<h5 class="widget-title">',
                        'after_title' => '</h5>',
                    ) ); ?>
                </div>
            
            </div>
        </div>

    </div>
</div>

<?php get_footer(); ?>