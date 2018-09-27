<?php

////////////////////////////////////////////////////////////////////
//ADD URL SHORTCODES
////////////////////////////////////////////////////////////////////

add_shortcode( 'blogurl', 'add_url_shortcode' );
function add_url_shortcode( $atts ) {

return home_url() . '/';

}
add_action( 'init', 'add_url_shortcode');



add_shortcode( 'childtemplateurl', 'add_childtemplateurl_shortcode' );

function add_childtemplateurl_shortcode( $atts ) {

return get_stylesheet_directory_uri() . '/';
}
add_action( 'init', 'add_childtemplateurl_shortcode');


add_shortcode( 'blogurl_uploads', 'add_uploads_shortcode' );

function add_uploads_shortcode( $atts ) {

return home_url() . '/' . 'wp-content' . '/' . 'uploads' . '/';
}
add_action( 'init', 'add_uploads_shortcode');

?>
