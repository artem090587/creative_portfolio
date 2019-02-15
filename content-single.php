<?php
/**
 * Content Single Content Template
 */
?>

<div class="blog-page">

	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-item' ); ?>>

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="post-thumbnail">
	                    <span class="post-image-inner">
	                        <?php the_post_thumbnail( 'onliestwp-classic-blog-thumb' ); ?>
	                    </span>
					<p class="post-meta-item post-meta-category"><?php the_category( ' ' ); ?></p>
				</div>
			<?php endif; ?>

			<div class="post-content">

				<div class="post-header">
					<p class="post-meta-item post-meta-date"></p>
					<h3 class="post-title"><?php the_title(); ?></h3>
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

				<?php the_content(); ?>

				<div class="post-tags tagcloud">
					<?php the_tags( '', '', '' ); ?>
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

				<?php wp_link_pages(array(
					'before' => '<p class="page-pagination">',
					'after ' => '</p>',
					'link_before' => '',
					'link_after' => '',
					'next_or_number' => 'next',
					'nextpagelink' => '<span class="next">' . esc_html__( 'Next Page &raquo;', 'onliestwp' ) . '</span>',
					'previouspagelink' => '<span class="prev">' . esc_html__( '&laquo; Previous Page', 'onliestwp' ) . '</span>',
				)); ?>

			</div>

		</article>


	<?php endwhile; ?>

</div>