<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'parse_request', 'fix1693444234_parse_request');
function fix1693444234_parse_request( &$wp ) {
	if($wp->request == 'export-cpt-carro-to-json'){
		if(!current_user_can('administrator')) die('--somente admins--');
		fix1693444234();
		exit;
	}
}

function fix1693444234(){

	$sql = "
	SELECT 
	    p.post_title,
	    p.post_content,
	    m02.meta_value as fix1693416443_model,
	    m03.meta_value as fix1693416443_fuel,
	    m04.meta_value as fix1693416443_price,
	    m05.meta_value as fix1693416443_color,
	    m06.meta_value as fix1693416443_key,
		t08.name as fabricante
	    
	FROM ".$GLOBALS['wpdb']->prefix."posts p
	    left join ".$GLOBALS['wpdb']->prefix."postmeta m02 on m02.post_id = p.ID and m02.meta_key = 'fix1693416443_model'
	    left join ".$GLOBALS['wpdb']->prefix."postmeta m03 on m03.post_id = p.ID and m03.meta_key = 'fix1693416443_fuel'
	    left join ".$GLOBALS['wpdb']->prefix."postmeta m04 on m04.post_id = p.ID and m04.meta_key = 'fix1693416443_price'
	    left join ".$GLOBALS['wpdb']->prefix."postmeta m05 on m05.post_id = p.ID and m05.meta_key = 'fix1693416443_color'
	    left join ".$GLOBALS['wpdb']->prefix."postmeta m06 on m06.post_id = p.ID and m06.meta_key = 'fix1693416443_key'
	    left join ".$GLOBALS['wpdb']->prefix."term_relationships t06 on t06.object_id = p.ID 
	    left join ".$GLOBALS['wpdb']->prefix."term_taxonomy t07 on t07.term_id = t06.term_taxonomy_id
	    left join ".$GLOBALS['wpdb']->prefix."terms t08 on t08.term_id = t07.term_id
	where 
	    p.post_status = 'publish' 
	    and p.post_type = 'carro' 
	";

	$rows = $GLOBALS['wpdb']->get_results($sql, 'ARRAY_A');

	echo "<pre>";
	echo json_encode($rows, JSON_PRETTY_PRINT);
	echo "</pre>";

}