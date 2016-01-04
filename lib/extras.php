<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package _s
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function _s_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', '_s_body_classes' );


/**
 * Adds SVG file support when uploading to media library
 */
function cc_mime_types( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );


/**
 * Remove updates
 */
remove_action( 'load-update-core.php', 'wp_update_themes' );
add_filter( 'pre_site_transient_update_themes', create_function( '$a', "return null;" ) );


/**
 * Selects Custom Post Type Templates for single and archive pages
 */
add_filter('template_include', 'custom_template_include');

function custom_template_include($template) {
	$custom_template_location = get_stylesheet_directory() . '/templates/single/';

	 if ( get_post_type () ) {

		if ( is_archive() ) :
		   if(file_exists($custom_template_location . 'archive-' . get_post_type() . '.php'))
			  return $custom_template_location . 'archive-' . get_post_type() . '.php';
		endif;

		if ( is_single() ) :
		   if(file_exists($custom_template_location . 'single-' . get_post_type() . '.php'))
			  return $custom_template_location . 'single-' . get_post_type() . '.php';
		endif;

	}

	return $template;
}