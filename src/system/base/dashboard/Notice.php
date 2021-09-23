<?php 

namespace QS_Paddle_Integration\system\base\dashboard;

Class Notice {
  
 
  private $notice_url = '#';
  // The constructor is private
  // to prevent initiation with outer code.
  public function register()
  {
      
      /*----------------------------------
        Check for required PHP version
      -----------------------------------*/
      if ( !class_exists( 'WooCommerce' ) ) {
        add_action( 'admin_notices', [ $this, 'admin_notice_woocommerce_install' ] );
        return false;
      }

      if ( ! did_action( 'elementor/loaded' ) ) {
			
        add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
        return false;
      }

     
 
  }
  /**************************
	 * 	MISSING NOTICE
	 ***************************/
	public function admin_notice_missing_main_plugin() {

		$product_name = qs_paddle_intregration_app_config()->all()['app']['product_name'];
		$con = esc_html__( 'Click to Install', 'qs-paddle-integration');
	
		if( file_exists(WP_PLUGIN_DIR .'/elementor/elementor.php' ) ) {
	
			$er_url = qs_paddle_intregration_plugin_activation_link_url('elementor/elementor.php');
			$con = esc_html__( 'Click to Activate', 'qs-paddle-integration');
			
		}else{

			$con    = esc_html__( 'Click to Install ', 'qs-paddle-integration');
			$action = 'install-plugin';
			$slug   = 'elementor';

			$er_url = wp_nonce_url(
				add_query_arg(
					array(
						'action' => $action,
						'plugin' => $slug
					),
					admin_url( 'update.php' )
				),
				$action.'_'.$slug
			);
		}
		
           

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		if ( in_array( 'elementor/elementor.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			$message = sprintf(
				esc_html__( '"%1$s" requires "%2$s"', 'qs-paddle-integration' ),
				'<strong>' .$product_name . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'qs-paddle-integration' ) . '</strong>'
			);
		}else{

			$message = sprintf(
				esc_html__( '"%1$s" requires "%2$s" %3$s', 'qs-paddle-integration' ),
				'<strong>' . $product_name . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'qs-paddle-integration' ) . '</strong>',
				'<strong> <a href="'.$er_url.'">' . $con  . '</a></strong>'
				
			);
		}
	

		printf( '<div class="notice qs-paddle-intregration-notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

		unset($product_name);
		unset($er_url);
		unset($con);
		unset($message);
	}
	public function admin_notice_woocommerce_install() {

		$product_name = qs_paddle_intregration_app_config()->all()['app']['product_name'];
		$con = esc_html__( 'Click to Install', 'qs-paddle-integration');
	
		if( file_exists(WP_PLUGIN_DIR .'/woocommerce/woocommerce.php' ) ) {
	
			$er_url = qs_paddle_intregration_plugin_activation_link_url();
			$con = esc_html__( 'Click to Activate', 'qs-paddle-integration');
			
		}else{

			$con    = esc_html__( ' Click to Install ', 'qs-paddle-integration');
			$action = 'install-plugin';
			$slug   = 'woocommerce';

			$er_url = wp_nonce_url(
				add_query_arg(
					array(
						'action' => $action,
						'plugin' => $slug
					),
					admin_url( 'update.php' )
				),
				$action.'_'.$slug
			);
		}
		
           

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			$message = sprintf(
				esc_html__( '"%1$s" requires "%2$s"', 'qs-paddle-integration' ),
				'<strong>' .$product_name . '</strong>',
				'<strong>' . esc_html__( 'WooCommerce', 'qs-paddle-integration' ) . '</strong>'
			);
		}else{

			$message = sprintf(
				esc_html__( '"%1$s" requires "%2$s" %3$s', 'qs-paddle-integration' ),
				'<strong>' . $product_name . '</strong>',
				'<strong>' . esc_html__( 'WooCommerce', 'qs-paddle-integration' ) . '</strong>',
				'<strong> <a href="'.$er_url.'">' . $con  . '</a></strong>'
				
			);
		}
	

		printf( '<div class="notice qs-paddle-intregration-notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

		unset($product_name);
		unset($er_url);
		unset($con);
		unset($message);

	}

}

