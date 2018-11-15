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

return array(
    'enabled' => array(
        'title' => __('Enable', 'aramex'),
        'type' => 'checkbox',
        'description' => __('Enable Aramex shipping', 'aramex'),
        'default' => 'yes'
    ),
    'title' => array(
        'title' => __('Title', 'aramex'),
        'type' => 'text',
        'description' => __('Title to be display on site', 'aramex'),
        'default' => __('Aramex Shipping', 'aramex')
    ),

    'freight' => array(
        'title' => __('Client information', 'aramex'),
        'type' => 'title',
    ),
    'user_name' => array(
        'title' => __('* Email', 'aramex'),
        'type' => 'text',
    ),
    'password' => array(
        'title' => __('* Password', 'aramex'),
        'type' => 'password',
    ),
    'account_pin' => array(
        'title' => __('* Account Pin', 'aramex'),
        'type' => 'text',
    ),
    'account_number' => array(
        'title' => __('* Account Number', 'aramex'),
        'type' => 'text',
    ),
    'account_entity' => array(
        'title' => __('* Account Entity', 'aramex'),
        'type' => 'text',
    ),
    'account_country_code' => array(
        'title' => __('* Account Country Code', 'aramex'),
        'type' => 'text',
    ),
    'allowed_cod' => array(
        'title' => __('COD Account', 'aramex'),
        'type' => 'select',
        'description' => __('Optional account data', 'aramex'),
        'options' => array(
            '0' => __('No', 'aramex'),
            '1' => __('Yes', 'aramex'),
        )
    ),
    'cod_account_number' => array(
        'title' => __('COD Account Number', 'aramex'),
        'type' => 'text',
        'description' => __('Optional account data', 'aramex'),
    ),
    'cod_account_pin' => array(
        'title' => __('COD Account Pin', 'aramex'),
        'type' => 'text',
        'description' => __('Optional account data', 'aramex'),
    ),
    'cod_account_entity' => array(
        'title' => __('COD Account Entity', 'aramex'),
        'type' => 'text',
        'description' => __('Optional account data', 'aramex'),
    ),
    'cod_account_country_code' => array(
        'title' => __('COD Account Country Code', 'aramex'),
        'type' => 'text',
        'description' => __('Optional account data', 'aramex'),
    ),
    'freight1' => array(
        'title' => __('Service Configuration', 'aramex'),
        'type' => 'title',
    ),
    'sandbox_flag' => array(
        'title' => __('Test Mode', 'aramex'),
        'type' => 'select',
        'options' => array(
            '1' => __('Yes', 'aramex'),
            '0' => __('No', 'aramex'),
        )
    ),
    'report_id' => array(
        'title' => __('Report ID', 'aramex'),
        'type' => 'text',
    ),
    'allowed_domestic_methods' => array(
        'title' => __('Allowed Domestic Methods', 'aramex'),
        'type' => 'multiselect',
        'css' => 'width: 350px;',
        'options' => array(
            'BLK' => __('Special: Bulk Mail Delivery', 'aramex'),
            'BLT' => __('Domestic - Bullet Delivery', 'aramex'),
            'CDA' => __('Special Delivery', 'aramex'),
            'CDS' => __('Special: Credit Cards Delivery', 'aramex'),
            'CGO' => __('Air Cargo (India)', 'aramex'),
            'COM' => __('Special: Cheque Collection', 'aramex'),
            'DEC' => __('Special: Invoice Delivery', 'aramex'),
            'EMD' => __('Early Morning delivery', 'aramex'),
            'FIX' => __('Special: Bank Branches Run', 'aramex'),
            'LGS' => __('Logistic Shipment', 'aramex'),
            'OND' => __('Overnight (Document)', 'aramex'),
            'ONP' => __('Overnight (Parcel)', 'aramex'),
            'P24' => __('Road Freight 24 hours service', 'aramex'),
            'P48' => __('Road Freight 48 hours service', 'aramex'),
            'PEC' => __('Economy Delivery', 'aramex'),
            'PEX' => __('Road Express', 'aramex'),
            'SFC' => __('Surface  Cargo (India)', 'aramex'),
            'SMD' => __('Same Day (Document)', 'aramex'),
            'SMP' => __('Same Day (Parcel)', 'aramex'),
            'SPD' => __('Special: Legal Branches Mail Service', 'aramex'),
            'SPL' => __('Special : Legal Notifications Delivery', 'aramex'),
        )
    ),
    'allowed_domestic_additional_services' => array(
        'title' => __('Allowed Domestic Additional Services', 'aramex'),
        'type' => 'select',
        'css' => 'width: 350px;',
        'options' => array(
            'AM10' => __('Morning delivery', 'aramex'),
            'CHST' => __('Chain Stores Delivery', 'aramex'),
            'CODS' => __('Cash On Delivery Service', 'aramex'),
            'COMM' => __('Commercial', 'aramex'),
            'CRDT' => __('Credit Card', 'aramex'),
            'DDP' => __('DDP - Delivery Duty Paid - For European Use', 'aramex'),
            'DDU' => __('DDU - Delivery Duty Unpaid - For the European Freight', 'aramex'),
            'EXW' => __('Not An Aramex Customer - For European Freight', 'aramex'),
            'INSR' => __('Insurance', 'aramex'),
            'RTRN' => __('Return', 'aramex'),
            'SPCL' => __('Special Services', 'aramex'),
        )
    ),
    'allowed_international_methods' => array(
        'title' => __('Allowed International Methods', 'aramex'),
        'type' => 'multiselect',
        'css' => 'width: 350px;',
        'options' => array(
            'DPX' => __('Value Express Parcels', 'aramex'),
            'EDX' => __('Economy Document Express', 'aramex'),
            'EPX' => __('Economy Parcel Express', 'aramex'),
            'GDX' => __('Ground Document Express', 'aramex'),
            'GPX' => __('Ground Parcel Express', 'aramex'),
            'IBD' => __('International defered', 'aramex'),
            'PDX' => __('Priority Document Express', 'aramex'),
            'PLX' => __('Priority Letter Express (<.5 kg Docs)', 'aramex'),
            'PPX' => __('Priority Parcel Express', 'aramex'),
        )
    ),
    'allowed_international_additional_services' => array(
        'title' => __('Allowed International Additional Services', 'aramex'),
        'type' => 'select',
        'css' => 'width: 350px;',
        'options' => array(
            'AM10' => __('Morning delivery', 'aramex'),
            'CODS' => __('Cash On Delivery', 'aramex'),
            'CSTM' => __('CSTM', 'aramex'),
            'EUCO' => __('NULL', 'aramex'),
            'FDAC' => __('FDAC', 'aramex'),
            'FRDM' => __('FRDM', 'aramex'),
            'INSR' => __('Insurance', 'aramex'),
            'NOON' => __('Noon Delivery', 'aramex'),
            'ODDS' => __('Over Size', 'aramex'),
            'RTRN' => __('RTRN', 'aramex'),
            'SIGR' => __('Signature Required', 'aramex'),
            'SPCL' => __('Special Services', 'aramex'),
        )
    ),
    'freight2' => array(
        'title' => __('Shipper Details', 'aramex'),
        'type' => 'title',
    ),
    'name' => array(
        'title' => __('Name', 'aramex'),
        'type' => 'text',
    ),
    'email_origin' => array(
        'title' => __('Email', 'aramex'),
        'type' => 'text',
    ),
    'company' => array(
        'title' => __('Company', 'aramex'),
        'type' => 'text',
    ),
    'address' => array(
        'title' => __('Address', 'aramex'),
        'type' => 'text',
    ),
    'country' => array(
        'title' => __('* Country Code', 'aramex'),
        'type' => 'text',
    ),
    'city' => array(
        'title' => __('* City', 'aramex'),
        'type' => 'text',
    ),
    'postalcode' => array(
        'title' => __('* Postal Code', 'aramex'),
        'type' => 'text',
    ),
    'state' => array(
        'title' => __('State', 'aramex'),
        'type' => 'text',
    ),
    'phone' => array(
        'title' => __('Phone', 'aramex'),
        'type' => 'text',
    ),
    'freight3' => array(
        'title' => __('Shipment Email Template', 'aramex'),
        'type' => 'title',
    ),
    'copy_to' => array(
        'title' => __('Shipment Email Copy To', 'aramex'),
        'type' => 'text',
    ),
    'copy_method' => array(
        'title' => __('Shipment Email Copy Method', 'aramex'),
        'type' => 'select',
        'options' => array(
            '1' => __('BBC', 'aramex'),
            '0' => __('Separate Email', 'aramex'),
        )
    ),
    'freight4' => array(
        'title' => __('Api Location Validator', 'aramex'),
        'type' => 'title',
    ),
    'apilocationvalidator_active' => array(
        'title' => __('Enabled', 'aramex'),
        'type' => 'select',
        'options' => array(
            '0' => __('No', 'aramex'),
            '1' => __('Yes', 'aramex'),
        )
    ),
    'freight5' => array(
        'title' => __('Front End Calculator', 'aramex'),
        'type' => 'title',
    ),
    'aramexcalculator' => array(
        'title' => __('Enabled', 'aramex'),
        'type' => 'select',
        'options' => array(
            '0' => __('No', 'aramex'),
            '1' => __('Yes', 'aramex'),
        )
    ),
    'freight6' => array(
        'title' => __('Hide shipping product type on Checkout page', 'aramex'),
        'type' => 'title',
    ),
    'hide_shipping_product' => array(
        'title' => __('Enabled', 'aramex'),
        'type' => 'select',
        'options' => array(
            '0' => __('No', 'aramex'),
            '1' => __('Yes', 'aramex'),
        )
    ),
     'freight7' => array(
        'title' => __('Rate calculator on Checkout page', 'aramex'),
        'type' => 'title',
    ),
    'rate_calculator_checkout_page' => array(
        'title' => __('Enabled', 'aramex'),
        'type' => 'select',
        'options' => array(
            '1' => __('Yes', 'aramex'),
            '0' => __('No', 'aramex'),
        )
    ),
);
