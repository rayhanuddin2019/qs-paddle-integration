<?php 
namespace QS_Paddle_Integration\system\base\dashboard;

Class Page {
  

  
    public function register(){
     
         add_action( 'admin_enqueue_scripts' , [ $this,'add_admin_scripts'] );
         add_action( 'admin_menu' , [ $this,'dashboard_menu_page'] );
         add_action( 'network_admin_menu' , [ $this,'dashboard_menu_page'] );
      
    }

    public function add_admin_scripts($handle){
      
      
        if( $handle == 'toplevel_page_'.QS_PADDLE_INTEGRATION_SETTING_PATH ) {
          
            wp_enqueue_style('qs-paddle-intregration-admin-base');
            wp_enqueue_style('qs-paddle-intregration-admin-grid');
      
        }
    }
   
    public function dashboard_content(){
       
        require_once( __DIR__ . '/views/dashboard.php' );
    }

    function dashboard_menu_page() {
        
        if(!current_user_can( 'edit_users' )){
          return;
        }

        add_menu_page( 
            esc_html__( 'QS Paddle Integration' , 'qs-paddle-integration' ),
            esc_html__( 'Paddle Integration' , 'qs-paddle-integration' ),
            'manage_options',
            QS_PADDLE_INTEGRATION_SETTING_PATH,
            [$this,'dashboard_content'],
            //QS_PADDLE_INTEGRATION_PUBLIC_ROOT_IMG . 'logo.jpg',
            'dashicons-products',
            4
        ); 

       
    
    }

   

}

