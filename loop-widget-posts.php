<?php if ( have_posts() ) : ?>
    <ul class="widget-recent-posts">
        <?php while( have_posts() ) : the_post(); ?>
            <li <?php echo post_class( 'widget-post' ); ?>>
                <div class="recent-post-item">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="recent-post-thumbnail">
                            <a href="<?php esc_url( the_permalink() ); ?>">
                                <?php the_post_thumbnail( 'onliestwp-recent-blog-thumb' ); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="recent-post-content">
                        <a href="<?php the_permalink(); ?>" class="recent-post-title"><?php the_title(); ?></a>
                        <?php if ( $show_date ) : ?>
                            <small class="recent-post-date"><?php echo get_the_date(); ?></small>
                        <?php endif; ?>
                    </div>
                </div>
            </li>
        <?php endwhile; ?>
    </ul>
<?php endif; ?>