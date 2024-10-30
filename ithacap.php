<?php

/**
 *
 * @link              https://itech-softsolutions.com/
 * @since             1.0.0
 * @package           Ithacap
 *
 * @wordpress-plugin
 * Plugin Name:       iTech Hide Add Cart If Already Purchased
 * Plugin URI:        https://itech-softsolutions.com/plugin
 * Description:       This plugin will hide cart button for logged in user who already purchased the product.
 * Version:           1.0.0
 * Author:            iTech Theme
 * Author URI:        https://itech-softsolutions.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ithacap
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'ITHACAP_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ithacap-activator.php
 */
function activate_ithacap() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ithacap-activator.php';
	Ithacap_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ithacap-deactivator.php
 */
function deactivate_ithacap() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ithacap-deactivator.php';
	Ithacap_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ithacap' );
register_deactivation_hook( __FILE__, 'deactivate_ithacap' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ithacap.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ithacap() {

	$plugin = new Ithacap();
	$plugin->run();

}

add_filter( 'woocommerce_is_purchasable', 'ithacap_hide_add_cart_if_already_purchased', 9999, 2 );	 

function ithacap_hide_add_cart_if_already_purchased( $is_purchasable, $product ) {
	if ( wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) {
	$is_purchasable = false;
   }
   return $is_purchasable;
}

run_ithacap();
