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
  // unregister_widget('WP_Widget_Text');
  unregister_widget('WP_Widget_Categories');
  unregister_widget('WP_Widget_Recent_Posts');
  unregister_widget('WP_Widget_Recent_Comments');
  unregister_widget('WP_Widget_RSS');
  unregister_widget('WP_Widget_Tag_Cloud');
  unregister_widget('WP_Nav_Menu_Widget');
}

add_action('widgets_init', 'unregister_default_wp_widgets', 1);



/**
 * Hide meta boxes on page edit screen
 */
function remove_page_meta_boxes() {
  remove_meta_box('postcustom', 'page', 'normal');
}

add_action( 'admin_menu' , 'remove_page_meta_boxes' );



/**
 * Hide meta boxes on post edit screen
 */
function remove_post_meta_boxes() {
  remove_meta_box( 'postcustom' , 'post' , 'normal' );
}

add_action( 'admin_menu' , 'remove_post_meta_boxes' );



/**
 * Disable help dropdown
 */
function disable_help_dropdown($old_help, $screen_id, $screen){
  $screen->remove_help_tabs();
  return $old_help;
}

add_filter( 'contextual_help', 'disable_help_dropdown', 999, 3 );



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



/**
 * Remove menu items
 */
function hide_menu_items() {
  remove_menu_page('edit-comments.php'); // comments
  remove_submenu_page( 'themes.php', 'theme-editor.php' ); // theme editor
}

add_action('admin_init','hide_menu_items');


function remove_appearance_menus () {
  global $submenu;
  unset($submenu['themes.php'][6]); // Customize
}

add_action('admin_menu', 'remove_appearance_menus');



/**
 * Disable comments
 */
// function disable_comments_post_types_support() {
//   $post_types = get_post_types();
//   foreach ($post_types as $post_type) {
//     if(post_type_supports($post_type, 'comments')) {
//       remove_post_type_support($post_type, 'comments');
//     }
//   }
// }
//
// // Close comments on the front-end
// function disable_comments_status() {
//   return false;
// }
//
// // Redirect any user trying to access comments page
// function disable_comments_admin_menu_redirect() {
//   global $pagenow;
//   if ($pagenow === 'edit-comments.php') {
//     wp_redirect(admin_url()); exit;
//   }
// }

// add_action('admin_init', 'disable_comments_post_types_support');
// add_filter('comments_open', 'disable_comments_status', 20, 2);
// add_filter('pings_open', 'disable_comments_status', 20, 2);
// add_action('admin_init', 'disable_comments_admin_menu_redirect');



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


/**
 * Remove emojicon support
 * http://wordpress.stackexchange.com/a/185578
 */
// function disable_wp_emojicons() {
//   // all actions related to emojis
//   remove_action( 'admin_print_styles', 'print_emoji_styles' );
//   remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
//   remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
//   remove_action( 'wp_print_styles', 'print_emoji_styles' );
//   remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
//   remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
//   remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
//
//   // filter to remove TinyMCE emojis
//   add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
//
//   // remove DNS prefetch
//   add_filter( 'emoji_svg_url', '__return_false' );
// }

// function disable_emojicons_tinymce( $plugins ) {
//   if ( is_array( $plugins ) ) {
//     return array_diff( $plugins, array( 'wpemoji' ) );
//   } else {
//     return array();
//   }
// }
//
// add_action( 'init', 'disable_wp_emojicons' );


/**
 * Clean up assets
 */
function clean_script_tag($input) {
  $input = str_replace("type='text/javascript' ", '', $input);
  return str_replace("'", '"', $input);
}

function clean_style_tag( $tag ) {
  return preg_replace( '~\s+type=["\'][^"\']++["\']~i', '', $tag );
}

add_filter('script_loader_tag', 'clean_script_tag');
add_filter( 'style_loader_tag', 'clean_style_tag' );


/**
 * Remove recent comments widget style in <head>
 */
add_filter( 'show_recent_comments_widget_style', '__return_false' );
