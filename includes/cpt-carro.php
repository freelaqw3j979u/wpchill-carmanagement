<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Registers the `carro` post type.
 */
function carro_init() {
	register_post_type(
		'carro',
		[
			'labels'                => [
				'name'                  => __( 'Carros', 'wpchill-carmanagement' ),
				'singular_name'         => __( 'Carro', 'wpchill-carmanagement' ),
				'all_items'             => __( 'All Carro', 'wpchill-carmanagement' ),
				'archives'              => __( 'Carro Archives', 'wpchill-carmanagement' ),
				'attributes'            => __( 'Carro Attributes', 'wpchill-carmanagement' ),
				'insert_into_item'      => __( 'Insert into Carro', 'wpchill-carmanagement' ),
				'uploaded_to_this_item' => __( 'Uploaded to this Carro', 'wpchill-carmanagement' ),
				'featured_image'        => _x( 'Featured Image', 'carro', 'wpchill-carmanagement' ),
				'set_featured_image'    => _x( 'Set featured image', 'carro', 'wpchill-carmanagement' ),
				'remove_featured_image' => _x( 'Remove featured image', 'carro', 'wpchill-carmanagement' ),
				'use_featured_image'    => _x( 'Use as featured image', 'carro', 'wpchill-carmanagement' ),
				'filter_items_list'     => __( 'Filter Carro list', 'wpchill-carmanagement' ),
				'items_list_navigation' => __( 'Carro list navigation', 'wpchill-carmanagement' ),
				'items_list'            => __( 'Carro list', 'wpchill-carmanagement' ),
				'new_item'              => __( 'New Carro', 'wpchill-carmanagement' ),
				'add_new'               => __( 'Add New', 'wpchill-carmanagement' ),
				'add_new_item'          => __( 'Add New Carro', 'wpchill-carmanagement' ),
				'edit_item'             => __( 'Edit Carro', 'wpchill-carmanagement' ),
				'view_item'             => __( 'View Carro', 'wpchill-carmanagement' ),
				'view_items'            => __( 'View Carro', 'wpchill-carmanagement' ),
				'search_items'          => __( 'Search Carro', 'wpchill-carmanagement' ),
				'not_found'             => __( 'No Carro found', 'wpchill-carmanagement' ),
				'not_found_in_trash'    => __( 'No Carro found in trash', 'wpchill-carmanagement' ),
				'parent_item_colon'     => __( 'Parent Carro:', 'wpchill-carmanagement' ),
				'menu_name'             => __( 'Carros', 'wpchill-carmanagement' ),
			],
			'public'                => true,
			'hierarchical'          => false,
			'show_ui'               => true,
			'show_in_nav_menus'     => true,
			'supports'              => [ 'title', 'editor', 'thumbnail', 'custom-fields' ], //to block (custom-fields)
			'has_archive'           => true,
			'show_in_rest' => true,//to block
			'rewrite'               => true,
			'query_var'             => true,
			'menu_position'         => null,
			'menu_icon'             => 'dashicons-admin-post',
			'show_in_rest'          => true,
			'rest_base'             => 'carro',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
		]
	);

}

add_action( 'init', 'carro_init' );

/**
 * Sets the post updated messages for the `carro` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `carro` post type.
 */
function carro_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['carro'] = [
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Carro updated. <a target="_blank" href="%s">View Carro</a>', 'wpchill-carmanagement' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'wpchill-carmanagement' ),
		3  => __( 'Custom field deleted.', 'wpchill-carmanagement' ),
		4  => __( 'Carro updated.', 'wpchill-carmanagement' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Carro restored to revision from %s', 'wpchill-carmanagement' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false, // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Carro published. <a href="%s">View Carro</a>', 'wpchill-carmanagement' ), esc_url( $permalink ) ),
		7  => __( 'Carro saved.', 'wpchill-carmanagement' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Carro submitted. <a target="_blank" href="%s">Preview Carro</a>', 'wpchill-carmanagement' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Carro scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Carro</a>', 'wpchill-carmanagement' ), date_i18n( __( 'M j, Y @ G:i', 'wpchill-carmanagement' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Carro draft updated. <a target="_blank" href="%s">Preview Carro</a>', 'wpchill-carmanagement' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	];

	return $messages;
}

add_filter( 'post_updated_messages', 'carro_updated_messages' );

/**
 * Sets the bulk post updated messages for the `carro` post type.
 *
 * @param  array $bulk_messages Arrays of messages, each keyed by the corresponding post type. Messages are
 *                              keyed with 'updated', 'locked', 'deleted', 'trashed', and 'untrashed'.
 * @param  int[] $bulk_counts   Array of item counts for each message, used to build internationalized strings.
 * @return array Bulk messages for the `carro` post type.
 */
function carro_bulk_updated_messages( $bulk_messages, $bulk_counts ) {
	global $post;

	$bulk_messages['carro'] = [
		/* translators: %s: Number of Carro. */
		'updated'   => _n( '%s Carro updated.', '%s Carro updated.', $bulk_counts['updated'], 'wpchill-carmanagement' ),
		'locked'    => ( 1 === $bulk_counts['locked'] ) ? __( '1 Carro not updated, somebody is editing it.', 'wpchill-carmanagement' ) :
						/* translators: %s: Number of Carro. */
						_n( '%s Carro not updated, somebody is editing it.', '%s Carro not updated, somebody is editing them.', $bulk_counts['locked'], 'wpchill-carmanagement' ),
		/* translators: %s: Number of Carro. */
		'deleted'   => _n( '%s Carro permanently deleted.', '%s Carro permanently deleted.', $bulk_counts['deleted'], 'wpchill-carmanagement' ),
		/* translators: %s: Number of Carro. */
		'trashed'   => _n( '%s Carro moved to the Trash.', '%s Carro moved to the Trash.', $bulk_counts['trashed'], 'wpchill-carmanagement' ),
		/* translators: %s: Number of Carro. */
		'untrashed' => _n( '%s Carro restored from the Trash.', '%s Carro restored from the Trash.', $bulk_counts['untrashed'], 'wpchill-carmanagement' ),
	];

	return $bulk_messages;
}

add_filter( 'bulk_post_updated_messages', 'carro_bulk_updated_messages', 10, 2 );
