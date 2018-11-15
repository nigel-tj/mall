<?php
/**
 * Plugin Name: TWP Shortcodes
 * Plugin URI: http://themes4wp.com/
 * Description: Shortcodes generator for Themes4WP.com WooCommerce theme
 * Version: 1.0.10
 * Author: Themes4WP
 * Author URI: http://themes4wp.com/
 * Text Domain: twp-shortcodes 
 * License: GPL2
 */
if(!class_exists("TWP_Shortcodes"))
{
    /**
     * class:   TWP_Shortcodes
     * desc:    plugin class to allow reports be pulled from multipe GA accounts
     */
    class TWP_Shortcodes
    {
        /**
         * Created an instance of the TWP_Shortcodes class
         */
        public function __construct()
        {
                        
            add_action( 'plugins_loaded', array( $this, 'twp_shortcodes_constructor' ) );
            
        } // END public function __construct()
        
        function twp_shortcodes_constructor() {
        
          if( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
      			return;
      		}
                
          define( 'TS_SCG_PATH', plugin_dir_path( __FILE__ ) . 'ts-shortcode-generator' );
          define( 'TS_SCG_URL', plugins_url( 'ts-shortcode-generator', __FILE__ ) );
                    
          require_once( dirname(__FILE__) . '/ts-shortcode-generator/bootstrap.php' );
  
                  
          load_plugin_textdomain( 'twp-shortcodes', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
          
          if ( ! function_exists( 'is_plugin_active' ) ) {
             require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
          }
          
          if( class_exists( 'TS_Shortcode_Generator' ) ) {
          
            $template = require_once( dirname(__FILE__) . '/shortcodes-template.php' ); 
            
            new TS_Shortcode_Generator(array(
              'name' => 'twp_shortcode_generator',    // Unique ID of the instance
              'title' => __( 'Themes4WP shortcode generator', 'twp-shortcodes' ),    // Title of the popup window
              'author' => 'Themes4WP',     // TinyMCE plugin author
              'website' => 'http://themes4wp.com/',     // TinyMCE plugin author website
              'icon' => plugins_url( 'ts-shortcode-generator/assets/img/icons/default.png', __FILE__ ),     // TinyMCE plugin icon. Must use a file path on server not a URI
              'version' => 1.0,     // TinyMCE plugin version. Not so necessary
              'template' => $template,     // Shortcode template array
            ));
          
          }
          
        }
        
        /**
         * Hook into the WordPress activate hook
         */
        public static function activate()
        {
            // Do something
        }
        
        /**
         * Hook into the WordPress deactivate hook
         */
        public static function deactivate()
        {
            // Do something
        }
        
    } // END class TWP_Shortcodes
} // END if(!class_exists("TWP_Shortcodes"))

if( ! function_exists( 'twp_install' ) ) {
    function twp_install() {

        if ( ! function_exists( 'is_plugin_active' ) ) {
            require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        }

        if ( ! function_exists( 'WC' ) ) {
            add_action( 'admin_notices', 'twp_install_woocommerce_admin_notice' );
        }
    }
}

add_action( 'plugins_loaded', 'twp_install', 11 );

if( ! function_exists( 'twp_install_woocommerce_admin_notice' ) ) {
    function twp_install_woocommerce_admin_notice() {
        ?>
        <div class="error">
            <p><?php _e( 'TWP shortcodes are enabled but not effective. It requires WooCommerce in order to work.', 'twp-shortcodes' ); ?></p>
        </div>
    <?php
    }
}

if(class_exists('TWP_Shortcodes'))
{    
    // Installation and uninstallation hooks
    register_activation_hook(__FILE__, array('TWP_Shortcodes', 'activate'));
    register_deactivation_hook(__FILE__, array('TWP_Shortcodes', 'deactivate'));
    
    // instantiate the plugin class
    $plugin = new TWP_Shortcodes();
} // END if(class_exists('TWP_Shortcodes')
