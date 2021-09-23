<?php
namespace QS_Paddle_Integration\system\base;

/*
* Wordpress Default Plugin Action
* Will Show In Plugin list
*/
class Meta {

    /*
    * Register 
    * return void
    */
    public function register() {
     
      
        add_filter( 'plugin_action_links_'.QS_PADDLE_INTEGRATION_PLUGIN_BASE, [ $this ,'add_plugin_page_settings_link'] );
    }

    function add_plugin_page_settings_link( $links ) {
	
        $links[] = '<a href="' .
            admin_url( 'admin.php?page='.QS_PADDLE_INTEGRATION_SETTING_PATH ) .
            '">' . esc_html__('Settings','qs-paddle-integration') . '</a>';
       return $links;
    
    }
 

    
}    