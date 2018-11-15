<?php
/**
 * Plugin Name:  Aramex Shipping WooCommerce
 * Plugin URI:   https://aramex.com
 * Description:  Aramex Shipping WooCommerce plugin
 * Version:      1.0.0
 * Author:       aramex.com
 * Author URI:   https://www.aramex.com/solutions-services/developers-solutions-center
 * License:      GPL2
 * License URI:  https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:  aramex
 * Domain Path:  /languages
 */

include_once __DIR__ . '../../core/class-aramex-helper.php';

/**
 * Class Aramex_Bulk_Method is a controller for Bulk functionality
 */
class Aramex_Bulk_Method extends Aramex_Helper
{

    /**
     * Aramex_Bulk_Method constructor.
     */
    public function __construct()
    {
        include_once __DIR__ . '../../core/class-aramex-helper.php';
    }

    /**
     * Starting method
     *
     * @return mixed|string|void
     */
    public function index()
    {
        require_once(explode("wp-content", __FILE__)[0] . "wp-load.php");
        $post_out = $this->formatPost($_POST);
        if (check_admin_referer('aramex-shipment-nonce' . wp_get_current_user()->user_email) == false || get_current_user_id() == 0) {
            echo(__('Invalid form data.', 'aramex'));
            die();
        }
        $post = array();
        $params = array();
        $params1 = array();
        parse_str($post_out['str'], $params1);
        $mail = $params1['aramex_email_customer'];
        $orders = array();
        include_once(plugin_dir_path(__FILE__) . '../../includes/shipping/class-aramex-woocommerce-shipping.php');
        $settings = new Aramex_Shipping_Method();
        $post['aramex_shipment_shipper_country'] = $settings->settings['country'];
        //check "pending" status
        if (count($post_out["selectedOrders"])) {
            foreach ($post_out["selectedOrders"] as $key => $order_id) {
                $order = wc_get_order($order_id);

                if ($order->post_status == "wc-processing") {
                    $shippingCountry = $order->shipping_country;
                    if ($shippingCountry == $post['aramex_shipment_shipper_country']) {
                        $orders[$key]['method'] = "DOM";
                    } else {
                        $orders[$key]['method'] = "EXP";
                    }
                    $orders[$key]['order_id'] = $order_id;
                } else {
                    $responce = "<p class='aramex_red'> __('Select orders with processing status, please', 'aramex')</p>";
                    echo json_encode(['message' => $responce]);
                    die();
                }
            }
            //domestic metods must be first
            $dom = array();
            $exp = array();
            foreach ($orders as $key => $order_item) {
                if ($order_item['method'] == 'DOM') {
                    $dom[$key]['method'] = "DOM";
                    $dom[$key]['order_id'] = $order_item['order_id'];
                } else {
                    $exp[$key]['method'] = "EXP";
                    $exp[$key]['order_id'] = $order_item['order_id'];
                }
            }
            $orders = array();
            $total = count($dom) + count($exp);
            for ($i = 0; $i < $total; $i++) {
                foreach ($dom as $key => $item) {
                    $orders[$key]['method'] = "DOM";
                    $orders[$key]['order_id'] = $item['order_id'];
                }
                foreach ($exp as $key => $item) {
                    $orders[$key]['method'] = "EXP";
                    $orders[$key]['order_id'] = $item['order_id'];
                }
            }
        }

        //domestic metods must be first
        if (count($orders)) {
            $responce = "";
            foreach ($orders as $key => $orderItem) {
                $post['aramex_shipment_original_reference'] = (int)$orderItem['order_id'];
                $order = wc_get_order($orderItem['order_id']);
                $itemsv = $order->get_items();
                $totalWeight = 0;
                $descriptionOfGoods = "";
                foreach ($itemsv as $itemvv) {
                    if ($itemvv['qty'] > 0) {
                        $product = wc_get_product($itemvv['product_id']);
                        $weight = $product->weight * $itemvv['qty'];
                        $descriptionOfGoods .= $itemvv['product_id'] . ' - ' . trim($itemvv['name']) . ' : ';
                        $totalWeight += $weight;
                        $qty = $itemvv['qty'];
                    }
                }
                if ($orderItem['method'] == 'DOM') {
                    $aramex_shipment_info_product_type = ($params1['aramex_shipment_info_product_type_dom']) ? $params1['aramex_shipment_info_product_type_dom'] : "";
                    $aramex_shipment_info_payment_type = ($params1['aramex_shipment_info_payment_type_dom']) ? $params1['aramex_shipment_info_payment_type_dom'] : "";
                    $aramex_shipment_info_payment_option = "";
                    $aramex_shipment_info_service_type = ($params1['aramex_shipment_info_service_type_dom']) ? $params1['aramex_shipment_info_service_type_dom'] : "";
                    $aramex_shipment_currency_code = ($params1['aramex_shipment_currency_code_dom']) ? $params1['aramex_shipment_currency_code_dom'] : "";
                    $aramex_shipment_info_custom_amount = "";
                } else {
                    $aramex_shipment_info_product_type = ($params1['aramex_shipment_info_product_type']) ? $params1['aramex_shipment_info_product_type'] : "";
                    $aramex_shipment_info_payment_type = ($params1['aramex_shipment_info_payment_type']) ? $params1['aramex_shipment_info_payment_type'] : "";
                    $aramex_shipment_info_payment_option = ($params1['aramex_shipment_info_payment_option']) ? $params1['aramex_shipment_info_payment_option'] : "";
                    $aramex_shipment_info_service_type = ($params1['aramex_shipment_info_service_type']) ? $params1['aramex_shipment_info_service_type'] : "";
                    $aramex_shipment_currency_code = ($params1['aramex_shipment_currency_code']) ? $params1['aramex_shipment_currency_code'] : "";
                    $aramex_shipment_info_custom_amount = ($params1['aramex_shipment_info_custom_amount']) ? $params1['aramex_shipment_info_custom_amount'] : "";
                }

                $company_name = isset($order->billing_country) ? $order->billing_company : '';
                if ($company_name == "") {
                    $company_name = $order->shipping_company;
                }
                if ($company_name == "") {
                    $company_name = $order->shipping_first_name . " " . $order->shipping_last_name;
                }
                //shipper parameters
                $params['Shipper'] = array(
                    'Reference1' => (string)$order->id,
                    'Reference2' => '',
                    'AccountNumber' => (string)$settings->settings['account_number'],
                    //Party Address
                    'PartyAddress' => array(
                        'Line1' => addslashes($settings->settings['address']),
                        'Line2' => '',
                        'Line3' => '',
                        'City' => $settings->settings['city'],
                        'StateOrProvinceCode' => $settings->settings['state'],
                        'PostCode' => $settings->settings['postalcode'],
                        'CountryCode' => $settings->settings['country'],
                    ),
                    //Contact Info
                    'Contact' => array(
                        'Department' => '',
                        'PersonName' => $settings->settings['name'],
                        'Title' => '',
                        'CompanyName' => $settings->settings['company'],
                        'PhoneNumber1' => $settings->settings['phone'],
                        'PhoneNumber1Ext' => '',
                        'PhoneNumber2' => '',
                        'PhoneNumber2Ext' => '',
                        'FaxNumber' => '',
                        'CellPhone' => $settings->settings['phone'],
                        'EmailAddress' => $settings->settings['email_origin'],
                        'Type' => ''
                    ),
                );

                //consinee parameters
                $params['Consignee'] = array(
                    'Reference1' => (string)$order->id,
                    'Reference2' => '',
                    'AccountNumber' => "",
                    //Party Address
                    'PartyAddress' => array(
                        'Line1' => ($order->shipping_address_1) ? $order->shipping_address_1 . " " . $order->shipping_address_2 : '',
                        'Line2' => '',
                        'Line3' => '',
                        'City' => ($order->shipping_city) ? $order->shipping_city : '',
                        'StateOrProvinceCode' => '',
                        'PostCode' => ($order->shipping_postcode) ? $order->shipping_postcode : '',
                        'CountryCode' => ($order->shipping_country) ? $order->shipping_country : '',
                    ),
                    //Contact Info
                    'Contact' => array(
                        'Department' => '',
                        'PersonName' => ($order->shipping_first_name) ? $order->shipping_first_name . " " . $order->shipping_last_name : '',
                        'Title' => '',
                        'CompanyName' => $company_name,
                        'PhoneNumber1' => ($order->billing_phone) ? $order->billing_phone : '',
                        'PhoneNumber1Ext' => '',
                        'PhoneNumber2' => '',
                        'PhoneNumber2Ext' => '',
                        'FaxNumber' => '',
                        'CellPhone' => ($order->billing_phone) ? $order->billing_phone : '',
                        'EmailAddress' => ($order->billing_email) ? $order->billing_email : '',
                        'Type' => ''
                    )
                );

                // Other Main Shipment Parameters
                $params['Reference1'] = (string)$order->id;
                $params['Reference2'] = '';
                $params['Reference3'] = '';
                $params['ForeignHAWB'] = '';

                $params['TransportType'] = 0;
                $params['ShippingDateTime'] = time(); //date('m/d/Y g:i:sA');
                $params['DueDate'] = time() + (7 * 24 * 60 * 60); //date('m/d/Y g:i:sA');
                $params['PickupLocation'] = 'Reception';
                $params['PickupGUID'] = '';
                $params['Comments'] = '';
                $params['AccountingInstrcutions'] = '';
                $params['OperationsInstructions'] = '';
                $params['Details'] = array(
                    'Dimensions' => array(
                        'Length' => '0',
                        'Width' => '0',
                        'Height' => '0',
                        'Unit' => 'cm'
                    ),
                    'ActualWeight' => array(
                        'Value' => (string)$totalWeight,
                        'Unit' => get_option('woocommerce_weight_unit')
                    ),
                    'ProductGroup' => $orderItem['method'],
                    'ProductType' => $aramex_shipment_info_product_type,
                    'PaymentType' => $aramex_shipment_info_payment_type,
                    'PaymentOptions' => $aramex_shipment_info_payment_option,
                    'Services' => $aramex_shipment_info_service_type,
                    'NumberOfPieces' => $qty,
                    'DescriptionOfGoods' => $descriptionOfGoods,
                    'GoodsOriginCountry' => $settings->settings['country'],
                    'Items' => '1',
                );

                $params['Details']['CashOnDeliveryAmount'] = array(
                    'Value' => $order->get_total(),
                    'CurrencyCode' => $aramex_shipment_currency_code
                );

                $params['Details']['CustomsValueAmount'] = array(
                    'Value' => $aramex_shipment_info_custom_amount,
                    'CurrencyCode' => $aramex_shipment_currency_code
                );

                $major_par['Shipments'][] = $params;
                $info = Aramex_Helper::getInfo(wp_create_nonce('aramex-shipment-check' . wp_get_current_user()->user_email));
                $major_par['ClientInfo'] = $info['clientInfo'];
                $report_id = trim($settings->settings['report_id']);
                if ($report_id == "") {
                    $report_id = 9729;
                }
                $major_par['LabelInfo'] = array(
                    'ReportID' => $report_id,
                    'ReportType' => 'URL'
                );
                $replay = $this->postAction($major_par, $order, $orderItem['method'], $mail);

                if ($replay[0] == "DOM") {
                    $method = "Domestic Product Group";
                } else {
                    $method = "International Product Group";
                };

                if ($replay[1] == "error") {
                    $responce .= "<p class='aramex_red'>" . __('Aramex Shipment Number -',
                            'aramex') . $orderItem['order_id'] . __(' not created',
                            'aramex') . " (" . $method . ")</p>";
                    break;
                } else {
                    $responce .= "<p class='aramex_green'>" . __('Aramex Shipment Number:',
                            'aramex') . $orderItem['order_id'] . __('has been created',
                            'aramex') . "(" . $method . ")</p>";
                }
            }
            echo json_encode(['message' => $responce]);
            die();
        } else {
            $errors = "<p class='aramex_red'>" . __('No orders with Pending status selected', 'aramex') . "</p>";
            return json_encode(['Test-Message' => $errors]);
        }
    }

