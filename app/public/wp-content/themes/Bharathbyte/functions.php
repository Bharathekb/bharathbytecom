<?php
/**
 * Bharathbyte theme setup.
 *
 * @package Bharathbyte
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function bharathbyte_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'bharathbyte' ),
			'footer'  => __( 'Footer Menu', 'bharathbyte' ),
			'social'  => __( 'Social Menu', 'bharathbyte' ),
		)
	);
}
add_action( 'after_setup_theme', 'bharathbyte_setup' );

function bharathbyte_enqueue_assets() {
	wp_enqueue_style(
		'bharathbyte-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'bharathbyte-bootstrap',
		get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css',
		array(),
		'5.3.7'
	);

	wp_enqueue_style(
		'bharathbyte-style',
		get_stylesheet_directory_uri() . '/assets/css/bharathbyte.css',
		array( 'bharathbyte-bootstrap', 'bharathbyte-fonts' ),
		'1.0.7'
	);

	wp_enqueue_script(
		'bharathbyte-bootstrap',
		get_stylesheet_directory_uri() . '/assets/js/bootstrap.bundle.min.js',
		array(),
		'5.3.7',
		true
	);

	wp_enqueue_script(
		'bharathbyte-script',
		get_stylesheet_directory_uri() . '/assets/js/bharathbyte.js',
		array(),
		'1.0.3',
		true
	);
}
add_action( 'wp_enqueue_scripts', 'bharathbyte_enqueue_assets', 99 );

function bharathbyte_remove_footer_newsletter_item( $items, $args ) {
	if ( empty( $args->theme_location ) || 'footer' !== $args->theme_location ) {
		return $items;
	}

	return array_values(
		array_filter(
			$items,
			function ( $item ) {
				return 'newsletter' !== strtolower( trim( wp_strip_all_tags( $item->title ) ) );
			}
		)
	);
}
add_filter( 'wp_nav_menu_objects', 'bharathbyte_remove_footer_newsletter_item', 10, 2 );

function bharathbyte_formspree_endpoint( $endpoint ) {
	if ( defined( 'BHARATHBYTE_FORMSPREE_ENDPOINT' ) && BHARATHBYTE_FORMSPREE_ENDPOINT ) {
		return BHARATHBYTE_FORMSPREE_ENDPOINT;
	}

	return $endpoint;
}
add_filter( 'bharathbyte_formspree_endpoint', 'bharathbyte_formspree_endpoint' );

function bharathbyte_is_contact_request() {
	$request_path = isset( $_SERVER['REQUEST_URI'] ) ? wp_parse_url( wp_unslash( $_SERVER['REQUEST_URI'] ), PHP_URL_PATH ) : '';
	$contact_path = wp_parse_url( home_url( '/contact/' ), PHP_URL_PATH );

	return untrailingslashit( $request_path ) === untrailingslashit( $contact_path );
}

function bharathbyte_contact_document_title( $title ) {
	if ( ! bharathbyte_is_contact_request() ) {
		return $title;
	}

	return sprintf(
		/* translators: %s: site name. */
		__( 'Contact - %s', 'bharathbyte' ),
		get_bloginfo( 'name' )
	);
}
add_filter( 'pre_get_document_title', 'bharathbyte_contact_document_title' );
add_filter( 'rank_math/frontend/title', 'bharathbyte_contact_document_title' );

function bharathbyte_contact_shortlink( $shortlink ) {
	if ( ! bharathbyte_is_contact_request() ) {
		return $shortlink;
	}

	return home_url( '/contact/' );
}
add_filter( 'pre_get_shortlink', 'bharathbyte_contact_shortlink' );

function bharathbyte_render_contact_route() {
	if ( ! bharathbyte_is_contact_request() ) {
		return;
	}

	global $wp_query;

	if ( $wp_query instanceof WP_Query ) {
		$contact_post = new WP_Post(
			(object) array(
				'ID'                    => -1,
				'post_author'           => 1,
				'post_date'             => current_time( 'mysql' ),
				'post_date_gmt'         => current_time( 'mysql', 1 ),
				'post_content'          => '',
				'post_title'            => __( 'Contact', 'bharathbyte' ),
				'post_excerpt'          => '',
				'post_status'           => 'publish',
				'comment_status'        => 'closed',
				'ping_status'           => 'closed',
				'post_password'         => '',
				'post_name'             => 'contact',
				'to_ping'               => '',
				'pinged'                => '',
				'post_modified'         => current_time( 'mysql' ),
				'post_modified_gmt'     => current_time( 'mysql', 1 ),
				'post_content_filtered' => '',
				'post_parent'           => 0,
				'guid'                  => home_url( '/contact/' ),
				'menu_order'            => 0,
				'post_type'             => 'page',
				'post_mime_type'        => '',
				'comment_count'         => 0,
				'filter'                => 'raw',
			)
		);

		$GLOBALS['post']                = $contact_post;
		$wp_query->post                = $contact_post;
		$wp_query->posts               = array( $contact_post );
		$wp_query->post_count          = 1;
		$wp_query->queried_object      = $contact_post;
		$wp_query->queried_object_id   = -1;
		$wp_query->is_404              = false;
		$wp_query->is_page             = true;
		$wp_query->is_singular         = true;
		$wp_query->is_home             = false;
		$wp_query->is_archive          = false;
	}

	status_header( 200 );
	include get_stylesheet_directory() . '/page-contact.php';
	exit;
}
add_action( 'template_redirect', 'bharathbyte_render_contact_route' );
