<?php
/**
 * Admin / Site optimizations
 *
 * @package _s
 */


/* ==========================================================================
Admin
========================================================================== */

/**
* Remove unecessary dashboard widgets
*/
function remove_dashboard_meta() {
        remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
}

add_action( 'admin_init', 'remove_dashboard_meta' );
remove_action('welcome_panel', 'wp_welcome_panel');



/**
* Admin bar
* (removes admin bar links)
*/
function remove_admin_bar_links() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');          // Remove the WordPress logo
    $wp_admin_bar->remove_menu('about');            // Remove the about WordPress link
    $wp_admin_bar->remove_menu('wporg');            // Remove the WordPress.org link
    $wp_admin_bar->remove_menu('documentation');    // Remove the WordPress documentation link
    $wp_admin_bar->remove_menu('support-forums');   // Remove the support forums link
    $wp_admin_bar->remove_menu('feedback');         // Remove the feedback link
    $wp_admin_bar->remove_menu('updates');          // Remove the updates link
    $wp_admin_bar->remove_menu('comments');         // Remove the comments link
    $wp_admin_bar->remove_menu('new-content');      // Remove the content link
}

add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );


/**
 * Hide unecessary widgets (Appearance -> Widgets)
 */
function unregister_default_wp_widgets() {
    unregister_widget('WP_Widget_Pages');
    unregister_widget('WP_Widget_Calendar');
    unregister_widget('WP_Widget_Archives');
    unregister_widget('WP_Widget_Links');
    unregister_widget('WP_Widget_Meta');
    unregister_widget('WP_Widget_Search');
    unregister_widget('WP_Widget_Text');
    unregister_widget('WP_Widget_Categories');
    unregister_widget('WP_Widget_Recent_Posts');
    unregister_widget('WP_Widget_Recent_Comments');
    unregister_widget('WP_Widget_RSS');
    unregister_widget('WP_Widget_Tag_Cloud');
    unregister_widget('WP_Nav_Menu_Widget');
}

add_action('widgets_init', 'unregister_default_wp_widgets', 1);



/**
 * Disable help dropdown
 */
function disable_help_dropdown($old_help, $screen_id, $screen){
    $screen->remove_help_tabs();
    return $old_help;
}

add_filter( 'contextual_help', 'disable_help_dropdown', 999, 3 );



/**
 * Remove 'Appearance' submenu items (optional)
 */
function hide_menu_items() {
    remove_submenu_page('plugins.php','plugin-editor.php'); // plugin editor
    remove_submenu_page( 'themes.php', 'theme-editor.php' ); // theme editor
}

function remove_appearance_menus () {
    global $submenu;
    unset($submenu['themes.php'][6]); // Customize
    unset($submenu['themes.php'][20]); // Background
}

// uncomment below to initialize

// add_action('admin_init','hide_menu_items');
// add_action('admin_menu', 'remove_appearance_menus');



/**
 * Remove user color scheme picker
 * (use if you are utilizing the admin stylesheet)
 */
if ( ! function_exists( 'remove_personal_options' ) ) {
  function remove_personal_options( $subject ) {
    $subject = preg_replace( '#<h3>'.__('Personal Options').'</h3>.+?/table>#s', '', $subject, 1 );
    return $subject;
  }

  function profile_subject_start() {
    ob_start( 'remove_personal_options' );
  }

  function profile_subject_end() {
    ob_end_flush();
  }
}

remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );
add_action( 'admin_head', 'profile_subject_start' );
add_action( 'admin_footer', 'profile_subject_end' );



/* ==========================================================================
Site
========================================================================== */

/**
 * Remove query strings from static resources
 */
function _remove_query_strings( $src ){
	$rqs = explode( '?ver', $src );
    return $rqs[0];
}

if ( !is_admin() ) {
    add_filter( 'script_loader_src', '_remove_query_strings', 15, 1 );
    add_filter( 'style_loader_src', '_remove_query_strings', 15, 1 );
}
