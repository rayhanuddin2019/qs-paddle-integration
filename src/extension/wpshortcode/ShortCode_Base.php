<?php 
namespace QS_Paddle_Integration\extension\wpshortcode;
use QS_Paddle_Integration\base\shortcode\ShortCode_Settings;

Abstract Class ShortCode_Base extends ShortCode_Settings {
    
    public $name = null;
    public $defaults = [];
    public $settings = [];
   
    abstract protected function view($atts , $content='');
    public function register(){
      
        $this->setup();
    }
    public function setup(){
       
       $this->set_configs();
       $this->set_name();
       $this->register_widget();
    }

    public function set_configs(){
       
        $this->configs = qs_paddle_integration_wpshortcode_config()->all()['widgets'][$this->slug];
        $this->defaults = isset($this->configs['defaults']) && is_array($this->configs['defaults']) ? $this->configs['defaults'] : [];
       
    }

    public function set_name(){

        $this->name = $this->configs['name'];
    }

    public function register_widget(){

        add_shortcode( $this->slug , [$this, 'render' ] );
    }

    public function render($atts , $content=''){

        $this->settings = shortcode_atts( $this->defaults, $atts );
        $wrapper_cls = apply_filters( 'qs_paddle_wp_shortcode_wrapper_cls', 'qs_paddle_wpsc_wrapper_cls' );
        
        ob_start();

        echo sprintf('<div class=%s>', $wrapper_cls );
           $this->view( $atts , $content = '' );
        echo '</div>';

        return ob_get_clean();

    }
    
}