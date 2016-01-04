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
 * Load Custom Post Types
 */
require get_template_directory() . '/lib/custom-post-types.php';

/**
 * Load Custom Taxonomies
 */
require get_template_directory() . '/lib/custom-taxonomies.php';

/**
 * Load Custom Fields (ACF)
 */
require get_template_directory() . '/lib/custom-fields.php';

/**
 * Custom White Label Functions
 */
require get_template_directory() . '/lib/white-label.php';

/**
 * Admin / Site optimizations
 */
require get_template_directory() . '/lib/optimizations.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/lib/jetpack.php';



/**
 * Custom Woocommerce functions (optional)
 */
// require get_template_directory() . '/lib/ecommerce.php';
