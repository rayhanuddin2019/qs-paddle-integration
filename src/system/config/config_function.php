<?php 
use Illuminate\Config\Repository as QS_Paddle_Intregration;
/*
** All Config file access
** Use this file anywhere of this plugin
*/
function qs_paddle_intregration_app_config(){
	// memoization cache
	static $qs_paddle_intregration_gl_config = null;
    if(is_null($qs_paddle_intregration_gl_config)) {
	    $qs_paddle_intregration_gl_config = new QS_Paddle_Intregration(require QS_PADDLE_INTEGRATION_DIR_PATH . 'src/system/config/app.php');
    }
   
	return $qs_paddle_intregration_gl_config;
}




/**
** qs_paddle_integration_sysytem_module_options
** Use this file anywhere of this plugin
*  @version 1.0
*/
function qs_paddle_intregration_sysytem_module_options_is_active($key= null){

	$option = get_option('qs_paddle_intregration_modules') ? get_option('qs_paddle_intregration_modules') : [];

	if(isset( $option[$key] )){
		return true;
	}

	return false;
}

function qs_paddle_intregration_sysytem_api_options_is_active($key= null){

	$option = get_option('qs_paddle_intregration_data_api') ? get_option('qs_paddle_intregration_data_api') : [];

	if(isset( $option[$key] ) && $option[$key] !=''){
		return $option[$key];
	}

	return false;
}


/*
** All Base css js Config file access
** Use this file anywhere of this plugin
*/
function qs_paddle_intregration_assets_config(){
	// memoization cache
	static $qs_paddle_intregration_asset_config = null;
    if(is_null($qs_paddle_intregration_asset_config)) {
	    $qs_paddle_intregration_asset_config = new QS_Paddle_Intregration(require QS_PADDLE_INTEGRATION_DIR_PATH . 'src/system/config/assets.php');
    }
   
	return $qs_paddle_intregration_asset_config;
}

/*
** All Base Dashboard  Settings
** Use this file anywhere of this plugin
*/
function qs_paddle_intregration_dashboard_config(){
	// memoization cache
	static $qs_paddle_intregration_dashboard_config = null;
    if(is_null($qs_paddle_intregration_dashboard_config)) {
	    $qs_paddle_intregration_dashboard_config = new QS_Paddle_Intregration(require QS_PADDLE_INTEGRATION_DIR_PATH . 'src/system/config/dashboard/tabs.php');
    }
   
	return apply_filters('qs_paddle_intregration_dashboard_config',$qs_paddle_intregration_dashboard_config);
}

/*
** All Base widgets Settings
** Use this file anywhere of this plugin
*/
function qs_paddle_intregration_widgets_config(){

	// memoization cache
	static $qs_paddle_intregration_widgets_config = null;
  
	if(is_null($qs_paddle_intregration_widgets_config)) {

		$qs_paddle_intregration_widgets_config = new QS_Paddle_Intregration(require QS_PADDLE_INTEGRATION_DIR_PATH . 'src/system/config/dashboard/widgets.php');
		
		
	}
  	
	return apply_filters('qs_paddle_intregration_system_widgets_config',$qs_paddle_intregration_widgets_config);
}

/*
** All Base moudles Settings
** Use this file anywhere of this plugin
*/
function qs_paddle_intregration_modules_config(){
	// memoization cache
	static $qs_paddle_intregration_modules_config = null;
    if(is_null($qs_paddle_intregration_modules_config)) {
	
	  $qs_paddle_intregration_modules_config = new QS_Paddle_Intregration(require QS_PADDLE_INTEGRATION_DIR_PATH . 'src/system/config/dashboard/modules.php');
		   
    }
   
	return apply_filters('qs_paddle_intregration_system_modules_config',$qs_paddle_intregration_modules_config);
}


/*
** All Base api Settings
** Use this file anywhere of this plugin
*/

function qs_paddle_intregration_api_config(){
	// memoization cache
	static $qs_paddle_intregration_api_config = null;
    if(is_null($qs_paddle_intregration_api_config)) {

		$qs_paddle_intregration_api        = new QS_Paddle_Intregration(require QS_PADDLE_INTEGRATION_DIR_PATH . 'src/system/config/dashboard/api.php');
		$db_data 			   = get_option( 'qs_paddle_intregration_data_api' ) ? get_option( 'qs_paddle_intregration_data_api' ) : [];
		$shop_api_old          = array_merge( $qs_paddle_intregration_api->all() , $db_data );
		$qs_paddle_intregration_api_config = new QS_Paddle_Intregration($shop_api_old);
	
     }
   
	return apply_filters('qs_paddle_intregration_api_config',$qs_paddle_intregration_api_config);
}

if(!function_exists('qs_paddle_intregration_system_db_option_config')){

	function qs_paddle_intregration_system_db_option_config(){
		// widget drectoryname+filename
		// memoization cache
		static $qs_paddle_intregration_system_db_option_config = null;
		if(is_null($qs_paddle_intregration_system_db_option_config)) {
			
			$qs_paddle_ready_ele = new QS_Paddle_Intregration(require QS_PADDLE_INTEGRATION_DIR_PATH . 'src/system/config/dashboard/modules.php');
			$db_opt 				= get_option('qs_paddle_intregration_modules') ? get_option('qs_paddle_intregration_modules') : [];
			$shop_wd_old 			= $qs_paddle_ready_ele->all();
		   
			if( is_array( $db_opt ) ){

				foreach( $db_opt as $key => $opt ){
					
					if(isset($shop_wd_old[$key])){
						$shop_wd_old[$key]['is_pro'] = false;
					}
				}

			}

			$qs_paddle_intregration_system_db_option_config = new QS_Paddle_Intregration($shop_wd_old);
		}
	   
		return $qs_paddle_intregration_system_db_option_config;
	}
	
}








