<?php
/**
 * Enqueue scripts and styles
 *
 * @package _s
 */

function _s_scripts() {

	/**
	 * Main stylesheet
	 */
	wp_enqueue_style( '_s-style', get_stylesheet_uri() );


	/**
	 * Handles toggling the navigation menu for small screens and enables tab
	 * support for dropdown menus. (optional)
	 */
	wp_enqueue_script( '_s-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20120206', true );

	/**
	 * Helps with accessibility for keyboard only users.
	 */
	wp_enqueue_script( '_s-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20130115', true );

	/**
	 * jQuery
	 * (use if you are including your own copy of jQuery)
	 */
	if( !is_admin()){
		wp_deregister_script('jquery');
	}


	// Upgrade Wordpress copy of jQuery
	/*=================================
    function jquery_enqueue() {
        wp_deregister_script('jquery');
        wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js", false, null);
        wp_enqueue_script('jquery');
    }

    if ( !is_admin() ) { 
    	add_action("wp_enqueue_scripts", "jquery_enqueue", 11);
    }
    ==================================*/


	/**
	 * Main script
	 * (single compiled script file)
	 */
	wp_enqueue_script( 'main', get_template_directory_uri() . '/script.js', array(), '', true );


	/**
	 * Allows for comment threading
	 *
	 * (file only loads if user is viewing either a page or a post, if comments are open for the entry,
	 *  and if threaded comments are enabled)
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}


	/**
	 * Enable livereload for development environment only
	 *
	 * (checks the server info to see if we are on local­host to prevent the js from loading 
	 * outside of our local envi­ron­ment)
	 *
	 * http://robandlauren.com/2014/02/05/live-reload-grunt-wordpress/
	 */

	if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
	  wp_register_script('livereload', 'http://localhost:35729/livereload.js?snipver=1', null, false, true);
	  wp_enqueue_script('livereload');
	}
	
}

add_action( 'wp_enqueue_scripts', '_s_scripts' );
