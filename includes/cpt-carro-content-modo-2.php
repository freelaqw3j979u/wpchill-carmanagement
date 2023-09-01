<?php 

add_filter( 'the_content', 'fix1693416443_the_content', -1 );
function fix1693416443_the_content( $content ) {
	if ( ( is_single() || is_page() ) && is_main_query() && (get_post_type()=='carro') ) {
		$content .= '<div style="height:20px"></div>';
		$content .= do_shortcode('[wpchill_carmanagement_view]');
		return $content;
	}
	return $content;
}