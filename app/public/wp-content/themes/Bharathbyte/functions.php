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
		'1.0.5'
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
		'1.0.2',
		true
	);
}
add_action( 'wp_enqueue_scripts', 'bharathbyte_enqueue_assets', 99 );
