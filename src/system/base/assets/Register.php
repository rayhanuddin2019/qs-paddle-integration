<?php 

namespace QS_Paddle_Integration\system\base\assets;

use Automattic\Jetpack\Constants;
/*
* Register Base js and css
* @since 1.0 
*/

Class Register extends Assets {

    public function register(){
       
        // public
        add_action( 'wp_enqueue_scripts', [ $this , 'register_public_js' ] );
        add_action( 'wp_enqueue_scripts', [ $this , 'register_public_css' ] );
        // admin
        add_action( 'admin_enqueue_scripts', [ $this , 'register_css' ] );
        add_action( 'admin_enqueue_scripts', [ $this , 'register_js' ] );
    }
   /*
   * Register css and js
   */ 
   public function register_css(){
   
        if( function_exists( 'qs_paddle_intregration_assets_config' ) ){

            $data = qs_paddle_intregration_assets_config();

            if( isset( $data['css'] ) ) {

                foreach( $data['css'] as $css ) {

                    if( file_exists( $css[ 'file' ] ) && !$css['public'] ) {
                        $media = isset($css['media'])?$css['media']:'all';
                      
                        wp_register_style( str_replace( ['_'] , ['-'] , $css[ 'handle_name' ] ) , $css['src'] , $css['deps'] , filemtime( $css['file'] ), $media );
                
                    }

                }

            }

            unset($data);

        }
   }
   /*
   * Register css and js
   * @since 1.0
   */ 
   public function register_public_css(){
   
    if( function_exists( 'qs_paddle_intregration_assets_config' ) ){

        $data = qs_paddle_intregration_assets_config();

        if( isset( $data['css'] ) ) {

            foreach( $data['css'] as $css ) {

                if( file_exists( $css[ 'file' ] ) && $css['public'] ) {
                    $media = isset($css['media'])?$css['media']:'all';
                  
                    wp_register_style( str_replace( ['_'] , ['-'] , $css[ 'handle_name' ] ) , $css['src'] , $css['deps'] , filemtime( $css['file'] ), $media );
            
                }

            }

        }

        unset($data);

    }
}

   /*
   * Register css and js
   */ 
   public function register_js(){

       
        if( function_exists( 'qs_paddle_intregration_assets_config' ) ){

            $data = qs_paddle_intregration_assets_config();

            if( isset( $data['js'] ) ) {

                foreach( $data['js'] as $js ) {
                  
                    if(file_exists($js['file']) && !$js['public'] ) {

                         wp_register_script( str_replace( ['_'] , ['-'] , $js[ 'handle_name' ] ) , $js['src'] , $js['deps'] , filemtime( $js['file'] ), $js['in_footer'] );
                   
                    }

                }

            }

            unset($data);

        }

   }

   public function register_public_js(){
     
        if( function_exists( 'qs_paddle_intregration_assets_config' ) ){

            $data = qs_paddle_intregration_assets_config();

            if( isset( $data['js'] ) ) {

                foreach( $data['js'] as $js ) {
                
                    if(file_exists($js['file']) && $js['public'] ) {

                        wp_register_script( str_replace( ['_'] , ['-'] , $js[ 'handle_name' ] ) , $js['src'] , $js['deps'] , filemtime( $js['file'] ), $js['in_footer'] );
                
                    }

                }

            }
             
            wp_localize_script('paddle-bootstrap', 'paddle_data', $this->get_api_settings());
            unset($data);

        }
        
       

    }

    public function get_api_settings(){

       $data =  qs_paddle_intregration_api_config()->all();

       $paddle_data = array(
            'ajax_url'         => admin_url( 'admin-ajax.php' ),
            'vendor_auth_code' => '',
            'vendor_id'        => '',
            'product_id'       => '',                             // elements ready real id 644180 
            'user'             => '',
            'key'              => 'abe9c6fac7557d15d334d1679322f329'
        );

        if ( is_user_logged_in() ) {
            $paddle_data['user'] = wp_get_current_user();
        }

       return array_merge($paddle_data, wp_list_pluck($data,'default') );
    }

}