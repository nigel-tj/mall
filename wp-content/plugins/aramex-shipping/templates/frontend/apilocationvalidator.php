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

function aramex_display_apilocationvalidator_in_checkout()
{
    $settings = new Aramex_Shipping_Method();
    $allowed = $settings->settings['apilocationvalidator_active'];
    if ($allowed == 1) {
        $ajax_nonce_serchautocities = wp_create_nonce("serchautocities");
        $ajax_nonce_applyvalidation = wp_create_nonce("applyvalidation"); ?>
        <script type="text/javascript">
            jQuery.noConflict();
            (function ($) {
                $(document).ready(function () {
                    var type = 'billing';
                    Go(type);
                    var type = 'shipping';
                    Go(type);

                    function Go(type) {
                        var button = '.woocommerce #place_order';
                        var shippingAramexCitiesObj;
                        /* set HTML blocks */
                        jQuery(".woocommerce-" + type + "-fields").find('input[name^= "' + type + '_city"]').after('<div id="aramex_loader" style="height:31px; width:31px; display:none;"></div>');
                        /* get Aramex sities */
                        shippingAramexCitiesObj = AutoSearchControls(type, "");
                        jQuery(".woocommerce-" + type + "-fields").find('select[name^= "' + type + '_country"]').change(function () {
                            jQuery('.woocommerce-' + type + '-fields').find('input[name^= "' + type + '_city"]').val("");
                            getAllCitiesJson(type, shippingAramexCitiesObj);
                        });
                        getAllCitiesJson(type, shippingAramexCitiesObj);

                        function AutoSearchControls(type, search_city) {
                            return jQuery('.woocommerce-' + type + '-fields').find('input[name^= "' + type + '_city"]')
                                .autocomplete({
                                    /*source: search_city,*/
                                    minLength: 3,
                                    scroll: true,
                                    source: function (req, responseFn) {
                                        var re = $.ui.autocomplete.escapeRegex(req.term);
                                        var matcher = new RegExp("^" + re, "i");
                                        var a = jQuery.grep(search_city, function (item, index) {
                                            return matcher.test(item);
                                        });
                                        responseFn(a);
                                    },
                                    search: function (event, ui) {
                                        /* open initializer */
                                        jQuery('.woocommerce-' + type + '-fields .ui-autocomplete').css('display', 'none');
                                        jQuery('.woocommerce-' + type + '-fields #aramex_loader').css('display', 'block');
                                    },
                                    response: function (event, ui) {
                                        var temp_arr = [];
                                        jQuery(ui.content).each(function (i, v) {
                                            temp_arr.push(v.value);
                                        });
                                        jQuery('.woocommerce-' + type + '-fields #aramex_loader').css('display', 'none');
                                        return temp_arr;
                                    }
                                });
                        }

                        function getAllCitiesJson(type, aramexCitiesObj) {
                            var country_code = jQuery('.woocommerce-' + type + '-fields').find('select[name^= "' + type + '_country"]').val();
                            var url_check = "<?php echo esc_js(esc_url(WP_PLUGIN_URL . '/aramex-shipping/includes/apilocationvalidator/class-aramex-woocommerce-serchautocities.php?')); ?>country_code=" + country_code + "&security=<?php echo $ajax_nonce_serchautocities; ?>";
                            aramexCitiesObj.autocomplete("option", "source", url_check);
                        }

                        /* make validation */
                        bindIvents(type, button);

                        function bindIvents(type, button) {
                            /*кількість привязок має бути рівна кількості (chk_region_id == '' || chk_city == '' || chk_postcode == '') шоб небуло зациклення*/
                            jQuery('.woocommerce-' + type + '-fields').find('input[name^= "' + type + '_city"]').blur(function () {
                                addressApiValidation(type, button);
                            });

                            jQuery('.woocommerce-' + type + '-fields').find('input[name^= "' + type + '_state"]').blur(function () {
                                addressApiValidation(type, button);
                            });
                            jQuery('.woocommerce-' + type + '-fields').find('input[name^= "' + type + '_postcode"]').blur(function () {
                                addressApiValidation(type, button);
                            });

                        }

                        function addressApiValidation(type, button) {

                            var chk_city = jQuery('.woocommerce-' + type + '-fields').find('input[name^= "' + type + '_city"]').val();
                            var chk_region_id = jQuery('.woocommerce-' + type + '-fields').find('input[name^= "' + type + '_state"]').val();
                            var chk_postcode = jQuery('.woocommerce-' + type + '-fields').find('input[name^= "' + type + '_postcode"]').val();
                            var country_code = jQuery('.woocommerce-' + type + '-fields').find('select[name^= "' + type + '_country"]').val();
                            if (chk_region_id == '' || chk_city == '' || chk_postcode == '') {
                                return false;
                            } else {
                                jQuery(button).prop("disabled", true);
                                jQuery(button).button('loading');
                                jQuery.ajax({

                                    url: "<?php echo esc_js(esc_url(WP_PLUGIN_URL . '/aramex-shipping/includes/apilocationvalidator/class-aramex-woocommerce-applyvalidation.php?')); ?>",
                                    data: {
                                        city: chk_city,
                                        post_code: chk_postcode,
                                        country_code: country_code,
                                        security: '<?php echo esc_html($ajax_nonce_applyvalidation); ?>',
                                    },
                                    type: 'Post',
                                    success: function (result) {
                                        var response = JSON.parse(result);
                                        if (!(response.suggestedAddresses) && response.message != '' && response.message !== undefined) {
                                            if (response.message.indexOf("City") != -1) {
                                                if (jQuery('.woocommerce-' + type + '-fields').find('input[name^= "' + type + '_city"]').val() != "") {
                                                    if (response.message !== undefined) {
                                                        alert(response.message);
                                                    }
                                                }
                                                jQuery('.woocommerce-' + type + '-fields').find('input[name^= "' + type + '_city"]').val("");
                                            }
                                            if (response.message.indexOf("zip") != -1) {
                                                if (jQuery('.woocommerce-' + type + '-fields').find('input[name^= "' + type + '_postcode"]').val() != "") {
                                                    if (response.message !== undefined) {
                                                        alert(response.message);
                                                    }
                                                }
                                                jQuery('.woocommerce-' + type + '-fields').find('input[name^= "' + type + '_postcode"]').val("");
                                            }
                                        } else if (response.suggestedAddresses) {
                                            //response.suggestedAddresses.City
                                            jQuery('.woocommerce-' + type + '-fields').find('input[name^= "' + type + '_city"]').val("");

                                        }
                                        jQuery(button).prop("disabled", false);
                                        jQuery(button).button('reset');
                                    }
                                })
                            }
                        }
                    }
                });
            })(jQuery);
        </script>
        <style>
            #aramex_loader {
                background-image: url(<?php echo WP_PLUGIN_URL . '/aramex-shipping/assets/img/aramex_loader.gif'; ?>);
            }

            .ui-autocomplete {
                max-height: 200px;
                overflow-y: auto;
                /* prevent horizontal scrollbar */
                overflow-x: hidden;
                /* add padding to account for vertical scrollbar */
            }

            .required-aramex:before {
                content: '* ' !important;
                color: #F00 !important;
                font-weight: bold !important;
            }
        </style>
    <?php 
    }
}

?>