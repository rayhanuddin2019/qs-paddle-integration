<?php
/**
 * Plugin Name: Paddle Integration - WooCommerce and Elementor Addon
 * Description: Paddle integration with elementor Price widget
 * Plugin URI: 	https://github.com/quomodosoftbd
 * Version: 	1.1
 * Author: 		quomodosoftbd
 * Author URI: 	https://github.com/quomodosoftbd
 * License:  	apache-2.0+
 * License URI: http://www.apache.org/licenses/LICENSE-2.0
 * Text Domain: qs-paddle-intregration
 * Domain Path: /languages
 * 
*/


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


if (defined('QS_PADDLE_INTEGRATION')) {
	/**
	 * The plugin was already loaded (maybe as another plugin with different directory name)
	 */
} else {

        require __DIR__.'/vendor/autoload.php';

        /*
        **
        *** 
        *** 1. Used for security
        *** 2. Used to help know where we am on the filesystem.
        *** 
        **
        */
        define( 'QS_PADDLE_INTEGRATION', true );
        define( 'QS_PADDLE_INTEGRATION_VERSION', '1.1' );
        define( 'QS_PADDLE_INTEGRATION_LITE', true );
        define( 'QS_PADDLE_INTEGRATION_ROOT', __FILE__ );
        define( 'QS_PADDLE_INTEGRATION_URL', plugins_url( '/', QS_PADDLE_INTEGRATION_ROOT ) );
        define( 'QS_PADDLE_INTEGRATION_DIR_PATH', plugin_dir_path( QS_PADDLE_INTEGRATION_ROOT ) );
        define( 'QS_PADDLE_INTEGRATION_ADDONS_DIR_URL', QS_PADDLE_INTEGRATION_URL.'src/extension' );
        define( 'QS_PADDLE_INTEGRATION_ADDONS_DIR_PATH', QS_PADDLE_INTEGRATION_DIR_PATH.'src/extension' );
        define( 'QS_PADDLE_INTEGRATION_PLUGIN_BASE', plugin_basename( QS_PADDLE_INTEGRATION_ROOT ) );
        define( 'QS_PADDLE_INTEGRATION_ITEM_NAME', esc_html__('QS Paddle Integration','qs-paddle-integration') );
        define( 'QS_PADDLE_INTEGRATION_PUBLIC_ROOT_IMG', QS_PADDLE_INTEGRATION_URL.'assets/public/images/' );
        define( 'QS_PADDLE_INTEGRATION_PUBLIC_ROOT_JS', QS_PADDLE_INTEGRATION_URL.'assets/public/js/' );
        define( 'QS_PADDLE_INTEGRATION_PUBLIC_ROOT_CSS', QS_PADDLE_INTEGRATION_URL.'assets/public/css/' );
        define( 'QS_PADDLE_INTEGRATION_DEMO_URL', '#' );
        define( 'QS_PADDLE_INTEGRATION_SETTING_PATH', 'qs-paddle-integration-dashboard' );

        /*
        ****
        ***** Now lets include the bootloader file
        ****
        */

        add_action('plugins_loaded', 'qs_paddle_intregration_action_init_src',100);

        function qs_paddle_intregration_action_init_src(){

            do_action('qs_paddle_intregration_before_bootstrap');
       
        
            require QS_PADDLE_INTEGRATION_DIR_PATH .'/src/system/boot.php';
            require QS_PADDLE_INTEGRATION_DIR_PATH .'/src/extension/init.php';
    
            
            do_action('qs_paddle_intregration_after_bootstrap');
        }

        register_activation_hook(__FILE__,function(){
            update_option( 'qs_paddle_intregration_qs_version', QS_PADDLE_INTEGRATION_VERSION );
        } ); 
}

