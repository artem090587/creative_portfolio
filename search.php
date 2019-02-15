<?php
global $wp_query;


// Found posts
$found_posts = $wp_query->found_posts;
?>

<?php get_header(); ?>

<div id="main-wrap" class="site-content section">
    <div class="container container-main">

        <div class="main-page-content" role="main">

            <div class="search-page-top">
                <div class="row">
                    <div class="search-page-top-text col-sm-6">
                        <?php if ( have_posts() ) : ?>
                            <?php echo sprintf( _n( '%s result found for &quot;%s&quot;', '%s results found for &quot;%s&quot;', $found_posts, 'onliestwp' ), number_format_i18n( $found_posts ), get_search_query() ); ?>
                        <?php else: ?>
                            <?php echo sprintf( esc_html__( 'No search results for &quot;%s&quot;', 'onliestwp' ), get_search_query() ); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="search-main">

                <?php if ( have_posts() ) : while( have_posts() ) : the_post() ; ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'list-post post-item' ); ?>>

                        <h3 class="entry-title">
                            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                        </h3>

                        <div class="entry-link"><?php the_permalink(); ?></div>

                        <div class="entry-content"><p><?php echo codebean_string_limit_words(get_the_excerpt(), 30); ?>&hellip;</p></div>

                        <div class="entry-meta post-meta-item"><?php echo get_the_date(); ?></div>
                    </article>

                <?php endwhile; endif; ?>

            </div>

            <?php
			$prev = get_previous_posts_link( esc_html__( '&laquo; Newer Posts', 'onliestwp' ) );
			$next = get_next_posts_link( esc_html__( 'Older Posts &raquo;', 'onliestwp' ) );
            ?>
            
            <?php if ( ! empty( $prev ) || ! empty( $next ) ) : ?>
				<ul class="search-pagination pager">
					<?php if ( ! empty( $prev ) ) : ?>
						<li class="previous"><?php echo wp_kses_post($prev); ?></li>
					<?php endif; ?>

					<?php if ( ! empty( $next ) ) : ?>
						<li class="next"><?php echo wp_kses_post($next); ?></li>
					<?php endif; ?>
				</ul>
            <?php endif; ?>
            
            <?php comments_template(); ?>

        </div>

        <?php get_sidebar(); ?>

    </div>
</div>

<?php get_footer(); ?>