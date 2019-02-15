<?php


// Global Data


// Thumbnail
$has_thumbnail                  = has_post_thumbnail();
$post_id						= get_the_id();
$post_thumbnail_id              = get_post_thumbnail_id();

// Portfolio Details
$sub_title                      = get_field( 'sub_title' );

$checklists                     = get_field( 'checklists' );

$launch_link_title              = get_field( 'launch_link_title' );
$launch_link_href               = get_field( 'launch_link_href' );
$new_window                     = get_field( 'new_window' );

// Description
$description_alignment          = get_field( 'item_description_alignment' );
$sticky_description             = get_field( 'sticky_description' );

// Gallery
$gallery_items                  = get_field( 'gallery' );

// Portfolio Style 2
$show_featured_image            = get_field( 'show_featured_image' );


if ( ! is_array( $gallery_items ) ) {
    $gallery_items = array();
}

if ( ! is_array( $checklists ) ) {
    $checklists = array();
}
