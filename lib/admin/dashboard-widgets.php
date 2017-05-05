<?php
/**
 * Custom dashboard widgets
 *
 * @package _s
 */


/**
 * Remove third party Widgets
 */
function remove_thirdparty_dashboard_widgets() {
  remove_meta_box('wpe_dify_news_feed', 'dashboard', 'normal'); // WP Engine
  remove_meta_box('tribe_dashboard_widget', 'dashboard', 'normal'); // Tribe Events
}



/**
 * Welcome
 */
function welcome_widget() {

  $developer = 'design@ikayzo.com';

  echo '<h2 class="unselectable">Welcome to the ' . wp_get_theme() . ' WordPress CMS!</h2>';
  echo '<br>';
  echo '<p><strong>Need help?</strong> Contact the developer <a href="mailto:' . $developer . '">' . $developer . '</a></p>';
}



/**
 * Technical Information
 */
function technical_widget() {
  echo '<p><strong>Current Wordpress Version:</strong> ' . get_bloginfo('version') . '</p>';
}



 /**
  * Setup Dashboard
  */
function dashboard_widgets() {
  remove_thirdparty_dashboard_widgets();

  // Main Widgets
  wp_add_dashboard_widget('welcome_widget', 'Overview', 'welcome_widget');

  if ( current_user_can('administrator') ) {
    wp_add_dashboard_widget('technical_widget', 'Technical Information', 'technical_widget');
  }
}

 add_action('wp_dashboard_setup', 'dashboard_widgets');
