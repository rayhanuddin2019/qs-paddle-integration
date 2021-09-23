<?php
namespace QS_Paddle_Integration\base;

Abstract class Ajax_Manager{
    public $config_array = [

    ];
    function __construct (){
        
      $this->register_event();
    }
    abstract protected function register();
    public function register_event(){
        
        foreach($this->config_array as $key => $method){
           
            if(method_exists(get_called_class(),$method)){
                add_action( 'wp_ajax_'.$key, [get_called_class(),$method] );
            }
            
        }
    }
 }