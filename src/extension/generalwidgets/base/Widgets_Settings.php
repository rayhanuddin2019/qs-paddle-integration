<?php

namespace QS_Paddle_Integration\extension\generalwidgets\base;
use Illuminate\Config\Repository as QS_Paddle_Intregration;

 Class Widgets_Settings{

    public function register(){

      add_filter('qs_paddle_intregration_system_widgets_config',[$this,'_load_components_widgets'],16); 
    }

    public function _load_components_widgets($widgets){
        
        $prev_arr = $widgets->all();
        $new_arry = qs_paddle_intregration_genwidget_config()->all();
        $merge    = array_merge($prev_arr, $new_arry);
        $_config  = new QS_Paddle_Intregration($merge);

        return $_config;
    }
    
}