<?php

add_filter( 'template_include', 'fix1693416443_template' );
function fix1693416443_template( $original_template ) {
    // global $plugin_file;
    // global $fix1693416443cpt;
    $post_type = get_post_type();
    if($post_type=='carro') {
        if( is_single() ) {
			return plugin_dir_path( __FILE__ )."cpt-carro-044-template-single.php";
        }
        if (is_archive()) {
			return plugin_dir_path( __FILE__ )."cpt-carro-043-template-archive.php";
        }
    }
    return $original_template;
}
