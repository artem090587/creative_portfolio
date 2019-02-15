<?php
/**
 * Fetch Variables
 */
$accent_color         = get_theme_mod( 'accent_color', '#fe504f' );

?>
/**
 * Change border color to accent color
 */
blockquote,
.btn-primary,
.btn-primary:hover,
.btn-primary:focus,
.post-item .post-meta-category a:hover {
	border-color: <?php echo esc_attr($accent_color); ?>;
}

/**
 * Change color to accent color
 */
a, 
h1 a:hover, 
h2 a:hover, 
h3 a:hover, 
h4 a:hover, 
h5 a:hover, 
h6 a:hover, 
.color-accent,
.header-menu li.current-menu-item>a,
.page-template-page-template-one-page-php .header-menu li.current-menu-item>a:hover,
.page-template-page-template-one-page-php .header-menu li.current-menu-item>a.is-active,
.page-template-page-template-one-page-php .header-menu li.current_page_parent>a:hover,
.page-template-page-template-one-page-php .header-menu li.current_page_parent>a.is-active,
.header-menu li a:hover,
.post-item .post-share .social-share-links a:hover,
.related-post-title:hover,
.btn-primary:hover,
.page-not-found .icon-404,
.widget-recent-posts li .recent-post-item .recent-post-title:hover,
.portfolio-post-navigation .nav-holder-item a:hover .nav-post-title,
.btn-link:hover,
.icon-box.style-2 .icon-box-elem,
.sidebar .widget:not(.widget_patch_recent_posts):not(.null-instagram-feed) ul li a:hover,
.header-social-menu li a:hover {
	color: <?php echo esc_attr($accent_color); ?>;
}

/**
 * Change background color to accent color
 */
.btn-primary,
.btn-primary:hover,
.btn-primary:focus,
.icon-box.style-1 .icon-box-elem i,
.wpb_patch_section_heading .section-title:after,
.post-item .post-meta-category a:hover,
.patch_progress_bar .progress-inner .progress-track,
#jpreBar,
.icon-list.accent-color .list-icon-wrapper {
	background-color: <?php echo esc_attr($accent_color); ?>;
}