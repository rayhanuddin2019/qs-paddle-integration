<?php 
use Illuminate\Config\Repository as QS_Paddle_Intregration;
/*
** All Config file access
** Use this function only wpshortcode extension
*/

if(!function_exists('shop_ready_wpshortcode_config')){

	function shop_ready_wpshortcode_config(){
		// memoization cache
		static $mangocube_shortcode_config = null;
		if(is_null($mangocube_shortcode_config)) {
			$mangocube_shortcode_config = new QS_Paddle_Intregration(require QS_PADDLE_INTEGRATION_DIR_PATH . 'src/extension/wpshortcode/config/settings.php');
		}
	   
		return $mangocube_shortcode_config;
	}
	
}
