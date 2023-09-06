<?php 

add_filter( 'the_content', 'fix1693416443_the_content', -1 );
function fix1693416443_the_content( $content ) {
	if ( ( is_single() || is_page() ) && is_main_query() && (get_post_type()=='carro') ) {
		$content .= '<div style="height:20px"></div>';
		// $content .= do_shortcode('[wpchill_carmanagement_view]');
		// $content .= do_shortcode('[wpchill_show_thumbs]');

		ob_start();
		?>
			<style type="text/css">
				#fix1693964034 {
					display: grid;
					grid-template-columns: 1fr 1fr;
				}
			</style>
			<div id="fix1693964034">
				<div><?php echo do_shortcode('[wpchill_carmanagement_view]') ?></div>
				<div><?php echo do_shortcode('[wpchill_show_thumbs]') ?></div>
			</div>
		teste


		<?php
		$content .=  ob_get_clean();
		return $content;
	}
	return $content;
}