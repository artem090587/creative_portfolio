<?php

/*
 * Template Name: Blog with Sidebar
 * Description: This page template works as blog post index page with Sidebar enabled.
 */

?>

<?php get_header(); ?>

<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>

    <div id="main-wrap" class="site-content section">
        <div class="container container-main">

            <?php global $wp_query, $more, $paged, $page; $temp = $wp_query; $more = 0;
            $paged    = max( $paged , $page );
            $wp_query = new WP_Query( array(
                'post_type' => 'post',
                'paged'     => $paged,
            ) ); ?>

            <div class="main-page-content" role="main">

                <?php get_template_part( 'loop' ); ?>

            </div>

            <?php $wp_query = $temp; wp_reset_postdata(); ?>

            <?php get_sidebar(); ?>
            
        </div>
    </div>      

<?php endwhile; endif; ?>

<?php get_footer(); ?>