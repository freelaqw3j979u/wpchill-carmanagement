<?php

/**
 * Registers the `fabricante` taxonomy,
 * for use with 'carro'.
 */
function fabricante_init() {
	register_taxonomy( 'fabricante', [ 'carro' ], [
		'hierarchical'          => true,
		'public'                => true,
		'show_in_nav_menus'     => true,
		'show_ui'               => true,
		'show_admin_column'     => false,
		'query_var'             => true,
		'rewrite'               => true,
		'capabilities'          => [
			'manage_terms' => 'edit_posts',
			'edit_terms'   => 'edit_posts',
			'delete_terms' => 'edit_posts',
			'assign_terms' => 'edit_posts',
		],
		'labels'                => [
			'name'                       => __( 'Fabricantes', 'wpchill-carmanagement' ),
			'singular_name'              => _x( 'Fabricante', 'taxonomy general name', 'wpchill-carmanagement' ),
			'search_items'               => __( 'Search Fabricantes', 'wpchill-carmanagement' ),
			'popular_items'              => __( 'Popular Fabricantes', 'wpchill-carmanagement' ),
			'all_items'                  => __( 'All Fabricantes', 'wpchill-carmanagement' ),
			'parent_item'                => __( 'Parent Fabricante', 'wpchill-carmanagement' ),
			'parent_item_colon'          => __( 'Parent Fabricante:', 'wpchill-carmanagement' ),
			'edit_item'                  => __( 'Edit Fabricante', 'wpchill-carmanagement' ),
			'update_item'                => __( 'Update Fabricante', 'wpchill-carmanagement' ),
			'view_item'                  => __( 'View Fabricante', 'wpchill-carmanagement' ),
			'add_new_item'               => __( 'Add New Fabricante', 'wpchill-carmanagement' ),
			'new_item_name'              => __( 'New Fabricante', 'wpchill-carmanagement' ),
			'separate_items_with_commas' => __( 'Separate fabricantes with commas', 'wpchill-carmanagement' ),
			'add_or_remove_items'        => __( 'Add or remove fabricantes', 'wpchill-carmanagement' ),
			'choose_from_most_used'      => __( 'Choose from the most used fabricantes', 'wpchill-carmanagement' ),
			'not_found'                  => __( 'No fabricantes found.', 'wpchill-carmanagement' ),
			'no_terms'                   => __( 'No fabricantes', 'wpchill-carmanagement' ),
			'menu_name'                  => __( 'Fabricantes', 'wpchill-carmanagement' ),
			'items_list_navigation'      => __( 'Fabricantes list navigation', 'wpchill-carmanagement' ),
			'items_list'                 => __( 'Fabricantes list', 'wpchill-carmanagement' ),
			'most_used'                  => _x( 'Most Used', 'fabricante', 'wpchill-carmanagement' ),
			'back_to_items'              => __( '&larr; Back to Fabricantes', 'wpchill-carmanagement' ),
		],
		'show_in_rest'          => true,
		'rest_base'             => 'fabricante',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	] );

}

add_action( 'init', 'fabricante_init' );

/**
 * Sets the post updated messages for the `fabricante` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `fabricante` taxonomy.
 */
function fabricante_updated_messages( $messages ) {

	$messages['fabricante'] = [
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Fabricante added.', 'wpchill-carmanagement' ),
		2 => __( 'Fabricante deleted.', 'wpchill-carmanagement' ),
		3 => __( 'Fabricante updated.', 'wpchill-carmanagement' ),
		4 => __( 'Fabricante not added.', 'wpchill-carmanagement' ),
		5 => __( 'Fabricante not updated.', 'wpchill-carmanagement' ),
		6 => __( 'Fabricantes deleted.', 'wpchill-carmanagement' ),
	];

	return $messages;
}

add_filter( 'term_updated_messages', 'fabricante_updated_messages' );
