<?php
/**
 * Custom Woocommerce functions
 *
 * @package _s
 */


/**
 * Declare WooCommerce support in third party theme
 * https://docs.woothemes.com/document/declare-woocommerce-support-in-third-party-theme/
 */
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'woocommerce_support' );



/**
 * Disable the default stylesheet
 * https://docs.woothemes.com/document/disable-the-default-stylesheet/
 */
function woocommerce_dequeue_styles( $enqueue_styles ) {

	// Remove the gloss
	unset( $enqueue_styles['woocommerce-general'] );

	// Remove the layout
	// unset( $enqueue_styles['woocommerce-layout'] );

	// Remove the smallscreen optimisation
	// unset( $enqueue_styles['woocommerce-smallscreen'] );
	
	return $enqueue_styles;
}

add_filter( 'woocommerce_enqueue_styles', 'woocommerce_dequeue_styles' );



/**
 * Hides the "Install the WooThemes Updater plugin..." message
 * https://wordpress.org/support/topic/hiding-install-the-woothemes-updater-plugin-alert-on-dashboard#post-4178154
 */
remove_action( 'admin_notices', 'woothemes_updater_notice' );

