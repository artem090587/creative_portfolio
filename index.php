<?php get_header(); ?>

<div id="main-wrap" class="site-content section">
    <div class="container container-main">

        <div class="main-page-content" role="main">

            <?php get_template_part( 'loop' ); ?>
    
        </div>
        
        <?php get_sidebar(); ?>

    </div>
</div>

<?php get_footer(); ?>