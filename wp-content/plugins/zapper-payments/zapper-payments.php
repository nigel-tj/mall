<?php
/*
Plugin Name:          Zapper Payments for WooCommerce
Plugin URI:           http://woothemes.com/products/zapper-payments/
Description:          Add Zapper as a payment method to your website!
Version:              1.3.1
Author:               Zapper Development
Author URI:           http://www.zapper.com
Developer:            Zapper Development
Developer URI:        http://www.zapper.com
Text Domain:          zapper-payments
WC requires at least: 2.2
WC tested up to:      3.0
*/

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

add_action( 'plugins_loaded', 'zapper_init', 0 );

function zapper_init() {
  if ( ! class_exists( 'WC_Payment_Gateway' ) ) return;

  include_once( 'api/zapper-api.php' );
  include_once( 'zapper-payment-gateway.php' );

  add_action('wp_head', 'zapper_payments_js');

  // Add Zapper as an option to the payment gateway
  add_filter( 'woocommerce_payment_gateways', 'add_zapper_payment_gateway' );
  function add_zapper_payment_gateway( $methods ) {
    $methods[] = 'Zapper_Payments';
    return $methods;
  }

  // Add Zapper settings page under the WooCommerce Menu
  add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'zapper_action_links' );
  function zapper_action_links( $links ) {
  	$plugin_links = array(
  		'<a href="' . admin_url( 'admin.php?page=wc-settings&tab=checkout' ) . '">' . __( 'Settings', 'zapper' ) . '</a>',
  	);

  	return array_merge( $plugin_links, $links );
  }
}

function init_js() {
  wp_enqueue_script('zapper_js', 'https://code.zapper.com/zapper.js');
}

function zapper_payments_js () {
  wp_enqueue_script('zapper_payments_js', plugins_url() . '/zapper-payments/scripts/zapper-payments.js');
}

?>
