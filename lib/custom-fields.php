<?php
/**
 * Custom fields (ACF)
 *
 * @package _s
 */


/**
 * Download a copy of the Advanced Custom Fields plugin here:
 * https://downloads.wordpress.org/plugin/advanced-custom-fields.4.4.4.zip
 *
 * Copy the entire plugin directory into the 'lib' folder
 *
 * Uncomment functions below
 */

/* ========================================================== */

// Set path to plugin files
$acf_theme_path = '/lib/advanced-custom-fields/';

function my_acf_settings_path(){
  global $acf_theme_path;
  $path = get_stylesheet_directory() . $acf_theme_path;
  return $path;
}

function my_acf_settings_dir(){
  global $acf_theme_path;
  $dir = get_stylesheet_directory_uri() . $acf_theme_path;
  return $dir;
}

add_filter('acf/settings/path', 'my_acf_settings_path');
add_filter('acf/settings/dir', 'my_acf_settings_dir');


// Hide ACF field group menu item
// define( 'ACF_LITE', true );
// add_filter('acf/settings/show_admin', '__return_false'); // Pro version


// Include ACF
include_once( my_acf_settings_path() . 'acf.php' );

/* ========================================================== */



/**
 * Paste export of custom fields here
 */