    /**
     *
     * @param array $major_par Data for Shipment calculation
     * @param object $order Order object
     * @param string $method Shipping method
     * @param string $mail Email
     * @return array Result from Aramex server
     */
    private function postAction($major_par, $order, $method, $mail)
    {
        $shipper_name = $order->shipping_first_name . " " . $order->shipping_last_name;
        $info = Aramex_Helper::getInfo(wp_create_nonce('aramex-shipment-check' . wp_get_current_user()->user_email));

        //SOAP object
        $soapClient = new SoapClient($info['baseUrl'] . 'shipping.wsdl', array('soap_version' => SOAP_1_1));
        try {
            //create shipment call
            $auth_call = $soapClient->CreateShipments($major_par);
            if ($auth_call->HasErrors) {
                if (empty($auth_call->Shipments)) {
                    if (count($auth_call->Notifications->Notification) > 1) {
                        foreach ($auth_call->Notifications->Notification as $notify_error) {
                            aramex_errors()->add('error',
                                __('Aramex: ' . $notify_error->Code . ' - ' . $notify_error->Message));
                        }
                    } else {
                        aramex_errors()->add('error',
                            __('Aramex: ' . $auth_call->Notifications->Notification->Code . ' - ' . $auth_call->Notifications->Notification->Message));
                    }
                } else {
                    if (count($auth_call->Shipments->ProcessedShipment->Notifications->Notification) > 1) {
                        $notification_string = '';
                        foreach ($auth_call->Shipments->ProcessedShipment->Notifications->Notification as $notification_error) {
                            $notification_string .= $notification_error->Code . ' - ' . $notification_error->Message . ' <br />';
                        }
                        $this->aramex_errors()->add('error', __($notification_string, 'aramex'));
                    } else {
                        $this->aramex_errors()->add('error',
                            __('Aramex: ' . $auth_call->Shipments->ProcessedShipment->Notifications->Notification->Code . ' - ' . $auth_call->Shipments->ProcessedShipment->Notifications->Notification->Message),
                            'aramex');
                    }
                }
                return array($method, 'error');
            } else {
                $commentdata = array(
                    'comment_post_ID' => $order->id,
                    'comment_author' => '',
                    'comment_author_email' => '',
                    'comment_author_url' => '',
                    'comment_content' => "AWB No. " . $auth_call->Shipments->ProcessedShipment->ID . " - Order No. " . $auth_call->Shipments->ProcessedShipment->Reference1,
                    'comment_type' => 'order_note',
                    'user_id' => "0",
                );

                wp_new_comment($commentdata);
                $order = new WC_Order($order->id);
                if (!empty($order)) {
                    $order->update_status('on-hold', __('Aramex shipment created.', 'woocommerce'));
                }

                /* sending mail */
                global $woocommerce;
                $mailer = $woocommerce->mailer();
                $message_body = sprintf(__('<p>Dear <b>%s</b> </p>', 'aramex'), $shipper_name);
                $message_body .= sprintf(__('<p>Your order is #%s </p>', 'aramex'),
                    $auth_call->Shipments->ProcessedShipment->Reference1);
                $message_body .= sprintf(__('<p>Created Airway bill number: %s </p>', 'aramex'),
                    $auth_call->Shipments->ProcessedShipment->ID);
                $message_body .= __('<p>You can track shipment on <a href="http://www.aramex.com/express/track.aspx">http://www.aramex.com/express/track.aspx</a> </p>',
                    'aramex');
                $message_body .= __('<p>If you have any questions, please feel free to contact us <b>support@example.com</b> </p>',
                    'aramex');
                $message = $mailer->wrap_message(
                // Message head and message body.
                    sprintf(__('Aramex shipment #%s created', 'aramex'), $order->id), $message_body);

                if ($mail == 'yes') {
                    // Cliente email
                    $to = array();
                    $to[] = $order->billing_email;
                    $to[] = $info['copyInfo']['copy_to'];
                    $emailsTo = implode(',', $to);
                    if (trim($info['copyInfo']['copy_to']) == "") {
                        $emailsTo = trim($emailsTo, ',');
                    }
                    $mailheader = array();
                    if ($info['copyInfo']['copy_method'] == "1" && trim($info['copyInfo']['copy_to']) != "") {
                        $emails = explode(',', trim($info['copyInfo']['copy_to']));
                        foreach ($emails as $email) {
                            $mailheader[] = 'Bcc: ' . $email;
                        }
                    }
                    if ($info['copyInfo']['copy_method'] == "0" && trim($info['copyInfo']['copy_to']) != "") {
                        $emails = explode(',', trim($info['copyInfo']['copy_to']));
                        foreach ((array)$emails as $email) {
                            $mailheader[] = 'Cc: ' . $email;
                        }
                    }
                    try {
                        $mailer->send($emailsTo,
                            sprintf(__('Aramex shipment #%s created', 'aramex'), $order->get_order_number()),
                            $message, $mailheader);
                    } catch (Exception $ex) {
                        $this->aramex_errors()->add('error', $ex->getMessage());
                    }
                }
                return array($method, 'success');
            }
        } catch (Exception $e) {
            $errors = $e->getMessage();
            return array($method, 'error');
        }
    }

    /**
     * @return WP_Error  WP Errors
     */
    private function aramex_errors()
    {
        static $wp_error; // Will hold global variable safely
        return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
    }
}

$aramex = new Aramex_Bulk_Method();
$aramex->index();
