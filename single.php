<?php get_header(); ?>

<div id="main-wrap" class="site-content section">
    <div class="container container-main">

        <div class="main-page-content" role="main">

            <?php get_template_part( 'content-single' ); ?>
            
            <?php if(get_the_author_meta('description') != '') { ?>
            <div class="author-bio">
                <div class="author-bio-avatar">
                    <?php echo get_avatar( get_the_author_meta( 'ID' ), 100 , '', get_the_author_meta( 'display_name' ) ); ?>
                </div>
                <div class="author-bio-content">
                    <h3 class="author-bio-name"><?php the_author_posts_link(); ?></h3>
                    <div class="author-bio-text"><?php the_author_meta( 'description' ); ?></div>
                    <?php if(get_the_author_meta('facebook')) : ?><a target="_blank" class="author-bio-social-link" href="http://facebook.com/<?php echo the_author_meta('facebook'); ?>"><i class="fa fa-facebook"></i></a><?php endif; ?>
                    <?php if(get_the_author_meta('twitter')) : ?><a target="_blank" class="author-bio-social-link" href="http://twitter.com/<?php echo the_author_meta('twitter'); ?>"><i class="fa fa-twitter"></i></a><?php endif; ?>
                    <?php if(get_the_author_meta('instagram')) : ?><a target="_blank" class="author-bio-social-link" href="http://instagram.com/<?php echo the_author_meta('instagram'); ?>"><i class="fa fa-instagram"></i></a><?php endif; ?>
                    <?php if(get_the_author_meta('google')) : ?><a target="_blank" class="author-bio-social-link" href="http://plus.google.com/<?php echo the_author_meta('google'); ?>?rel=author"><i class="fa fa-google-plus"></i></a><?php endif; ?>
                    <?php if(get_the_author_meta('pinterest')) : ?><a target="_blank" class="author-bio-social-link" href="http://pinterest.com/<?php echo the_author_meta('pinterest'); ?>"><i class="fa fa-pinterest"></i></a><?php endif; ?>
                    <?php if(get_the_author_meta('tumblr')) : ?><a target="_blank" class="author-bio-social-link" href="http://<?php echo the_author_meta('tumblr'); ?>.tumblr.com/"><i class="fa fa-tumblr"></i></a><?php endif; ?> 
                </div>
            </div>
            <?php } ?>
            
            <?php if ( get_theme_mod( 'enable_related_posts', '1' ) ) : ?>

                <?php global $wp_query;
                $cat_arr = array();
                foreach ( get_the_category() as $category ) {
                    array_push( $cat_arr, $category->term_id );
                }

                $temp = $wp_query;
                $wp_query = new WP_Query( array(
                    'orderby'        => 'rand',
                    'order'          => 'DESC',
                    'post_type'      => 'post',
                    'posts_per_page' => 3,
                    'post__not_in'   => array( get_the_ID() ),
                    'category__in'   => $cat_arr,
                    'post_status'    => 'publish',
                ) );

                if ( have_posts() ) : ?>

                    <div class="related-posts">
                        <h3 class="related-posts-title"><?php esc_html_e( 'You Might Also Like', 'onliestwp' ); ?></h3>
                        <div class="row">
                            <?php while ( have_posts() ) : the_post(); ?>
                                <div <?php post_class( 'related-post-item col-sm-4' ); ?>>
                                    <?php if ( has_post_thumbnail() ) : ?>
                                    <a class="related-post-thumbnail" href="<?php the_permalink(); ?>" rel="bookmark">
                                        <?php the_post_thumbnail( 'onliestwp-related-blog-thumb' ); ?>
                                    </a>
                                    <?php endif; ?>
                                    <h4 class="related-post-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h4>
                                    <span class="post-meta-item related-post-date">
                                        <?php if ( !codebean_post_has_title() ) { ?> <a href="<?php echo the_permalink(); ?>"> <?php } ?>
                                            <span><?php echo get_the_date(); ?></span>
                                        <?php if ( !codebean_post_has_title() ) { ?> </a> <?php } ?>
                                    </span>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>

                <?php endif;

                $wp_query = $temp;
                wp_reset_postdata(); ?>

            <?php endif; ?>
            
            <?php comments_template(); ?>

        </div>

        <?php get_sidebar(); ?>

    </div>
</div>

<?php get_footer(); ?>