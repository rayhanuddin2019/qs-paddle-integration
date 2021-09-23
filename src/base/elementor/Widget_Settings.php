<?php 

namespace QS_Paddle_Integration\base\elementor;

/*
* Register all elementor widge
* @since 1.0 
*/

Abstract Class Widget_Settings {

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