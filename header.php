<!doctype html>
<html <?php language_attributes(); ?> class="">

    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>


        <?php
        $slider_alias = get_post_meta( get_the_ID(), 'rev_slider', true);
        $show_slider = get_post_meta( get_the_ID(), 'show_rev_slider', true);
        if ( ! empty( $slider_alias && $show_slider == '1' ) ) { ?>
        <div id="home-banner" class="row row-full-width no-padding">
            <div class="banner-wrapper">
                <?php echo do_shortcode( sprintf( '[rev_slider alias="%s"]', $slider_alias) ); ?>
            </div>
        </div>
        <?php } ?>

        <div class="page-wrap" id="wrapper">

            <header class="mobile-header mobile-fixed-header">
                <div class="top-part">
                    <div class="logo">
                        <?php if ( get_theme_mod( 'header_logo' ) ) : ?>
                            <a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo('name') ); ?>" rel="home" class="site-logo">
                                <img src="<?php echo esc_url( get_theme_mod( 'header_logo' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>">
                            </a>
                        <?php else : ?>
                            <a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo('name') ); ?>" rel="home" class="site-logo">
                                <span><?php bloginfo( 'name' ); ?></span>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="mobile-toggle">
                        <a href="#" class="mobile-toggle-icon">
                            <span></span>
                        </a>
                    </div>
                </div>
                <?php wp_nav_menu( array(
                    'theme_location'    => 'header-navigation',
                    'depth'             => 0,
                    'container'         => false,
                    'menu_class'        => 'mobile-menu',
                    'fallback_cb'       => 'codebean_Nav_Walker::fallback',
                    'walker'            => new codebean_Nav_Walker(),
                ) ); ?>
            </header>

            <header id="header" class="header-site header-fixed">

                <div class="container-fluid">
                    
                    <div class="header-site-inner clearfix">

                        <div class="header-logo-holder">
                            <?php if ( get_theme_mod( 'header_logo' ) ) : ?>
                                <a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo('name') ); ?>" rel="home" class="site-logo">
                                    <img src="<?php echo esc_url( get_theme_mod( 'header_logo' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>">
                                </a>
                            <?php else : ?>
                                <a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo('name') ); ?>" rel="home" class="site-logo">
                                    <span><?php bloginfo( 'name' ); ?></span>
                                </a>
                            <?php endif; ?>
                        </div>

                        <div class="header-main-menu">
                            <?php wp_nav_menu( array(
                                'theme_location'    => 'header-navigation',
                                'depth'             => 0,
                                'container'         => false,
                                'menu_class'        => 'js-superfish sf-menu header-menu',
                                'fallback_cb'       => 'codebean_Nav_Walker::fallback',
                                'walker'            => new codebean_Nav_Walker(),
                            ) ); ?>
                        </div>

                        <?php $social_networks = get_theme_mod( 'social_networks', array() ); ?>
                        <?php if ( ! empty( $social_networks ) ) : ?>
                        <div class="header-right">
                            <div class="social-menu-container">
                                <ul class="header-social-menu">
                                    <?php foreach ( $social_networks as $social_network ) : ?>
                                        <li>
                                            <a href="<?php echo esc_url_raw( $social_network['url'] ); ?>" target="_blank">
                                                <i class="fa fa-<?php echo esc_attr( $social_network['network'] ); ?>"></i>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <?php endif; ?>

                    </div>

                </div>

            </header>

            <?php get_template_part('tpls/page-title'); ?>

