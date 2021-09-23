<?php 

namespace QS_Paddle_Integration\base\shortcode;

/*
* Register all wp shortcode related js and css
* @since 1.0 
*/

Abstract Class ShortCode_Settings {

    public $slug = null; 
    public $configs = []; 

    public function get_configs(){
      
      return $this->configs;  
    }

    public function get_slug(){
 
      return $this->slug;
    }
    abstract protected function register();
    abstract protected function set_configs( );
    abstract protected function render( $atts, $content ='' );
    
}