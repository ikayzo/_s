<?php
/**
 * Custom white label functions
 *
 * @package _s
 */


/**
 * Admin
 * (enqueue custom stylesheet for Wordpress admin)
 */
function load_custom_wp_admin_style() {
    wp_register_style( 'custom_wp_admin_css', get_template_directory_uri() . '/admin.css', false, '1.0.0' );
    wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );



/**
* Login page
*
*  1. Change logo link title
*  2. Change logo link url
*  3. Enqueue custom stylesheet for login page
*/
function custom_login_logo_url( $url ) {
    return home_url();
}
add_filter( 'login_headerurl', 'custom_login_logo_url' );


function custom_login_logo_title( $title ) {
    return esc_attr( get_bloginfo( 'name' ) );
}
add_filter( 'login_headertitle', 'custom_login_logo_title' );


function load_custom_wp_login_style() {
    wp_register_style( 'custom_wp_login_css', get_template_directory_uri() . '/login.css', false, '1.0.0' );
    wp_enqueue_style( 'custom_wp_login_css' );
}
add_action( 'login_enqueue_scripts', 'load_custom_wp_login_style' );



/**
 * Custom admin welcome
 */
function custom_howdy( $text ) {
    $greeting = 'Aloha';
    if ( is_admin() ) {
        $text = str_replace( 'Howdy', $greeting, $text );
    }
    return $text;
}

add_filter( 'gettext', 'custom_howdy' );



/**
 * Admin - Footer
 *
 *  1. Removed Wordpress version
 *  2. Replace footer text
 */

function admin_footer() {
    remove_filter( 'update_footer', 'core_update_footer' );
}

function replace_footer_text () {
    echo '<span id="footer-thankyou">Developed by <a href="http://www.ikayzo.com/" target="_blank">Ikayzo</a></span>';
}

add_action( 'admin_menu', 'admin_footer' );
add_filter('admin_footer_text', 'replace_footer_text');
