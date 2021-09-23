<?php

    /**************************************** 
    * all Widgets settings 
    * Widget will read this arra
    * since 1.0
    **********************  ****************/

    /********************** *********************
    * since 1.0 
    * price 
   
    ************************** **************/

    /****************************************
    * widgets/components Config
    * slug = directory_name+filename
    * key should be lower_case
    **************** *************/

    $return_component  = [

     

            'price_table_qs_paddle_widget' => [

              'title'         => esc_html__('Price Table','qs-paddle-integration'),
              'icon'          => 'eicon-tabs',
              'show_in_panel' => false,
              'is_pro'        => false,
              'dashboard'     => 'yes',
              'category'      => [ 'wgenerel' ],
              'keywords'      => [ 'Price Table', 'Table' ],
              'css'           => [
                'qs-paddle-intregration-extra-widgets-base'
              ],

              'js' => [
                'paddle-bootstrap'
              ]
            ], 

            'button_qs_paddle_button_widget' => [

              'title'         => esc_html__('Paddle Button','qs-paddle-integration'),
              'icon'          => 'eicon-button',
              'show_in_panel' => false,
              'is_pro'        => false,
              'dashboard'     => 'yes',
              'category'      => [ 'wgenerel' ],
              'keywords'      => [ 'Paddle button', 'Buy button','paddle' ],
              'css'           => [
                'qs-paddle-intregration-extra-widgets-base'
              ],

              'js' => [
                'paddle-bootstrap'
              ]
            ],
             
    ];

    // Call from anywhere
    return apply_filters( 'qs_paddle_inegration_gen_widgets_config', $return_component );