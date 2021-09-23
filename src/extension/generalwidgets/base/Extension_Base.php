<?php

namespace QS_Paddle_Integration\extension\generalwidgets\base;

use QS_Paddle_Integration\base\elementor\Boot as QS_Ready_Boot;
use QS_Paddle_Integration\extension\generalwidgets\base\Widgets_Settings as Widgets_Settings;
use QS_Paddle_Integration\extension\generalwidgets\deps\Checkout as Checkout;
/**
* @since 1.0
* Elementor Extension Boot Base
*/
Abstract Class Extension_Base extends QS_Ready_Boot{
   

    /****************************
	 * 	INIT WIDGETS
	 ****************************/
	public function init_widgets() {
		$this->_widgets();
	}

	public static function get_base(){

		return [
			Widgets_Settings::class
		];
	}

	public static function get_defs(){

		return [
			Checkout::class
		];
	}

	/** 
	* Elementor Editor Page | Site Document Settings
	* https://developers.elementor.com/elementor-document-settings/
	* @return array class
	*/
	public static function document(){
        
		$settings = [];
     	return $settings;
	}

    
   /****************************
	 * 	Register Widgets
	 ****************************/
	public function _widgets(){

     	/*
		** Autoload Widget class
		** 
		*/
	
        $modules = qs_paddle_intregration_widgets_class_dir_list( QS_PADDLE_INTEGRATION_DIR_PATH.'src/extension/generalwidgets/widgets' );
		
		 if( is_array( $modules ) ){
	
			foreach($modules as $module=> $item){
				
				if( is_array( $item )){
                  
                   foreach($item as $widget_file){
                   
                     $cls = '\QS_Paddle_Integration\extension\generalwidgets\widgets\\'.$module.'\\'.$widget_file;
					
                   	 if( class_exists( $cls ) && get_parent_class($cls) == 'QS_Paddle_Integration\extension\generalwidgets\Widget_Base' ):
						\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $cls() );
                     endif;
                       
                   }
                }
					
			}
		}
      

	}


    /*******************************
	 * 	ADD CUSTOM CATEGORY
	 *******************************/
	public function add_elementor_category()
	{

		
		$category_list = qs_paddle_intregration_genwidget_meta_config()->all();
		$categories    = $category_list['categories'];
      
		if( is_array( $categories ) ) {
			
			foreach( $categories as $slug => $item ){
				
				\Elementor\Plugin::instance()->elements_manager->add_category( $slug , array(
					'title' => $item['name'],
					'icon'  => isset($item['name']) ? $item['name']: ' eicon-pro-icon',
				), 1 );
	
			} 

		}
		
	}
    

 
}