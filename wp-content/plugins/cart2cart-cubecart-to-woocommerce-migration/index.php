<?php

/**
 * Plugin Name: Cart2cart: CubeCart to Woocommerce Plugin
 * Plugin URI: https://app.shopping-cart-migration.com/
 * Description: WooCommerce migration with Cart2Cart will let you to import/export all your products, orders, customers, categories, reviews and other entities, preserving relations between them.
 * Version: 2.0.0
 * Author: MagneticOne
 * Author URI: https://www.magneticone.com/
*/

namespace Cart2cart;

define('CART2CART_PLUGIN_ROOT_DIR', __DIR__ . '/');

require __DIR__ . '/class/AutoLoad.php';

AutoLoad::init();

add_action('init', array(__NAMESPACE__ . '\Plugin', 'init'), 21);

register_activation_hook(__FILE__, array(__NAMESPACE__ . '\Installer', 'activate'));
register_deactivation_hook(__FILE__, array(__NAMESPACE__ . '\Installer', 'deactivate'));
register_uninstall_hook(__FILE__, array(__NAMESPACE__ . '\Installer', 'uninstall'));