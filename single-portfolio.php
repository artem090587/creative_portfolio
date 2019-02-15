<?php get_header(); ?>

<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
    <?php if ( post_password_required() ) { get_template_part( 'inc/templates/portfolio-password-protected' ); } else { ?>

        <?php
            $id = get_the_ID();

            $portfolio_type = get_field('portfolio_type');
        ?>

        <?php get_template_part( 'tpls/portfolio-'.$portfolio_type); ?>

        <div class="portfolio-navigation">
            <?php codebean_content_nav( 'single-portfolio-nav' ); ?>
        </div>

    <?php } ?>
<?php endwhile; else : endif; ?>

<?php get_footer(); ?>