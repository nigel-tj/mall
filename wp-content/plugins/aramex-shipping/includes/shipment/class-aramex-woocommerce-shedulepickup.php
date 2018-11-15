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
 * Class Aramex_Shedule_Method is a metod for Shedule functionality
 */
class Aramex_Shedule_Method extends Aramex_Helper
{

    /**
     * Starting method
     *
     * @return mixed|string|void
     */

    public function index()
    {
        require_once(explode("wp-content", __FILE__)[0] . "wp-load.php");
        check_admin_referer('aramex-shipment-check' . wp_get_current_user()->user_email);
        $info = $this->getInfo(wp_create_nonce('aramex-shipment-check' . wp_get_current_user()->user_email));
        $post = $this->formatPost($_POST);

        $response = array();
        try {
            $post_array = $post['pickup'];
            $pickupDate = strtotime($post_array['date']);
            $readyTimeH = $post_array['ready_hour'];
            $readyTimeM = $post_array['ready_minute'];
            $readyTime = mktime(($readyTimeH - 2), $readyTimeM, 0, date("m", $pickupDate), date("d", $pickupDate),
                date("Y", $pickupDate));

            $closingTimeH = $post_array['latest_hour'];
            $closingTimeM = $post_array['latest_minute'];
            $closingTime = mktime(($closingTimeH - 2), $closingTimeM, 0, date("m", $pickupDate), date("d", $pickupDate),
                date("Y", $pickupDate));
            $params = array(
                'ClientInfo' => $info['clientInfo'],
                'Transaction' => array(
                    'Reference1' => $post_array['reference']
                ),
                'Pickup' => array(
                    'PickupContact' => array(
                        'PersonName' => html_entity_decode($post_array['contact']),
                        'CompanyName' => html_entity_decode($post_array['company']),
                        'PhoneNumber1' => html_entity_decode($post_array['phone']),
                        'PhoneNumber1Ext' => html_entity_decode($post_array['ext']),
                        'CellPhone' => html_entity_decode($post['mobile']),
                        'EmailAddress' => html_entity_decode($post['email'])
                    ),
                    'PickupAddress' => array(
                        'Line1' => html_entity_decode($post['address']),
                        'City' => html_entity_decode($post['city']),
                        'StateOrProvinceCode' => html_entity_decode($post_array['state']),
                        'PostCode' => html_entity_decode($post_array['zip']),
                        'CountryCode' => $post_array['country']
                    ),
                    'PickupLocation' => html_entity_decode($post_array['location']),
                    'PickupDate' => $readyTime,
                    'ReadyTime' => $readyTime,
                    'LastPickupTime' => $closingTime,
                    'ClosingTime' => $closingTime,
                    'Comments' => html_entity_decode($post_array['comments']),
                    'Reference1' => html_entity_decode($post_array['reference']),
                    'Reference2' => '',
                    'Vehicle' => $post_array['vehicle'],
                    'Shipments' => array(
                        'Shipment' => array()
                    ),
                    'PickupItems' => array(
                        'PickupItemDetail' => array(
                            'ProductGroup' => $post_array['product_group'],
                            'ProductType' => $post_array['product_type'],
                            'Payment' => $post_array['payment_type'],
                            'NumberOfShipments' => $post['no_shipments'],
                            'NumberOfPieces' => $post['no_pieces'],
                            'ShipmentWeight' => array(
                                'Value' => $post['text_weight'],
                                'Unit' => $post_array['weight_unit']
                            ),
                        ),
                    ),
                    'Status' => $post_array['status']
                )
            );

            //SOAP object
            $soapClient = new SoapClient($info['baseUrl'] . 'shipping.wsdl', array('soap_version' => SOAP_1_1));
            try {
                $results = $soapClient->CreatePickup($params);
                if ($results->HasErrors) {
                    if (count($results->Notifications->Notification) > 1) {
                        $error = "";
                        foreach ($results->Notifications->Notification as $notify_error) {
                            $error .= 'Aramex: ' . $notify_error->Code . ' - ' . $notify_error->Message . "<br>";
                        }
                        $response['error'] = $error;
                    } else {
                        $response['error'] = 'Aramex: ' . $results->Notifications->Notification->Code . ' - ' . $results->Notifications->Notification->Message;
                    }
                    $response['type'] = 'error';
                } else {
                    $comment = __('Pickup reference number',
                            'aramex') . " ( <strong>" . $results->ProcessedPickup->ID . "</strong> ).";
                    $commentdata = array(
                        'comment_post_ID' => $post_array['reference'],
                        'comment_author' => '',
                        'comment_author_email' => '',
                        'comment_author_url' => '',
                        'comment_content' => $comment,
                        'comment_type' => 'order_note',
                        'user_id' => "0",
                    );
                    wp_new_comment($commentdata);
                    $response['type'] = 'success';
                    $amount = "<p class='amount'>" . __('Pickup reference number',
                            'aramex') . " ( <strong>" . $results->ProcessedPickup->ID . "</strong> ).</p>";
                    $response['html'] = $amount;
                }
            } catch (Exception $e) {
                $response['type'] = 'error';
                $response['error'] = $e->getMessage();
            }
        } catch (Exception $e) {
            $response['type'] = 'error';
            $response['error'] = $e->getMessage();
        }
        print json_encode($response);
        die();
    }
}

$aramexshedule = new Aramex_Shedule_Method();
$aramexshedule->index();
