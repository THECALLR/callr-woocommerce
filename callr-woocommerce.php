<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://callr.com
 * @since             1.0.0
 * @package           Callr_Woocommerce
 *
 * @wordpress-plugin
 * Plugin Name:       SMS notifications for WooCommerce by Callr
 * Plugin URI:        http://callr.com
 * Description:       This plugin allows customers and admins to be notified by SMS when an order is created or updated.
 * Version:           1.0.0
 * Author:            Callr
 * Author URI:        http://callr.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       callr-woocommerce
 * Domain Path:       /languages
 */


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Check if WooCommerce is active
if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	return;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-callr-woocommerce-activator.php
 */
function activate_callr_woocommerce() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-callr-woocommerce-activator.php';
	Callr_Woocommerce_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-callr-woocommerce-deactivator.php
 */
function deactivate_callr_woocommerce() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-callr-woocommerce-deactivator.php';
	Callr_Woocommerce_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_callr_woocommerce' );
register_deactivation_hook( __FILE__, 'deactivate_callr_woocommerce' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-callr-woocommerce.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_callr_woocommerce() {

	$plugin = new Callr_Woocommerce();
	$plugin->run();

}
run_callr_woocommerce();
