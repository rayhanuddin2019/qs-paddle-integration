<?php 

namespace QS_Paddle_Integration\base\elementor;

/******************* **********
* Register all elementor boot
* register widget control type
* @since 1.0 
************************* ***************/
 
Abstract Class Boot {

    use \QS_Paddle_Integration\base\config\App;

	const VERSION                   = QS_PADDLE_INTEGRATION_VERSION;
	const MINIMUM_ELEMENTOR_VERSION = '3.4';
	const MINIMUM_PHP_VERSION       = '5.6';

	abstract protected function init_widgets();
	/***************************
	 * 	VERSION CHECK
	 * *************************/
	public function admin_notice_minimum_elementor_version() {
        

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
		$product_name = self::get_app_config()->all()['app']['product_name'];
		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'qs-paddle-integration' ),
			'<strong>' . $product_name  . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'qs-paddle-integration' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice qs-paddle-intregration-notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		unset($product_name);
	}



	/****************************
	 * 	PHP VERSION NOTICE
	 ****************************/
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
		$product_name = self::get_app_config()->all()['app']['product_name'];
		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'qs-paddle-integration' ),
			'<strong>' . $product_name . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'qs-paddle-integration' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice qs-paddle-intregration-notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}
	


	public function is_compatible() {

		
		/*---------------------------------
			Check if Elementor installed and activated
		-----------------------------------*/
		if ( ! did_action( 'elementor/loaded' ) ) {
			return;
		}	
 		/*----------------------------------
			Check for required PHP version
      -----------------------------------*/
      if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
        add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
        return false;
      }
		/*---------------------------------
			Check for required Elementor version
		----------------------------------*/
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
		
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return false;
		}

		
		return true;

	}

	function plugin_notice_assets(){
		wp_enqueue_style('shop-ready-admin-notice');
	}

	public function init_controls() {
	    
		\Elementor\Plugin::$instance->controls_manager->register_control( 'wrradioimage', new controls\Radio_Choose() );

	}

    
}