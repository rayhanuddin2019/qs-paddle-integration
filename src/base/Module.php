<?php 

namespace QS_Paddle_Integration\base;

trait Module {

    public static function  sr_module_live() { return qs_paddle_intregration_sysytem_module_options_is_active(self::$ext_name); }
   
}