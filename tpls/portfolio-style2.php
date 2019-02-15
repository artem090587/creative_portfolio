<?php
    $vars = $wp_query->query_vars;
    $codebean_masonry = array_key_exists('codebean_masonry', $vars) ? $vars['codebean_masonry'] : false;
    $codebean_size = array_key_exists('codebean_size', $vars) ? $vars['codebean_size'] : false;
    $codebean_style = array_key_exists('codebean_style', $vars) ? $vars['codebean_style'] : false;
    $codebean_hover_style = array_key_exists('codebean_hover_style', $vars) ? $vars['codebean_hover_style'] : false;

    $id = get_the_ID();
    $image_id = get_post_thumbnail_id($id);
    $image_url = wp_get_attachment_image_src($image_id, 'full');
    $aspect_ratio = $image_id ? (($image_url[2] / $image_url[1]) * 100).'%' : '100%';
    $aspect_ratio = $codebean_masonry ? $aspect_ratio : '80%';

    $categories = get_the_term_list( $id, 'portfolio-category', '', ', ', '' );
    if ($categories !== '') {
        $categories = strip_tags($categories);
    }

    $terms = get_the_terms( $id, 'portfolio-category' );

    $cats = '';
    if (!empty($terms)) {
        foreach ($terms as $term) { $cats .= ' cdb-cat-'.strtolower($term->slug); }
    } else {
        $cats = '';
    }

    $class[] = 'masonry-item';
    $class[] = 'col-sm-6';
    $class[] = $codebean_size;
    $class[] = $codebean_hover_style;
    $class[] = $cats;
    $class[] = 'style2';

    $portfolio_link = get_field('item_linking');
    $portfolio_external_link = get_field('launch_link_href');
    $permalink = '';
    if ($portfolio_link == 'external') {
        $permalink = $portfolio_external_link;
        $class[] = 'portfolio-image-links';
    }  else {
        $permalink = get_the_permalink();
    }
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
    <div class="portfolio-item-wrapper">
        <div class="portfolio-item-thumbnail" style="<?php echo esc_attr('padding-bottom: '.$aspect_ratio.';'); ?>">
            <div class="portfolio-thumbnail-holder" style="background-image: url(<?php echo esc_url($image_url[0]); ?>);"></div>
        </div>
        <a href="<?php echo esc_url($permalink); ?>" class="portfolio-link" title="<?php the_title_attribute(); ?>"></a>
        <div class="portfolio-item-info">
            <h3 class="portfolio-item-title"><?php the_title(); ?></h3>
            <span class="portfolio-item-cat"><?php echo esc_html($categories); ?></span>
        </div>
    </div>
</article>
