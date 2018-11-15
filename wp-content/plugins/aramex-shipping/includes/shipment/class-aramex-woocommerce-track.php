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
 * Class Aramex_Track_Method is a controller for Tracking functionality
 */
class Aramex_Track_Method extends Aramex_Helper
{

    /**
     * Starting method
     * @return void
     */
    public function index()
    {
        require_once(explode("wp-content", __FILE__)[0] . "wp-load.php");
        check_admin_referer('aramex-shipment-check' . wp_get_current_user()->user_email);
        $info = $this->getInfo(wp_create_nonce('aramex-shipment-check' . wp_get_current_user()->user_email));
        $post = $this->formatPost($_POST);
        $account = $info['clientInfo']['AccountNumber'];
        $trackingvalue = $post["aramex-track"];
        $response = array();

        //SOAP object
        $soapClient = new SoapClient($info['baseUrl'] . 'Tracking.wsdl', array('soap_version' => SOAP_1_1));
        $aramexParams = $this->_getAuthDetails($info);
        $aramexParams['Transaction'] = array('Reference1' => '001');
        $aramexParams['Shipments'] = array($trackingvalue);
        $_resAramex = $soapClient->TrackShipments($aramexParams);

        if (is_object($_resAramex) && !$_resAramex->HasErrors) {
            $response['type'] = 'success';
            if (!empty($_resAramex->TrackingResults->KeyValueOfstringArrayOfTrackingResultmFAkxlpY->Value->TrackingResult)) {
                $response['html'] = $this->getTrackingInfoTable($_resAramex->TrackingResults->KeyValueOfstringArrayOfTrackingResultmFAkxlpY->Value->TrackingResult);
            } else {
                $response['html'] = __('Unable to retrieve quotes, please check if the Tracking Number is valid or contact your administrator.',
                    'aramex');
            }
        } else {
            $response['type'] = 'error';
            foreach ($_resAramex->Notifications as $notification) {
                $response['html'] .= '<b>' . $notification->Code . '</b>' . $notification->Message;
            }
        }
        print json_encode($response);
        die();
    }

    /**
     * @param $info
     * @return array
     */
    private function _getAuthDetails($info)
    {
        return array(
            'ClientInfo' => $info['clientInfo']
        );
    }

    /**
     * @param $HAWBHistory
     * @return string
     */
    private function getTrackingInfoTable($HAWBHistory)
    {
        $checkArray = is_array($HAWBHistory);
        $_resultTable = '<table summary="Item Tracking"  class="data-table">';
        $_resultTable .= "<col width='1'>
                          <col width='1'>
                          <col width='1'>
                          <col width='1'>
                          <thead>
                          <tr class='first last'>
                          <th>" . __('Location', 'aramex') . "</th>
                          <th>" . __('Action Date/Time', 'aramex') . "</th>
                          <th class='a-right'>" . __('Tracking Description', 'aramex') . "</th>
                          <th class='a-center'>" . __('Comments', 'aramex') . "</th>
                          </tr>
                          </thead><tbody>";
        if ($checkArray) {
            foreach ($HAWBHistory as $HAWBUpdate) {
                $_resultTable .= '<tr>
                    <td>' . $HAWBUpdate->UpdateLocation . '</td>
                    <td>' . $HAWBUpdate->UpdateDateTime . '</td>
                    <td>' . $HAWBUpdate->UpdateDescription . '</td>
                    <td>' . $HAWBUpdate->Comments . '</td>
                    </tr>';
            }
        } else {
            $_resultTable .= '<tr>
                    <td>' . $HAWBHistory->UpdateLocation . '</td>
                    <td>' . $HAWBHistory->UpdateDateTime . '</td>
                    <td>' . $HAWBHistory->UpdateDescription . '</td>
                    <td>' . $HAWBHistory->Comments . '</td>
                    </tr>';
        }
        $_resultTable .= '</tbody></table>';
        return $_resultTable;
    }
}

$aramextrack = new Aramex_Track_Method();
$aramextrack->index();
