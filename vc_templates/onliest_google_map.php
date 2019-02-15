<?php

// Atts
if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

// Used by the Visual Composer Design options tab
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$map_id = 'map-'. rand( 0, 9999 );

$map_api_key = get_theme_mod( 'gmap_api_key', '' );

$map_style = '
   [
      {
            "featureType": "water",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#e9e9e9"
                },
                {
                    "lightness": 17
                }
            ]
       },
       {
            "featureType": "landscape",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#f5f5f5"
                },
                {
                    "lightness": 20
                }
            ]
       },
       {
            "featureType": "road.highway",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#ffffff"
                },
                {
                    "lightness": 17
                }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#ffffff"
                },
                {
                    "lightness": 29
                },
                {
                    "weight": 0.2
                }
            ]
        },
        {
            "featureType": "road.arterial",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#ffffff"
                },
                {
                    "lightness": 18
                }
            ]
        },
        {
            "featureType": "road.local",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#ffffff"
                },
                {
                    "lightness": 16
                }
            ]
        },
        {
            "featureType": "poi",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#f5f5f5"
                },
                {
                    "lightness": 21
                }
            ]
        },
        {
            "featureType": "poi.park",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#dedede"
                },
                {
                    "lightness": 21
                }
            ]
        },
        {
            "elementType": "labels.text.stroke",
            "stylers": [
                {
                    "visibility": "on"
                },
                {
                    "color": "#ffffff"
                },
                {
                    "lightness": 16
                }
            ]
        },
        {
            "elementType": "labels.text.fill",
            "stylers": [
                {
                    "saturation": 36
                },
                {
                    "color": "#333333"
                },
                {
                    "lightness": 40
                }
            ]
        },
        {
            "elementType": "labels.icon",
            "stylers": [
                {
                    "visibility": "off"
                }
            ]
        },
        {
            "featureType": "transit",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#f2f2f2"
                },
                {
                    "lightness": 19
                }
            ]
        },
        {
            "featureType": "administrative",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#fefefe"
                },
                {
                    "lightness": 20
                }
            ]
        },
        {
            "featureType": "administrative",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#fefefe"
                },
                {
                    "lightness": 17
                },
                {
                    "weight": 1.2
                }
            ]
        }
    ]';

$map_style = json_decode( $map_style );

?>
<div class="contact-map <?php echo esc_attr( $css_class ); ?>">
    <div id="<?php echo esc_attr( $map_id ); ?>" style="height:<?php echo esc_attr( $map_height );?>px;"></div>
	<?php
	$contact_map_init = '
        function initialize() {
            var myLatlng = new google.maps.LatLng(' . wp_json_encode( $map_lat ) . ',' . wp_json_encode( $map_lon ) .');
            var mapOptions = {
                zoom :' . absint( $map_zoom ) . ',
                center : myLatlng,
                scrollwheel: false,
                styles:' . wp_json_encode( $map_style, JSON_PRETTY_PRINT ) . ',
                streetViewControl : true
            };
            
            var map = new google.maps.Map(document.getElementById(' . wp_json_encode( $map_id ) . '), mapOptions);
            
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title:' . wp_json_encode( $title ) . ',
                icon:' . wp_json_encode( $map_icon ) . ',
            });
        }
    
        function loadScript() {
            var script = document.createElement("script");
            script.type = "text/javascript";
            script.src = "https://maps.googleapis.com/maps/api/js?key='. esc_attr( $map_api_key ) . '&callback=initialize";
            document.body.appendChild(script);
        }
    
        window.onload = loadScript;';

	// Add google map as inline style
	wp_add_inline_script( 'onliest-main', $contact_map_init );
	?>
</div>
