<?php

/***** ****** :::::::::::::::: :::::::::::::::::::::::::::::: 
*
* start_date 2021/06  
* @since 1.0 
*
****************** ::::::::::::::  *******************/

if ( !class_exists( 'WooCommerce' ) ) {
    return;
}

if ( ! did_action( 'elementor/loaded' ) ) {
    return;
}

// initialize General Widgets
QS_Paddle_Integration\extension\generalwidgets\Service::register_services();

