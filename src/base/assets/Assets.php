<?php 

namespace QS_Paddle_Integration\base\assets;
use QS_Paddle_Integration\system\base\assets\Assets as QS_Resource;

/*
* Register all widgets related js and css
* @since 1.0 
* $pagenow (string) used in wp-admin See also get_current_screen() for the WordPress Admin Screen API
* $post_type (string) used in wp-admin
* $allowedposttags (array)
* $allowedtags (array)
* $menu (array)
*/

Class Assets extends QS_Resource{
   
   public function register(){

    add_action( 'wp_enqueue_scripts' , [ $this,'enqueue_public_css' ], 10 );
    add_action( 'wp_enqueue_scripts' , [ $this,'enqueue_public_js' ], 100 );
    add_action( 'admin_enqueue_scripts' , [ $this,'enqueue_js' ], 10 );
    add_action( 'admin_enqueue_scripts' , [ $this,'enqueue_css' ], 10 );
    add_action( 'elementor/editor/after_enqueue_styles' , [ $this, 'qs_editor_styles' ] );

   }

   /*
   * Editor enqueue css
   */ 
  public function qs_editor_styles($hook){

     
    $public_css = [
        [
            'handle_name' => 'qs-paddle-integration-editor-style',
            'src'         => QS_PADDLE_INTEGRATION_URL.'assets/admin/css/editor.css',
            'file'        => QS_PADDLE_INTEGRATION_DIR_PATH.'assets/admin/css/editor.css',
            'minimize'    => false,
            'editor'      => true,
            'media'       => 'all',
            'deps'        => [

            ]
        ]
    ];

    foreach($public_css as $css) {
      
        if( file_exists( $css[ 'file' ] ) && $css['editor'] ) {
           
            $media = isset($css['media'])?$css['media']:'all';
            wp_enqueue_style( str_replace( ['_'] , ['-'] , $css[ 'handle_name' ] ) , $css['src'] , $css['deps'] , filemtime( $css['file'] ), $media );
    
        }
    }

    unset($public_css);
 }

  /*
   * enqueue css
   */ 
  public function enqueue_public_css($hook){

   
        
    $public_css = [
        'qs-paddle-integration-public-base'
    ];

    foreach($public_css as $handle){
        wp_enqueue_style( str_replace(['_'],['-'],$handle ) );
    }

    unset($public_css);
 }

   /*
   * enqueue css and js
   */ 
   public function enqueue_css($hook){

            
        $admin_css = [
           
            'qs-paddle-integration-admin-notice'
        ];

        foreach($admin_css as $handle){
            wp_enqueue_style( str_replace(['_'],['-'],$handle ) );
        }

        unset($admin_css);
   }
   /*
   * push all admin enqueue 
   */
   public function enqueue_js($hook){

        $admin_js = [
            'qs-paddle-integration-admin-base'
        ];

        foreach($admin_js as $handle){
            wp_enqueue_script( str_replace(['_'],['-'],$handle ) );
        } 
       
        unset($admin_js);
      
   }

   public function enqueue_public_js($hook){

    $public_js = [
        'qs-paddle-integration-public-base'
    ];

    foreach($public_js as $handle) {
        wp_enqueue_script( str_replace(['_'],['-'],$handle ) );
    }

    unset($public_js);
   }


}