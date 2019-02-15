<?php get_header(); ?>

<?php $is_using_vc = get_post_meta( get_the_ID(), '_wpb_vc_js_status', true ); ?>

<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>

    <?php if ( $is_using_vc === 'true' ) : ?>

        <div id="main-wrap" <?php post_class( 'visual-composer-page' ); ?>>

            <div class="section-anchor" data-anchor="remove" data-section="#header"></div>

            <div class="container">
                <?php the_content();?>
            </div>

        </div>

    <?php else : ?>

        <div id="main-wrap" class="site-content section">
            <div class="container container-main">

                <div class="main-page-content" role="main">

                    <div class="page-content">

                        <article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <?php
                                the_content();
                                do_action('codebean_page_after_content');
                            ?>
                        </article>

                    </div>

                    <?php comments_template(); ?>

                </div>

                <?php get_sidebar(); ?>

            </div>
        </div>

    <?php endif; ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>