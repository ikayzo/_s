<?php
/**
 * _s functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package _s
 */


/**
 * Theme setup
 */
require get_template_directory() . '/lib/theme-setup.php';

/**
 * Register widget areas
 */
require get_template_directory() . '/lib/widgets.php';

/**
 * Enqueue scripts and styles
 */
require get_template_directory() . '/lib/enqueue-assets.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/lib/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/lib/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/lib/jetpack.php';
