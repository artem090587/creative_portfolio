<?php

function codebean_data_printer( $datas ) {
	$data_str = '';
	foreach ( $datas as $key => $value ) {
		if ( ! empty( $value ) ) {
			$data_str .= " data-{$key}=\"{$value}\"";
		}
	}
	return $data_str;
}


function codebean_extract_css( $css ) {
    
    $results = array();

    preg_match_all( '/(.+?)\s?\{\s?(.+?)\s?\}/', $css, $matches );
    foreach($matches[0] as $i=>$original)
        foreach( explode( ';', $matches[2][$i] ) as $attr )
            if ( strlen( trim( $attr ) ) > 0 ) {
                // for missing semicolon on last element, which is legal
                list($name, $value) = explode(':', $attr);
                $results[$matches[1][$i]][trim($name)] = trim($value);
            }
    return $results;
}

// credit to http://frankiejarrett.com/get-an-attachment-id-by-url-in-wordpress/
function codebean_get_attachment_id_by_url( $url ) {
    
    // Split the $url into two parts with the wp-content directory as the separator.
    $parse_url  = explode( parse_url( WP_CONTENT_URL, PHP_URL_PATH ), $url );

    // Get the host of the current site and the host of the $url, ignoring www.
    $this_host = str_ireplace( 'www.', '', parse_url( home_url(), PHP_URL_HOST ) );
    $file_host = str_ireplace( 'www.', '', parse_url( $url, PHP_URL_HOST ) );

    // Return nothing if there aren't any $url parts or if the current host and $url host do not match.
    if ( ! isset( $parse_url[1] ) || empty( $parse_url[1] ) || ( $this_host != $file_host ) ) {
        return;
    }

    // Now we're going to quickly search the DB for any attachment GUID with a partial path match.
    // Example: /uploads/2013/05/test-image.jpg
    global $wpdb;

    $attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM {$wpdb->prefix}posts WHERE guid RLIKE %s;", $parse_url[1] ) );

    // Returns null if no attachment is found.
    return $attachment[0];
}