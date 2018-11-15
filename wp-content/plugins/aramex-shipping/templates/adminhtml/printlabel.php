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

function aramex_display_printlabel_in_admin($order)
{
    $get_userdata = get_userdata(get_current_user_id());
    if (!$get_userdata->allcaps['edit_shop_order'] || !$get_userdata->allcaps['read_shop_order'] || !$get_userdata->allcaps['edit_shop_orders'] || !$get_userdata->allcaps['edit_others_shop_orders']
        || !$get_userdata->allcaps['publish_shop_orders'] || !$get_userdata->allcaps['read_private_shop_orders']
        || !$get_userdata->allcaps['edit_private_shop_orders'] || !$get_userdata->allcaps['edit_published_shop_orders']) {
        return false;
    }
    $order_id = $order->id;
    $currentUrl = home_url(add_query_arg(null, null));
    $history = get_comments(array(
        'post_id' => $order_id,
        'orderby' => 'comment_ID',
        'order' => 'DESC',
        'approve' => 'approve',
        'type' => 'order_note',
    ));

    $history_list = array();
    foreach ($history as $_shipment) {
        $history_list[] = $_shipment->comment_content;
    }
    $last_track = "";
    if (count($history_list)) {
        foreach ($history_list as $_history) {
            $awbno = strstr($_history, "- Order No", true);
            $awbno = trim($awbno, "AWB No.");
            if (isset($awbno)) {
                if ((int)$awbno) {
                    $last_track = $awbno;
                    break;
                }
            }
            $awbno = trim($awbno, "Aramex Shipment Return Order AWB No.");
            if (isset($awbno)) {
                if ((int)$awbno) {
                    $last_track = $awbno;
                    break;
                }
            }
        }
    } ?>
    <?php

    if ($_SESSION['aramex_errors_printlabel']->errors > 0) {
        echo '    <div id="track_overlay"  class="printlabel_overlay"><div class="aramex_errors printlabel_error">';
        // Loop error codes and display errors
        foreach ($_SESSION['aramex_errors_printlabel']->errors as $key => $error) {
            if ($key == "error") {
                foreach ($error as $value) {
                    echo '<span class="error">' . esc_html($value) . '</span><br/>';
                }
            } else {
                foreach ($error as $value) {
                    echo '<span class="success">' . esc_html($value) . '</span><br/>';
                }
            }
        }
        echo ' <button id="printlabel_close" class="button-primary" type="button">';
        echo esc_html__('Close', 'aramex');
        echo '</button></div></div>';
    }
    if (isset($_SESSION['aramex_errors_printlabel'])) {
        unset($_SESSION['aramex_errors_printlabel']);
    } ?>
    <div id="printlabel_overlay" style="display:none;">
        <form method="post"
              action=" <?php echo esc_url(WP_PLUGIN_URL . '/aramex-shipping/includes/shipment/class-aramex-woocommerce-printlabel.php'); ?>"
              id="printlabel-form">
            <input name="_wpnonce" id="aramex-shipment-nonce" type="hidden"
                   value="<?php echo esc_attr(wp_create_nonce('aramex-shipment-check' . wp_get_current_user()->user_email)); ?>"/>
            <input type="hidden" name="aramex_shipment_referer" value="<?php echo esc_attr(esc_url($currentUrl)); ?>"/>
            <input name="aramex-printlabel" id="aramex-printlabel-field" type="hidden"
                   value="<?php echo esc_attr($order_id); ?>"/>
            <input name="aramex-lasttrack" id="aramex-printlabel-field" type="hidden"
                   value="<?php echo esc_attr($last_track); ?>"/>
            <script type="text/javascript">
                jQuery.noConflict();
                (function ($) {
                    $(document).ready(function () {
                        $('#print_aramex_shipment').click(function () {
                            $('#printlabel-form').submit();
                        });
                        $('#printlabel_close').click(function () {
                            $('.printlabel_overlay').css("display", "none");
                        });
                    });
                })(jQuery);
            </script>
        </form>
    </div>
<?php 
} ?>