<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

#cpt-carro-027-shortcode-show-thumbs.php


add_shortcode("wpchill_show_thumbs", "wpchill_show_thumbs");
function wpchill_show_thumbs($atts, $content = null){
	global $post;
	// print_r($post);
	
	$featured_img_url = get_the_post_thumbnail_url($post->ID, 'full'); 
	ob_start();
	?>
	<img src="<?php echo $featured_img_url ?>">
	<?php
	
	return ob_get_clean();
}
