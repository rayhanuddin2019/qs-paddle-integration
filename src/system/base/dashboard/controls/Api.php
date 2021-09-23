<?php

namespace QS_Paddle_Integration\system\base\dashboard\controls;
use Illuminate\Support\MessageBag as QSMessageBag;

class Api{
  
    public $action_key        = 'qs_paddle_intregration_data_api_options';
    public $option_key        = 'qs_paddle_intregration_data_api';
    public $nonce             = '_qs_paddle_intregration_data_api';
    public $option_switch_key = 'qs_paddle_intregration_data_api_switch';

    public $transform_apis = [];

    public function register(){
        
       add_action( 'admin_post_'.$this->action_key , [ $this,'_qs_paddle_intregration_data_api_options'] ); 
       add_action( 'qs_paddle_intregration_admin_message', [ $this ,'admin_notice__success' ],20 );
    }
   
    function admin_notice__success() {
       
        if ( isset($_SESSION['qs_paddle_intregration_dash_message'])  ) {
       
        ?>

            <div class='notice notice-success is-dismissible'>
                <p><?php echo esc_html($_SESSION['qs_paddle_intregration_dash_message']); ?></p>
            </div>

        <?php
        
        }

        unset($_SESSION['qs_paddle_intregration_dash_message']);
    }

    function _qs_paddle_intregration_data_api_options(){
      
        // Verify if the nonce is valid
        if ( !isset($_POST[$this->nonce]) || !wp_verify_nonce($_POST[$this->nonce], $this->action_key) ) {
            wp_redirect($_SERVER[ 'HTTP_REFERER' ]);
        }
       
        if( !array_key_exists($this->option_key,$_POST) ){
            $_SESSION['qs_paddle_intregration_dash_message'] = esc_html__('Somethings Wrong','qs-paddle-integration');
            wp_redirect( $_SERVER[ 'HTTP_REFERER' ] ); 
            return;
        }
        
      
        $this->transform_data_api_options();
       
        
        $this->_parsist();
       
        if ( wp_doing_ajax() ){
            wp_die();
        }else{

            $url        = $_SERVER["HTTP_REFERER"];
            $return_url = add_query_arg( array(
                'nav' => $this->option_key,
            ), $url );
  
            $_SESSION['qs_paddle_intregration_dash_message'] = esc_html__('Data Api Settings Saveed','qs-paddle-integration');
            wp_redirect($return_url);
        }
        
    } 

    function transform_data_api_options(){
 
        $new_array = [];
       
        $templates = qs_paddle_intregration_api_config()->all();
        $user_data = $_REQUEST[$this->option_key];
        
        foreach( $templates as $key => $item ){

            if( isset($user_data[ $key ] ) ){
                $item['default'] = $user_data[ $key ];
            }else{
                $item['default'] = '';
            }
            
           $new_array[$key] = $item;
        }

        $this->transform_apis = $new_array; 

        unset( $new_array );
        unset( $templates );
        unset( $user_data );

    }

 

    public function _parsist(){

        update_option($this->option_key , $this->transform_apis );
    }
  
}