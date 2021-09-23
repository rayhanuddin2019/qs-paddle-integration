<?php

/* all shortcode basic settings 
* array widgets key is shortcode unique identifier
*/
return [

    //  Extension Config
    'meta' => [
      'name' => esc_html__('Wp Shortcode','qs-paddle-integration'),
      'description' => esc_html__('Wp Shortcode use for base widget setting that can run any editor','qs-paddle-integration'),
      'author' => 'quomodosoft'
    ],

    'widgets' => [
        
      
        'qs_paddle_notice' => [
            'name' => esc_html__('Notice','qs-paddle-integration'),
            'category'      => ['Account','Checkout'],
            // configure defaults settings otherwise will not works
            'defaults'      => [
                'type' => 'default',
            ],
        ],
  
    ],
  
    
];