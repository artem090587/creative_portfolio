<?php 

global $wp_query, $page;

# Meta Information about WP Posts Query
$pagination_position    = '';

$max_num_pages          = $wp_query->max_num_pages;
$paged                  = get_query_var('paged');

if($page > $paged)
    $paged = $page;


if($max_num_pages > 1):
    $_from               = 1;
	$_to                 = $max_num_pages;
	$current_page        = $paged ? $paged : 1;
	$numbers_to_show     = 5;
	$pagination_position = strtolower($pagination_position);

	list($from, $to) = codebean_generate_from_to($_from, $_to, $current_page, $max_num_pages, $numbers_to_show);
endif;

?>
<div class="blog-page">

    <?php
    if(have_posts()):

        while(have_posts()):

            the_post();

            ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-item' ); ?>>

            <?php if ( has_post_thumbnail() ) : ?>
                <div class="post-thumbnail">
                    <span class="post-image-inner">
                        <a href="<?php the_permalink(); ?>" rel="bookmark">
                            <?php the_post_thumbnail( 'onliestwp-classic-blog-thumb' ); ?>
                        </a>
                    </span>
                    <p class="post-meta-item post-meta-category"><?php the_category( ' ' ); ?></p>
                </div>
            <?php endif; ?>

            <div class="post-content">
                <div class="post-header">
                    <p class="post-meta-item post-meta-date"></p>
                    <h3 class="post-title">
                        <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                    </h3>
                    <ul class="post-meta-list">
                        
                        <li class="post-meta-item post-author-avatar">
                            <span><?php echo esc_html__('Posted by', 'onliestwp'); ?></span>
                            <?php echo get_avatar( get_the_author_meta( 'ID' ), 80, '', get_the_author_meta( 'display_name' ) ); ?>
                        </li>
                        <li class="post-meta-item post-meta-author">
                            <?php the_author_posts_link(); ?>
                        </li>
                        <li class="post-meta-item post-meta-comments">
                            <a href="<?php comments_link(); ?>">
                                <span class="ti-comment">
                                    <span class="comment-number"><?php comments_number( esc_html__('0', 'onliestwp'), esc_html__('1 ', 'onliestwp'), esc_html__('%', 'onliestwp') ); ?></span>
                                </span>
                            </a>
                        </li>
                        <li class="post-meta-item post-meta-date">
                            <?php if ( !codebean_post_has_title() ) { ?> <a href="<?php echo the_permalink(); ?>"> <?php } ?>
                                <span><?php echo get_the_date(); ?></span>
                            <?php if ( !codebean_post_has_title() ) { ?> </a> <?php } ?>
                        </li>
                    </ul>
                </div>

	            <?php the_excerpt(); ?>

                <div class="read-more text-center">
                    <a class="btn btn-bordered" href="<?php echo the_permalink(); ?>"><?php esc_html_e( 'Continue Reading', 'onliestwp' ); ?></a>
                </div>

            </div>

            <?php if ( get_theme_mod( 'enable_social_share' ) ) : ?>
                <div class="post-share">
                    <div class="social-share-links">
                        <span>Share:</span>
                        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="fa fa-facebook"></i></a>
                        <a target="_blank" href="https://twitter.com/home?status=Check%20out%20this%20article:%20<?php the_title(); ?>%20-%20<?php the_permalink(); ?>"><i class="fa fa-twitter"></i></a>
                        <?php $pin_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?>
                        <a data-pin-do="skipLink" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo esc_url($pin_image); ?>&description=<?php the_title(); ?>"><i class="fa fa-pinterest"></i></a>
                        <a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="fa fa-google-plus"></i></a> 
                    </div>
                </div>
            <?php endif; ?>

        </article>
        <?php

        endwhile;

            if($max_num_pages > 1):
            
                codebean_show_pagination($current_page, $max_num_pages, $from, $to, $pagination_position);
            
            endif;
        ?>
    <?php endif; ?>
</div>