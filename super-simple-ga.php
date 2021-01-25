<?php
/**
 * Plugin Name: Super Simple GA
 * Plugin URI:
 * Description: The simplest way to add GA scripts to a theme/site.
 * Version: 0.1.0
 * Author: Erik Mitchell
 * Author URI:
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: ssga
 * Domain Path: /languages
 *
 * @package ssga
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

if ( ! defined( 'SSGA_PLUGIN_FILE' ) ) {
    define( 'SSGA_PLUGIN_FILE', __FILE__ );
}

// Include the main SSGA class.
if ( ! class_exists( 'SSGA' ) ) {
    include_once dirname( __FILE__ ) . '/includes/class-super-simple-ga.php';
}
