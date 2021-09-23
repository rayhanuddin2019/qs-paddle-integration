<?php 
namespace QS_Paddle_Integration\base;

trait SingleTone {
	private static $instance = null;
	public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }
        return self:: $instance;
    }
}