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
 * Class Aramex_Aramexcalculator_Method is a constructor for Aramexcalculator functionalty
 */
class Aramex_Aramexcalculator_Method extends Aramex_Helper
{

    /**
     * @var Aramex_Aramecalculator_Method_Model
     */
    private $model;

    /**
     * Aramex_Aramexcalculator_Method constructor.
     */
    public function __construct()
    {
        include_once __DIR__ . '/class-aramex-woocommerce-aramexcalculator_model.php';
        $this->model = new Aramex_Aramecalculator_Method_Model();
    }

    /**
     * Starting method
     *
     * @return array Result from Aramex server
     */
    public function index()
    {
        require_once(explode("wp-content", __FILE__)[0] . "wp-load.php");
        check_ajax_referer('aramexcalculator', 'security');
        $post = $this->formatPost($_POST);
        $this->model->rateCalculator($post);
    }
}

$aramexserchautocities = new Aramex_Aramexcalculator_Method();
$aramexserchautocities->index();
