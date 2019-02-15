<?php

    $hide_page_title = '';

    if ( get_post_meta( get_the_ID(), 'hide_page_title', true) ) {
        $hide_page_title = get_post_meta( get_the_ID(), 'hide_page_title', true );
    }

    if ( isset($hide_page_title) && ($hide_page_title !== '' ) ) {
        codebean_print_page_title();
    }

?>