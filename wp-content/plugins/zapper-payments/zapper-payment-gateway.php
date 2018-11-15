<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

$current_order_id = 0;

class Zapper_Payments extends WC_Payment_Gateway {
  // Go wild in here
  // Setup our Gateway's id, description and other values
  function __construct() {


    // write_log($this->site_id);

    // if (  ) {
    //
    // }

    $this->id = "zapper_payments";
    $this->method_title = __( "Zapper", 'zapper-payments' );
    $this->method_description = __( "Allow your customers to pay with Zapper on your WooCommerce Store", 'zapper-payments' );
    $this->title = __( "Zapper", 'zapper-payments' );
    $this->icon = null;
    $this->has_fields = true;
    $this->supports = array('products'); //array( 'default_credit_card_form' );
    $this->init_form_fields();
    $this->init_settings();

    foreach ( $this->settings as $setting_key => $value ) {
      $this->$setting_key = $value;
    }

    $this->zapper_api = new ZapperApi();

    // add_action( 'admin_notices', array( $this, 'do_ssl_check' ) );

    if ( is_admin() ) {
      add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
    } else {
      add_action( 'wp_head', 'init_js' );
    }

    add_action('woocommerce_api_'.strtolower(get_class($this)), array(&$this, 'handle_callback'));
  }

  function handle_callback() {
    // echo $_COOKIE['z_order_id'];

    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header('Access-Control-Allow-Headers: Content-Type');

    $entityBody = file_get_contents('php://input');
    $entityBody = trim($entityBody, '"');
    $entityBody = str_replace('\\"', '"', $entityBody);
    $jsonBody = json_decode($entityBody, TRUE);

    $reference = $jsonBody["Reference"];
    $payment_status = $jsonBody["PaymentStatusId"];

    $order = new WC_Order($reference);

    // try {
    //   $payment_result = $this->zapper_api->verify_zapper_payment($this->merchant_id, $this->site_id, $this->pos_key, $this->pos_secret, $payment_id);
    // } catch (Exception $e) {
    //   wc_add_notice( $e->getMessage(), 'error' );
    //   return;
    // }

    // echo $reference;
    if ($order != null && $order->post->post_status != "wc-processing") {
      if ($payment_status == 2) {
        $order->add_order_note( __( 'Zapper payment completed.', 'zapper-payments' ) );
        $order->payment_complete();
      } else if ($payment_status == 5) {
        wc_add_notice( $payment_result->error, 'error' );
        $order->add_order_note( 'Error: '. 'Zapper Payment was unsuccessful' );
      }
    }
    
    echo json_encode($order);
    exit;
  }

  function create_qrcode($site_id, $merchant_id, $bill_amount, $order_id) {
    echo '<script type="text/javascript">if (window.zapperMethod) {
      window.zapperMethod(' . $merchant_id . ', ' . $site_id . ', ' . $bill_amount . ', ' . $order_id . ');
    }</script>';
  }

  public function init_form_fields() {
    $this->form_fields = array(
      'enabled' => array(
        'title'   => __( 'Enable / Disable', 'zapper-payments' ),
        'label'   => __( 'Enable this payment method', 'zapper-payments' ),
        'type'    => 'checkbox',
        'default' => 'no',
      ),
      'merchant_id' => array(
        'title'    => __( 'Merchant ID', 'zapper-payments' ),
        'type'     => 'number',
        'desc_tip' => __( 'The Merchant ID you received after registering with Zapper.', 'zapper-payments' ),
        // 'default'   => __( '0', 'zapper-payments' ),
      ),
      'site_id' => array(
        'title'    => __( 'Site ID', 'zapper-payments' ),
        'type'     => 'number',
        'desc_tip' => __( 'The Merchant Site ID you received after registering with Zapper.', 'zapper-payments' ),
      ),
      'pos_key' => array(
        'title'        => __( 'POS Key', 'zapper-payments' ),
        'type'         => 'string',
        'description'  => 'POS Key recieved from Zapper to authenticate your merchant.',
        'desc_tip'     => __( 'The POS Key you received after registering with Zapper.', 'zapper-payments' ),
      ),
      'pos_secret' => array(
        'title'        => __( 'POS Token', 'zapper-payments' ),
        'type'         => 'string',
        'description'  => 'POS Token recieved from Zapper to authenticate your merchant.',
        'desc_tip'     => __( 'The POS Token you received after registering with Zapper.', 'zapper-payments' ),
      )
    );
  }

  // Payment Form Stuff

  // 1. Set up payment fields
  public function payment_fields() {
    if ( $this->enabled == "no" ) {
      echo 'Zapper has not been enabled by the store owner yet. Please select a different payment method.';
      return;
    }

    $isValid = $this->merchant_id != "" && $this->site_id != "" && $this->pos_key != "" && $this->pos_secret != "";

    if (! $isValid ) {
      echo '<span>Invalid Zapper Settings - Please contact the store owner.</span>';
      return;
    }

    echo '<input type="hidden" name="zapper_payment_id" id="zapper_payment_id" /><div id="zapper_payment_wrapper"></div><div style="text-align:center; margin-top:8px;">You will be redirected to <strong>Zapper</strong> to complete your order.</div>';
  }

  // 2. Payment Form validation
  public function validate_fields() {
    return true;
  }

  // User Clicks "Place Order"
  public function process_payment( $order_id ) {
    global $woocommerce, $post;

    // $payment_id = $_POST["zapper_payment_id"];
    // if ($payment_id == "") {
    //   wc_add_notice( 'No payment found. Please make sure that you have scanned the Zapper QR Code and made the payment.', 'error' );
    //   return;
    // }

    $customer_order = new WC_Order($order_id);
    // try {
    //   $payment_result = $this->zapper_api->verify_zapper_payment($this->merchant_id, $this->site_id, $this->pos_key, $this->pos_secret, $payment_id);
    // } catch (Exception $e) {
    //   wc_add_notice( $e->getMessage(), 'error' );
    //   return;
    // }


    // if ($payment_result->success == false) {
    //   wc_add_notice( $payment_result->error, 'error' );
    //   $customer_order->add_order_note( 'Error: '. $payment_result->error );
    // } else {
    //   $customer_order->add_order_note( __( 'Zapper payment completed.', 'zapper-payments' ) );
    //   $customer_order->payment_complete();

    //   $woocommerce->cart->empty_cart();

    $return_url = 'https://woocommerce.zapzap.mobi/?a='.$woocommerce->cart->total.'&r='.$customer_order->id.'&m='.$this->merchant_id.'&s='.$this->site_id.'&u='.$this->get_return_url( $customer_order );

    return array(
      'result'   => 'success',
      'redirect' => $return_url
    );
  }
}

?>
