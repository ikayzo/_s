<?php
/**
 * Custom functions that act independently of the theme templates
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

  // Adds a class of hfeed to non-singular pages.
  if ( ! is_singular() ) {
    $classes[] = 'hfeed';
  }

  return $classes;
}

add_filter( 'body_class', '_s_body_classes' );


/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function _s_pingback_header() {
  if ( is_singular() && pings_open() ) {
    echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
  }
}

add_action( 'wp_head', '_s_pingback_header' );


/**
 * Adds SVG file support when uploading to media library
 */
function cc_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );


/**
 * Remove theme updates
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



/**
 * Customize the post excerpt
 */
// function custom_excerpt_length( $length ) {
//   return 30;
// }
//
// function new_excerpt_more( $more ) {
//   return '...';
// }
//
// add_filter('excerpt_more', 'new_excerpt_more');
// add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
