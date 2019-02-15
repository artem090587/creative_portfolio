<?php

/*
 * Template Name: One Page
 * Description: Create the famous One Page site with binding scrolling navigation
 */

?>

<?php get_header(); ?>

<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>

	<?php $is_using_vc = get_post_meta( get_the_ID(), '_wpb_vc_js_status', true ); ?>

	<?php if ( $is_using_vc === 'true' ) : ?>

		<div id="main-wrap" <?php post_class( 'visual-composer-page' ); ?>>

			<div class="section-anchor" data-anchor="remove" data-section="#header"></div>

			<div class="container">
				<?php the_content(); ?>
			</div>

		</div>

	<?php else : ?>

		<div id="main-wrap" class="site-content section">
			<div class="container">

				<div class="main" role="main">
					
					<div class="page-loop">

						<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
							<?php the_content(); ?>
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