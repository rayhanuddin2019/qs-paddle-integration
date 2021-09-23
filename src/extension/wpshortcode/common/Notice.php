<?php 
namespace QS_Paddle_Integration\extension\wpshortcode\common;
use QS_Paddle_Integration\extension\wpshortcode\ShortCode_Base;

Class Notice extends ShortCode_Base {
   
    // [qs_paddle_wc_order]
    public $slug = 'qs_pricing_table';

    public function view( $atts , $content='' ){

        $settings =  $this->settings;
        include( plugin_dir_path( __FILE__ ) . 'view/default.php');
        unset($settings);
    }

    
 
}