<?php 

namespace QS_Paddle_Integration\extension\generalwidgets\assets;
use QS_Paddle_Integration\system\base\assets\Assets as Woo_Ready_Resource;

/*
* Register all widgets related js and css
* @since 1.0 
* $pagenow (string) used in wp-admin See also get_current_screen() for the WordPress Admin Screen API
* $post_type (string) used in wp-admin
* $allowedposttags (array)
* $allowedtags (array)
* $menu (array)
*/

Class Assets extends Woo_Ready_Resource{
   
   public function register(){
    /*--------------------------------
        ENQUEUE FRONTEND SCRIPTS
    ---------------------------------*/
    //add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'enqueue_public_js' ] );
    //add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'enqueue_public_css' ] );
   
   }

  /*
   * enqueue css
   */ 
  public function enqueue_public_css($hook){
 
        
    $public_css = [
        'qs-paddle-intregration-extra-widgets-base'
    ];

    foreach($public_css as $handle){
        wp_enqueue_style( str_replace(['_'],['-'],$handle ) );
    }

    unset($public_css);
 } 
 

   public function enqueue_public_js($hook){

    $public_js = [
        'qs-paddle-intregration-extra-widgets',
   ];

    foreach($public_js as $handle) {
 
        wp_enqueue_script( str_replace(['_'],['-'],$handle ) );
    }

 
    unset($public_js);
   }


}